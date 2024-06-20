<!-- HEADER DESKTOP-->
<header class="header-desktop2">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="header-wrap2">
                <div class="logo d-block d-lg-none">
                    <a href="#">
                        <img src="images/icon/logoshellphone.png" alt="Admin" />
                    </a>
                </div>
                <div class="header-button2">
                    <div class="header-button-item mr-0 js-sidebar-btn">
                        <i class="zmdi zmdi-menu"></i>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</header>
<aside class="menu-sidebar2 js-right-sidebar d-block d-lg-none">
    <div class="logo">
        <a href="../../index.php">
            <img src="images/icon/sp.png" alt="Admin" />
        </a>
    </div>
    <div class="menu-sidebar2__content js-scrollbar2">
        <div class="account2">
            <div class="image img-cir img-120">
                <img src="images/icon/admin.png" alt="Admin" />
            </div>
            <h4 class="name">Admin</h4>
            <a class="signOut" style="cursor: pointer;">Đăng Xuất</a>
        </div>
        <nav class="navbar-sidebar2">
            <ul class="list-unstyled navbar__list">
                <li class="dashboard">
                    <a href="admin.php">
                        <i class="fas fa-tachometer-alt"></i>Thống kê
                    </a>
                </li>
                <li class="receipt">
                    <a href="receiptTable.php">
                        <i class="fas fa-chart-bar"></i>Hóa đơn</a>
                    <span class="inbox-num" id="progressingNum">
                        <?php
                            $sql = 'SELECT * FROM receipt WHERE receipt.status=0';
                            $rs = conSQL :: executeQuery($sql);
                            echo mysqli_num_rows($rs);
                        ?>
                    </span>
                </li>
                <li class="product">
                    <a href="productTable.php">
                        <i class="fas fa-shopping-basket"></i>Sản phẩm
                    </a>
                </li>
                <?php
                if(isset($_SESSION['isLOGIN']) && $_SESSION["isLOGIN"] == 1 && $_SESSION["AUTHENTICATION"] == 0)
                {
                    echo '  <li class="user">
                                <a href="userTable.php">
                                    <i class="fas fa-users"></i>Tài khoản
                                </a>
                            </li>';
                }
                ?>
            </ul>
        </nav>
    </div>
</aside>
<!-- END HEADER DESKTOP-->