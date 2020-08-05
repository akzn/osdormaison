<?php
	session_start();
	include_once "../config/conn.php";
    include_once "../config/general_helper.php";
	if (!$_SESSION['key_data']) {
		$_SESSION['key_data'] = gen_pass();
	}
	$key = $_SESSION['key_data'];
	$id_produk = $_POST['id'];
	$price = $_POST['price'];
	$qty = 1;

	//cek key
	$get_cart = "select qty from tb_cart where order_key='$key' and id_produk = '$id_produk'";
	$res = mysql_query($get_cart);
	$val = mysql_fetch_row($res);

	if ($val[0]>0) {
		$qty = $val[0]+$qty;
		$sql = "update tb_cart set qty='$qty' where order_key='$key' and id_produk='$id_produk'";
	} else {
		$sql = "insert into tb_cart(order_key,id_produk,qty,harga) values('$key','$id_produk','$qty','$price')";
	}
	$insert = mysql_query($sql);
	echo $key;
?>