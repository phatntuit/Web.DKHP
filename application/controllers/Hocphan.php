<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Hocphan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Hocphan_model');
		$this->data['hocphan']=$this->Hocphan_model->gethocphan();
		$this->data['monhoc']=$this->Hocphan_model->getmonhoc();
		$this->data['giaovien']=$this->Hocphan_model->getgiaovien();
		$this->data['khoa']=$this->Hocphan_model->getkhoa();
		$this->data['phong']=$this->Hocphan_model->getphong();
		$this->data['hocky']=$this->Hocphan_model->gethocky();
		$this->data['namhoc']=$this->Hocphan_model->getnamhoc();
	}
	public function index()
	{
		
		$this->data['page_title']='Thông tin học phần';
		$this->load->view('template/header',$this->data);
		$this->load->view('hocphan/thongtinhocphan');
	}
	public function addhocphan()
	{
		//$this->_validate();
		echo json_encode(array("status" => TRUE));
	}
	// Hàm bên dưới đang test mã lớp 
	public function test()
	{
		$this->load->model('Hocphan_model');
		$ch=$this->Hocphan_model->Randomstr(1);
		echo $ch;
	}
	//// kết thúc phần test
}
?>