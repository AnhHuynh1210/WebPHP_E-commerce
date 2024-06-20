<?php
    include("./myClass.php");
    session_start();
    $quality = 0;
    if(isset($_POST['id']) &&  isset($_POST['quality']) && isset($_POST['min']) && isset($_POST['max']) && isset($_SESSION['id']) )
    {
        $id = $_POST['id'];
        $quality = $_POST['quality'];
        $min = $_POST['min'];
        $max = $_POST['max'];
        foreach($_SESSION['id'] as $item )
        {
            if($item->id == $id)
            {

                $checkQty = $item->quality + $quality;
                if($checkQty >= $min  && $checkQty <= $max) 
                {
                    $item->upQuality($quality);
                }
                echo $checkQty;
                exit;
            }
        }
    }

    
?>