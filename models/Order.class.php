<?php 
class Order
{
	private $id;
	private $id_user;
	private $date_paid;
	private $date_ship;
	private $amount;
	private $status;

	public function __construct($db);
	{
		$this->db = $db;
	}

	public function getId($Id);
	{
		return $this->id;
	}
	public function getIdUser();
	{
		return $this->id_user;
	}
	public function getDatePaid()
	{
		return $this->date_paid;
	}
	public function getDateShip()
	{
		return $this->date_ship;
	}
	public function getAmount()
	{
		return $this->amount;
	}
	public function getStatus()
	{
		return $this->status;
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
	public function setDatePaid()
	{
		$this->date_paid = $date_paid;
		return true;
	}
	public function setDateShip()
	{
		$this->date_ship = $date_ship;
		return true;
	}
	public function setAmount()
	{
		$this->amount = $amount;
		return true;
	}
	public function setStatus()
	{
		$this->status = $status;
		return true;
	}
}
 ?>