<?php
/**
* 
*/
class Hocphan_model extends CI_model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	public function gethocphan()
	{
		$q=$this->db->query('CALL join_hocphan()');
		return $q->result_object();
	}
	public function getgiaovien()
	{
		$q=$this->db->get('giaovien');
		return $q->result_object();
	}
	public function getphong()
	{
		$q=$this->db->get('phong');
		return $q->result_object();
	}
	public function getmonhoc()
	{
		$q=$this->db->get('monhoc');
		return $q->result_object();
	}
	public function getkhoa()
	{
		$q=$this->db->get('khoa');
		return $q->result_object();
	}
	public function getnamhoc()
	{
		$q=$this->db->get('namhoc');
		return $q->result_object();
	}
	public function gethocky()
	{
		$q=$this->db->get('hocky');
		return $q->result_object();
	}
}
?>