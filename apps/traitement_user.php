<?php
if (isset($_GET['page']))
{
	$action = $_GET['page'];
	if ($action == 'login')
	{
		if (isset($_POST['login'], $_POST['password']))
		{
			$manager = new UserManager($db);
			$retour = $manager->findByLogin($_POST['login']);
			if (is_string($retour))
			{
				$errors[] = $retour;
			}
			else
			{
				$user = $retour;
				if ($user->verifPassword($_POST['password']))
				{
					$_SESSION['id'] = $user->getId();
					header('Location: index.php');
					exit;
				}
				else
				{
					$errors[] = 'Incorrect Password';
				}
			}
		}
	}

	//------------------------------------------------------------------------------------------------

	else if ($action == 'register')
	{
		if (isset($_POST['login'], $_POST['password1'], $_POST['password2'], $_POST['email'], $_POST['name'], $_POST['surname'], $_POST['date_birth']))
		{
			$manager = new UserManager($db);
			$retour = $manager->create($_POST['login'], $_POST['password1'], $_POST['password2'], $_POST['email'], $_POST['name'], $_POST['surname'], $_POST['date_birth']);
			if (is_array($retour))
			{
				$errors = array_merge($errors, $retour);
			}
			else if (is_string($retour)) 
			{
				$errors[]=$retour;
			}
			else
			{
				header('Location: index.php?page=login');
				exit;
			}
		}
	}

	//------------------------------------------------------------------------------------------------

	else if ($action == 'logout')
	{
		session_destroy();
		$_SESSION = array();
		header('Location: index.php');
		exit;
	}

	//------------------------------------------------------------------------------------------------

	else if ($action == 'edit_profil')
	{
		
		if (isset($_POST['login'], $_POST['email'], $_POST['password1'], $_POST['password2'], $_POST['name'], $_POST['surname'], $_POST['date_birth']))
		{
			$manager = new UserManager($db);
			$currentUser->setLogin($_POST['login']);
			$currentUser->setEmail($_POST['email']);
			$currentUser->setPassword($_POST['password1'], $_POST['password2']);
			$currentUser->setName($_POST['name']);
			$currentUser->setSurname($_POST['surname']);
			$currentUser->setDateBirth($_POST['date_birth']);
			$retour = $manager->update($currentUser);
			if (is_array($retour))
			{
				$errors = array_merge($errors, $retour);
			}
			else
			{
				$user = $retour;
				header('Location: index.php?page=profil&id='.$currentUser->getId().'');
				exit;
			}

		}

	}

	//------------------------------------------------------------------------------------------------

	else if ($action == 'edit_address')
	{
		if (isset($_POST['ship_address'], $_POST['ship_city'], $_POST['ship_postal_code'], $_POST['ship_region'], $_POST['ship_country'], $_POST['bill_address'], $_POST['bill_city'], $_POST['bill_postal_code'], $_POST['bill_region'], $_POST['bill_country']))
		{
			$addressManager = new AddressManager($db);
			$userManager = new UserManager($db);
			try
			{
				$retour = $addressManager->findByIdUser($currentUser->getId());
			}
			catch(Exception $e)
			{
				$retour = $e->getMessage();
			}
			
			if (is_string($retour))
			{
				$retour=$addressManager->create($currentUser, $_POST['ship_address'], $_POST['ship_city'], $_POST['ship_postal_code'], $_POST['ship_region'], $_POST['ship_country'], $_POST['bill_address'], $_POST['bill_city'], $_POST['bill_postal_code'], $_POST['bill_region'], $_POST['bill_country']);
				if (is_string($retour))
				{
					$errors = array_merge($errors, $retour);
				}
				else
				{
					header('Location: index.php?page=profil');
					exit;
				}
			}
			
			else
			{
				$addressManager = new AddressManager($db);
				$address = $addressManager->findByIdUser($_SESSION['id']);

				$address->setShipAddress($_POST['ship_address']);
				$address->setShipCity($_POST['ship_city']);
				$address->setShipPostalCode($_POST['ship_postal_code']);
				$address->setShipRegion($_POST['ship_region']);
				$address->setShipCountry($_POST['ship_country']);
				$address->setBillAddress($_POST['bill_address']);
				$address->setBillCity($_POST['bill_city']);
				$address->setBillPostalCode($_POST['bill_postal_code']);
				$address->setBillRegion($_POST['bill_region']);
				$address->setBillCountry($_POST['bill_country']);

				$retour=$addressManager->update($address);
				
				if (is_array($retour))
				{
					$errors = array_merge($errors, $retour);
				}
				else
				{
					$_SESSION['success']='Your informations has been updated';
					header('Location: index.php?page=profil');
					exit;
				}

			}
				
		}

	}

}
?>