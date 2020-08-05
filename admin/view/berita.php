<?php include 'header.php';	?>
<h3>Berita</h3>

<a href="berita_form.php" class="btn btn-primary btn-lg">Tambah Berita</a>
<hr>
<div class="row">
		<div class="col-md-12">
			<table class="table table-striped table-bordered">
				<tr>
					<th>No</th>
					<th>Judul</th>
					<th>Deskripsi</th>
					<th>Gambar</th>
					<th>Aksi</th>
				</tr>
<?php
	$get_berita = mysql_query("SELECT * from tb_berita order by id_berita desc") or die(mysql_error());
	
	while ($ord = mysql_fetch_array($get_berita)) {
		$start=0;
?>

				<tr>
					<td><?=++$start?></td>
					<td><?=$ord['judul']?></td>
					<td><a href="berita_detail.php?id=<?=$ord['id_berita']?>">Baca</a></td>
					<td><img src="<?=BASE?>admin/img/berita/<?=$ord['gambar']?>.jpg" class="img img-responsive img-thumbnail" width="100"></td>
					<td>
						<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_berita.php?id=<?php echo $ord['id_berita']; ?>' }" class="btn btn-danger btn-xs">Hapus</a>
					</td>
				</tr>
			
<?php
}
?>

</table>
		</div>
	</div>