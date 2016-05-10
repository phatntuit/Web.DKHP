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
		//$this->_validate();
		$data = array(
			'id' => $this->input->post('id'),
			'pwd'=>$this->input->post('pwd')
			);
		// print_r($data);
		$this->load->model('User_model');
		$this->User_model->check_login($data['id'],$data['pwd']);
		$check=$this->User_model->check_login($data['id'],$data['pwd']);
		if ($check==true) {
			#login thanh cong
			$user= $this->User_model->get_user($data['id']);
			//set session data
			$_SESSION['id']      = $user[0]['Manguoidung'];
			$_SESSION['quyen']     =$user[0]['Quyen'];
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
}