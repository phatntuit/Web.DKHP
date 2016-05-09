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
			'username' => $this->input->post('username'),
			'pwd'=>$this->input->post('pwd')
			);
		$this->load->model('User_model');
		if ($this->User_model->resolve_user_login($username,$pwd)==true) {
			#login thanh cong
			$user=$this->User_model->get_user();
			//set session data
			// set session user datas
			$_SESSION['id']      = $user->Manguoidung;
			$_SESSION['quyen']     =$user->Quyen;
			http_redirect('');
		}

	}
}