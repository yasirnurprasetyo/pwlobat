<?php


class ModelObat extends CI_Model
{
	var $table = "obat";
	var $primaryKey = "id_obat";

	public function insert($data)
	{
		return $this->db->insert($this->table, $data);
	}

	public function insertGetId($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function getAll()
	{
		//hanya mengembalikan data yang is_active = 1
		$this->db->where("is_active", 1);
		return $this->db->get($this->table)->result();
	}

	public function getByPrimaryKey($id)
	{
		$this->db->where($this->primaryKey, $id);
		return $this->db->get($this->table)->row();
	}

	public function update($id, $data)
	{
		$this->db->where($this->primaryKey, $id);
		return $this->db->update($this->table, $data);
	}

	// delete data
	public function delete($id)
	{
		//hanya mengupdate is_active dari 1 menjadi 0
		$this->db->where($this->primaryKey, $id);
		return $this->db->update($this->table, array("is_active" => 0));
	}

	public function riwayat()
	{
		$this->db->where("is_active", 0);
		return $this->db->get($this->table)->result();
	}

	public function hitungStockSisa() {
		$sql = "SELECT sum(stock_obat) as stock_obat FROM obat";
		$result =  $this->db->query($sql);
		return $result->row()->stock_obat;
	}
}
