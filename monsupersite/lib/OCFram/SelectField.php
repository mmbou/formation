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

    foreach ($this->values as $value) 
    {
      $widget .= '<option value="'.$value->id().'">'.$value->descriptif().'</option>';
    }
 

    $widget .= '</select>';
    return $widget;
  }
  
 
}




?>