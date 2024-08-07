<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class MdsKetQua extends CI_Model {
    public function __construct()
    {
        parent::__construct();
        
    }
    
    public function getDeTheoMon($mamon) {
        $this->db->where('fk_mon', $mamon);
        $this->db->select("sMaDe");
        return $this->db->get("tblde")->result_array();
    }

    public function getThuMuc() {
        $this->db->where("bLoaiThuMuc", 0);
        $this->db->order_by("dThoiGian", "DESC");
        return $this->db->get("tblThuMuc")->result_array();
    }

    public function getTenMonTheoMa($mamon) {
        $this->db->where("idMon", $mamon);
        $this->db->select("sTenMon");
        return $this->db->get("tblMon")->result_array();
    }
}