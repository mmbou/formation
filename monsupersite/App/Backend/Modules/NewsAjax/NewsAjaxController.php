<?php
namespace App\Backend\Modules\NewsAjax;
 
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

 
class NewsAjaxController extends BackController
{
  
 
  public function executeInsertAjax(HTTPRequest $request)
  {
    $this->app->user()->setAttribute('format','json');
    $this->page->addVar('format', $this->app->user()->getAttribute('format'));
    $this->processForm($request);

    $this->page->addVar('title', 'Ajout d\'une news');
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


       $retour = array(
            'titre'      => $news->titre(),
            'contenu'=> $news->contenu(),
            'success' =>'Success');
       $this->page->addVar('data',$retour);

 
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

  

  
    


}


?>