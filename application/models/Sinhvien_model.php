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
}
?>