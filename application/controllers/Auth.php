<?php
class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('model_pengguna');
		//$this->load->model('model_log');
	}
	
	function index()
	{
		$this->load->view('auth/index');
	}
	function masuk()
	{
		//echo md5('admin');
		if(isset($_POST['submit'])){
				$email = $this->input->post('email');
				$password = md5($this->input->post('password'));
				$hasil		= $this->model_pengguna->login($email,$password);
				if ($hasil==1) {
				$userlogin	= $this->model_pengguna->datauser($email,$password);
				$data_session = array(
									'adminname' => $userlogin['nama_pengguna'],
									'adminid'   => $userlogin['id_pengguna'],
									'image'		=> $userlogin['foto_pengguna']
								);
				$this->session->set_userdata($data_session);
				redirect('dashboard');
			}else{
				 $this->session->set_flashdata('alert_error', 'Please correct your email or password.');
				 redirect('auth');
			}
		}
	}
	
	function logout()
	{
		$this->session->set_flashdata('alert_logout', 'You are logout.');
		$user_data = $this->session->userdata();
		foreach ($user_data as $key => $value) {
    	if ($key!='_ci_last_regenerate' && $key != '_ci_vars')
       		$this->session->unset_userdata($key);
		}
		redirect('auth');
	}
		
}