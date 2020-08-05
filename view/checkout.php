<?php
	if (!$_SESSION['key_data']) {
		$url = BASE."?hal=home";
		echo $url;
		echo "<meta http-equiv='refresh' content='0;url=".$url."'>";
		die();
	} else {

	$key = $_SESSION['key_data'];
	$get_cart = "select id_cart,tb_produk.id_produk,nama_produk,tb_cart.harga,gambar,qty
	 			from tb_cart join tb_produk on tb_produk.id_produk=tb_cart.id_produk where order_key='$key' order by id_cart desc";

	$res = mysql_query($get_cart);

	$get_prov = "Select * from tb_provinsi";

	$res_prov = mysql_query($get_prov);

		?>


<style type="text/css">
	
	body{
        background-color: white;
        color: #000;
    }

</style>

<div class="row">
	<div class="col-md-12">
		<h2>Checkout</h2>
	</div>
</div>
<hr>
<div class="row">
	<form id="form" method="POST" action="<?=BASE?>?hal=summary">
		<div class="col-md-12">
			<div class="form-group">
				<label>Order Key</label>
				<input type="text" class="form-control" name="key" value="<?=$_SESSION['key_data']?>" autocomplete="off" readonly>
			</div>
			<div class="form-group">
				<label>Nama Pembeli</label>
				<input type="text" class="form-control" name="nama_pembeli" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Email</label>
				<input type="email" class="form-control" name="email" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Alamat Pengiriman</label>
				<input type="text" class="form-control" name="alamat" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Kota</label>
				<input type="text" class="form-control" name="kota" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Kode Pos</label>
				<input type="text" class="form-control" name="kodepos" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Nomor yang Bisa DIhubungi</label>
				<input type="text" class="form-control" name="telp" autocomplete="off" required>
			</div>
			<div class="form-group">
				<label>Provinsi</label>
				<select class="form-control" name="provinsi" id="provinsi" required>
					<option value="0">--pilih provinsi-</option>
					<?php
					while ($prov = mysql_fetch_array($res_prov)) {
						?>

						<option value="<?=$prov['id_provinsi']?>"><?=$prov['nama_provinsi']?></option>

						<?php
					}
					?>
				</select>
			</div>
			<div class="form-group hidden" id="div_ongkir">
				<label>Biaya Kirim</label>
				<input type="text" class="form-control"  name="ongkir" id="ongkir" readonly>
				<input type="hidden" class="form-control"  name="ongkirval" id="ongkirval">
			</div>

			<table class="table table-striped table-bordered">
				<tr>
					<th>No</th>
					<th>Gambar</th>
					<th>Nama Produk</th>
					<th>harga Satuan</th>
					<th>Qty</th>
					<th>Subtotal</th>
				</tr>
					<?php $start=0;
					$total=0;
					while($row=mysql_fetch_array($res)){
						$subtotal = $row['qty']*$row['harga'];
						$total = $total+$subtotal;
						?>
					<tr>
						<td><?=++$start?></td>
						<td  class="text-center"><img style="max-height:100px" class="img img-responsive img-thumbnails text-center" src="./admin/img/produk/<?=$row['gambar']?>.jpg"></td>
						<td><?=$row['nama_produk']?></td>
						<td class="text-right"><?=uang($row['harga'])?></td>
						<td><?=$row['qty']?></td>
						<td class="text-right"><?=uang($subtotal)?></td>
					</tr>
						<?php
					}
					?>
				<tr>
					<td colspan='5' class="text-right"><h4>Total</h4></td>
					<td class="text-right"><?=uang($total)?></td>
					<td class="text-right hidden" id="td-total"><?=$total?>
						<input type="hidden" name="subtotal" id="subtotal" value="<?=$total?>">
					</td>
				</tr>
				<tr>
					<td colspan='5' class="text-right"><h4>Ongkir</h4></td>
					<td class="text-right" id="td-ongkir"><?=uang(0)?></td>
				</tr>
				<tr>
					<td colspan='5' class="text-right"><h4>Jumlah</h4></td>
					<td class="text-right" id="td-jumlah"><?=uang($total)?>
						
					</td><input type="hidden" name="total_all" id="total_all" value="<?=$total?>">
				</tr>
			</table>
			<div class="form-group">
				<input  class="btn btn-primary btn-checkout" type="submit" value="Lanjutkan ke Pembayaran">
			</div>
		</div>
	</form>
</div>
	<?php
	}
?>
<!-- jQuery -->
<script type="text/javascript">
	$('#form').on('submit',function(e){
		//e.preventDefault();
		if($('#provinsi').val()=='0'){
			alert('Harap Pilih Provinsi dulu');
			return false;
		} else return true;
	});

	$('#provinsi').change(function(){
		val = $(this).val(); 
		if (val == 0) {
			$('#div_ongkir').addClass('hidden');
			return false;
		} else {
			$.ajax({
				url : 'process/get_biaya_kirim.php',
				type : 'POST',
				data : 'id='+val,
				dataType : 'html',
				success : function(data){
					$('#div_ongkir').removeClass('hidden');
					$('#ongkir').val(rp(data));	
					$('#ongkirval').val(data);	
					$('#td-ongkir').html(rp(data));
					jumlah = parseInt($('#td-total').html())+parseInt(data);
					$('#td-jumlah').html(rp(jumlah));
					$('#total_all').val(jumlah);
				},
				error : function(){
					alert('terjadi error');
					$('#provinsi').val('0').change();
				}
			})
		}
	})
</script>