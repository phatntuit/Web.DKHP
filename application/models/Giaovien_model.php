<?php
class Giaovien_model extends CI_model
{
	public function show()
	{
		$query = $this->db->get('giaovien');
		$query_result = $query->result_object();
		return $query_result;
	}
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('Magiaovien',$id);
		$query = $this->db->get();
		return $query->row();
	}
	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

}
?>