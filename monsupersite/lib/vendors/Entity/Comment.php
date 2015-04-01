<?php
namespace Entity;

use \OCFram\Entity;

class Comment extends Entity
{
  protected $news,
            $auteur,
            $contenu,
            $date,
            $email,
            $checkbox;

  const AUTEUR_INVALIDE = 1;
  const CONTENU_INVALIDE = 2;
  const EMAIL_INVALIDE = 3;

  public function isValid()
  {
    return !( empty($this->auteur) || empty($this->contenu)  );
  }

  public function setNews($news)
  {
    $this->news = (int) $news;
  }

  public function setAuteur($auteur)
  {
    if (!is_string($auteur) || empty($auteur))
    {
      $this->erreurs[] = self::AUTEUR_INVALIDE;
    }

    $this->auteur = $auteur;
  }

  public function setContenu($contenu)
  {
    if (!is_string($contenu) || empty($contenu))
    {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    }

    $this->contenu = $contenu;
  }

  public function setDate(\DateTime $date)
  {
    $this->date = $date;
  }


    public function setEmail($email)
  {
    if (!is_string($email) || empty($email))
    {
      $this->erreurs[] = self::EMAIL_INVALIDE;
    }

    $this->email = $email;
  }

     public function setCheckbox($checkbox)
  {
    if(isset($checkbox))
    {
    $this->checkbox = 1;
    }
     if(!isset($checkbox))
    {
    $this->checkbox = 0;
    }

  }

  public function news()
  {
    return $this->news;
  }

  public function auteur()
  {
    return $this->auteur;
  }

  public function contenu()
  {
    return $this->contenu;
  }

  public function date()
  {
    return $this->date;
  }

  public function email()
  {
    return $this->email;
  }

   public function checkbox()
  {
    return $this->checkbox;
  }


}

?>