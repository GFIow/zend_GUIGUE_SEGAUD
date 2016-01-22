<?php 

 namespace Avis\Form;

 use Zend\Form\Form;

 class AvisForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('avis');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'titre',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Titre',
             ),
         ));
         $this->add(array(
             'name' => 'avis',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Avis',
             ),
         ));
         $this->add(array(
             'name' => 'note',
             'type' => 'Number',
             'options' => array(
                 'label' => 'Note',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }
 
 ?>