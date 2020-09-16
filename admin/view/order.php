<?php include 'header.php';	?>

<h3><span class="glyphicon glyphicon-briefcase"></span>  Data Pemesanan</h3>
<button style="margin-bottom:20px" data-toggle="modal" data-target="#myModal" class="btn btn-info col-md-2 hidden"><span class="glyphicon glyphicon-pencil"></span>  Entry</button>
<form action="" method="get" class="hidden">
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

<form action="" method="get" class="hidden">
	<div class="input-group col-md-5">
		<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
		<select type="submit" name="bulan" class="form-control" onchange="this.form.submit()">
			<option>Pilih Bulan ..</option>
			<option>All</option>
			<?php 
			for($i=1;$i<13;$i++)
				print("<option value=".$i.">".date('F',strtotime('01.'.$i.'.2001'))."</option>");
			?>			
		</select>
	</div>

</form>
<br/>

<div class="row">
	<div class="col-md-6">
		
<p>Filter Periode</p>	
<form action="order.php" method="post" class="form-inline">
	<div class="form-group">
		<div class="input-group col-md-5">
			<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
			<input type="date" name="fdate" value="<?=$_POST['fdate']?>">
		</div>
    </div>
    <div class="form-group">
		<div class="input-group col-md-5">
			<span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-calendar"></span></span>
			<input type="date" name="ldate" value="<?=$_POST['ldate']?>">
		</div>
	</div>
	<input type="submit" name="filterperiodesubmit">
</form>

</div>
	
</div>

<?php 
if((isset($_GET['tanggal']))&&($_GET['tanggal']!='All')){	
	//echo $_GET['tanggal'];die;
	$tanggal=mysql_real_escape_string($_GET['tanggal']);
	$tg="lap_order.php?tanggal='$tanggal'";
	$link_excel="lap_order_excel.php?tanggal='$tanggal'";
	?>

<?php

}elseif ($_POST['filterperiodesubmit']) {
	$fdate=mysql_real_escape_string($_POST['fdate']);
	$ldate=mysql_real_escape_string($_POST['ldate']);
	$tg="lap_order.php?fdate='$fdate'&ldate='$ldate'";
	$link_excel="lap_order_excel.php?fdate='$fdate'&ldate='$ldate'";
}else{
	$tg="lap_order.php";

	$link_excel="lap_order_excel.php";

	?>

	

	<?php
}
?>

<a style="margin-bottom:10px" href="<?php echo $link_excel ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Download Excel</a>

<a style="margin-bottom:10px" href="<?php echo $tg ?>" target="_blank" class="btn btn-default pull-right"><span class='glyphicon glyphicon-print'></span>  Download PDF</a>

<br/>
<?php 
if((isset($_GET['tanggal']))&&($_GET['tanggal']!='All')){
	echo "<h4> Data Penjualan Tanggal  <a style='color:blue'> ". $_GET['tanggal']."</a></h4>";
}elseif ($_POST['filterperiodesubmit']) {
	echo "<h4> Data Penjualan PERIODE  <a style='color:blue'> ". $_POST['fdate']." - ". $_POST['ldate'] ."</a></h4>";
}
?>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>

<table class="table" id="table_order">
	<thead>
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
	</thead>
	<tbody>
	<?php 
	if((isset($_GET['tanggal']))&&($_GET['tanggal']!='All')){
		$tanggal=mysql_real_escape_string($_GET['tanggal']);
		$brg=mysql_query("select * from tb_order where tgl_order like '$tanggal' order by tgl_order desc");
	}elseif ($_POST['filterperiodesubmit']) {
		$fdate=mysql_real_escape_string($_POST['fdate']);
		$ldate=mysql_real_escape_string($_POST['ldate']);
		$brg=mysql_query("select * from tb_order where tgl_order between '$fdate' AND '$ldate' order by tgl_order desc");
	}else{
		$brg=mysql_query("select * from tb_order order by tgl_order desc");
	}
	$no=1;
	while($b=mysql_fetch_array($brg)){

			if ($b['status'] == 'pending') {
				$status_label = 'default';
			} elseif ($b['status']=='transfer') {
				$status_label = 'info';
			} elseif ($b['status']=='dibayar') {
				$status_label = 'warning';
			} elseif ($b['status']=='dikirim') {
				$status_label = 'primary';
			} elseif ($b['status']=='selesai') {
				$status_label = 'success';
			}
		?>
		
		<tr>
			<td><?php echo $no++ ?></td>
			<td><?php echo $b['tgl_order'] ?></td>
			<td><?php echo $b['kode_order'] ?></td>
			<td><span class="label label-<?=$status_label?>"><?php echo $b['status'] ?></span></td>
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
	</tbody>
	<tfoot>
	<tr>
		<td colspan="7">Total Pemasukan</td>
		<?php 
		if((isset($_GET['tanggal']))&&($_GET['tanggal']!='All')){
			$tanggal=mysql_real_escape_string($_GET['tanggal']);
			$x=mysql_query("select sum(total) as total from tb_order where tgl_order='$tanggal'");	
			$xx=mysql_fetch_array($x);			
			echo "<td><b> Rp.". number_format($xx['total']).",-</b></td>";
		}elseif ($_POST['filterperiodesubmit']) {
			$fdate=mysql_real_escape_string($_POST['fdate']);
			$ldate=mysql_real_escape_string($_POST['ldate']);
			$x=mysql_query("select sum(total) as total from tb_order where tgl_order between '$fdate' AND '$ldate'");	
			$xx=mysql_fetch_array($x);			
			echo "<td><b> Rp.". number_format($xx['total']).",-</b></td>";
		}else{
			$x=mysql_query("select sum(total) as total from tb_order");	
			$xx=mysql_fetch_array($x);			
			echo "<td><b> Rp.". number_format($xx['total']).",-</b></td>";
		}

		?>
	</tr>
</tfoot>
</table>


<script type="text/javascript">
	$(document).ready( function () {
	    $('#table_order').DataTable();
	} );
</script>

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