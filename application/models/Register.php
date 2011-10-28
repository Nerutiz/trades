<?php
class Application_Model_Register
{
	protected $_id;
	protected $_username;
	protected $_email;
	protected $_fullname;
	protected $_password;
	protected $_image;
	protected $_address;
	protected $_country;
	protected $_city;
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
	
	public function setImage($image)
	{
		$this->_image = (string) $image;
		return $this;
	}

	public function getImage()
	{
		return $this->_image;
	}
	
	public function setAddress($address)
	{
		$this->_address = (string) $address;
		return $this;
	}

	public function getAddress()
	{
		return $this->_address;
	}

	public function setEmail($email)
	{
		$this->_email = (string) $email;
		return $this;
	}

	public function getEmail()
	{
		return $this->_email;
	}

	public function setUsername($username)
	{
		$this->_username = (string) $username;
		return $this;
	}

	public function getUsername()
	{
		return $this->_username;
	}

	public function setFullname($fullname)
	{
		$this->_fullname = (string) $fullname;
		return $this;
	}

	public function getFullname()
	{
		return $this->_fullname;
	}

	public function setPassword($password)
	{
		$this->_password = (string) $password;
		return $this;
	}

	public function getPassword()
	{
		return $this->_password;
	}
//
//	public function setImage($image)
//	{
//		$this->_image = (string) $image;
//		return $this;
//	}
//
//	public function getImage()
//	{
//		return $this->_image;
//	}

	public function setId($id)
	{
		$this->_id = (int) $id;
		return $this;
	}
	
	public function getId()
	{
		return $this->_id;
	}
	
	public function setCountry($country)
	{
		$this->_country = (string) $country;
		return $this;
	}
	
	public function getCountry()
	{
		return $this->_country;
	}
	
	public function setCity($city)
	{
		$this->_city = (string) $city;
		return $this;
	}
	
	public function getCity()
	{
		return $this->_city;
	}

}