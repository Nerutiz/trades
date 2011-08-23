<?php
class Application_Model_UploadMapper
{
	protected $_dbTable;

	public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Things');
        }
        return $this->_dbTable;
    }
    
 	public function saveall(Application_Model_Upload $upload)
    {
    	$data = array(
    		'uuid'			=>	$upload->getUuid(),
    		'type'			=>	$upload->getTitle(),
    		'name'			=>	$upload->getName(),
    		'size'			=>	$upload->getSize(),
    		'things_id'		=>	$upload->getThingid(),
    	);
      $this->getDbTable()->insert($data);
    }

	public function find($id, Application_Model_Things $thing)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
        	return;
        }
      	$row = $result->current();
        $thing->setId($row->id)
                  ->setTitle($row->title)
                  ->setDescription($row->description)
                  ->setWishes($row->wishes)
                  ->setKeywords($row->keywords);
        return $row->toArray();
    }
    
	public function fetchAll($userId)
    {
        $resultSet = $this->getDbTable()->fetchAll($this->getDbTable()->select()->where('users_id=?', $userId));
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Things();
            $entry->setId($row->id)
                  ->setTitle($row->title)
                  ->setDescription($row->description)
                  ->setWishes($row->wishes)
                  ->setKeywords($row->keywords);
            $entries[] = $entry;
        }
        return $entries;
    }
    
	
}