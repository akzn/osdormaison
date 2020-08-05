<?php
include '../config/config.php';
$id = $_GET['id'];
$status = $_GET['status'];

$set = mysql_query("update tb_payment set status_payment = '$status' where id_payment = '$id'") or die(mysql_error());
$get = mysql_query("select * from tb_payment where id_payment = '$id' limit 1") or die(mysql_error());
$data = mysql_fetch_row($get);
$kode_order = $data[1];

if ($status=='success') {
	$set2 = mysql_query("update tb_order set status = 'dibayar' where kode_order = '$kode_order'") or die(mysql_error());
} else if ($status=='not_found') {
	$set2 = mysql_query("update tb_order set status = 'pending' where kode_order = '$kode_order'") or die(mysql_error());
}

if ($set) {
	header("location:pembayaran.php");
}


?>