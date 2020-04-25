<?php
    session_start();
    //makes sure user is logged on as admin
    if ($_SESSION['is_valid_admin'] == FALSE) {
        header("Location: admin_login.php");
    }
?>