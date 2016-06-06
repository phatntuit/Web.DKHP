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
	public function kiemtratrungmonhoc($mssv,$mahk,$manh,$malop)
	{
		$this->db->query("CALL getmamhcuahocphan('$malop',@mhdangdk,@ht)");
		$q=$this->db->query('select @mhdangdk as mhdangdk,@ht as hinhthuc');
		$q=$q->result_array();
		$w=$this->db->query("CALL getmamhdadangky('$mssv','$mahk','$manh')");
		//$w=$this->db->query('select @mhdadk as mhdadk,@ht as hinhthuc');
		$w=$w->result_object();
		mysqli_next_result( $this->db->conn_id );
		foreach ($q as $mhp) {
			foreach ($w as $mdk) {
				if($mdk->Mamonhoc==$mhp['mhdangdk'] && $mdk->Hinhthuc==$mhp['hinhthuc'])
					return FALSE;
			}
		}
		return TRUE;
	}
	// input ma lop thực hành. trả về true khi ma lớp thưc hành trùng lớp lý thuyết
	public function kiemtralopltvoith($mssv,$mahk,$manh,$malop)
	{
		if(strlen($malop)>9){
			$this->db->query("CALL getmamhcuahocphan('$malop',@mhdangdk,@ht)");
			$q=$this->db->query('select @mhdangdk as mhdangdk,@ht as hinhthuc');
			$q=$q->result_array();
			$w=$this->db->query("CALL getmamhdadangky('$mssv','$mahk','$manh')");
			//$w=$this->db->query('select @mhdadk as mhdadk,@ht as hinhthuc,@malop as malop');
			$w=$w->result_object();
			mysqli_next_result( $this->db->conn_id );
			foreach ($q as $mhp) {
				foreach ($w as $mdk) {
					if($mdk->Mamonhoc==$mhp['mhdangdk'] && $mdk->Hinhthuc!=$mhp['hinhthuc'])
						$a=substr($malop, 0,9);
						if($a!=$mdk->malop)
							return FALSE;
				}
			}
		}
		return TRUE;
	}
	//trả về true khi thứ của lớp đang dk trùng thứ của lớp đã dk
	public function kiemtratrungthu($mssv,$mahk,$manh,$malop)
	{
		$thudadk=$this->db->query("CALL getthulopdadk('$mssv','$mahk','$manh')");
		//$thudadk=$this->db->query('select @thu as thulopdadk');
		$thudadk=$thudadk->result_object();
		mysqli_next_result( $this->db->conn_id );
		$this->db->query("CALL getthulopdangdk('$malop',@thu)");
		$thudangdk=$this->db->query('select @thu as thulopdangdk');
		$thudangdk=$thudangdk->result_object();
		foreach ($thudangdk as $a) {
			foreach ($thudadk as $b) {
				if($a->thulopdangdk==$b->Thu)
					return TRUE;
			}
		}
		return FALSE;
	}
	//trả về true khi không trùng lịch vs các môn đã đăng ký
	public function kiemtratrungtiet($mssv,$mahk,$manh,$malop)
	{
		if($this->kiemtratrungthu($mssv,$mahk,$manh,$malop)===TRUE){
			$dadk=$this->db->query("CALL gettietdadk('$mssv','$mahk','$manh')");
			//$dadk=$this->db->query('select @tbd as Tietbatdau,@tkt as Tietketthuc');
			$dadk=$dadk->result_object();
			mysqli_next_result( $this->db->conn_id );
			$this->db->query("CALL gettietlopdangdk('$malop',@tbd,@tkt)");
			$dangdk=$this->db->query('select @tbd as Tietbatdau,@tkt as Tietketthuc');
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
	public function kiemtramontq($mssv,$mahk,$manh,$malop)
	{
		$mhtq=$this->db->query("CALL getmontq('$malop')");
		$mhtq=$mhtq->result_array();
		//return $mhtq;
		mysqli_next_result( $this->db->conn_id );
		if(count($mhtq)==0)//không có môn tiên quyết cho đăng ký
			return TRUE;
		else{
			foreach ($mhtq as $mtq) {
				$mamh=$mtq['Mamonhoc_tq'];
				$diemtq=$this->db->query("CALL getdiemtq('$mssv','$mamh')");
				//$diemtq=$this->db->query('select @nh as namhoc,@hk as hocky,@diem as diem');
				$diemtq=$diemtq->result_array();
				if(count($diemtq)==0)//chưa học môn tiên quyết không cho đăng ký
					return FALSE;
				else{
					$maxnh=$diemtq[0]['Manamhoc'];
					$maxhk=$diemtq[0]['Mahocky'];
					if($maxnh!=$manh || $maxhk!=$mahk){//kiểm tra nếu điểm môn tiên quyết thuộc hk,nh đang đăng ký->chưa hoàn thành môn tiên quyết trước->ko cho đăng ký
						$maxnam=substr($diemtq[0]['Manamhoc'],0,4);
						$maxk=substr($diemtq[0]['Mahocky'],2,1);
						for ($i=1; $i <count($diemtq) ; $i++) {//lấy năm học gần nhất
							if($diemtq[$i]['Manamhoc']!=$manh || $diemtq[$i]['Mahocky']!=$mahk){
								$nam=substr($diemtq[$i]['Manamhoc'],0,4);
								if($nam>$maxnam){
									$maxnam=$nam;
									$maxnh=$diemtq[$i]['Manamhoc'];
								}
							}
						}
						for ($i=1; $i <count($diemtq) ; $i++) { //lấy hk gần nhất thuộc năm học gần nhất
							if($diemtq[$i]['Manamhoc']!=$manh || $diemtq[$i]['Mahocky']!=$mahk){
								if($diemtq[$i]['Manamhoc']==$maxnh){
									$hk=substr($diemtq[$i]['Mahocky'],2,1);
									if($hk>$maxk){
										$maxk=$hk;
										$maxhk=$diemtq[$i]['Mahocky'];
									}
								}
							}
						}
						for ($i=0; $i <count($diemtq) ; $i++) {
							if($diemtq[$i]['Mahocky']==$maxhk && $diemtq[$i]['Manamhoc']==$maxnh){
								if($diemtq[$i]['Diem']<5)
									return FALSE;
							}
						}
						return TRUE;
					}
					return FALSE;
				}
			}	
		}
	}
	public function addphieudangky($mssv,$mahk,$manh,$malop)
	{
		$tt=$this->db->query("CALL kiemtratontaipdk('$mssv','$manh','$mahk')");
		$tt=$tt->result_array();
		mysqli_next_result( $this->db->conn_id);
		return $tt;
		if(count($tt)==0){
			//add pdk
			//add ct_pdk
		}
		else{
			//add ct_pdk
		}
	}
}
?>