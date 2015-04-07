<?php
namespace OCFram;

class TypeValidator extends Validator
{


    public function isValid($value)
  {
   
  $valeurInt = (int) $value;
    if($valeurInt == 0 || $valeurInt == 1)
    {
      return $valeurInt;
    }

    return null;
  }

}



?>