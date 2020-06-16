<?php


class Obat extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model("ModelObat");
		isLogin();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function index() {
		$listObat = $this->ModelObat->getAll();
		$data = array(
			"header" => "Obat",
			"page" => "content/obat/v_list_obat",
			"obats" => $listObat
		);
		$this->load->view("layout/main", $data);
	}

	function get_obat()
    {
        $kode = $this->input->post('kode_obat');
        $data = $this->ModelObat->get_data_obat_bykode($kode);
        echo json_encode($data);
    }

	public function tambah() {
		$data = array(
			"header" => "Obat",
			"page" => "content/obat/v_form_obat",
		);
		$this->load->view("layout/main", $data);
	}

	public function proses_simpan() {
		$obat = array(
			"kode_obat" => $this->input->post("kode"),
			"nama_obat" => $this->input->post("nama"),
			"harga_obat" => $this->input->post("harga"),
			"stock_obat" => $this->input->post("stock"),
		);
		$id = $this->ModelObat->insertGetId($obat);
		if ($id > 0) {
			$uploadGambar = $this->uploadGambar("gambar_obat");

			if ($uploadGambar["result"] == "success") {
				$dataUpdate = array(
					"gambar_obat" => $uploadGambar["file"]["file_name"],
				);
				$this->ModelObat->update($id,$dataUpdate);
			}
		}
		redirect("obat");
	}

	public function update($idobat) {
		$obat = $this->ModelObat->getByPrimaryKey($idobat);
		$data = array(
			"header" => "Obat",
			"page" => "content/obat/v_update_obat",
			"obat" => $obat
		);
		$this->load->view("layout/main", $data);
	}

	public function proses_update() {
		$id = $this->input->post("id");
		$obat = array(
			"kode_obat" => $this->input->post("kode"),
			"nama_obat" => $this->input->post("nama"),
			"harga_obat" => $this->input->post("harga"),
			"stock_obat" => $this->input->post("stock"),
		);
		$this->ModelObat->update($id, $obat);
		redirect("obat");
	}

	public function proses_hapus() {
		$id = $this->input->post("id");
		$this->ModelObat->delete($id);
		redirect("obat");
	}

	public function uploadGambar($field) {
		$config = array(
			"upload_path" => "upload/images/",
			"allowed_types" => "jpg|jpeg|png",
			"max_size" => "5000",
			"remove_space" => true,
			"encrypt_name" => true
		);
		$this->load->library("upload", $config);
		if ($this->upload->do_upload($field)) {
			$result = array("result" => "success", "file" => $this->upload->data(), "error" => "");
			return $result;
		} else {
			$result = array("result" => "failed", "file" => "", "error" => $this->upload->display_errors());
			return $result;
		}
	}

	public function riwayat()
    {
        $riwayatObat = $this->ModelObat->riwayat();
        $data = array(
			"header" => "Riwayat Hapus Obat",
            "page" => "content/obat/v_riwayatObat",
            "obats" => $riwayatObat
        );
        $this->load->view("layout/main", $data);
    }
}
