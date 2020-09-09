<?php
include '../config/config.php';
$id = $_GET['id'];
$status = $_GET['status'];





$set = mysql_query("update tb_order set status = '$status' where id_order = '$id'") or die(mysql_error());

if ($set) {
	header("location:detail_order.php?id=$id");
}


?>