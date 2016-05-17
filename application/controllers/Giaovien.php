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
		$ma = $this->Taoma->Matudong("Magiaovien","giaovien","GV",6);
		return $ma;

	}
	public function ajax_add()
	{
		$this->_validate();
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
		 $this->Giaovien_model->add($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Giaovien_model->get_by_id($id);
		echo json_encode($data);
	}
	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'Tengiaovien' => $this->input->get('Tengiaovien'),
				'Mahocvi' => $this->input->get('Mahocvi'),
				'Gioitinh' => $this->input->get('Gioitinh'),
				'Ngaysinh' => $this->input->get('Ngaysinh'),
				'Diachi' => $this->input->get('Diachi'),
				'Dienthoai' => $this->input->get('Dienthoai'),
				'Email' => $this->input->get('Email'),
			);
		$this->Giaovien_model->update(array('Magiaovien' => $this->input->get('Magiaovien')), $data);
		//$this->Giaovien_model->update($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Giaovien_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->get('Tengiaovien') == '')
		{
			$data['inputerror'][] = 'Tengiaovien';
			$data['error_string'][] = '*Vui lòng nhập tên';
			$data['status'] = FALSE;
		}

		if($this->input->get('Mahocvi') == '')
		{
			$data['inputerror'][] = 'Mahocvi';
			$data['error_string'][] = '*Vui lòng chọn học vị';
			$data['status'] = FALSE;
		}

		if($this->input->get('Gioitinh') == '')
		{
			$data['inputerror'][] = 'Gioitinh';
			$data['error_string'][] = '*Vui lòng chọn giới tính';
			$data['status'] = FALSE;
		}

		if($this->input->get('Ngaysinh') == '')
		{
			$data['inputerror'][] = 'Ngaysinh';
			$data['error_string'][] = '*Vui lòng nhập ngày sinh';
			$data['status'] = FALSE;
		}

		if($this->input->get('Diachi') == '')
		{
			$data['inputerror'][] = 'Diachi';
			$data['error_string'][] = '*Vui lòng nhập địa chỉ';
			$data['status'] = FALSE;
		}

		if($this->input->get('Dienthoai') == '')
		{
			$data['inputerror'][] = 'Dienthoai';
			$data['error_string'][] = '*Vui lòng nhập điện thoại';
			$data['status'] = FALSE;
		}
		if($this->input->get('Email') == '')
		{
			$data['inputerror'][] = 'Email';
			$data['error_string'][] = '*Vui lòng nhập Email';
			$data['status'] = FALSE;
		}
		//if($this->giaovien_view->EmailValidate() ===0)
		//{
		//	$data['inputerror'][] = 'Email';
		//	$data['error_string'][] = '*Vui lòng nhập Email đúng ';
		//	;$data['status'] = FALSE;
		//}
		
		 
		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	public function Get_new_data()
	{
		$giaovien = $this->Giaovien_model->getgiaovien();
		$tb='';
		$tb.='<table id="mytable" class="table table-bordred table-striped">	
                   <thead>
                   <th>Tên giáo viên</th>
                    <th>Giới tính</th>
                     <th>Học vị</th>
                     <th>Ngày sinh</th>
                     <th>Địa chỉ</th>
                      <th>Điện thoại</th>
                      <th>Email</th>
                      <th stle="width:125px;">Action</th>
                   </thead>
                   <tbody>';
                   foreach($giaovien as $gv){
                   		$tb.='<tr>
                   		 <td>'.$gv->Tengiaovien.'</td>
        				<td>'.$gv->Gioitinh.'</td>
        				<td>'.$gv->Tenhocvi.'</td>
        				<td>'.$gv->Ngaysinh.'</td>
       			 		<td>'.$gv->Diachi.'</td>
        				<td>'.$gv->Dienthoai.'</td>
        				<td>'.$gv->Email.'</td>
        <td><a class="btn btn-sm btn-primary" data-toggle="modal"  title="Edit" onclick="edit_giaovien('."'".$gv->Magiaovien."'".')"><i class="glyphicon glyphicon-pencil"></i> Sửa</a></td>
        <td><a class="btn btn-sm btn-danger" title="Hapus" onclick="delete_giaovien('."'".$gv->Magiaovien."'".')"><i class="glyphicon glyphicon-trash"></i> Xóa</a></td>
        <tr>';

                   }
        $tb.='</tbody></table>';
		echo $tb;
	}
}