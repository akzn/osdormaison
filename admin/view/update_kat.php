<?php 
include '../config/config.php';
$id=$_POST['id'];
$nama=$_POST['nama'];

mysql_query("update tb_kategori set nama_kategori='$nama' where id_kategori='$id'");
header("location:kategori.php");

?>