<?php
class AddressManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function create(User $user, $ship_address, $ship_city, $ship_postal_code, $ship_region, $ship_country, $bill_address, $bill_city, $bill_postal_code, $bill_region, $bill_country)
	{
		$errors = array();
		$address = new Address($this->db);
		try
		{
			$address -> setUser($user);
			$address -> setShipAddress($ship_address);
			$address -> setShipCity($ship_city);
			$address -> setShipPostalCode($ship_postal_code);
			$address -> setShipRegion($ship_region);
			$address -> setShipCountry($ship_country);
			$address -> setBillAddress($bill_address);
			$address -> setBillCity($bill_city);
			$address -> setBillPostalCode($bill_postal_code);
			$address -> setBillRegion($bill_region);
			$address -> setBillCountry($bill_country);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}
		if (count($errors) == 0)
		{
			$id_user = $this->db->quote($user->getId());
			$ship_address = $this->db->quote($address->getShipAddress());
			$ship_city = $this->db->quote($address->getShipCity());
			$ship_postal_code = $this->db->quote($address->getShipPostalCode());
			$ship_region = $this->db->quote($address->getShipRegion());
			$ship_country = $this->db->quote($address->getShipCountry());
			$bill_address = $this->db->quote($address->getBillAddress());
			$bill_city = $this->db->quote($address->getBillCity());
			$bill_postal_code = $this->db->quote($address->getBillPostalCode());
			$bill_region = $this->db->quote($address->getBillRegion());
			$bill_country = $this->db->quote($address->getBillCountry());

			$query = "INSERT INTO address (id_user, ship_address, ship_city, ship_postal_code, ship_region, ship_country, bill_address, bill_city, bill_postal_code, bill_region, bill_country) VALUES(".$id_user.",".$ship_address.", ".$ship_city.", ".$ship_postal_code.", ".$ship_region.", ".$ship_country.", ".$bill_address.", ".$bill_city.", ".$bill_postal_code.", ".$bill_region.", ".$bill_country.")";

			$res = $this->db->exec($query);
			if ($res)
			{
				$id = $this->db->lastInsertId();
				if ($id)
				{
					return $this->findById($id);
				}
				else
				{
					return "Internal server error";
				}
			}
		}
		else
		{
			return $errors;
		}
	}
	public function findById($id)
	{
		$id = intval($id);
		$query = "SELECT * FROM address WHERE id=".$id;
		$res = $this->db->query($query);

		if ($res)
		{
			$address = $res->fetchObject("Address",array($this->db));
			if ($address)
			{
				return $address;
			}
			else
			{
				throw new Exception("Address not found");
			}
		}
		else 
		{
			throw new Exception("Database error");
		}
	}
	// public function delete(address $address)
	// {
	// 	$id = $address->getId();
	// 	$query = "DELETE FROM address WHERE id='".$id."'";
	// 	$res = $db->exec($query);
	// 	if ($res)
	// 	{
	// 		return true;
	// 	}
	// 	else
	// 	{
	// 		return "Internal Server Error";
	// 	}
	// }
	public function update(Address $address)
	{
		$id = $address->getId();
		$ship_address = $this->db->quote($address->getShipaddress());
		$ship_city = $this->db->quote($address->getShipCity());
		$ship_postal_code = $this->db->quote($address->getShipPostalCode());
		$ship_region = $this->db->quote($address->getShipRegion());
		$ship_country = $this->db->quote($address->getShipCountry());
		$bill_address = $this->db->quote($address->getBilladdress());
		$bill_city = $this->db->quote($address->getBillCity());
		$bill_postal_code = $this->db->quote($address->getBillPostalCode());
		$bill_region = $this->db->quote($address->getBillRegion());
		$bill_country = $this->db->quote($address->getBillCountry());

		$query = "UPDATE address SET ship_address=".$ship_address.", ship_city=".$ship_city.", ship_postal_code=".$ship_postal_code.", ship_region=".$ship_region.", ship_country=".$ship_country.", bill_address=".$bill_address.", bill_city=".$bill_city.", bill_postal_code=".$bill_postal_code.", bill_region=".$bill_region.", bill_country=".$bill_country.",WHERE id='".$id."'";

		$res = $this->db->exec($query);
		if ($res)
		{
			return $this->findById($id);
		}
		else
		{
			return "Internal Server Error";
		}
	}
	public function findByIdUser($id_user) 
	{
		$id_user = intval($id_user);
		$query = "SELECT * FROM address WHERE id_user=".$id_user;
		$res = $this->db->query($query);

		if($res)
		{
			$address = $res->fetchObject("Address", array($this->db));
			if ($address)
			{
				return $address;
			}
			else
			{
				throw new Exception("Address not found");
			}
		}
		else
		{
			throw new Exception("Database error");
		}
	}
}
?>