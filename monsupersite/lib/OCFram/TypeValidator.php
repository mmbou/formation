<?php
namespace OCFram;

class TypeValidator extends Validator
{


    public function isValid($value)
  {
   
  $valeurInt = (int) $value;
    if($valeurInt == 1 || $valeurInt == 2)
    {
      return $valeurInt;
    }

    return null;
  }

}



?>