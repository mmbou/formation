<?php
namespace Model;

use \Entity\User;

class UsersManagerPDO extends UsersManager
{


 public function count()   
  {
    return $this->dao->query('SELECT COUNT(*) FROM users')->fetchColumn();
  }



 public function getUnique($login, $password)
  {
    $requete = $this->dao->prepare('SELECT id, nom, prenom, login, password, dateNaissance, dateAjout, type FROM users WHERE login = :login AND password = :password');
    
    $requete->bindValue(':login', (string) $login, \PDO::PARAM_STR);
    $requete->bindValue(':password', (string) $password, \PDO::PARAM_STR);

    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
    
    if ($user = $requete->fetch())
    {

      return $user;
    }
    
    return null;
  }









}

?>