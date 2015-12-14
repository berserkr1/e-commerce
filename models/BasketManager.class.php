<?php

public function addToBasket(Product $product)
{
	$id_product = intval($product->getId());

	if ( isset($_SESSION['id']) )
	{
		$query = "INSERT INTO basket (id_product) VALUES(".$id_product.")";
		$res = $this->db->exec($query);
		if($res)
		{
			$id = $this->db->lastInsertId();
			if ($id)
			{
				return $this->findById($id);
			}
			else
			{
				throw new Exception ("Internal server error");
			}
		}
		else
		{
			throw new Exception ("Database error");
		}
	}
	else 
	{
		throw new Exception ("Error");
	}
}

?>