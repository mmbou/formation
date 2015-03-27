<?php
namespace Model;
 
use \OCFram\Manager;
use \Entity\Users;
 
abstract class UsersManager extends Manager
{
  
  /**
   * Méthode renvoyant le nombre d'utilisateur total
   * @return int
   */
  abstract public function count();

  /**
   * Méthode retournant l'utilisateur qui veut se connecter
   * @param $login et $password de l'utilisateur 
   * @return User demandé
   */
  abstract public function getUnique($login, $password);
 
  
}

?>