<?php 
include 'header.php';
$get_kat = mysql_query("SELECT * from tb_kategori");
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Tambah Wilayah</h3>
<a class="btn" href="ongkos_kirim.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
				
	<form action="tmb_ongkir_act.php" method="post" id="form" enctype=multipart/form-data>
		<table class="table">
			<tr>
				<td>Provinsi</td>
				<td><input type="text" class="form-control" name="nama_provinsi" value="" required></td>
			</tr>
			<tr>
				<td>Ongkos Kirim</td>
				<td><input type="number" class="form-control" name="ongkir" value="" required></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>

<?php include 'footer.php'; ?>


<script type="text/javascript">

</script>