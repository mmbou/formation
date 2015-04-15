<?php
namespace App\Backend;

use \OCFram\Application;

class BackendApplication extends Application
{
  public function __construct()
  {
    parent::__construct();

    $this->name = 'Backend';
  }

  public function run()
  {
    $controller = $this->getController();

    if (!$this->user->isAuthenticated())
    {
      if($controller->format() === 'html')
        $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'index', 'html');
      else 
        $controller = new Modules\Connexion\ConnexionController($this, 'Connexion', 'noConnected', $controller->format());
    }

    $controller->execute();

    $this->httpResponse->setPage($controller->page());
    $this->httpResponse->send();
  }
}

?>