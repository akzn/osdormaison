<?php
include '../config/config.php';
$id=$_GET['id'];
mysql_query("delete from tb_order where id_order='$id'");
mysql_query("delete from tb_order_detail where id_order='$id'");
header("location:order.php");

?>