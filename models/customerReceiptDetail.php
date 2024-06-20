<div class="section-padding-80" >
    <div class="container">
        <?php
            require("..//WEBbanhang1/XuLy/conSQL.php");
            if(isset($_SESSION['user']))
            {
                $output ='';
                $userName = $_SESSION['user']->userName;
                $receiptSQL = 'SELECT * FROM receipt WHERE userName="'.$userName.'"';
                // echo $receiptSQL;
                $receiptResult = conSQL :: executeQuery($receiptSQL);
                while($row = mysqli_fetch_array($receiptResult))
                {
                    $status = '<span class="alert alert-danger">Đang xử lý</span>';
                    if($row['status'] == 1)
                    {
                        $status = '<span class="alert alert-success">Đã xử lý</span>';
                    }
                    $output .= '<div class="row m-auto w-75 border border-dark p-md-4">
                                    <div class="col-9">
                                        <h5>Hóa đơn : '.$row['receiptID'].'</h5>
                                        <p>Ngày : '.$row['receiptDate'].'</p>
                                    </div>
                                    <div class="col-3">
                                        '.$status.'
                                    </div>
                                    <div class="col-12">
                                        <ul class="list-group list-group-flush" style="display:flex">';

                    $receiptDetailSQL = 'SELECT * FROM receiptdetail WHERE receiptID="'.$row['receiptID'].'"';
                    $receiptDetailResult = conSQL :: executeQuery($receiptDetailSQL);
                    while($detail = mysqli_fetch_array($receiptDetailResult))
                    {
                        $output.='  <li class="list-group-item" >
                                        <span>'.$detail['productName'].'</span>
                                        <span class="float-right">'.$detail['quality'].' x '.number_format($detail['price'],0,".",".").'đ</span>
                                    </li>';
                    }
                    $output .='         </li>
                                    <ul>
                                <div class="col-12 mt-md-3">
                                    <h5 class="float-right">Tổng tiền : '.number_format($row['receiptTotal'],0,".",".").' VNĐ</h5>
                                    </div>
                                </div>
                            </div>';
                }
                if(empty($output))
                {
                    $output ='<h3 class="alert alert-danger">Chưa có hóa đơn</h3>';
                }
                echo $output;
            }
        ?>
    </div>
</div>
    