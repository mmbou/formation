<?php
namespace OCFram;

class PasswordField extends Field
{
  protected $maxLength;

  public function buildWidget()
  {
    $widget = '';
    
    if (!empty($this->errorMessage))
    {
      $widget .= $this->errorMessage.'<br />';
    }

   
        $widget .= '<label>'.$this->label.'</label><input type="password" name="'.$this->name.'"';
        $widget .= ' value="'.htmlspecialchars($this->value).'"';

       
    
    if (!empty($this->maxLength))
    {
      $widget .= ' maxlength="'.$this->maxLength.'"';
    }
    
    return $widget .= ' />';
  }
  
  public function setMaxLength($maxLength)
  {
    $maxLength = (int) $maxLength;
    
    if ($maxLength > 0)
    {
      $this->maxLength = $maxLength;
    }
    else
    {
      throw new \RuntimeException('La longueur maximale doit être un nombre supérieur à 0');
    }
  }
}




?>