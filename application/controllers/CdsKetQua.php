<?php 
 if (!defined('BASEPATH')) exit('No direct script access allowed');
 require FCPATH . 'vendor/autoload.php';

 class CdsKetQua extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->model('MdsKetQua');
        $this->load->model('Mdsmon');
        
    }

    public function loadView() {

        //Lấy danh sách tất cả các môn
        // $data['dsmon']=$this->Mdsmon->getDSMon();
        // foreach($data['dsmon'] as &$i) {
            
        //     //lấy danh sách các đề của môn
        //     $made = $this->MdsKetQua->getDeTheoMon($i["idMon"]);
        //     // file_put_contents("E:\\xampp\htdocs\TinhDiem\\result2.json", json_encode($made));
        //     $str_md = implode(", ", array_column($made, "sMaDe"));
        //     $i["sMaDe"] = $str_md;
        // }
        // unset($i);
        $data['dskq']=$this->MdsKetQua->getThuMuc();
        foreach($data['dskq'] as &$i) {
            $mamon = explode('-', $i["idThuMuc"])[0];
            //lấy danh sách các đề của môn
            $tenmon = $this->MdsKetQua->getTenMonTheoMa($mamon);
            // file_put_contents("E:\\xampp\htdocs\TinhDiem\\result2.json", json_encode($made));
            // $str_md = implode(", ", array_column($made, "sMaDe"));
            $i["sTenMon"] = array_column($tenmon, "sTenMon")[0];
            
        }
        unset($i);
        $this->load->view("VdsKetQua",$data);
    }

    public function download($dd){
        
    }
    
 }
