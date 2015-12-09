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
			$res = mysqli_query($this->db, $query);
			if ($res)
			{
				$id = mysqli_insert_id($this->db);
				if ($id)
				{
					return $this->readById($id);
				}
				else
				{
					return "Internal server error";
				}
			}
			else
			{
				return mysqli_error($this->db);
			}
		}
		else
		{
			return $errors;
		}
	}
}
 ?>