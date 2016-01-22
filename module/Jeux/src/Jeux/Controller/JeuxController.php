<?php 

 namespace Jeux\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Jeux\Model\Jeux;          // <-- Add this import
 use Jeux\Form\JeuxForm;       // <-- Add this import


 class JeuxController extends AbstractActionController
 {
     public function indexAction()
     {
		 
		//$this->layout()->setVariable('hasIdentity', $this->getServiceLocator()->get('AuthService')->hasIdentity());
/*
        if (! $this->getServiceLocator()
                 ->get('AuthService')->hasIdentity()){
            return $this->redirect()->toRoute('login');
        }
*/

		// print_r( $this->getServiceLocator()->get('AuthService'));
		//exit;


         return new ViewModel(array(
			  'data' => $this->getServiceLocator()->get('AuthService'),
             'jeuxs' => $this->getJeuxTable()->fetchAll($this->getServiceLocator()->get('AuthService')->getStorage()->read()->id),
         ));
     }

    public function addAction()
     {
         $form = new JeuxForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $jeux = new Jeux();
             $form->setInputFilter($jeux->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $jeux->exchangeArray($form->getData());
                 $this->getJeuxTable()->saveJeux($jeux);

                 // Redirect to list of jeuxs
                 return $this->redirect()->toRoute('jeux');
             }
         }
         return array('form' => $form);
     }


     public function editAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('jeux', array(
                 'action' => 'add'
             ));
         }

         // Get the Jeux with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $jeux = $this->getJeuxTable()->getJeux($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('jeux', array(
                 'action' => 'index'
             ));
         }

		 if(!$jeux) {
             return $this->redirect()->toRoute('jeux', array(
                 'action' => 'add'
             ));
		 }
		 // var_dump($jeux);
		 
         $form  = new JeuxForm();
         $form->bind($jeux);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($jeux->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getJeuxTable()->saveJeux($jeux);

                 // Redirect to list of jeuxs
                 return $this->redirect()->toRoute('jeux');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
     }

     public function deleteAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
		 $jeux = $this->getJeuxTable();

         if (!$id) {
             return $this->redirect()->toRoute('jeux');
         }
		 
		 if(!$jeux->getJeux($id))
             return $this->redirect()->toRoute('jeux');


         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $jeux->deleteJeux($id);
             }

             // Redirect to list of jeuxs
             return $this->redirect()->toRoute('jeux');
         }

         return array(
             'id'    => $id,
             'jeux' => $jeux->getJeux($id)
         );
     }
	 
	 protected $jeuxTable;
	 
     public function getJeuxTable()
     {
         if (!$this->jeuxTable) {
             $sm = $this->getServiceLocator();
             $this->jeuxTable = $sm->get('Jeux\Model\JeuxTable');
			 $this->jeuxTable->__setUser($this->getServiceLocator()->get('AuthService')->getStorage()->read()->id);
         }
         return $this->jeuxTable;
     }
 }
 
 ?>