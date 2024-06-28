<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Cdsmon extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('Mdsmon');
    }
    public function index(){
        // $data['dsmon']=$this->Madmin->getDSMon();
        $this->load->view("Cdsmon");
    }
    public function qlyDsMon(){
        $data['dsmon']=$this->Mdsmon->getDSMon();
        $this->load->view("Vdsmon",$data);
    }
    public function addMon(){
        $data['idMon']=$_POST['mamon'];
        $data['sTenMon']=$_POST['tenmon'];
        $this->Mdsmon->addMon($data);
    }
    public function fixMon(){
        $mamon=$_POST['mamon'];
        $data['sTenMon']=$_POST['tenmon'];
        echo $_POST['tenmon'];
        $msg=$this->Mdsmon->fixMon($mamon,$data);
        echo $msg;
    }
    public function showArr($arr)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}