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


                $filePath = '.\assets\uploadSV\\' . $files[$t];
                // echo $filePath;

                $spreadsheet = IOFactory::load($filePath);
                $sheetdata = $spreadsheet->getActiveSheet()->toArray();
                $sheetcount = count($sheetdata);


                // $data_key = ["ma_sv", "ho_ten", "nam_sinh", "que_quan"];
                // $data_key = ["iSTT", "sMaDe", "sDapAn", "sNoiDung", "sMaCauHoi"];


                // file_put_contents('E:\xampp\htdocs\tinhdiem\result.json', $sheetcount);
                if ($sheetcount > 1) {

                    for ($i = 8; $i < $sheetcount; $i++) {
                        $soCauHoi = 0;
                        if ($sheetdata[$i][0] == "Số bài thi:" || $sheetdata[$i][0] == "") {
                            break;
                        }
                        $listDA = "";
                        for ($j = 6; $j < count($sheetdata[$i]); $j++) {


                            if ($sheetdata[7][$j] == "Số câu đúng") {
                                $soCauHoi = $j - 6;
                                break;
                            }

                            $listDA .= $sheetdata[$i][$j] . "/";
                        }

                        $maCauDung = "";
                        $count = 0;

                        $this->db->like("pk_DeMon", $mamon . "-" . $sheetdata[$i][5]);
                        $da = $this->db->get("tblDapAn");
                        $dataDA = $da->result_array();
                        
                        $list1 = explode("/", $dataDA[0]["sDapAn"]);
                        $list2 = explode("/", $listDA);
                        $listMCH = explode("/", $dataDA[0]["sMaCauHoi"]);


                        for ($q = 0; $q < count($list1) - 1; $q++) {
                            if ($list1[$q] == $list2[$q]) {
                                $count++;
                                $maCauDung .= $listMCH[$q] . "/";
                            }
                        }
                    

                        $dataCH = array(
                            "sSBD" => $sheetdata[$i][1],
                            "fk_idThuMuc" => "tm1",
                            "sHoTen" => $sheetdata[$i][2],
                            "sLop" => $sheetdata[$i][4],
                            "sNgaySinh" => $sheetdata[$i][3],
                            "sDapAn" => $listDA,
                            "fk_demon" => $mamon . "-" . $sheetdata[$i][5],
                            "iSoLuongCau" => $soCauHoi,
                            "iSoCauDung" => $count,
                            "sMaCauDung" => $maCauDung,
                            "sMaDe" => $sheetdata[$i][5],
                            "fDiem" => $count*10/$soCauHoi
                        );

                        array_push($data_res, $dataCH);
                    }

                    file_put_contents('.\result.json', json_encode($data_res));

                    $data_import  = array_map(function ($item) {
                        if (isset($item['sMaDe'])) {
                            unset($item['sMaDe']);
                        }
                        return $item;
                    }, $data_res);

                    $this->db->insert_batch("tblphieutraloi", $data_import);
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
}
