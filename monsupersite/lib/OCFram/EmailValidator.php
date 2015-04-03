<?php
namespace OCFram;

class EmailValidator extends Validator
{
  public function isValid($value)
  {
  	if (filter_var($value, FILTER_VALIDATE_EMAIL))
  	{
  		return $value;
  	}

  return null;

  }


}



?>