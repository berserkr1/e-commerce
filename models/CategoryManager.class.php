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
		$errors = array();
		try
		{
			$category->setName($name);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}
		try
		{
			$category->setDescription($description);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}
		try
		{
			$category->setImg($img);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}

		if (count($errors) == 0)
		{
			$name = $this->db->quote($category->getName());
			$description = $this->db->quote($category->getDescription());
			$img = $this->db->quote($category->getImg());
			$query = "INSERT INTO category (name, description, img) VALUES(".$name.",".$description.",".$img.")";
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
					$errors[] = "Category not found";
					return $errors;
				}
			}
			else
			{
				$errors[] = "Internal server error";
				return $errors;
			}				
		}
		else
		{
			return $errors;
		}
	}

	public function find($n = 0)
	{	
		$n = intval($n);
	 	if ($n > 0)
	 	{
	 		$query = 'SELECT * FROM category ORDER BY `name` ASC LIMIT '.$n;
	 	}
	 	else
	 	{
	 		$query = 'SELECT * FROM category ORDER BY `name` ASC';
	 	}
	 	$res = $this->db->query($query);
	 	if ($res)
	 	{
	 		$category_list = array();
	 		while ($category = $res->fetchObject("Category", array($this->db)))
	 		{
	 			$category_list[] = $category;
	 		}
	 		return $category_list;
	 	}
	 	else
	 	{
	 		throw new Exception ("Database error");
	 	}
	}

	public function findById($id)
	{
		$id	= intval($id);
		$query = "SELECT * FROM category WHERE id=".$id;
		$res = $this->db->query($query);			
		if ($res)
		{
			$category = $res->fetchObject("Category", array($this->db));
			if ($category)
			{
				return $category;
			}
			else
			{
				throw new Exception("No match");
			}
		}
		else
		{
			throw new Exception("Internal Server Error");
		}
	}
}
 ?>