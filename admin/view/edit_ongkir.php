<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Ongkos Kirim</h3>
<a class="btn" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php



$id_prov=mysql_real_escape_string($_GET['id']);
$det=mysql_query("select * from tb_ongkir a join tb_provinsi b on a.id_wilayah = b.id_provinsi where id_provinsi='$id_prov'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>				
	<form action="update_ongkir.php" method="post" enctype=multipart/form-data>
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_provinsi" value="<?php echo $d['id_provinsi'] ?>"></td>
			</tr>
			<tr>
				<td>Nama Provinsi</td>
				<td><input type="text" class="form-control" name="nama_provinsi" value="<?php echo $d['nama_provinsi'] ?>"></td>
			</tr>
			<tr>
				<td>Ongkos Kirim</td>
				<td><input type="text" class="form-control" name="ongkir" value="<?php echo $d['ongkir'] ?>"></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>
	<?php 
}
?>
<?php include 'footer.php'; ?>