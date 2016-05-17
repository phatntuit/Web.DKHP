<?php
class Giaovien_model extends CI_model
{
	public function show()
	{
		$query = $this->db->get('giaovien');
		$query_result = $query->result_object();
		return $query_result;
	}
	public function update($where, $data)
	{
		$this->db->update('giaovien', $data, $where);
	}

	public function add($data)
	{
		 $this->db->insert('giaovien', $data);
	}

	public function delete_by_id($id)
	{
		$this->db->where('Magiaovien', $id);
		$this->db->delete('giaovien');
	}
	public function get_by_id($id)
	{
		$this->db->from('giaovien');
		$this->db->where('Magiaovien',$id);
		$query = $this->db->get();
		return $query->row();
	}
	public function getgiaovien()
	{
		$giaovien = $this->db->query("CALL GET_GV()");
		$result = $giaovien->result_object();
		mysqli_next_result( $this->db->conn_id );
		return $result;
	}
}
?>