<?php 
class Address
{
	private $id;
	private $id_user;
	private $user;
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
	public function getUser()
	{
		$id_user = intval($this->id_user);
		$query = 'SELECT * FROM user WHERE id ='.$id_user;
		$res = $this->db->query($query);

		if ($res && ($user = $res->fetchObject("User", array($this->db))))
		{
			$this->user = $user;
		}
		return $this->user;
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
	public function getBillRegion()
	{
		return $this->bill_region;
	}
	public function getBillCountry()
	{
		return $this->bill_country;
	}

	public function setUser(User $user)
		{
			$this->user	= $user;
			$this->id_user = $user->getId();
			return true;
		}
	public function setShipAddress($ship_address)
	{
		$this->ship_address = $ship_address;
		return true;
	}
	public function setShipCity($ship_city)
	{
		$this->ship_city = $ship_city;
		return true;
	}
	public function setShipPostalCode($ship_postal_code)
	{
		$this->ship_postal_code = $ship_postal_code;
		return true;
	}
	public function setShipRegion($ship_region)
	{
		$this->ship_region = $ship_region;
		return true;
	}
	public function setShipCountry($ship_country)
	{
		$this->ship_country = $ship_country;
		return true;
	}
	public function setBillAddress($bill_address)
	{
		$this->bill_address = $bill_address;
		return true;
	}
	public function setBillCity($bill_city)
	{
		$this->bill_city = $bill_city;
		return true;
	}
	public function setBillPostalCode($bill_postal_code)
	{
		$this->bill_postal_code = $bill_postal_code;
		return true;
	}
	public function setBillRegion($bill_region)
	{
		$this->bill_region = $bill_region;
		return true;
	}
		public function setBillCountry($bill_country)
	{
		$this->bill_country = $bill_country;
		return true;
	}

}
 ?>