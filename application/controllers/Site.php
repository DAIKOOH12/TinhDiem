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
		echo "Xin chào";
		$data["dsmon"]=$this->Msite->get_dsmon();
		$this->load->view("form_multiple",$data);
	}

	public function addMonHoc(){
		$this->showArr($this->input->post());
		$monhoc['idMon']=$this->input->post('mamon');
		$monhoc['sTenMon']=$this->input->post('tenmon');
		$this->Msite->insert_mon($monhoc);
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

	public function themdapan()
	{
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
		$this->showArr($sheetdata);
		// $sheetcount = count($sheetdata);
		// if ($sheetcount > 1) {
		// 	$data = array();
		// 	for ($i = 1; $i < $sheetcount; $i++) {
		// 		$stt = $sheetdata[$i][0];
		// 		$dapan = $sheetdata[$i][1];
		// 		$noidung = $sheetdata[$i][2];
		// 		$macau = $sheetdata[$i][3];
		// 		$data[] = array(
		// 			'STT' => $stt,
		// 			'sMaDe' => $made,
		// 			'DapAn' => $dapan,
		// 			'NoiDung' => $noidung,
		// 			'sMaCau' => $macau
		// 		);
		// 	}
		// 	// $this->showArr($data);
		// 	$this->Msite->insert_data($data);
		// }
	}
	public function showArr($arr)
	{
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
}
