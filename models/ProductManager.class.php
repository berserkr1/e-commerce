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
			$product->setSubCategory($sub_category);
			$product->setName($name);
			$product->setDescription($description);
			$product->setPrice($price);
			$product->setImg($img);
			$product->setStock($stock);
		}
		catch (Exception $e)
		{
			$errors[] = $e->getMessage();
		}	
		$errors = array_filter($errors, function ($val) 
		{
			return $val !== true;
		});
		if (count($errors) == 0)
		{
			$idSubCategory = intval($product->getIdSubCategory());
			$name = $this->db->quote($product->getName());
			$description = $this->db->quote($product->getDescription());
			$price = $this->db->quote($product->getPrice());
			$img = $this->db->quote($product->getImg());
			$stock = $this->db->quote($product->getStock());
			$query = "INSERT INTO product(id_sub_category, name, description, price, img, stock) VALUES('" . $idSub_category . "', " . $name . ", " . $description . ", " . $price . ", " . $img . ", " . $stock . ")";
			$res = $this->db->exec($query);
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

	public function findById($id)
	{
		$id	= intval($id);
		$query = "SELECT * FROM product WHERE id=".$id;
		$res = $this->db->query($query);			
		if ($res)
		{
			$product = $res->fetchObject("Product", array($this->db));
			if ($product)
			{
				return $product;
			}
			else
			{
				throw new Exception("No match");
			}
		}
		else
		{
			throw new Exception("Internal Server Error");
		}
	}
}