<?php
    include("./myClass.php");
    session_start();
    for($i = 0 ; $i < count($_SESSION['id']) ; $i++)
    {
        if($_POST["id"] == $_SESSION['id'][$i]->id)
        {
            unset($_SESSION['id'][$i]);
            $_SESSION['id'] = array_values($_SESSION['id']);
        }

        // echo $item->id;
    }

    include("cartBag.php");
?>