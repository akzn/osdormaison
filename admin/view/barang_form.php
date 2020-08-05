<?php 
include 'header.php';
$get_kat = mysql_query("SELECT * from tb_kategori");
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Tambah Barang</h3>
<a class="btn" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
				
	<form action="tmb_brg_act.php" method="post" id="form" enctype=multipart/form-data>
		<table class="table">
			<tr>
				<td>Gambar</td>
				<td>
					<br><input type="file" name="file" required>
				</td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama_produk" value="" required></td>
			</tr>
			<tr>
				<td>Kategori</td>
				<td>
					<select name="kategori" id="kategori">
						<option value="0">--pilih kategori--</option>
						<?php while($tow = mysql_fetch_array($get_kat)){
							?>
							<option value="<?=$tow['id_kategori']?>"><?=$tow['nama_kategori']?></option>
							<?php
						}?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input type="number" class="form-control" name="harga" value="" required></td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td><input type="number" class="form-control" name="stok" value="" required></td>
			</tr>
			<tr>
				<td>Deskripsi</td>
				<td><textarea name="deskripsi" class="form-control" rows="5"></textarea></td>
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