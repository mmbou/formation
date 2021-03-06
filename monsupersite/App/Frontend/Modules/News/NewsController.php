<?php
namespace App\Frontend\Modules\News;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \OCFram\FormHandler;
use \Entity\Comment;
use \Entity\News;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;



class NewsController extends BackController
{

  public function executeConfirmCommentInsert(HTTPRequest $request)
  {
         // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'news' => $request->getData('news'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu'),
        'email' => $request->postData('email'), 
        'checkbox' => $request->postData('checkbox') 
      ]);

     $retour = array(
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu'),
        'email' => $request->postData('email'), 
        'checkbox' => $request->postData('checkbox'));

      $formBuilder = new CommentFormBuilder($comment);
      $formBuilder->build();

      $form = $formBuilder->form();

      $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

      if($formHandler->process())
      {

        $commentScope = $this->managers->getManagerOf('Comments')->get($this->managers->getManagerOf('Comments')->getScope());
       
        $f = "<fieldset><legend>Post&eacute par <a href=\"/commentauthor/".$commentScope->email()."html\"><strong>".htmlspecialchars($commentScope->auteur())."</strong></a> le ".$commentScope->date(). "</legend><p>".nl2br(htmlspecialchars($commentScope->contenu()))."</p></fieldset>";

        $retour = array(
        'id' => $commentScope->id(), 
        'news' => $commentScope->news(), 
        'auteur' => $commentScope->auteur(),
        'contenu' => $commentScope->contenu(),
        'email' => $commentScope->email(), 
        'date' => $commentScope->date(),
        'checkbox' =>$commentScope->checkbox(),
        'f' => $f);
       
          $this->page->addVar('data', $retour);

          $this->page->addVar('code', 200);

      }
      else
      {
          $this->page->addVar('data', $retour);

          $this->page->addVar('code', 100);
      }

    }
   


  } 

    public function executeInsertComment(HTTPRequest $request)
  {
       // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'news' => $request->getData('news'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu'),
        'email' => $request->postData('email'), 
        'checkbox' => $request->postData('checkbox') 
      ]);
    }
    else
    {
      $comment = new Comment;
    }

    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();

    $form = $formBuilder->form();

    

    $retour = array('formulaire' => $form->createView());

    $this->page->addVar('data', $retour);

    $this->page->addVar('code', 200);
/*
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);

    

    if ($formHandler->process())
    {
      $mails = $this->managers->getManagerOf('Comments')->sendingMails($request->getData('news'), $comment->email());
      // $this->app->user()->setFlash(var_dump($mails));
      //die;

      $mailNonEnvoye = '';
      foreach ($mails as $mail)
        mail($mail->email(),$request->postData('auteur').' a commenté la news '.$request->getData('news')->titre(), 'Commentaire: '.$comment->contenu());
      

      $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
      $this->app->httpResponse()->redirect('news-'.$request->getData('news').'.html');
  

    }

    $this->page->addVar('news', $request->getData('news'));
    $this->page->addVar('comment', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');*/
  }


  public function executeIndex(HTTPRequest $request)
  {

    $nombreNews = $this->app->config()->get('nombre_news');
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
    
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des '.$nombreNews.' dernières news');
    
    // On récupère le manager des news.
    $manager = $this->managers->getManagerOf('News');

     $listeNews = $manager->getList(0, $nombreNews);
    
    // Cette ligne, vous ne pouviez pas la deviner sachant qu'on n'a pas encore touché au modèle.
    // Contentez-vous donc d'écrire cette instruction, nous implémenterons la méthode ensuite.
   
    
    foreach ($listeNews as $news)
    {
      if (strlen($news->contenu()) > $nombreCaracteres)
      {
        $debut = substr($news->contenu(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
        
        $news->setContenu($debut);
      }
    }
    
    // On ajoute la variable $listeNews à la vue.
    $this->page->addVar('listeNews', $listeNews);
  }


  public function executeShow(HTTPRequest $request)
  {
    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
    $auteur = $this->managers->getManagerOf('Users')->getNom($news->auteur());
    
    if (empty($news))
    {
      $this->app->httpResponse()->redirect404();
    }
    
    $this->page->addVar('title', $news->titre());
    $this->page->addVar('news', $news);
    $this->page->addVar('auteur', $auteur);
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($news->id()));
  }


  public function executeListNewsOfAuthor(HTTPRequest $request)
  {
   
    $this->page->addVar('title', 'Auteur news');
 
    $manager = $this->managers->getManagerOf('News');
 
    $this->page->addVar('listeNews', $manager->getListNews($request->getData('id')));
    $this->page->addVar('nombreNews', $manager->countNews($request->getData('id')));

  }

   public function executeGetNewsCommentedByEmail(HTTPRequest $request)
  {
    
     $this->page->addVar('title', 'Comment email');

     $manager = $this->managers->getManagerOf('Comments');

     $this->page->addVar('comments', $manager->getCommentByEmail($request->getData('email')));


  }

 



}

?>