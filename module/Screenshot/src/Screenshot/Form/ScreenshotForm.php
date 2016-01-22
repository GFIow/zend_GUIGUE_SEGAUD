<?php 

 namespace Screenshot\Form;

 use Zend\Form\Form;

 class ScreenshotForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('screenshot');

         $this->add(array(
             'name' => 'id',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'jeu',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Jeu',
             ),
         ));
         $this->add(array(
             'name' => 'url_image',
             'type' => 'Text',
             'options' => array(
                 'label' => 'URL',
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