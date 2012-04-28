<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Help extends CI_Controller {

	function __construct() {
		parent::__construct();
		#$this->load->library('tank_auth');
	}

	function index() {
		$data['promo'] = FALSE;
		$data['title'] = 'Help';
		$data['logged_in'] = $this->tank_auth->is_logged_in();
		$this->load->view('page-top', $data);
		$this->load->view('help', $data);
		$this->load->view('page-bottom', $data);
	}
}
