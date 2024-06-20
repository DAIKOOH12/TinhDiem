<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caculation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
    }

    public function start_cal()
    {
        shell_exec('php index.php CPhieuTraLoi index');
    }


    public function process_cal() {
        $this->load->library('../controllers/CPhieuTraLoi');
        $this->CPhieuTraLoi->index();
    }
}
