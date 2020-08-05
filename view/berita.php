<?php 
$id = $_GET['id'];
$get_berita = mysql_query("SELECT * from tb_berita where id_berita='$id'") or die(mysql_error());
$data=mysql_fetch_row($get_berita);
?>

<div class="row">
	<div class="col-md-4">
		<img src="<?=BASE?>admin/img/berita/<?=$data[3]?>.jpg" class="img img-responsive img-thumbnail" width="200">
	</div>
	<div class="col-md-8">
		<h3><?=$data[1]?></h3>
		<p style="text-align:justify">
			<?=$data[2]?>
		</p>
	</div>
</div>			



<script type="text/javascript">

</script>