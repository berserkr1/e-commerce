<?php 
	if (isset($_GET['page']))
	{
		if ($_GET['page'] == 'create_product')
		{
			$name = $description = $price = $img = $stock = "";
			if (isset ($_POST['name'], $_POST['description'], $_POST['price'], $_POST['img'], $_POST['stock']))
			{
				$productManager = new ProductManager($db);
				$subCategoryManager = new SubCategoryManager($db);
				try
				{
					$subCategory = $subCategoryManager->findById(intval($_GET['id']));
				}
				catch (Exception $e)
				{
					$errors[] = $e->getMessage();
				}
				$product = $productManager->create($subCategory, $_POST['name'], $_POST['description'], $_POST['price'], $_POST['img'], $_POST['stock']);
				if (is_array($product))
				{
					$errors = array_merge($errors, $product);
					$name = $_POST['name'];
					$description = $_POST['description'];
					$price = $_POST['price'];
					$img = $_POST['img'];
					$stock = $_POST['stock'];
				}
				else
				{
					$_SESSION['success'] = "Produit créé avec succès";
					header('Location: ?page=product&id='.$product->getId());
					exit;
				}
			}
		}
	}
 ?>