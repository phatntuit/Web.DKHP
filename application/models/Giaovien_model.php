<?php
class Hocphi_model extends CI_model
{
	public function show()
	{
		$query = $this->db->get('sinhvien');
		$query_result = $query->result_object();
		return $query_result;
	}
}
?>