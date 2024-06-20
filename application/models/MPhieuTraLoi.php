<?php 
use LDAP\Result;
defined("BASEPATH") OR exit("No direct script access allowed");
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class MPhieuTraLoi extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function import() {

        $da = $this->db->get("tblDapAn");
        $dataDA = $da->result_array();
        file_put_contents("E:\\xampp\htdocs\TinhDiem\check.json", json_encode($dataDA));
        
        $this->load->helper('file');
        $files = get_filenames("./assets/uploadSV");
        // file_put_contents('E:\xampp\htdocs\tinhdiem\result.json', "fdsf");
        $data_res = array();
        // file_put_contents('E:\xampp\htdocs\tinhdiem\result.json', "f");
        for ($t = 0; $t < count($files); $t++) {
            try {
                // $this->load->helper('file');
                // $files = get_filenames("./assets/uploads");


                $filePath = 'E:\xampp\htdocs\TinhDiem\assets\uploadSV\\' . $files[$t];
                // echo $filePath;

                $spreadsheet = IOFactory::load($filePath);
                $sheetdata = $spreadsheet->getActiveSheet()->toArray();
                $sheetcount = count($sheetdata);

                
                // $data_key = ["ma_sv", "ho_ten", "nam_sinh", "que_quan"];
                // $data_key = ["iSTT", "sMaDe", "sDapAn", "sNoiDung", "sMaCauHoi"];


                // file_put_contents('E:\xampp\htdocs\tinhdiem\result.json', $sheetcount);
                if ($sheetcount > 1) {

                    for ($i = 1; $i < $sheetcount; $i++) {
                        $listDA = "";
                        for ($j = 0; $j < count($sheetdata[$i]); $j++) {

                            // file_put_contents('E:\xampp\htdocs\tinhdiem\result.json', $sheetdata[$i][$j]);
                            if ($j > 5)
                                $listDA .= $sheetdata[$i][$j] . "/";
                        }
                        // for ($o = 0; $o < count($dataDA); $o++) {
                            $SoCH = "";
                            $count = 0;
                            // log_message("dk","DS01" .$sheetdata[$i][5]);
                            // file_put_contents('E:\xampp\htdocs\tinhdiem\result.json', "DS01" . $sheetdata[$i][5]);
                            if ("DS01" == $sheetdata[$i][5]) {
                                // file_put_contents('E:\xampp\htdocs\TinhDiem\status.txt', json_encode($listDA));
                                $list1 = explode("/", $dataDA[0]["sDapAn"]);
                                $list2 = explode("/", $listDA);
                                $listMCH = explode("/", $dataDA[0]["sMaCauHoi"]);


                                for ($q = 0; $q < count($list1) - 1; $q++) {
                                    if ($list1[$q] == $list2[$q]) {
                                        $count++;
                                        $SoCH .= $listMCH[$q] . "/";
                                    }
                                }
                            }
                        // }

                        $dataCH = array(
                            "sSBD" => $sheetdata[$i][1],
                            "fk_idThuMuc" => "tm1",
                            "sHoTen" => $sheetdata[$i][2],
                            "sLop" => $sheetdata[$i][4],
                            "sNgaySinh" => $sheetdata[$i][3],
                            "sDapAn" => $listDA,
                            "fk_demon" => "fk",
                            "iSoLuongCau" => 40,
                            "iSoCauDung" => $count,
                            "sMaCauDung" => $SoCH,
                        );

                        array_push($data_res, $dataCH);
                    }


                    file_put_contents('E:\xampp\htdocs\tinhdiem\result.json', json_encode($data_res));
                    $this->get_excel($data_res);
                    // $this->import_tblDapAn($dataDA);
                    // $this->load->model("Msite");
                    // $this->Msite->insert_tblPhieuTraLoi($data_res);
                }
                // echo $sheetcount;

                // Your data processing logic goes here

            } catch (Exception $e) {
                // Handle Exception
                echo 'Caught exception: ',  $e->getMessage(), "\n";
                log_message('debug', $e->getMessage());
            } catch (Error $err) {
                // Handle Error
                echo 'Caught error: ',  $err->getMessage(), "\n";
            }
        }
    }

    public function get_excel($data_res) {
        // echo "haha";
        // exit;
        
        // $productlist = json_decode(file_get_contents("E:\\xampp\htdocs\TinhDiem\\result.json"), true);
        $productlist = $data_res;
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