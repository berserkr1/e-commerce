<?php 
class Address
{
	private $id;
	private $id_user;
	private $ship_address;
	private $ship_city;
	private $ship_postal_code;
	private $ship_region;
	private $ship_country;
	private $bill_address;
	private $bill_city;
	private $bill_postal_code;
	private $bill_country;
	private $bill_region;

	public function __construct($db);
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
	public function getShipAddress()
	{
		return $this->ship_address;
	}
	public function getShipCity()
	{
		return $this->ship_city;
	}
	public function getShipPostalCode()
	{
		return $this->ship_postal_code;
	}
	public function getShipRegion()
	{
		return $this->ship_region;
	}
	public function getShipCountry()
	{
		return $this->ship_country;
	}
	public function getBillAddress()
	{
		return $this->bill_address;
	}
	public function getBillCity()
	{
		return $this->bill_city;
	}
	public function getBillPostalCode()
	{
		return $this->bill_postal_code;
	}
	public function getBillCountry()
	{
		return $this->bill_country;
	}
	public function getBillRegion()
	{
		return $this->bill_region;
	}

	public function setId()
	{
		$this->id = $id;
		return true;
	}
	public function setIdUser()
	{
		$this->id = $id_user;
		return true;
	}
	public function setShipAddress()
	{
		$this->id = $ship_address;
		return true;
	}
	public function setShipCity()
	{
		$this->id = $ship_city;
		return true;
	}
	public function setShipPostalCode()
	{
		$this->id = $ship_postal_code;
		return true;
	}
	public function setShipRegion()
	{
		$this->id = $ship_region;
		return true;
	}
	public function setShipCountry()
	{
		$this->id = $ship_country;
		return true;
	}
	public function setBillAddress()
	{
		$this->id = $bill_address;
		return true;
	}
	public function setBillCity()
	{
		$this->id = $bill_city;
		return true;
	}
	public function setBillPostalCode()
	{
		$this->id = $bill_postal_code;
		return true;
	}
	public function setBillCountry()
	{
		$this->id = $bill_country;
		return true;
	}
	public function setBillRegion()
	{
		$this->id = $bill_region;
		return true;
	}
}
}
 ?>