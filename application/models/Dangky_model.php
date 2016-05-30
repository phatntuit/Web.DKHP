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
	//hàm trả về true khi count==1(malop tồn tại)
	public function kiemtramalop($malop)
	{
		$bool=TRUE;
		$this->db->query("CALL kiemtramalop('$malop',@tc)");
		$q=$this->db->query('select @tc as cnt');
		$q=$q->result_object();
		foreach ($q as $key ) {
			$count=$key->cnt;
		}
		if($count!=1) $bool=FALSE;
		return $bool;
	}
	//kiểm tra số lượng sinh viên của lớp hiện hành
	//hàm tra về false khi count==1(số lượng sinh viên đã đăng ký lớp đó = số lượng sinh viên dự kiến của lớp)
	public function kiemtraslsv($malop)
	{
		$this->db->query("CALL KT_SL('$malop',@ck)");
		$q=$this->db->query('select @ck as kt');
		$q=$q->result_array();
		foreach ($q as $key) {
			$count=$key['kt'];
		}
		if($count==1) return FALSE;
		else return TRUE;
	}
	//kiểm tra trùng môn học đã đăng ký(cho học kỳ năm học đang đăng ký)
	public function kiemtratrungmonhoc($mssv,$mahk,$namhoc,$malop)
	{
		$manh=$this->getmanh($namhoc);
		$this->db->query("CALL getmamhcuahocphan('$malop',@mhdangdk)");
		$q=$this->db->query('select @mhdangdk as lopdangdk');
		$q=$q->result_array();
		$this->db->query("CALL getmamhdadangky('$mssv','$mahk','$manh',@mhdadk)");
		$w=$this->db->query('select @mhdadk as lopdadk');
		$w=$w->result_object();
		foreach ($q as $mhp) {
			foreach ($w as $mdk) {
				if($mdk->lopdadk==$mhp['lopdangdk'] )
					return FALSE;
			}
		}
		return TRUE;
	}
	public function kiemtralopltvoith($mssv,$mahk,$namhoc,$malop)
	{
		$manh=$this->getmanh($namhoc);
		$q=$this->db->query("CALL getmamhcuahocphan('$malop')");
		$q=$q->result_array();
		$w=$this->db->query("CALL getmamhdadangky('$mssv','$mahk','$manh')");
		$w=$w->result_array();
		foreach ($q as $mhp) {
			foreach ($w as $mdk) {
				if($mdk['Mamonhoc']==$mhp['Mamonhoc'] && $mdk['Hinhthuc']!=$mhp['Hinhthuc'])
					if(strlen($malop)>strlen($mdk['Malop'])){
						$a=substr($malop, 0,9);
						if($a!=$mdk['Malop'])
							return FALSE;
					}
					else{
						$a=substr($mdk['Malop'],0,9);
						if($a!=$malop)
							return FALSE;
					}	
			}
		}
		return TRUE;
	}
	public function getmanh($namhoc)
	{
		$this->db->query("CALL getmanh('$namhoc',@manh)");
		$q=$this->db->query('select @manh as manh');
		$q=$q->result_object();
		foreach ($q as $key ) {
			$manh=$key->manh;
		}
		return $manh;
	}
	//trả về true khi thứ của lớp đang dk trùng thứ của lớp đã dk
	public function kiemtratrungthu($mssv,$mahk,$manh,$malop)
	{
		$this->db->query("CALL getthulopdadk('$mssv','$mahk','$manh',@thu)");
		$thudadk=$this->db->query('select @thu as thulopdadk');
		$thudadk=$thudadk->result_object();
		$this->db->query("CALL getthulopdangdk('$malop',@thu)");
		$thudangdk=$this->db->query('select @thu as thulopdangdk');
		$thudangdk=$thudangdk->result_object();
		foreach ($thudangdk as $a) {
			foreach ($thudadk as $b) {
				if($a->thulopdangdk==$b->thulopdadk)
					return TRUE;
			}
		}
		return FALSE;
	}
	public function kiemtratrungtiet($mssv,$mahk,$namhoc,$malop)
	{
		$manh=$this->getmanh($namhoc);
		if($this->kiemtratrungthu($mssv,$mahk,$manh,$malop)===TRUE){
			$dadk=$this->db->query("CALL gettietdadk('$mssv','$mahk','$manh')");
			$dadk=$dadk->result_object();
			$dangdk=$this->db->query("CALL gettietlopdangdk('$malop')");
			$dangdk=$dangdk->result_array();
			foreach ($dadk as $a) {
				foreach ($dangdk as $b) {
					if($a->Tietbatdau==$b['Tietbatdau'] || $a->Tietketthuc==$b['Tietketthuc'] || $b['Tietbatdau']==$a->Tietketthuc || $a->Tietbatdau==$b['Tietketthuc'] || ($a->Tietbatdau<$b['Tietbatdau'] && $a->Tietketthuc>$b['Tietketthuc']) || ($a->Tietbatdau>$b['Tietbatdau'] && $a->Tietketthuc<$b['Tietketthuc']))
						return FALSE;
				}
			}
		}
		return TRUE;
	}
}
?>