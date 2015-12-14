<?php 
$productManager = new ProductManager($db);
$sub_categoryManager = new SubCategoryManager($db);

$sub_category = $sub_categoryManager->find();
require('views/create_product.phtml');
 ?>