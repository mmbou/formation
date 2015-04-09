<?php
namespace App\Backend\Modules\News;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \OCFram\FormHandler;
use \Entity\News;
use \Entity\Comment;
use \Entity\User;
use \Entity\Type;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \FormBuilder\UserFormBuilder;

 
class NewsController extends BackController
{
  public function executeDelete(HTTPRequest $request)
  {
    $newsId = $request->getData('id');
 
    $this->managers->getManagerOf('News')->delete($newsId);
    $this->managers->getManagerOf('Comments')->deleteFromNews($newsId);
 
    $this->app->user()->setFlash('La news a bien été supprimée !');
 
    $this->app->httpResponse()->redirect('.');
  }

   public function executeDeleteUser(HTTPRequest $request)
  {
 
    $this->managers->getManagerOf('Users')->deleteUser($request->getData('id'));
 
    $this->app->user()->setFlash('Le user a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function executeDeleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Gestion des news');
 
    $manager = $this->managers->getManagerOf('News');
 
    $this->page->addVar('listeNews', $manager->getList());
    $this->page->addVar('nombreNews', $manager->count());
  }



    public function executeIndexUser(HTTPRequest $request)
  {

    $this->page->addVar('title', 'Gestion des users');
 
    $manager = $this->managers->getManagerOf('Users');

    $this->page->addVar('nombreUsers', $manager->count());
    $this->page->addVar('listeUsers', $manager->getList());

   
  }
 
  public function executeInsert(HTTPRequest $request)
  {
    $this->app->user()->setAttribute('back','html');
    $this->processForm($request);
 
    $this->page->addVar('back',$this->app->user()->getAttribute('back'));
    $this->page->addVar('title', 'Ajout d\'une news');
  }


   public function executeInsertUser(HTTPRequest $request)
  {
    $this->processForm2($request);
 
    $this->page->addVar('title', 'Ajout d\'un utilisateur');
  }
 
  public function executeUpdate(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Modification d\'une news');
  }

    public function executeUpdateUser(HTTPRequest $request)
  {
    $this->processForm2($request);
 
    $this->page->addVar('title', 'Modification d\'un user');
  }
 
 
  public function executeUpdateComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification d\'un commentaire');
 
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu'),
        'email' => $request->postData('email'), 
        'checkbox' => $request->postData('checkbox') 
      ]);
    }
    else
    {
      $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été modifié');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }
 
  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $news = new News([
        'auteur' => $this->app->user()->getAttribute('id'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      ]);
 
      if ($request->getExists('id'))
      {
        $news->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
      }
      else
      {
        $news = new News;
      }
    }
 
    $formBuilder = new NewsFormBuilder($news);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash($news->isNew() ? 'La news a bien été ajoutée !' : 'La news a bien été modifiée !');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }

  

  public function processForm2(HTTPRequest $request)
  {
   $liste = $this->managers->getManagerOf('Types')->getType();

      if ($request->method() == 'POST')
      {

          $user = new User([
          'nom' => $request->postData('nom'),
          'prenom' => $request->postData('prenom'),
          'login' => $request->postData('login'), 
          'password' => $request->postData('password'),
          'passwordConfirmation' => $request->postData('passwordConfirmation'),
          'type' => $request->postData('type'),
          'email' => $request->postData('email'),
             ]);



        if ($request->getExists('id'))
        {
          $user->setId($request->getData('id'));
        }
      }
      else 
      {
        // L'identifiant du user est transmis si on veut le modifier
        if ($request->getExists('id'))
        {
          $user = $this->managers->getManagerOf('Users')->getUnique($request->getData('id'));
        }
        else
        {
          $user = new User;
        }
      }
   
      $formBuilder = new UserFormBuilder($user);
      $formBuilder->build($liste);
   
      $form = $formBuilder->form();
   
      $formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);
      $user->setPassword(crypt($request->postData('password'), '$2a$07$usesomesillystringfor'.$this->app->config()->get('salt').'$'));


         if ($formHandler->process())
        {

          $this->app->user()->setFlash($user->isNew() ? 'Le user a bien été ajoutée !' : 'Le user a bien été modifié !');
     
          $this->app->httpResponse()->redirect('/admin/');
        }

       
   
      $this->page->addVar('form', $form->createView());
    
   
      
  }


  public function executeGetNewsCommentedByEmail(HTTPRequest $request)
  {
    $manager = $this->managers->getManagerOf('Comment'); 
    
    $this->processForm($request);
 
    $this->page->addVar('title', 'Modification d\'une news');
  }


    


}


?>