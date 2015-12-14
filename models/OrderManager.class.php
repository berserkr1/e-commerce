<?php 

	class OrderManager
	{

		// Properties
		private $db;

		
		// Constructors
		public function __construct($db)
		{
			$this -> db = $db;
		}


		// Functions


		// Create function
		public function create(User $user)
		{
			$order = new Order($this->db);
			$errors = array();
			$order -> setUser($user);
			$id_user = $order->getUser()->getId();
			$query = 'INSERT INTO order (id_user,amount,status) VALUES ("'.$id_user.'","0","'.STATUS_UNPAID.'")';
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
					$errors[] = 'Order not found';
					return $errors;
				}
			}
			else
			{
				$errors[] = 'Internal server error';
				return $errors;
			}
		}

		// Update functions
		public function update_paid(User $user, $date_paid)
		{
			// Amount à définir
			$id_user = $user->getId();
			$query = "UPDATE order SET date_paid ='".$date_paid."', amount ='', status ='".STATUS_PAID."' WHERE id_user='".$id_user."' AND status ='".STATUS_UNPAID."'";
			$res = $this->db->exec($query);
			if ($res)
			{
				return true;
			}
			else
			{
				throw new Exception("Database error");
			}
		}

		public function update_ship(User $user, $date_ship)
		{
			$id_user = $user->getId();
			$query = "UPDATE order SET date_ship ='".$date_ship."' WHERE id_user ='".$id_user."'";
			$res = $this->db->exec($query);
			if ($res)
			{
				return true;
			}
			else
			{
				throw new Exception("Database error");
			}
		}

		// Delete function
		// public function delete(Order $order)
		// {
		// 	$id = $order->getId();
		// 	$query = 'DELETE FROM order WHERE id = '.$id;
		// 	$res = $this->db->exec($query);

		// 	if ($res)
		// 	{
		// 		return true;
		// 	}
		// 	else
		// 	{
		// 		throw new Exception('Error 07 : Database error');
		// 	}
		// }

		// Read functions
		public function find($n = 0)
		{			
			if ($n > 0)
			{
				$n = intval($n);
				$query = '	SELECT *
							FROM order 
							ORDER BY date_paid DESC 
							LIMIT '.$n;
			}
			else
			{
				$query = '	SELECT * 
							FROM order 
							ORDER BY date_paid DESC';
			}
			$res = $this->db->query($query);

			if ($res)
			{
				$orders = $res->fetchAll(PDO::FETCH_CLASS, "Order", array($this->db));
				if (count($orders) > 0)
				{
					return $orders;
				}
				else
				{
					throw new Exception('No order to show');
				}
			}
			else
			{
				throw new Exception('Error 01 : Database error');
			}
		}

		public function findById($id)
		{
			$id = intval($id);
			$query = 'SELECT * FROM order WHERE id = '.$id;
			$res = $this->db->query($query);

			if ($res)
			{
				if ($order = $res->fetchObject("Order", array($this->db)))
				{
					return $order;
				}
				else
				{
					throw new Exception('Order not found');
				}
			}
			else
			{
				throw new Exception('Error 02 : Database error');
			}
		}

		public function findByIdUser($id_user)
		{
			$id_user = intval($id_user);
			$query = 'SELECT * FROM order WHERE id_user = '.$id_user;
			$res = $this->db->query($query);

			if ($res)
			{
				if ($order = $res->fetchObject("Order", array($this->db)))
				{
					return $order;
				}
				else
				{
					throw new Exception('Order not found');
				}
			}
			else
			{
				throw new Exception('Error 02 : Database error');
			}
		}
	}
?>