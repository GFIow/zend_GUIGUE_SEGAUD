<?php 

 namespace Screenshot\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Screenshot\Model\Screenshot;          // <-- Add this import
 use Screenshot\Form\ScreenshotForm;       // <-- Add this import


 class ScreenshotController extends AbstractActionController
 {
     public function indexAction()
     {
	
         return new ViewModel(array(
			  'data' => $this->getServiceLocator()->get('AuthService'),
             'screenshots' => $this->getScreenshotTable()->fetchAll($this->getServiceLocator()->get('AuthService')->getStorage()->read()->id),
         ));
     }

    public function addAction()
     {
         $form = new ScreenshotForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $screenshot = new Screenshot();
             $form->setInputFilter($screenshot->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $screenshot->exchangeArray($form->getData());
                 $this->getScreenshotTable()->saveScreenshot($screenshot);

                 // Redirect to list of screenshot
                 return $this->redirect()->toRoute('screenshot');
             }
         }
         return array('form' => $form);
     }


     public function editAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('screenshot', array(
                 'action' => 'add'
             ));
         }

         // Get the Screenshot with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $screenshot = $this->getScreenshotTable()->getScreenshot($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('screenshot', array(
                 'action' => 'index'
             ));
         }

		 if(!$screenshot) {
             return $this->redirect()->toRoute('screenshot', array(
                 'action' => 'add'
             ));
		 }
		 // var_dump($screenshot);
		 
         $form  = new ScreenshotForm();
         $form->bind($screenshot);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($screenshot->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getScreenshotTable()->saveScreenshot($screenshot);

                 // Redirect to list of screenshots
                 return $this->redirect()->toRoute('screenshot');
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
		 $screenshot = $this->getScreenshotTable();

         if (!$id) {
             return $this->redirect()->toRoute('screenshot');
         }
		 
		 if(!$screenshot->getScreenshot($id))
             return $this->redirect()->toRoute('screenshot');


         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $screenshot->deleteScreenshot($id);
             }

             // Redirect to list of screenshots
             return $this->redirect()->toRoute('screenshot');
         }

         return array(
             'id'    => $id,
             'screenshot' => $screenshot->getScreenshot($id)
         );
     }
	 
	 protected $screenshotTable;
	 
     public function getScreenshotTable()
     {
         if (!$this->screenshotTable) {
             $sm = $this->getServiceLocator();
             $this->screenshotTable = $sm->get('Screenshot\Model\ScreenshotTable');
			 $this->screenshotTable->__setUser($this->getServiceLocator()->get('AuthService')->getStorage()->read()->id);
         }
         return $this->screenshotTable;
     }
 }
 
 ?>