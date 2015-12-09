<?php
$categoryManager = new CategoryManager($db);
$category = $categoryManager->read();

$sub_categoryManager = new Sub_CategoryManager($db);
$sub_category = $sub_categoryManager->read();
if (count($sub_category) == 0)
{
	$sub_category = "Nothing to show";
}
else
{
	for ($i = 0, $c = count($sub_category); $i < $c; $i++)
	{
		$sub_category = $sub_category[$i];
		require('views/create_sub_category.phtml');
	}
}