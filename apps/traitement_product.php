<?php 
if (isset($_POST['action'])) {
	if ($_POST['action'] == 'create') {
		if (isset ($_POST['create_product'])) {
			$create_product = $_POST['create_product'];
			$productManager = new ProductManager($db);
			$subCategoryManager = new SubCategoryManager($db);
			$subCategory = $subCategoryManager->readById(intval($_GET['id']));
			$res = $productManager->create($subCategory, $_POST['create_product']);
			if (is_array($res))
			{
				$errors = $res;
				return $errors;
			}
			else if (is_string($res))
			{
				$errors[] = $res;
			}
			else
			{
				$_SESSION['success'] = "Produit créé avec succès";
				header('Location: ?page=product&id='.$res->getProduct()->getId());
				exit;
			}
		}
	}
}
 ?>