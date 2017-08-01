<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller {

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
		$this->load->model('user_model');
		$this->load->module('header');
		$this->load->module('footer');
	}

	public function login() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$check_user = $this->user_model->checkUser($email, $password);
		
		
		if ($check_user->num_rows == 1) {
			$data_user = $check_user->result();
			print_r($data_user);
			$dataSession = array(
				'user_id' => $data_user[0]->uuid,
				'name' => $data_user[0]->username,
				'email' => $email,
			);

			$this->session->set_userdata($dataSession);
			// echo $this->session->userdata('name');
			// echo $this->session->userdata('user_id');
			// exit();
			header('location:'.base_url().'home');
		} else {
			header('location:'.base_url().'login');
		}
	}

	public function ajaxLogin() {
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$check_user = $this->user_model->checkUser($email, $password);
		
		if ($check_user->num_rows == 1) {
			$data_user = $check_user->result();
			
			$dataSession = array(
				'user_id' => $data_user[0]->uuid,
				'name' => $data_user[0]->username,
				'email' => $email,
			);

			$this->session->set_userdata($dataSession);
			$result = TRUE;
			echo json_encode($result);
		} else {
			$result = FALSE;
			echo json_encode($result);
		}
	}

	public function addNewsletter()
	{
		$email = $this->input->post('email');

		if ($this->user_model->isNewsletterExist($email)) {
			echo json_encode(false);
		} else {
			$this->user_model->isNewsletterExist($email);
			echo json_encode(true);
		}
	}

	public function signup() {
		$full_name = $this->input->post('name');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$today_date = new DateTime();
		$company = $this->input->post('company');

		if ($this->isAlready($email)) {
			//give notification if user is already signup
			header('location:'.base_url().'home');
		} else {
			$this->load->library('email');
	
			$config['mailtype'] = 'html';
			$config['wordwrap'] = TRUE;
		
			$this->email->initialize($config);
			
			$this->email->from('admin@digitrainee.com', 'Digitrainee Admin');
			$this->email->to($email); 
			// if($cc) { $this->email->cc($cc);}
			// if($bcc) { $this->email->bcc($bcc);}
		
			$this->email->subject('Congratulation! You are ready to learn now');
			$this->email->message('
				<p>Hello '.$full_name.', Thanks for your registration</p>
				<p>You have entered '.$email.' as a contact email address for your DigiTrainee user account.</p>
				<p></p>
				<p>Thank you</p>
				<p>DigiTrainee Admin</p>
				<p>admin@digitrainee</p>
			');
			//$this->email->attach($name);	
			
			if ($this->email->send()) {
				$save = $this->user_model->save_user($full_name, $mobile, $email, $password, $today_date->format('Y-m-d H:i:s'), $company);

				$dataSession = array(
					'name' => $full_name, 
					'email' => $email,
				);

				$this->session->set_userdata($dataSession);
				header('location:'.base_url().'home');
			} else {
				header('location:'.base_url().'register');
			}
		}
	}

	public function presignup() {
		$full_name = $this->input->post('name');
		$mobile = $this->input->post('mobile');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$today_date = new DateTime();
		$email_hash = md5($email);
		$referrer_email = $this->input->post('referrer');

		if ($this->isAlready($email)) {
			//give notification if user is already signup
			$user = array("status_signup" => 0, "email"=>$email);
			echo json_encode($user);
		} else {
			$save = $this->user_model->save_user($full_name, $mobile, $email, $email_hash, $password, $today_date->format('Y-m-d H:i:s'));
			
			if ($save == 1) {
				if ($referrer_email != "") {
					$get_target_referral = $this->user_model->get_target_referral($email)->result();
					$id_target_referral = $get_target_referral[0]->uuid;

					$get_referrer = $this->user_model->get_referrer($referrer_email)->result();
					$id_referrer = $get_referrer[0]->uuid;

					$saveReferral = $this->user_model->save_referral($id_referrer, $id_target_referral);
				}
				$referral_code = md5($email);
				$user = $user = array("status_signup" => 1, "", "nama"=>$full_name, "email"=>$email, "referral_code"=>$referral_code);
				echo json_encode($user);
			} else {
				header('location:'.base_url().'home');
			}
		}
	}

	public function isUser($name, $email) {
		if (!empty($email) AND !empty($name)) {
			$is_user = $this->user_model->isUser($name, $email);

			if ($is_user->num_rows == 1) {
				return TRUE;
			} else {
				$this->session->sess_destroy();
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function isAlready($email) {
		$is_already = $this->user_model->isAlready($email);

		if ($is_already->num_rows == 1) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		header('location:'.base_url().'home');
	}

	public function forgetPassword() {
		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;

		$this->load->view('forget_password_view', $data);
	}

	public function forgetPasswordProcess() {
		$email = $this->input->post('email');

		$check_email = $this->user_model->checkEmail($email)->result();
		$full_name = $check_email[0]->username;

		$email_hash = md5($email);

		if (!empty($check_email)) {
			$this->load->library('email');
		
			$config['mailtype'] = 'html';
			$config['wordwrap'] = TRUE;
		
			$this->email->initialize($config);
			
			$this->email->from('admin@digitrainee.com', 'Digitrainee Admin');
			$this->email->to($email); 
			// if($cc) { $this->email->cc($cc);}
			// if($bcc) { $this->email->bcc($bcc);}
		
			$this->email->subject('Forgotten password request');
			$this->email->message('
				<h3>Hallo '.$full_name.',</h3>
				<p>Digitrainee recently received a request for a forgotten password</p>
				<p>To change your Digitrainee password, please click on this <a href="<?php echo base_url();?>user/resetPassword/<?php echo $email_hash;?>">link</a>.</p>
				<p>If you did not request this change, you do not need to do anything.</p>
				<p></p>
				<p>Thank you</p>
				<p>DigiTrainee Admin</p>
				<p>admin@digitrainee</p>
			');
			//$this->email->attach($name);	
			
			$this->email->send();
			header('location:'.base_url().'login');
		} else {
			header('location:'.base_url().'user/forgetPassword');
		}
	}

	public function resetPassword() {
		$email_hash = $this->uri->segment(3);
		$data['email_hash'] = $email_hash;

		$header = $this->header->nav_header();
		$footer = $this->footer->index();
		$data['header'] = $header;
		$data['footer'] = $footer;

		$this->load->view('reset_password_view', $data);
	}

	public function resetPasswordProcess() {
		$email_hash = $this->input->post('email_hash');
		$email = md5($email_hash);

		$password = $this->input->post('password');
		$password2 = $this->input->post('password2');

		if ($password == $password2) {
			$reset_password = $this->user_model->resetPassword($password, $email);

			if ($reset_password) {
				header('location:'.base_url().'login');
			}
		} else {
			//password tidak sama
		}
	}
}
