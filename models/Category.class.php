<?php 
class Category extends SubCategoryManager
{
	private $id;
	private $name;
	private $description;
	private $img;
	private $db;

	public function __construct($db)
	{
		parent::__construct($db);
		$this->db = $db;
	}

	public function getId()
	{
		return $this->id;
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
	
	public function setName($name)
	{
		if (strlen($name) > 1 && strlen($name) < 32)
		{
			$this -> name = $name;
			return true;
		}
		else
		{
			return "Invalid name";
		}
	}
	public function setDescription($description)
	{
		if (strlen($description) > 1 && strlen($description) < 512)
		{
			$this -> description = $description;
			return true;
		}
		else
		{
			return "Invalid description";
		}
	}
	public function setImg($img)
	{
		if ($image_proprietes = @getimagesize($img))
		{
			if ($image_proprietes[0] > 400 || $image_proprietes[1] > 400)
			{
				return "Invalid image dimensions (max 400x400 px)";
			}
			else if (@filesize($image) > 1e6)
			{
				return "Invalid image size (max 25 kB)";
			}
			else
			{
				$this -> image = $image;
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