<?php 
include 'header.php';
$id = $_GET['id'];
$get_berita = mysql_query("SELECT * from tb_berita where id_berita='$id'") or die(mysql_error());
$data=mysql_fetch_row($get_berita);
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Tambah Barang</h3>
<a class="btn" href="berita.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
				
		<table class="table">
			<tr>
				<td>Gambar</td>
				<td>
					<br><img src="<?=BASE?>admin/img/berita/<?=$data[3]?>.jpg" class="img img-responsive img-thumbnail" width="200">
				</td>
			</tr>
			<tr>
				<td>Judul</td>
				<td><input type="text" class="form-control" name="judul" value="<?=$data[1]?>" required disabled value=""></td>
			</tr>

			<tr>
				<td>Isi</td>
				<td><textarea class="form-control" rows="20" name="isi" required disabled><?=$data[2]?></textarea></td>
			</tr>
		</table>


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