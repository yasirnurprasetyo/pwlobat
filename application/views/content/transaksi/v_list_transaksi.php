<div class="card card-gray">
	<div class="card-header">
		<h4>Daftar Barang</h4>
	</div>
	<div class="card-body">
		<table class="table table-bordered table-striped" id="dataTable">
			<thead>
			<tr>
				<th>#</th>
				<th>No Transaksi</th>
				<th>Tanggal</th>
				<th>Action</th>
			</tr>
			</thead>
			<tbody>
			<?php
			$no = 1;
			foreach ($transaksi as $row) {
				?>
				<tr>
					<td><?= $no++ ?></td>
					<td><?= $row->no_transaksi ?></td>
					<td><?= $row->tanggal_transaksi ?></td>
					<td>
						<a href="<?= site_url("transaksi/detail/$row->id_transaksi") ?>" data-id="<?= $row->id_transaksi ?>"
						   class="btn btn-sm btn-info"><i
								class="fas fa-eye"></i></a>
					</td>
				</tr>
				<?php
			}
			?>
			</tbody>
		</table>
	</div>
</div>
