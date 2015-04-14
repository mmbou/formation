<?php
namespace OCFram;

class Page extends ApplicationComponent
{
  protected $contentFile;
  protected $vars = [];
  protected $format;

  public function __construct(Application $app, $format)
  {
    parent::__construct($app);
    $this->format = $format;

  }

  public function addVar($var, $value)
  {
    if (!is_string($var) || is_numeric($var) || empty($var))
    {
      throw new \InvalidArgumentException('Le nom de la variable doit être une chaine de caractères non nulle');
    }

    $this->vars[$var] = $value;
  }

  public function getGeneratedPage()
  {
    if (!file_exists($this->contentFile))
    {
      throw new \RuntimeException('La vue spécifiée n\'existe pas');
    }

    $user = $this->app->user();       //add

    extract($this->vars);

  /*  var_dump($this->vars);

    ob_start();
      require $this->contentFile;
    $content = ob_get_clean();

    ob_start();      
 
     require __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.html.php';             
             
       


    return ob_get_clean();*/

    switch($this->format)
    {
      case 'json': return $this->getGeneratedPageJson(); break;

      case 'html': return $this->getGeneratedPageHtml($user); break;

      default: return $this->getGeneratedPageHtml($user); break;

    }
  }

  public function setContentFile($contentFile)
  {
    if (!is_string($contentFile) || empty($contentFile))
    {
      throw new \InvalidArgumentException('La vue spécifiée est invalide');
    }

    $this->contentFile = $contentFile;
  }


  public function getGeneratedPageJson(){
   extract($this->vars);
   $content = include $this->contentFile;

   header('Content-Type: application/json');
   return json_encode(include __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.'.$this->format.'.php');
       
 }

  public function getGeneratedPageHtml($user){

     extract($this->vars);
     ob_start();
     require $this->contentFile;
     $content = ob_get_clean();

     ob_start();
     require __DIR__.'/../../App/'.$this->app->name().'/Templates/layout.php';
     return ob_get_clean();

 }

}

?>