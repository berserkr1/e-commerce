<?php 
class Product
{
	private $id;
	private $id_sub_category;
	private $name;
	private $description;
	private $price;
	private $rate;
	private $img;
	private $stock;

	public function __construct($db);
	{
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

	public function setId()
	{
		$this->id = $id;
		return true;
	}
	public function setIdSubCategory()
	{
		$this->id_sub_category = $id_sub_category;
		return true;
	}
	public function setName()
	{
		$this->name = $name;
		return true;
	}
	public function setDescription()
	{
		$this->description = $description;
		return true;
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