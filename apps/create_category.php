<?php 
$categoryManager = new CategoryManager($db);
$category = $categoryManager->read();

if (count($category) == 0)
{
	$category = "Nothing to show";
}
else
{
	for ($i = 0, $c = count($category); $i < $c; $i++)
	{
		$category = $category[$i];
		require('views/create_category.phtml');
	}
}
 ?>