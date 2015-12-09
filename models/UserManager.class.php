<?php
class UserManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function create($login, $password1, $password2, $email, $name, $surname, $date_birth)
	{
		$errors = array();
		$user = new User($this -> db);
		try
		{
			$user -> setLogin($login);
			$user -> setPassword($password1, $password2);
			$user -> setEmail($email);
			$user -> setName($name);
			$user -> setSurname($surname);
			$user -> setDateBirth($date_birth);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}
		// $user = new User();
		// $errors[] = $user->setLogin($login);
		// $errors[] = $user->setPassword($password1, $password2);
		// $errors[] = $user->setEmail($email);
		// $errors[] = $user->setAvatar($avatar);
		$errors = array_filter($errors, function($val)
		{
			return $val !== true;
		});
		if (count($errors) == 0)
		{
			// $login = mysqli_real_escape_string($this->db, $user->getLogin());
			$login = $this->db->quote($user->getLogin());
			// $email = mysqli_real_escape_string($this->db, $user->getEmail());
			$email = $this->db->quote($user->getEmail());
			// $password = $user->getHash();
			$password = $user->getHash();
			// $name = mysqli_real_escape_string($this->db, $user->getName());
			$name = $this->db->quote($user->getName());
			$surname = $this->db->quote($user->getSurname());
			$date_birth = $this->db->quote($user->getDateBirth());
			$query = "INSERT INTO user (login, password, email, name, surname, date_birth) VALUES(".$login.", '".$password."', ".$email.", ".$name.", ".$surname.", ".$date_birth.")";
			// $res = mysqli_query($this->db, $query);
			$res = $this->db->exec($query);
			if ($res)
			{
				$id = $this->db->lastInsertId();
				if ($id)
				{
					return $this->findById($id);
				}
				else
				{
					return "Internal server error";
				}
			}
		
		}
		else
		{
			return $errors;
		}
	}
	public function delete(User $user)
	{
		$id = $user->getId();
		$query = "DELETE FROM user WHERE id='".$id."'";
		// $res = mysqli_query($this->db, $query);
		$res = $db->exec($query);
		if ($res)
		{
			return true;
		}
		else
		{
			return "Internal Server Error";
		}
	}
	public function update(User $user)
	{
		$id = $user->getId();
		// $login = mysqli_real_escape_string($this->db, $user->getLogin());
		$login = $this->db->quote($user->getLogin());
		// $password = mysqli_real_escape_string($this->db, $user->getHash());
		$password = $this->db->quote($user->getHash());
		// $email = mysqli_real_escape_string($this->db, $user->getEmail());
		$email = $this->db->quote($user->getEmail());
		// $name = mysqli_real_escape_string($this->db, $user->getName());
		$name = $this->db->quote($user->getName());
		// $surname = mysqli_real_escape_string($this->db, $user->getSurname());
		$surname = $this->db->quote($user->getSurname());
		$date_birth = $user->getDateBirth();
		$query = "UPDATE user SET login=".$login.", password=".$password.", email=".$email.", name=".$name.", surname=".$surname.", date_birth=".$date_birth." WHERE id=".$id."";
		// $res = mysqli_query($this->db, $query);
		$res = $db->exec($query);
		if ($res)
		{
			return $this->findById($id);
		}
		else
		{
			return "Internal Server Error";
		}
	}
	public function find($id)
	{
		return $this->findById($id);
	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM user WHERE id='".$id."'";
		// $res = mysqli_query($this->db, $query);
		$res = $this->db->query($query);
		if ($res)
		{
			// $user = mysqli_fetch_object($res, "User");
			$user = $res->fetchObject("User"/*, array($this->db)*/);
			if ($user)
			{
				return $user;
			}
			else
			{
				return "User not found";
			}
		}
		else
		{
			return "Internal Server Error";
		}
	}
	public function findByLogin($login)
	{
		if (strlen(trim($login)) > 0)
		{
			// $login = mysqli_real_escape_string($this->db, $login);
			$login = $this->db->quote($login);
			$query = "SELECT * FROM user WHERE login=".$login;
			// $res = mysqli_query($this->db, $query);
			$res = $this->db->query($query);
			if ($res)
			{
				// $user = mysqli_fetch_object($res, "User");
				$user = $res->fetchObject("User"/*, array($this->db)*/);
				if ($user) {
					return $user;
				}					
				else
					return "User not found";
			}
			else
			{
				return "Internal Server Error";
			}
		}
		else
		{
			return "User not found";
		}
	}
	public function getCurrent()
	{
		if (isset($_SESSION['id']))
		{
			$query = "SELECT * FROM user WHERE id='".$_SESSION['id']."'";
			// $res = mysqli_query($this->db, $query);
			$res = $this->db->query($query);
			if ($res)
			{
				// $user = mysqli_fetch_object($res, "User");
				$user = $res->fetchObject("User"/*, array($this->db)*/);
				if ($user)
				{
					return $user;
				}
				else
				{
					return false;
				}
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
}
?>