<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sinhvien extends  CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
	public function index()
	{	
		$this->load->model('Sinhvien_model');
		$mssv=$this->Sinhvien_model->Taoma();
		echo "$mssv";
	}
}