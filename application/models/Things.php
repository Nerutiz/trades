<?php
class Application_Model_Things
{
	protected $_id;
	protected $_title;
	protected $_description;
	protected $_imageid;
	protected $_wishes;
	protected $_keywords;
	protected $_userID;
	protected $_images;

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

	public function setImages($images)
	{
		$this->_images = (string) $images;
		return $this;
	}

	public function getImages()
	{
		return $this->_images;
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

	public function setTitle($title)
	{
		$this->_title = (string) $title;
		return $this;
	}

	public function getTitle()
	{
		return $this->_title;
	}

	public function setDescription($description)
	{
		$this->_description = (string) $description;
		return $this;
	}

	public function getDescription()
	{
		return $this->_description;
	}

	public function setWishes($wishes)
	{
		$this->_wishes = (string) $wishes;
		return $this;
	}

	public function getWishes()
	{
		return $this->_wishes;
	}

	public function setKeywords($keywords)
	{
		$this->_keywords = (string) $keywords;
		return $this;
	}

	public function getKeywords()
	{
		return $this->_keywords;
	}

	public function setImageid($imageid)
	{
		$this->_imageid = (string) $imageid;
		return $this;
	}

	public function getImageid()
	{
		return $this->_imageid;
	}

	public function setUserid($userID)
	{
		$this->_userID = (string) $userID;
		return $this;
	}

	public function getUserid()
	{
		return $this->_userID;
	}

}