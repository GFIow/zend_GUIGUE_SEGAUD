<?php 

 namespace Screenshot\Model;

 use Zend\Db\TableGateway\TableGateway;

 class ScreenshotTable
 {
     protected $tableGateway;
	 
	 protected $user_id;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
         $this->user_id = -1;
     }

     public function fetchAll($user_id)
     {
         $resultSet = $this->tableGateway->select("owner = ".$this->user_id);
         return $resultSet;
     }
	 
	 public function __setUser($uid) {
		 $this->user_id = $uid;
	 }
	 /*
	 public function isMine($user_id, $screenshot_id) {
         $resultSet = $this->tableGateway->select("owner = ".$user_id);
		var_dump($resultSet);
	 }*/

     public function getScreenshot($id)
     {
		// $this->isMine();
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id' => $id, 'owner' => $this->user_id));
         $row = $rowset->current();
        /* if (!$row) {
             throw new \Exception("Could not find row $id");
         }*/
         return $row;
     }

     public function saveScreenshot(Screenshot $screenshot)
     {
         $data = array(
             'jeu' => $screenshot->jeu,
             'url_image' => $screenshot->url_image,
             'owner'  => $this->user_id,
         );

         $id = (int) $screenshot->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getScreenshot($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Screenshot id does not exist');
             }
         }
     }

     public function deleteScreenshot($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
 
 ?>