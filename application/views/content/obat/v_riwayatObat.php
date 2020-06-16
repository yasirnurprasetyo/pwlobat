<div class="card card-gray">
    <div class="card-header">
        <h4>Data Obat yang Terhapus</h4>
    </div>
    <div class="card-footer">
        <a href="<?= site_url("obat") ?>" class="btn btn-primary">
            <i class="fas fa-reply"></i> Kembali
        </a>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="dataTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Harga</th>
                    <th>Gambar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($obats as $b) {
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $b->kode_obat ?></td>
                        <td><?= $b->nama_obat ?></td>
                        <td><?= $b->harga_obat ?></td>
                        <td class="gambar">
                            <img width="100" src="<?= base_url('assets/images/') . $b->gambar_obat ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/images/noimage.jpg') . $b->gambar_obat ?>';" alt="<?= $b->nama_obat ?>">
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>