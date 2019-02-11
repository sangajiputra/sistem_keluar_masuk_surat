<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengguna extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('model_pengguna');
        $this->load->model('model_surat_masuk');
        if(!$this->session->userdata('adminid'))
            redirect('auth');
	}
	
	public function index()
	{
		$datacontent['page']	='pengguna';
		$datacontent['data'] 	= $this->model_pengguna->select();
        $datacontent['hitung']  = $this->model_surat_masuk->pending($this->session->userdata('adminid'));
		$this->load->view('pengguna/index', $datacontent);
	}

    function add()
    {
        $datacontent['page']   = 'pengguna';
        $this->load->view('pengguna/add',$datacontent);
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
            'nama_pengguna'         => $this->input->post('nama'),
            'password'              => $password,
            'email'                 => $this->input->post('email'),
            'des_pengguna'          => $this->input->post('des_admin'),
            'foto_pengguna'         => $image_name
        );
        
        $this->model_pengguna->add($data);
        redirect('pengguna');  
    }

    function cpassword($id)
    {
        $datacontent['page']   = 'pengguna';
        $datacontent['data']   = $this->model_pengguna->get_pengguna($id);
        $this->load->view('pengguna/cpassword',$datacontent);
    }   
    
    
    function actioncpassword()
    {
    
        $password = md5($this->input->post('password'));
        $data = array(
            'password'          => $password
        );          
        $this->model_pengguna->update($this->input->post('id'),$data);
        redirect('pengguna'); 
    }

    function edit($id)
    {
        $datacontent['page']        = 'pengguna';
        $datacontent['data']        = $this->model_pengguna->get_pengguna($id);
        $this->load->view('pengguna/edit',$datacontent);
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
            'nama_pengguna'         => $this->input->post('nama'),
            'email'                 => $this->input->post('email'),
            'des_pengguna'          => $this->input->post('des_admin'),
            'foto_pengguna'         => $image_name
        );
        $this->model_pengguna->update($this->input->post('id'),$data);
        redirect('pengguna'); 
    }

    function actiondelete($id)
    {
        $this->model_pengguna->delete($id);
        redirect('pengguna');  
    }

    function toexcel(){
        header('Content-type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename="Data-pengguna-'.date("Y-m-d/H-i-s").'.xls"');
        $data["rows"] = $this->model_pengguna->select();
        $this->load->view("gen_cnf/pengguna/xls", $data);
    }
}
