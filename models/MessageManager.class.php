<?php 

	class MessageManager
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
		public function create(User $user, Product $product, Order $order, $content, $rate)
		{
			$message = new Message($this->db);
			$errors = array();
			$message -> setUser($user);
			$message -> setProduct($product);
			try
			{
				$message -> setOrder();
			}
			catch (Exception $e)
			{
				$errors[] = $e->getMessage();
			}
			try
			{
				$message -> setContent($content);
			}
			catch (Exception $e)
			{
				$errors[] = $e->getMessage();
			}
			try
			{
				$message -> setRate($rate);
			}
			catch (Exception $e)
			{
				$errors[] = $e->getMessage();
			}

			$errors = array_filter($errors, function($value)
			{
				return $value !== true;
			});
			if (count($errors) == 0)
			{
				$id_user = intval($message->getUser()->getId());
				$id_product = intval($message->getProduct()->getId());
				$id_order = intval($message->getOrder()->getId());
				$content = $this->db->quote($message->getContent());
				$rate = $this->db->quote($message->getRate());
				$query = 'INSERT INTO message (id_user, id_product, id_order, content, rate) VALUES ("'.$id_user.'","'.$id_product.'", "'.$id_order.'", '.$content.', '.$rate.')';
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
						throw new Exception('Internal server error');
					}
				}
			}
			else
			{
				return $errors;
			}
		}

		// Delete function
		public function delete(Message $message)
		{
			$id = $message->getId();
			$query = 'DELETE FROM message WHERE id = '.$id;
			$res = $this->db->exec($query);

			if ($res)
			{
				return true;
			}
			else
			{
				throw new Exception('Error 07 : Database error');
			}
		}

		// Read functions
		public function find($n)
		{			
			if (isset($n))
			{
				$n = intval($n);
				$query = '	SELECT * 
							FROM message 
							ORDER BY rate DESC 
							LIMIT '.$n;
			}
			else
			{
				$query = '	SELECT * 
							FROM message 
							ORDER BY rate DESC';
			}
			$res = $this->db->query($query);

			if ($res)
			{
				$messages = $res->fetchAll(PDO::FETCH_CLASS, "Message", array($this->db));
				if (count($messages) > 0)
				{
					return $messages;
				}
				else
				{
					throw new Exception('No message to show');
				}
			}
			else
			{
				throw new Exception('Error 01 : Database error');
			}
		}

		public function findByIdUser($id_user)
		{
			$id_user = intval($id_user);
			$query = 'SELECT * FROM message WHERE id_user = '.$id_user;
			$res = $this->db->query($query);

			if ($res)
			{
				if ($message = $res->fetchObject("Message", array($this->db)))
				{
					return $message;
				}
				else
				{
					throw new Exception('Message not found');
				}
			}
			else
			{
				throw new Exception('Error 02 : Database error');
			}
		}

		public function findByIdProduct($id_product)
		{
			$id_product = intval($id_product);
			$query = 'SELECT * FROM message WHERE id_product = '.$id_product;
			$res = $this->db->query($query);

			if ($res)
			{
				if ($message = $res->fetchObject("Message", array($this->db)))
				{
					return $message;
				}
				else
				{
					throw new Exception('Message not found');
				}
			}
			else
			{
				throw new Exception('Error 02 : Database error');
			}
		}

		public function findByIdOrder($id_order)
		{
			$id_order = intval($id_order);
			$query = 'SELECT * FROM message WHERE id_order = '.$id_order;
			$res = $this->db->query($query);

			if ($res)
			{
				if ($message = $res->fetchObject("Message", array($this->db)))
				{
					return $message;
				}
				else
				{
					throw new Exception('Message not found');
				}
			}
			else
			{
				throw new Exception('Error 02 : Database error');
			}
		}
	}
?>