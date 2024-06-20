<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php
    include("./models/head.php");
?>
</head>

<body>
    <?php
        include("./models/header1.php");
        include("./models/contactModal.php");
        include("./models/footer.php");
        include("./models/shopbag.php");
    ?>

    <!-- ##### Footer Area Start ##### -->
    
    <!-- ##### Footer Area End ##### -->

    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Classy Nav js -->
    <script src="js/classy-nav.min.js"></script>
    <!--- AOS JS --->
    <script src="js/aos.js"></script>
    <script>
        AOS.init();
        
    </script>
    <!-- Active js -->
    <script src="js/script1.js"></script>
    <!--------------->
    <script src="MyJs/all.js"></script>
    <!-- Active js -->
    <script src="js/active.js"></script>
    <!-- Google Maps -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAwuyLRa1uKNtbgx6xAJVmWy-zADgegA2s"></script>
    <script src="js/map-active.js"></script>

</body>

</html>