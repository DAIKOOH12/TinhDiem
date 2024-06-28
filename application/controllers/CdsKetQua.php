<?php 
 if (!defined('BASEPATH')) exit('No direct script access allowed');
 require FCPATH . 'vendor/autoload.php';

 class CdsKetQua extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('MdsKetQua');
        
    }

    public function loadView() {
        $this->load->view("VdsKetQua");
    }
    
 }
