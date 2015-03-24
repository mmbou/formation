<?php
class Personnage
{
  private $_force = 20;        // La force du personnage
  private $_experience = 0;   // Son expérience
  private $_degats = 0;       // Ses dégâts
        

  public function __construct($force, $degats) // Constructeur demandant 2 paramètres
  {
    echo 'Voici le constructeur !'; // Message s'affichant une fois que tout objet est créé.
    $this->setForce($force); // Initialisation de la force.
    $this->setDegats($degats); // Initialisation des dégâts.
    $this->_experience = 1; // Initialisation de l'expérience à 1.
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
    if (!is_int($force)) // S'il ne s'agit pas d'un nombre entier.
    {
      trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
      return;
    }
    
    if ($force > 100) // On vérifie bien qu'on ne souhaite pas assigner une valeur supérieure à 100.
    {
      trigger_error('La force d\'un personnage ne peut dépasser 100', E_USER_WARNING);
      return;
    }
    
    $this->_force = $force;
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
  public function parler()
  {
    echo "<br/>";
    echo 'Je suis un personnage !';
  }

    public function affichePersonne()
  {
    echo "<br/>";
    echo 'Personnage [] Force: ',$this->_force,' Experience : ',$this->_experience,' Degats : ', $this->_degats;
  }

}

$perso1 = new Personnage(60, 0); // 60 de force, 0 dégât
$perso1->affichePersonne();



?>