<pre>
<?php

  require_once(__DIR__.'/config/connect.php');
  require_once(__DIR__.'/function_product.php');

  if ( isset($_POST) && count($_POST) > 0 ) {
    echo '<table>';
        echo '<tr>';
            echo '<th colspan="2"> สินค้า </th>';
            echo '<th> ราคา  </th>';
            echo '<th> จำนวน </th>';
        echo '</tr>';
    foreach ($_POST as $key => $value) { 
       if ( strpos($key, "product-") == 0) {
           $_id   = str_replace('product-', '', $key);
           $_pd   = get_products($con, $_id);
           if ($_pd['result'] === true) {
             $_info = $_pd['data'][$_id];
             echo '<tr>';
                echo "<td colspan='2'> <img src='products/{$_info['product_img']}' width='100' height='100' /> </td>";
                echo "<td> {$_info['product_price']} </td>";
                echo "<td> {$value} </td>";
             echo '</tr>';
           }
       }
    }

  }
