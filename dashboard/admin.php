<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        require("./../XuLy/conSQL.php");
        include("./model/head_css.php");
    ?>
</head>

<body class="animsition" id="stattstic">
    <div class="page-wrapper">
        <?php include("./model/menuBar.php") ?>
        <!-- PAGE CONTAINER-->
        <div class="page-container2">
            <?php include("./model/header.php") ?>
            <!-- BREADCRUMB-->
            <section class="au-breadcrumb m-t-75">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="au-breadcrumb-content">
                                    <div class="au-breadcrumb-left">
                                        <span class="au-breadcrumb-span">Bạn đang ở:</span>
                                        <ul class="list-unstyled list-inline au-breadcrumb__list">
                                            <li class="list-inline-item">Trang thống kê</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

            <!-- STATISTIC-->
            <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">
                                        <?php
                                            $total = 0;
                                            $sql='  SELECT * 
                                                    FROM user 
                                                    WHERE user.state = 1';
                                            $rs = conSQL :: executeQuery($sql);
                                            echo mysqli_num_rows($rs);
                                        ?>
                                    </h2>
                                    <span class="desc">Thành viên hoạt động</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-account-o"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="statistic__item">
                                    <h2 class="number">
                                        <?php
                                            $total = 0;
                                            $sql='  SELECT receiptdetail.productID,sum(receiptdetail.quality) as quality 
                                                    FROM `receipt` INNER JOIN receiptdetail ON receipt.receiptID = receiptdetail.receiptID 
                                                    WHERE receipt.status = 1 
                                                    GROUP BY receiptdetail.productID';
                                            $rs = conSQL :: executeQuery($sql);
                                            while($row = mysqli_fetch_array($rs))
                                            {
                                                $total += $row["quality"];
                                            }
                                            echo $total;
                                        ?>
                                    </h2>
                                    <span class="desc">Sản phẩm bán được</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-shopping-cart"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-6">
                                <div class="statistic__item">
                                    <h2 class="number">
                                    <?php
                                            $total = 0;
                                            $sql='  SELECT * 
                                                    FROM `receipt` 
                                                    WHERE receipt.status = 1 ';
                                            $rs = conSQL :: executeQuery($sql);
                                            while($row = mysqli_fetch_array($rs))
                                            {
                                                $total += $row["receiptTotal"];
                                            }
                                            echo number_format($total,0,".",".");
                                        ?>
                                     VNĐ</h2>
                                    <span class="desc">Tổng thu nhập</span>
                                    <div class="icon">
                                        <i class="zmdi zmdi-money"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END STATISTIC-->
            <!-- TOP CAMPAIGNS -->
            <div class="row ml-3 mr-3">
                <div class="col-lg-6">
                    <div class="top-campaign pb-5">
                        <h3 class="title-3 m-b-30">Top sản phẩm bán chạy</h3>
                        <div class="table-responsive">
                            <table class="table table-top-campaign">
                                <thead>
                                    <tr style="font-weight:bolder">
                                        <td>Tên sản phẩm</td>
                                        <td style="text-align:center">Số lượng</td>
                                    </tr>
                                </thead>           
                                <tbody>
                                    <?php
                                        $out="";
                                        $sql = 'SELECT productID , productName , SUM(quality) quality 
                                                FROM receipt,receiptdetail 
                                                WHERE receipt.receiptID = receiptdetail.receiptID AND receipt.status = 1 
                                                GROUP BY productID 
                                                ORDER BY quality DESC LIMIT 5';
                                        $rs = conSQL :: executeQuery($sql);
                                        while($row = mysqli_fetch_array($rs))
                                        {
                                            $out.= '<tr>
                                                        <td>'.$row['productName'].'</td>
                                                        <td style="text-align:center">'.$row['quality'].'</td>
                                                    </tr>';
                                        }
                                        echo $out;
                                        
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END TOP CAMPAIGNS -->
            

            <section>
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                        </div>
                    </div>
                </div>
            </section>

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="copyright">
                                <p>Copyright © 2018 Colorlib. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END PAGE CONTAINER-->
        </div>

    </div>

    <?php include("./model/script.php") ?>

</body>

</html>
<!-- end document-->