<?php
	if(isset($_GET['page']))
	{
		if ($_GET['page'] == 'create_category')
		{
			$category_name=$category_banner=$category_description="";
			if (isset($_POST['category_name'], $_POST['category_banner'], $_POST['category_description']))
			{
				$categoryManager = new CategoryManager($db);
				$category = $categoryManager->create($_POST['category_name'], $_POST['category_description'], $_POST['category_banner']);
				if (is_array($category))
				{
					$errors = array_merge($errors, $category);
					$category_name = $_POST['category_name'];
					$category_banner = $_POST['category_banner'];
					$category_description = $_POST['category_description'];
				}
				else
				{
					$_SESSION['success'] = "Category has been created";
					header('Location: ?page=category&id='.$category->getId());
					exit;
				}
			}
		}

		if ($_GET['page'] == 'create_sub_category')
		{
			$subCategory_name=$subCategory_banner=$subCategory_description="";
			if (isset($_POST['subCategory_name'], $_POST['subCategory_banner'], $_POST['subCategory_description']))
			{
				$subCategoryManager = new SubCategoryManager($db);
				$subCategory = $subCategoryManager->create('1', $_POST['subCategory_name'], $_POST['subCategory_description'], $_POST['subCategory_banner']);
				if (is_array($subCategory))
				{
					$errors = array_merge($errors, $subCategory);
					$subCategory_name = $_POST['subCategory_name'];
					$subCategory_banner = $_POST['subCategory_banner'];
					$subCategory_description = $_POST['subCategory_description'];
				}
				else
				{
					$_SESSION['success'] = "Subcategory has been created";
					header('Location: ?page=sub_category&id='.$subCategory->getId());
					exit;
				}
			}
		}
	}
?>