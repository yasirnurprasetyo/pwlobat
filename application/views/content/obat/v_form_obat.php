<div class="card card-gray">
	<div class="card-header">
		<h4>Tambah Obat</h4>
	</div>
	<div class="card-body">
		<form id="form-tambah-obat" enctype="multipart/form-data" method="post"
			  action="<?= site_url("obat/proses_simpan") ?>">
			<div class="form-group">
				<label for="kode-obat">Kode Obat</label>
				<input required type="text" maxlength="20" name="kode" id="kode-obat" class="form-control"/>
			</div>
			<div class="form-group">
				<label for="nama-obat">Nama Obat</label>
				<input required type="text" name="nama" id="nama-obat" class="form-control"/>
			</div>
			<div class="form-group">
				<label for="harga-obat">Harga Obat</label>
				<input required type="text" name="harga" id="harga-obat" class="form-control"/>
			</div>
			<div class="form-group">
				<label for="stock-obat">Stock Obat</label>
				<input required type="text" name="stock" id="stock-obat" class="form-control"/>
			</div>
			<div class="form-group">
				<label for="gambar-obat">Gambar Obat</label>
				<div class="input-group">
					<div class="custom-file">
						<input type="file" name="gambar_obat" class="custom-file-input" id="gambar-obat">
						<label class="custom-file-label" for="gambar-obat">Choose file</label>
					</div>
				</div>
			</div>
		</form>
	</div>
	<div class="card-footer">
		<button id="btn-save-obat" type="button" class="btn btn-success">
			<i class="fas fa-save"></i> Simpan
		</button>
		<a href="<?= site_url("obat") ?>" class="btn btn-info">
			<i class="fas fa-reply"></i> Kembali
		</a>
	</div>
</div>
<script>
    $(function () {
        $("#btn-save-obat").on("click", function () {
            let validate = $("#form-tambah-obat").valid();
            if(validate){
                $("#form-tambah-obat").submit();
			}
        });
        $("#form-tambah-obat").validate({
            rules: {
                kode: {
                    alphanumeric: true
                },
                harga: {
                    digits: true
                },
                stock: {
                    digits: true
                }
            },
            messages: {
                kode: {
                    alphanumeric: "Hanya Boleh Angka, Huruf dan Undescore"
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
