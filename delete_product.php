<?php
// detect product ID isset for editing mode
if (isset($_GET['product_id'])){
	
	// include database connection
	require("config/connect.php");
	
	// product ID
	$product_id = addslashes($_GET['product_id']);
	
	// delete product by ID
	$query = "DELETE FROM `products` WHERE `product_id` LIKE '".$product_id."'";
	if ($result = mysqli_query($con, $query)){
		
		// redirect to ref page
		if (isset($_SERVER['HTTP_REFERER'])){
			header("location: ".$_SERVER['HTTP_REFERER']);
		}
		else {
			echo "ลบสินค้าเรียบร้อย";
		}
	}
	else {
		echo mysqli_error($con);
	}
}