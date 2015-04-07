<?php
namespace Model;

use \Entity\Type;

class TypesManagerPDO extends TypesManager
{



    public function getType()
  {
    $sql = 'SELECT id,descriptif FROM type ORDER BY id ASC';
    
    
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Type');
    
    $listeType = $requete->fetchAll();
    
    
    $requete->closeCursor();
    
    return $listeType;
  }










}

?>