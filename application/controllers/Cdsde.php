<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Cdsde extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdsde');
    }
    public function index()
    {
        if (!empty($_GET)) {
            $data['dsde'] = $this->Mdsde->getDSDeTheoMon($_GET['id']);
        } else {
            $data['dsde'] = $this->Mdsde->getDSDe();
        }
        $this->load->view('Vdsde', $data);
    }
    public function showArr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }
}
