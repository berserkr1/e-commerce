<?php 
class User
{
	private $id;
	private $login;
	private $password;
	private $status;
	private $email;
	private $name;
	private $surname;
	private $date_birth;
	private $date_register;

	public function __construct($db);
	{
		$this->db = $db;
	}

	public function getId()
	{
		return $this -> id;
	}
	public function getLogin()
	{
		return $this -> login;
	}
	public function getPassword()
	{
		return $this -> password;
	}
	public function getStatus()
	{
		return $this -> status;
	}
	public function getEmail()
	{
		return $this -> email;
	}
	public function getName()
	{
		return $this -> name;
	}
	public function getSurname()
	{
		return $this -> surname;
	}
	public function getDateBirth()
	{
		return $this -> date_birth;
	}
	public function getDateRegister()
	{
		return $this -> date_register;
	}

	public function setId()
	{
		$this -> id = $id;
		return true;
	}
	public function setLogin()
	{
		$this -> login = $login;
		return true;
	}
	public function setPassword()
	{
		$this -> password = $password;
		return true;
	}
	public function setStatus()
	{
		$this -> status = $status;
		return true;
	}
	public function setEmail()
	{
		$this -> email = $email;
		return true;
	}
	public function setName()
	{
		$this -> name = $name;
		return true;
	}
	public function setSurname()
	{
		$this -> surname = $surname;
		return true;
	}
	public function setDateBirth()
	{
		$this -> date_birth = $date_birth;
		return true;
	}
	public function setDateRegister()
	{
		$this -> date_register = $date_register;
	}
}
 ?>