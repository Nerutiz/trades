<?php
class TradesController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
		$myThingsMapper = new Application_Model_ThingsMapper();
		$otherThingsMapper = new Application_Model_ThingsMapper();
		$accountMapper = new Application_Model_RegisterMapper();
		$this->view->mydojodata = $myThingsMapper->fetchAll(Zend_Auth::getInstance()->getStorage()->read()->id);
		
		if($this->getRequest()->isPost())
        {
			if ($this->_hasParam('userid'))
	    		$id = $this->_getParam('userid');
	    	else 
	    		$id = '';
        }
		$this->view->othersthings = $otherThingsMapper->findotherthings(Zend_Auth::getInstance()->getStorage()->read()->id, $id);
		$this->view->users = $accountMapper->selectAllUsers(Zend_Auth::getInstance()->getStorage()->read()->id);
	}


}