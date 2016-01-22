<?php 

 return array(
     'controllers' => array(
         'invokables' => array(
             'Avis\Controller\Avis' => 'Avis\Controller\AvisController',
         ),
     ),
	 
     'router' => array(
         'routes' => array(
             'avis' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/avis[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Avis\Controller\Avis',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

	 
     'view_manager' => array(
         'template_path_stack' => array(
             'avis' => __DIR__ . '/../view',
         ),
     ),
 );
 
 ?>