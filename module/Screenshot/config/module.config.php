<?php 

 return array(
     'controllers' => array(
         'invokables' => array(
             'Screenshot\Controller\Screenshot' => 'Screenshot\Controller\ScreenshotController',
         ),
     ),
	 
     'router' => array(
         'routes' => array(
             'screenshot' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/screenshot[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Screenshot\Controller\Screenshot',
                         'action'     => 'index',
                     ),
                 ),
             ),
         ),
     ),
     'lien' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/screenshot[/:action][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Screenshot\Controller\Screenshot',
                         'action'     => 'index',
                     ),
                 ),
             ),
	 
     'view_manager' => array(
         'template_path_stack' => array(
             'screenshot' => __DIR__ . '/../view',
         ),
     ),
 );
 
 ?>