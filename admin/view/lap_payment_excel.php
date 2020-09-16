<?PHP
	error_reporting(0);
	// $tgl = (!$_GET['tanggal'])?'ALL':$_GET['tanggal'];

	if ($_GET['tanggal']) {
		$tanggal=$_GET['tanggal'];
	}elseif ($_GET['fdate']) {
		$tanggal=$_GET['fdate'] . ' - ' . $_GET['ldate'];
	}else{
		$tanggal = 'SEMUA';
	}

	$tgl = $tanggal;

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=laporan-Pembayaran-".$tgl.".xls");
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
	<h2>OSDORMAISON - Laporan Pembayaran</h2>
</div>

<?php 
	
	if ($_GET['tanggal']) {
		$tanggal=$_GET['tanggal'];
		$query=mysql_query("select * from tb_payment where tgl_konfirmasi=" . $tanggal);
	}elseif ($_GET['fdate']) {
		$tanggal=$_GET['fdate'] . ' - ' . $_GET['ldate'];
		$fdate=$_GET['fdate'];
		$ldate=$_GET['ldate'];
		$query=mysql_query("select * from tb_payment where tgl_konfirmasi between $fdate AND $ldate ");
	}else{
		$tanggal = 'SEMUA';
		$query=mysql_query("select * from tb_payment order by id_payment desc");
	}
	
    ?>

<p>Laporan Tanggal : <?=$tanggal?></p>
<p>Dicetak Tanggal : <?=date("Y-m-d")?></p>

<table style="border:1px solid black">
	<th>No</th>
	<th>Tanggal</th>
	<th>Kode Order</th>
	<th>Bank Asal</th>
	<th>Atas Nama</th>
	<th>Bank Tujuan</th>
	<th>Nominal</th>
	
	<?php 

		while($lihat=mysql_fetch_array($query)){
			?>

			<tr>
				<td><?=++$start?></td>
				<td><?=$lihat['tgl_konfirmasi']?></td>
				<td><?=$lihat['kode_order']?></td>
				<td><?=$lihat['bank_asal']?></td>
				<td><?=$lihat['atas_nama']?></td>
				<td><?=$lihat['bank_tujuan']?></td>
				<td><?=$lihat['nominal']?></td>
			</tr>

			<?php

		}

	?>

</table>
