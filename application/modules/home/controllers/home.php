<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends MX_Controller {

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
		//$this->load->module('course_model');
		$this->load->module('landing_page');
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

		// echo $this->session->userdata('email');
		// exit();
		
		//$get_categories = $this->course_model->getCategories()->result();
		//$data['categories'] = $get_categories;

		//$get_courses = $this->course_model->getCourses()->result();
		//print_r($get_courses);
		//$data['courses'] = $get_courses;

		/*
		if (!empty($get_courses)) {
			for ($i=0; $i<count($get_courses); $i++) {
				$count_course_member = $this->course_model->getUsersCourse($get_courses[$i]->course_id)->result();
				$array_member[] = array("course_id"=>$get_courses[$i]->course_id, "course_member"=>count($count_course_member));
			}
			$data['array_member'] = $array_member;
		}
		*/
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;

			$this->load->view('home_view', $data);
		} else {
			$this->load->view('home_view', $data);
		}
		
	}
}
