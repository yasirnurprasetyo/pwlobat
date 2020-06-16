<div class="card card-gray">
    <div class="card-body">
        <div class="row">
            <div class="callout callout-info col-md-6">
                <h5><i class="fas fa-info-circle"></i> <?= $transaksis->no_transaksi ?></h5>
            </div>
            <p></p>
            <div class="callout callout-info col-md-6">
                <h5><i class="fas fa-calendar"></i> <?= $transaksis->tanggal_transaksi ?></h5>
            </div>
        </div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Harga Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $totalAll = 0;
                foreach ($detail as $d) {
                    $totalHarga = (int) $d->harga_item_transaksi * (int) $d->qty_item_transaksi;
                    $totalAll += $totalHarga;
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d->nama_obat ?></td>
                        <td><?= formatRupiah($d->harga_item_transaksi) ?></td>
                        <td><?= $d->qty_item_transaksi ?></td>
                        <td><?= formatRupiah($totalHarga) ?></td>
                    </tr>
                <?php
                }
                ?>
                <tr>
                    <td colspan="4"><b>Total</b></td>
                    <td><?= formatRupiah($totalAll) ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card-footer">
        <!-- <a href="<?= site_url("transaksi/print/$d->id_transaksi") ?>" class="btn btn-warning">
            <i class="fas fa-print"> Print Nota</i>
        </a> -->
        <a href="<?= site_url("transaksi") ?>" class="btn btn-primary">
            <i class="fas fa-reply"> Kembali</i>
        </a>
    </div>
</div>