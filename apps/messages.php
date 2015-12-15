<?php
	$messageManager = new MessageManager($db);
	try
	{
		$messages = $messageManager->findByIdProduct($_GET['id']);
	} 
	catch (Exception $e)
	{
		$messages = $e->getMessage();
	}

	if (is_string($messages))
	{
		echo $messages;
	}
	else
	{
		for($i = 0; $i < count($messages); $i++)
		{
		    $message = $messages[$i];
		    require('views/messages.phtml');
		}
	}	
?>