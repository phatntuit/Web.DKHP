<?php
/**
* 
*/
class User_model extends CI_model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	public function check_login($id,$pwd)
	{
		$query="SELECT * FROM nguoidung WHERE Manguoidung = ? and Matkhau= ?";
		$result=$this->db->query($query,array($id,$pwd));
		$num=$result->num_rows();
		if($num==true)
			return true;
		return false;

	}
	public function Get_user($id)
	{
		$sql="select * from nguoidung where manguoidung =?";
		$exec=$this->db->query($sql,array($id));
		$result=$exec->result_array();
		//print_r($result);
		return $result;
	}

}
?>