
<?php
	//var_dump($_POST);die;
session_start();
if (!$_SESSION['key_data']) { ?>
	<meta http-equiv="refresh" content="0;url=<?=BASE?>?hal=home">
	<?php
	die();
}
	$insert = mysql_query("INSERT INTO 
tb_order(kode_order,`id_pelanggan`, `tgl_order`,`nama_penerima`,email,`alamat`,`id_provinsi`,kota,kodepos,no_telp,ongkir,subtotal,total)
VALUES('".$_POST['key']."','".$_POST['id_pelanggan']."','".date('Y-m-d')."','".$_POST['nama_pembeli']."','".$_POST['email']."','".$_POST['alamat']."','".$_POST['provinsi']."','".$_POST['kota']."','".$_POST['kodepos']."','".$_POST['telp']."','".$_POST['ongkirval']."','".$_POST['subtotal']."','".$_POST['total_all']."')") or die(mysql_error());

	if ($insert) {
		$get_id = mysql_query("select * from tb_order where kode_order = '".$_POST['key']."' limit 1")or die(mysql_error());
		//echo "select * from tb_order where order_key = ".$_POST['key']." limit 1";
		$fetch_id = mysql_fetch_row($get_id);
		$id_order = $fetch_id[0];
		//echo 'aa'.$id_order;
		if ($get_id) {
			$sql2 = mysql_query("select * from tb_cart where order_key = '".$_POST['key']."'");
			while ($row2 = mysql_fetch_array($sql2)) {
				$subtotal = $row2['qty']*$row2['harga'];
				$sql3 = mysql_query("insert into tb_order_detail(id_order,id_produk,harga,jumlah,subtotal)
					VALUES('$id_order','".$row2['id_produk']."','".$row2['harga']."','".$row2['qty']."','$subtotal')")or die(mysql_error());
				if ($sql3) {
					$sql4 = mysql_query("DELETE from tb_cart where order_key='".$_POST['key']."' and id_produk = '".$row2['id_produk']."'")or die(mysql_error());
				}
			}
			unset($_SESSION['key_data']);
		}
	}
	
	if ($id_order) {
		$get_data_order = mysql_query("SELECT nama_produk,tb_order_detail.harga,tb_order_detail.jumlah,tb_order_detail.subtotal 
FROM tb_order
JOIN tb_order_detail ON tb_order.`id_order`=tb_order_detail.`id_order`
JOIN tb_produk ON `tb_produk`.`id_produk` = `tb_order_detail`.`id_produk` where tb_order.id_order = $id_order ") or die(mysql_error());
	} 


	
?>

<style type="text/css">
    body{
        background-color: white;
        color: #000;
    }
</style>

<h2>Summary</h2>
<hr>
<div class="row">
	<div class="col-md-6">
		<table class="table table-striped">
			<tr>
				<td style="text-align:left">Kode Order</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=$_POST['key']?></td>
			</tr>
			<tr>
				<td style="text-align:left">Pembeli</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=$_POST['nama_pembeli']?></td>
			</tr>
			<tr>
				<td style="text-align:left">Alamat</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=$_POST['alamat']?></td>
			</tr>
			<tr>
				<td style="text-align:left">E-mail</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=$_POST['email']?></td>
			</tr>
		</table>
	</div>
	<div class="col-md-6">
		<table class="table table-striped">
			<tr>
				<td style="text-align:left">Subtotal</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=uang($_POST['subtotal'])?></td>
			</tr>
			<tr>
				<td style="text-align:left">Ongkos Kirim</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=$_POST['ongkir']?></td>
			</tr>
			<tr>
				<td style="text-align:left">Jumlah</td>
				<td style="text-align:left">:</td>
				<td style="text-align:left"><?=uang($_POST['total_all'])?></td>
			</tr>
		</table>
	</div>
</div>
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
		<?php while ($var = mysql_fetch_array($get_data_order)): ?>
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
			<td style="text-align:right"><?=uang($_POST['subtotal'])?></td>
		</tr>
		<tr>
			<td colspan="4" style="text-align:right"> ONGKOS KIRIM</td>
			<td style="text-align:right"><?=uang($_POST['ongkirval'])?></td>
		</tr>
		<tr>
			<td colspan="4" style="text-align:right"> JUMLAH TOTAL</td>
			<td style="text-align:right"><?=uang($_POST['total_all'])?></td>
		</tr>
	</table>
</div>
</div>

<div class="row">
	<div class="col-md-12">
		<h2>Transfer Pembayaran melalui bank berikut : </h2>
	</div>
</div>
<div class="row">
	<div class="col-md-4">
		<img class="img img-responsive img-thumbnail" src="images/Bank_Central_Asia.png">
	</div>
	<div class="col-md-5">
		<table class="table table-striped">
			<tr>
				<td>Rekening</td>
				<td>:</td>
				<td>8690656729</td>
			</tr>
			<tr>
				<td>Atas Nama</td>
				<td>:</td>
				<td>Farik</td>
			</tr>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<h3>Untuk konfirmas pembayaran, silakan memenuju halaman <a href="<?=BASE?>?hal=konfirmasi">Konfirmasi</a></h3>
	</div>
</div>


<?php
	
	$judul = 'Konfirmasi Pemesanan';
		$isi = 'Pemesanan anda dengan kode '. $_POST['key'] .' sudah masuk ke sistem. Silahkan lakukan konfirmasi ke web kami setelah melakukan pembayaran';
		mailer_1($judul,$isi,$_POST['email']);
		//mail($_POST['email'],"$judul",$isi);
?>