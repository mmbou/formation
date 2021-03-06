<?php
namespace App\Backend\Modules\Connexion;

use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\User;
use \Entity\News;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \OCFram\FormHandler;

class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->app->user()->setAttribute('format','html');
    $this->page->addVar('title', 'Connexion');
    
    if ($request->postExists('login'))
    {
      $login = $request->postData('login');
      $password = $request->postData('password');

    // On récupère le manager des users.
    $user = $this->managers->getManagerOf('Users')->getUniqueCurrent($login, crypt($request->postData('password'), '$2a$07$usesomesillystringfor'.$this->app->config()->get('salt').'$'));

    // On regarde si l'utilisateur était trouvé
    if(isset($user))
    {
      $this->app->user()->setAuthenticated(true);

      $this->app->user()->setAttribute('id',$user->id()); 
      $this->app->user()->setAttribute('type',$user->type()); 
      $this->app->user()->setAttribute('nom',$user->nom()); 
      $this->app->user()->setAttribute('prenom',$user->prenom());


      if($user->type() == 1)    
      {
        //On le dirige vers la partie admin
        $this->app->httpResponse()->redirect('/admin/');
      }

      //On le dirige vers la partie écrivains
      $this->app->httpResponse()->redirect('/');

              
    }
     else
    {
            $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
    }


      
    }
  }

/**
 * Fonction de déconnexion d'un utilisateur
 */

public function executeLogout(HTTPRequest $request)
  {
        $this->app->user()->setAttribute('id',null); 
        $this->app->user()->setAttribute('type',null); 
        $this->app->user()->setAttribute('nom',null); 
        $this->app->user()->setAttribute('prenom',null);
        $this->app->user()->setAttribute('back',null);
        $this->app->user()->setAuthenticated(false);
        $this->app->httpResponse()->redirect('.');
  
    
  }


  public function executeGeneratePassword(HTTPRequest $request)
  {   
      $this->app->user()->setFlash(var_dump('Test'));die; 
      $this->page->addVar('title', 'Generation password');
  }


    public function executeNoConnected(HTTPRequest $request)
  {   
      $retour = array(
        'error' => 'Error',
        'message' => 'Vous n\' etes pas connecté');

       $this->page->addVar('data', $retour);

       $this->page->addVar('code', 100);
  }







}

?>