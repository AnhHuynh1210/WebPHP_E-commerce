<?php
    require("./../../XuLy/conSQL.php");
    session_start();
    if(isset($_POST['do']) && isset($_POST['receiptId']) )
    { 
        $do = $_POST['do'];
        $receiptId = $_POST['receiptId'];
        if($do == 'progress')
        {
            $state = $_POST['state'];
            ProgessReceipt($receiptId,$state);
            
            $myObj = new stdClass();
            $myObj->state = receiptProgess($state);
            $myObj->btnProgress = progressBTN( $state == 1?0:1,$receiptId);
            $myObj->totalProgressing = totalProgressingReceipt();

            echo json_encode($myObj);
        }

    }

    function ProgessReceipt($receiptId,$state)
    {
        $sql = "UPDATE receipt SET  status = $state WHERE receiptID = $receiptId";
        conSQL :: executeQuery($sql);
        // echo $sql;
    }

    function receiptProgess($status)
    {
        $out = '<span class="status--denied">Đang xử lý</span>';
        if($status == 1)
        {
            $out = '<span class="status--process">Đã xử lý</span>';
        }
        return $out;
    }

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

    function totalProgressingReceipt()
    {
        $sql = 'SELECT * FROM receipt WHERE receipt.status=0';
        $rs = conSQL :: executeQuery($sql);
        return mysqli_num_rows($rs);
    }

?>