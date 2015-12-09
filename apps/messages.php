<?php
	$messageManager = new MessageManager($db);
	$messages = $messageManager->findByIdProduct($_GET['id']);

	for($i = 0; $i < count($messages); $i++)
	{
	    $message = $messages[$i];
	    require('views/messages.phtml');
	}
?>