<?php
    require("./../../XuLy/conSQL.php");
    header("Content-type: text/html; charset=utf-8");
    session_start();

    if(isset($_POST['do']) && isset($_POST['userId']) )
    { 
        $do = $_POST['do'];
        $userId = $_POST['userId'];
    
        if($do == "authentication" && isset($_POST['authen']))
        {
            $authen = $_POST['authen'];
            if(isset($_POST['confirm']) && $_POST['confirm'] == "true") 
            {
                updateAuthentication($userId,$authen);
            }

            $myObj = new stdClass();
            $myObj->confirm = $_POST['confirm'];
            $myObj->authentication = authentication($userId);
            echo json_encode($myObj);
        }
        else if($do == "block" && isset($_POST['state']))
        {
            $state = $_POST['state'];
            blockUser($userId,$state);
            $myObj = new stdClass();
            $myObj->state = state($state);
            $myObj->stateBtn = stateBtn($userId,$state);
            $myObj->authentication = authentication($userId);
            echo json_encode($myObj);
        }
        else if($do == "resetPass")
        {
            resetPass($userId);
        }
        else if($do == "editUser")
        {
            $complete = false;
            $error = "";

            $userId = $_POST['userId'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $email = $_POST['email'];

            if(empty($firstName)){
                $error = " Vui lòng nhập họ";
            } 
            else if(!preg_match("/^[a-zA-Z _ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]{2,}+$/",$firstName))
            {
                $error = "Họ gồm 2 kí tự trở lên, không bao gồm kí tự đặc biệt";
            }
            else if(empty($lastName))
            {
                $error = "Vui lòng nhập tên";
            } 
            else if(!preg_match("/^[a-zA-Z _ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]{2,}+$/",$lastName))
            {
                $error = "Tên gồm 2 kí tự trở lên, không bao gồm kí tự đặc biệt";
            }
            
            else if(empty($email)){
                $error = "Vui lòng nhập email";
            } 
            else if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$email))
            {
                $error = "Vui lòng nhập email hợp lệ";
            }
            else if(mysqli_num_rows(conSQL::executeQuery('SELECT * FROM customer WHERE email="'.$email.'" AND userID NOT IN ("'.$userId.'")')))
            {
                $error = "Email đã đăng ký";
            }

            if(empty($error))
            {
                $complete = true;
                $sql = 'UPDATE customer SET firstName ="'.$firstName.'", lastName ="'.$lastName.'", email="'.$email.'" WHERE userID ="'.$userId.'"';
                conSQL :: executeQuery($sql);
                if(isset($_SESSION['user']) && $_SESSION['user']->userId == $userId)
                {
                    $_SESSION['user']->firstName = $firstName;
                    $_SESSION['user']->lastName = $lastName; 
                    $_SESSION['user']->email = $email;
    
                }
            }

            $error = '<div class="alert alert-danger" role="alert" data-aos="fade-left">
                         '.$error.'
                        </div>';

            $myObj = new stdClass();
            $myObj->complete = $complete;
            $myObj->error = $error;

            echo json_encode($myObj);

        }
        else if($do == "changePass")
        {
            $complete = false;
            $error = "";

            $userName = $_POST["userName"]; 
            $oldPass = $_POST["oldPass"];
            $newPass = $_POST["newPass"];
            $confirmPass = $_POST["confirmPass"];

            if(empty($oldPass)){
                $error = "Vui lòng nhập mật khẩu hiện tại";
            } 
            else 
            {
                $sql = "SELECT * FROM user WHERE userNAME='$userName' AND state ='1' " ;
                $result = conSQL::executeQuery($sql);
                while($row = mysqli_fetch_array($result))
                {
                    if(!password_verify($oldPass,$row["userPass"])) 
                    {
                        $error = "Sai mật khẩu hiện tại !!";
                    }
                    else if(empty($newPass))
                    {
                        $error = "Vui lòng nhập mật khẩu mới";
                    } 
                    else if(!preg_match("/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/",$newPass))
                    {
                            $error = "Vui lòng nhập mật khẩu hợp lệ, gồm 6 kí tự trở lên bao gồm chữ in hoa, chữ thường và số";
                    }
                    else if(empty($confirmPass)){
                        $error = "Vui lòng nhập mật khẩu nhập lại";
                    } 
                    else if(!($newPass === $confirmPass))
                    {
                        $error = "Mật khẩu nhập lại phải trùng với mật khẩu";
                    }
                }
            }

            
            
            if(empty($error))
            {
                $complete = true;
                $sql = 'UPDATE user SET userPass="'.password_hash($newPass,PASSWORD_DEFAULT).'" WHERE userName ="'.$userName.'"';
                conSQL :: executeQuery($sql);
            }

            $error = '<div class="alert alert-danger" role="alert" data-aos="fade-left">
                         '.$error.'
                        </div>';

            $myObj = new stdClass();
            $myObj->complete = $complete;
            $myObj->error = $error;

            echo json_encode($myObj);
        }
    }


    function blockUser($userId,$state)
    {
        $sql = "UPDATE user SET  user.state = $state WHERE userID = $userId";
        conSQL :: executeQuery($sql);
        // echo $sql;
    }

    function resetPass($userId)
    {
        $newPass = password_hash("123456789",PASSWORD_DEFAULT);
        $sql = "UPDATE user SET  user.userPass ='".$newPass."' WHERE userID = $userId";
        echo $sql;
        conSQL :: executeQuery($sql);
    }

    function state($state)
    {
        $rs ='<span class="role admin">disable</span>';
        if($state == 1 )
        {
            $rs ='<span class="role member">enable</span>';
        }
        return $rs;
    }

    

    function updateAuthentication($userId,$authen)
    {
        $sql = "UPDATE user SET  userAuthentication = $authen WHERE userID = $userId";
        conSQL :: executeQuery($sql);
    }    
    function authentication($userId)
    {
        $sql = "SELECT * FROM user WHERE userID ='$userId' ";
        $rs = conSQL :: executeQuery($sql);
        while($row = mysqli_fetch_array($rs))
        {
            $authen = $row['userAuthentication'];
        }

        $option = array("Admin","Sale","Customer");    
        $rs ='
                    <select class="js-select2-user" name="property">';
        foreach($option as $key => $s)
        {
            // $rs .= $key;
            if($key == $authen)
            {
                $rs.='<option value="'.$key.'" selected>'.$s.'</option>';
            }
            else{
                $rs.='<option value="'.$key.'">'.$s.'</option>';
            }
        }
        $rs.=       '</select>
                    <div class="dropDownSelect2"></div>';
        return $rs;
    }

    function stateBtn($userId,$state)
    {
        $rs='
            <button class="item block-user" data-toggle="tooltip" data-placement="top" title="" userid='.$userId.' state=1 data-original-title="Bỏ chặn">
                <i class="zmdi zmdi-check"></i>
            </button>';
        if($state == 1)
        {
            $rs='
            <button class="item block-user" data-toggle="tooltip" data-placement="top" title="" userid='.$userId.' state=0 data-original-title="Chặn">
                <i class="zmdi zmdi-block"></i>
            </button>';
        }   
        return $rs;
    }

    
?>