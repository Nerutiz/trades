<?php
class ThingsController extends Zend_Controller_Action
{
    public function init()
    {
		if(!Zend_Auth::getInstance()->hasIdentity())  
        {  
            $this->_redirect('/account');  
        }  
    }
    
    public function mythingsAction()
    {
    	$mapper = new Application_Model_ThingsMapper();
        $this->view->things = $mapper->fetchAll(Zend_Auth::getInstance()->getStorage()->read()->id);
    }
    
    public function indexAction()
    {
    	$thingsForm = new Application_Form_ThingsForm();
     	$this->view->thingsForm = $thingsForm;
	    if ($this->getRequest()->isPost()) 
	    {
			if ($thingsForm->isValid($this->getRequest()->getPost())) 
			{
					$userInfo = Zend_Auth::getInstance()->getStorage()->read();
					$things = new Application_Model_Things($thingsForm->getValues());
	                $mapper  = new Application_Model_ThingsMapper();
	                $mapper->saveall($things, $userInfo->id);
			}
			else 
				return 'nevalidi';
		}
    }
    
    public function editthingAction()
    {
    	$form = new Application_Form_ThingsForm();
		$thing = new Application_Model_Things();
		$mapper = new Application_Model_ThingsMapper();
		if($this->_getParam('id'))
		{
//			echo $this->_getParam('id');
//			return;
			$this->view->form = $form;
			$mapper = new Application_Model_ThingsMapper();
			$result = $mapper->find($this->_getParam('id'), $thing);
			$form->populate($result);
		}
		else 
			$this->view->form = $form;
    }
    
    public function saverecordAction()
    {
    	$userInfo = Zend_Auth::getInstance()->getStorage()->read();
    	$thingsForm = new Application_Form_ThingsForm();
    	$thing = new Application_Model_Things($thingsForm->getValues());
    	$mapper = new Application_Model_ThingsMapper();
    	//var_dump($thingsForm);
    	print_r($thingsForm->getValues());
    	//$mapper->saveall($thing, $userInfo->id);
    }
   
    public function uploadAction()
    {
    	$upload = new Zend_File_Transfer_Adapter_Http();
		$files = $upload->getFileInfo();
		//$upload->setDestination("uploads/files");
		$i=0;
		foreach ($files as $file)
		{
			$exts = split("[/\\.]", $file['name']) ; 
 			$n = count($exts)-1; 
 			$exts = $exts[$n]; 
			$files['uploadedfiles_' . $i . '_']['savedName'] = uniqid();
			
			move_uploaded_file($files['uploadedfiles_' . $i . '_']['savedName'], "uploads/files" . $files['uploadedfiles_' . $i . '_']['savedName']);
			//print_r($files['uploadedfiles_' . $i . '_']['savedName'] = uniqid() . '.' . $exts);
			$upload->addFilter(new Zend_Filter_File_Rename(array('target' => 'uploads/files/' . $files['uploadedfiles_' . $i . '_']['savedName'] . '.' . 'jpg')));
			$i++;
			$upload->receive($file);
		} 	
			 
	 	if (!$upload->receive())
	 	{
			$messages = $upload->getMessages();
			echo implode("\n", $messages);
		}
    }
}