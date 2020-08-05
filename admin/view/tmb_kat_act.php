<?php 
include '../config/config.php';
$nama=$_POST['nama'];
//var_dump($_POST);die;

mysql_query("insert into tb_kategori(nama_kategori,id_induk) values('$nama','0')")or die(mysql_error());
header("location:kategori.php");
 ?>