<?PHP
	error_reporting(0);
	$tgl = (!$_GET['tanggal'])?'ALL':$_GET['tanggal'];

    header("Content-type: application/octet-stream");
    header("Content-Disposition: attachment; filename=laporan-barang-".$tgl.".xls");
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
	<h2>OSDORMAISON - Laporan Barang</h2>
</div>

<?php 
	
	if ($_GET['tanggal']) {
		$tanggal=$_GET['tanggal'];
		$query=mysql_query("select * from tb_produk where tgl_order=" . $tanggal);
	}else{
		$tanggal = 'SEMUA';
		$query=mysql_query("select * from tb_produk order by id_produk desc");
	}
	
    ?>

<p>Laporan Tanggal : <?=$tanggal?></p>
<p>Dicetak Tanggal : <?=date("Y-m-d")?></p>



<table style="border:1px solid black">
	<th>No</th>
	<th>Nama Barang</th>
	<th>Stok</th>
	<th>Harga</th>
	
	<?php 

		while($lihat=mysql_fetch_array($query)){
			?>

			<tr>
				<td><?=++$start?></td>
				<td><?=$lihat['nama_produk']?></td>
				<td><?=$lihat['stok']?></td>
				<td><?=$lihat['harga']?></td>
			</tr>

			<?php

		}

	?>

</table>
