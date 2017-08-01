<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends MX_Controller {

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
		$this->load->module('footer');
		$this->load->module('landing_page');

		$this->load->model('user_model');
	}

	public function index() {
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;
		$landing_page = $this->landing_page->index();
		$data['landing_page'] = $landing_page;

		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');

		$companyList = $this->user_model->findActiveCompany()->result();
		$data['companyList'] = $companyList;		
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;

			$this->load->view('register_view', $data);
		} else {
			$this->load->view('register_view', $data);
		}
	}
}
