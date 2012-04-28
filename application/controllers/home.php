<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct() {
		parent::__construct();
		#$this->load->library('tank_auth');
	}

	function index() {
		$data['title'] = 'Home inventory listing for insurance purposes';
		$data['logged_in'] = $this->tank_auth->is_logged_in();
		$data['promo'] = $this->load->view('home-promo', $data, TRUE);
		$this->load->view('page-top', $data);
		$this->load->view('home', $data);
		$this->load->view('page-bottom', $data);
	}
}
