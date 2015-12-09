<?php 
	class Message
	{
		// Properties
		private $id;
		private $user;
		private $product;
		private $order;
		private $content;
		private $rate;

		// Constructors
		public function __construct($db)
		{
			$this->db = $db;
		}

		// Getters
		public function getId()
		{
			return $this->id;
		}
		public function getUser()
		{
			$id_user = intval($this->id_user);
			$query = 'SELECT * FROM user WHERE id ='.$id_user;
			$res = $this->db->query($query);

			if ($res && ($user = $res->fetchObject("User", array($this->db))))
			{
				$this->user = $user;
			}
			return $this->user;
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
		public function getContent()
		{
			return $this->content;
		}
		public function getRate()
		{
			return $this->rate;
		}

		// Setters
		public function setUser(User $user)
		{
			$this->user	= $user;
			$this->id_user = $user->getId();
			return true;
		}
		public function setProduct(Product $product)
		{
			$this->product = $product;
			$this->id_product = $product->getId();
			return true;
		}
		public function setOrder()
		{
			$id_product = intval($this->id_product);
			$query = "SELECT * FROM basket WHERE id_product =".$id_product;
			$res = $this->db->query($query);
			if($basket = $res->fetch(PDO::FETCH_ASSOC)) // + récente commande du produit ?
			{
				$id_order = intval($basket['id_order']);
				$query = "SELECT * FROM order WHERE id =".$id_order." AND status ='1'"; // Modif statut avec constante PAID
				$res = $this->db->query($query);
				if ($res && ($order = $res->fetchObject("Order", array($this->db))))
				{
					$this->order = $order;
					$this->id_order = $order->getId();
					return true;
				}
				else
				{
					throw new Exception("Only buyers can leave a comment");
				}
			}
			else
			{
				throw new Exception("Only buyers can leave a comment");
			}
		}
		public function setContent($content)
		{
			if (strlen($content) > 15 && strlen($content) < 2047)
			{
				$this->content = $content;
				return true;
			}
			else
			{
				throw new Exception('Content must be between 16 and 2046 characters');
			}
		}
		public function setRate($rate)
		{
			if (!is_nan($rate) && $rate >=0 && $rate <= 10)
			{
				$this->rate = $rate;
				return true;
			}
			else
			{
				throw new Exception('Rating must be between 0 and 10');
			}
		}
	}
?>