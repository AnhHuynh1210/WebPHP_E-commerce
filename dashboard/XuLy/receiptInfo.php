<?php
    require("./../../XuLy/conSQL.php");
    
    $receiptId ="";
    $id = "";
    $user = "";
    $name = "";
    $country = "";
    $address = "";
    $phone = "";
    $product ="";
    $description ="";
    $total ="";
    
    if($_POST)
    {
        $receiptId = $_POST['receiptId'];
        $sql1 ='SELECT * FROM receipt WHERE receiptID = '.$receiptId.'';
        $rs1 = conSQL :: executeQuery($sql1);
        while($row = mysqli_fetch_array($rs1))
        {
            $id = $row['receiptID'];
            $user = $row['userName'];
            $name = $row['firstName']." ".$row['lastName'];
            $country = $row['country'];
            $address = $row['address'];
            $phone = $row['phone'];
            $description = $row['description'];
            $total = $row['receiptTotal'];
        }

        $sql2 ='SELECT * FROM receiptdetail WHERE receiptID = '.$receiptId.'';
        $rs2 = conSQL :: executeQuery($sql2);
        while($row = mysqli_fetch_array($rs2))
        {
            $product .='<li> 
                        '.$row['productName'].'&emsp;X&emsp;'.$row['quality'].'	
                        </li>';
        }

    }

    $myReceipt = new stdClass();
    $myReceipt->id = $id;
    $myReceipt->user = $user;
    $myReceipt->name = $name;
    $myReceipt->country = $country;
    $myReceipt->address = $address;
    $myReceipt->phone = $phone;
    $myReceipt->product = $product;
    $myReceipt->total = number_format($total,0,".",".")."đ";
    $myReceipt->description = $description;

    echo json_encode($myReceipt);
?>