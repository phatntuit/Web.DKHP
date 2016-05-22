<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DangKy extends CI_Controller {

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
		$this->data['page_title']='Đăng ký  | Hệ thống đăng ký học phần';
		$this->load->view('template/header',$this->data);
		$this->load->view('dangky');
	}
	public function dangkynhanh()
	{
		$dsmh=$this->input->get('edit-dsmh');
		$dsmh=strtoupper($dsmh);
		$data=explode("\n", $dsmh);
		echo json_encode($data);
	}
}
