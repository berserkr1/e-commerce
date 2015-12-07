<?php
$titre = "Ecommerce";
         /*   LANCEMENT PAGE SPECIAL AJAX*/
if (isset($_GET['ajax']))
{
    require('apps/***.php');
} else{
require('views/skel.phtml');
}
?>