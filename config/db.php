<?php
    $conn = mysqli_connect('localhost','root','','html_php_1_9_21');
    //kiểm tra kết nối
    if(empty($conn)){
        die('không thể kết nối csdl').mysql_error()->$conn;
    }else{  
        // echo "kết nối thành công";
    }
?>