<?php
/**
* 
*/
class Dangky_model extends CI_model
{
	
	public function __construct()
	{
		parent::__construct();
	}
	public function gethocphan()
	{
		$query= $this->db->get('hocphan');
    	$query_result= $query->result_object();
    	return $query_result;
	}
	//kiểm tra tính tồn tại của mã lớp
	public function kiemtradsml()
	{

	}
}
?>