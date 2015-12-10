<?php 
	$subCategoryManager = new SubCategoryManager($db);
	try
	{
		$subcategory_list = $subCategoryManager->find();
	}
	catch (Exception $e)
	{
		$subcategory_list = $e->getMessage();
	}

	if (is_string($subcategory_list))
	{
		$errors[] = "Nothing to show";
	}
	else
	{
		for ($i = 0; $i<count($subcategory_list); $i++)
		{
			$subcategory = $subcategory_list[$i];
			require('views/create_sub_category_list.phtml');
		}
	}
	require('views/create_sub_category.phtml');
?>