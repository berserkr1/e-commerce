<?php
	
// ________ TOOLS ________
	session_start();

	// $db = mysqli_connect('192.168.1.7', 'root', 'troiswa', 'ecommerce');
	$db = new PDO("mysql:host=192.168.1.7;dbname=ecommerce", 'root', 'troiswa');

	if ( $db === false )
		require('apps/404.php');

	spl_autoload_register(function ($class)
	{
		require('models/'.$class.'.class.php');
	});

	if ( isset($_SESSION['id']) )
	{
		$userManager = new UserManager($db);
		$currentUser = $userManager->getCurrent();
	}

// ________ HUB ________
	// Pages
	$access_public = array('404', 'home', 'category', 'subcategory', 'product', 'basket', 'register', 'login');
	$access_user = array('404', 'home', 'category', 'subcategory', 'product', 'basket',  'profile', 'logout');
	$access_admin = array('404', 'home', 'category', 'subcategory', 'product', 'basket', 'profile', 'logout', 'dashboard_user', 'dashboard_product', 'dashboard_message', 'dashboard_sections', 'dashboard_order')
	
	// Traitements
	$traitements_public = array('product'=>'product', 'basket'=>'basket', 'register'=>'user', 'login'=>'user');
	$traitements_user = array('product'=>'product', 'basket'=>'basket', 'profile'=>'user', 'logout'=>'user');
	$traitements_admin = array('product'=>'product', 'basket'=>'basket', 'profile'=>'user', 'logout'=>'user', 'dashboard_user'=>'user', 'dashboard_product'=>'product', 'dashboard_message'=>'message', 'dashboard_sections'=>'sections', 'dashboard_order'=>'order');

	$page = 'home';
	$errors = array();

	if (isset($_GET['page']))
	{
		// Pages publiques
		if (in_array($_GET['page'], $access_public) && !isset($_SESSION['id']))
		{
			$page = $_GET['page'];

			if (isset($traitements_public[$_GET['page']]))
			{
				require('apps/traitement_'.$traitements_public[$_GET['page']].'.php');
			}
		}

//---------------------------------------------------------
		// Pages utilisateurs
		else if (in_array($_GET['page'], $access_user) && isset($_SESSION['id']))
		{
			if (in_array($_GET['page'], $access_ids))
			{
				if (isset($_GET['id']))
				{
					$page = $_GET['page'];
				}
				else
				{
					header('Location: ?page=home');
					exit;
				}
			}
			else
			{
				$page = $_GET['page'];
			}
			if (isset($handlers_user[$_GET['page']]) && !empty($_POST))
			{
				require('controllers/handler/handler_'.$handlers_user[$_GET['page']].'.php');
			}
		}

		// Admin pages
		else if (in_array($_GET['page'], $access_admin) && isset($_SESSION['id']) && ($currentUser -> getStatus()) > 0)
		{
			$page = $_GET['page'];

			if (isset($handlers_admin[$_GET['page']]) && !empty($_POST))
			{
				require('controllers/handler/handler_'.$handlers_admin[$_GET['page']].'.php');
			}
		}

// Default pages
	else
	{
		if (isset($_SESSION['id']))
		{
			header('Location: ?page=home');
			exit;
		}
		else
		{
			header('Location: ?page=login');
			exit;
		}
	}
}
else
{
	if (isset($_SESSION['id']))
	{
		$page = 'home';
	}
	else
	{
		$page = 'login';
	}
}

	require('apps/skel.php');

	/* TURN OFF SESSION SUCCESS*/
	$_SESSION['success'] = "";

?>