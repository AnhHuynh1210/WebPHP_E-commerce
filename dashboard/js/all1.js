$(document).ready(function()
{
    isLogin();
    pagingProduct();
    pagingReceipt();
    pagingUser();
    activeMenuItem();

    
    
    $('#statistic').ready(function()
    {
        statistic();
    })

    $(document).on("change","#selectTimeOrder",function()
    {
        switch ($(this).val())
        {
            case 'month':
                $(".selectYear").css("visibility","visible");
                $(".selectMonth").css("visibility","hidden");
            break;
            case 'day':
                $(".selectYear").css("visibility","visible");
                $(".selectMonth").css("visibility","visible");
            break;
            default:
                $(".selectYear").css("visibility","hidden");
                $(".selectMonth").css("visibility","hidden");
            break;
        }
    })
    $(document).on("change","#selectMonth",function()
    {
        statistic();
    })
    $(document).on("change","#selectYear",function()
    {
        statistic();
    })
    $(document).on("change","#selectTimeOrder",function()
    {
        statistic();
    })

    function pagingProduct(page)
    {
        $cetorgry = $(".product-cetorgry").val();
        $brand = $(".product-brand").val();
        $search = $("#searchProduct").val();
        // console.log($search);

        $.ajax({
            url:"./XuLy/pagingProductTable.php",
            method:"POST",
            data:{  page:page,
                    cetorgry : $cetorgry ,
                    brand : $brand,
                    search : $search},
            datatype:"json",
            success:function(data)
            {
                // console.log(data);
                data = JSON.parse(data);
                $(".productTable").html(data.output);
                $(".productPaging").html(data.paging);
            }
        })
    }

    function pagingReceipt(page)
    {

        $order = $("#receiptOrder").val();
        switch($order)
        {
            case 'date': 
                $order = "receiptDate";
            break;
            case 'total': 
                $order = "receiptTotal";
            break;
        }
        $DescOrAsc = $("#receiptDescOrAsc").val();

        $.ajax({
            url:"./XuLy/pagingReceipt.php",
            method:"POST",
            data:{  page:page,
                    order : $order,
                    DescOrAsc : $DescOrAsc,
                    },
            datatype:"json",
            success:function(data)
            {
                // console.log(data);
                data = JSON.parse(data);
                $(".receiptTable").html(data.output);
                $(".receiptPaging").html(data.paging);
            }
        })
    }

    function pagingUser(page)
    {
        $search = $("#searchUser").val();
        // console.log($("#searchUser"));

        $.ajax({
            url:"./XuLy/pagingUser.php",
            method:"POST",
            data:{  page:page,
                    search : $search,
                    },
            datatype:"json",
            success:function(data)
            {
                data = JSON.parse(data);
                console.log(data);
                $(".userTable").html(data.output);
                $(".userPaging").html(data.paging);
            },
            complete:function()
            {
                reloadComboBox();
            }
        })
    }

    $(document).on("click",".searchUser-btn",function(event)
    {
        pagingUser();
    });

    $("#searchUser").keypress(function(event)
    {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            pagingUser();
        }
    });

    $(document).on("click",".page-item",function(event)
        {
            event.preventDefault();
            var page = $(this).attr("id");
            // console.log(page);
            pagingReceipt(page);
            pagingProduct(page);
            pagingUser(page);
        });

    $(document).on("click",".info-receipt",function(event)
    {
        getReceiptInfo($(this).attr('receiptid'))

        $("#receiptInfo").modal('toggle');
    });

    function isLogin()
    {
        console.log("abc");
        $.ajax({
            url: "../dashboard/XuLy/isLogin.php",
            method:"POST",
            datatype: "json",
            success:function(data)
            {
                data = JSON.parse(data);
                console.log(data.isLogin);
                if(data.isLogin == false)
                {
                    window.location.href = "../index.php";
                }
            }
        })
    }

    function getReceiptInfo(receiptId)
    {
        $.ajax({
            url:"./XuLy/receiptInfo.php",
            method:"POST",
            data: {receiptId : receiptId,},
            datatype:"json",
            success:function(data)
            {
                console.log(data);
                data = JSON.parse(data);
                $("#receiptInfoId").html(data.id);
                $("#receiptInfoUser").html(data.user);
                $("#receiptInfoName").html(data.name);
                $("#receiptInfoCountry").html(data.country);
                $("#receiptInfoAddress").html(data.address);
                $("#receiptInfoPhone").html(data.phone);
                $("#receiptInfoProduct").html(data.product);
                $("#receiptInfoTotal").html(data.total);
                $("#receiptInfoDescription").val(data.description);
                // $(".userTable").html(data.output);
                // $(".userPaging").html(data.paging);
            },
        })


    }

    $(document).on("click",".block-user",function()
    {
        $userId = $(this).attr("userid");
        $state = $(this).attr("state");
        console.log($userId);
        blockUser($userId,$state);
    })
    $(document).on("click",".pass-reset",function()
    {
        $userId = $(this).attr("userid");
        resetPass($userId);
    })

    $(document).on("click",".edit-user",function(e)
    {
        var userId = $(this).attr("userid");
        var firstName = $(this).attr("firstName");
        var lastName = $(this).attr("lastName");
        var email = $(this).attr("email");

        $(document).find('input[name="userId"]').val(userId);
        $(document).find('input[name="firstName"]').val(firstName);
        $(document).find('input[name="lastName"]').val(lastName);
        $(document).find('input[name="email"]').val(email);

        $("#userEdit").modal("toggle");
    })

    $(document).on("submit","#userEdit",function(event)
    {
        event.preventDefault();

        $userId = $(this).find('input[name="userId"]').val();  
        $firstName = $(this).find('input[name="firstName"]').val();  
        $lastName = $(this).find('input[name="lastName"]').val();  
        $email = $(this).find('input[name="email"]').val();  

        console.log($firstName);

        $do = "editUser";
        $.ajax({
            url :"../dashboard/XuLy/userSetting.php",
            method:"POST",
            data : {userId: $userId , 
                    do : $do ,
                    firstName : $firstName ,
                    lastName : $lastName ,
                    email : $email},
            success:function(data)
            {
                data = JSON.parse(data);
                console.log(data);
                if(data.complete == true)
                {
                    alert("Done");
                }
                else
                {
                    $(".user-edit-error").html(data.error);
                }
                // window.location.reload();
            }
        })
    })

    $(document).on("select2:select",".userAuthen",function(e)
    {
        $userId = $(this).attr("userid")
        $newAuthen = e.params.data.id;
        console.log($newAuthen);
        console.log($userId);
        $confirm = confirm("Bạn muốn thay đổi quyền của user ??")
        console.log($confirm);
        authentication($userId,$newAuthen,$confirm);

    });

    $(document).on("click",".product-filter",function()
    {
        pagingProduct();
    });

    $(document).on("click",".receipt-filter",function()
    {
        pagingReceipt();
    });

    $(document).on("click",".block-product",function()
    {
    $productId = $(this).attr("productid");
        $state = $(this).attr("state");
        $messge ="Bạn muốn tiếp tục bán sản phẩm này ??";
        if($state == 0)
        {
            $messge = "Bạn muốn ngưng bán sản phẩm này ??";
        }
        if(confirm($messge))
        {
            blockProduct($productId,$state);
        }
    });

    $(document).on("click",".progress-receipt",function()
    {
        $receiptId = $(this).attr("receiptid");
        $state = $(this).attr("state");
        $messge ="Bạn muốn xủ lý hoán đơn này ??";
        if($state == 0)
        {
            $messge = "Bạn muốn ngưng bán sản phẩm này ??";
        }
        if(confirm($messge))
        {
            progressReceipt($receiptId,$state);
        }
    });

    $("#searchProduct").keypress(function(event){
    
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13'){
            pagingProduct();
        }
    })

    $("#DK").on("submit",function(e)
        {
            e.preventDefault();
            console.log(decodeURI($(this).serialize()));
            $.ajax({
                url:"./../XuLy/validation.php",
                method:"POST",
                data:{  
                        toLogin : 0,
                        info : $(this).serialize()},
                success:function(data)
                {
                    console.log(data);
                    data = JSON.parse(data);
                    console.log(data.isRegister);
                    if(data.isRegister == false)
                    {
                        $infoE = data.error;
                        var error = $(".error");

                        for(var i = 0 ; i<= error.length ;i++)
                        {
                            var s = $infoE[i];
                            error[i].innerText = s;
                        }
                    }
                    else
                    {
                        $("#register").modal("toggle");
                        Swal.fire(
                            {
                                type: "succes",
                                title: "Đăng ký thành công",
                                onClose: () => {
                                    pagingUser();
                                    }
                            }
                        )
                    }
                    
                }
            })
        });

    $(document).on("change","#productImgChoice",function()
    {
        var input = this;
        var url = $(this).val();
        console.log(input.files);
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
        {
            var reader = new FileReader();

            reader.onload = function (e) {
            $('#productImg').attr('src',e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
            // console.log(input.files[0])
        }
        else
        {
            $('#productImg').attr('src','./../img/sanpham/noImage.png');
        }
    })

    $(document).on('submit','#product-form',function(e)
    {
        e.preventDefault();

        // var form = $(this);
        var form_data = new FormData($(this)[0]);
        console.log(form_data);
        $do = $('#product-form').find('input[name="submit"]').attr("do");
        console.log($do);
        
        $.ajax({
            url :"./../dashboard/XuLy/uploadProduct.php",
            method:"POST",
            data :form_data,
            dataType:'json',
            cache : false,
            contentType:false,
            processData: false,
            // async:false,
            success:function(data)
            {
                console.log(data);
                if(data.complete == true)
                {
                    $("#productEdit").modal('toggle');
                    sweetAlert("success","Thêm thành công");
                }
                else
                {
                    $(".product-error").html(data.error);
                }
            }
        })

        // return false;
    })

    $(document).on('click','.edit-product',function(e)
    {
        $productId = $(this).attr('productid');

        $.ajax({
            url:"../dashboard/XuLy/productInfo.php",
            method:'POST',
            data: {
                    id : $productId,
            },
            success:function(data)
            {
                data = JSON.parse(data);
                console.log(data);
                $('#productEdit').modal("toggle");
                
                $(".product-error").html("");
                $('#product-form').find('input[name="do"]').val("edit");

                $('#product-form').find('input[name="id"]').val(data.id);
                document.getElementById('productId').setAttribute("readonly", true);
                
                $imgURL = './../img/sanpham/'+data.img;
                $('#productImg').attr("src",$imgURL);
                $("#productImgChoice").val('');

                $('#product-form').find('input[name="name"]').val(data.name);
                $('#productCetorgry').val(data.category);
                $('#productBrand').val(data.brand);
                $('#product-form').find('input[name="price"]').val(data.price);
                $('#product-form').find('input[name="amount"]').val(data.amount);
                $('#description').val(data.description);
                $('#product-form').find('input[name="submit"]').val("Xác nhận");
                $('#product-form').find('input[name="submit"]').attr("do","edit");


            }
        })
    })

    $(document).on('click','.btn-product-edit',function()
    {
        refeshProductEdit();
    })

    $(document).on('click','.signOut',function(event)
    {
        event.preventDefault();
        $.ajax({
            url : "./XuLy/logOut.php",
            success:function(data)
            {
                window.location.reload();
            }
        })
    })

    function statistic()
    {
        var chartData="";
        var orderBy = $("#selectTimeOrder").val();
        var month=$("#selectMonth").val();
        var year=$("#selectYear").val();
        console.log("Tháng "+month+" Năm "+year);

        $.ajax({
            url : '../dashboard/XuLy/statistic.php',
            method : 'POST',
            data: {
                    orderBy : orderBy,
                    month : month,
                    year : year,
            },
            success:function(data)
            {
                // console.log(data);
                chartData = JSON.parse(data);
                // $("#my-recent-rep-chart").data('val',chartData.value);
            },
            complete:function(data)
            {
                // console.log(chartData)
                // DrawMyChart(chartData.label);
                $('#myReportChart').remove();
                $(".recent-report2").append('<div class="recent-report__chart" id="myReportChart"><canvas id="my-singelBarChart" data-val=""></canvas></div>');
                $("#my-singelBarChart").data('val',chartData.value);
                DrawMyChart1(chartData.label,chartData.value);
                
            }
        })

    }

    function DrawMyChart(myLabel)
    {
        const brandProduct = 'rgba(0,181,233,0.8)'
        const brandService = 'rgba(0,173,95,0.8)'
        
        var elements = 10
        var data1 = [52, 60, 55, 50, 65, 80, 57, 70, 105, 115, 90, 100, 20]
        var data2 = [102, 70, 80, 100, 56, 53, 80, 75, 65, 90, 80, 70, 60]
        
        var label = myLabel.split(',');

        var ctx = document.getElementById("my-recent-rep-chart");
        var data = $("#my-recent-rep-chart").data('val');
        if(data != null)data = data.split(",");

        if (ctx) {
        ctx.height = 450;
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
            labels: label,
            datasets: [
                {
                label: 'My First dataset',
                backgroundColor: brandService,
                borderColor: 'transparent',
                pointHoverBackgroundColor: '#fff',
                borderWidth: 0,
                data: data

                },
                {
                label: 'My Second dataset',
                backgroundColor: brandProduct,
                borderColor: 'transparent',
                pointHoverBackgroundColor: '#fff',
                borderWidth: 0,
                data: data2

                }
            ]
            },
            options: {
            maintainAspectRatio: true,
            legend: {
                display: false
            },
            responsive: true,
            scales: {
                xAxes: [{
                gridLines: {
                    drawOnChartArea: true,
                    color: '#f2f2f2'
                },
                ticks: {
                    fontFamily: "Poppins",
                    fontSize: 12
                }
                }],
                yAxes: [{
                ticks: {
                    beginAtZero: true,
                    maxTicksLimit: 5,
                    stepSize: 50,
                    max: 150,
                    fontFamily: "Poppins",
                    fontSize: 12
                },
                gridLines: {
                    display: true,
                    color: '#f2f2f2'

                }
                }]
            },
            elements: {
                point: {
                radius: 0,
                hitRadius: 10,
                hoverRadius: 4,
                hoverBorderWidth: 3
                }
            }
            }
        });
        }
    }

    function DrawMyChart1(myLabel)
    {

        var label = myLabel.split(',');
        var ctx = document.getElementById("my-singelBarChart");
        var data = $("#my-singelBarChart").data('val');
        
        if(data != null)data = data.split(",");
        
        if (ctx) {
        ctx.height = 450;
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: label,
            datasets: [
                {
                label: "Tổng tiền bán ra",
                data: data,
                borderColor: "rgba(0, 123, 255, 0.9)",
                borderWidth: "0",
                backgroundColor: "rgba(0, 123, 255, 0.5)"
                }
            ]
            },
            options: {
            legend: {
                position: 'top',
                labels: {
                fontFamily: 'Poppins'
                }

            },
            scales: {
                xAxes: [{
                ticks: {
                    fontFamily: "Poppins"

                }
                }],
                yAxes: [{
                ticks: {
                    beginAtZero: true,
                    fontFamily: "Poppins"
                }
                }]
            }
            }
        });
        }
    } 

    function refeshProductEdit()
    {
        $(".product-error").html();
        $('#product-form').find('input[name="do"]').val("add");

        $('#product-form').find('input[name="id"]').val("");
        document.getElementById('productId').removeAttribute('readonly');

        $('#productImg').attr("src","");
        $("#productImgChoice").val('');


        $('#product-form').find('input[name="name"]').val("");
        $('#productCetorgry').val("001");
        $('#productBrand').val("001");
        $('#product-form').find('input[name="price"]').val("");
        $('#product-form').find('input[name="amount"]').val("");
        $('#description').val("");

        $('#product-form').find('input[name="submit"]').val("Thêm");
        $('#product-form').find('input[name="submit"]').attr("do","add");
    }

    function blockProduct(productId,state)
    {
        $do = "block";
        $.ajax({
            url :"../dashboard/XuLy/productSetting.php",
            method:"POST",
            data : {productId : productId ,state: state ,do : $do},
            datatype :'json',
            success:function(data)
            {
                data = JSON.parse(data);
                console.log(data);
                $("#"+productId+"-state").html(data.state);
                $("#"+productId+"-block").attr('state',data.isBlock);
                $("#"+productId+"-block").html(data.btnIcon);
                // pagingProduct();
            }
        })
    }

    function progressReceipt(receiptId,state)
    {
        $do = "progress";
        $.ajax({
            url :"../dashboard/XuLy/receiptSetting.php",
            method:"POST",
            data : {receiptId : receiptId ,state: state ,do : $do},
            datatype :'json',
            success:function(data)
            {
                data = JSON.parse(data);
                console.log(data);
                $("#"+receiptId+"-state").html(data.state);
                $("#"+receiptId+"-progress-btn").html(data.btnProgress);
                $("#progressingNum").html(data.totalProgressing);
                // pagingProduct();
            }
        })
    }


    function authentication(userId,authen,confirm)
    {
        console.log(confirm);
        $do = "authentication";
        $.ajax({
            url :"../dashboard/XuLy/userSetting.php",
            method:"POST",
            data : {userId: userId ,authen: authen ,do : $do,confirm : confirm},
            datatype :'json',
            success:function(data)
            {
                console.log(data);
                data = JSON.parse(data);
                $("#"+userId+"-authen").html(data.authentication);
                // alert("Done");
                reloadComboBox("#"+userId+"-row");
                // window.location.reload();
            }
        })
    }

    function blockUser(userId,state)
    {
        $do = "block";
        $.ajax({
            url :"../dashboard/XuLy/userSetting.php",
            method:"POST",
            data : {userId: userId ,state: state ,do : $do},
            datatype :'json',
            success:function(data)
            {
                console.log(data);
                data = JSON.parse(data);
                // alert("Done");
                $("#"+userId+"-state").html(data.state);
                $("#"+userId+"-state-btn").html(data.stateBtn);
                $("#"+userId+"-authen").html(data.authentication);
                reloadComboBox("#"+userId+"-row");
                // window.location.reload();
            }
        })
    }


    function resetPass(userId)
    {
        $do = "resetPass";
        $.ajax({
            url :"../dashboard/XuLy/userSetting.php",
            method:"POST",
            data : {userId: userId ,do : $do},
            datatype :'json',
            success:function(data)
            {
                console.log(data);
                alert("Done");
                // window.location.reload();
            }
        })
    }

    function reloadComboBox($this)
    {
        if($this == null)
        {
            $class=".js-select2-user";
        }
        else
        {
            $class=""+$this+" .js-select2-user";
        }

        "use strict";
        try {
            $.each($($class),function () {
            //   console.log("1");
              $(this).select2({
                minimumResultsForSearch: 20,
                dropdownParent: $(this).next('.dropDownSelect2')
              });
            });
        
          } catch (error) {
            console.log(error);
          }
    }

    function activeMenuItem()
    {
        $url = $(location).attr("href");
        $parts = $url.split("/");
        $last_part = $parts[$parts.length-1];
        console.log($last_part)
        switch ($last_part)
        {
            case "admin.php":
                $(".dashboard").addClass("active");
            break;
            case "productTable.php":
                $(".product").addClass("active");
            break;
            case "userTable.php":
                $(".user").addClass("active");
            break;
            case "receiptTable.php":
                $(".receipt").addClass("active");
            break;
        }
    }

    function sweetAlert(type,message)
    {
        Swal.fire(
            {
                type: type,
                title: message,
            }
        )
    }
})