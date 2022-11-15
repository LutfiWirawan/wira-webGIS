<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_marker extends CI_Model {

	
	public function all_data()
	{
		$this->db->select('*');
		$this->db->from('tbl_marker');
		return $this->db->get()->result();
	}
}