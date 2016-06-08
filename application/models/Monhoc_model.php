<?php
/**
* 
*/
class Monhoc_model extends CI_model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	public function show()
	{
		$query = $this->db->get('monhoc');
		$result = $query->result_object();
		return $result;
	}
	public function add($data)
	{
		$this->db->insert('monhoc',$data);
	}
}
?>