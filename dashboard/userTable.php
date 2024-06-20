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
<div class="modal fade" id="userEdit" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Chỉnh sửa</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="user-edit-error"></div>
            <div class="modal-body">
            <form id="userEdit-form">
                <div class="row">
                    <input type="hidden" name="userId" class="form-control" value="" required placeholder="Nguyễn Văn">
                    <div class="col-md-5 mb-3">
                        <label for="user">Họ<span>*</span></label>
                        <input type="text" name="firstName" class="form-control" value="" required placeholder="Nguyễn Văn">
                    </div>
                    <div class="form-group col-md-7 mb-3">
                        <label for="password">Tên<span>*</span></label>
                        <input type="text" name="lastName" class="form-control" value="" required placeholder="A">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="user">Email<span>*</span></label>
                        <input type="text" name="email" class="form-control"  value="" required placeholder="abc@example.com">
                    </div>
                    <div class="col-md-12 mb-3">
                        
                    </div>
                    <div class="col-md-12 mb-3 mt-3">
                        <input type="submit" class="form-control" value="Xác nhận">
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- ADD USER -->
<div class="modal fade" id="register" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
    <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
            <h4 class="modal-title">Đăng ký</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
            <form id="DK" action="" method="post">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="last_name">Họ*<span class="error"></span></label>
                        <input type="text" class="form-control" name="firstName" value="" placeholder="Nguyễn Văn">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name">Tên*<span class="error"></span></label>
                        <input type="text" class="form-control" name="lastName" value="" placeholder="A">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="last_name">Tên đăng nhập*<span class="error"></span></label>
                        <input type="text" class="form-control" name="user" value="" placeholder="Tên đăng nhập">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="last_name">Email*<span class="error"></span></label>
                        <input type="text" class="form-control" name="email" value="" placeholder="admin1234@gmail.com">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="last_name">Mật khẩu*<span class="error"></span></label>
                        <input type="password" class="form-control" name="password" value="" placeholder="Mật khẩu">
                    </div>
                    <div class="col-md-12 mb-3">
                        <label for="last_name">Nhập lại mật khẩu*<span class="error"></span></label>
                        <input type="password" class="form-control" name="confirmpassword" value="" placeholder="Mật khẩu">
                    </div>
                    <div class="col-md-12 mb-3 mt-3">
                        <input type="submit" class="form-control" value="Đăng ký" name="submit">
                    </div>
                </div>
            </form>
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
                                            <li class="list-inline-item">Quản lý tài khoản</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- END BREADCRUMB-->

        <section class="statistic">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- USER DATA-->
                                <div class="user-data m-b-30">
                                    <h3 class="title-3 m-b-30">
                                        <i class="zmdi zmdi-account-calendar"></i>Tài khoản</h3>
                                    <div class="filters m-b-45 row">
                                        <div class="col-sm-6 input-group">
                                            <div class="input-group">
                                                <div class="input-group-btn">
                                                    <button class="btn btn-primary searchUser-btn">
                                                        <i class="fa fa-search"></i> Tìm
                                                    </button>
                                                </div>
                                                <input type="text" name="input1-group2" id="searchUser" placeholder="Tên đăng nhập cần tìm ...." class="form-control">
                                            </div>
                                        </div>
                                        <div class="table-data__tool-right">
                                            <button class="au-btn au-btn-icon au-btn--green au-btn--small btn-product-edit" data-toggle="modal" data-target="#register">
                                            <i class="zmdi zmdi-plus"></i>Thêm tài khoản</button>
                                        </div>
                                    </div>
                                    <div class="table-responsive table-data h-100">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <td>tên đăng nhập</td>
                                                    <td>mật khẩu</td>
                                                    <td>email</td>
                                                    <td>quyền</td>
                                                    <td>trạng thái</td>
                                                    <td></td>
                                                </tr>
                                            </thead>
                                            <tbody class="userTable">  
                                            </tbody>
                                        </table>
                                        <div class='userPaging mt-3 mb-4'>
                                        </div>
                                    </div> 
                                </div>
                                <!-- END USER DATA-->
                            </div> 
            <!-- END PAGE CONTAINER-->
                        </div>
                    </div>
                </div>  
            </div>     
        </section>

    </div>

    <?php include("./model/script.php") ?>

</body>

</html>
<!-- end document-->