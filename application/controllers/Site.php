<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Site extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Msite');
	}

	public function index()
	{
		$data["dsmon"] = $this->Msite->get_dsmon();
		$this->load->view("form_multiple", $data);
	}

	public function addMonHoc()
	{
		$this->showArr($this->input->post());
		$monhoc['idMon'] = $this->input->post('mamon');
		$monhoc['sTenMon'] = $this->input->post('tenmon');
		$this->Msite->insert_mon($monhoc);
	}
	public function upload()
	{
		if (!empty($_FILES)) {
			$config2['upload_path'] = "./assets/uploads/traloi";
			$config2['allowed_types'] = 'xlsx';

			$this->load->library('upload');
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$this->upload->initialize($config2);

			$files = $_FILES;
			$number_of_files = count($_FILES['file']['name']);
			$errors = 0;
			// codeigniter upload just support one file
			// to upload. so we need a litte trick
			$total_data_files = array();
			$total_record = 0;
			$data = array();
			for ($i = 0; $i < $number_of_files; $i++) {
				$_FILES['file']['name'] = $files['file']['name'][$i];
				$_FILES['file']['type'] = $files['file']['type'][$i];
				$_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
				$_FILES['file']['error'] = $files['file']['error'][$i];
				$_FILES['file']['size'] = $files['file']['size'][$i];

				// we have to initialize before upload

				if (!$this->upload->do_upload("file")) {
					$errors++;
				}
				$spreadsheet = $reader->load($files['file']['tmp_name'][$i]);
				$sheetdata = $spreadsheet->getActiveSheet()->toArray();
				// $this->showArr($sheetdata);
				$sheetcount = count($sheetdata);
				$total_record += $sheetcount;
				if ($sheetcount > 1) {
				}
				$sheetcount = count($sheetdata);
			}
			// $this->showArr($data);
			$this->Msite->insert_sv_answer($data);
			// $this->showArr($total_data_files);

			if ($errors > 0) {
				echo $errors . "File(s) cannot be uploaded";
			}
		} elseif ($this->input->post('file_to_remove')) {
			$file_to_remove = $this->input->post('file_to_remove');
			unlink("./assets/uploads/" . $file_to_remove);
		} else {
			$this->listFiles();
		}
	}

	private function listFiles()
	{
		$this->load->helper('file');
		$files = get_filenames("./assets/uploads");
		echo json_encode($files);
		exit;
	}

	public function spreadsheet_format()
	{
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="helloworld.xlsx"');
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		$sheet->setCellValue('A1', 'Hello World');

		$writer = new Xlsx($spreadsheet);
		$writer->save("php://output");
	}

	public function themdapan()
	{
		// $this->showArr($_POST);
		// $this->showArr($_FILES);
		if (!empty($_FILES)) {
			$errors = 0;
			$config1['upload_path'] = "./assets/uploads/dapan";
			$config1['allowed_types'] = 'xlsx';

			$this->load->library('upload');
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$this->upload->initialize($config1);
			if (!$this->upload->do_upload("upload_file_key")) {
				$errors++;
			}
			// $file_name=$_FILES();
			$thumucdapan = "/assets/uploads/dapan/" . $_FILES['upload_file_key']['full_path'];
			$dapan['idThuMuc'] = $_FILES['upload_file_key']['full_path']. "-" . date('d/m/Y')."-".date('h:i:s');
			$dapan['fk_idNguoiDung'] = 'nd1';
			$dapan['sDuongDan'] = $thumucdapan;
			$dapan['sTenFile'] = $_FILES['upload_file_key']['full_path'];
			$dapan['dThoiGian'] = date('d/m/Y') . "-" . date('h:i:s');
			$dapan['bLoaiThuMuc'] = 1;
			// $this->Msite->insert_dapan_to_folder($dapan);

			// $made = $this->input->post('made') . "-" . date('d/m/Y') . "-" . date('h:i:s');
			$made = $this->input->post('made');
			$mamon = $this->input->post('mamon');
			$newDe['idDe'] = $made. "-" . date('d/m/Y') . "-" . date('h:i:s');
			// $newDe['sMaDe'] = $this->input->post('made');
			$newDe['fk_idMon'] = '7E23942';
			$newDe['dThoiGianTao'] = date('d/m/Y') . "-" . date('h:i:s');
			$newDe['sTrangThai'] = "active";
			$this->Msite->insert_de($newDe);



			$upload_file = $_FILES['upload_file_key']['name'];
			$extension = pathinfo($upload_file, PATHINFO_EXTENSION);
			if ($extension == 'csv') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else if ($extension == 'xls') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
			} else if ($extension == 'xlsx') {
				$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet = $reader->load($_FILES['upload_file_key']['tmp_name']);
			$sheetdata = $spreadsheet->getActiveSheet()->toArray();
			// $this->showArr($sheetdata);
			$sheetcount = count($sheetdata);
			// $dsDapAn['pk_DeMon'] = $mamon . "-" . $made . "-" . date('d/m/Y') . "-" . date('h:i:sa');
			$dsDapAn['pk_DeMon'] = $mamon . "-" . $made;
			$dsDapAn['fk_idde'] = $made. "-" . date('d/m/Y') . "-" . date('h:i:s');
			$dsDapAn['fk_idmon'] = $mamon;
			$dsDapAn['fk_idThuMuc'] = $_FILES['upload_file_key']['full_path']. "-" . date('d/m/Y')."-".date('h:i:s');
			$dsDapAn['sDapAn'] = "";
			$dsDapAn['sMaCauHoi'] = "";
			$dsDapAn['iSoLuongCau'] = $sheetcount - 1;
			if ($sheetcount > 1) {
				for ($i = 1; $i < $sheetcount; $i++) {
					if ($i == 1) {
						$dsDapAn['sDapAn'] .= $sheetdata[$i][1];
						$dsDapAn['sMaCauHoi'] = $sheetdata[$i][3];
					} else {
						$dsDapAn['sDapAn'] = $dsDapAn['sDapAn'] . "/" . $sheetdata[$i][1];
						$dsDapAn['sMaCauHoi'] = $dsDapAn['sMaCauHoi'] . "/" . $sheetdata[$i][3];
					}
				}

				// $this->showArr($dsDapAn);
				// $this->Msite->insert_dapan($dsDapAn);
			}
		}
		$this->load->helper('file');
		$dapan=basename("./assets/uploads/dapan/".$_FILES['upload_file_key']['name']);
		// $this->showArr($dapan);
		echo json_encode($dapan);
		exit;
	}
	public function xoaDapAn(){
		$filename=$this->input->post('namefile');
		unlink("./assets/uploads/dapan/" . $filename);
	}
	public function showArr($arr)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}
