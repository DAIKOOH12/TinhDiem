<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Cdsde extends CI_Controller{
    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->load->view('Vdsde'); 
    }
}