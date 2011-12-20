<?php
class Application_Model_TradesMapper
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
			$this->setDbTable('Application_Model_DbTable_Trades');
		}
		return $this->_dbTable;
	}
        
        public function get_my_trades($userID)
        {
            $result = Zend_Db_Table::getDefaultAdapter()->query("SELECT * FROM `trades` JOIN things ON trades.to = things.id WHERE trades.users_id = ?", array($userID))->fetchAll();
            
            return $result;
        }
}