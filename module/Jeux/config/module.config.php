<?php 

 return array(
     'controllers' => array(
         'invokables' => array(
             'Jeux\Controller\Jeux' => 'Jeux\Controller\JeuxController',
         ),
     ),
	 
     'router' => array(
         'routes' => array(
             'jeux' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/jeux[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Jeux\Controller\Jeux',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),

	 
     'view_manager' => array(
         'template_path_stack' => array(
             'jeux' => __DIR__ . '/../view',
         ),
     ),
 );
 
 ?>