<?php
	class BasketManager
	{
		private $db;

		public function __construct($db)
		{
			$this->db = $db;
		}

	public function create(User $user, Product $product)
	{
		if ( isset($_SESSION['id']) )
		{
			//----------
			$orderManager = new OrderManager($this->db);
			$order  = $orderManager->create($user);
			//----------
			$id_product = intval($product->getId());
			$query = "INSERT INTO basket (id_product,quantity) VALUES ('".$id_product."','1')";
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
			throw new Exception ("You must be logged in to purchase");
		}
	}
?>