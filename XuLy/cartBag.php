<?php
    $output = '<div class="cart-list" >';
    $total = 0;
    $num = 0;
    if(isset($_SESSION['id']))
    {
        foreach($_SESSION['id'] as $item)
        {    
            $output .= '<div class="single-cart-item">
                            <a class="product-image">
                                <img src="./img/sanpham/'.$item->img.'" class="cart-thumb" alt="" style="height:220px">
                                <!-- Cart Item Desc -->
                                <div class="cart-item-desc">
                                <span class="product-remove" data="'.$item->id.'" ><i class="fa fa-close delete_item" aria-hidden="true"></i></span>
                                    <span class="badge">'.$item->brand.'</span>
                                    <h6>'.$item->name.'</h6>
                                    <p class="size">Số lượng: '.$item->quality.'</p>
                                    <p class="price">'.number_format($item->price,0,".",".").'</p>
                                </div>
                            </a>
                        </div>';
            $total += $item->price*$item->quality;
            $num += $item->quality;
                        
        }
    }
    $output .= '</div>
                    <!-- Cart Summary -->
                    <div class="cart-amount-summary">
                        <h2>Hóa Đơn</h2>
                        <ul class="summary-table">
                            <li><span>Tổng:</span> <span>'.number_format($total,0,".",".").' đ</span></li>
                            <li><span>Phí vận chuyển :</span> <span>Free</span></li>
                            
                            <li><span>Tổng tiển:</span> <span>'.number_format($total,0,".",".").' đ</span></li>
                        </ul>
                        <div class="checkout-btn mt-100">
                            <a href="checkout.php" class="btn essence-btn">Kiểm tra</a>
                        </div>
                    </div>
                </div>';
    
    $myObj = new stdClass();
    $myObj->num = $num;
    $myObj->output = $output;

    echo json_encode($myObj);
                
?>