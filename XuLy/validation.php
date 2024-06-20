<?php
require("conSQL.php");
session_start();

$isRegister = false;
$error = array();

$firstNameError = "";
$lastNameError = "";
$userError = "";
$emailError = "";
$pswdError = "";
$confirmpswdError = "";

if(isset($_POST['info'])){
$firstName  = GetParameter($_POST['info'],"firstName");
$firstName = urldecode($firstName);
$lastName  = GetParameter($_POST['info'],"lastName");
$lastName = urldecode($lastName);
$userName = GetParameter($_POST['info'],"user");
$email  = GetParameter($_POST['info'],"email");
$email = urldecode($email);
$password  = GetParameter($_POST['info'],"password");
$confirmpassword  = GetParameter($_POST['info'],"confirmpassword");

	if(empty($firstName)){
		$firstNameError = " Vui lòng nhập họ";
	} else{
		if(!preg_match("/^[a-zA-Z _ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]{2,}+$/",$firstName)){
			$firstNameError = "Họ gồm 2 kí tự trở lên, không bao gồm kí tự đặc biệt";
		}
	}
	
	if(empty($lastName)){
		$lastNameError = "Vui lòng nhập tên";
	} else{
		if(!preg_match("/^[a-zA-Z _ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ]{2,}+$/",$lastName)){
			$lastNameError = "Tên gồm 2 kí tự trở lên, không bao gồm kí tự đặc biệt";
		}
	}
	
	if(empty($userName)){
		$userError = "Vui lòng nhập tên đăng nhập";
	} else{
		$rs = conSQL :: executeQuery("SELECT * FROM user WHERE userName='$userName' ");
		if(!preg_match("/^[A-Za-z0-9]{5,32}$/",$userName)){
			$userError = "Tên đăng nhập gồm 5 kí tự trở lên, không bao gồm kí tự đặc biệt";
		}
		else if(mysqli_num_rows($rs))
		{
			$userError = "Tên đăng nhập đã tồn tại";
		}
	}
	
	if(empty($email)){
		$emailError = "Vui lòng nhập email";
	} else{
		$rs = conSQL :: executeQuery("SELECT * FROM customer WHERE email='$email' ");
		if(!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/",$email)){
			$emailError = "Vui lòng nhập email hợp lệ";
		}
		else if(mysqli_num_rows($rs))
		{
			$emailError = "Email đã đăng ký";
		}
	}
	
	//\S là Tập không chứa bất kỳ ký tự trắng
	if(empty($password)){
		$pswdError = "Vui lòng nhập mật khẩu";
	} else{
		if(!preg_match("/^((?=\S*?[A-Z])(?=\S*?[a-z])(?=\S*?[0-9]).{6,})\S$/",$password)){
			$pswdError = "Vui lòng nhập mật khẩu hợp lệ, gồm 6 kí tự trở lên bao gồm chữ in hoa, chữ thường và số";
		}
	}
	
	if(empty($confirmpassword)){
		$confirmpswdError = "Vui lòng nhập mật khẩu nhập lại";
	} else{
		if(!($password === $confirmpassword)){
			$confirmpswdError = "Mật khẩu nhập lại phải trùng với mật khẩu";
		}
	}
}
	//vd: firstName=Nguyễn Văn&lastName=A&......
    function GetParameter($string,$sParam) {
        $sVariables = explode("&",$string);		//Tách chuỗi thành một mảng, dựa trên “ký tự chỉ định”
        for ($i = 0; $i < count($sVariables); $i++){
            $sParameterName = explode("=",$sVariables[$i]);
            if ($sParameterName[0] == $sParam)
            {
                return $sParameterName[1];
            }
        }
    }
	function test_input($data) {
		$data = trim($data);				//Xóa những ký tự có tên trong danh sách ký tự do bạn chỉ định ra khỏi vị trí đầu tiên và cuối cùng của chuỗi
		$data = stripslashes($data);		//Loại bỏ các dấu gạch chéo ngược (\)	
		$data = htmlspecialchars($data);	//Chuyển đổi các ký tự " ' < > & bên trong chuỗi sang dạng “ký tự thực thể HTML”
		return $data;
	}

	function isArrayEmpty($error)
	{
		foreach ($error as $s)
		{
			if(!empty($s))
			{
				return false;
			}
		}
		return true;
	}

	function getID($id)
	{
		return "00".$id;
	}

	array_push($error,$firstNameError);
	array_push($error,$lastNameError);
	array_push($error,$userError);
	array_push($error,$emailError);
	array_push($error,$pswdError);
	array_push($error,$confirmpswdError);

	if(isArrayEmpty($error))
	{
		$isRegister = true;
		$result = conSQL :: executeQuery("SELECT * FROM customer");
		$id = mysqli_num_rows($result);
		$userId = getID($id+1);
		$pass = password_hash($password , PASSWORD_DEFAULT);//mã hóa pass
		//$pass = $password;

		$sql1 = 'INSERT INTO `customer` VALUES ("'.$userId.'","'.$firstName.'","'.$lastName.'","'.$email.'")';
		conSQL :: executeQuery($sql1);

		$sql2 = 'INSERT INTO `user` VALUES ("'.$userId.'","'.$userName.'","'.$pass.'","2","1")';
		conSQL :: executeQuery($sql2);
	
		if($_POST['toLogin'] == 1)
		{
			$customer = new stdClass();
			$customer->userId = $userId; 
			$customer->userName = $userName; 
			$customer->firstName = $firstName; 
			$customer->lastName = $lastName; 
			$customer->email = $email;

			$_SESSION["isLOGIN"] = 1;
			$_SESSION["user"] = $customer;
			$_SESSION["AUTHENTICATION"] = 2;
		}
	}
	$myObj = new stdClass();
	$myObj->isRegister = $isRegister;
	$myObj->error = $error;

	echo json_encode($myObj);
?>
