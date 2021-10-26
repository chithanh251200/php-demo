<?php
	session_start();
?>

<?php
	require 'config/db.php';
	require 'helper/show_data.php';
?>
<?php
	if(isset($_POST['btn-submit'])){
		$error = array();
		if(empty($_POST['username'])){
			$error['username'] = "vui lòng nhập tại khoản username . không được để trống";
		}else{
			$username = $_POST['username'];
		}
		if(empty($_POST['password'])){
			$error['password'] = "vui lòng nhập tại khoản password . không được để trống";
		}else{
			$password = md5($_POST['password']);
		}

		// kiểm tra nếu không có lỗi
		if(empty($error)){

			// lấy dữ liệu 
			$sql = mysqli_query($conn , " SELECT * FROM `customer_account` WHERE `user_account` = '{$username}' and `pass_account` = '{$password}' ");
			 
			// kiểm tra bảng ghi có lớn hơn 1 không 
			$row = mysqli_num_rows($sql);

			// kiểm tra dữ liệu
			if($row > 0 ){
				$_SESSION['is_account'] = true;
				$_SESSION['is_username'] = $username;

				header('location:index.php');
			}
			else{
				echo "đăng nhập không thành công";
			}


		}

	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Trang Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="asset/public/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="asset/public/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="asset/public/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="asset/public/login/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="asset/public/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="asset/public/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="asset/public/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="asset/public/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="asset/public/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="asset/public/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="asset/public/login/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
				<form action="" method="POST" class="login100-form validate-form p-b-33 p-t-5">

					<div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input class="input100" type="text" name="username" placeholder="User name">
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input class="input100" type="password" name="password" placeholder="Password">
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<input class="login100-form-btn" type="submit" name="btn-submit" value="Login">
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="asset/public/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="asset/public/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="asset/public/login/vendor/bootstrap/js/popper.js"></script>
	<script src="asset/public/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="asset/public/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="asset/public/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="asset/public/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="asset/public/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="asset/public/login/js/main.js"></script>

</body>
</html>