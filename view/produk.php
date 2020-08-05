<?php
	$id_produk = $_GET['id'];
	$qry = "select * from tb_produk join tb_kategori on tb_kategori.id_kategori=tb_produk.id_kategori where id_produk = '".$id_produk."'";
	$sql = mysql_query($qry);
	if($sql === FALSE) { 
	    die(mysql_error()); // TODO: better error handling
	}
	$data = mysql_fetch_array($sql);

?>
<div class="row">
	<div class="col-md-6">
		<img class="img-responsive img-thumbnail" style="min-height:555px" src="<?=BASE?>admin/img/produk/<?=$data['gambar']?>.jpg">
	</div>
	<div class="col-md-6 product-detail">
		<h4 class="">Kategori : <?=$data['nama_kategori']?></h4>
		<h2><?=$data['nama_produk']?></h2>
		<h3 class="price"><?=uang($data['harga'])?></h3>
		<a href="" class="btn btn-primary add-to-cart" data-id='<?=$data['id_produk']?>' data-price='<?=$data['harga']?>'>Tambahkan ke keranjang</a>
		<h4>Deskripsi</h4>
		<p><?=$data['deskripsi']?></p>
	</div>
</div>