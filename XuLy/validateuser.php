<?php
    require('../XuLy/conSQL.php');
    session_start();

    $isAdmin = "";    
    if(isset($_POST['isAdmin']))
    {
        $isAdmin = "AND userAuthentication = '0' OR userAuthentication = '1' ";
    }

    $myObj = new stdClass();
    $islogin = true;
    $loginSuccess = false;
    $output ="";
    $error = ' <div class="alert alert-danger" role="alert" data-aos="fade-left">
                    Sai tài khoản hoặc mật khẩu !!!
                </div>';
    $user ="";
    $userInfo="";    
    
    $firstName="";
    $lastName="";
    $email="";
    $authen="";

    if(isset($_SESSION["isLOGIN"]) && $_SESSION["isLOGIN"] == 1)
    {
        logout();
        $islogin = false;
        $output = include("./header.php");
        $user = $output->user;
        $userInfo = $output->userInfo;
    }
    else
    {
        $username = $_POST['username'];
        $pass = $_POST['password'];

        $sql = "SELECT * FROM user,customer WHERE userNAME='$username' AND user.userID = customer.userID AND state ='1' $isAdmin " ;
        $result = conSQL::executeQuery($sql);
        while($row = mysqli_fetch_array($result))
        {
            if(password_verify($pass,$row["userPass"]))
			//if($pass==$row["userPass"]) 
            { 
                $customer = new stdClass();
                $customer->userId = $row['userID']; 
                $customer->userName = $row['userName']; 
                $customer->firstName = $row['firstName']; 
                $customer->lastName = $row["lastName"]; 
                $customer->email = $row["email"];

                $authen = $row["userAuthentication"];
                $loginSuccess = true;
                $islogin = true;
                $_SESSION["isLOGIN"] = 1;
                $_SESSION["user"] = $customer;
                $_SESSION["AUTHENTICATION"] = $authen;
                $output = include("./header.php");
                $user = $output->user;
                $userInfo = $output->userInfo;
            }
        }
    }
    $myObj->islogin = $islogin;
    $myObj->login = $loginSuccess;
    $myObj->user =  $user;
    $myObj->userInfo = $userInfo;
    $myObj->error = $error;
    $myObj->authen = $authen;
    
    echo json_encode($myObj);

    function logout()
    {
        unset($_SESSION["user"]);
        unset($_SESSION["AUTHENTICATION"]);
        $_SESSION['isLOGIN'] = 0;
    }
?>