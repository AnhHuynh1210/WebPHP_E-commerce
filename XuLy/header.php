<?php
    $user = " ";
    if(isset($_SESSION["isLOGIN"]) && $_SESSION["isLOGIN"] == "1")
    {
        $customer = $_SESSION['user'];
        $user = $customer->userName;
        $user = '<div class="user-login-info" data-toggle="modal" data-target="#logout">
                <a style="width:12em;"> Chào,'.$customer->userName.' </a>
                </div>';
    }
    else
    {
        
        $user = '<div class="user-login-info" data-toggle="modal" data-target="#login">
                <a href="#"><img src="img/core-img/user.svg" alt=""></a>
                </div>';
    }

    $userInfo = " ";
    if(isset($_SESSION['isLOGIN']) && $_SESSION["isLOGIN"] == 1)
    {
        $customer = $_SESSION['user'];
        $userInfo =   '<div class="mb-1"><strong> Họ và tên :</strong> '.$customer->firstName.' '.$customer->lastName.'</div><br>'.
                    '<div class="mb-1"><strong> Email :</strong> '.$customer->email.'</div><br>';   
    }
    
    $output = new stdClass();
    $output->user = $user;
    $output->userInfo = $userInfo;

    return $output;
?>