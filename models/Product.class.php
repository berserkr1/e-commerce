<?php 
class Product
{
	private $id;
	private $id_sub_category;
	private $sub_category;
	private $name;
	private $description;
	private $price;
	private $rate;
	private $img;
	private $stock;

	public function __construct($db)
	{
		parent::__construct($db);
		$this->db = $db;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getIdSubCategory()
	{
		return $this->id_sub_category;
	}
	public function getSubCategory()
	{
		if (!$this->sub_category)
		{
			$id_sub_category = intval($this->id_sub_category);
			$query = 'SELECT * FROM sub_category WHERE id ='.$id_sub_category;
			$res = mysqli_query($this->db, $query);
			if ($res && ($sub_category = mysqli_fetch_object($res, 'SubCategory', array($this->db))))
			{
				$this->sub_category = $sub_category;
			}
		}
		return $this->sub_category;	
	}
	public function getName()
	{
		return $this->name;
	}
	public function getDescription()
	{
		return $this->description;
	}
	public function getPrice()
	{
		return $this->price;
	}
	public function getRate()
	{
		return $this->rate;
	}
	public function getImg()
	{
		return $this->img;
	}
	public function getStock()
	{
		return $this->stock;
	}

	public function setSubCategory()
	{
		$this->id_sub_category = $sub_category->getId();
		$this->sub_category	= $sub_category;
		return true;
	}
	public function setName()
	{
		if(is_string($name))
		{
			if(strlen(trim($name)) >= 2 && strlen(trim($name))<= 31)
			{
				$this->name = trim($name);
				return true;
			}
			else
			{
				return 'Product name is not valid';
			}
		}
		else
		{
			return 'Product name needs to be a string';
		}
	}
	public function setDescription()
	{
		if (strlen($description) > 15 && strlen($description) < 2047)
		{
			$this->content = $content;
			return true;
		}
		else
		{
			return 'Description must be between 16 and 2046 characters';
		}
	}
	public function setPrice()
	{
		$this->price = $price;
		return true;
	}
	public function setRace()
	{
		$this->race = $race;
		return true;
	}
	public function setImg()
	{
		$this->img = $img;
		return true;
	}
	public function setStock()
	{
		$this->stock = $stock;
		return true;
	}
}
 ?>