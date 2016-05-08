<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Giaovien extends  CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function index()
	{	
		//$this->load->model('Giaovien_model');
	//	$data['sinhvien']=$this->hocphi_model->show();
	//	$this->load->view('hocphi_view',$data);
		//$hocphi['hocphi'] = $this->hocphi_model->showhocphi();
		$this->load->view('giaovien_view');
	}
}