<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {
	function __construct() {
        parent::__construct();
    }

    public function save_user($full_name, $mobile, $email, $password, $today_date, $company = '') {
        $query = $this->db->query("INSERT INTO digi_users (username, password, email, last_login, date_submitted, date_modified, company_id) VALUES ('".$full_name."', '".$password."', '".$email."', '".$today_date."', '".$today_date."', '".$today_date."', '".$company."')");
        $query2 = $this->db->query("INSERT INTO digi_user_profile (phone) VALUES ('".$mobile."')");
        return $query2;
    }

    public function isUser($name, $email) {
    	$query = $this->db->query("SELECT * FROM digi_users WHERE username = '".$name."' AND email = '".$email."'");
    	return $query;
    }

    public function isAlready($email) {
    	$query = $this->db->query("SELECT * FROM digi_users WHERE email = '".$email."'");
    	return $query;
    }

    public function checkUser($email, $password) {
    	$query = $this->db->query("SELECT * FROM digi_users WHERE email = '".$email."' AND password = '".$password."'");
    	return $query;
    }

    public function get_referrer($referrer_email) {
        $query = $this->db->query("SELECT * FROM digi_users WHERE email_hash = '".$referrer_email."'");
        return $query;
    }

    public function get_target_referral($email) {
        $query = $this->db->query("SELECT * FROM digi_users WHERE email = '".$email."'");
        return $query;
    }

    public function save_referral($id_referrer, $id_target_referral) {
        $query = $this->db->query("INSERT INTO digi_users_referral (id_referrer, id_target_referral) VALUES ('".$id_referrer."', '".$id_target_referral."')");
        return $query;
    }

    public function getIdByEmail($email) {
        $query = $this->db->query("SELECT uuid FROM digi_users WHERE email = '".$email."'");

        if ($query->num_rows() > 0) {
            $res = $query->result_array();
            return $res[0]['uuid'];
        } else {
            return '';
        }
    }

    public function checkEmail($email) {
        $query = $this->db->query("SELECT * FROM digi_users WHERE email = '".$email."'");
        return $query;
    }

    public function resetPassword($password, $email) {
        $query = $this->db->query("UPDATE digi_users SET password = '".$password."' WHERE email = '".$email."'");
        return $query;
    }

    public function findActiveCompany() {
        $query = $this->db->query("SELECT * FROM digi_company WHERE is_enabled = 1");
        return $query;
    }

    public function addNewsletter($email) {
        $query = $this->db->query("INSERT INTO digi_newsletter_email SET email = '".$email."'");
        return $query;
    }

    public function isNewsletterExist($email) {
        $query = $this->db->query("SELECT * FROM digi_newsletter_email WHERE email = '".$email."'");
        return $query->num_rows() > 0 ? true : false;
    }
}