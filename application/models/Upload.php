<?php
class Application_Model_Things
{
	protected $_id;
	protected $_uuid;
	protected $_name;
	protected $_type;
	protected $_size;
	protected $_things_id;

	public function __construct(array $options = null)
	{
		if (is_array($options)) {
			$this->setOptions($options);
		}
	}

	public function __set($name, $value)
	{
		$method = 'set' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid guestbook property');
		}
		$this->$method($value);
	}

	public function __get($name)
	{
		$method = 'get' . $name;
		if (('mapper' == $name) || !method_exists($this, $method)) {
			throw new Exception('Invalid guestbook property');
		}
		return $this->$method();
	}

	public function setOptions(array $options)
	{
		$methods = get_class_methods($this);
		foreach ($options as $key => $value) {
			$method = 'set' . ucfirst($key);
			if (in_array($method, $methods)) {
				$this->$method($value);
			}
		}
		return $this;
	}

	public function setId($id)
	{
		$this->_id = (string) $id;
		return $this;
	}

	public function getId()
	{
		return $this->_id;
	}

	public function setUuid($uuid)
	{
		$this->_uuid = (string) $uuid;
		return $this;
	}

	public function getUuid()
	{
		return $this->_uuid;
	}

	public function setName($name)
	{
		$this->_name = (string) $name;
		return $this;
	}

	public function getName()
	{
		return $this->_name;
	}

	public function setType($type)
	{
		$this->_type = (string) $type;
		return $this;
	}

	public function getType()
	{
		return $this->_type;
	}

	public function setSize($size)
	{
		$this->_size = (string) $size;
		return $this;
	}

	public function getSize()
	{
		return $this->_size;
	}

	public function setThingid($thingId)
	{
		$this->_things_id = (string) $thingId;
		return $this;
	}

	public function getThingid()
	{
		return $this->_things_id;
	}
}