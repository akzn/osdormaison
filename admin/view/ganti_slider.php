<?php 
include 'header.php';
?>

<h3><span class="glyphicon glyphicon-picture"></span>  Ganti Slider</h3>
<br/><br/>
<?php 
if(isset($_GET['pesan'])){
	$pesan=mysql_real_escape_string($_GET['pesan']);
	if($pesan=="oke"){
		echo "<div class='alert alert-success'>Slider berhasil di ganti !! </div>";
	} elseif ($pesan=="error") {
		echo "<div class='alert alert-warning'>terjadi error !! </div>";
	}
}
?>

<h4>*Ukuran Slider 800x300px</h4>
<br/>
<div class="row">
	<div class="col-md-5">
		<form action="ganti_slider_act.php?slide=1" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Slider 1</label>
				<input name="file" type="file" class="form-control" placeholder="Password Lama ..">
			</div>		
			<div class="form-group">
				<label></label>
				<input type="submit" class="btn btn-info" value="Ganti">
				<input type="reset" class="btn btn-danger" value="reset">
			</div>																	
		</form>
	</div>
	<div class="col-md-6">
		<img src="<?=BASE?>admin/img/slider/slide1.png" class="img img-responsive img-thumbnail" width="400">
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-5">
		<form action="ganti_slider_act.php?slide=2" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Slider 2</label>
				<input name="file" type="file" class="form-control" placeholder="Password Lama ..">
			</div>		
			<div class="form-group">
				<label></label>
				<input type="submit" class="btn btn-info" value="Ganti">
				<input type="reset" class="btn btn-danger" value="reset">
			</div>																	
		</form>
	</div>
	<div class="col-md-6">
		<img src="<?=BASE?>admin/img/slider/slide2.png" class="img img-responsive img-thumbnail" width="400">
	</div>
</div>
<hr>
<div class="row">
	<div class="col-md-5">
		<form action="ganti_slider_act.php?slide=3" method="post" enctype="multipart/form-data">
			<div class="form-group">
				<label>Slider 3</label>
				<input name="file" type="file" class="form-control" placeholder="Password Lama ..">
			</div>		
			<div class="form-group">
				<label></label>
				<input type="submit" class="btn btn-info" value="Ganti">
				<input type="reset" class="btn btn-danger" value="reset">
			</div>																	
		</form>
	</div>
	<div class="col-md-6">
		<img src="<?=BASE?>admin/img/slider/slide3.png" class="img img-responsive img-thumbnail" width="400">
	</div>
</div>

<?php 
include 'footer.php';

?>