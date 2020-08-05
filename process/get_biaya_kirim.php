<?php

	session_start();
	include_once "../config/conn.php";
    include_once "../config/general_helper.php";
    $id = $_POST['id'];
    $sql = "select ongkir from tb_ongkir where id_wilayah = '$id'";
    $res = mysql_query($sql);
    $data = mysql_fetch_row($res);

    echo $data[0];

?>