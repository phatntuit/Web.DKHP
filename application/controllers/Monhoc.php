<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Monhoc extends CI_Controller
{
	public function construct()
	{
		parent::__construct();
		$this->load->model('Monhoc_model');
	}
	public function index()
	{	
		$this->load->helper('url');
		$this->data['page_title'] = 'Thông tin môn học';
		$this->load->model('Monhoc_model');
		$this->data['monhoc'] = $this->Monhoc_model->show();
		$this->load->view('template/header',$this->data);
		$this->load->view('monhoc_view');
	}
	public function ajax_add()
	{
		$data = array(
				
				'Mamonhoc' => $this->input->get('Mamonhoc'),
				'Tenmonhoc' => $this->input->get('Tenmonhoc'),
				'Sotinchi_lt' => $this->input->get('Sotinchilt'),
				'Sotinchi_th'=> $this->input->get('Sotinchith'),
				'Sotinchi' => $this->input->get('Sotinchi'),
			);
		 $this->Monhoc_model->add($data);
		echo json_encode(array("status" => TRUE));
	}


}
 ?>