<?php 
$sub_categoryManager = new SubCategoryManager($db);
try
{
	$sub_category = $sub_categoryManager->findById($_GET['id']);
}
catch (Exception $e)
{
	$sub_category = $e->getMessage();
}
if (!is_string($sub_category))
{
	require('views/sub_category.phtml');
}
else
{
	echo ("Nothing to show");
}
 ?>