
<?php
    session_start();

    // xóa session 
    unset($_SESSION['is_login']);
    unset($_SESSION['is_email']);

    // điều hướng đến trang login
    header('location:login.php');

?>