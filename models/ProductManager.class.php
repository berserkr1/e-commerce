<?php 
class ProductManager
{
	private $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function create(SubCategory $sub_category, $name, $description, $price, $img, $stock)
	{
		$errors = array();		
		$product = new Product($this->db);
		try
		{
			$product->setSub_category($sub_category);
			$product->setName($name);
			$product->setDescription($description);
			$product->setPrice($price);
			$product->setImg($img);
			$product->setStock($stock);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getProduct;
		}	
		$errors = array_filter($errors, function ($val) 
		{
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
			$res = mysqli_query($this->db->exec($query));
			if ($res)
			{
				$id = $this->db->lastInsertId();
				if ($id)
				{
					return $this->findById($id);
				}
				else
				{
					return "Internal Server error";
				}
			}
		}
		else
		{
			return $errors;
		}	
	}
}