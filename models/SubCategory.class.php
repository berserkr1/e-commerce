<?php 
class SubCategory extends ProductManager
{
	private $id;
	private $id_category;
	private $category;
	private $name;
	private $description;
	private $img;

	public function __construct($db)
	{
		parent::__construct($db);
		$this->db = $db;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getIdCategory()
	{
		return $this->id_category;
	}
	public function getCategory()
	{
		if (!$this->category)
		{
			$id_category = intval($this->id_category);
			$query = 'SELECT * FROM category WHERE id ='.$id_category;
			$res = mysqli_query($this->db, $query);

			if ($res && ($category = mysqli_fetch_object($res, 'Category', array($this->db))))
			{
				$this->category = $category;
			}
		}
		return $this->category;
	}
	public function getName()
	{
		return $this->name;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getImg()
	{
		return $this->img;
	}

	public function setCategory(Category $category)
	{
		$this->category	= $category;
		$this->id_category = $category->getId();
		return true;
	}
	public function setName($name)
	{
		if (strlen($name) > 1)
		{
			$this->name = $name;
			return true;
		}
		else
		{
			return "Nom trop court";
		}
		
	}
	public function setDescription($description)
	{
		if (strlen($description) > 1)
		{
			$this->description = $description;
			return true;
		}
		else
		{
			return "Description trop courte";
		}
		
	}
	public function setImg($img)
	{
		if ($image_proprietes = @getimagesize($img))
		{
			if ($image_proprietes[0] > 500 || $image_proprietes[1] > 500)
			{
				return "Invalid image dimensions (max 500x500 px)";
			}
			else if (@filesize($img) > 1e6)
			{
				return "Invalid image size (max 25 kB)";
			}
			else
			{
				$this->img = $img;
				return true;
			}
		}
		else
		{
			return "Invalid filetype";
		}
	}
}
 ?>