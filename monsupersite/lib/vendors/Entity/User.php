<?php
namespace Entity;

use \OCFram\Entity;

class User extends Entity
{
  protected $nom,
            $prenom,
            $login,
            $password,
            $passwordConfirmation,
            $dateAjout,
            $type,
            $email;

const NOM_INVALIDE                  = 1;
const PRENOM_INVALIDE               = 2;
const LOGIN_INVALIDE                = 3;
const PASSWORD_INVALIDE             = 4;
const PASSWORDCONFIRMATION_INVALIDE = 5;
const TYPE_INVALIDE                 = 6;
const EMAIL_INVALIDE                 = 7;



  public function isValid()
  {
    return !(empty($this->nom) || empty($this->prenom) || empty($this->login) || empty($this->password) || empty($this->passwordConfirmation) || empty($this->email));
  }


  // SETTERS //

  public function setNom($nom)
  {
    if (!is_string($nom) || empty($nom))
    {
      $this->erreurs[] = self::NOM_INVALIDE;
    }

    $this->nom = $nom;
  }

   public function setPrenom($prenom)
  {
    if (!is_string($prenom) || empty($prenom))
    {
      $this->erreurs[] = self::PRENOM_INVALIDE;
    }

    $this->prenom = $prenom;
  }

   public function setLogin($login)
  {
    if (!is_string($login) || empty($login))
    {
      $this->erreurs[] = self::LOGIN_INVALIDE;
    }

    $this->login = $login;
  }


   public function setPassword($password)
  {
    if (!is_string($password) || empty($password))
    {
      $this->erreurs[] = self::PASSWORD_INVALIDE;
    }

    $this->password = $password;
  }


    public function setPasswordConfirmation($passwordConfirmation)
  {
    if (!is_string($passwordConfirmation) || empty($passwordConfirmation))
    {
      $this->erreurs[] = self::PASSWORDCONFIRMATION_INVALIDE;
    }

    $this->passwordConfirmation = $passwordConfirmation;
  }




  public function setDateAjout(\DateTime $dateAjout)
  {
    $this->dateAjout = $dateAjout;
  }

     public function setType($type)
  {
    if (!is_int($type) || empty($type))
    {
      $this->erreurs[] = self::TYPE_INVALIDE;
    }

    $this->type = $type;
  }

    public function setEmail($email)
  {
    if (!is_string($email) || empty($email))
    {
      $this->erreurs[] = self::EMAIL_INVALIDE;
    }

    $this->email = $email;
  }

  // GETTERS //

  public function nom()
  {
    return $this->nom;
  }

  public function prenom()
  {
    return $this->prenom;
  }

  public function login()
  {
    return $this->login;
  }

  public function password()
  {
    return $this->password;
  }

   public function passwordConfirmation()
  {
    return $this->passwordConfirmation;
  }

  public function dateAjout()
  {
    return $this->dateAjout;
  }

  public function type()
  {
    return $this->type;
  }

  public function email()
  {
    return $this->email;
  }

}


?>