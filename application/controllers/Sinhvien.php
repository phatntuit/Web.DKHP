<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sinhvien extends  CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sinhvien_model');
		$this->data['nganh']=$this->Sinhvien_model->Get_nganh();
		$this->data['khoahoc']=$this->Sinhvien_model->Get_khoahoc();
		$this->data['sinhvien']=$this->Sinhvien_model->Get_sv();
	}
	public function index()
	{	
		$this->load->model('Sinhvien_model');
		$this->data['page_title'] = 'Quản lý sinh viên';
		$this->data['header']="Trang quản lý sinh viên";
		// header là chức năng của page
		$this->load->view('sinhvien_view',$this->data);
		
	}
	//test ajax
	// public function index()
	// {	
	// 	$this->load->view('test_ajax');
	// }
	// public function test()
	// {
	// 	$user=array('name' =>'Phat','diem'=>'10' );
	// 	echo json_encode($user);
	// }
	// public function Testajax()
	// {
	// 	$input=
	// }
}