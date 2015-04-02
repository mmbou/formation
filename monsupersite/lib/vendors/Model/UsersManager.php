<?php
namespace Model;
 
use \OCFram\Manager;
use \Entity\User;
 
abstract class UsersManager extends Manager
{


  /**
   * Méthode permettant d'enregistrer une news.
   * @param $news News la news à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(User $user)
  {
    if ($user->isValid())
    {
      $user->isNew() ? $this->add($user) : $this->modify($user);
    }
    else
    {
      throw new \RuntimeException('Le user doit être valide pour être enregistré');
    }
  }

    /**
   * Méthode permettant d'ajouter une news.
   * @param $news News La news à ajouter
   * @return void
   */
  abstract protected function add(User $user);

  /**
   * Méthode renvoyant le nombre d'utilisateur total
   * @return int
   */
  abstract public function count();

   /**
   * Méthode retournant une liste de news demandée.
   * @param $debut int La première news à sélectionner
   * @param $limite int Le nombre de news à sélectionner
   * @return array La liste des news. Chaque entrée est une instance de News.
   */
  abstract public function getList($debut = -1, $limite = -1);



    /**
   * Méthode permettant de supprimer une news.
   * @param $id int L'identifiant de la news à supprimer
   * @return void
   */
  abstract public function deleteUser($id);
 
 

  /**
   * Méthode retournant l'utilisateur qui veut se connecter
   * @param $login et $password de l'utilisateur 
   * @return User demandé
   */
  abstract public function getUniqueCurrent($login, $password);

    /**
   * Méthode retournant une news précise.
   * @param $id int L'identifiant de la news à récupérer
   * @return News La news demandée
   */
  abstract public function getUnique($id);

  abstract public function getNom($id); 
  
}

?>