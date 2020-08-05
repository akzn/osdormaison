<?php 
include '../config/config.php';
$user=$_POST['user'];
$lama=$_POST['lama'];
$baru=$_POST['baru'];
$ulang=$_POST['ulang'];



$cek=mysql_query("select * from tb_admin where password='$lama' and username='$user'");
if(mysql_num_rows($cek)==1){
	if($baru==$ulang){
		$b = $baru;
		mysql_query("update tb_admin set password='$b' where username='$user'");
		header("location:ganti_pass.php?pesan=oke"); die;
	}else{
		header("location:ganti_pass.php?pesan=tdksama"); die;
	}
}else{
	header("location:ganti_pass.php?pesan=gagal"); die;
}

 ?>