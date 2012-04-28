<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Missing extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->page_data['logged_in'] = $this->tank_auth->is_logged_in();
		$this->page_data['title'] = '404';
		$this->page_data['promo'] = FALSE;
	}

	function index() {
		$this->load->view('page-top', $this->page_data);
		$this->load->view('missing', $this->page_data);
		$this->load->view('page-bottom', $this->page_data);
	}
}
