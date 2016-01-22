<?php 

 namespace Avis\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Avis\Model\Avis;          // <-- Add this import
 use Avis\Form\AvisForm;       // <-- Add this import


 class AvisController extends AbstractActionController
 {
     public function indexAction()
     {
	
         return new ViewModel(array(
			  'data' => $this->getServiceLocator()->get('AuthService'),
             'aviss' => $this->getAvisTable()->fetchAll($this->getServiceLocator()->get('AuthService')->getStorage()->read()->id),
         ));
     }

    public function addAction()
     {
         $form = new AvisForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $avis = new Avis();
             $form->setInputFilter($avis->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $avis->exchangeArray($form->getData());
                 $this->getAvisTable()->saveAvis($avis);

                 // Redirect to list of avis
                 return $this->redirect()->toRoute('avis');
             }
         }
         return array('form' => $form);
     }


     public function editAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('avis', array(
                 'action' => 'add'
             ));
         }

         // Get the Avis with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $avis = $this->getAvisTable()->getAvis($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('avis', array(
                 'action' => 'index'
             ));
         }

		 if(!$avis) {
             return $this->redirect()->toRoute('avis', array(
                 'action' => 'add'
             ));
		 }
		 // var_dump($avis);
		 
         $form  = new AvisForm();
         $form->bind($avis);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($avis->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getAvisTable()->saveAvis($avis);

                 // Redirect to list of aviss
                 return $this->redirect()->toRoute('avis');
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
		 $avis = $this->getAvisTable();

         if (!$id) {
             return $this->redirect()->toRoute('avis');
         }
		 
		 if(!$avis->getAvis($id))
             return $this->redirect()->toRoute('avis');


         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $avis->deleteAvis($id);
             }

             // Redirect to list of aviss
             return $this->redirect()->toRoute('avis');
         }

         return array(
             'id'    => $id,
             'avis' => $avis->getAvis($id)
         );
     }
	 
	 protected $avisTable;
	 
     public function getAvisTable()
     {
         if (!$this->avisTable) {
             $sm = $this->getServiceLocator();
             $this->avisTable = $sm->get('Avis\Model\AvisTable');
			 $this->avisTable->__setUser($this->getServiceLocator()->get('AuthService')->getStorage()->read()->id);
         }
         return $this->avisTable;
     }
 }
 
 ?>