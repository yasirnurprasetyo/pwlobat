<?php


class ModelItemTransaksi extends CI_Model {
	var $table = "item_transaksi";
	var $primaryKey = "id_item_transaksi";

	public function insert($data) {
		return $this->db->insert($this->table, $data);
	}

	public function insertBatch($data) {
		return $this->db->insert_batch($this->table, $data);
	}

	public function getAll() {
		return $this->db->get($this->table)->result();
	}

	public function getByPrimaryKey($id) {
		$this->db->where($this->primaryKey, $id);
		return $this->db->get($this->table)->row();
	}

	public function update($id, $data) {
		$this->db->where($this->primaryKey, $id);
		return $this->db->update($this->table, $data);
	}

	// delete data
	public function delete($id) {
		//hanya mengupdate is_active dari 1 menjadi 0
		$this->db->where($this->primaryKey, $id);
		return $this->db->update($this->table, array("is_active" => 0));
	}

	public function getJoinChart()
    {
        $this->db->select('MONTH(transaksi.tanggal_transaksi) as bulan, SUM(item_transaksi.total_item_transaksi) AS totals');
		$this->db->from('transaksi');
		$this->db->join('item_transaksi', 'transaksi.id_transaksi=item_transaksi.id_transaksi');
        $this->db->group_by('MONTH(transaksi.tanggal_transaksi)');
        return $this->db->get()->result();
	}
	
	public function hitungItemTerjual() {

		$this->db->select_sum('qty_item_transaksi');
        return $this->db->get('item_transaksi')->row()->qty_item_transaksi;
	}

	public function hitungPendapatan()
	{
		$this->db->select_sum('total_item_transaksi');
		return $this->db->get('item_transaksi')->row()->total_item_transaksi;
	}

	public function getMinStock()
    {
        $this->db->select('obat.nama_obat, obat.stock_obat');
        $this->db->from('obat');
        $this->db->where('obat.stock_obat < 10');
        $query = $this->db->get();
        return $query;
        // select obat.nama as nama_barang, obat.stock from obat where obat.stock < 10;
    }
}
