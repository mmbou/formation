<?php
namespace OCFram;

class SelectField extends Field
{
  protected $maxLength;
  
  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }
    
    $widget .= '<label>'.$this->label.'</label><select name="'.$this->name.'">';
    
    $listeType = $this->managers->getManagerOf('Types')->getType();
    foreach ($listeType as $type) {
    $widget .= '<option value="$type->id()">$type->descriptif()</option>'; 
    }
    

    $widget .= '</select>';
    return $widget;
  }
  
 
}




?>