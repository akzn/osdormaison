<?php include 'header.php'; ?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Barang</h3>
<a href="barang_form.php" style="margin-bottom:20px"  class="btn btn-info col-md-2"><span class="glyphicon glyphicon-plus"></span>Tambah Barang</a>
<br/>
<br/>
<?php 
$per_hal=10;
$jumlah_record=mysql_query("SELECT id_produk as jum from tb_produk") or die(mysql_error());
$jum=mysqli_num_rows($jumlah_record);
$halaman=ceil($jum / $per_hal);
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $per_hal;
?>
<div class="col-md-12">
	<table class="col-md-2">
		<tr>
			<td>Jumlah Record</td>		
			<td><?php echo $jum; ?></td>
		</tr>
		<tr>
			<td>Jumlah Halaman</td>	
			<td><?php echo $halaman; ?></td>
		</tr>
	</table>
	<a style="margin-bottom:10px" href="lap_barang.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Download PDF</a>

	<a style="margin-bottom:10px" href="lap_barang_excel.php" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Download Excel</a>
</div>
<form action="cari_act.php" method="get">
	<div class="input-group col-md-5 col-md-offset-7">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Cari barang di sini .." aria-describedby="basic-addon1" name="cari">	
	</div>
</form>
<br/>
<table class="table table-hover">
	<tr>
		<th class="col-md-1">No</th>
		<th class="col-md-2">Gambar</th>
		<th class="col-md-2">Nama Barang</th>
		<th class="col-md-2">Kategori</th>
		<th class="col-md-2">Harga Jual</th>
		<th class="col-md-1">Jumlah</th>
		<th class="col-md-2">Opsi</th>
	</tr>
	<?php 
	if(isset($_GET['cari'])){
		$cari=mysql_real_escape_string($_GET['cari']);
		$brg=mysql_query("select * from tb_produk 
			join tb_kategori on tb_kategori.id_kategori = tb_produk.id_kategori
			where nama_produk like '%$cari%' order by id_produk desc limit $start, $per_hal")or die(mysql_error());
	}else{
		$brg=mysql_query("select * from tb_produk 
			join tb_kategori on tb_kategori.id_kategori = tb_produk.id_kategori
			order by id_produk desc limit $start, $per_hal")or die(mysql_error());
	}
	$no=$start+1;
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><img src="../img/produk/<?=$b['gambar']?>.jpg" width="50" class="img img-responsive img-thumbnail"></td>
			<td><?php echo $b['nama_produk'] ?></td>
			<td><?php echo $b['nama_kategori'] ?></td>
			<td>Rp.<?php echo number_format($b['harga']) ?>,-</td>
			<td><?php echo $b['stok'] ?></td>
			<td>
				<a href="det_barang.php?id=<?php echo $b['id_produk']; ?>" class="btn btn-info btn-xs">Detail</a>
				<a href="edit.php?id=<?php echo $b['id_produk']; ?>" class="btn btn-warning btn-xs">Edit</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus.php?id=<?php echo $b['id_produk']; ?>' }" class="btn btn-danger btn-xs">Hapus</a>
			</td>
		</tr>		
		<?php 
	}
	?>
</table>
<ul class="pagination">			
			<?php 
			for($x=1;$x<=$halaman;$x++){
				?>
				<li class="<?= ($x == $page)? 'active' : '' ?>"><a href="?page=<?php echo $x ?>"><?php echo $x ?></a></li>
				<?php
			}
			?>						
		</ul>
<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Barang Baru</h4>
			</div>
			<div class="modal-body">
				<form action="tmb_brg_act.php" method="post">
					<div class="form-group">
						<label>Nama Barang</label>
						<input name="nama" type="text" class="form-control" placeholder="Nama Barang ..">
					</div>
					<div class="form-group">
						<label>Jenis</label>
						<input name="jenis" type="text" class="form-control" placeholder="Jenis Barang ..">
					</div>
					<div class="form-group">
						<label>Suplier</label>
						<input name="suplier" type="text" class="form-control" placeholder="Suplier ..">
					</div>
					<div class="form-group">
						<label>Harga Modal</label>
						<input name="modal" type="text" class="form-control" placeholder="Modal per unit">
					</div>	
					<div class="form-group">
						<label>Harga Jual</label>
						<input name="harga" type="text" class="form-control" placeholder="Harga Jual per unit">
					</div>	
					<div class="form-group">
						<label>Jumlah</label>
						<input name="jumlah" type="text" class="form-control" placeholder="Jumlah">
					</div>																	

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
					<input type="submit" class="btn btn-primary" value="Simpan">
				</div>
			</form>
		</div>
	</div>
</div>



<?php 
include 'footer.php';

?>