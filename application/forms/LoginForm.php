<?php
class Application_Form_LoginForm extends Zend_Dojo_Form
{

	public $buttonDecorators = array(
        'DijitElement',
	array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
	array(array('label' => 'HtmlTag'), array('tag' => 'td', 'placement' => 'prepend')),
	array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
	);

	public $elementDecorators = array(
        'DijitElement',
        'Errors',
	array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class' => 'element')),
	array('Label', array('tag' => 'td')),
	array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
	);

	public function init()
	{
		$this->setName('loginForm');
		$this->setMethod('post');
		$this->addElement('ValidationTextBox', 'email', array(
		 	'validators'	=> array(
                'EmailAddress'
                ),
           	'regExp'		=>	"\b[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b",
            'decorators'	=>	$this->elementDecorators,
		 	'placeHolder'	=>	'Type your Email',
			'required'		=>	true,
                	
                ));
                	
                $this->addElement('PasswordTextBox', 'password', array(
		 	'placeHolder'		=>	'Type your Password',
		  	'decorators'		=>	$this->elementDecorators,
                 
			'required'			=>	true,
		 	'type'				=>	'password'
		 	));
		 		
		 	$this->addElement('button', 'login', array(
         'value'		=>	'Register',
	     'decorators'	=>	$this->buttonDecorators,
		 	));

		 	$this->setDecorators(array('FormElements',array('HtmlTag', array('tag' => 'table')),'Form',));
	}
}