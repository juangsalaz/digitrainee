<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Voucher_model extends CI_Model {
	function __construct() {
        parent::__construct();
    }

    public function save($noInv, $email, $nama, $nominal, $jumlah, $total) 
    {
        $sql = "insert into digi_coupons_request set 
                    no_inv = '".$noInv."', 
                    tgl = NOW(), 
                    email = '".$email."', 
                    nama = '".$nama."', 
                    nominal = '".$nominal."', 
                    jumlah = '".$jumlah."', 
                    total = '".$total."', 
                    status = 0";
        $res = $this->db->query($sql);        
        return $res;
    }    

    public function nextInv($prefix)
    {
        $sql = "select max(substr(no_inv, 14)) as no_max from digi_coupons_request where substr(no_inv from 1 for 13) = '".$prefix."'";        
        $res = $this->db->query($sql)->result_array();        

        if (count($res) > 0) {
            return str_pad($res[0]['no_max']+1, 4, "0", STR_PAD_LEFT); 
        } else {
            return '0001';
        }
    }

    public function findByInvoice($noInv)
    {
        $sql = "select * from digi_coupons_request where no_inv = '".$noInv."'";        
        $res = $this->db->query($sql)->result_array();        

        if (count($res) > 0) {
            return $res[0]; 
        } else {
            return array();
        }
    }

    public function confirmPayment($id, $dateConfirm, $accName, $accNumber, $refNumber, $total) 
    {
        $sql = "update digi_coupons_request set 
                    tgl_konfirmasi = '".$dateConfirm."', 
                    nama_rekening = '".$accName."', 
                    norek = '".$accNumber."', 
                    no_referensi = '".$refNumber."', 
                    total_transfer = '".$total."', 
                    status = 1
                    where id = '".$id."'";
        $res = $this->db->query($sql);        
        return $res;
    }
}