<?php 
class Sub_CategoryManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function create(Category $category, $name, $description, $img)
	{
		$sub_category = new SubCategory($this->db);
		$valide	= $sub_category->setName($name);
		$errors = array();
		$errors[] = $sub_category->setCategory($category);
		$errors[] = $sub_category->setName($name);
		$errors[] = $sub_category->setDescription($description);
		$errors[] = $sub_category->setImg($img);

		$errors = array_filter($errors, function($val)
			{
				return $val !== true;
			});

		if (count($errors) == 0)
		{
			$idCategory = intval($sub_category->getIdCategory());
			$name = mysqli_escape_string($this->db, $sub_category->getName());
			$description = mysqli_escape_string($this->db, $sub_category>getDescription());
			$img = mysqli_escape_string($this->db, $sub_category->getImg());
			$query	= "INSERT INTO sub_category (id_category, name, description, img) VALUES ('".$idCategory."', '".$name."', '".$description."', '".$img."')";
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
					throw new Exception ("Internal server error");
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
			$query = 'SELECT * FROM sub_category ORDER BY `name` ASC LIMIT '.$n;
		}
		else
		{
			$query = 'SELECT * FROM sub_category ORDER BY `name` ASC';
		}		
		$res = $this->db->query($query);
		if ($res)
		{
			$sub_category = array();
			while ($sub_category = $res->fetchObject('SubCategory', array($this->db)))
			{
				$sub_category[] = $sub_category;
			}
			return $sub_category;
		}
		else
		{
			return 'Database error';
		}
	}
}
 ?>