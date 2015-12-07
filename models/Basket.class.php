<?php 
class Basket
{
	private $id;
	private $id_order;
	private $id_product;
	private $quantity;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getIdOrder()
	{
		return $this->id_order;
	}
	public function getIdProduct()
	{
		return $this->id_product;
	}
	public function getQuantity()
	{
		return $this->quantity;
	}

	public function setId($id)
	{
		$this->id = $id;
		return true;
	}
	public function setIdOrder()
	{
		$this->id_order = $id_order;
		return true;
	}
	public function setIdProduct()
	{
		$this->id_product = $id_product;
		return true;
	}
	public function setQuantity()
	{
		$this->quantity = $quantity;
		return true;
	}
}
 ?>