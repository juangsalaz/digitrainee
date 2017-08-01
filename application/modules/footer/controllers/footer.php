<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('user');
	}

	public function index() {
		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;
			return $this->load->view('footer_view', $data, true);
		} else {
			return $this->load->view('footer_view', "", true);
		}
	}
}
