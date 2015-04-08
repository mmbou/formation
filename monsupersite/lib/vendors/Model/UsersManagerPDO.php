<?php
namespace Model;

use \Entity\User;
use \Entity\Type;

class UsersManagerPDO extends UsersManager
{


 public function count()   
  {
    return $this->dao->query('SELECT COUNT(*) FROM users')->fetchColumn();
  }

 public function getNom($id)
 {
    $requete = $this->dao->prepare('SELECT nom, prenom FROM users WHERE id = :id');
    
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
    
    if ($user = $requete->fetch())
    {

      return $user;
    }
    
    return null;
 }


 public function getUniqueCurrent($login, $password)
  {
    $requete = $this->dao->prepare('SELECT id, nom, prenom, login, password, dateAjout, type, email FROM users WHERE login = :login AND password = :password');
    
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
    $requete = $this->dao->prepare('INSERT INTO users SET nom = :nom, prenom = :prenom, login = :login, password = :password, dateAjout = NOW(), type = :type, email = :email');
    
    $requete->bindValue(':nom', $user->nom());
    $requete->bindValue(':prenom', $user->prenom());
    $requete->bindValue(':login', $user->login());
    $requete->bindValue(':password', $user->password());
    $requete->bindValue(':type', $user->type());
    $requete->bindValue(':email', $user->email());

    
    $requete->execute();
  }


    protected function modify(User $user)
  {
    $requete = $this->dao->prepare('UPDATE users SET nom = :nom, prenom = :prenom, login = :login, password = :password, type = :type, email = :email WHERE id = :id');
    
    $requete->bindValue(':nom', $user->nom());
    $requete->bindValue(':prenom', $user->prenom());
    $requete->bindValue(':login', $user->login());
    $requete->bindValue(':password', $user->password());
    $requete->bindValue(':type', $user->type());
     $requete->bindValue(':email', $user->email());
    $requete->bindValue(':id', $user->id(), \PDO::PARAM_INT);
    
    $requete->execute();
  }

      public function deleteUser($id)
  {
    $this->dao->exec('DELETE FROM users WHERE id = '.(int) $id);
  }




 public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, nom, prenom, login, password, dateAjout, type, email FROM users WHERE id = :id');
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


  public function getList($debut = -1, $limite = -1)
  {
    $sql = 'SELECT id, nom, prenom, dateAjout, type, email FROM users ORDER BY id DESC';
    
    if ($debut != -1 || $limite != -1)
    {
      $sql .= ' LIMIT '.(int) $limite.' OFFSET '.(int) $debut;
    }
    
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
    
    $listeUsers = $requete->fetchAll();
    
    foreach ($listeUsers as $users)
    {
      $users->setDateAjout(new \DateTime($users->dateAjout()));
    }
    
    $requete->closeCursor();
    
    return $listeUsers;
  }


     public function getListType()
  {
    $sql = 'SELECT type.id,type.descriptif FROM type LEFT OUTER JOIN users ON type = type.id GROUP BY type.id, type.descriptif ORDER BY type.id ASC';
    

    
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
    
    $listeUsers = $requete->fetchAll();
    
    foreach ($listeUsers as $users)
    {
      $users->setDateAjout(new \DateTime($users->dateAjout()));
    }
    
    $requete->closeCursor();
    
    return $listeUsers;
  }









}

?>