<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends MX_Controller {
	var $gallery_path;
    var $gallery_path_url;
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
		$this->load->module('course');
		$this->load->module('header');
		$this->load->module('footer');
		
		$this->load->model('profile_model');

		$this->gallery_path = realpath(APPPATH . '../upload/images');
        $this->gallery_path_url = base_url() . 'upload/images/';
        $this->load->helper('form');

		$this->load->model('course_model');
		$this->load->model('user_model');
	}

	public function index() {
		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');
		$profile_header = $this->header->profile_feature($name, $email);
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['profile_header'] = $profile_header;
		$data['footer'] = $footer;

		$get_user_data = $this->profile_model->getUserDataByEmail($email)->result();
		$data['data_user'] = $get_user_data;

		$this->session->set_userdata('user_id', $get_user_data[0]->uuid);

		$companyList = $this->profile_model->findActiveCompany()->result();
		$data['companyList'] = $companyList;		
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;
			// echo $this->session->userdata('user_id');
			// exit();
			$this->load->view('profile_view', $data);
		} else {
			header('location:'.base_url());
		}
	}

	public function user() {
		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');
		$user_login_id = $this->session->userdata('user_id');
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;

		$user_id = $this->uri->segment(3);
		$get_user_by_id = $this->profile_model->getUserById($user_id)->result();
		$data['profile'] = $get_user_by_id;
		$user_name = $get_user_by_id[0]->username;
		$user_email = $get_user_by_id[0]->email;

		$profile_header = $this->header->profile_feature($user_name, $user_email);
		$data['profile_header'] = $profile_header;
		
		if ($this->user->isUser($name, $email)) {
			if ($user_id == $user_login_id) {
				$this->load->view('profile_view', $data);
			} else {
				$this->load->view('guest_profile_view', $data);	
			}
		} else {
			$this->load->view('guest_profile_view', $data);
		}
	}

	public function learning() {
		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');
		$user_id = $this->session->userdata('user_id');

		$profile_header = $this->header->profile_feature($name, $email);
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['profile_header'] = $profile_header;
		$data['footer'] = $footer;

		$get_learning_course = $this->profile_model->getLearningCourse($user_id)->result();
		$data['learning_course'] = $get_learning_course;

		for ($i=0; $i<count($get_learning_course); $i++) {
			$get_added_course_user = $this->profile_model->getAddedCourseUser($get_learning_course[$i]->course_id)->result();
			$array_user_added[] = array('course_id'=>$get_learning_course[$i]->course_id, 'user_added_name'=>$get_added_course_user[0]->username, 'user_added_picture'=>$get_added_course_user[0]->picture);
		}

		if (!empty($array_user_added)) {
			$data['data_added_users'] = $array_user_added;
		}

		foreach ($get_learning_course as $learning_course) {
			$count_all_unit = $this->course_model->countAllUnit($learning_course->course_id, $user_id)->result_array();
			$all_unit = $count_all_unit[0]['total_unit'];

			$count_marked_unit = $this->course_model->countMarkedUnit($learning_course->course_id, $user_id)->result_array();
			$marked_unit = $count_marked_unit[0]['total_marked_unit'];
			
			$learn_progress = ($marked_unit / $all_unit) * 100;
			$arrayProgress[] = array("course_id"=>$learning_course->course_id, "progress"=>round($learn_progress));
		}
		if (!empty($arrayProgress)) {
			$data['learn_progress'] = $arrayProgress;
		}

		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;

			$this->load->view('learning_profile_view', $data);
		} else {
			header('location:'.base_url());
		}
	}


	public function teaching() {
		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');

		$profile_header = $this->header->profile_feature($name, $email);
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['profile_header'] = $profile_header;
		$data['footer'] = $footer;
		
		if ($this->user->isUser($name, $email)) {
			$data['name'] = $name;
			$data['email'] = $email;
			$userId = $this->user_model->getIdByEmail($email);
			$courses = $this->course_model->teachingList($userId);
			$data['courses'] = $courses->result_array();

			$get_courses = $this->course_model->getCourses()->result();

			if (!empty($get_courses)) {
				for ($i=0; $i<count($get_courses); $i++) {
					$count_course_member = $this->course_model->getUsersCourse($get_courses[$i]->course_id)->result();
					$array_member[] = array("course_id"=>$get_courses[$i]->course_id, "course_member"=>count($count_course_member));
				}
				$data['array_member'] = $array_member;
			}

			$this->load->view('teaching_profile_view', $data);
		} else {
			header('location:'.base_url().'index.php/home');
		}
	}

	public function saveProfile() {
		$name = $this->session->userdata('name');
		$email = $this->session->userdata('email');
		$user_id = $this->session->userdata('user_id');

		//$email = $this->input->post('email');
		$company = $this->input->post('company');
		$current_password = $this->input->post('current_password');
		$new_password = $this->input->post('new_password');
		$confirm_password = $this->input->post('confirm_password');
		$user_about = $this->input->post('user_about');

		$config = array(
	                'allowed_types' => 'jpg|jpeg|gif|png',
	                'upload_path' => $this->gallery_path,
	                'max_size' => 2000
	            );

		$this->load->library('upload', $config);
    	$this->upload->do_upload();
        $upload_data = $this->upload->data();
        $file_name = $upload_data['file_name'];

		if ($this->user->isUser($name, $email)) {
			if ($new_password != "" and $confirm_password != "") {
				$save_about = $this->profile_model->saveAboutUser($user_about, $user_id);
				if ($new_password == $confirm_password) {
					$cek_current_password = $this->profile_model->cekCurrentPassword($user_id, $current_password);

					if ($cek_current_password->num_rows == 1) {
						if ($file_name != "") {
							// $this->upload->do_upload();
							$update_picture = $this->profile_model->updatePicture($file_name, $user_id);
							$this->session->set_flashdata('success_image_alert', 'Profile picture is uploaded');
						}
						$update_profile = $this->profile_model->updateProfile($user_id, $current_password, $new_password, $company);
						$this->session->set_flashdata('success_alert', 'Change password is success');
						header('location:'.base_url().'profile');
					} else {
						if ($file_name != "") {
							// $this->upload->do_upload();
							$update_picture = $this->profile_model->updatePicture($file_name, $user_id);
							$this->session->set_flashdata('success_image_alert', 'Profile picture is uploaded');
						}
						$this->session->set_flashdata('error_alert', 'Current password is incorrect');
						header('location:'.base_url().'profile');
					}
				} else {
					if ($file_name != "") {
						// $this->upload->do_upload();
						$update_picture = $this->profile_model->updatePicture($file_name, $user_id);
						$this->session->set_flashdata('success_image_alert', 'Profile picture is uploaded');
					}
					$this->session->set_flashdata('error_alert', 'New password is incorrect');
					header('location:'.base_url().'profile');
				}
			} else {
				$save_about = $this->profile_model->saveAboutUser($user_about, $user_id);
				$this->profile_model->updateUser($user_id, $email, $company);
				if ($file_name != "") {
					// $this->upload->do_upload();
					$update_picture = $this->profile_model->updatePicture($file_name, $user_id);
					$this->session->set_flashdata('success_image_alert', 'Profile picture is uploaded');
				} else {
					$this->session->set_flashdata('success_alert', 'Update Profile is Success');
				}
				header('location:'.base_url().'profile');
			}
		} else {
			header('location:'.base_url());
		}
	}
}
