<?php

class Application_Form_ThingsForm extends Zend_Dojo_Form
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
		$this->setName('thingsForm');
		$this->setMethod('post');
		$this->addElement(new Zend_Dojo_Form_Element_TextBox('title', array(
            'decorators'	=>	$this->elementDecorators,
		//	'label'			=>	'Email',
            'label'	=>	'Type your thing name',
			'required'		=>	false,
		)));
			
		$this->addElement('Textarea', 'description', array(
            'decorators'	=>	$this->elementDecorators,
		  	'label'			=>	'Type your thing description',
			'required'		=>	false,
		));
			
		$this->addElement('Textarea', 'wishes', array(
            'decorators'	=>	$this->elementDecorators,
		//'label'			=>	'Full name',
		 	'label'			=>	'Type your Wishes',
		  	'required'		=>	false,
		));
			
		$this->addElement('Textarea', 'keywords', array(
            'decorators'	=>	$this->elementDecorators,
		 	'label'	=>	'Type Keywords',
		  	'required'		=>	false,
		));
			
		$this->addElement(new Zend_Form_Element_Hidden('images'));
			
		$this->addElement(new Zend_Dojo_Form_Element_SubmitButton('save', array(
         'value'		=>	'Save',
	     'decorators'	=>	$this->buttonDecorators,
		)));

		$this->setDecorators(array('FormElements',array('HtmlTag', array('tag' => 'table')),'Form',));
		 
			
	}
}