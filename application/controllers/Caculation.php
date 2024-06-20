<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Caculation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        session_start();
    }

    public function start_cal()
    {
        shell_exec('php index.php CPhieuTraLoi index');
    }


    public function process_cal() {
        $this->load->library('../controllers/CPhieuTraLoi');
        $this->CPhieuTraLoi->index();
    }

    public function get_status() {
		$res = file_get_contents("E:\\xampp\htdocs\TinhDiem\status.txt");
		echo ($res);
		exit;
	}

    public function get_excel() {
        // echo "haha";
        // exit;
        
        // $productlist = array();
        // file_put_contents('E:\xampp\htdocs\tinhdiem\result2.json', json_encode($_SESSION['data_result']));
        
        $productlist = json_decode(file_get_contents("E:\\xampp\htdocs\TinhDiem\\result.json"), true);
        // if(isset($_SESSION['data_result']))
        //     $productlist = $_SESSION['data_result'];
        // print_r($productlist);
        // exit;
        if (!is_array($productlist)) {
            echo "Lỗi: Dữ liệu JSON không hợp lệ.";
            exit;
        }


        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="ketQua.xlsx"');
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'spl');
        // $sheet->setCellValue('B1', 'spw');
        // $sheet->setCellValue('C1', 'ptl');
        // $sheet->setCellValue('D1', 'ptw');
        // $sheet->setCellValue('E1', 'class');

        $sheet->setCellValue('A1', mb_convert_encoding("SBD", 'UTF-8'));
        $sheet->setCellValue('B1', mb_convert_encoding('Họ Tên', 'UTF-8'));
        $sheet->setCellValue('C1', mb_convert_encoding("Ngày sinh", 'UTF-8'));
        $sheet->setCellValue('D1', mb_convert_encoding("Số lượng câu", 'UTF-8'));
        $sheet->setCellValue('E1', mb_convert_encoding("Số câu đúng", 'UTF-8'));
        $sheet->setCellValue('F1', mb_convert_encoding("Các câu đúng", 'UTF-8'));
        


        $sn = 2;
        foreach ($productlist as $prod) {

            $prod["sSBD"] = mb_convert_encoding($prod["sSBD"], 'UTF-8');
            $prod["sHoTen"] = mb_convert_encoding($prod["sHoTen"], 'UTF-8');
            $prod["sNgaySinh"] = mb_convert_encoding($prod["sNgaySinh"], 'UTF-8');
            $prod["iSoLuongCau"] = mb_convert_encoding($prod["iSoLuongCau"], 'UTF-8');

            $sheet->setCellValue('A' . $sn, $prod["sSBD"]);
            $sheet->setCellValue('B' . $sn, $prod["sHoTen"]);
            $sheet->setCellValue('C' . $sn, $prod["sNgaySinh"]);
            $sheet->setCellValue('D' . $sn, $prod["iSoLuongCau"]);
            $sheet->setCellValue('E' . $sn, $prod["iSoCauDung"]);
            $sheet->setCellValue('F' . $sn, $prod["sMaCauDung"]);
            


            // echo $prod["sp_length"];
            // echo $prod["sp_width"];
            // echo $prod["pt_length"];
            // echo $prod["pt_witdth"];
            // echo $prod["class"];
            // break;

            $sn++;
        }
        //TOTAL
        // $sheet->setCellValue('D8','Total');
        // $sheet->setCellValue('E8','=SUM(E2:E'.($sn-1).')');

        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
    }
}
