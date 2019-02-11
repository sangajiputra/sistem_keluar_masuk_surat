<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat_keluar extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_surat_keluar');
        $this->load->model('model_surat_masuk');
        if(!$this->session->userdata('adminid'))
            redirect('auth');
	}
	
	public function index()
	{
		$datacontent['page']	='surat_keluar';
		$datacontent['data'] 	= $this->model_surat_keluar->select($this->session->userdata('adminid'));
        $datacontent['hitung']  = $this->model_surat_masuk->pending($this->session->userdata('adminid'));
		$this->load->view('surat_keluar/index', $datacontent);
	}

    function add()
    {
        $datacontent['page']   = 'surat_keluar';
        $this->load->view('surat_keluar/add',$datacontent);
    }
    
    function actionadd()
    {
    if(!empty($_FILES['foto_admin']['name'])){
                $image_name =  str_replace(' ','_',date('Ymdhis').$_FILES['foto_admin']['name']);
                $config['upload_path']      = $this->config->item('upload_image').'admin';
                $config['allowed_types']    = 'gif|jpg|png';
                $config['file_name']        = $image_name;
                $this->upload->initialize($config);
                $this->upload->do_upload('foto_admin');
            }else{
                $image_name = '';
            }
        
        $password = md5($this->input->post('password'));
        $data = array(
            'nama_surat_keluar'         => $this->input->post('nama'),
            'password'              => $password,
            'email'                 => $this->input->post('email'),
            'des_surat_keluar'          => $this->input->post('des_admin'),
            'foto_surat_keluar'         => $image_name
        );
        
        $this->model_surat_keluar->add($data);
        redirect('surat_keluar');  
    }

    function cpassword($id)
    {
        $datacontent['page']   = 'surat_keluar';
        $datacontent['data']   = $this->model_surat_keluar->get_surat_keluar($id);
        $this->load->view('surat_keluar/cpassword',$datacontent);
    }   
    
    
    function actioncpassword()
    {
    
        $password = md5($this->input->post('password'));
        $data = array(
            'password'          => $password
        );          
        $this->model_surat_keluar->update($this->input->post('id'),$data);
        redirect('surat_keluar'); 
    }

    function edit($id)
    {
        $datacontent['page']        = 'surat_keluar';
        $datacontent['data']        = $this->model_surat_keluar->get_surat_keluar($id);
        $this->load->view('surat_keluar/edit',$datacontent);
    }   
    
    function actionedit()
    {
    if(!empty($_FILES['foto_admin']['name'])){
                $image_name =  str_replace(' ','_',date('Ymdhis').$_FILES['foto_admin']['name']);
                $config['upload_path']      = $this->config->item('upload_image').'admin';
                $config['allowed_types']    = 'gif|jpg|png';
                $config['file_name']        = $image_name;
                $this->upload->initialize($config);
                $this->upload->do_upload('foto_admin');
            }else{
                $image_name = $this->input->post('imagex');
            }
        $data = array(
            'nama_surat_keluar'         => $this->input->post('nama'),
            'email'                 => $this->input->post('email'),
            'des_surat_keluar'          => $this->input->post('des_admin'),
            'foto_surat_keluar'         => $image_name
        );
        $this->model_surat_keluar->update($this->input->post('id'),$data);
        redirect('surat_keluar'); 
    }

    function actiondelete($id)
    {
        $this->model_surat_keluar->delete($id);
        redirect('surat_keluar');  
    }

    function toexcel(){
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data-surat_keluar-'.date("Y-m-d/H-i-s").'.xls"');
        $data["rows"] = $this->model_surat_keluar->select();
        $this->load->view("gen_cnf/surat_keluar/xls", $data);
    }
}
