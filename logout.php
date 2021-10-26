<?php

    session_start();

    unset($_SESSION['is_account']);
    unset($_SESSION['is_username']);

    header('location:index.php');

?>