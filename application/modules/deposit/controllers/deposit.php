<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Deposit extends MX_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://digitrainee.dev/index.php/home
	 *	- or -
	 * 		http://digitrainee.dev/index.php/home/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://digitrainee.dev/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
		$this->load->module('user');
		$this->load->module('header');
	}

	public function index() {
		$header = $this->header->small_header();
		$data['header'] = $header;

		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;

			$this->load->view('deposit_view', $data);
		} else {
			$this->load->view('deposit_view', $data);
		}
	}
}
