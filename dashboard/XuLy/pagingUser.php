<?php
    require("./../../XuLy/conSQL.php");
    $page="";

    $search="";
    $where="";

    $data = array();
    array_push($data,1);
    array_push($data,'user.userID = customer.userID');

    if(isset($_POST["page"]))
    {
        $page = $_POST["page"];
    }
    else{
        $page = 1;
    }

    if(isset($_POST["search"]))
    {
        if($_POST['search'] != "")
        {
            $search = 'userName LIKE "'.$_POST["search"].'%"';
            array_push($data,$search);
        }
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

    $record_page = 6;

    $page_query = "SELECT * FROM user,customer WHERE $where";
    // echo $page_query;
    $page_result = conSQL::executeQuery($page_query);
    $total_record = mysqli_num_rows($page_result); 
    $total_page = ceil($total_record/$record_page);


    $output = '';
    $start_form = ($page - 1)*$record_page;
    $query = "SELECT * FROM user,customer WHERE $where LIMIT $start_form,$record_page";
    $result = conSQL::executeQuery($query);

    while($row = mysqli_fetch_array($result))
    {
        // $state = $row['status'] == 1 ? 0 : 1;
        $output.='  <tr id="'.$row['userID'].'-row">
                        <td>
                            '.$row['userName'].'
                        </td>
                        <td>
                            *********
                        </td>
                        <td>
                            <span class="block-email">'.$row['email'].'</span>
                        </td>
                        <td>
                            '.authentication($row['userID'],$row['userAuthentication']).'
                        </td>
                        <td id="'.$row['userID'].'-state">
                            '.state($row["state"]).'
                        </td>
                        <td>
                            <div class="table-data-feature float-left">
                                <button class="item pass-reset" data-toggle="tooltip" data-placement="top" title=""  userid='.$row['userID'].' data-original-title="Reset pass">
                                    <i class="zmdi zmdi-rotate-left"></i>
                                </button>
                                <button class="item edit-user" data-toggle="tooltip" data-placement="top" title=""  userid='.$row['userID'].'  firstName="'.$row['firstName'].'" lastName="'.$row['lastName'].'" email="'.$row["email"].'" data-original-title="Chỉnh sửa">
                                    <i class="zmdi zmdi-edit"></i>
                                </button>
                                <span id="'.$row['userID'].'-state-btn">
                                        '.stateBtn($row['userID'],$row['state']).'
                                </span>
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

    function state($state)
    {
        $rs ='<span class="role admin">disable</span>';
        if($state == 1 )
        {
            $rs ='<span class="role member">enable</span>';
        }
        return $rs;
    }

    function authentication($userId,$authen)
    {
        $option = array("Admin","Sale","Customer");    
        $rs = '  <div class="rs-select2--trans rs-select2--sm userAuthen" value="2" id="'.$userId.'-authen" userid='.$userId.' >
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
                    <div class="dropDownSelect2"></div>
                </div>';
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