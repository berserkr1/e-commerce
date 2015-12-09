<?php 
$categoryManager = new CategoryManager($db);
try
{
	$category = $categoryManager->findById($_GET['id']);
}
catch (Exception $e)
{
	$category = $e->getMessage();
}
if (!is_string($category))
{
	require('views/category.phtml');
}
else
{
	echo ("Nothing to show");
}
 ?>