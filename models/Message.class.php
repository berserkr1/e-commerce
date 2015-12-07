<?php 
class Message
{
	private $id;
	private $id_user;
	private $id_product;
	private $id_order;
	private $content;
	private $rate;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function getId()
	{
		return $this->id;
	}
	public function getIdUser()
	{
		return $this->id_user;
	}
	public function getIdProduct()
	{
		return $this->id_product;
	}
	public function getIdOrder()
	{
		return $this->id_order;
	}
	public function getContent()
	{
		return $this->content;
	}
	public function getRate()
	{
		return $this->rate;
	}

	public function setId()
	{
		$this->id = $id;
		return true;
	}
	public function setIdUser()
	{
		$this->id_user = $id_user;
		return true;
	}
	public function setIdProduct()
	{
		$this->id_product = $id_product;
		return true;
	}
	public function setIdOrder()
	{
		$this->id_order = $id_order;
		return true;
	}
	public function setContent()
	{
		$this->content = $content;
		return true;
	}
	public function setRate()
	{
		$this->rate = $rate;
		return true;
	}
}
 ?>