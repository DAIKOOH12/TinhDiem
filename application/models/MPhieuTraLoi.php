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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $now = date('Y_m_d-H_i_s');
        $now_VN = date('d/m/Y-H:i:s');

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
                            "fk_idThuMuc" => $mamon . "-" . $now,
                            "sHoTen" => $sheetdata[$i][2],
                            "sLop" => $sheetdata[$i][4],
                            "sNgaySinh" => $sheetdata[$i][3],
                            "sDapAn" => $listDA,
                            "fk_demon" => $mamon . "-" . $sheetdata[$i][5],
                            "iSoLuongCau" => $soCauHoi,
                            "iSoCauDung" => $count,
                            "sMaCauDung" => $maCauDung,
                            "sMaDe" => $sheetdata[$i][5],
                            "fDiem" => $count * 10 / $soCauHoi
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

                    $data_tm = array(
                        "idThuMuc" => $mamon . "-" . $now,
                        "fk_idNguoiDung" => "nd1",
                        "sDuongDan" => "assets/uploads/ketqua/" . $mamon . "-" . $now,
                        "sTenFile" => $mamon . "-" . $now,
                        "dThoiGian" => $now_VN,
                        "bLoaiThuMuc" => 0
                    );


                    $this->db->insert("tblThuMuc", $data_tm);
                    $this->db->insert_batch("tblphieutraloi", $data_import);
                    $this->get_excel($data_res, "assets/uploads/ketqua/" . $mamon . "-" . $now);
                    // $this->get_excel($data_res, "assets/uploads/ketqua/" . $mamon . "-" . $now);
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


    public function get_excel($data_res, $path)
    {
        // $array = file_get_contents("E:\\xampp\\htdocs\\TinhDiem\\result.json");
        // $array = trim($array, "\xEF\xBB\xBF");
        // $productlist = json_decode($array, true);
        echo "fdfd";
        $productlist = $data_res;

        if (!is_array($productlist)) {
            echo "Lỗi: Dữ liệu JSON không hợp lệ.";
            exit;
        }

        // Dọn dẹp output buffer
        if (ob_get_contents()) ob_end_clean();

        // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        // header('Content-Disposition: attachment;filename="ketQua.xlsx"');
        // header('Cache-Control: max-age=0');

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
        // $writer->save($path. ".xlsx");
        $writer->save($path . ".xlsx");
    }

    public function import_tblMon($data)
    {
        if (!empty($data)) {
            $sql = "INSERT IGNORE INTO tblMon (idMon, sTenMon) VALUES ('" . $data["idMon"] . "', '" . $data["sTenMon"] . "')";
            $values = [];

            // foreach ($data as $row) {
            //     // Sửa lỗi cú pháp: đảm bảo đóng ngoặc đúng chỗ
            //     $values[] = "('" . ($row['idMon']) . "', '" . ($row['sTenMon']) . "')";
            // }

            // $sql .= implode(", ", $values);

            // Kiểm tra kết quả thực thi câu lệnh SQL
            $this->db->query($sql);
            // if ($this->db->query($sql)) {
            //     return true;
            // } else {
            //     // Ghi log thông báo lỗi
            //     log_message('error', 'Error inserting data: ' . $this->db->error());
            //     return false;
            // }
        }
    }

    public function import_tblDe($data)
    {
        $this->db->insert("tblDe", $data);
    }

    public function import_tblDapAn($data)
    {
        $this->db->insert_batch("tblDapAn", $data);
    }

    public function getDapAn($idDe, $idMon)
    {
        $this->db->select('*');
        $this->db->from('tbldapan as d');
        $this->db->join('tblDe as e', 'd.fk_idde = e.idDe');
        $this->db->where('e.sTrangThai', 'active');
        $this->db->where("d.idDapAn", $idDe . "-" . $idMon);
        $da = $this->db->get();
        return $da->result_array();
    }
}
