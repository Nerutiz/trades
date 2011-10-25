<?php
class Application_Model_RegisterMapper
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
			$this->setDbTable('Application_Model_DbTable_Register');
		}
		return $this->_dbTable;
	}

	public function save(Application_Model_Register $user)
	{
		$data = array(
    		'email'			=>	$user->getEmail(),
    		'password'	=>	md5($user->getPassword()),
		);
		if (null === ($id = $user->getId()))
		{
			unset($data['id']);
			$this->getDbTable()->insert($data);
		}
		else
		{
			$this->getDbTable()->update($data, array('id = ?' => $id));
		}
	}

	public function update(Application_Model_Register $user, $userId)
	{
		$data = array(
    		'email'			=>	$user->getEmail(),
    		'username'		=>	$user->getUsername(),
    		'fullname'		=>	$user->getFullname(),
    		'address'		=>	$user->getAddress(),
			'city'			=>  $user->getCity(),
			'country'		=>	$user->getCountry()
		);
		 
		$this->getDbTable()->update($data, array('id = ?' => $userId));
	}

	public function find($id, Application_Model_Register $user)
	{
		$result = $this->getDbTable()->find($id);
		if (0 == count($result)) {
			return;
		}
		$row = $result->current();
		$user->setEmail($row->email)
		->setUsername($row->username)
		->setFullname($row->fullname)
		->setAddress($row->address);
		return $row->toArray();
	}
	
	public function selectAllUsers($id)
	{
		$users = $this->getDbTable()->fetchAll($this->getDbTable()->select()->where('id!=?', $id));
		return $users;
	}

}