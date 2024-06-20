<?php
    require('./../../XuLy/conSQL.php');    

    $complete = false;
    $error = "";

    $productId="";
    $productName="";
    $productCetorgry="";
    $productBrand="";
    $productPrice="";
    $productAmount="";
    $productDescription="";
    $img="";

    if($_POST)
    {
        $do = $_POST['do'];
        $productId = $_POST['id'];
        $productName = $_POST['name'];
        $productCetorgry = $_POST['category'];
        $productBrand = $_POST['brand'];
        $productPrice = $_POST['price'];
        $productAmount = $_POST['amount'];
        $productDescription = $_POST['description'];

        if(empty($productId)){
            $error = " Vui lòng nhập mã sản phẩm";
        } 
        else if(empty($productName))
        {
            $error = "Vui lòng tên sản phẩm";
        } 
        else if(!preg_match("/^[a-zA-Z _ÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂưăạảấầẩẫậắằẳẵặẹẻẽềềểỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễệỉịọỏốồổỗộớờởỡợụủứừỬỮỰỲỴÝỶỸửữựỳỵỷỹ 0-9]{1,}+$/",$productName))
        {
            $error = "Tên sản không có kí tự đặc biệt";
        }
        else if(empty($productPrice))
        {
            $error = "Vui lòng nhập giá sản phẩm";
        } 
        else if(empty($productAmount))
        {
            $error = "Vui lòng điển số lượng";
        } 
        else if (isset($_FILES['image']))
        {
            if ($_FILES['image']['error'] > 0)
            {
                $img ="noImage.png";
            }
            else{
                $file_extensions = strtolower(pathinfo($_FILES['image']['name'],PATHINFO_EXTENSION));
                $imgName = $productId.".".$file_extensions;
                move_uploaded_file($_FILES['image']['tmp_name'], './../../img/sanpham/'.$imgName);
                $img=$imgName;
            }
        }

        $productDescription = preg_replace("/[\n\r]/","%",$productDescription); 
        
        if(empty($error))
        {
            $complete = true;
            $sql='INSERT INTO product VALUES ("'.$productId.'" , "'.$productName.'" , "'.$productDescription.'" , "'.$productPrice.'" ,"'.$productAmount.'" ,"'.$productCetorgry.'" ,"'.$productBrand.'","'.$img.'",1)';
            // echo $sql;
            if($do == 'edit')
            {
                $updateImg = "";
                if($img != 'noImage.png')
                {
                    $updateImg = ',IMG="'.$img.'"';
                }    
                $sql = 'UPDATE product SET 
                        productName="'.$productName.'",
                        productDescription="'.$productDescription.'",
                        productPrice="'.$productPrice.'",
                        productAmount="'.$productAmount.'",
                        productCetorgry="'.$productCetorgry.'",
                        productBrand="'.$productBrand.'"
                        '.$updateImg.'
                        WHERE productID="'.$productId.'" ';
            }
            conSQL :: executeQuery($sql);
        }
    }
            
            
            
    $error = '<div class="alert alert-danger" role="alert" data-aos="fade-left">'.$error.'</div>';
            
            
            
    $myObj = new stdClass();
    $myObj->complete1 = $error;
    $myObj->complete = $complete;
    $myObj->error = $error;
    echo json_encode($myObj);
    

    ?>