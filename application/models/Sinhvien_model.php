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
		$sinhvien = $this->db->query("CALL GET_SV()");
		$result = $sinhvien->result_object();
		mysqli_next_result( $this->db->conn_id );
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
	public function update($where, $data)
	{
		$this->db->update('sinhvien', $data, $where);
	}

	public function add($data)
	{
		 $this->db->insert('sinhvien', $data);
	}

	public function delete_by_id($id)
	{
		$this->db->where('Mssv', $id);
		$this->db->delete('sinhvien');
	}
	public function get_by_id($id)
	{
		$this->db->from('sinhvien');
		$this->db->where('Mssv',$id);
		$query = $this->db->get();
		return $query->row();
	}
	public function get_nganh_by_id($id)
	{
		$this->db->from('nganh');
		$this->db->where('Manganh',$id);
		$query = $this->db->get();
		return $query->row();
	}
}
?>