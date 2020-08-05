<?php 
include 'header.php';

?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Tambah Barang</h3>
<a class="btn" href="berita.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
				
	<form action="tmb_berita_act.php" method="post" id="form" enctype=multipart/form-data>
		<table class="table">
			<tr>
				<td>Gambar</td>
				<td>
					<br><input type="file" name="file" required>
				</td>
			</tr>
			<tr>
				<td>Judul</td>
				<td><input type="text" class="form-control" name="judul" value="" required></td>
			</tr>

			<tr>
				<td>Isi</td>
				<td><textarea class="form-control" rows="20" name="isi" required=""></textarea></td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" class="btn btn-info" value="Simpan"></td>
			</tr>
		</table>
	</form>

<?php include 'footer.php'; ?>


<script type="text/javascript">
	$('#form').on('submit',function(){
		if ($('#kategori').val()==0) {
			alert('Harap pilih jenis kategori');
			return false
		} else return true;
		return false;
	});
</script>