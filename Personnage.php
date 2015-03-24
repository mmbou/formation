<?php
class Personnage
{
  private $_force ;        // La force du personnage
  private $_experience ;   // Son expérience
  private $_degats ;       // Ses dégâts

  //Déclaration de constantes
  const FORCE_PETITE = 20;
  const FORCE_MOYENNE = 50;
  const FORCE_GRANDE = 80;
        

  public function __construct($force) // Constructeur demandant 2 paramètres
  {
    echo 'Voici le constructeur !'; // Message s'affichant une fois que tout objet est créé.
    $this->setForce($force); // Initialisation de la force.
    $this->setDegats(0); // Initialisation des dégâts.
    $this->setExperience(1); // Initialisation de l'expérience à 1.
  }




 // Ceci est la méthode degats() : elle se charge de renvoyer le contenu de l'attribut $_degats.
  public function degats()
  {
    return $this->_degats;
  }
        
  // Ceci est la méthode force() : elle se charge de renvoyer le contenu de l'attribut $_force.
  public function force()
  {
    return $this->_force;
  }
        
  // Ceci est la méthode experience() : elle se charge de renvoyer le contenu de l'attribut $_experience.
  public function experience()
  {
    return $this->_experience;
  }

 // Mutateur chargé de modifier l'attribut $_force.
  public function setForce($force)
  {
      // On vérifie qu'on nous donne bien soit une « FORCE_PETITE », soit une « FORCE_MOYENNE », soit une « FORCE_GRANDE ».
    if (in_array($force, [self::FORCE_PETITE, self::FORCE_MOYENNE, self::FORCE_GRANDE]))
    {
      $this->_force = $force;
    }
  }



 // Mutateur chargé de modifier l'attribut $_experience.
  public function setExperience($experience)
  {
    if (!is_int($experience)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('L\'expérience d\'un personnage doit être un nombre entier', E_USER_WARNING);
      return;
    }
    
    if ($experience > 100) // On vérifie bien qu'on ne souhaite pas assigner une valeur supérieure à 100.
    {
      trigger_error('L\'expérience d\'un personnage ne peut dépasser 100', E_USER_WARNING);
      return;
    }
    
    $this->_experience = $experience;
  }

 // Mutateur chargé de modifier l'attribut $_degats.
  public function setDegats($degats)
  {
    if (!is_int($degats)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('Le niveau de dégâts d\'un personnage doit être un nombre entier', E_USER_WARNING);
      return;
    }

    $this->_degats = $degats;
  }

   
  public function frapper(Personnage $persoAFrapper) // Une méthode qui frappera un personnage (suivant la force qu'il a).
  {
    $persoAFrapper->_degats += $this->_force;
  }
        
  public function gagnerExperience() // Une méthode augmentant l'attribut $experience du personnage de 1.
  {
    $this->_experience++;
  }

  public function afficherExperience() // Une méthode qui affiche l'attribut $experience du personnage.
  {
    echo "<br/>";
    echo $this->_experience ; 
  }


   // Nous déclarons une méthode dont le seul but est d'afficher un texte.
  public static function parler()
  {
    echo "<br/>";
    echo 'I\'m the king of this kingdom, Ah ah ah ah!! ';
  }

    public function affichePersonnage()
  {
    echo "<br/>";
    echo 'Personnage [] Force: ',$this->_force,' Experience : ',$this->_experience,' Degats : ', $this->_degats;
  }

}




?>