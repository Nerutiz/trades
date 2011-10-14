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
		$things = $mapper->fetchAll(Zend_Auth::getInstance()->getStorage()->read()->id);
		$this->view->things = $things;
		$this->view->mapper = $mapper;
		//foreach ($things as $thing):
			//$image=$mapper->selectmainimage($thing->getId());
				//$this->view->mainimage = $mainImage;
		//endforeach;
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
			$this->view->form = $form;
			$mapper = new Application_Model_ThingsMapper();
			$result = $mapper->find($this->_getParam('id'), $thing);
			$form->populate($result); 
			$this->view->images = $mapper->findimage($this->_getParam('id'));
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
		$this->_helper->layout->disableLayout();
		if($this->getRequest()->isPost())
		{
			$cnt = 0;
			$mapper = new Application_Model_UploadMapper();
			$upload = new Zend_File_Transfer_Adapter_Http();
			$upload->addValidator('Size', false, 20000, 'file2');
			$upload->setDestination('uploads/');
			$files = $upload->getFileInfo();
			foreach ($files as $file => $info)
			{
				$ext = end(explode(".", $info['name']));
				$uuid = uniqid();
				$upload->addFilter('Rename', array('target' => 'uploads/' . $uuid . '.' . $ext ,'overwrite' => true));
				if($upload->isValid($file))
				{
					$upload->receive($file);
				}
				$imageSize = getimagesize('uploads/' . $uuid . '.' . $ext);
				$name = $info['name'];
				$type = $info['type'];
				$size = $info['size'];
				$file = 'uploads/' . $name;
				$_post['file'] = $file;
				$_post['name'] = $name;
				$_post['type'] = $type;
				$_post['size'] = $size;
				$_post['uuid'] = $uuid;
				$_post['width'] = $imageSize[0];
				$_post['height'] = $imageSize[1];
				$_post['ext'] = $ext;
				$htmldata[$cnt] = $_post;
				$mapper->saveall($htmldata[$cnt]);
				$cnt++;
			}
			$data = json_encode($htmldata);
			echo $data;
		}

	}
	
	public function setmainimageAction()
	{
		if($this->_getParam('imageid') && $this->_getParam('thingid'))
		{
			$update = new Application_Model_ThingsMapper();
			$update->setmainimage($this->_getParam('imageid'), $this->_getParam('thingid'));
		}
	}
	
	public function deletefileAction()
	{
		$this->_helper->layout->disableLayout();
		$mapper = new Application_Model_UploadMapper();
		$file = $this->_getParam('file');
		if($file)
		{
			if ($_SERVER['DOCUMENT_ROOT'].file_exists($file))
			{
				unlink($_SERVER['DOCUMENT_ROOT'].$file);
				$mapper->deletefile($this->_getParam('uuid'));
			}
		}
	}
}