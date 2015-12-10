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
			$this->name = $name;
			return true;
		}
		else
		{
			throw new Exception("Name must be under 32 characters");
		}
	}
	public function setDescription($description)
	{
		if (strlen($description) > 1 && strlen($description) < 512)
		{
			$this->description = $description;
			return true;
		}
		else
		{
			throw new Exception("Description must be under 512 characters");
		}
	}
	public function setImg($img)
	{
		if ($image_proprietes = @getimagesize($img))
		{
			if ($image_proprietes[0] > 500 || $image_proprietes[1] > 500)
			{
				throw new Exception("Invalid image dimensions (max 500x500 px)");
			}
			else if (@filesize($img) > 1e6)
			{
				throw new Exception("Invalid image size (max 1 Mo)");
			}
			else
			{
				$this->img = $img;
				return true;
			}
		}
		else
		{
			throw new Exception("Invalid filetype");
		}
	}
}
?>