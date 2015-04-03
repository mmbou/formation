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
    
    $widget .= '<option value="0">Writer</option><option value="1">Admin</option>';

    $widget .= '</select>';
    return $widget;
  }
  
 
}




?>