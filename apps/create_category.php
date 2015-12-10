<?php 
	$categoryManager = new CategoryManager($db);
/*	try
	{
		$category_list = $categoryManager->find();
	}
	catch (Exception $e)
	{
		$category_list = $e->getMessage();
	}

	if (is_string($category_list))
	{
		$errors[] = "Nothing to show";
	}
	else
	{
		for ($i = 0; $i<count($category_list); $i++)
		{
			$category = $category_list[$i];
			require('views/create_category_list.phtml');
		}
	}*/
	require('views/create_category.phtml');
?>