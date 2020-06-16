<div class="row">
	<div class="col-lg-4 col-xs-6">
		<div class="small-box bg-red">
			<div class="inner">
				<h4><?php echo $this->db->query('SELECT * FROM obat where is_active = 1')->num_rows(); ?></h4>
				<p>Total Obat</p>
			</div>
			<div class="icon">
				<i class="fa fa-medkit"></i>
			</div>
			<a href="<?= site_url("obat") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-4 col-xs-6">
		<div class="small-box bg-blue">
			<div class="inner">
				<h4><?php echo $this->db->query('SELECT * FROM users where is_active = 1')->num_rows(); ?></h4>
				<p>Total User</p>
			</div>
			<div class="icon">
				<i class="fas fa-user"></i>
			</div>
			<a href="<?= site_url("user") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<div class="col-lg-4 col-xs-6">
		<div class="small-box bg-green">
			<div class="inner">
				<h4><?php echo $this->db->query('SELECT * FROM transaksi')->num_rows(); ?></h4>
				<p>Total Transaksi</p>
			</div>
			<div class="icon">
				<i class="fas fa-credit-card"></i>
			</div>
			<a href="<?= site_url("transaksi") ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		</div>
	</div>
</div>
<div class="row">
	<div class="card card-gray col-md-12">
		<div class="card-header">
			<h3 class="box-title">Grafik Penjualan Perbulan</h3>
		</div>
		<div class="card-body">
			<div class="chart">
				<canvas id="lineChart" style="height: 180px"></canvas>
			</div>
		</div>
		<div class="card-footer">
			<div class="row">
				<div class="col-sm-4 col-6">
					<div class="description-block border-right">
						<span class="description-percentage text-danger"><i class="fas fa-caret-square-up"></i></span>
						<h5 class="description-header"><?= $barangterjual ?></h5>
						<span class="description-text">Obat TERJUAL</span>
					</div>
				</div>
				<div class="col-sm-4 col-6">
					<div class="description-block border-right">
						<span class="description-percentage text-success"><i class="fas fa-hand-holding-usd"></i></span>
						<h5 class="description-header"><?= formatRupiah($pendapatan) ?></h5>
						<span class="description-text">PENDAPATAN</span>
					</div>
				</div>
				<div class="col-sm-4 col-6">
					<div class="description-block">
						<span class="description-percentage text-warning"><i class="fab fa-dropbox"></i></span>
						<h5 class="description-header"><?= $stocksisa ?></h5>
						<span class="description-text">STOCK TERSISA</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-6">
		<div class="card card-info">
			<div class="card-header">
				<h5 class="card-title">Top 5 Item Sales</h5>
			</div>
			<div class="card-body">
				<table class="table table-striped table-bordered">
					<thead>
						<tr>
							<th style="width:1px;">No.</th>
							<th>Nama Obat</th>
							<th>Terjual</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($topsale as $t) {
						?>
							<tr>
								<td><?= $no++ ?>.</td>
								<td><?= $t->nama_obat ?></td>
								<td style="text-align: center"><span class="badge badge-info"><?= $t->total_qty ?></span></td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card card-danger">
			<div class="card-header">
				<h3 class="card-title">Daftar Barang Habis</h3>
			</div>
			<div class="card-body">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>No</th>
							<th>Nama Obat</th>
							<th>Stock</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($sisa->result() as $stock => $s) {
						?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $s->nama_obat ?></td>
								<td style="text-align: center"><span class="badge badge-danger" ><?= $s->stock_obat ?></td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(function() {
		var lineChartCanvas = $('#lineChart').get(0).getContext('2d')

		var lineChartData = {
			labels: [
				<?php
				if (count($trans) > 0) {
					foreach ($trans as $data) {
						echo "'" . bulan($data->bulan) . "',";
					}
				}
				?>
			],
			datasets: [{
				label: 'Pendapatan',
				backgroundColor: 'rgba(60,141,188,0.9)',
				borderColor: 'rgba(60,141,188,0.8)',
				pointRadius: true,
				pointColor: '#FF7F00',
				pointStrokeColor: 'rgba(60,141,188,1)',
				pointHighlightFill: '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				data: [
					<?php
					if (count($trans) > 0) {
						foreach ($trans as $data) {
							echo "'" . $data->totals . "',";
						}
					}
					?>
				]
			}, ]
		}

		var lineChartOptions = {
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false
			},
			scales: {
				xAxes: [{
					gridLines: {
						display: false,
					}
				}],
				yAxes: [{
					gridLines: {
						display: false,
					}
				}]
			}
		}

		var lineChart = new Chart(lineChartCanvas, {
			type: 'line',
			data: lineChartData,
			options: lineChartOptions
		})
	})
</script>