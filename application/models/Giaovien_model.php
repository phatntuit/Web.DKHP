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
		$this->db->trans_begin();
		$this->db->update('giaovien', $data, $where);
		if($this->db->trans_status()=== FALSE)
		{
			$this->db->trans_rollback();	
		}
		else
		{
			$this->db->trans_commit();
		}
	}

	public function add($data)
	{
		$this->db->trans_begin();
		$this->db->insert('giaovien', $data);
		if($this->db->trans_status()=== FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();

		}
	
	}

	public function delete_by_id($id)
	{
		
		$this->db->trans_begin();
		$this->db->where('Magiaovien', $id);
		$this->db->delete('giaovien');
		if($this->db->trans_status()=== FALSE)
		{
			$this->db->trans_rollback();
		}
		else
		{
			$this->db->trans_commit();
		}

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