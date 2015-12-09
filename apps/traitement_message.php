<?php
    $content=$rate="";
	if (isset($_POST['content'], $_POST['rate'])) 
	{
        $content = $_POST['create_message'];
        $messageManager = new MessageManager($db);

        $topicManager = new TopicManager($db);
        $topic = $topicManager->readByID(intval($_GET['id']));
        $res = $messageManager->create($currentUser, $topic, $_POST['create_message']);
        if(is_array($res))
        {
            $errors = $res;
            return $errors;
        }
        elseif(is_string($res))
        {
            $errors[] = $res;
        }
        else
        {
            $_SESSION['success'] = "Message posté avec succès :)";
            header('Location: ?page=topic&id='.$res->getTopic()->getId());
            exit;
        }
	}
?>