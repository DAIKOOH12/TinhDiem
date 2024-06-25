<?php

defined("BASEPATH") or exit("No direct script access allowed");
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MPhieuTraLoi extends CI_Model
{

    public $data_excel = array();

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function import($mamon)
    {


        // file_put_contents("E:\\xampp\htdocs\TinhDiem\check.json", json_encode($dataDA));

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

                    for ($i = 8; $i < $sheetcount; $i++) {
                        if($sheetdata[$i][0] == "Số bài thi:") {
                            break;
                        }
                        $listDA = "";
                        for ($j = 6; $j < count($sheetdata[$i]); $j++) {

                            // file_put_contents('E:\xampp\htdocs\tinhdiem\result.json', $sheetdata[$i][$j]);
                            
                            if($sheetdata[7][$j] == "Số câu đúng") {
                                break;
                            }

                            // if ($j > 5 )
                                $listDA .= $sheetdata[$i][$j] . "/";
                        }
                        // for ($o = 0; $o < count($dataDA); $o++) {
                        $SoCH = "";
                        $count = 0;

                        $this->db->like("pk_DeMon", $mamon . "-" . $sheetdata[$i][5]);
                        $da = $this->db->get("tblDapAn");
                        $dataDA = $da->result_array();
                        file_put_contents("E:\\xampp\htdocs\TinhDiem\\result2.json",json_encode($dataDA), false);

                        // if ($dataDA[0]["pk_DeMon"] == $sheetdata[$i][5]) {
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
                        // }


                        // }

                        $dataCH = array(
                            "sSBD" => $sheetdata[$i][1],
                            "fk_idThuMuc" => "tm1",
                            "sHoTen" => $sheetdata[$i][2],
                            "sLop" => $sheetdata[$i][4],
                            "sNgaySinh" => $sheetdata[$i][3],
                            "sDapAn" => $listDA,
                            "fk_demon" => $mamon. "-" . $sheetdata[$i][5],
                            "iSoLuongCau" => 40,
                            "iSoCauDung" => $count,
                            "sMaCauDung" => $SoCH,
                            // "sMaDe" => $sheetdata[$i][5],
                        );

                        array_push($data_res, $dataCH);
                    }


                    // $this->data_excel = $data_res;
                    // session_start();
                    // $_SESSION['data_result']=$data_res;
                    // session_write_close();
                    file_put_contents('E:\xampp\htdocs\tinhdiem\result.json', json_encode($data_res));
                    // $this->db->insert_batch("tblphieutraloi", $data_res);
                    // $this->get_excel($data_res);
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
}
