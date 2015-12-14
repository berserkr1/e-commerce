<?php 
	class Basket
	{
		private $id;
		private $id_order;
		private $id_product;
		private $quantity;

		public function __construct($db)
		{
			$this->db = $db;
		}

		public function getId()
		{
			return $this->id;
		}
		public function getOrder()
		{
			$id_order = intval($this->id_order);
			$query = 'SELECT * FROM order WHERE id ='.$id_order;
			$res = $this->db->query($query);

			if ($res && ($order = $res->fetchObject("Order", array($this->db))))
			{
				$this->order = $order;
			}
			return $this->order;
		}
		public function getProduct()
		{
			$id_product = intval($this->id_product);
			$query = 'SELECT * FROM product WHERE id ='.$id_product;
			$res = $this->db->query($query);

			if ($res && ($product = $res->fetchObject("Product", array($this->db))))
			{
				$this->product = $product;
			}
			return $this->product;
		}
		public function getQuantity()
		{
			return $this->quantity;
		}

		public function setOrder(Order $order)
		{
			$this->order = $order;
			$this->id_order = $order->getId();
			return true;
		}
		public function setProduct(Product $product)
		{
			$this->product = $product;
			$this->id_product = $product->getId();
			return true;
		}
		public function setQuantity()
		{
			$this->quantity = $quantity;
			return true;
		}
	}
?>