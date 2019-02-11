<?php
class Model_pengguna extends CI_Model 
{
	protected $_table = 'pengguna';
	function __construct()
	{
		parent::__construct();
	}

	function login($email,$password){
		$check = $this->db->get_where($this->_table, array('email'=>$email, 'password'=>$password));
		if($check->num_rows()>0){
			return 1;
		}else{
			return 0;
		}
	}

	function datauser($email,$password)
	{
		$query    = $this->db->get_where($this->_table, array('email'=>$email, 'password'=>$password));
		$result   = $query->row_array();

		return $result;
	}

	function select(){
		$this->db->order_by('id_pengguna','desc');
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}

	function without_me($idm){
		$this->db->where_not_in('id_pengguna', $idm);
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}

	function add($data)
    {
        $this->db->insert($this->_table, $data);
    }
	
	function get_pengguna($adminid)
	{
		$query   = $this->db->get_where($this->_table, array('id_pengguna' => $adminid));
		return $query->row_array();
	}
	
	function update($id, $data)
    {
		$this->db->where('id_pengguna', $id);
		$this->db->update($this->_table, $data); 
	}
	
	function delete($data)
	{
		$this->db->delete($this->_table, array('id_pengguna' => $data)); 
	}
}
?>
