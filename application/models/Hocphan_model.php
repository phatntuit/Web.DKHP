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
	// ---------------------------
	/* test mã số */
	function Randomstr($length) 
	{
		$ch=substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
    	return  $ch;
	}
	public function Taoma($mamon,$hinhthuc)
	{
		$this->load->model('Taoma');

	}
	/* kết thúc phần test*/
	//----------------------------
	public function gethocphan()
	{
		$q=$this->db->query('CALL join_hocphan()');
		$result= $q->result_object();
		mysqli_next_result( $this->db->conn_id );
		return $result;
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