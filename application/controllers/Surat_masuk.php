<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_masuk extends CI_Controller {

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
	
	public function index()
	{
		$datacontent['page']	='surat_masuk';
		$datacontent['data'] 	= $this->model_surat_masuk->select($this->session->userdata('adminid'));
        $datacontent['hitung']  = $this->model_surat_masuk->pending($this->session->userdata('adminid'));
		$this->load->view('surat_masuk/index', $datacontent);
	}

    function detail($id)
    {
        $datacontent['page']        = 'surat_masuk';
        $datacontent['data']        = $this->model_surat_masuk->get_surat_masuk($id);
        $data = array(
            'status'                => '1'
        );
        $this->model_surat_masuk->update($id,$data);
        $this->load->view('surat_masuk/detail',$datacontent);
    }  

    function kirim($id){
        $datacontent['page']        = 'surat_masuk';
        $datacontent['data']        = $this->model_surat_masuk->get_surat_masuk($id);
        $datacontent['user']        = $this->model_pengguna->without_me($this->session->userdata('adminid'));
        $this->load->view('surat_masuk/kirim',$datacontent);
    }

    function action_kirim()
    {
        $data = array(
            'dokumen_id'           => $this->input->post('id'),
            'from'                 => $this->session->userdata('adminid'),
            'to'                   => $this->input->post('to'),
            'send_date'            => date('Y-m-d H-i-s'),
            'status'               => '0',
            'message'              => $this->input->post('message')
        );
        
        $this->model_surat_masuk->add($data);

        $dataa = array(
            'dokumen_id'           => $this->input->post('id'),
            'from'                 => $this->session->userdata('adminid'),
            'to'                   => $this->input->post('to'),
            'send_date'            => date('Y-m-d H-i-s'),
            'message'              => $this->input->post('message')
        );
        
        $this->model_surat_keluar->add($dataa);
        redirect('surat_masuk');
    }

    function actiondelete($id)
    {
        $this->model_surat_masuk->delete($id);
        redirect('surat_masuk');  
    }

    function toexcel(){
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data-surat_masuk-'.date("Y-m-d/H-i-s").'.xls"');
        $data["rows"] = $this->model_surat_masuk->select();
        $this->load->view("gen_cnf/surat_masuk/xls", $data);
    }
}
