<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends  CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{	
		
	}
	public function Login()
	{
		// echo json_encode() nua de chay ajax login
		$data = array(
			'id' => $this->input->post('id'),
			'pwd'=>md5($this->input->post('pwd'))
			);
		// print_r($data);
		$this->load->model('User_model');
		$check=$this->User_model->check_login($data['id'],$data['pwd']);
		$thamso=$this->User_model->Get_thamso();
		mysqli_next_result( $this->db->conn_id );
		if ($check==true) {
			#login thanh cong
			$user= $this->User_model->get_user($data['id']);
			//set session data
			$_SESSION['id']      = $user[0]['Manguoidung'];
			$_SESSION['quyen']     =$user[0]['Quyen'];
			$_SESSION['hocky']     =$thamso[0]['Hocky'];
			$_SESSION['namhoc']     =$thamso[0]['Namhoc'];
			$_SESSION['ngaybatdau']  =$thamso[0]['Ngaybatdaudk'];
			$_SESSION['ngayketthuc']     =$thamso[0]['Ngayketthucdk'];
			//call view
			redirect(site_url(''));
		}
		else
			echo "Error.";

	}
	public function logout()
	{
		# code...
		session_destroy();
		redirect(site_url(''));
	}
	// test area
	public function Login_md5()
	{
		// $id=$this->input->post('id');
		// $pwd=$this->input->post('pwd');
		$id="13520604";
		$pwd=md5("123456");
		// result
		$ck=0;
		$quyen="";
		$error="";
		// print_r($data);
		$this->load->model('User_model');
		$exec=$this->User_model->check_login_md5($id,$pwd);
		foreach ($exec as $key) {
			$ck=$key['ck'];
			$quyen=$key['quyen'];
			$error=$key['error'];
		}
		$data=array('ck' =>$ck,'quyen'=>$quyen,'error'=>$error );
		if ($ck==1)
		{
			$_SESSION['id']      = $id;
			$_SESSION['quyen']     =$quyen;
		}
		echo json_encode($data);
	}
	// end test
}