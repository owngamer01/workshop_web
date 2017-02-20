<?php
session_start();

// validate is login 
if (isset($_SESSION['user_name']) && isset($_SESSION['role']) ){
		
	// validate role is not "admin"
	if (strtoupper($_SESSION['role'])!="ADMIN"){
		echo "คุณไม่มีสิทธิ์ในการเข้าถึงหน้าสำหรับจัดการ";
		exit;
	}
	
	// set default variables
	$editing_mode = false;	
	$_PRODUCT = array();
	$_PRODUCT['product_name']  = "";
	$_PRODUCT['product_price'] = "";
	$_PRODUCT['product_img']   = "";
	
	
	// detect product ID isset for editing mode
	if (isset($_GET['product_id'])){
		
		// include database connection
		require("config/connect.php");
		
		// product ID
		$product_id = addslashes($_GET['product_id']);
		
		
		// get product detail
		$query = "SELECT * FROM `products` WHERE `product_id` LIKE '".$product_id."'";
		if ($result = mysqli_query($con, $query)){
			$num_rows = mysqli_num_rows($result);
			if ($num_rows === 1){
				$row = mysqli_fetch_assoc($result);
				$_PRODUCT['product_id'] = $row['product_id'];
				$_PRODUCT['product_name'] = $row['product_name'];
				$_PRODUCT['product_price'] = $row['product_price'];
				$_PRODUCT['product_img'] = $row['product_img'];
				
				$editing_mode = true;
			}
		}
	}

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">
		<link href="dist/css/mycss.css" rel="stylesheet">
		<link href="dist/css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
    </head>
    <body>

    <form action="<?= ($editing_mode ? 'edit_product.php' : 'add_product.php'); ?>" class="form-start-add" method="post" enctype="multipart/form-data">
	   <div class="form-group2 theme_ft">
		 <center> <h1><span class="glyphicon glyphicon-pencil"></span> Your Product</h1> </center>
	   </div>
	   <div class="form-group2 theme_ft">
	      <label for="product_name">Product name </label>
	      <input type="text" class="form-control" name="product_name" id="product_name" value="<?=$_PRODUCT['product_name'] ?>" >
	   </div>
	   <div class="form-group2 theme_ft">
	     <label for="product_price">Product price</label>
	     <input type="text" class="form-control" name="product_price" id="product_price"  value="<?=$_PRODUCT['product_price'] ?>" >
	   </div>
	   <div class="form-group2">
	       		<input class="file" type="file" name="product_img" />
	   </div>
	   <div class="form-group2">
		   <input name="product_id" value="<?=$_PRODUCT['product_id']?>" hidden>
	     <input type="submit" class="btn btn-primary w100" value="<?= ($editing_mode) ? "แก้ไขสินค้า" : "เพิ่มสินค้า" ; ?>" />
	   </div>
    </form>
    </body>
    <script src="dist/js/jquery-3.1.1.min.js"></script>
    <script src="dist/js/bootstrap.min.js"></script>
	<script src="dist/js/fileinput.js" type="text/javascript"></script>
	<script>
   
    $("#file-1").fileinput({
        uploadUrl: '#', // you must set a valid URL here else you will get an error
        allowedFileExtensions: ['jpg', 'png', 'gif'],
        overwriteInitial: false,
        maxFileSize: 1000,
        maxFilesNum: 10,
        //allowedFileTypes: ['image', 'video', 'flash'],
        slugCallback: function (filename) {
            return filename.replace('(', '_').replace(']', '_');
        }
    });
</script>
</html>