<?php
class Application_Form_ChangePasswordForm extends Zend_Dojo_Form
{
	public function init()
	{
		$this->setName('changePasswordForm');
		$this->setMethod('post');
	     $this->addElement('PasswordTextBox', 'oldpassword', array(
		 	'placeHolder'		=>	'Type your old Password', 
			'required'			=>	true,
		 	'type'				=>	'password'
		 	));
		 	
		 	$this->addElement('PasswordTextBox', 'newpassword', array(
		 	'placeHolder'		=>	'Type your new Password',  
			'required'			=>	true,
		 	'type'				=>	'password'
		 	));
		 	
		 	$this->addElement('PasswordTextBox', 'repeatpassword', array(
		 	'placeHolder'		=>	'Repeat Password',
			'required'			=>	true,
		 	'type'				=>	'password'
		 	));
		 	
			$this->addElement('button', 'change', array(
			'value'		=>	'Change',
			'class'		=>	'formButton'
		 	));
		 	
	}
}