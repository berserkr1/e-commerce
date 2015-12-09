<?php 
$addressManager = new AddressManager($db);
try
{
	$address = $addressManager -> findByIdUser($currentUser->getId());
}
catch (Exception $e)
{
	$address = $e->getMessage();
}
$ship_address=$ship_postal_code=$ship_city=$ship_region=$ship_country=$bill_address=$bill_postal_code=$bill_city=$bill_region=$bill_country="";
if (is_object($address))
{
	$ship_address=$address->getShipAddress();
	$ship_postal_code=$address->getShipPostalCode();
	$ShipCity=$address->getShipCity();
	$ShipRegion=$address->getShipRegion();
	$address->getShipCountry();
	$address->getBillAddress();
	$address->getBillPostalCode();
	$address->getBillCity();
	$address->getBillRegion();
	$address->getBillCountry();

}

require('views/profil.phtml');
?>