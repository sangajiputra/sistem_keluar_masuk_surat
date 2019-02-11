<?php
class Contact_us extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('adminid'))
			redirect('auth');
	}
	
	function index()
	{
		$data['page']		= 'contact_us';
		$this->load->view('contacus/index',$data);
	}
		
}
