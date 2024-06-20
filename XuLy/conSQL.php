<?php
    
    // Create connection
    class conSQL
    {
        public static function executeQuery($sql)
        {
            include ('dbConfig.inc');
            //include_once('error.inc');
            // 1. Tao ket noi CSDL
            if (!($connection = mysqli_connect($hostName, $username, $password,$databaseName)))
                die ("couldn't connect to localhost");
            //2. Thiet lap font Unicode
            if (!(mysqli_query($connection,"set names 'utf8'")))
                showError();
            // Thuc thi cau truy van
            if (!($result = mysqli_query($connection,$sql)))
                showError();
            // Dong ket noi CSDL
            if (!(mysqli_close($connection)))
                showError();
            return $result;
        }
    }
?>