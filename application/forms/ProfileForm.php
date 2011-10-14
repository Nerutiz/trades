<?php

class Application_Form_ProfileForm extends Zend_Dojo_Form
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
		$this->setName('profileForm');
		$this->setMethod('post');
		$this->addElement('ValidationTextBox', 'email', array(
		 	'validators'	=> array(
                'EmailAddress'
                ),
           	'regExp'		=>	"\b[a-zA-Z0-9._%-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}\b",
            'decorators'	=>	$this->elementDecorators,
                //	'label'			=>	'Email',
            'placeHolder'	=>	'Type your email',
			'required'		=>	true,
                ));
                	
                $this->addElement('ValidationTextBox', 'username', array(
            'decorators'	=>	$this->elementDecorators,
                // 	'label'			=>	'Username',
		  	'placeHolder'	=>	'Type your username',
			'required'		=>	false,
                ));
                	
                $this->addElement('ValidationTextBox', 'fullname', array(
            'decorators'	=>	$this->elementDecorators,
                //'label'			=>	'Full name',
		  	'placeHolder'	=>	'Type your Full name',
		  	'required'		=>	false,
                ));
                	
                $this->addElement('ValidationTextBox', 'address', array(
            'decorators'	=>	$this->elementDecorators,
                //	'label'			=>	'Address',
		  	'placeHolder'	=>	'Type your Address',
		  	'required'		=>	false,
                ));
                	
                $this->addElement('button', 'save', array(
         'value'		=>	'Register',
	     'decorators'	=>	$this->buttonDecorators,
                ));

                $this->setDecorators(array('FormElements',array('HtmlTag', array('tag' => 'table')),'Form',));
                 
                	
	}
}