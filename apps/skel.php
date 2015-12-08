<?php

	$titre = "Ecommerce";
	// LANCEMENT PAGES AJAX
	if (isset($_GET['ajax']))
	{
	    require('apps/***.php');
	} 
	else
	{
		require('views/skel.phtml');
	}

?>