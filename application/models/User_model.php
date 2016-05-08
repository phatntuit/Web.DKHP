<?php
/**
* 
*/
class User_model extends CI_model
{
	
	public function __construct()
	{
		parent::__contruct();
	}
	public function resolve_user_login($id, $password) {
		$this->db->select('matkhau');
		$this->db->from('nguoidung');
		$this->db->where('manguoidung', $id);
		// $hash = $this->db->get()->row('password');
		if($password==$this->db->get()->row('matkhau'))
			return true;
		return false;
	}
	public function get_user($id) {
		
		$this->db->from('nguoidung');
		$this->db->where('manguoidung', $id);
		return $this->db->get()->row();
		
	}

}
?>