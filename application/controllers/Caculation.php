<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Caculation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function start_cal()
    {
        $res = (".\status.txt");
        if (file_exists($res)) {
            file_put_contents($res, '');
        }
        if (isset($_POST['mamon'])) {
            $this->load->model("MPhieuTraLoi");
            $this->MPhieuTraLoi->import($_POST['mamon']);
            file_put_contents(".\status.txt", "Done");
            exit;
        }
    }


    public function process_cal()
    {
        $this->load->library('../controllers/CPhieuTraLoi');
        $this->CPhieuTraLoi->index();
    }

    public function get_status()
    {
        $res = file_get_contents(".\status.txt");
        echo ($res);
        exit;
    }

    // public function get_excel()
    // {
    //     require 'vendor/autoload.php';

    //     // file_put_contents('E:\xampp\htdocs\tinhdiem\result2.json', json_encode($_SESSION['data_result']));
    //     $array = file_get_contents("E:\\xampp\htdocs\TinhDiem\\result.json");
    //     $productlist = json_decode($array, true);
    //     file_put_contents(".\\result2.json", json_encode($productlist));

    //     if (!is_array($productlist)) {
    //         echo "Lỗi: Dữ liệu JSON không hợp lệ.";
    //         exit;
    //     }


    //     header('Content-Type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment;filename="ketQua.xlsx"');
    //     $spreadsheet = new Spreadsheet();
    //     $sheet = $spreadsheet->getActiveSheet();

    //     $sheet->setCellValue('A1', mb_convert_encoding("SBD", 'UTF-8'));
    //     $sheet->setCellValue('B1', mb_convert_encoding('Họ Tên', 'UTF-8'));
    //     $sheet->setCellValue('C1', mb_convert_encoding("Ngày sinh", 'UTF-8'));
    //     $sheet->setCellValue('D1', mb_convert_encoding("Mã đề", "UTF-8"));
    //     $sheet->setCellValue('E1', mb_convert_encoding("Số lượng câu", 'UTF-8'));
    //     $sheet->setCellValue('F1', mb_convert_encoding("Số câu đúng", 'UTF-8'));
    //     $sheet->setCellValue('G1', mb_convert_encoding("Các câu đúng", 'UTF-8'));


    //     $sn = 2;
    //     foreach ($productlist as $prod) {

    //         $prod["sSBD"] = mb_convert_encoding($prod["sSBD"], 'UTF-8');
    //         $prod["sHoTen"] = mb_convert_encoding($prod["sHoTen"], 'UTF-8');
    //         $prod["sNgaySinh"] = mb_convert_encoding($prod["sNgaySinh"], 'UTF-8');
    //         $prod["iSoLuongCau"] = mb_convert_encoding($prod["iSoLuongCau"], 'UTF-8');

    //         $sheet->setCellValue('A' . $sn, $prod["sSBD"]);
    //         $sheet->setCellValue('B' . $sn, $prod["sHoTen"]);
    //         $sheet->setCellValue('C' . $sn, $prod["sNgaySinh"]);
    //         $sheet->setCellValue('D' . $sn, $prod["sMaDe"]);
    //         $sheet->setCellValue('E' . $sn, $prod["iSoLuongCau"]);
    //         $sheet->setCellValue('F' . $sn, $prod["iSoCauDung"]);
    //         $sheet->setCellValue('G' . $sn, $prod["sMaCauDung"]);

    //         $sn++;
    //     }

    //     $writer = new Xlsx($spreadsheet);
    //     $writer->save("php://output");
    //     exit;
    // }

    public function get_excel()
    {
        require 'vendor/autoload.php'; // Đảm bảo bạn đã cài đặt PhpSpreadsheet qua Composer

        // Đảm bảo rằng không có BOM trong dữ liệu JSON
        $array = file_get_contents("E:\\xampp\\htdocs\\TinhDiem\\result.json");
        $array = trim($array, "\xEF\xBB\xBF");
        $productlist = json_decode($array, true);

        if (!is_array($productlist)) {
            echo "Lỗi: Dữ liệu JSON không hợp lệ.";
            exit;
        }

        // Dọn dẹp output buffer
        if (ob_get_contents()) ob_end_clean();

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="ketQua.xlsx"');
        header('Cache-Control: max-age=0');

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', mb_convert_encoding("SBD", 'UTF-8'));
        $sheet->setCellValue('B1', mb_convert_encoding('Họ Tên', 'UTF-8'));
        $sheet->setCellValue('C1', mb_convert_encoding("Ngày sinh", 'UTF-8'));
        $sheet->setCellValue('D1', mb_convert_encoding("Mã đề", "UTF-8"));
        $sheet->setCellValue('E1', mb_convert_encoding("Tổng số câu", 'UTF-8'));
        $sheet->setCellValue('F1', mb_convert_encoding("Số câu đúng", 'UTF-8'));
        $sheet->setCellValue('G1', mb_convert_encoding("Số điểm", 'UTF-8'));
        $sheet->setCellValue('H1', mb_convert_encoding("Các câu đúng", 'UTF-8'));

        $sn = 2;
        foreach ($productlist as $prod) {
            $prod["sSBD"] = mb_convert_encoding($prod["sSBD"], 'UTF-8');
            $prod["sHoTen"] = mb_convert_encoding($prod["sHoTen"], 'UTF-8');
            $prod["sNgaySinh"] = mb_convert_encoding($prod["sNgaySinh"], 'UTF-8');
            $prod["iSoLuongCau"] = mb_convert_encoding($prod["iSoLuongCau"], 'UTF-8');

            $sheet->setCellValue('A' . $sn, $prod["sSBD"]);
            $sheet->setCellValue('B' . $sn, $prod["sHoTen"]);
            $sheet->setCellValue('C' . $sn, $prod["sNgaySinh"]);
            $sheet->setCellValue('D' . $sn, $prod["sMaDe"]);
            $sheet->setCellValue('E' . $sn, $prod["iSoLuongCau"]);
            $sheet->setCellValue('F' . $sn, $prod["iSoCauDung"]);
            $sheet->setCellValue('G' . $sn, $prod["fDiem"]);
            $sheet->setCellValue('H' . $sn, $prod["sMaCauDung"]);

            $sn++;
        }

        $writer = new Xlsx($spreadsheet);
        $writer->save("php://output");
        exit;
    }
}
