<div class="row">
	<div class="col-md-4">
		<div class="card card-gray">
			<div class="card-header"><h5>Pilih Obat</h5></div>
			<div class="card-body">
				<div class="form-group">
					<label for="">Pilih Obat</label>
					<select name="" class="form-control" id="select-obat">
						<option value="" disabled selected>Pilih Obat</option>
						<?php
						foreach ($obats as $b) {
							echo "<option data-nama='$b->nama_obat' "
								. "data-harga='$b->harga_obat' "
								. "data-stock='$b->stock_obat' "
								. "data-kode='$b->kode_obat' "
								. "value='$b->id_obat'> "
								. "$b->kode_obat / $b->nama_obat"
								. "</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Kode Obat</label>
					<input readonly type="text" id="kode-obat" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="">Nama Obat</label>
					<input readonly type="text" id="nama-obat" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="">Harga Obat</label>
					<input readonly type="text" id="harga-obat" class="form-control"/>
				</div>
				<div class="form-group">
					<label for="">Jumlah Obat</label>
					<input type="text" id="jumlah-obat" class="form-control"/>
				</div>

			</div>
			<div class="card-footer">
				<button type="button" class="btn btn-primary float-right" id="btn-add-item"><i class="fas fa-plus"></i>
				</button>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<div class="card card-gray">
			<div class="card-header"><h5>Item Transaksi</h5></div>
			<div class="card-body">
				<table id="table-item" class="table">
					<thead>
					<tr>
						<th>Kode</th>
						<th>Nama</th>
						<th>Harga</th>
						<th>Jumlah</th>
						<th>Sub Total</th>
						<th>Action</th>
					</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
			<div class="card-footer">
				<button type="button" id="btn-save-transaksi" class="btn btn-primary float-right">
					<i class="fas fa-save"></i> Simpan
				</button>
			</div>
		</div>
	</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js"></script>
<script>
    $(function () {
        let obat;
        $("#select-obat")
            .select2()
            .on("change", function () {
                var optionSelected = $(this).children("option:selected");
                $("#kode-obat").val(optionSelected.data("kode"));
                $("#nama-obat").val(optionSelected.data("nama"));
                $("#harga-obat").val(optionSelected.data("harga"));
                $("#jumlah-obat").val(1);
            });

        $("#btn-add-item").on("click", function () {
            let id = $("#select-obat").val();
            let kodeobat = $("#kode-obat").val();
            let namaobat = $("#nama-obat").val();
            let hargaobat = $("#harga-obat").val();
            let jumlahobat = $("#jumlah-obat").val();
            let subTotal = parseInt(hargaobat) * parseInt(jumlahobat);
            if (kodeobat != "") {
                let tr = `<tr data-id="${id}">`;
                tr += `<td>${kodeobat}</td>`;
                tr += `<td>${namaobat}</td>`;
                tr += `<td>${hargaobat}</td>`;
                tr += `<td>${jumlahobat}</td>`;
                tr += `<td>${subTotal}</td>`;
                tr += `<td>`;
                tr += `<button class="btn btn-xs btn-del-item btn-danger"> <i class="fas fa-trash"></i></button>`;
                tr += `</td>`;
                tr += `</tr>`;
                $("#table-item tbody").append(tr);
                $("#select-obat").val("").trigger("change");
                $("#kode-obat").val();
                $("#nama-obat").val();
                $("#harga-obat").val();
                $("#jumlah-obat").val(1);
                $(".btn-del-item").on("click", function () {
                    $(this).parent().parent().remove();
                });
            }
        });
        $("#btn-save-transaksi").on("click", function () {
            $.LoadingOverlay("show");
            let rows = $("#table-item tbody tr");
            let itemTransaksi = [];
            rows.each(function () {
                let row = $(this);
                let item = {
                    id_obat: row.data("id"),
                    harga_item_transaksi: row.children().eq(2).text(),
                    qty_item_transaksi: row.children().eq(3).text(),
                    total_item_transaksi: row.children().eq(4).text(),
                };
                itemTransaksi.push(item);
            });
            let dataKirim = JSON.stringify(itemTransaksi);
            $.ajax({
                url: window.base_url + "app/proses_transaksi",
                type: "POST",
                data: {
                    item_transaksi: dataKirim
                },
                success: function (result) {
					if(parseInt(result) > 0){
					    //success
						window.location.replace(window.base_url+"app");
					}else{
					    //error
					}
                    $.LoadingOverlay("hide");
                }
            });
        });
    });
</script>
