<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dokumen extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_dokumen');
        $this->load->model('model_surat_masuk');
        $this->load->model('model_surat_keluar');
        $this->load->model('model_pengguna');
        if(!$this->session->userdata('adminid'))
            redirect('auth');
	}
	
	public function index()
	{
		$datacontent['page']	='dokumen';
		$datacontent['data'] 	= $this->model_dokumen->select($this->session->userdata('adminid'));
        $datacontent['hitung']  = $this->model_surat_masuk->pending($this->session->userdata('adminid'));
		$this->load->view('dokumen/index', $datacontent);
	}

    function add()
    {
        $datacontent['page']   = 'dokumen';
        $this->load->view('dokumen/add',$datacontent);
    }
    
    function actionadd()
    {
    if(!empty($_FILES['file']['name'])){
                $image_name =  str_replace(' ','_',date('Ymdhis').$_FILES['file']['name']);
                $config['upload_path']      = $this->config->item('upload_image').'dokumen';
                $config['allowed_types']    = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|xls|xlsx';
                $config['file_name']        = $image_name;
                $this->upload->initialize($config);
                $this->upload->do_upload('file');
            }else{
                $image_name = '';
            }
        
        $data = array(
            'nama_dokumen'         => $this->input->post('nama_dokumen'),
            'post_by'              => $this->session->userdata('adminid'),
            'create_date'          => date('Y-m-d H-i-s'),
            'dokumen_file'         => $image_name
        );
        
        $this->model_dokumen->add($data);
        redirect('dokumen');  
    }

    function edit($id)
    {
        $datacontent['page']        = 'dokumen';
        $datacontent['data']        = $this->model_dokumen->get_dokumen($id);
        $this->load->view('dokumen/edit',$datacontent);
    }   
    
    function actionedit()
    {
            if(!empty($_FILES['file']['name'])){
                $image_name =  str_replace(' ','_',date('Ymdhis').$_FILES['file']['name']);
                $config['upload_path']      = $this->config->item('upload_image').'dokumen';
                $config['allowed_types']    = 'jpg|jpeg|png|pdf|doc|docx|ppt|pptx|xls|xlsx';
                $config['file_name']        = $image_name;
                $this->upload->initialize($config);
                $this->upload->do_upload('file');
            }else{
                $image_name = $this->input->post('filex');
            }
        $data = array(
            'nama_dokumen'         => $this->input->post('nama_dokumen'),
            'post_by'              => $this->session->userdata('adminid'),
            'dokumen_file'         => $image_name
        );
        $this->model_dokumen->update($this->input->post('id'),$data);
        redirect('dokumen'); 
    }

    function actiondelete($id)
    {
        $this->model_dokumen->delete($id);
        redirect('dokumen');  
    }

    function kirim($id){
        $datacontent['page']        = 'dokumen';
        $datacontent['data']        = $this->model_dokumen->get_dokumen($id);
        $datacontent['user']        = $this->model_pengguna->without_me($this->session->userdata('adminid'));
        $this->load->view('dokumen/kirim',$datacontent);
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
        redirect('dokumen');
    }

    function toexcel(){
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data-dokumen-'.date("Y-m-d/H-i-s").'.xls"');
        $data["rows"] = $this->model_dokumen->select();
        $this->load->view("gen_cnf/dokumen/xls", $data);
    }
}
