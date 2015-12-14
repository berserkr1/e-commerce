<?php 
	class Order
	{
		private $id;
		private $id_user;
		private $date_paid;
		private $date_ship;
		private $amount;
		private $status;

		public function __construct($db);
		{
			$this->db = $db;
		}

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
		public function getDatePaid()
		{
			return $this->date_paid;
		}
		public function getDateShip()
		{
			return $this->date_ship;
		}
		public function getAmount()
		{
			return $this->amount;
		}
		public function getStatus()
		{
			return $this->status;
		}

		public function setUser(User $user)
		{
			$this->user	= $user;
			$this->id_user = $user->getId();
			return true;
		}
		public function setDatePaid($date_paid)
		{
			// Conversion format date à faire
			$this->date_paid = $date_paid;
			return true;
		}
		public function setDateShip($date_ship)
		{
			// Conversion format date à faire
			$this->date_ship = $date_ship;
			return true;
		}
		public function setAmount()
		{
			$id_order = $this->id;
			$query = "SELECT * FROM basket WHERE id_order=".$id_order;
			$res = $this->db->query($query);
			if ($res)
			{
				$basket = $res->fetchAll();
				$amount=0;
				for ($i=0;$i<count($basket);$i++)
				{
					$query = "SELECT * FROM product WHERE id =".$basket[$i]['id'];
					$res = $this->db->query($query);
					if ($res)
					{
						$product = $res->fetchObject("Product", array($this->db));
						$amount+= floatval($product->getPrice())*$basket[$i]['quantity'];
					}
				}
				else
				{
					throw new Exception("Database error");
				}
				$this->amount = $amount;
				return true;
			}
			else
			{
				throw new Exception("Database error");
			}
		}
		public function setStatus($status)
		{
			$this->status = $status;
			return true;
		}
	}
?>