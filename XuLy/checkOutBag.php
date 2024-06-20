<?php 
    include("./myClass.php");
    session_start();
    $checkOutBag = "";
    $total = 0;
    if(isset($_SESSION['id']))
    {
        if(!empty($_SESSION['id']))
        {
            $checkOutBag .='   <div class="table-reponsive">
                        <table class="table"> 
                        <caption>by ShellPhone</caption>
                            <thead>
                                <tr>
                                <th scope="col">Stt</th>
                                <th scope="col">Hỉnh ảnh</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Đơn giá</th>
                                <th scope="col">Số lượng</th>
                                </tr>
                        </thead>
                    <tbody>';
            foreach($_SESSION['id'] as $key => $item)
            {
                $checkOutBag .= '<tr>
                                <th scope="row">'.($key+1).'</th>
                                    <td><img src="./img/sanpham/'.$item->img.'" alt="" width="120"></td>
                                    <td>'.$item->name.'</td>
                                    <td>'.number_format($item->price,0,".",".").'</td>
                                    <td>
                                    <div class="input-group m-auto" style="width:13em">
                                        <div class="input-group-prepend">
                                            <button style="min-width: 2.5rem" class="btn btn-decinc btn-decrement btn-outline-secondary" min=1 max="'.$item->max.'" id="'.$item->id.'" quality="-1" type="button"><strong>-</strong></button>
                                        </div>
                                            <input type="number" class="form-control qty m-auto text-center" id="'.$item->id.'-quality" min=1 max="'.$item->max.'" value="'.$item->quality.'">
                                        <div class="input-group-append">
                                            <button style="min-width: 2.5rem" class="btn btn-decinc btn-increment btn-outline-secondary" min=1 max="'.$item->max.'" id="'.$item->id.'" quality="1" type="button"><strong>+</strong></button>
                                        </div>
                                    </div>
                                    </td>
                                    <td><input type="button" value="Xóa" class="product-remove" data="'.$item->id.'"></td>
                                </tr>
                            <tr>';
            }
            $checkOutBag .= '   </tbody></table></div>';
        }
        else{
            $checkOutBag .= '<div class="alert alert-danger" role="alert">
                            Không có sản phẩm trong giỏ !!
                        </div>';
        }
    }

    $myObj = new stdClass();
    $myObj->checkOutBag = $checkOutBag;

    echo json_encode($myObj);
?>