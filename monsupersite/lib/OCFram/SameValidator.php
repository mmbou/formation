<?php
namespace OCFram;

class SameValidator extends Validator
{

	protected $otherField;

	public function __construct($errorMessage,Field $otherField)
  	{
    	parent::__construct($errorMessage);
    	$this->otherField = $otherField;
  	}

    public function isValid($value)
  {
	
	return ($value == $this->otherField->value());
  }

}



?>