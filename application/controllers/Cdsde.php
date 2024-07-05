<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class Cdsde extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mdsde');
        $this->load->library('pagination');
    }
    public function index()
    {
        if (!empty($_GET)) {
            $data['dsde'] = $this->Mdsde->getDSDeTheoMon($_GET['id']);
        } else {
            $data['dsde'] = $this->Mdsde->getDSDe();
        }
        // $this->showArr($data);
        $this->load->view('Vdsde', $data);
    }
    public function changeStateDe(){
        $made=$this->input->post('idde');
        $data['sTrangThai']=$this->input->post('state');
        $this->Mdsde->changeStateDe($made,$data);
    }
    public function showArr($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }
}
