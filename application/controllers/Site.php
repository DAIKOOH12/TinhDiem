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
		$this->load->view("site");
	}

	public function upload()
	{
		if (!empty($_FILES)) {
			$config['upload_path'] = "./assets/uploads";
			$config['allowed_types'] = 'xlsx';

			$this->load->library('upload');
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			$this->upload->initialize($config);

			$files = $_FILES;
			$number_of_files = count($_FILES['file']['name']);
			$errors = 0;
			// $this->showArr($files);
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
					for ($j = 1; $j < $sheetcount; $j++) {
						$stt = $sheetdata[$j][0];
						$masv = $sheetdata[$j][1];
						$sophach = $sheetdata[$j][2];
						$made = $sheetdata[$j][3];
						$cau1 = $sheetdata[$j][4];
						$cau2 = $sheetdata[$j][5];
						$cau3 = $sheetdata[$j][6];
						$cau4 = $sheetdata[$j][7];
						$cau5 = $sheetdata[$j][8];
						$cau6 = $sheetdata[$j][9];
						$cau7 = $sheetdata[$j][10];
						$cau8 = $sheetdata[$j][11];
						$cau9 = $sheetdata[$j][12];
						$cau10 = $sheetdata[$j][13];
						$cau11 = $sheetdata[$j][14];
						$cau12 = $sheetdata[$j][15];
						$cau13 = $sheetdata[$j][16];
						$cau14 = $sheetdata[$j][17];
						$cau15 = $sheetdata[$j][18];
						$cau16 = $sheetdata[$j][19];
						$cau17 = $sheetdata[$j][20];
						$cau18 = $sheetdata[$j][21];
						$cau19 = $sheetdata[$j][22];
						$cau20 = $sheetdata[$j][23];
						$cau21 = $sheetdata[$j][24];
						$cau22 = $sheetdata[$j][25];
						$cau23 = $sheetdata[$j][26];
						$cau24 = $sheetdata[$j][27];
						$cau25 = $sheetdata[$j][28];
						$cau26 = $sheetdata[$j][29];
						$cau27 = $sheetdata[$j][30];
						$cau28 = $sheetdata[$j][31];
						$cau29 = $sheetdata[$j][32];
						$cau30 = $sheetdata[$j][33];
						$cau31 = $sheetdata[$j][34];
						$cau32 = $sheetdata[$j][35];
						$cau33 = $sheetdata[$j][36];
						$cau34 = $sheetdata[$j][37];
						$cau35 = $sheetdata[$j][38];
						$cau36 = $sheetdata[$j][39];
						$cau37 = $sheetdata[$j][40];
						$cau38 = $sheetdata[$j][41];
						$cau39 = $sheetdata[$j][42];
						$cau40 = $sheetdata[$j][43];
						$data[] = array(
							'STT' => $stt,
							'sMaSV' => $masv,
							'iSoPhach' => $sophach,
							'sMaDe' => $made,
							'1' => $cau1,
							'2' => $cau2,
							'3' => $cau3,
							'4' => $cau4,
							'5' => $cau5,
							'6' => $cau6,
							'7' => $cau7,
							'8' => $cau8,
							'9' => $cau9,
							'10' => $cau10,
							'11' => $cau11,
							'12' => $cau12,
							'13' => $cau13,
							'14' => $cau14,
							'15' => $cau15,
							'16' => $cau16,
							'17' => $cau17,
							'18' => $cau18,
							'19' => $cau19,
							'20' => $cau20,
							'21' => $cau21,
							'22' => $cau22,
							'23' => $cau23,
							'24' => $cau24,
							'25' => $cau25,
							'26' => $cau26,
							'27' => $cau27,
							'28' => $cau28,
							'29' => $cau29,
							'30' => $cau30,
							'31' => $cau31,
							'32' => $cau32,
							'33' => $cau33,
							'34' => $cau34,
							'35' => $cau35,
							'36' => $cau36,
							'37' => $cau37,
							'38' => $cau38,
							'39' => $cau39,
							'40' => $cau40,
						);
					}
				}
				$sheetcount=count($sheetdata);
			}
			// $this->showArr($data);
			// $this->Msite->insert_sv_answer($data);
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

	public function spreadsheet_import()
	{
		$this->showArr($_FILES);
		$upload_file = $_FILES['upload_file_key']['name'];
		$extension = pathinfo($upload_file, PATHINFO_EXTENSION);
		if ($extension == 'csv') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
		} else if ($extension == 'xls') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
		} else if ($extension == 'xlsx') {
			$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
		}
		$made = $this->input->post('made');
		// $this->showArr($upload_file);
		$spreadsheet = $reader->load($_FILES['upload_file_key']['tmp_name']);
		$sheetdata = $spreadsheet->getActiveSheet()->toArray();
		// $this->showArr($sheetdata);
		$sheetcount = count($sheetdata);
		if ($sheetcount > 1) {
			$data = array();
			for ($i = 1; $i < $sheetcount; $i++) {
				$stt = $sheetdata[$i][0];
				$dapan = $sheetdata[$i][1];
				$noidung = $sheetdata[$i][2];
				$macau = $sheetdata[$i][3];
				$data[] = array(
					'STT' => $stt,
					'sMaDe' => $made,
					'DapAn' => $dapan,
					'NoiDung' => $noidung,
					'sMaCau' => $macau
				);
			}
			// $this->showArr($data);
			$this->Msite->insert_data($data);
		}
	}
	public function showArr($arr)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}
