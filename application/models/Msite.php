<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Msite extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function insert_data($data)
    {
        $this->db->insert_batch('tbldapan', $data);
    }
    public function get_dsmon()
    {
        return $this->db->get("tblmon")->result_array();
    }
    public function insert_mon($data)
    {
        $this->db->insert("tblmon", $data);
    }
    public function insert_de($data)
    {
        $this->db->insert('tblde',$data);
    }
    public function insert_dapan($data){
        $this->db->insert('tbldapan',$data);
    }
    public function insert_dapan_to_folder($data){
        $this->db->insert("tblthumuc",$data);
    }
    public function showArr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }
}
