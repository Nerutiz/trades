<?php
class Application_Model_ThingsMapper
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
    
 	public function getImageDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Upload');
        }
        return $this->_dbTable;
    }
    
 	public function saveall(Application_Model_Things $thing, $userid)
    {
    	$data = array(
    		'title'			=>	$thing->getTitle(),
    		'description'	=>	$thing->getDescription(),
    		'wishes'		=>	$thing->getWishes(),
    		'keywords'		=>	$thing->getKeywords(),
    		'users_id'		=>	$userid,
    	);
		$this->getDbTable()->insert($data);
		$lastId = $this->getDbTable()->getAdapter()->lastInsertId();
		$imageArray = explode("-", $thing->getImages());
		foreach ($imageArray as $image)
		{
			$dbAdapter = Zend_Db_Table::getDefaultAdapter(); 
			if ($image != '')
    	 	$dbAdapter->query('UPDATE upload SET things_id="' . $lastId . '" WHERE uuid="' . $image . '"');
		}
    }
    
    public function save($dbField, $value, $userid, Application_Model_Things $thing)
    {
    	
    	$data = array(
    		$dbField	=>	$value,
    		'users_id'	=>	$userid,
    	);
    	echo 'id = ' . $thing->getId();
    	if (null === ($id = $thing->getId())) 
    	{
            $this->getDbTable()->insert($data);
        }
        else 
        {
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
        $datas = new Zend_Dojo_Data();
		$datas->setIdentifier('users_id')
	    	->addItems(array($data));
	    	$datas->setLabel('users_id');
	    	// $datas->fromJson($json);
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
    
	public function findimage($id)
    {
    	//$this->setDbTable('upload');
    	 $imageDbTable = $this->setDbTable('Application_Model_DbTable_Upload');
        //$dbAdapter = Zend_Db_Table::getDefaultAdapter(); 
        $result = $this->getImageDbTable()->fetchAll($this->getImageDbTable()->select()->where('things_id=?', $id));
//        $select = $dbAdapter->query('SELECT * FROM upload WHERE things_id=' . $id . '');
//        $result = $select->fetchAll();
     	return $result;
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