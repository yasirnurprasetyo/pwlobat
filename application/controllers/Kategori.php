<?php
class Kategori extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        isLogin();
        $this->load->model("ModelKategori");
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
	{
		$listKategori = $this->ModelKategori->getAll();
		$data = array(
			"header" => "kategori",
			"page" => "content/kategori/v_list_kategori",
			"kategoris" => $listKategori
		);
		$this->load->view("layout/main", $data);
	}
	public function register()
    {
        $kategori = new stdClass();
        $kategori->id_kategori = null;
        $kategori->nama_kategori = null;
        $data = array(
            "header" => "Tambah Data Kategori",
            "page" => "content/kategori/modal",
            "pages" => 'register',
            "suppliers" => $kategori
        );
        $this->load->view("layout/main", $data);
    }

    public function update($id)
    {
        $listKategori = $this->ModelKategori->getByPrimaryKey($id);
        $data = array(
			"pages" => 'update',
			"page" => "content/kategori/modal",
            "suppliers" => $listKategori
        );
        $this->load->view("layout/main", $data);
    }

    public function proses_simpan()
    {
        $kategori = array(
            "nama_kategori" => $this->input->post('nama_kategori'),
        );
        $this->ModelKategori->insert($kategori);
        redirect("Kategori");
    }

    public function proses_update()
    {
        $id = $this->input->post("kategoriID", true);
        $nama = $this->input->post("nama_kat", true);
        $kategori = array(
            "nama_kategori" => $nama,
        );
        redirect("Kategori");
    }

    public function proses_delete($id)
    {
        $this->ModelKategori->delete($id);
        redirect("Kategori");
    }
}
