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
	public function taoma()
	{
		$this->load->model('Sinhvien_model');
		$ma = $this->Sinhvien_model->Taoma();
		return $ma;

	}
	public function index()
	{	
		$this->data['page_title'] = 'Quản lý sinh viên';
		$this->data['header']="Trang quản lý sinh viên";
		// header là chức năng của page
		$this->load->view('sinhvien/sinhvien_view',$this->data);
		
	}
	public function ajax_add()
	{
		$this->_validate();
		if ($this->input->get('Gioitinh')=='1')
			$gioitinh='Nam';
		$gioitinh='Nữ';
		$TEST='13520604';
		$data = array(
				'Mssv' => $this->taoma(),
				'Hoten' => $this->input->get('Tensinhvien'),
				'Manganh' => $this->input->get('Manganh'),
				'Gioitinh' => $gioitinh,
				'Ngaysinh' => $this->input->get('Ngaysinh'),
				'Quequan' => $this->input->get('Quequan'),
				'Makhoahoc' => $this->input->get('Makhoahoc'),
				'Manguoidung'=> $TEST
			);
		 $this->Sinhvien_model->add($data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Sinhvien_model->get_by_id($id);
		echo json_encode($data);
	}
	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'Mssv' => $this->taoma(),
				'Tensinhvien' => $this->input->get('Tensinhvien'),
				'Manganh' => $this->input->get('Manganh'),
				'Gioitinh' => $this->input->get('Gioitinh'),
				'Ngaysinh' => $this->input->get('Ngaysinh'),
				'Quequan' => $this->input->get('Quequan'),
				'Makhoahoc' => $this->input->get('Makhoahoc'),
			);
		$this->Sinhvien_model->update(array('Mssv' => $this->input->get('Mssv')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		$this->Sinhvien_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		$date = $this->input->get('Ngaysinh');
		$year = substr("$date",0,3);

		if($this->input->get('Tensinhvien') == '')
		{
			$data['inputerror'][] = 'Tensinhvien';
			$data['error_string'][] = '*Vui lòng nhập tên';
			$data['status'] = FALSE;
		}

		if($this->input->get('Makhoahoc') == '-1')
		{
			$data['inputerror'][] = 'Makhoahoc';
			$data['error_string'][] = '*Vui lòng chọn khóa học';
			$data['status'] = FALSE;
		}

		if($this->input->get('Gioitinh') == '-1')
		{
			$data['inputerror'][] = 'Gioitinh';
			$data['error_string'][] = '*Vui lòng chọn giới tính';
			$data['status'] = FALSE;
		}
		if($this->input->get('Manganh') == '-1')
		{
			$data['inputerror'][] = 'Manganh';
			$data['error_string'][] = '*Vui lòng chọn ngành học';
			$data['status'] = FALSE;
		}

		if($this->input->get('Ngaysinh') == '')
		{
			$data['inputerror'][] = 'Ngaysinh';
			$data['error_string'][] = '*Vui lòng nhập ngày sinh';
			$data['status'] = FALSE;
		}
		else if(year('Y')-$year<18)
		{
			$data['inputerror'][] = 'Ngaysinh';
			$data['error_string'][] = '*Ngày sinh không hợp lệ';
			$data['status'] = FALSE;
		}


		if($this->input->get('Quequan') == '')
		{
			$data['inputerror'][] = 'Quequan';
			$data['error_string'][] = '*Vui lòng nhập quê quán';
			$data['status'] = FALSE;
		}

		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	public function Get_new_data()
	{
		$sinhvien = $this->Sinhvien_model->Get_sv();
		$tb='';
		$tb.='<table class="table table-hover table-responsive table-striped">
					<thead>
						<tr>
							<th>Mã số sinh viên</th>
							<th>Họ tên</th>
							<th>Giới tính</th>
							<th>Ngày sinh</th>
							<th>Quê quán</th>
							<th>Ngành</th>
							<th>Khóa</th>
							<th>Chức năng</th>
						</tr>
					</thead>
					<tbody>';
                   foreach($sinhvien as $sv){
                   		$edit="edit_sinhvien('".$sv->Mssv."')";
						$delete="delete_sinhvien('".$sv->Mssv."')";
                   		$tb.='<tr>
                   		 <td>'.$sv->Mssv.'</td>
        				<td>'.$sv->Hoten.'</td>
        				<td>'.$sv->Gioitinh.'</td>
        				<td>'.$sv->Ngaysinh.'</td>
       			 		<td>'.$sv->Quequan.'</td>
        				<td>'.$sv->Tennganh.'</td>
        				<td>'.$sv->Makhoahoc.'</td>
        				<td>
        					<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Sửa" onclick="$edit"><i class="glyphicon glyphicon-pencil"></i>Sửa
							</a>
							<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Xóa" onclick="$delete">
								<i class="glyphicon glyphicon-trash"></i>Xóa
							</a>
        				</td>';

                   }
        $tb.='</tbody></table>';
		echo $tb;
	}
}