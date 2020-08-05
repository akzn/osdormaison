<?php
session_start();
if ($_GET['ajax']) {
	include_once "../config/conn.php";
	include_once "../config/general_helper.php";
}
if ($_SESSION['key_data']) {
	$key = $_SESSION['key_data'];
	$get_cart = "select id_cart,tb_produk.id_produk,nama_produk,tb_cart.harga,gambar,qty
	 			from tb_cart join tb_produk on tb_produk.id_produk=tb_cart.id_produk where order_key='$key' order by id_cart desc";

	$res = mysql_query($get_cart);
	//var_dump($get_cart);
	//unset($_SESSION['key_data']);
	while($row = mysql_fetch_array($res)){
		$subtotal = $row['qty']*$row['harga'];
	?>


	<div class="row">
		<div class="col-md-3">
			<img src="<?=BASE?>admin/img/produk/<?=$row['gambar']?>.jpg" alt="produk-img" class="img img-thumbnails img-responsive">
		</div>
		<div class="col-md-9">
			<div><h4><?=$row['nama_produk']?></h4></div>
			<div><p>Qty : <?=$row['qty']?></p></div>
			<div><p>Subtotal : <?=uang($subtotal)?></p></div>
		</div>
	</div>



	<?php  $total = $total+$subtotal;
	}
	?>
	<hr>
	<div class="row">
		<div class="col-md-12 text-right">
			<h4>Total : <?=uang($total)?></h4>
		</div>
		<div class="col-md-12 text-right btn-checkout">
			<a href="<?=BASE?>?hal=checkout" class="btn btn-info">Checkout</a>
		</div>
	</div>

	<?php
} else {
	?>

	<div class="row">
		<div class="col-md-12">
			<div><p>keranjang belanja kosong</p></div>
		</div>
	</div>

	<?php
}
?>
