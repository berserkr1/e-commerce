<?php

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
		header('Location: ?page=category&id='.$subCategory->getIdCategory());
		exit;
	}
}