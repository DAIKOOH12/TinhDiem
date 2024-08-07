<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Mdsde extends CI_Model{
    public function __construct(){
        parent::__construct();
    }
    public function getDSDe(){
        $this->db->select("*");
        $this->db->from("tbldapan");
        $this->db->join("tblde","tbldapan.fk_idde=tblde.idDe","inner");
        $this->db->join("tblmon","tblde.fk_idMon=tblmon.idMon","inner");
        return $this->db->get()->result_array();
    }
    public function getDSDeTheoMon($id){
        $this->db->select("*");
        $this->db->from("tbldapan");
        $this->db->join("tblde","tbldapan.fk_idde=tblde.idDe","inner");
        $this->db->join("tblmon","tblde.fk_idMon=tblmon.idMon","inner");
        $this->db->where("tblde.fk_idMon",$id);
        return $this->db->get()->result_array();
    }
    public function changeStateDe($id,$state){
        $this->db->where('idDe', $id);
        $this->db->update('tblde',$state);
        return $this->db->last_query();
    }
}