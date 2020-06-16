<?php


class ModelTransaksi extends CI_Model {
	var $table = "transaksi";
	var $primaryKey = "id_transaksi";

	public function insert($data) {
		return $this->db->insert($this->table, $data);
	}

	public function insertGetId($data) {
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
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

	function insertBatch($params)
	{
		$this->db->insert_batch('item_transaksi', $params);
	}

	// delete data
	public function delete($id) {

		return $this->db->update($this->table, array("is_active" => 0));
	}

	public function getJoinFull($id)
	{
		$this->db->select("b.nama_obat,it.*,t.*")
			->from("item_transaksi as it")
			->join("obat as b", "it.id_obat = b.id_obat")
			->join("transaksi as t", "it.id_transaksi = t.id_transaksi")
			->where("it.id_transaksi", $id);
		return $this->db->get()->result();
	}

	public function topSale()
	{
		$data = $this->db->select('*, b.nama_obat as nama_obat, SUM(qty_item_transaksi) as total_qty')
			->from('item_transaksi it')
			->join("obat b", 'it.id_obat = b.id_obat')
			->order_by('total_qty', 'desc')
			->limit(5)
			->group_by('it.id_obat')
			->get()->result();
		return $data;
	}
}
