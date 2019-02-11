<?php
class Model_surat_keluar extends CI_Model 
{
	protected $_table = 'surat_keluar';
	function __construct()
	{
		parent::__construct();
	}

	function select($id){
		$this->db->join('dokumen', 'surat_keluar.dokumen_id = dokumen.id_dokumen');
		$this->db->join('pengguna', 'surat_keluar.to = pengguna.id_pengguna');
		$this->db->where('surat_keluar.from', $id);
		$this->db->order_by('id_surat_keluar','desc');
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}

	function add($data)
    {
        $this->db->insert($this->_table, $data);
    }
	
	function get_surat_keluar($adminid)
	{
		$query   = $this->db->get_where($this->_table, array('id_surat_keluar' => $adminid));
		return $query->row_array();
	}
	
	function update($id, $data)
    {
		$this->db->where('id_surat_keluar', $id);
		$this->db->update($this->_table, $data); 
	}
	
	function delete($data)
	{
		$this->db->delete($this->_table, array('id_surat_keluar' => $data)); 
	}
}
?>
