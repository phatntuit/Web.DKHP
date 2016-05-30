<?php
class Sinhvien_model extends CI_model
{
	public function Taoma()
	{
		$tenid="Mssv";
		$tenbang="sinhvien";
		$chuoi="";
		$limit=8;
		// xét năm hiện tại để tạo mã sinh viên : yy52xxxx
		// y là year,x là số thứ tự
		$chuoi=date("Y");
		$chuoi=substr($chuoi,-2);
		$chuoi=$chuoi."52";
		$this->load->model('Taoma');
		return $this->Taoma->Matudong($tenid,$tenbang,$chuoi,$limit);
	}
	public function Get_sv()
	{
		$sp_data = $this->db->query("CALL GET_SV()");
		$result = $sp_data->result_array();
		return $result;
	}
	public function Get_khoahoc()
	{
		$q=$this->db->get('khoahoc');
		return $q->result_object();
	}
	public function get_nganh()
	{
		$q=$this->db->get('nganh');
		return $q->result_object();
	}
}
?>