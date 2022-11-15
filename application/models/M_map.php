<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_map extends CI_Model {

	
	public function all_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_atribut');
		return $this->db->get()->result();
	}
}