<?php session_start(); ?>
<html>
<head>
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
</head>
<body>
<?php
	// include database connection
	require("config/db-connection.php");
	
	// validate is login
	if (isset($_SESSION['login_name']) && isset($_SESSION['role']) ){
			
		// validate role is not "admin"
		if (strtoupper($_SESSION['role'])!="ADMIN"){
			echo "คุณไม่มีสิทธิ์ในการเข้าถึงหน้าสำหรับจัดการ";
			exit;
		}
?>
<div class="col-sm-12" style="margin-bottom: 20px;">
	<ul class="nav nav-pills">
		<li role="presentation" class="active"><a href="page_admin.php">หน้าหลัก</a></li>
		<li role="presentation"><a href="form_product.php" target="_blank">เพิ่มสินค้า</a></li>
		<li role="presentation"><a href="action_logout.php" target="_blank">Logout</a></li>
	</ul>
</div>
<div class="container-fluid" style="margin-top: 20px;">
	<?php		
		// include product table
		include("list_products.php");
	?>
</div>
<?php
	}
	else {
		// redirect to login page
		header("location: ../login.php");
	}
?>
</body>
</html>
<!-- This source code for educational purposes only. Made by Warin.P -->