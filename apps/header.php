<?php
	if (isset($_SESSION["id"]))
	{
		require('views/header_in.phtml');
	}
	else
	{
		require('views/header.phtml');
	}
?>