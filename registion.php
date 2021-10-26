<?php
	require 'config/db.php';
	require 'helper/show_data.php';
?>
<?php

    if(isset($_POST['btn-submit'])){

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $sql =  mysqli_query($conn ,"INSERT INTO `customer_account` (`user_account`, `pass_account`)
        VALUES ('$username' , '$password') ");       

        // $row = mysqli_num_rows($sql);

        // if($row > 0){
        //     echo "thành công";
           
        // }
        // else{
        //     echo  "không thành công";
        // }


        header('location:login.php');
    
  

    }

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang đăng ký</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="asset/public/registion/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="asset/public/registion/css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form action="" method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="username" id="username" placeholder="Your name"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btn-submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="#" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="asset/public/registion/vendor/jquery/jquery.min.js"></script>
    <script src="asset/public/registion/js/main.js"></script>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>