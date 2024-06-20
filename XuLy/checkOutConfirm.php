<?php
    include("./myClass.php");
    require("./conSQL.php");
    session_start();
    $isLogin = false;
    $isBagEmpty = true;
    $isAddressError = true;
    $error='';

    $userName = $_POST['userName'];
    $userId = $_POST['userId'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $country = $_POST['country'];
    $street_address = $_POST['street_address'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $description = $_POST['description'];

    $receiptSQL="";
    $receiptDetailSQL=array();
    $result="";
    
    if(isset($_SESSION['isLOGIN']) && $_SESSION['isLOGIN'] == 1)
    {
        $isLogin = true;
    }
    if(isset($_SESSION['id']) && !empty($_SESSION['id']))
    {
        $isBagEmpty = false;
    }

    // Kiểm tra địa chỉ đơn hàng
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
    else if(empty($street_address)){
        $error = "Vui lòng nhập địa chỉ";
    }   
    else if(empty($phone)){
        $error = "Vui lòng số điện thoại ";
    }   
    else if(empty($email)){
        $error = "Vui lòng nhập email";
    } 
    else if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$email))
    {
        $error = "Vui lòng nhập email hợp lệ";
    }

    if(empty($error))
    {
        $isAddressError = false;
    }

    if($isLogin == true
        && $isBagEmpty == false
        && $isAddressError == false)
    {
        $id = IdMax();
        $total = 0;
        foreach($_SESSION['id'] as $key => $item)
        {
            $total += $item->price*$item->quality;
            $SQL ='INSERT INTO receiptdetail VALUES ("'.$id.'","'.$item->id.'","'.$item->name.'",'.$item->quality.','.$item->price.','.($item->price*$item->quality).')';
            array_push($receiptDetailSQL,$SQL);
        }
        
        $receiptSQL='INSERT INTO receipt VALUES ("'.$id.'","'.$userName.'","'.$firstName.'","'.$lastName.'","'.$country.'","'.$street_address.'",
                                                    "'.$phone.'","'.$email.'","'.$description.'",'.$total.',"'.date("Y-m-d H:i:s").'","0")';
        conSQL :: executeQuery($receiptSQL);
        
        foreach($receiptDetailSQL as $s)
        {
            conSQL :: executeQuery($s);
            $result = $s;
        }
        unset($_SESSION['id']);

    }

    $error = '<div class="alert alert-danger" role="alert" data-aos="fade-left">
                    '.$error.'
                </div>';

    $myObj = new stdClass();
    $myObj->isLogin = $isLogin;
    $myObj->isBagEmpty = $isBagEmpty;
    $myObj->isAddressError = $isAddressError;
    $myObj->error = $error;
    $myObj->sql = $result;

    echo json_encode($myObj);

    function IdMax()
    {
        $sql = 'SELECT receiptID FROM receipt';
        $rs = conSQL :: executeQuery($sql);
        $id = 0;
        while($row = mysqli_fetch_array($rs))
        {
            if($row['receiptID'] > $id)
            {
                $id = $row['receiptID'];
            } 
        }
        return $id+1;
    }
?>