<?php 
class SubCategoryManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function create(Category $category, $name, $description, $img)
	{
		$sub_category = new SubCategory($this->db);		
		$errors = array();
		try
		{
			$sub_category->setCategory($category);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}
		try
		{
			$sub_category->setName($name);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}
		try
		{
			$sub_category->setDescription($description);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}
		try
		{
			$sub_category->setImg($img);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}			

		if (count($errors) == 0)
		{
			$idCategory = intval($sub_category->getIdCategory());
			$name = $this->db->quote($sub_category->getName());
			$description = $this->db->quote($sub_category->getDescription());
			$img = $this->db->quote($sub_category->getImg());
			$query	= "INSERT INTO sub_category (id_category, name, description, img) VALUES ('".$idCategory."', ".$name.", ".$description.", ".$img.")";
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

	public function find($n = 0)
	{	
	 	if (isset($n) && !is_nan($n))
	 	{
	 		$n = intval($n);
	 		$query = 'SELECT * FROM sub_category ORDER BY `name` ASC LIMIT '.$n;
	 	}
	 	else
	 	{
	 		$query = 'SELECT * FROM sub_category ORDER BY `name` ASC';
	 	}
	 	$res = $this->db->query($query);
	 	if ($res)
	 	{
	 		$subcategory_list = array();
	 		while ($subcategory = $res->fetchObject("SubCategory", array($this->db)))
	 		{
	 			$subcategory_list[] = $subcategory;
	 		}
	 		return $subcategory_list;
	 	}
	 	else
	 	{
	 		throw new Exception ("Database error");
	 	}
	}

	public function findByIdCategory($id_category)
	{
		$id_category = intval($id_category);
		$query = 'SELECT * FROM sub_category WHERE id_category ='.$id_category;
		$res = $this->db->query($query);

		if ($res)
		{
			$subcategory_list = $res->fetchAll(PDO::FETCH_CLASS, "SubCategory", array($this->db));
			if (count($subcategory_list) > 0)
			{
				return $subcategory_list;
			}
			else
			{
				throw new Exception('Subcategory not found');
			}
		}
		else
		{
			throw new Exception('Error 02 : Database error');
		}
	}

	public function findById($id)
	{
		$id	= intval($id);
		$query = "SELECT * FROM sub_category WHERE id=".$id;
		$res = $this->db->query($query);			
		if ($res)
		{
			$sub_category = $res->fetchObject("SubCategory", array($this->db));
			if ($sub_category)
			{
				return $sub_category;
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
