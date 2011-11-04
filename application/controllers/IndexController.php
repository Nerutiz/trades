<?php

class IndexController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function indexAction()
	{
            $id = '';
            $thingsMapper = new Application_Model_ThingsMapper();
            $this->view->allthings = $thingsMapper->findotherthings(Zend_Auth::getInstance()->getStorage()->read()->id, $id);
	}


}

