<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Voucher extends MX_Controller {

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
		$this->load->module('header');
		$this->load->module('footer');
		$this->load->module('landing_page');

		$this->load->model('voucher_model');
	}

	public function index() 
	{
		if ($this->input->post()) {
			$email = $this->input->post('email');
			$name = $this->input->post('name');
			$nominal = $this->input->post('nominal');
			$totalVoucher = $this->input->post('total_voucher');

			$prefix = 'VIR.'.date('y').'.'.date('d').'.'.date('m').'.';
			$noInv = $prefix.$this->voucher_model->nextInv($prefix);

			$this->load->library('email');
	
			$config['mailtype'] = 'html';
			$config['wordwrap'] = TRUE;
		
			$this->email->initialize($config);
			
			$this->email->from('admin@digitrainee.com', 'Digitrainee Admin');
			$this->email->to($email); 
			
			$this->email->subject('DigiTrainee Voucher Request');
			$this->email->message('
				<p>Hello '.$name.', </p>
				<p>You have made a request '.$totalVoucher.' vouchers of Rp. '.number_format($nominal).'.</p>
				<p>Your invoice number is '.$noInv.' with total '.($totalVoucher*$nominal).'</p>
				<p>Please make a payment on account below :</p>
				<p>Permata Bank <br />975527077 a.n PT. EDUTEK GLOBAL SYSTEM <br />KCP CIPUTRA WORLD</p>
				<p><a href="'.base_url().'/voucher/confirm?v='.$noInv.'">Click this link for your payment confirmation</a></p>
				<p></p>
				<p>Thank you</p>
				<p>DigiTrainee Admin</p>
				<p>admin@digitrainee</p>
			');

			if ($this->voucher_model->save($noInv, $email, $name, $nominal, $totalVoucher, ($totalVoucher*$nominal))) {
				$this->session->set_flashdata('success_msg', 'Request voucher success. Please check your email');
			} else {
				$this->session->set_flashdata('error_msg', 'Request voucher failed');
			}

			
			/*
			if ($this->email->send()) {
				$save = $this->voucher_model->save($noInv, $email, $name, $nominal, $totalVoucher, ($totalVoucher*$nominal));

				$this->session->set_flashdata('success_msg', 'Request voucher success. Please check your email');
			} else {
				$this->session->set_flashdata('error_msg', 'Request voucher failed');
			}
			*/
			header('location:'.base_url().'voucher');
		}

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
		} 

		$this->load->view('voucher_request_view', $data);
	}

	public function confirm() 
	{
		if ($this->input->post()) {
			$noInv = $this->input->post('no_inv');
			$dateConfirm = $this->input->post('date_confirm');
			$accName = $this->input->post('acc_name');
			$accNumber = $this->input->post('acc_number');
			$refNumber = $this->input->post('ref_number');
			$total = $this->input->post('total_transfer');

			list($d, $m, $y) = explode('/', $dateConfirm);
			$dateConfirm = $y.'-'.$m.'-'.$d;

			$detail = $this->voucher_model->findByInvoice($noInv);

			$this->load->library('email');
	
			$config['mailtype'] = 'html';
			$config['wordwrap'] = TRUE;
		
			$this->email->initialize($config);
			
			$this->email->from('admin@digitrainee.com', 'Digitrainee Admin');
			$this->email->to($email); 
			
			$this->email->subject('DigiTrainee Voucher Confirm');
			$this->email->message('
				<p>Hello '.$name.', </p>
				<p>Thanks for your payment confirmation. We will process your transaction as soon as possible.</p>
				<p></p>
				<p>DigiTrainee Admin</p>
				<p>admin@digitrainee</p>
			');

			if ($this->voucher_model->confirmPayment($detail['id'], $dateConfirm, $accName, $accNumber, $refNumber, $total)) {
				$this->session->set_flashdata('success_msg', 'Payment confirmation success');
			} else {
				$this->session->set_flashdata('error_msg', 'Payment confirmation failed');
			}

			
			/*
			if ($this->email->send()) {
				$this->voucher_model->confirmPayment($detail['id'], $dateConfirm, $accName, $accNumber, $refNumber, $total);

				$this->session->set_flashdata('success_msg', 'Payment confirmation success');
			} else {
				$this->session->set_flashdata('error_msg', 'Payment confirmation failed');
			}
			*/
			header('location:'.base_url().'voucher/confirm');
		}

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
		} 
		$data['noInv'] = ($this->input->get('v')) ? $this->input->get('v') : '';

		$this->load->view('voucher_payment_confirm_view', $data);
	}
}
