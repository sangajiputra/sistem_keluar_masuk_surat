<?php
class Dashboard extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_surat_masuk');
		$this->load->model('model_surat_keluar');
		$this->load->model('model_dokumen');
		$this->load->model('model_pengguna');
		if(!$this->session->userdata('adminid'))
			redirect('auth');
	}
	
	function index()
	{
		$data['page']		= 'dashboard';
		$data['dokumen'] 	= count($this->model_dokumen->select($this->session->userdata('adminid')));
		$data['keluar'] 	= count($this->model_surat_keluar->select($this->session->userdata('adminid')));
		$data['masuk']		= count($this->model_surat_masuk->select($this->session->userdata('adminid')));
		$data['hitung']  	= $this->model_surat_masuk->pending($this->session->userdata('adminid'));
		$data['pengguna'] 	= count($this->model_pengguna->select());
		$this->load->view('dashboard/index',$data);
	}
		
}
