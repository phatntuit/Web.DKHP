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
		$this->data['monhoc']=$this->Hocphan_model->getmonhoc();
		$this->data['giaovien']=$this->Hocphan_model->getgiaovien();
		$this->data['khoa']=$this->Hocphan_model->getkhoa();
		$this->data['phong']=$this->Hocphan_model->getphong();
		$this->data['hocky']=$this->Hocphan_model->gethocky();
		$this->data['namhoc']=$this->Hocphan_model->getnamhoc();
	}
	public function index()
	{
		
		$this->data['page_title']='Thông tin học phần';
        $this->load->view('template/header',$this->data);
		$this->load->view('hocphan/thongtinhocphan');   
	}
	public function get_new_data(){
		$hocphan=$this->Hocphan_model->gethocphan();
		$tb='';
		$tb.='<table id="tablehocphan" class="table table-bordred table-striped">
						<thead>
							<th>Mã Lớp</th>
							<th>Môn Học</th>
							<th>Khoa</th>
							<th>Giáo Viên</th>
							<th>Phòng</th>
							<th>Năm Học</th>   
							<th>Học Kỳ</th>
							<th>Thứ</th>
							<th>Tiết Học</th>
							<th>Cách Tuần</th>
							<th>Tín Chỉ</th>
							<th>Hình Thức</th>
							<th>Sĩ số</th>
							<th>Ngày bắt đầu</th>
							<th>Ngày kết thúc</th>
							<th>Chỉnh Sửa</th>
							<th>Xóa</th>
						</thead>
						<tbody>';
						foreach ($hocphan as $hp) {
							$tiethoc='';
							for($i=$hp->Tietbatdau;$i<=$hp->Tietketthuc;$i++) $tiethoc.= $i.',';
							$ht='';
							if($hp->Hinhthuc=="LT") $ht.="Lý Thuyết";else $ht.="Thực Hành";
							$tb.='<tr>
								<td>'.$hp->Malop.'</td>
								<td>'.$hp->Tenmonhoc.'</td>
								<td>'.$hp->Tenkhoa.'</td>
								<td>'.$hp->Tengiaovien.'</td>
								<td>'.$hp->Maphong.'</td>
								<td>'.$hp->Tennamhoc.'</td>
								<td>'.$hp->Tenhocky.'</td>
								<td>'.$hp->Thu.'</td>
								<td>'.$tiethoc.'</td>
								<td>'.$hp->Cachtuan.'</td>
								<td>'.$hp->Sotinchi.'</td>
								<td>'.$ht.'</td>
								<td>'.$hp->Sisodukien.'</td>
								<td>'.$hp->Ngaybatdau.'</td>
								<td>'.$hp->Ngayketthuc.'</td>
								<td><p data-placement="top" data-toggle="tooltip" title="Edit"><button class="btn btn-primary btn-xs" data-toggle="modal" onclick="edithocphan('.$hp->Malop.')"><span class="glyphicon glyphicon-pencil"></span></button></p></td>
								<td><p data-placement="top" data-toggle="tooltip" title="Delete"><button class="btn btn-danger btn-xs" data-toggle="modal" onclick="deletehocphan('.$hp->Malop.')" ><span class="glyphicon glyphicon-trash"></span></button></p></td>
								</tr>';
						}
						$tb.='</tbody></table>';
						echo $tb;

	}
	public function addhocphan()
	{
		$this->_validate();
		$data=array(
			'Malop'=>$this->input->get('malop'),
			'Mamonhoc'=>$this->input->get('monhoc'),
			'Makhoa'=>$this->input->get('khoa'),
			'Magiaovien'=>$this->input->get('giaovien'),
			'Maphong'=>$this->input->get('phong'),
			'MaNamhoc'=>$this->input->get('namhoc'),
			'MaHocky'=>$this->input->get('hocky'),
			'Tietbatdau'=>$this->input->get('tietbatdau'),
			'Tietketthuc'=>$this->input->get('tietketthuc'),
			'Thu'=>$this->input->get('thu'),
			'Cachtuan'=>$this->input->get('cachtuan'),
			'Hinhthuc'=>$this->input->get('hinhthuc'),
			'Sisodukien'=>$this->input->get('siso'),
			'Ngaybatdau'=>$this->input->get('ngaybatdau'),
			'Ngayketthuc'=>$this->input->get('ngayketthuc'),
			);
		$this->Hocphan_model->addhocphan($data);
		echo json_encode(array("status" => TRUE));
	}
	private function _validate()
	{
		$now = new DateTime("now", new DateTimeZone('Asia/Ho_Chi_Minh'));
        $now=date("Y-m-d",strtotime($now->format('Y-m-d')));
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		if($this->input->get('monhoc')=='')
		{
			$data['inputerror'][] = 'monhoc';
			$data['error_string'][] = 'Vui lòng chọn môn học';
			$data['status'] = FALSE;
		}
		if($this->input->get('khoa')=='')
		{
			$data['inputerror'][] = 'khoa';
			$data['error_string'][] = 'Vui lòng chọn khoa';
			$data['status'] = FALSE;
		}
		if($this->input->get('giaovien')=='')
		{
			$data['inputerror'][] = 'giaovien';
			$data['error_string'][] = 'Vui lòng chọn giáo viên';
			$data['status'] = FALSE;
		}
		if($this->input->get('phong')=='')
		{
			$data['inputerror'][] = 'phong';
			$data['error_string'][] = 'Vui lòng chọn phòng';
			$data['status'] = FALSE;
		}
		if($this->input->get('namhoc')=='')
		{
			$data['inputerror'][] = 'namhoc';
			$data['error_string'][] = 'Vui lòng chọn năm học';
			$data['status'] = FALSE;
		}
		if($this->input->get('hocky')=='')
		{
			$data['inputerror'][] = 'hocky';
			$data['error_string'][] = 'Vui lòng chọn học kỳ';
			$data['status'] = FALSE;
		}
		if($this->input->get('tietbatdau')=='')
		{
			$data['inputerror'][] = 'tietbatdau';
			$data['error_string'][] = 'Vui lòng chọn tiết bắt đầu';
			$data['status'] = FALSE;
		}
		if($this->input->get('tietketthuc')=='')
		{
			$data['inputerror'][] = 'tietketthuc';
			$data['error_string'][] = 'Vui lòng chọn tiết kết thúc';
			$data['status'] = FALSE;
		}
		if($this->input->get('thu')=='')
		{
			$data['inputerror'][] = 'thu';
			$data['error_string'][] = 'Vui lòng chọn thứ';
			$data['status'] = FALSE;
		}
		if($this->input->get('cachtuan')=='')
		{
			$data['inputerror'][] = 'cachtuan';
			$data['error_string'][] = 'Vui lòng chọn cách tuần';
			$data['status'] = FALSE;
		}
		if($this->input->get('hinhthuc')=='')
		{
			$data['inputerror'][] = 'hinhthuc';
			$data['error_string'][] = 'Vui lòng chọn hình thức';
			$data['status'] = FALSE;
		}
		if($this->input->get('siso')=='')
		{
			$data['inputerror'][] = 'siso';
			$data['error_string'][] = 'Vui lòng điền sĩ số';
			$data['status'] = FALSE;
		}
		if($this->input->get('ngaybatdau')=='')
		{
			$data['inputerror'][] = 'ngaybatdau';
			$data['error_string'][] = 'Vui lòng điền ngày bắt đầu';
			$data['status'] = FALSE;
		}
		if($this->input->get('ngayketthuc')=='')
		{
			$data['inputerror'][] = 'ngayketthuc';
			$data['error_string'][] = 'Vui lòng điền ngày kết thúc';
			$data['status'] = FALSE;
		}
		if($this->input->get('tietketthuc')<$this->input->get('tietbatdau'))
		{
			$data['inputerror'][] = 'tietketthuc';
			$data['error_string'][] = 'Tiết kết thúc phải lớn hơn tiết bắt đầu';
			$data['status'] = FALSE;
		}
		if($this->input->get('ngayketthuc')<$this->input->get('ngaybatdau'))
		{
			$data['inputerror'][] = 'ngayketthuc';
			$data['error_string'][] = 'Ngày kết thúc phải lớn hơn ngày bắt đầu';
			$data['status'] = FALSE;
		}
		if($this->input->get('ngaybatdau')<$now)
		{
			$data['inputerror'][] = 'ngaybatdau';
			$data['error_string'][] = 'Ngày bắt đầu không được nằm trong quá khứ';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
}
?>