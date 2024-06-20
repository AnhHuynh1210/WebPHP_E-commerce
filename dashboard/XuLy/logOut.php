<?php
    session_start();
    unset($_SESSION["user"]);
    unset($_SESSION["AUTHENTICATION"]);
    $_SESSION['isLOGIN'] = 0;
?>