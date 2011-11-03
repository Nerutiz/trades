<?php
class AccountController extends Zend_Controller_Action
{

	public function init()
	{
		//		if(!Zend_Auth::getInstance()->hasIdentity())
		//        {
		//            $this->_redirect('/account');
		//        }
		}

		public function registerAction()
		{
			//$this->_helper->layout()->setLayout('notlogged');
			$validator = new Zend_Validate_Db_RecordExists(
			array(
        	'table' => 'users',
        	'field' => 'email'
        	));
        	 
        	$form = new Application_Form_RegisterForm();
        	$form->register->setAttrib('onClick', 'validateAndSubmitForm(\'' . $form->getName() . '\');');
        	$this->view->form = $form;


        	if ($this->getRequest()->isPost())
        	{
        		if ($form->isValid($this->getRequest()->getPost()))
        		{
        			if (!$validator->isValid($form->email->getValue()))
        			{
        				$user = new Application_Model_Register($form->getValues());
        				$mapper  = new Application_Model_RegisterMapper();
        				$mapper->save($user);
        			}
        			else
        			$this->view->existedRecordErrorMessage = 'This Email already registered';
        		}
        		else
        		return 'nevalidi';
        	}
		}

		public function indexAction()
		{
			//$this->_helper->layout()->setLayout('notlogged');
			if(Zend_Auth::getInstance()->hasIdentity())
				$this->_redirect('/account/profile');
				 
				$loginform = new Application_Form_LoginForm();
				$request = $this->getRequest();

				if($request->isPost())
				{
					if($loginform->isValid($request->getPost()))
					{
						$username = $loginform->getValue('email');
						$password = $loginform->getValue('password');
						$dbAdapter = Zend_Db_Table::getDefaultAdapter();

						$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);

						$authAdapter->setTableName('users')
						->setIdentityColumn('email')
						->setCredentialColumn('password')
						->setCredentialTreatment('MD5(?)');

			   $authAdapter->setIdentity($username)
			   ->setCredential($password);
			   //echo $username . ' ' .  $password;
			   $auth = Zend_Auth::getInstance();
			   $result = $auth->authenticate($authAdapter);

			   if($result->isValid())
			   {
			   	$userInfo = $authAdapter->getResultRowObject(null, 'password');
			   	$authStorage = $auth->getStorage();
			   	$authStorage->write($userInfo);
			   	$this->_redirect('/things');
			   }
			   else
			   {
			   	$errorMessage = "Wrong username or password provided. Please try again.";
			   }
					}
				}

				//	$this->view->errorMessage = $errorMessage;
				$this->view->loginform = $loginform;
		}

		public function profileAction()
		{
			$profileForm = new Application_Form_ProfileForm();
			$userInfo = Zend_Auth::getInstance()->getStorage()->read();
			$user = new Application_Model_Register($profileForm->getValues());
			$mapper  = new Application_Model_RegisterMapper($user);
			$result = $mapper->find(array($userInfo->id), $user);
			$profileForm->populate($result);
			$profileForm->save->setAttrib('onClick', 'validateForSubmit(\'' . $profileForm->getName() . '\');');
			$this->view->profileForm = $profileForm;

			if ($this->getRequest()->isPost())
			{
				if ($profileForm->isValid($this->getRequest()->getPost()))
				{
					$user = new Application_Model_Register($profileForm->getValues());
					$mapper  = new Application_Model_RegisterMapper($user);
					$mapper->update($user, $userInfo->id);
				}
			}
		}

		public function changepasswordAction()
		{
			Zend_Layout::getMvcInstance()->disableLayout();
            Zend_Dojo_View_Helper_Dojo::setUseDeclarative();
            $form = new Application_Form_ChangePasswordForm();
            $form->change->setAttrib('onclick', 'changePassword();');
			$this->view->changePasswordForm = $form;
		}
		
		public function logoutAction()
		{
			// clear everything - session is cleared also!
			Zend_Auth::getInstance()->clearIdentity();
			$this->_redirect('/account/register');
		}

}
