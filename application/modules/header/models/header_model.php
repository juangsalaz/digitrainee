<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Header_model extends CI_Model {
	function __construct() {
        parent::__construct();
    }

    public function getUserDataByEmail($email) {
        $query = $this->db->query("SELECT * FROM digi_users, digi_user_profile WHERE digi_users.uuid = digi_user_profile.uuid AND digi_users.email = '".$email."'");
        return $query;
    }
}