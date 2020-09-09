<?php include 'header.php';	?>
<h2>Detail Order</h2>
<a class="btn" href="order.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php
	$get_order = mysql_query("SELECT * from tb_order where id_order = '".$_GET['id']."' limit 1") or die(mysql_error());

	$status_order = '';
	
	while ($ord = mysql_fetch_array($get_order)) {
		$subtotal = $ord['subtotal'];
		$ongkir = $ord['ongkir'];
		$total_all = $ord['total'];
		$status_order = $ord['status'];
?>
<div class="row">
	<div class="col-md-6">
		<table class="table table-striped">
			<tr>
				<td style="text-align:left">Kode Order</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=$ord['kode_order']?></td>
			</tr>
			<tr>
				<td style="text-align:left">Pembeli</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=$ord['nama_penerima']?></td>
			</tr>
			<tr>
				<td style="text-align:left">Alamat</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=$ord['alamat']?></td>
			</tr>
			<tr>
				<td style="text-align:left">E-mail</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=$ord['email']?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<table class="table table-striped">
			<tr>
				<td style="text-align:left">Subtotal</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=uang($ord['subtotal'])?></td>
			</tr>
			<tr>
				<td style="text-align:left">Ongkos Kirim</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=$ord['ongkir']?></td>
			</tr>
			<tr>
				<td style="text-align:left">Jumlah</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=uang($ord['total'])?></td>
			</tr>
			<tr>
				<td style="text-align:left">Status Order</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=$ord['status']?></td>
			</tr>
		</table>
	</div>
</div>
<?php } ?>
<hr>
<h3>Items :</h3>
<div class="row">
<div class="col-md-12">
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Nama Produk</th>
			<th>Harga Satuan</th>
			<th>Qty</th>
			<th>Subtotal</th>
		</tr>

		<?php 
		$get_data_order = mysql_query("SELECT * from tb_order_detail
			join tb_produk on tb_produk.id_produk = tb_order_detail.id_produk
		 where id_order = '".$_GET['id']."' ") or die(mysql_error());
		$start =0;
		while ($var = mysql_fetch_array($get_data_order)): ?>
			<tr>
				<td><?=++$start?></td>
				<td><?=$var['nama_produk']?></td>
				<td style="text-align:right"><?=uang($var['harga'])?></td>
				<td><?=$var['jumlah']?></td>
				<td style="text-align:right"><?=uang($var['subtotal'])?></td>
			</tr>
		<?php endwhile ?>
		<tr>
			<td colspan="4" style="text-align:right"> SUBTOTAL</td>
			<td style="text-align:right"><?=uang($subtotal)?></td>
		</tr>
		<tr>
			<td colspan="4" style="text-align:right"> ONGKOS KIRIM</td>
			<td style="text-align:right"><?=uang($ongkir)?></td>
		</tr>
		<tr>
			<td colspan="4" style="text-align:right"> JUMLAH TOTAL</td>
			<td style="text-align:right"><?=uang($total_all)?></td>
		</tr>
	</table>
</div>
</div>

<div class="row">
	<div class="col-md-3">
		<p>Ubah Status Order <?=$status_order?></p>
	</div>
	<div class="col-md-9">
		<a href="set_status_order.php?id=<?=$_GET['id']?>&status=dikirim" class="btn btn-primary btn-status">Dikirim</a>
		<a href="set_status_order.php?id=<?=$_GET['id']?>&status=selesai" class="btn btn-info btn-status">Selesai</a>
	</div>
</div>

<?php include 'footer.php'; ?>

<script type="text/javascript">
	$(function(){
		var status = '<?=$status_order;?>';
		$('.btn-status').on('click',function(e){
			e.preventDefault();
			if (status=='pending') {
				e.preventDefault();
				alert('PEMBELI BELUM MELAKUKAN KONFIRMASI PEMBAYARAN !!');
			} else if (status=='transfer'){
				e.preventDefault();
				alert('STATUS PEMBAYARAN BELUM DISETUJUI ADMIN !!');
			} else {
				document.location.href=$(this).attr('href');
			}
		})
	})
</script>