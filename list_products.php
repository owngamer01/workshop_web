
<?php
require(__DIR__.'/config/connect.php');
// detect database connection
if (!empty($con)){
	// query products
	$query = "SELECT * FROM products";
	if ($result = mysqli_query($con, $query)){
		$num_rows = mysqli_num_rows($result);
		// have some product
		if ($num_rows > 0){ ?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
				<table class="table table-striped">
					<thead>
						<tr>
							<th width="4%">ลำดับ</th>
							<th width="5%">&nbsp;</th>
							<th width="55%">ชื่อสินค้า</th>
							<th width="20%" style="padding-right: 60px;"><div style="text-align:right;">ราคา</div></th>
							<th width="16%"><div style="text-align:center">แก้ไข / ลบ</div></th>
						</tr>
					</thead>
					<tbody><?php
					// each row
					$i=0;
					while ($rows = mysqli_fetch_assoc($result)){ ?>
						<tr>
							<td><?php echo ++$i; ?></td>
							<td><img src="products/<?php echo $rows['product_img']; ?>" width="60" height="60" /></td>
							<td><?php echo $rows['product_name']; ?></td>
							<td align="right" style="padding-right: 60px;"><?php echo number_format($rows['product_price'], 2); ?></td>
							<td align="center"><a href="form_product.php?product_id=<?php echo $rows['product_id']; ?>">แก้ไข</a> / <a href="delete_product.php?product_id=<?php echo $rows['product_id']; ?>">ลบ</a></td>
						</tr><?php 
					} ?>
					</tbody>
				</table>
			</div>
		</div>
	</div><?php
		}
		else {
			echo "ไม่พบรายการสินค้า";
		}
	}
	else {
		echo "Query error: ".mysqli_error($con);
	}
}
else {
	echo "ไม่พบการเชื่อมต่อฐานข้อมูล";
}