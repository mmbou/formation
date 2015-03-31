<?php
namespace Model;

use \Entity\User;

class UsersManagerPDO extends UsersManager
{


 public function count()   
  {
    return $this->dao->query('SELECT COUNT(*) FROM users')->fetchColumn();
  }



 public function getUniqueCurrent($login, $password)
  {
    $requete = $this->dao->prepare('SELECT id, nom, prenom, login, password, dateAjout, type FROM users WHERE login = :login AND password = :password');
    
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


 protected function add(User $user)
  {
    $requete = $this->dao->prepare('INSERT INTO users SET nom = :nom, prenom = :prenom, login = :login, password = :password, dateAjout = NOW(), type = :type');
    
    $requete->bindValue(':nom', $user->nom());
    $requete->bindValue(':prenom', $user->prenom());
    $requete->bindValue(':login', $user->login());
    $requete->bindValue(':password', $user->password());
    $requete->bindValue(':type', $user->type());

    
    $requete->execute();
  }


    protected function modify(User $user)
  {
    $requete = $this->dao->prepare('UPDATE users SET nom = :nom, prenom = :prenom, login = :login, password = :password, dateAjout = :dateAjout, type = :type WHERE id = :id');
    
    $requete->bindValue(':nom', $user->nom());
    $requete->bindValue(':prenom', $user->prenom());
    $requete->bindValue(':login', $user->login());
    $requete->bindValue(':password', $user->password());
    $requete->bindValue(':type', $user->type());
    $requete->bindValue(':id', $user->id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }


 public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, nom, prenom, login, password, dateAjout, type FROM users WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
    
    if ($user = $requete->fetch())
    {
      $user->setDateAjout(new \DateTime($user->dateAjout()));
      
      return $user;
    }
    
    return null;
  }







}

?>