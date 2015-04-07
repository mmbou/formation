<?php
namespace Model;
 
use \OCFram\Manager;
use \Entity\Type;
 
abstract class TypesManager extends Manager
{

  abstract public function getType();

  
}

?>