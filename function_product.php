<?php

    require_once(__DIR__.'/config/connect.php');
    function get_products($con, $id = null){
        $data   = array();
        $return = array();
        $return['result'] = false;
        $sql     = "SELECT * FROM products";

        if ( trim($id) != '') {
            $sql.= " WHERE product_id = '".addslashes($id)."' ";

        }
        $result  = mysqli_query($con, $sql) or die('Query false'); 
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $data[ $row['product_id'] ] = $row;
                
            }
            $return['result'] = true;
            $return['data'] = $data;
            
        }
        return $return;

    }

?>