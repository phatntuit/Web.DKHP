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
			$this->load->view('template/header',$this->data);
			$this->load->view('dangky');
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
			$dsmh=$this->input->get('edit-dsmh');
			$dsmh=strtoupper($dsmh);
			$mahk='HK'.$_SESSION['hocky'];
			if($dsmh==''){
				$data['require']="Vui lòng điền mã lớp";
				echo json_encode($data);
				exit();
			}
			$dsml=explode("\r\n", $dsmh);
			for ($i=0;$i<count($dsml);$i++) {
				//kiểm tra tính tồn tại của mã lớp
				if($this->Dangky_model->kiemtramalop($dsml[$i])===TRUE){
					//kiểm tra lớp đăng ký hiện tại đã đăng ký chưa(cho học kỳ và năm học đang đăng ký)
					if($this->Dangky_model->kiemtratrungmonhoc($_SESSION['id'],$mahk,$_SESSION['namhoc'],$dsml[$i])===TRUE){
					//kiểm tra lớp đăng ký đã đủ số lượng sinh viên chưa
						if($this->Dangky_model->kiemtraslsv($dsml[$i])===TRUE){
							if($this->Dangky_model->kiemtratrungtiet($_SESSION['id'],$mahk,$_SESSION['namhoc'],$dsml[$i])===TRUE){
								array_push($data['success'],$dsml[$i]);
							}
							else array_push($data['trunglich'],$dsml[$i]);
						}
						else array_push($data['lopday'],$dsml[$i]);
					}
					else array_push($data['dadk'],$dsml[$i]);
				}
				else array_push($data['malopkhongtontai'],$dsml[$i]);
			}
			echo json_encode($data);
		}
	}
}
