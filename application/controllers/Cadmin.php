<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Cadmin extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Madmin');
    }
    public function index(){
        // $data['dsmon']=$this->Madmin->getDSMon();
        $this->load->view("Vadmin");
    }
    public function qlyDsMon(){
        $data['dsmon']=$this->Madmin->getDSMon();
        $this->load->view("Vadmin",$data);
    }
    public function showArr($arr)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}