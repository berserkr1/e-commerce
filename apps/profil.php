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
	$ship_city=$address->getShipCity();
	$ship_region=$address->getShipRegion();
	$ship_country=$address->getShipCountry();
	$bill_address=$address->getBillAddress();
	$bill_postal_code=$address->getBillPostalCode();
	$bill_city=$address->getBillCity();
	$bill_region=$address->getBillRegion();
	$bill_country=$address->getBillCountry();

}

require('views/profil.phtml');
?>