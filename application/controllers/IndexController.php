<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
            $thingsMapper = new Application_Model_ThingsMapper();
            
            $sql = "1";
            
            $categoryid = $this->getRequest()->getParam("category");
            if(!empty ($categoryid))
            {
                $sql .= " AND thingscategories_id = " . (int)$categoryid; 
            }
            
            
            if (Zend_Auth::getInstance()->hasIdentity()){
                $this->view->allthings = $thingsMapper->getthings(Zend_Auth::getInstance()->getStorage()->read()->id, $sql);
            }else{
                $this->view->allthings = $thingsMapper->getthings(null, $sql);
            }
	}
        
        
        public function rulesAction()
        {
            $this->render("/rules");
        }
        
        public function companyAction()
        {
            $this->render("/company");
        }
        


}

