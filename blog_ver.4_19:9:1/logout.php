<?php
    session_start();

    // if(!empty($_POST['btn_logout']) ) {
        unset($_SESSION['user_loginid']);
        header('Location: login.php');
    // }
?>
