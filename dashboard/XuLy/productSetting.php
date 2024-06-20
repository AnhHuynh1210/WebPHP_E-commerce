<?php
    require("./../../XuLy/conSQL.php");
    // header("Content-type: text/html; charset=utf-8");
    session_start();
    if(isset($_POST['do']) && isset($_POST['productId']) )
    { 
        $do = $_POST['do'];
        $productId = $_POST['productId'];
        if($do == "block")
        {
            $state = $_POST['state'];
            blockProduct($productId,$state);
            
            $myObj = new stdClass();
            $myObj->state = productStatus($state);
            $myObj->isBlock = $state == 1?0:1;
            $myObj->btnIcon = stateIcon($state == 1?0:1);

            echo json_encode($myObj);
        }
    }

    function blockProduct($productId,$state)
    {
        $sql = "UPDATE product SET  state = $state WHERE productID = $productId";
        conSQL :: executeQuery($sql);
        // echo $sql;
    }

    function productStatus($status)
    {
        $out='<span class="status--denied">Tạm ngưng</span>';
        if($status == 1)
        {
            $out='<span class="status--process">Đang bán</span>';
            return $out;
        }
        return $out;
    }

    function stateIcon($state)
    {
        $out ='<i class="zmdi zmdi-delete"></i>';
        if($state == 1)
        {
            $out ='<i class="zmdi zmdi-check"></i>';
            return $out;
        }
        return $out;
    }
?>
