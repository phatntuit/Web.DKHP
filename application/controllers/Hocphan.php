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
	}
	public function index()
	{
		$this->data['page_title']='Thông tin học phần';
		$this->load->view('template/header',$this->data);
		$this->load->view('hocphan/thongtinhocphan');
	}
}
?>