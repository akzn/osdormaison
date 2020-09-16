<?PHP
	error_reporting(0);

	if ($_GET['tanggal']) {
		$tanggal=$_GET['tanggal'];
	}elseif ($_GET['fdate']) {
		$tanggal=$_GET['fdate'] . ' - ' . $_GET['ldate'];
	}else{
		$tanggal = 'SEMUA';
	}


	// $tgl = (!$_GET['tanggal'])?'ALL':$_GET['tanggal'];
	$tgl = $tanggal;

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=laporan-penjualan-".$tgl.".xls");
    header("Pragma: no-canche");
    header("Expires: 0");

include '../config/config.php';
include '../config/general_helper.php';

?>

<style type="text/css">
	table, th, td {
	  border: 1px solid black;
	}
</style>

<div>
	<h2>OSDORMAISON - Laporan Penjualan</h2>
</div>

<?php 
	
	if ($_GET['tanggal']) {
		$tanggal=$_GET['tanggal'];
		$query=mysql_query("select * from tb_order where tgl_order=" . $tanggal);
	}elseif ($_GET['fdate']) {
		$tanggal=$_GET['fdate'] . ' - ' . $_GET['ldate'];
		$fdate=$_GET['fdate'];
		$ldate=$_GET['ldate'];
		$query=mysql_query("select * from tb_order where tgl_order between $fdate AND $ldate ");
	}else{
		$tanggal = 'SEMUA';
		$query=mysql_query("select * from tb_order");
	}
	
    ?>

<p>Laporan Tanggal : <?=$tanggal?></p>
<p>Dicetak Tanggal : <?=date("Y-m-d")?></p>



<table style="border:1px solid black">
	<th>No</th>
	<th>Tanggal</th>
	<th>Kode Order</th>
	<th>Total</th>
	<th>Ongkir</th>
	<th>Jumlah</th>

	<?php 

		while($lihat=mysql_fetch_array($query)){
			?>

			<tr>
				<td><?=++$start?></td>
				<td><?=$lihat['tgl_order']?></td>
				<td><?=$lihat['kode_order']?></td>
				<td><?=$lihat['subtotal']?></td>
				<td><?=$lihat['ongkir']?></td>
				<td><?=$lihat['total']?></td>
			</tr>

			<?php

		}

	?>

	<?php 

	if ($_GET['tanggal']) {
		$tanggal = $_GET['tanggal'];
		$q=mysql_query("select sum(total) as total from tb_order where tgl_order=".$tanggal);
	}elseif ($_GET['fdate']) {
		$fdate=$_GET['fdate'];
		$ldate=$_GET['ldate'];
		$q=mysql_query("select sum(total) as total from tb_order where tgl_order between $fdate AND $ldate");
	} else {
		$q=mysql_query("select sum(total) as total from tb_order");
	}

	while($total=mysql_fetch_array($q)){
		?>
		<tr>
			<td colspan="5">Total</td>
			<td><?=$total['total']?></td>
		</tr>
		<?php	
	}

	?>


</table>
