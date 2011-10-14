<?php
class Application_Model_Base
{
	public function convertObjectToArray($object/*Object*/)
	{
		if(is_object($object))
		{
			$array = array();
			foreach($object as $key => $value)
			{
				$array[$key] = $this->convertObjectToArray($value);
			}
		    return $array;
		}
		else
			throw new Zend_Exception('It\'s not an object');
	}
}