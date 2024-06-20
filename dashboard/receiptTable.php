<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php 
        require("./../XuLy/conSQL.php");
        include("./model/head_css.php") 
    ?>
</head>
<!-- RECEIPT INFO -->
<div class="modal fade" id="receiptInfo" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog mw-100 w-50">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin hóa đơn</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="product-error"></div>
                <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <h5>Mã hóa đơn : <span class="font-weight-normal" id="receiptInfoId">12</span> </h5>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <h5 >Tài khoản mua : <span class="font-weight-normal" id="receiptInfoUser">minhminion</span> </h5>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <h5 >Họ tên người mua : <span class="font-weight-normal" id="receiptInfoName">Lưu Bảo Minh</span></h5>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <h5 >Số điện thoại : <span class="font-weight-normal" id="receiptInfoPhone">0937834465</span></h5>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <h5 >Thành phố : <span class="font-weight-normal" id="receiptInfoCountry">dasdasd</span></h5>
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <h5 >Địa chỉ : <span class="font-weight-normal" id="receiptInfoAddress">dasdasd</span></h5>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <h5 >Sản phẩm :</h5>
                                <ul class="ml-5 mt-2" id="receiptInfoProduct">
                                    <li>ABC</li>
                                    <li>ABC</li>
                                    <li>ABC</li>
                                    <li>ABC</li>
                                </ul>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <h4>Tổng tiền  : <span class="font-weight-normal" id="receiptInfoTotal"></span></h4>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <h5 >Mô tả</h5>
                                <textarea class="form-control rounded-0" id="receiptInfoDescription" name="description" rows="5"></textarea>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<body class="animsition">
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
                                            <li class="list-inline-item">Quản lý hóa đơn</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="main-content">
            <!-- END BREADCRUMB-->
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- DATA TABLE-->
                                <h3 class="title-5 m-b-35">Hóa đơn</h3>
                                <div class="table-data__tool">
                                    <div class="table-data__tool-left">
                                        <div class="rs-select2--light rs-select2--md">
                                            <select id="receiptOrder" class="js-select2 select2-hidden-accessible" name="property" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" value="">Sắp xếp</option>
                                                <option value="date">Ngày</option>
                                                <option value="total">Tổng tiền</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <div class="rs-select2--light rs-select2--md">
                                            <select id="receiptDescOrAsc" class="js-select2 select2-hidden-accessible"  name="property" tabindex="-1" aria-hidden="true">
                                                <option selected="selected" value="">Thứ tự</option>
                                                <option value="ASC">Tăng</option>
                                                <option value="DESC">Giảm</option>
                                            </select>
                                            <div class="dropDownSelect2"></div>
                                        </div>
                                        <button class="au-btn-filter receipt-filter">
                                            <i class="zmdi zmdi-filter-list"></i>Lọc</button>
                                    </div>
                                </div>
                                <div class="table-responsive m-b-40">
                                    <table class="table table-borderless table-data3">
                                        <thead>
                                            <tr>
                                                <th>Mã hóa đơn</th>
                                                <th>Họ Tên</th>
                                                <th>Tài khoản mua</th>
                                                <th>Địa chỉ</th>
                                                <th>Tổng tiền</th>
                                                <th>Tình trạng</th>
                                                <th>Ngày mua</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody class="receiptTable">
                                        </tbody>
                                    </table>
                                    <div class="receiptPaging mt-3">
                                    </div>
                                </div>
                                <!-- END DATA TABLE-->
                            </div>
                        </div>
            <!-- END PAGE CONTAINER-->
                        </div>
                    </div>
                </div>  
            </div>     

    </div>

    <?php include("./model/script.php") ?>

</body>

</html>
<!-- end document-->