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
		$this->data['page_title'] = 'Thông tin giáo viên';
		$this->load->model('Giaovien_model');
		$this->data['giaovien'] = $this->Giaovien_model->show();
		$this->load->view('template/header',$this->data);
		$this->load->view('giaovien_view');
	}
	public function ajax_edit($id)
	{
		$data = $this->person->get_by_id($id);
		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
	public function Get_Gv()
	{
		$this->load->model('Giaovien_model');
		$data['giaovien'] = $this->Giaovien_model->Get_Gv();
		$this->load->view('test',$data);

	}
}