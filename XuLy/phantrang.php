<?php
    require("conSQL.php");
    
    
    $record_page = 6;
    $page =" ";
    
    $where = "";

    $brand="";
    $brandName="";

    $cetorgry = "";
    $cetorgryName ="";

    /**** Search */
    $data = array();
    array_push($data,"productBrand = brandID");
    $enable = "state ='1'";
    array_push($data,$enable);
    if(isset($_POST['search']) && $_POST['search'] != "undefined" )
    {
        $search = ' productName LIKE "%'.$_POST['search'].'%"';
        array_push($data,$search);
    }
    /********** */
    

    /**** Lấy Loại */
    if(isset($_POST["cetorgry"]))
    {
        $rs = conSQL :: executeQuery('SELECT * FROM cetorgry WHERE cetorgryID = "'.$_POST["cetorgry"].'" ');
        while($row = mysqli_fetch_array($rs))
        {
            $cetorgryName = $row['cetorgryName'];
        }
        $cetorgry = 'productCetorgry="'.$_POST["cetorgry"].'"';
        array_push($data,$cetorgry);
    }
    else{
        $cetorgryName = "Tất cả";
    }
    /************* */

    /**** Lấy Nhăn Hiệu */
    if(isset($_POST["brand"]))
    {
        $rs = conSQL :: executeQuery('SELECT * FROM brand WHERE brandID = "'.$_POST["brand"].'" ');
        while($row = mysqli_fetch_array($rs))
        {
            $brandName = $row['brandName'];
        }
        $cetorgryName = $cetorgryName." : ".$brandName."";
        $brand = 'productBrand="'.$_POST["brand"].'"';
        array_push($data,$brand);
    }

    /************ */

    /******* Tao SQL WHERE*/
    for($i = 0 ; $i < count($data); $i++)
    {
        if($i+1 == count($data))
        {
            $where .= $data[$i] ;
        }
        else
        {
            $where .= $data[$i]." AND ";
        }
    }
    if($where == "")
    {
        $where = "productBrand = brandID";
    }
    /******** */

    /***** Pagging */
    if(isset($_POST["page"]))
    {
        $page = $_POST["page"];
    }
    else{
        $page = 1;
    }
    /**** */
    
    /**** SORT */
    if(isset($_POST['order']))
    {
        $sort = $_POST['order'];
    }
    else{
        $sort = "DESC";  //giảm dần
    }
    /************* */
    
    /*** Tim theo gia */

    $min = isset($_POST['min'])?$min = $_POST['min']*1000000:$min = 0;
    $max = isset($_POST['max'])?$max = $_POST['max']*1000000:$max = 50000000;
    /****** */

    $page_query = "SELECT product.*,brand.brandName FROM `product`,brand WHERE $where AND productPrice BETWEEN $min AND $max";
    // echo $page_query."?";
    $page_result = conSQL::executeQuery($page_query);
    $total_record = mysqli_num_rows($page_result);		//Tổng sản phẩm
    $total_page = ceil($total_record/$record_page);		//Tổng trang


    $output = '';
    $start_form = ($page - 1)*$record_page; 
    $query = "SELECT product.*,brand.brandName FROM `product`,brand WHERE $where AND productPrice BETWEEN $min AND $max ORDER BY productPrice $sort LIMIT $start_form,$record_page";		//LIMIT 0,6 : bất đầu từ 0, lấy 6 dòng
    $result = conSQL::executeQuery($query);

    while($row = mysqli_fetch_array($result))
    {
        $output .='<div class="col-12 col-sm-6 col-lg-4" data-aos="zoom-in" data-aos-duration="850" data-aos-delay="50" data-aos-once="true">
                        <div class="single-product-wrapper">
                            <!-- Product Image -->
                            <div class="product-img">
                                <img src="./img/sanpham/'.$row["IMG"].'" alt="">

                                <!-- Favourite -->
                                <div class="product-favourite">
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
                        </div>
                    </div>';
    }
    $output .="</div>";

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
	
	//$page là trang hiện tại đang được chọn
    $prev = $page - 1;	//Trang trước đó:	nút	<
    $next = $page + 1;	// trang tiếp theo:	nút	>

    if($page == 1)
    {
        $prev = $page;
    }
    if($page == $total_page)
    {
        $next = $page;
    }  
    $paging = "";
    $paging .='     <ul class="pagination justify-content-center mt-50 mb-70">
                        <li class="page-item" id="1"><a class="page-link" href="#">Đầu</a></li>
                        <li class="page-item" id="'.$prev.'"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>';



    for($i = 1 ; $i <= $total_page ; $i++)
    {
        $paging .= '<li class="page-item" id="'.$i.'"><a class="page-link" href="#">'.$i.'</a></li>';
    }
    $paging .='<li class="page-item" id="'.$next.'"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                <li class="page-item" id="'.$total_page.'"><a class="page-link" href="#">Cuối</a></li>
                </ul>';

    $myobj = new \stdClass();
    $myobj->cetorgry = $cetorgryName;
    $myobj->totalRecord = $total_record;
    $myobj->output = $output;
    $myobj->paging = $paging;

    echo json_encode($myobj);

    // echo $output."%";
    // echo $query."%";
    // echo $paging;
    
?>