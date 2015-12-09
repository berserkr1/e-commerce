<?php 
class CategoryManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function create($name, $description, $img)
		{
			$category = new Category($this->db);
			$valide	= $category->setName($name);
			$errors = array();
			$errors[] = $category->setName($name);
			$errors[] = $category->setDescription($description);
			$errors[] = $category->setImg($img);			
			$errors = array_filter($errors, function($val)
			{
				return $val !== true;
			});

			if (count($errors) == 0)
			{
				$name = mysqli_escape_string($this->db, $category->getName());
				$description = mysqli_escape_string($this->db, $category->getDescription());
				$img = mysqli_escape_string($this->db, $category->getImg());
				$query = "INSERT INTO category (name, description, img) VALUES('".$name."','".$description."','".$img."')";
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
						throw new Exception ("Erreur interne du serveur");
					}
				}				
			}
			else
			{
				return $errors;
			}		
		}

	public function read($n = 0)
		{
			$n = intval($n);		
			if ($n > 0)
			{
				$query = 'SELECT * FROM category ORDER BY `name` ASC LIMIT '.$n;
			}
			else
			{
				$query = 'SELECT * FROM section ORDER BY `name` ASC';
			}
			$res = $this->db->query($query);
			if ($res)
			{
				$category = array();
				while ($category = $res->fetchObject("Category", array($this->db)))
				{
					$category[] = $category;
				}
				return $category;
			}
			else
			{
				return 'Database error';
			}
		}

	public function findByIdCategory($id)
		{
			$id	= intval($id);
			$query = "SELECT * FROM category WHERE id=".$id;
			$res = $this->db->query($query);			
			if ($res)
			{
				if ($category = $res->fetchObject("Category", array($this->db)))
				{
					return $category;
				}
				else
				{
					return "No match";
				}
			}
			else
			{
				return "Internal Server Error";
			}
		}
}
 ?>