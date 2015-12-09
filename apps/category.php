<?php 
$categoryManager = new CategoryManager($db);
$category = $categoryManager->findByIdCategory($_GET['id']);
require('views/category.phtml');
 ?>