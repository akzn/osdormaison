<?php 
include 'header.php';
?>
<h3><span class="glyphicon glyphicon-briefcase"></span>  Edit Barang</h3>
<a class="btn" href="barang.php"><span class="glyphicon glyphicon-arrow-left"></span>  Kembali</a>
<?php

$get_kat = mysql_query("SELECT * from tb_kategori");

$id_brg=mysql_real_escape_string($_GET['id']);
$det=mysql_query("select * from tb_produk where id_produk='$id_brg'")or die(mysql_error());
while($d=mysql_fetch_array($det)){
?>					
	<form action="update.php" method="post" enctype=multipart/form-data>
		<table class="table">
			<tr>
				<td></td>
				<td><input type="hidden" name="id_produk" value="<?php echo $d['id_produk'] ?>"></td>
			</tr>
			<tr>
				<td>Gambar</td>
				<td>
					<img src="../img/produk/<?=$d['gambar']?>.jpg" class="img img-responsive img-thumbnail" width="320">
					<br>Ganti Gambar
					<br><input type="file" name="file">
				</td>
			</tr>
			<tr>
				<td>Nama</td>
				<td><input type="text" class="form-control" name="nama_produk" value="<?php echo $d['nama_produk'] ?>"></td>
			</tr>
			<tr>
				<td>Kategori</td>
				<td>
					<select name="kategori" id="kategori">
						<?php while($tow = mysql_fetch_array($get_kat)){
							?>
							<option value="<?=$tow['id_kategori']?>" <?=($tow['id_kategori']==$d['id_kategori'])?'selected':'';?>><?=$tow['nama_kategori']?></option>
							<?php
						}?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Harga</td>
				<td><input type="text" class="form-control" name="harga" value="<?php echo $d['harga'] ?>"></td>
			</tr>
			<tr>
				<td>Jumlah</td>
				<td><input type="text" class="form-control" name="stok" value="<?php echo $d['stok'] ?>"></td>
			</tr>
			<tr>
				<td>Deskripsi</td>
				<td><input type="text" class="form-control" name="deskripsi" value="<?php echo $d['deskripsi'] ?>"></td>
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