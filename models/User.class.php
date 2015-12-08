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
		return $this->id;
	}
	public function getLogin()
	{
		return $this->login;
	}
	public function getPassword()
	{
		return $this->password;
	}
	public function getStatus()
	{
		return $this->status;
	}
	public function getEmail()
	{
		return $this->email;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getSurname()
	{
		return $this->surname;
	}
	public function getDateBirth()
	{
		return $this->date_birth;
	}
	public function getDateRegister()
	{
		return $this->date_register;
	}

	public function setId()
	{
		$this->id = $id;
		return true;
	}
	public function setLogin($login)
	{
		if (strlen($login) > 1 && strlen($login) < 16)
		{
			$this -> login = $login;
			return true;
		}
		else
		{
			throw new Exception("Invalid login");
		}
	}
	public function setPassword($password1, $password2)
	{
		if (strlen($password1) > 5)
		{
			if ($password1 == $password2)
			{
				$this->password = password_hash($password1, PASSWORD_BCRYPT, array("cost"=>10));
				return true;
			}
			else
			{
				return "Les mots de passe ne correspondent pas";
			}
		}
		else
		{
			return "Mot de passe trop court";
		}
	}
	public function verifPassword($password)
	{
		return (password_verify($password, $this->password));
	}
	public function setStatus()
	{
		$this->status = $status;
		return true;
	}
	public function setEmail($email)
	{
		$regex = "@";
		if (strlen($email) > 1 && strlen($email) < 32 && ereg($regex,$email))
		{
			$this -> email = $email;
			return true;
		}
		else
		{
			throw new Exception("Invalid email");
		}
	}
	public function setName($name)
	{
		if (strlen($name) > 1 && strlen($name) < 32)
		{
			$this -> name = $name;
			return true;
		}
		else
		{
			throw new Exception("Invalid name");
		}
	}
	public function setSurname($surname)
	{
		if (strlen($surname) > 1 && strlen($surname) < 32)
		{
			$this -> surname = $surname;
			return true;
		}
		else
		{
			throw new Exception("Invalid surname");
		}
	}
	public function setDateBirth()
	{
		$this->date_birth = $date_birth;
		return true;
	}
	public function setDateRegister()
	{
		$this->date_register = $date_register;
		return true;
	}
}
 ?>