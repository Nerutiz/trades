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
		
		$id = '';
		
		if($this->getRequest()->isPost())
                {
			if ($this->_hasParam('userid'))
	    		$id = $this->_getParam('userid');
                }
		$this->view->othersthings = $otherThingsMapper->findotherthings(Zend_Auth::getInstance()->getStorage()->read()->id, $id);
		$this->view->users = $accountMapper->selectAllUsers(Zend_Auth::getInstance()->getStorage()->read()->id);
	}

        
        public function thingAction()
        {
            $mapper = new Application_Model_ThingsMapper();
            
            if($this->getRequest()->getParam('itemid'))
            {
                if (Zend_Auth::getInstance()->hasIdentity())
                {
                    $this->view->thing = $mapper->selectThing($this->getRequest()->getParam('itemid'), new Application_Model_Things);
                    $this->view->images = $mapper->findimage($this->getRequest()->getParam('itemid'));
                    $this->view->mythings = $mapper->fetchAll(Zend_Auth::getInstance()->getStorage()->read()->id);
                }else
                {
                    $this->view->thing = $mapper->selectThing($this->getRequest()->getParam('itemid'), new Application_Model_Things);
                    $this->view->images = $mapper->findimage($this->getRequest()->getParam('itemid'));
             
                }
            }
            
        }
        
        public function mytradesAction()
        {
            $mapper = new Application_Model_TradesMapper();
            
            $userID = Zend_Auth::getInstance()->getStorage()->read()->id;
            $myTrades = $mapper->get_my_trades($userID);
            
            $this->view->myTrades = $myTrades;
        }
        

}