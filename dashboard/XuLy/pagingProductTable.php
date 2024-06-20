<?php
    require("./../../XuLy/conSQL.php");
    $page="";

    $cetorgry="";
    $brand ="";
    $search="";
    $where="";

    $data = array();
    array_push($data,1);

    if(isset($_POST["page"]))
    {
        $page = $_POST["page"];
    }
    else{
        $page = 1;
    }

    if(isset($_POST["cetorgry"]))
    {
        if($_POST['cetorgry'] != "")
        {
            $cetorgry = 'productCetorgry="'.$_POST["cetorgry"].'"';
            array_push($data,$cetorgry);
        }
    }

    if(isset($_POST["brand"]))
    {
        if($_POST['brand'] != "")
        {
            $brand = 'productBrand="'.$_POST["brand"].'"';
            array_push($data,$brand);
        }
    }

    if(isset($_POST["search"]))
    {
        if($_POST['search'] != "")
        {
            $search = 'productName LIKE "'.$_POST["search"].'%"';
            array_push($data,$search);
        }
    }

    foreach ($data as $i => $s)
    {
        if($i+1 == count($data))
        {
            $where .= $s ;
        }
        else
        {
            $where .= $s." AND ";
        }
    }

    $record_page = 5;

    $page_query = "SELECT * FROM product WHERE $where";
    // echo $page_query;
    $page_result = conSQL::executeQuery($page_query);
    $total_record = mysqli_num_rows($page_result); 
    $total_page = ceil($total_record/$record_page);


    $output = '';
    $start_form = ($page - 1)*$record_page;
    $query = "SELECT * FROM product,cetorgry,brand WHERE $where AND productCetorgry = cetorgryID AND productBrand=brandID LIMIT $start_form,$record_page";
    $result = conSQL::executeQuery($query);

    while($row = mysqli_fetch_array($result))
    {
        $state = $row['state'] == 1 ? 0 : 1;
        $output .=' <tr class="tr-shadow">
                        <td>'.$row['productID'].'</td>
                        <td class="desc">'.$row['productName'].'</td>
                        <td>'.$row['cetorgryName'].'</td>
                        <td>'.$row['brandName'].'</td>
                        <td>'.$row['productAmount'].'</td>
                        <td>'.number_format($row['productPrice'],0,".",".").'</td>
                        <td id="'.$row['productID'].'-state">
                            '.productStatus($row['state']).'
                        </td>
                        <td>
                            <div class="table-data-feature">
                                <button productid="'.$row['productID'].'" class="item edit-product" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit">
                                    <i class="zmdi zmdi-edit"></i>
                                </button>
                                <button id="'.$row['productID'].'-block" class="item block-product" data-toggle="tooltip" state="'.$state.'" data-placement="top" title="" productid="'.$row['productID'].'" data-original-title="Delete">
                                    '.stateIcon($state).'
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr class="spacer"></tr>';
}
    $prev = $page - 1;
    $next = $page + 1;

    if($page == 1)
    {
        $prev = $page;
    }
    if($page == $total_page)
    {
        $next = $page;
    }  
    $paging = "";
    $paging .='     <ul class="pagination justify-content-center mt-50 mb-70">
                        <li class="page-item" id="1"><a class="page-link" href="#">Đầu</a></li>
                        <li class="page-item" id="'.$prev.'"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>';



    for($i = 1 ; $i <= $total_page ; $i++)
    {
        if($i == $page)
        {
            $paging .= '<li class="page-item active" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
        }
        else
        {
            $paging .= '<li class="page-item" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
        }
    }
    $paging .='<li class="page-item" id="'.$next.'"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                <li class="page-item" id="'.$total_page.'"><a class="page-link" href="#">Cuối</a></li>
                </ul>';

    $myobj = new \stdClass();
    $myobj->output = $output;
    $myobj->total = $total_page;
    $myobj->paging = $paging;
    $myobj->sql = $page_query;

    echo json_encode($myobj);

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