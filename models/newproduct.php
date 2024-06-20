<section class="new_arrivals_area section-padding-80 clearfix" data-aos="zoom-in-up" data-aos-duration="850" data-aos-delay="50" data-aos-once="true">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h2>Sản Phẩm Bán Chạy</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="popular-products-slides owl-carousel">
                    <?php
                        require('./XuLy/conSQL.php');
                        $output="";
                        $query = "  SELECT product.*,brand.brandName 
                                    FROM `product`,brand 
                                    WHERE productBrand = brandID 
                                    LIMIT 8";
                        $result = conSQL::executeQuery($query);
                        while($row = mysqli_fetch_array($result))
                        {
                            $output .=' <div class="single-product-wrapper">
                                            <!-- Product Image -->
                                            <div class="product-img">
                                                <img src="./img/sanpham/'.$row["IMG"].'" alt="">
                
                                                <!-- Favourite -->
                                                <div class="product-favourite">
                                                    <a href="#" class="favme fa fa-heart"></a>
                                                </div>
                                            </div>
                                            <!-- Product Description -->
                                            <div class="product-description">
                                                <span>'.$row["brandName"].'</span>
                                                <a href="product-details.php?id='.$row["productID"].'">
                                                    <h6>'.$row["productName"].'</h6>
                                                </a>
                                                <p class="product-price">'.number_format($row["productPrice"],0,".",".").' Đ</p>
                
                                                <!-- Hover Content -->'
                                                    .productAmount($row["productID"],$row["productName"],$row["brandName"],$row["IMG"],$row["productPrice"],$row["productAmount"]).
                                                    '
                                            </div>
                                        </div>';
                        }
                        function productAmount($id,$name,$brand,$img,$price,$amount)
                        {
                            $out='
                                <div class="btn-disable">
                                    <div>
                                        <a class="btn essence-btn" style="color:white;">
                                            Hết Hàng
                                        </a>
                                    </div>     
                                </div>';
                            if($amount > 0)
                            {
                                $out ='
                                    <div class="hover-content">
                                        <div>
                                        <a class="btn essence-btn add-to-cart-btn" style="color:white;"
                                            id="'.$id.'" 
                                                name="'.$name.'" 
                                                brand="'.$brand.'"  
                                                img="'.$img.'" 
                                                price="'.$price.'"
                                                max ='.$amount.'
                                            >Thêm vào giỏ</a>
                                        </div>
                                    </div>';
                            }
                            return $out;
                        }
                        echo $output
                    ?>
                
                   
                </div>
            </div>
        </div>
    </div>
</section>
