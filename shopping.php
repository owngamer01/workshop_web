<!DOCTYPE html>
<?php require_once(__DIR__.'/config/connect.php'); ?>
<?php require_once(__DIR__.'/function_product.php'); ?>
<?php session_start(); ?>
<html lang="en">
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="dist/css/mycss.css" rel="stylesheet">
        <script src="dist/js/jquery-3.1.1.min.js"></script>
        <script src="dist/js/bootstrap.min.js"></script>
        
    </head>
     <!-- Large modal -->
    <div class="modal fade" id="shoppingModal" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Modal title</h4>
          </div>
          <div class="modal-body">
            <p>-- Data not found --</p>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <body>
    <header>
        <script>
    $( document ).ready(function() {
      $( window ).scroll(function() {
          var height = $(window).scrollTop();
          console.log(height);
          if(height  > 50) {
            $("body").addClass("scl_inited");
          }
          else{
            $("body").removeClass("scl_inited");
          }
      });
    });
    </script>
    
    <script>
    $( document ).ready(function() {
     $('.product-card_cert').click(function(){
       let count   = $('#count_cart').attr("count");
       let display = 0;
       count = +count + 1;

       if (count > 99) {
           display = "10+";

       } else {
           display = count;

       }
       $('#count_cart').attr("count", count);
       $('#count_cart').html(display);

       let _id = $(this).parent().parent().attr('id');
       _id      = _id.replace('product-', '');

       if ( !$('input[name="product-'+_id+'"]').attr('value')) {
          let _str =  '<input type="hidden" name="product-'+_id+'" value="1" />';
          $('#form-cart').append(_str);


       } else {
          let val = $('input[name="product-'+_id+'"]').val();
          let _val = +val + 1;
          $('input[name="product-'+_id+'"]').val(_val);

       }

     });
     $('#btn-cart').click(function(){
        $.post( "products_modal.php", $( "#form-cart" ).serialize() , function( data ) {
            $("#shoppingModal .modal-body").html(data);
        });
     }); 
   });
    </script>
      <div id="menu" class="container-fluid while">
          <ul class="nav navbar-nav">
            <li><a href="#" class="white">Home</a></li>
            <li><a href="#" class="white">Link</a></li>
            <li><a href="#" class="white">Link</a></li>
          </ul>
      </div>
       <div id="search" class="container-fluid">
         <div class="row" style="padding-bottom: 10px">
           <div class="col-xs-12 col-md-3">
              <div class="logo">
                 <span class="glyphicon glyphicon-fire"></span> Kimuchi.io
              </div>
           </div>
           <div class="col-xs-12 col-md-6">
            <form class="form-inline" >
              <div class="form-group white w100">
                <div class="input-group white w100">
                   <input type="text" class="form-control gray" id="inputsearch">
                     <div class="input-group-addon" style="width:1%;">
                        <span class="glyphicon glyphicon-search"></span>
                     </div>
                </div>
              </div>
            </form>
           </div>
           <div class="icon-menu col-xs-12 col-md-3">
              <div id="btn-cart" data-toggle="modal" data-target="#shoppingModal">
              <div id="cart">
                  <img src="image/shopping-cart.png" />
              </div>
              <div id="count_cart" count="0">0</div>
              <div id="in-cart">
                  <form id="form-cart"></form>
             </div>
            </div>
           </div>
         </div>
        </div>
    </header>

    <div id="body" class="container-fluid">
        <div class="row">

        <div class="col-xs-2 col-md-2">
                55
        </div>
         <div class="col-xs-10 col-md-10">
          <?php $data_product = get_products($con); 
                if($data_product['result'] != false) {
                foreach($data_product['data'] as $key => $value) { ?>
                <div class="product" id="product-<?= $value['product_id'] ?>">
                    <div class="product-card_img">
                        <center><img src="products/<?= $value['product_img'] ?>" class="img_shopping img-rounded" width="200" height="200"></center>
                    </div>
                    <div class="product-card_description">
                        <div class="product-card_name">
                            <?= $value['product_name'] ?>
                        </div>
                        <div class="product-card_rate">
                            <?php $rate = 3; ?>
                            <?php  for ($star = 0; $star < 5; $star++) { ?>
                                <?php if ($rate > $star) {  ?>
                                    <img src="image/favorite.png"/>
                                <?php } else  {  ?>
                                    <img src="image/star-c.png"/>
                                <? } ?>     
                            <?php } //End for ?>
                         <?php } //End for ?>
                        </div>
                        <div class="product-card_price"> <?= number_format($value['product_price'], 2) ?> </div>
                        <div class="product-card_cert"> ใส่ตระกร้า </div>
                    </div>
                </div>
          <?php } ?>
        <?php } ?>
        </div>
        <!--row-->
        </div>
        
    <!--col-md-12-->
    </div>



    </body>

    
</html>