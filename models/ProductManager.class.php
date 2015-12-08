<?php 
class ProductManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function create(SubCategory $sub_category, $name, $description, $price, $img, $stock)
	$product = new Product($this->db);
	$errors[] = $product->setSub_category($sub_category);
	$errors[] = $product->setName($name);
	$errors[] = $product->setDescription($description);
	$errors[] = $product->setPrice($price);
	$errors[] = $product->setImg($img);
	$errors[] = $product->setStock($stock);
	$errors = array_filter($errors, function ($val) {
					return $val !== true;
				});
	if (count($errors) == 0)
		{
			$idSub_category = intval($product->getIdSub_category());
			$name = mysqli_escape_string($this->db, $product->getName());
			$description = mysqli_escape_string($this->db, $product->getDescription());
			$price = mysqli_escape_string($this->db, $product->getPrice());
			$img = mysqli_escape_string($this->db, $product->getImg());
			$stock = mysqli_escape_string($this->db, $product->getStock());
			$query = "INSERT INTO product(id_sub_category, name, description, price, img, stock) VALUES('" . $idSub_category . "', '" . $name . "', '" . $description . "', '" . $price . "', '" . $img . "', '" . $stock . "')";
			$data = mysqli_query($this->db, $query);
			else
			{
				return "DB connect error";
			}
		}
		else
		{
			return $errors;
		}	
}
 ?>