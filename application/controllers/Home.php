<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->data['page_title']='Trang chủ  | Hệ thống đăng ký học phần';
		$this->load->view('template/header',$this->data);
		$this->load->view('home');
	}
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('username') == '')
		{
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'user name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('pwd') == '')
		{
			$data['inputerror'][] = 'Password';
			$data['error_string'][] = 'Password is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	public function Login()
	{
		$this->_validate();
		$data = array(
			'username' => $this->input->post('username'),
			'pwd'=>$this->input->post('pwd')
			);
		//Either you can print value or you can send value to database
		// echo json_encode($data);
	}
}
