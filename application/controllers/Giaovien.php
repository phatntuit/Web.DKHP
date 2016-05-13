<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Giaovien extends  CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Giaovien_model');
		
	}
	public function index()
	{	
		$this->load->helper('url');
		$this->data['page_title'] = 'Thông tin giáo viên';
		$this->load->model('Giaovien_model');
		$this->data['giaovien'] = $this->Giaovien_model->show();
		$this->load->view('template/header',$this->data);
		$this->load->view('giaovien_view');
	}
	public function taoma()
	{
		$this->load->model('Taoma');
		$ma = $this->Taoma->Matudong("Magiaovien","giaovien","GV",5);
		return $ma;

	}
	public function ajax_add()
	{
		//$this->_validate();
		$data = array(
				'Magiaovien' => $this->taoma(),
				'Tengiaovien' => $this->input->get('Tengiaovien'),
				'Mahocvi' => $this->input->get('Mahocvi'),
				'Gioitinh' => $this->input->get('Gioitinh'),
				'Ngaysinh' => $this->input->get('Ngaysinh'),
				'Diachi' => $this->input->get('Diachi'),
				'Dienthoai' => $this->input->get('Dienthoai'),
				'Email' => $this->input->get('Email'),
			);
		 $this->Giaovien_model->save($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'Tengiaovien' => $this->input->post('Tengiaovien'),
				'Mahocvi' => $this->input->post('Mahocvi'),
				'Gioitinh' => $this->input->post('Gioitinh'),
				'Ngaysinh' => $this->input->post('Ngaysinh'),
				'Diachi' => $this->input->post('Diachi'),
				'Dienthoai' => $this->input->post('Dienthoai'),
				'Email' => $this->input->post('Email'),
			);
		$this->Giaovien_model->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_list()
	{
		$giaovien = $this->Giaovien_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($giaovien as $gv) {
			$no++;
			$row = array();
			//$row[] = $gv->Magiaovien;
			$row[] = $gv->Tengiaovien;
			$row[] = $gv->Mahocvi;
			$row[] = $gv->Gioitinh;
			$row[] = $gv->Ngaysinh;
			$row[] = $gv->Diachi;
			$row[] = $gv->Dienthoai;
			$row[] = $gv->Email;
			

			//add html for action
			$row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$gv->Magiaovien."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Hapus" onclick="delete_person('."'".$gv->Magiaovien."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Giaovien_model->count_all(),
						"recordsFiltered" => $this->Giaovien_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);

	}
	public function ajax_edit($id)
	{
		$data = $this->Giaovien_model->get_by_id($id);
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