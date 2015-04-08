<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\PasswordField;
use \OCFram\SelectField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;
use \OCFram\EmailValidator;
use \OCFram\SameValidator;
use \OCFram\TypeValidator;


class UserFormBuilder extends FormBuilder
{

  public function build($listeType = null)
  {
    $this->form->add(new StringField([
        'label' => 'Nom',
        'name' => 'nom',
        'maxLength' => 20,
        'validators' => [
          new MaxLengthValidator('Le nom spécifié est trop long (20 caractères maximum)', 20),
          new NotNullValidator('Merci de spécifier le nom'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Prenom',
        'name' => 'prenom',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le prenom spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le prenom'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Login',
        'name' => 'login',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le login spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le login'),
        ],
       ]))
       ->add($PasswordField = new PasswordField([
        'label' => 'Password',
        'name' => 'password',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le mot de pass spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le mot de pass'),
        ],
       ]))
       ->add(new PasswordField([
        'label' => 'Confirmer votre password', 
        'name' =>'passwordConfirmation', 
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le mot de pass spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de confirmer le mot de pass'),
          new SameValidator('Le mot de passe doit être identique',$PasswordField)
        ],
       ]))
       ->add(new SelectField([
        'label' => 'Type',
        'name' => 'type',
        'values' => $listeType,
        'validators' => [
          new TypeValidator('Merci de spécifier un type correct',$listeType),
          
        ],
       ]))
       ->add(new StringField([
        'label' => 'Email',
        'name' => 'email',
        'maxLength' => 50,
        'validators' => [
          new MaxLengthValidator('L\'email spécifié est trop long (50 caractères maximum)', 50),
          new NotNullValidator('Merci de spécifier l\'email du commentaire'),
          new EmailValidator('L\' email n\'est pas un valide'),
        ],
       ]))
       ;
  }
}



?>


