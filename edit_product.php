<?php
// detect product ID isset for editing mode
if (isset($_POST['product_id'])){
	
	// include database connection
	require("config/connect.php");
	var_dump($_FILES);
	// product ID
	$product_id    = $_POST['product_id'];
	$product_name  = addslashes($_POST['product_name']);
	$product_price = str_replace(",", "", addslashes($_POST['product_price']));
	$product_image = $_FILES['product_img']['name'];
	$type_img      = array('jpg', 'png', 'jpeg');

	//folder of files img
    $target_file       = 'products/' . basename($product_image);

    //jpg, png or jpeg
    $img_type          = pathinfo($target_file, PATHINFO_EXTENSION);  

	 if( in_array($img_type, $type_img) ) {

      	if (move_uploaded_file($_FILES["product_img"]["tmp_name"], 'products/' . basename($product_image)) ) {
			echo 'upload สำเร็จ';
                           
                            
        } else {
            // file can't move upload
            echo "Sorry, error upload your file";
            $status_move = true;
        }


	
	// delete product by ID
	$query = "UPDATE `products` SET `product_name`='".$product_name."', `product_price`='".$product_price."' WHERE `product_id` LIKE '".$product_id."'";
	$query .= ", `product_img ` = '".$product_image."' ";
	
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
}