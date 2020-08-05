<?php include 'header.php';	?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Pemesanan</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2 hidden"><span class="glyphicon glyphicon-pencil"></span>  Entry</button>
<form action="" method="get">
	<div class="input-group col-md-5">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="tanggal" class="form-control" onchange="this.form.submit()">
			<option>Pilih tanggal ..</option>
			<option>All</option>
			<?php 
			$pil=mysql_query("select distinct tgl_order from tb_order order by tgl_order desc");
			while($p=mysql_fetch_array($pil)){
				?>
				<option><?php echo $p['tgl_order'] ?></option>
				<?php
			}
			?>			
		</select>
	</div>

</form>
<br/>
<?php 
if((isset($_GET['tanggal']))&&($_GET['tanggal']!='All')){
	//echo $_GET['tanggal'];die;
	$tanggal=mysql_real_escape_string($_GET['tanggal']);
	$tg="lap_order.php?tanggal='$tanggal'";
	?><a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Cetak</a><?php
}else{
	$tg="lap_order.php";
}
?>

<br/>
<?php 
if((isset($_GET['tanggal']))&&($_GET['tanggal']!='All')){
	echo "<h4> Data Penjualan Tanggal  <a style='color:blue'> ". $_GET['tanggal']."</a></h4>";
}
?>
<table class="table">
	<tr>
		<th>No</th>
		<th>Tanggal</th>
		<th>Kode Order</th>
		<th>Status</th>
		<th>Total</th>
		<th>Ongkir</th>
		<th>Jumlah</th>						
		<th>Opsi</th>
	</tr>
	<?php 
	if((isset($_GET['tanggal']))&&($_GET['tanggal']!='All')){
		$tanggal=mysql_real_escape_string($_GET['tanggal']);
		$brg=mysql_query("select * from tb_order where tgl_order like '$tanggal' order by tgl_order desc");
	}else{
		$brg=mysql_query("select * from tb_order order by tgl_order desc");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

		?>
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['tgl_order'] ?></td>
			<td><?php echo $b['kode_order'] ?></td>
			<td><?php echo $b['status'] ?></td>
			<td><?php echo uang($b['subtotal']) ?></td>
			<td><?php echo uang($b['ongkir']) ?></td>
			<td><?php echo uang($b['total']) ?></td>					
			<td>		
				<a href="detail_order.php?id=<?php echo $b['id_order']; ?>" class="btn btn-warning btn-xs">Detail</a>
				<a onclick="if(confirm('Apakah anda yakin ingin menghapus data ini ??')){ location.href='hapus_order.php?id=<?php echo $b['id_order']; ?>' }" class="btn btn-danger btn-xs">Hapus</a>
			</td>
		</tr>

		<?php 
	}
	?>
	<tr>
		<td colspan="5">Total Pemasukan</td>
		<?php 
		if((isset($_GET['tanggal']))&&($_GET['tanggal']!='All')){
			$tanggal=mysql_real_escape_string($_GET['tanggal']);
			$x=mysql_query("select sum(total) as total from tb_order where tgl_order='$tanggal'");	
			$xx=mysql_fetch_array($x);			
			echo "<td><b> Rp.". number_format($xx['total']).",-</b></td>";
		}else{
			$x=mysql_query("select sum(total) as total from tb_order");	
			$xx=mysql_fetch_array($x);			
			echo "<td><b> Rp.". number_format($xx['total']).",-</b></td>";
		}

		?>
	</tr>
</table>

<!-- modal input -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Tambah Penjualan
				</div>
				<div class="modal-body">				
					<form action="barang_laku_act.php" method="post">
						<div class="form-group">
							<label>Tanggal</label>
							<input name="tgl" type="text" class="form-control" id="tgl" autocomplete="off">
						</div>	
						<div class="form-group">
							<label>Nama Barang</label>								
							<select class="form-control" name="nama">
								<?php 
								$brg=mysql_query("select * from tb_produk");
								while($b=mysql_fetch_array($brg)){
									?>	
									<option value="<?php echo $b['nama_produk']; ?>"><?php echo $b['nama_produk'] ?></option>
									<?php 
								}
								?>
							</select>

						</div>									
						<div class="form-group">
							<label>Harga Jual / unit</label>
							<input name="harga" type="text" class="form-control" placeholder="Harga" autocomplete="off">
						</div>	
						<div class="form-group">
							<label>Jumlah</label>
							<input name="jumlah" type="text" class="form-control" placeholder="Jumlah" autocomplete="off">
						</div>																	

					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
						<input type="reset" class="btn btn-danger" value="Reset">												
						<input type="submit" class="btn btn-primary" value="Simpan">
					</div>
				</form>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#tgl").datepicker({dateFormat : 'yy/mm/dd'});							
		});
	</script>
	<?php include 'footer.php'; ?>