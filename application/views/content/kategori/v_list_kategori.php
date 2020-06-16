<div class="card card-gray">
    <div class="card-header">
        <h4>Daftar Kategori</h4>
    </div>
    <div class="card-footer">
        <button href="#" class="btn btn-primary btn-sm tombolTambah"><i class="fas fa-plus-circle"></i>&nbsp;
            ADD KATEGORI
        </button>
    </div>
    <div class="card-body">
        <table class="table table-bordered table-striped" id="dataTable">
            <thead>
                <tr>
                    <th style="width:8%;">No.</th>
                    <th>Nama Kategori</th>
                    <th style="text-align: center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($kategoris as $kategori) {
                ?>
                    <tr id="<?= $kategori->id_kategori ?>">
                        <td class="hidden id_kategori"><?= $kategori->id_kategori ?></td>
                        <td><?= $no++ ?>.</td>
                        <td><?= $kategori->nama_kategori ?></td>
                        <td style="text-align: center">
                            <button class="hidden btn btn-sm btn-info tombolEdit" 
                                data-id="<?= $kategori->id_kategori ?>" 
                                data-nama="<?= $kategori->nama_kategori ?>" 
                                data-title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </button>
                            <a href="#" data-id="<?= $kategori->id_kategori ?>" data-id="<?= $kategori->nama_kategori ?>" id="delete_id" class="btn btn-sm btn-danger tombolHapus"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal Add -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">ADD DATA </h5>
            </div>
            <form method="post" action="<?= site_url('kategori/proses_simpan') ?>" role="form" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-12">Kategori</label>
                        <div class="col-md-12">
                            <input type="text" id="nama_kategori" name="nama_kategori" class="form-control" required> </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger">Simpan</button>
                    </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Update -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data </h5>
            </div>
            <form method="post" action="<?= site_url('kategori/proses_update') ?>" role="form" class="form-horizontal">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-12">Kategori</label>
                        <div class="col-md-12">
                            <input type="text" id="nama_kats" name="nama_kat" class="form-control" required> </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="kategoriID" class="pelanggan_id_delete" id="kategoriID">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" id="btnEdit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    $(function() {
        $(".hidden").hide();
        var id_kategori = "";

        $(".tombolTambah").click(function() {
            $("#modalTambah").modal('show');
        });

        $(".tombolEdit").click(function() {
            id_kategori = $(this).closest('tr').find('.id_kategori').text();
            var nama = $(this).data('nama');
            $("#kategoriID").val(id_kategori);
            $("#nama_kats").val($(this).data('nama'));
            $("#modalEdit").modal('show');
        });

        let idUser = 0;
        $(".tombolHapus").on("click", function() {
            var id = $(this).data('id');
            SwalDelete(id);
            // e.preventDefault();
        });

        function SwalDelete(id) {
            $.confirm({
                theme: 'modern',
                icon: 'fa fa-warning',
                title: 'Hapus Data!',
                content: 'Apakah anda yakin hapus data ini ? <br>',
                // closeIcon: true,
                boxWidth: '500px',
                useBootstrap: false,
                closeIconClass: 'fa fa-close',
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'HAPUS',
                        btnClass: 'btn-red',
                        action: function() {
                            var url = "Kategori/proses_delete/"
                            $.ajax({
                                    url: '<?= base_url() ?>' + url + id,
                                    type: "POST",
                                })
                                .done(function(id) {
                                    $.confirm({
                                        theme: 'modern',
                                        icon: 'fa fa-success',
                                        title: 'Data Terhapus!',
                                        content: false,
                                        closeIcon: true,
                                        boxWidth: '500px',
                                        useBootstrap: false,
                                        type: 'blue',
                                        typeAnimated: true,
                                        buttons: {
                                            tryAgain: {
                                                text: 'OKE',
                                                btnClass: 'btn-blue',
                                                action: function() {
                                                    window.location.replace("<?= site_url("Kategori") ?>");
                                                }
                                            },
                                        }
                                    });
                                })
                                .fail(function() {
                                    $.alert({
                                        theme: 'modern',
                                        icon: 'fa fa-danger',
                                        title: 'Data Tidak bisa dihapus!',
                                        content: 'Data tersebut telah berelasi dengan tabel lain',
                                        closeIcon: true,
                                        boxWidth: '500px',
                                        useBootstrap: false,
                                        type: 'red',
                                        typeAnimated: true,
                                        buttons: {
                                            tryAgain: {
                                                text: 'OKE',
                                                btnClass: 'btn-blue',
                                                action: function() {}
                                            },
                                        }
                                    })
                                });
                        }
                    },
                    close: function() {}
                }
            });
        }
    })
</script>