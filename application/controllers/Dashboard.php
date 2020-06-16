<?php


class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		isLogin();
		$this->load->model(array("ModelItemTransaksi","ModelTransaksi","ModelObat"));
		date_default_timezone_set('Asia/Jakarta');
	}


	public function index() {
		$chart = $this->ModelItemTransaksi->getJoinChart();
		$barangterjual = $this->ModelItemTransaksi->hitungItemTerjual();
		$pendapatan = $this->ModelItemTransaksi->hitungPendapatan();
		$stockSisa = $this->ModelObat->hitungStockSisa();
		$topSale = $this->ModelTransaksi->topSale();
		$sisa = $this->ModelItemTransaksi->getMinStock();
		$data = array(
			"header" => "Dashboard",
			"page" => "dashboard",
			"trans" => $chart,
			"barangterjual" => $barangterjual,
			"pendapatan" => $pendapatan,
			"stocksisa" => $stockSisa,
			"topsale" => $topSale,
			"sisa" => $sisa
		);
		$this->load->view("layout/main", $data);
	}
}
