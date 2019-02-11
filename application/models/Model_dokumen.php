<?php
class Model_dokumen extends CI_Model 
{
	protected $_table = 'dokumen';
	function __construct()
	{
		parent::__construct();
	}

	function select($id){
		$this->db->join('pengguna', 'dokumen.post_by = pengguna.id_pengguna');
		$this->db->where('post_by', $id);
		$this->db->order_by('id_dokumen','desc');
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}

	function add($data)
    {
        $this->db->insert($this->_table, $data);
    }
	
	function get_dokumen($adminid)
	{
		$query   = $this->db->get_where($this->_table, array('id_dokumen' => $adminid));
		return $query->row_array();
	}
	
	function update($id, $data)
    {
		$this->db->where('id_dokumen', $id);
		$this->db->update($this->_table, $data); 
	}
	
	function delete($data)
	{
		$this->db->delete($this->_table, array('id_dokumen' => $data)); 
	}
}
?>
