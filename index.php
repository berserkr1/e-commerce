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
	$chemins = array(
		'register', 'login', 'profil', 'edit_profil',
		'home', 'category', 'sub_category', 'edit_category', 'edit_sub_category',
		'404');
	$traitements = array(
		'register'=>'user', 'login'=>'user', 'logout'=>'user', 'edit_profil'=>'user',
		'create_category'=>'category', 'edit_category'=>'category',
		'edit_sub_category'=>'sub_category');

	$page = 'home';
	$errors = array();

	if ( isset($_GET['page']) )
	{
		if ( isset($traitements[$_GET['page']]) )
		{
			require('apps/traitement_'.$traitements[$_GET['page']].'.php');
		}
		else if ( in_array($_GET['page'], $traitements) )
		{
			require('apps/traitement_'.$_GET['page'].'.php');
		}
		if ( in_array($_GET['page'], $chemins) )
		{
			$page = $_GET['page'];
		}
	}

	require('apps/skel.php');

?>