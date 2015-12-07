<?php 
class SubCategory
{
	private $id;
	private $id_category;
	private $name;
	private $description;
	private $img;

	public function __construct($db);
	{
		$this->db = $db;
	}

	public function getId()
	{
		return $this -> id;
	}
	public function getIdCategory()
	{
		return $this -> id_category;
	}
	public function getName()
	{
		return $this -> name;
	}
	public function getDescription()
	{
		return $this -> description;
	}
	public function getImg()
	{
		return $this -> img;
	}

	public function setId()
	{
		$this -> id = $id;
		return true;
	}
	public function setIdCategory()
	{
		$this -> id_category = $id_category;
		return true;
	}
	public function setName()
	{
		$this -> name = $name;
		return true;
	}
	public function setDescription()
	{
		$this -> description = $description;
		return true;
	}
	public function setImg()
	{
		$this -> img = $img;
		return true;
	}
}
 ?>