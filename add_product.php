<link href="dist/css/mycss.css" rel="stylesheet">
<link href="dist/css/bootstrap.min.css" rel="stylesheet">
<?php

    //using variable connection
    require_once(__DIR__.'/config/connect.php');

    // need table_name
    $tb_name  = 'products';

    $product_name      = $_POST['product_name'];
    $product_img_name  = $_FILES['product_img']['name'];
    $product_price     = $_POST['product_price'];
    $name_duplicate    = '';
    $type_img          = array('jpg', 'png', 'jpeg');
    $status_move       = false;

    //folder of files img
    $target_file       = 'products/' . basename($product_img_name);

    //jpg, png or jpeg
    $img_type          = pathinfo($target_file, PATHINFO_EXTENSION);  

    try {
        //Connection
        $con = new PDO("{$type}:host={$host};dbname={$db_name};charset=utf8", $user_db, $pass_db);


        if( isset($_FILES) ) {
            
            // file name duplicate
            if (file_exists($target_file)) {
                $name_duplicate = md5(microtime());

            }

            $column = 'product_id, product_name, product_img, product_price, lastupdate';
            $value  = "NULL, '{$product_name}', '{$name_duplicate}{$product_img_name}', '{$product_price}', CURRENT_TIMESTAMP";

                //Max size 5MB
                if ($_FILES["product_img"]["size"] <= 500000) {

                    if( in_array($img_type, $type_img) ) {

                        if (move_uploaded_file($_FILES["product_img"]["tmp_name"], 'products/' . $name_duplicate.basename($product_img_name)) ) {

                            $sql = $con->prepare("INSERT INTO {$db_name}.{$tb_name} ({$column}) VALUES ({$value})"); 
                            $rs = $sql->execute();
                            
                            if($rs) {
                                echo "
                                    <center>
                                    <div class='panel panel-default form-start form-group3'>
                                        <div class='panel-heading theme_bg alLeft'><h4><span class=''> </span> Completed Upload </h4></div>
                                        <div class='panel-body theme_ft'> 
                                            <img src='{$target_file}' width='290px' height='300px' /> 
                                            <br /><br />
                                            File name : {$product_img_name}
                                        </div>
                                        <div class='panel-footer theme_bg alRight'> <a href='list_products.php' class='theme_bg'> back to homepage </a> </div>
                                    </div>
                                    </center>
                                ";
                            }
                            
                        } else {
                            // file can't move upload
                            echo "Sorry, error upload your file";
                            $status_move = true;
                        }
                        
                    } else {
                    // type not match
                    echo "type is must jpg, png, jpeg";
                    }

                } else {
                    // size maxover
                    echo "size is over";
                }

        } else {
            echo 'not send file';

        }


    } catch (Exception $ex) {
        echo 'Error [code] => ' . $ex;

    }










?>