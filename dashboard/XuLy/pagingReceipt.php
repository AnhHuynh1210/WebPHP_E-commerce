<?php
    require("./../../XuLy/conSQL.php");
    $page="";

    $cetorgry="";
    $brand ="";
    $search="";
    $where="";
    $order = 1 ;

    $data = array();
    array_push($data,1);

    if(!empty($_POST['order']))
    {
        $order = $_POST['order'];
    }

    if(!empty($_POST['DescOrAsc']))
    {
        $order .= " ".$_POST['DescOrAsc'];
    }
    else
    {
        $order .= " DESC";
    }

    if(isset($_POST["page"]))
    {
        $page = $_POST["page"];
    }
    else{
        $page = 1;
    }


    // echo $order;
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

    $record_page = 7;

    $page_query = "SELECT * FROM receipt WHERE $where";
    // echo $page_query;
    $page_result = conSQL::executeQuery($page_query);
    $total_record = mysqli_num_rows($page_result); 
    $total_page = ceil($total_record/$record_page);


    $output = '';
    $start_form = ($page - 1)*$record_page;
    $query = "SELECT * FROM receipt WHERE $where ORDER BY $order LIMIT $start_form,$record_page";
    $result = conSQL::executeQuery($query);

    while($row = mysqli_fetch_array($result))
    {
        $state = $row['status'] == 1 ? 0 : 1;
        $output.='  <tr>
                        <td>'.$row['receiptID'].'</td>
                        <td>'.$row['firstName'].' '.$row['lastName'].'</td>
                        <td>'.$row['userName'].'</td>
                        <td>'.$row['address'].'</td>
                        <td>'.number_format($row['receiptTotal'],0,".",".").'</td>
                        <td id="'.$row['receiptID'].'-state">
                        '.receiptState($row['status']).'
                        </td>
                        <td>'.$row['receiptDate'].'</td>
                        <td>
                            <div class="table-data-feature">
                                <span class="mr-2" id="'.$row['receiptID'].'-progress-btn">
                                '.progressBTN($state,$row['receiptID']).'
                                </span>
                                <button id="'.$row['receiptID'].'-info" class="item info-receipt" data-toggle="tooltip" data-placement="top" title="" receiptid="'.$row['receiptID'].'" data-original-title="Chi tiết">
                                    <i class="zmdi zmdi-more"></i>
                                </button>
                            </div>
                        </td>
                    </tr>';
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
    $paging .=' <ul class="pagination justify-content-center mt-50 mb-70">
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
    $paging .='<li class="page-item" id="'.$next.'"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li></ul>';

    $myobj = new \stdClass();
    $myobj->output = $output;
    $myobj->total = $total_page;
    $myobj->paging = $paging;
    $myobj->sql = $page_query;

    echo json_encode($myobj);

    function progressBTN($state,$receiptId)
    {
        $out ='';
        if($state == 1)
        {
            $out ='
            <button class="item progress-receipt" data-toggle="tooltip" data-placement="top" title="" state="'.$state.'" receiptid="'.$receiptId.'" data-original-title="Xử lý dơn hàng">
                <i class="zmdi zmdi-mail-send"></i>
            </button>';
        }
        return $out;
    }

    function receiptState($state)
    {
        $out = '<span class="status--denied">Đang xử lý</span>';
        if($state == 1)
        {
            $out = '<span class="status--process">Đã xử lý</span>';
        }
        return $out;
    }
?>