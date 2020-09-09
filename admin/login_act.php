<?php 
session_start();
// include 'config/config.php';
require '../config/conn.php';
$uname=$_POST['uname'];
$pass=$_POST['pass'];
//$pas=md5($pass);
$query=mysql_query("select * from tb_admin where username='$uname' and password='$pass'")or die(mysql_error());
//echo "select * from tb_admin where username='$uname' and password='$pas'";die;

if(mysql_num_rows($query)==1){
	$_SESSION['uname']=$uname;
	header("location:view/index.php");
}else{
	header("location:index.php?pesan=gagal")or die(mysql_error());
	// mysql_error();
}
// echo $pas;
 ?>