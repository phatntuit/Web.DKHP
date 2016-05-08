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
	public function getdata()
	{
		$query= $this->db->get('');
    	$query_result= $query->result_object();
    	return $query_result;
	}

}
?>