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

    $widget .= '<label>'.$this->label.'</label><select name="'.$this->name.'" id="'.$this->id.'">';


    foreach ($this->values as $valuesType) 
    {
      if($this->value == $valuesType->id())
      $widget .= '<option value="'.$valuesType->id().'" selected>'.$valuesType->descriptif().'</option>';

      else
      $widget .= '<option value="'.$valuesType->id().'">'.$valuesType->descriptif().'</option>'; 
    }
 
    $widget .= '</select>';
    return $widget;
  }
  
 
}




?>