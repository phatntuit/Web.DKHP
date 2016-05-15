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
	public function addhocphan($data)
	{
		$this->db->insert('hocphan',$data);
	}
	//lấy số tín chỉ của lớp dựa trên hình thức trong bảng môn học
	public function gettinchi($mamon,$hinhthuc)
	{
		$this->db->query("CALL Gettinchi('$mamon','$hinhthuc',@tc)");
		$q=$this->db->query("select @tc as tinchi");
		$result=$q->result_array();
		//mysqli_next_result( $this->db->conn_id );
		return $result;
	}
	//kiểm tra trạng thái của phòng đã được xếp lịch hay chưa?
	public function kiemtraphongtrong($namhoc,$hocky,$maphong,$thu,$tietbatdau,$tietketthuc)
	{
		$q=$this->db->query("CALL kiemtraphongtrong('$hocky','$namhoc','$thu','$maphong','$tietbatdau','$tietketthuc')");
		$q=$q->result_object();
		mysqli_next_result( $this->db->conn_id );
		return $q->row_count;
	}
	//lấy sức chứa của phòng
	public function getsucchua($maphong)
	{
		//mysqli_next_result( $this->db->conn_id );
		$q=$this->db->query("CALL getsucchua('$maphong')");
		
		return $q->result_object();
	}
}
?>