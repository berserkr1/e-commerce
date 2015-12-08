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
	else if ($action == 'logout')
	{
		session_destroy();
		$_SESSION = array();
		header('Location: index.php');
		exit;
	}
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
				header('Location: index.php?page=profil&id='.$user->getId().'');
				exit;
			}

		}

	}
}
?>