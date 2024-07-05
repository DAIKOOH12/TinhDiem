<?php
defined('BASEPATH') or exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Caculation extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("MPhieuTraLoi");
    }

    public function start_cal()
    {
        $res = (".\status.txt");
        // if (file_exists($res)) {
        //     file_put_contents($res, '');
        // }
        // if (isset($_POST['mamon'])) {
        //     $this->load->model("MPhieuTraLoi");
        //     $this->MPhieuTraLoi->import($_POST['mamon']);

        //     //xóa file sinh vien
        //     $this->load->helper('file');
        //     $files = get_filenames("./assets/uploadSV");
        //     for ($t = 0; $t < count($files); $t++) {
        //         unlink( './assets/uploadSV/' . $files[$t]);
        //     }


        //     file_put_contents(".\status.txt", "Done");
        //     exit;
        // }



        if (file_exists($res)) {
            file_put_contents($res, '');
        }
        $this->LayThongTin();

        $this->load->helper('file');
        $fileSV = get_filenames("./assets/uploadSV");
        for ($t = 0; $t < count($fileSV); $t++) {
            unlink('./assets/uploadSV/' . $fileSV[$t]);
        }
        $fileDE = get_filenames("./assets/uploadDe");
        for ($t = 0; $t < count($fileDE); $t++) {
            unlink('./assets/uploadDe/' . $fileDE[$t]);
        }

        file_put_contents(".\status.txt", "Done");
        exit;
    }

    public function LayThongTin()
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now_VN = date('d/m/Y-H:i:s');

        $this->load->helper('file');
        $files = get_filenames("./assets/uploadSV");

        $data_res = array();

        for ($i = 0; $i < count($files); $i++) {
            try {
                // $this->load->helper('file');
                // $files = get_filenames("./assets/uploads");


                $filePath = '.\assets\uploadSV\\' . $files[$i];
                // echo $filePath;

                $spreadsheet = IOFactory::load($filePath);
                $sheetdata = $spreadsheet->getActiveSheet()->toArray();
                $sheetcount = count($sheetdata);


                if ($sheetcount > 1) {

                    //Lấy thông tin về tên môn, mã môn, ngày thi, phòng thi
                    $ma_tenMon = trim(explode(":", $sheetdata[3][0])[1]);
                    $mon = explode("_", $ma_tenMon)[1];
                    $trungTam = $sheetdata[4][0];
                    preg_match('/Phòng số:\s*(\S+)/', $sheetdata[5][0], $phongThi);
                    preg_match('/Ngày thi:\s*(\d{2}\/\d{2}\/\d{4})/', $sheetdata[5][0], $ngayThi);
                    $thongTin = array(
                        "tenMon" => $mon,
                        "trungTam" => $trungTam,
                        "phongThi" => $phongThi[1],
                        "ngayThi" => $ngayThi[1],
                    );
                    $array_tblmon = array(
                        "idMon" => explode("_", $ma_tenMon)[0],
                        "sTenMon" => explode("_", $ma_tenMon)[1]
                    );



                    //import vào db

                    $this->MPhieuTraLoi->import_tblMon($array_tblmon);
                    file_put_contents("./status.txt", ($array_tblmon));

                    $idmon = explode("_", $ma_tenMon)[0];
                    if ($i == (count($files) - 1)) {
                        $this->data_DA($idmon);
                    }




                    //Lấy thông tin thí sinh: 
                    for ($e = 8; $e < $sheetcount; $e++) {
                        $soCauHoi = 0;
                        if ($sheetdata[$e][0] == "Số bài thi:" || $sheetdata[$e][0] == "") {
                            break;
                        }
                        $listDA = "";
                        for ($j = 6; $j < count($sheetdata[$e]); $j++) {


                            if ($sheetdata[7][$j] == "Số câu đúng") {
                                $soCauHoi = $j - 6;
                                break;
                            }

                            $listDA .= $sheetdata[$e][$j] . "/";
                        }

                        $maCauDung = "";
                        $count = 0;
                        $maPI = "";



                        $dataDA = $this->MPhieuTraLoi->getDapAn($sheetdata[$e][5], $idmon);
                        file_put_contents('./result2.json', json_encode($dataDA));

                        $list1 = explode("/", $dataDA[0]["sDapAn"]);
                        $list2 = explode("/", $listDA);
                        $listMCH = explode("/", $dataDA[0]["sMaCauHoi"]);
                        $listPI = explode("/", str_replace("-", "/", $dataDA[0]["sCLO"]));;


                        for ($q = 0; $q < count($list1) - 1; $q++) {
                            if ($list1[$q] == $list2[$q]) {
                                $count++;
                                $maCauDung .= $listMCH[$q] . "/";
                                $maPI .= $listPI[$q] . "/";
                            }
                        }


                        $dataCH = array(
                            "sSBD" => $sheetdata[$e][1],
                            "fk_idThuMuc" => "tm1",
                            "sHoTen" => $sheetdata[$e][2],
                            "sLop" => $sheetdata[$e][4],
                            "sNgaySinh" => $sheetdata[$e][3],
                            "sDapAn" => $listDA,
                            "fk_idDapAn" => $sheetdata[$e][5] . "-" . $idmon,
                            "iSoLuongCau" => $soCauHoi,
                            "iSoCauDung" => $count,
                            "sMaCauDung" => $maCauDung,
                            "sMaDe" => $sheetdata[$e][5],
                            "fDiem" => $count * 10 / $soCauHoi,
                            "sPI" => $maPI,
                            "iSoCauCLO" => $dataDA[0]["sCLO"]
                        );

                        array_push($data_res, $dataCH);
                    }
                    file_put_contents("./result.json", json_encode($data_res));
                    // $this->get_excel($data_res, );
                    // file_put_contents("./result.json", "fdfdf");
                }
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

    public function data_DA($idMon)
    {
        $this->load->helper('file');
        $files = get_filenames("./assets/uploadDe");

        $data_files = array();

        if (count($files) == 0)
            return;

        for ($i = 0; $i < count($files); $i++) {
            try {
                // $this->load->helper('file');
                // $files = get_filenames("./assets/uploads");


                $filePath = ".\assets\uploadDe\\" . $files[$i];

                $idDe = explode(".", $files[$i])[0];
                $this->data_De($idMon, $idDe);
                // echo $filePath;

                $spreadsheet = IOFactory::load($filePath);
                $sheetdata = $spreadsheet->getActiveSheet()->toArray();
                $sheetcount = count($sheetdata);

                $sDapAn = "";
                $sCauHoi = "";
                $sPI = "";
                $CLO = "";
                if ($sheetcount > 1) {
                    for ($j = 1; $j < $sheetcount; $j++) {
                        if ($sPI == "") {
                            $sDapAn .= $sheetdata[$j][1];
                            $sCauHoi .= $sheetdata[$j][3];
                            $sPI .= $sheetdata[$j][4];
                            $CLO = explode(".", $sheetdata[$j][4])[0];
                        } else {
                            $sDapAn .= "/" . $sheetdata[$j][1];
                            $sCauHoi .= "/" . $sheetdata[$j][3];
                            if (explode(".", $sheetdata[$j][4])[0] != $CLO) {
                                $CLO = explode(".", $sheetdata[$j][4])[0];
                                $sPI .= "-" . $sheetdata[$j][4];
                            } else {
                                $sPI .= "/" . $sheetdata[$j][4];
                            }
                        }
                    }

                    $data_file = array(
                        "idDapAn" => $idDe . "-" . $idMon,
                        "fk_idde" => $idDe,
                        "fk_idThuMuc" => "tm1",
                        "sDapAn" => $sDapAn,
                        "sMaCauHoi" => $sCauHoi,
                        "iSoLuongCau" => $sheetcount - 1,
                        "sCLO" => $sPI
                    );

                    array_push($data_files, $data_file);
                } else {
                    return;
                }
            } catch (Exception $e) {
                // Handle Exception
                echo 'Caught exception: ',  $e->getMessage(), "\n";
                log_message('debug', $e->getMessage());
            } catch (Error $err) {
                // Handle Error
                echo 'Caught error: ',  $err->getMessage(), "\n";
            }
        }
        file_put_contents("./result.json", json_encode($data_files));
        // $this->load->model("MPhieuTraLoi");
        $this->MPhieuTraLoi->import_tblDapAn($data_files);
    }

    public function data_De($idMon, $idDe)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');

        $now_VN = date('d/m/Y-H:i:s');
        $data = array(
            "idDe" => $idDe,
            "fk_idMon" => $idMon,
            "dThoiGianTao" => $now_VN,
            "sTrangThai" => "active",
        );

        $this->load->model("MPhieuTraLoi");
        $this->MPhieuTraLoi->import_tblDe($data);
    }

    public function get_excel()
    {
        $array = file_get_contents(".\\result.json");
        $array = trim($array, "\xEF\xBB\xBF");
        $productlist = json_decode($array, true);
        // echo "fdfd";
        // $productlist = $data_res;

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

        $tachCLO = explode("-", $productlist[0]["iSoCauCLO"]);
        for($i = 0; $i <count($tachCLO); $i ++) {
            $sheet->setCellValue(chr(105 + $i).'1', mb_convert_encoding("CLO ".$i + 1, 'UTF-8'));
        }

        $sn = 2;
        foreach ($productlist as $prod) {
            $listPI = explode("/", $prod["sPI"]);

            $mang = array();
            for($i = 0; $i <count($tachCLO); $i ++) {
                $count = 0;
                for($j = 0 ; $j < count($listPI)-1 ; $j++) {
                    $mang2 = array("fff" => explode(".", $listPI[$j])[0]);
                    if(explode(".", $listPI[$j])[0] == (String)($i + 1)) {
                        $count ++;
                    }
                    
                }
                $demCauCLO = count(explode("/", $tachCLO[$i]));
                $sheet->setCellValue(chr(105 + $i). $sn, mb_convert_encoding($count . "/". $demCauCLO, 'UTF-8'));
            }
            file_put_contents("./checkPI.json", json_encode($listPI));

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
        // $writer->save($path. ".xlsx");
        // $writer->save($path . ".xlsx");
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

}
