<?php
    $content=$rate="";
	if (isset($_POST['content'], $_POST['rate'])) 
	{
        $productManager = new ProductManager($db);
        try
        {
            $retour = $productManager->findById($_GET['id']);
        }
        catch (Exception $e)
        {
            $retour = $e->getMessage();
        }
        if (is_string($retour))
        {
            $errors[] = $retour;
        }
        else
        {
            $retour = $product;
            $messageManager = new MessageManager($db);
            $retour = $messageManager->create($currentUser, $product, $_POST['content'], $_POST['rate']);
            if(is_array($retour))
            {
                $errors = $retour;
                $content = $_POST['content'];
            }
            else
            {
                $_SESSION['success'] = "Your opinion has been posted";
                header('Location: ?page=product&id='.$product->getId());
                exit;
            }
        }
	}
?>