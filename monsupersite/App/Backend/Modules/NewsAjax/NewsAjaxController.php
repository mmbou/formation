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
 
    public function executeInsert(HTTPRequest $request)
  {
    $this->processForm($request);
    $this->app->user()->setAttribute('back','json');
    $this->app->user()->setFlash(var_dump( $this->app->user()->getAttribute('back')));
    $this->page->addVar('back', $this->app->user()->getAttribute('back'));
 
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

      if($news->isValid())
      {
                // Traitements
        $retour = array(
            'auteur'    => $this->app->user()->getAttribute('id'),
            'titre'      => $news->titre(),
            'contenu'=> $news->contenu(),
            'success' =>'Success'
        );
         
        // Envoi du retour (on renvoi le tableau $retour encodé en JSON)
        header('Content-type: application/json');
        echo json_encode($retour);
        
      }
      else
      {
                // Traitements
        $retour = array(

            'success' =>'Failed'
        );

        header('Content-type: application/json'); 
        echo json_encode($retour);
      }
 
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
      $this->app->user()->setFlash($news->isNew() ? 'La news a bien été ajoutée (Ajax)!' : 'La news a bien été modifiée !');
 
    }
 
    $this->page->addVar('form', $form->createView());
  }


    


}


?>