<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hocphi extends  CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{	
		$this->data['page_title'] = 'Thông tin học phí';
		$this->load->model('Hocphi_model');
	//	$data['sinhvien']=$this->hocphi_model->show();
	//	$this->load->view('hocphi_view',$data);
		$this->data['hocphi'] = $this->Hocphi_model->show();
		$this->load->view('template/header',$this->data);
		$this->load->view('hocphi_view');

	}
}