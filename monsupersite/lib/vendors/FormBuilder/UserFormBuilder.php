<?php
namespace FormBuilder;

use \OCFram\FormBuilder;
use \OCFram\StringField;
use \OCFram\TextField;
use \OCFram\MaxLengthValidator;
use \OCFram\NotNullValidator;

class UserFormBuilder extends FormBuilder
{
  public function build()
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
       ->add(new StringField([
        'label' => 'Password',
        'name' => 'password',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le mot de pass spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le mot de pass'),
        ],
       ]))
       ->add(new StringField([
        'label' => 'Type (1: Admin, 0:Writer)',
        'name' => 'type',
        'maxLength' => 100,
        'validators' => [
          new MaxLengthValidator('Le type spécifié est trop long (100 caractères maximum)', 100),
          new NotNullValidator('Merci de spécifier le type'),
        ],
       ]));
  }
}



?>