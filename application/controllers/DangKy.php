<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DangKy extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Dangky_model');
	}
	public function index()
	{
		if(isset($_SESSION['id'])){
			$this->data['page_title']='Đăng ký  | Hệ thống đăng ký học phần';
			$this->data['hocphan'] = $this->Dangky_model->gethocphan();
			$this->data['test']=$this->Dangky_model->showpdk($_SESSION['id'],$_SESSION['hocky'],$_SESSION['namhoc']);
			$this->load->view('template/header',$this->data);
			$this->load->view('dangky');

		}
		else
    	{
        	echo "<div class='container'>
        	<div class='col-xs-3 col-sm-3 col-md-3 col-lg-3'></div>
        	<div class='col-xs-4 col-sm-4 col-md-4 col-lg-4'><p class='has-error'>(*) Bạn vui lòng đăng nhập để sử dụng website.</p>";
        	$this->load->view('template/login');
        	echo "</div></div>";
    	}

	}
	public function dangkynhanh()
	{
		if(isset($_SESSION['id'])){
			$data = array();
			$data['success']= array();
			$data['malopkhongtontai']=array();
			$data['lopday']=array();
			$data['require']='';
			$data['dadk']=array();
			$data['trunglich']=array();
			$data['ltvsth']=array();
			$data['tienquyet']=array();
			$dsmh=$this->input->get('edit-dsmh');
			$dsmh=strtoupper($dsmh);
			if($dsmh==''){
				$data['require']="Vui lòng điền mã lớp";
				echo json_encode($data);
				exit();
			}
			$dsml=explode("\r\n", $dsmh);
			for ($i=0;$i<count($dsml);$i++) {
				//kiểm tra tính tồn tại của mã lớp
				if($this->Dangky_model->kiemtramalop($dsml[$i])===TRUE){
					//kiểm tra lớp lý thuyết vs lớp thục hành
					if($this->Dangky_model->kiemtralopltvoith($_SESSION['id'],$_SESSION['hocky'],$_SESSION['namhoc'],$dsml[$i])===TRUE){
						//kiểm tra lớp đăng ký hiện tại đã đăng ký chưa(cho học kỳ và năm học đang đăng ký)
						if($this->Dangky_model->kiemtratrungmonhoc($_SESSION['id'],$_SESSION['hocky'],$_SESSION['namhoc'],$dsml[$i])==TRUE){
						//kiểm tra lớp đăng ký đã đủ số lượng sinh viên chưa
							if($this->Dangky_model->kiemtraslsv($dsml[$i])===TRUE){
								//kiểm tra trùng lịch học với các môn đã đăng ký
								if($this->Dangky_model->kiemtratrungtiet($_SESSION['id'],$_SESSION['hocky'],$_SESSION['namhoc'],$dsml[$i])===TRUE){
									if($this->Dangky_model->kiemtramontq($_SESSION['id'],$_SESSION['hocky'],$_SESSION['namhoc'],$dsml[$i])===TRUE){
										$this->Dangky_model->addphieudangky($_SESSION['id'],$_SESSION['hocky'],$_SESSION['namhoc'],$dsml[$i]);
										array_push($data['success'],$dsml[$i]);
									}
									else array_push($data['tienquyet'],$dsml[$i]);
								}
								else array_push($data['trunglich'],$dsml[$i]);
							}
							else array_push($data['lopday'],$dsml[$i]);
						}
						else array_push($data['dadk'],$dsml[$i]);
					}
					else array_push($data['ltvsth'],$dsml[$i]);
				}
				else array_push($data['malopkhongtontai'],$dsml[$i]);
			}
			echo json_encode($data);
		}
	}
	public function showdadk()
	{
		$tb='';
		$tb='<div class="form-wrapper"><span><a style="color:blue" data-toggle="collapse" data-target="#dadk" href="javascript:void(0)">Lớp đã đăng ký</a><hr></span></div><br>
					<div id="dadk" class="collapse">';

		$tb.='</div>';
	}
	public function huyhocphan()
	{
		if(isset($_SESSION['id'])){
			$dsmh=$this->input->get('ds-malop-huy');
			$dsmh=strtoupper($dsmh);
			if($dsmh==''){
				$data['require']="Vui lòng điền mã lớp";
				echo json_encode($dsmh);
				exit();
			}
			$dsml=explode("-", $dsmh);
			
			echo json_encode($dsml);
		}
	}
}
