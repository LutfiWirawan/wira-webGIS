<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class map extends CI_Controller {

	public function construct() {
		parent::__construct();
		$this->load->model('M_map');
		$this->load->model('M_marker');
	}


	public function index()
	{
		$data['peta'] = $this->M_map->all_data();
		$data['marker'] = $this->M_marker->all_data();
		$this->load->view('map_page',$data, FALSE);

	}

}
