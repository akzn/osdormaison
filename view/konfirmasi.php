<h2>Konfirmasi Pembayaran</h2>
<div class="row">
<form action="process/proses_konfirm.php" method="POST">
	<div class="col-md-6">
		<div class="form-group">
			<label>Kode Order</label>
			<input type="text" class="form-control" name="key" required>
		</div>
		<div class="form-group">
			<label>E-mail</label>
			<input type="text" class="form-control" name="email" required>
		</div>
		<div class="form-group">
			<label>Bank Pengirim</label>
			<input type="text" class="form-control" name="bank_pengirim" required>
		</div>
		<div class="form-group">
			<label>Atas Nama</label>
			<input type="text" class="form-control" name="atas_nama_pengirim" required>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label>Bank Tujuan</label>
			<input type="text" class="form-control" name="bank_tujuan" required>
		</div>
		<div class="form-group">
			<label>Nominal</label>
			<input type="text" class="form-control" name="nominal" required>
		</div>
		<div class="form-group">
			
			<input type="submit" class="btn btn-primary" value="Kirim">
		</div>
	</div>
</form>
</div>