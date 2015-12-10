<?php 
$productManager = new ProductManager($db);
try
{
	$product = $productManager->findById($_GET['id']);
}
catch (Exception $e)
{
	$product = $e->getMessage();
}
if (!is_string($product))
{
	require('views/product.phtml');
}
else
{
	echo ("Nothing to show");
}
 ?>