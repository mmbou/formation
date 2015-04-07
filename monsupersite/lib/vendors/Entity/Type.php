<?php
namespace Entity;

use \OCFram\Entity;

class Type extends Entity
{
  protected $descriptif;

const DESCRIPTIF_INVALIDE = 1;




  public function isValid()
  {
    return !(empty($this->descriptif));
  }


  // SETTERS //

  public function setDescriptif($descriptif)
  {
    if (!is_string($descriptif) || empty($descriptif))
    {
      $this->erreurs[] = self::DESCRIPTIF_INVALIDE;
    }

    $this->descriptif = $descriptif;
  }

  

  // GETTERS //

  public function descriptif()
  {
    return $this->descriptif;
  }



}


?>