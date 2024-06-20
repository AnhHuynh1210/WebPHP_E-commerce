<?php
    session_start();
    $isLogin = false;
    if(isset($_SESSION['isLOGIN']) && $_SESSION['isLOGIN'] == 1 && ($_SESSION["AUTHENTICATION"] == 0 || $_SESSION["AUTHENTICATION"] == 1))
    {   
        $isLogin = true;
    }
    
    $myObj = new stdClass();
    $myObj->isLogin = $isLogin;
     
    echo json_encode($myObj);
?>