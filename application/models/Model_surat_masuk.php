<?php
class Model_surat_masuk extends CI_Model 
{
	protected $_table = 'surat_masuk';
	function __construct()
	{
		parent::__construct();
	}

	function select($id){
		$this->db->join('dokumen', 'surat_masuk.dokumen_id = dokumen.id_dokumen');
		$this->db->join('pengguna', 'surat_masuk.from = pengguna.id_pengguna');
		$this->db->where('surat_masuk.to', $id);
		$this->db->order_by('id_surat_masuk','desc');
		$query = $this->db->get($this->_table);
		return $query->result_array();
	}

	function pending($id){
		$this->db->where('status', '0');
		$this->db->where('to', $id);
		$query = $this->db->get($this->_table);
		$jumlah = $query->num_rows();
		return $jumlah;
	}

	function add($data)
    {
        $this->db->insert($this->_table, $data);
    }
	
	function get_surat_masuk($adminid)
	{
		$this->db->join('dokumen', 'surat_masuk.dokumen_id = dokumen.id_dokumen');
		$this->db->join('pengguna', 'surat_masuk.from = pengguna.id_pengguna');
		$query   = $this->db->get_where($this->_table, array('id_surat_masuk' => $adminid));
		return $query->row_array();
	}
	
	function update($id, $data)
    {
		$this->db->where('id_surat_masuk', $id);
		$this->db->update($this->_table, $data); 
	}
	
	function delete($data)
	{
		$this->db->delete($this->_table, array('id_surat_masuk' => $data)); 
	}
}
?>
