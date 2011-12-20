<?php
class Application_Model_Base
{
    
	public function convertObjectToArray($object/*Object*/)
	{
		if(is_object($object))
		{
			$array = array();
			foreach($object as $key => $value)
			{
				$array[$key] = $this->convertObjectToArray($value);
			}
		    return $array;
		}
		else
			throw new Zend_Exception('It\'s not an object');
	}
        
        public function authUser($email, $password)
        {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();

            $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

            $authAdapter->setTableName('users')
                    ->setIdentityColumn('email')
                    ->setCredentialColumn('password')
                    ->setCredentialTreatment('MD5(?)');

               $authAdapter->setIdentity($email)
               ->setCredential($password);
               $auth = Zend_Auth::getInstance();
               $result = $auth->authenticate($authAdapter);

               if($result->isValid())
               {
                    $userInfo = $authAdapter->getResultRowObject(null, 'password');
                    $authStorage = $auth->getStorage();
                    $authStorage->write($userInfo);
                    return true;
               }
               else
               {
                   return false;
               }
        }
        
        public function getCategories()
        {
            $dbAdapter = Zend_Db_Table::getDefaultAdapter();
            
            return $dbAdapter->query("SELECT * FROM thingscategories WHERE 1")->fetchAll();
        }
}