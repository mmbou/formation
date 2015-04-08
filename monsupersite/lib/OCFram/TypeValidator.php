<?php
namespace OCFram;

class TypeValidator extends Validator
{

  protected $liste;
  
  public function __construct($errorMessage, $liste)
  {
    parent::__construct($errorMessage);
    
    $this->setListe($liste);
  }
  
  public function isValid($value)
  {

  	foreach ($this->liste as $list)
    {
  		if($list->id() == $value)
  		{
  			return $value;
  		}
  	}
    return null;
  }

  public function liste()
  {   
    return $liste;
  
  }

  
  public function setListe($liste)
  {   
    $this->liste = $liste;
  
  }
}



?>