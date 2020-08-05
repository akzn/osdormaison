<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Detail Barang</h3>
<a class="btn" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>

<?php
$id_brg=mysql_real_escape_string($_GET['id']);


$det=mysql_query("select * from tb_produk where id_produk='$id_brg'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
	?>					
	<div class="row">
		<div class="col-md-3">
			<img src="../img/produk/<?=$d['gambar']?>.jpg" class="img img-responsive img-thumbnail">
		</div>
		<div class="col-md-6">
			<table class="table">
				<tr>
					<td>Nama</td>
					<td><?php echo $d['nama_produk'] ?></td>
				</tr>
				<tr>
					<td>Harga</td>
					<td>Rp.<?php echo number_format($d['harga']) ?>,-</td>
				</tr>
				<tr>
					<td>Jumlah</td>
					<td><?php echo $d['stok'] ?></td>
				</tr>
				<tr>
					<td>Deskripsi Barang</td>
					<td><?php echo $d['deskripsi'] ?></td>
				</tr>
			</table>
		</div>
	</div>
		
	<?php 
}
?>
<?php include 'footer.php'; ?>