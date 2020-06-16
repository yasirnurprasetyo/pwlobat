<?php


class Transaksi extends CI_Controller {
	public function __construct() {
		parent::__construct();
		isLogin();
		$this->load->model(array("ModelTransaksi","ModelObat"));
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index() {
		$obat = $this->ModelObat->getAll();
		$transaksi = $this->ModelTransaksi->getAll();
		$data = array(
			"header" => "Riwayat Transaksi",
			"page" => "content/transaksi/v_list_transaksi",
			"transaksi" => $transaksi,
			"obat" => $obat
		);
		$this->load->view("layout/main", $data);
	}

	public function detail($id){
		$detail = $this->ModelTransaksi->getJoinFull($id);
		$transaksi = $this->ModelTransaksi->getByPrimaryKey($id);
        $data = array(
            "page" => "content/transaksi/v_detail_trx",
            "header" => "Detail Transaksi",
			"detail" => $detail,
			"transaksis" => $transaksi
        );
        $this->load->view("layout/main", $data);
	}
}
