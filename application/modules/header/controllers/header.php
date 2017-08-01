<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Header extends MX_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->module('user');
		$this->load->model('header_model');
	}

	public function large_header() {
		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;
			return $this->load->view('large_header', $data, true);
		} else {
			return $this->load->view('large_header', "", true);
		}
	}

	public function small_header() {
		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;
			return $this->load->view('small_header', $data, true);
		} else {
			return $this->load->view('small_header', "", true);
		}
	}

	public function nav_header() {
		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');

		$get_user_data = $this->header_model->getUserDataByEmail($email)->result();
		$data['data_user'] = $get_user_data;
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;
			return $this->load->view('nav_header', $data, true);
		} else {
			return $this->load->view('nav_header', "", true);
		}
	}

	public function profile_feature($name, $email) {
		$data['name'] = $name;

		$get_user_data = $this->header_model->getUserDataByEmail($email)->result();
		$data['data_user'] = $get_user_data;

		return $this->load->view('profile_feature_view', $data, true);
	}
}
