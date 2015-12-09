<?php

$manager = new UserManager($db); 
$user = $manager->findById($_GET['id']);
if (is_string($user))
{
	require('views/home.phtml');
}
else 
{
	require('views/edit_profil.phtml');
}

?>