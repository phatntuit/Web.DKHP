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
		$this->data['monhoc']=$this->Hocphan_model->getmonhoc();
		$this->data['khoa']=$this->Hocphan_model->getkhoa();
		$this->data['hocky']=$this->Hocphan_model->gethocky();
		$this->data['namhoc']=$this->Hocphan_model->getnamhoc();
		$this->data['giaovien']=$this->Hocphan_model->getgiaovien();
		$this->data['phong']=$this->Hocphan_model->getphong();
		$this->data['hocphan']=$this->Hocphan_model->gethocphan();
	}
	public function index()
	{
		$this->data['page_title']='Thông tin học phần';
		$this->load->view('template/header',$this->data);
		$this->load->view('hocphan/thongtinhocphan');
	}
}
?>