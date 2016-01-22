<?php 

 namespace Jeux\Model;

 use Zend\Db\TableGateway\TableGateway;

 class JeuxTable
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
	 public function isMine($user_id, $jeux_id) {
         $resultSet = $this->tableGateway->select("owner = ".$user_id);
		var_dump($resultSet);
	 }*/

     public function getJeux($id)
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

     public function saveJeux(Jeux $jeux)
     {
         $data = array(
             'titre' => $jeux->titre,
             'type'  => $jeux->type,
             'plateforme' => $jeux->plateforme,
             'owner'  => $this->user_id,
         );

         $id = (int) $jeux->id;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getJeux($id)) {
                 $this->tableGateway->update($data, array('id' => $id));
             } else {
                 throw new \Exception('Jeux id does not exist');
             }
         }
     }

     public function deleteJeux($id)
     {
         $this->tableGateway->delete(array('id' => (int) $id));
     }
 }
 
 ?>