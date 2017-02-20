<?php
    session_start();

    //post by user
    $username = $_POST['username'];
    $password = $_POST['password'];

    //using variable connection
    require_once(__DIR__.'/config/connect.php');

    // need table_name
    $tb_name  = 'user_account';

    try {
        $con = new PDO("{$type}:host={$host};dbname={$db_name};charset=utf8", $user_db, $pass_db);
        $sql = $con->prepare(
                "SELECT * FROM {$db_name}.{$tb_name}  WHERE 
                    user_name = '{$username}' && 
                    user_pass = '{$password}' 
                "); 
        $sql->execute();
        $rs  = $sql->fetch(PDO::FETCH_ASSOC);
          
            // have data
            if ($rs != false) {
                $_SESSION['user_id']      = $rs['user_id'];
                $_SESSION['user_name']    = $rs['user_name'];
                $_SESSION['user_display'] = $rs['user_display'];
                $_SESSION['role']         = $rs['role'];

                switch (strtoupper($_SESSION['role'])){
					case "ADMIN" :
						$redirect_url = "page_admin.php";
					break;
					case "STAFF" :
						$redirect_url = "page_staff.php";
					break;
					case "CUSTOMER" :
						$redirect_url = "../";
					break;
				}

				header("location: ".$redirect_url);

            } else {
                header("location:login.php");

            }

    } catch (Exception $ex) {
        echo "Can't connection somethings wrong or Internet is false";
        
    }

    
?>  