<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Mdsmon extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getDSMon()
    {
        return $this->db->get('tblmon')->result_array();
    }
    public function addMon($data)
    {
        $this->db->insert("tblmon", $data);
    }
    public function fixMon($mamon,$data)
    {
        $this->db->where('idMon', $mamon);
        $this->db->update('tblmon',$data);
        return $this->db->last_query();
    }
    public function delmon($id){
        $this->db->where('idMon',$id);
        $this->db->delete('tblmon');
    }
}
