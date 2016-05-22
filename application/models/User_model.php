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
	// test
	public function check_login_md5($id,$pwd)
	{
		$error="";
		$ck=0;
		$quyen="";
		$sql="CALL CHECK_LOGIN('$id','$pwd',@p3,@p4,@p5)";
		//$this->db->trans_start();
		$result=$this->db->query($sql);
		$this->db->query($sql); // not need to get output
        $query = $this->db->query("SELECT @p3 as error,@p4 as ck ,@p5 as quyen");
		//$this->db->trans_complete();
        if($query->num_rows() > 0)
            $result = $query->result_array();
        //print_r($result);
        return $result;

	}
	public function Get_thamso()
	{
		$sql="CALL GET_THAMSO()";
		$query=$this->db->query($sql);
		if($query->num_rows() > 0)
            $result = $query->result_array();
        return $result;
	}
	// end test

}
?>