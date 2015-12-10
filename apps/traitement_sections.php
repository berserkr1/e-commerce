<?php
	if(isset($_GET['page']))
	{
		if ($_GET['page'] == 'create_category')
		{
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
					$_SESSION['success'] = "Catégorie créée avec succès";
					header('Location: ?page=category&amp;id=' .$category->getIdCategory());
					exit;
				}
			}

			if (isset($_POST['subCategory_name'], $_POST['subCategory_banner'], $_POST['subCategory_description']))
			{
				$CategoryManager = new CategoryManager($db);
				$subCategoryManager = new SubCategoryManager($db);
				$subCategory = $subCategoryManager->create($CategoryManager->readById($_GET['id']), $_POST['subCategory_name'], $_POST['subCategory_description'], $_POST['subCategory_banner']);

				if (is_array($subCategory))
				{
					$errors = array_merge($errors, $subCategory);
					$subCategory_name = $_POST['subCategory_name'];
					$subCategory_banner = $_POST['subCategory_banner'];
					$subCategory_description = $_POST['subCategory_description'];
				}
				else
				{
					$_SESSION['success'] = "Sous-catégorie créée avec succès";
					header('Location: ?page=sub_category&amp;id='.$subCategory->getIdsub_Category());
					exit;
				}
			}
		}

		if ($_GET['page'] == 'create_sub_category')
		{
			
		}
	}
?>