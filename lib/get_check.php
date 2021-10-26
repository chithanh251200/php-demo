
<?php 
    function get_customer_acount($user_account){
        global $conn;
        $sql = mysqli_query($conn , "SELECT id_account FROM `customer_account` WHERE `user_account` = '{$user_account}' ");
        $result = mysqli_fetch_assoc($sql);
        if(!empty($result)){
            return $result;
        }
    }
?>

