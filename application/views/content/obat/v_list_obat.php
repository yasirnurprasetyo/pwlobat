<div class="card card-gray">
	<div class="card-header">
		<h4>Daftar Obat</h4>
	</div>
	<div class="card-footer">
		<a href="<?= site_url("obat/tambah") ?>" class="btn btn-primary">
			<i class="fas fa-plus"></i> Tambah Obat
		</a>
		<a href="<?= site_url("report/obat") ?>" target="_blank" class="btn btn-success">
			<i class="fas fa-file-excel"></i> Report Obat
		</a>
		<a href="<?= site_url("obat/riwayat") ?>" class="btn btn-danger">
			<i class="fas fa-minus-circle"> Riwayat Delete Obat</i>
		</a>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-striped" id="dataTable">
			<thead>
				<tr>
					<th>#</th>
					<th>Kode</th>
					<th>Nama</th>
					<th>Harga</th>
					<th>Stock</th>
					<th>Gambar</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$no = 1;
				foreach ($obats as $obat) {
				?>
					<tr>
						<td><?= $no++ ?></td>
						<td><?= $obat->kode_obat ?></td>
						<td><?= $obat->nama_obat ?></td>
						<td><?= $obat->harga_obat ?></td>
						<td><?= $obat->stock_obat ?></td>
						<td>
							<img height="70" onerror="this.onerror=null;this.src='<?= base_url() . 'assets/images/no-image.png' ?>';" src="<?= base_url() . "upload/images/" . $obat->gambar_obat ?>" alt="Gambar_obat" />

						</td>
						<td>
							<a href="<?= site_url("obat/update/$obat->id_obat") ?>" class="btn btn-sm btn-warning">
								<i class="fas fa-edit"></i>
							</a>
							<a href="#" data-id="<?= $obat->id_obat ?>" class="btn btn-sm btn-danger btn-delete-obat"><i class="fas fa-trash"></i></a>
						</td>
					</tr>
				<?php
				}
				?>
			</tbody>
		</table>
	</div>
</div>

<div class="modal fade" id="modal-confirm-delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<h4>Anda Yakin Hapus data ini?</h4>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Tidak</button>
				<button type="button" class="btn btn-danger" id="btn-delete">Hapus</button>
			</div>
		</div>
	</div>
</div>
<form id="form-delete" method="post" action="<?= site_url('obat/proses_hapus') ?>">

</form>
<script>
	$(function() {
		let idobat = 0;
		$(".btn-delete-obat").on("click", function() {
			idobat = $(this).data("id");
			console.log(idobat);
			$("#modal-confirm-delete").modal("show");
		});
		$("#btn-delete").on("click", function() {
			//panggil url untuk hapus data
			let inputId = $("<input>")
				.attr("type", "hidden")
				.attr("name", "id")
				.val(idobat);
			let formDelete = $("#form-delete");
			formDelete.empty().append(inputId);
			formDelete.submit();
			$("#modal-confirm-delete").modal("hide");
		});
	});
</script>