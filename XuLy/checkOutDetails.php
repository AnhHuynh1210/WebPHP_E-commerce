<?php 
    include("./myClass.php");
    session_start();
    $checkOutDetails ='<li style="font-weight:bold;"><span>Sản phẩm</span> <span>Tổng tiền</span></li>';                   
    $total = 0;
    if(isset($_SESSION['id']))
    {
        if(!empty($_SESSION['id']))
        {
            foreach($_SESSION['id'] as $key => $item)
            {
                $total += $item->price*$item->quality;
                $checkOutDetails .='<li><span>'.$item->name.'</span> <span class="'.$item->id.'-total" >'.number_format($item->price*$item->quality,0,".",".").'đ</span></li>';
            }
            $checkOutDetails .='
                                 <li style="font-weight:bold;" ><span>Shipping</span> <span>Free</span></li>
                                 <li style="font-weight:bold;" ><span>Tổng tiền</span> <span>'.number_format($total,0,".",".").'đ</span></li>';
        }
    }

    $myObj = new stdClass();
    $myObj->checkOutDetails = $checkOutDetails;

    echo json_encode($myObj);
?>