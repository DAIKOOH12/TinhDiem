<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
require FCPATH . 'vendor/autoload.php';

class CPhieuTraLoi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('');
	}

	public function index() {
		
		$this->load->model("MPhieuTraLoi");
		$this->MPhieuTraLoi->import();
	}

	public function upload_files()
	{
		// file_put_contents("E:\\xampp\htdocs\TinhDiem\check.json", json_encode($_FILES));
		if (!empty($_FILES)) {
			$config['upload_path'] = "./assets/uploadSV";
			$config['allowed_types'] = 'xlsx';

			$this->load->library('upload');

			$files           = $_FILES;

			$number_of_files = count($_FILES['file']['name']);
			// file_put_contents("E:\\xampp\htdocs\TinhDiem\check.json", $number_of_files);

			$errors = 0;

			// codeigniter upload just support one file
			// to upload. so we need a litte trick
			for ($i = 0; $i < $number_of_files; $i++) {
				$_FILES['file']['name'] = $files['file']['name'][$i];
				$_FILES['file']['type'] = $files['file']['type'][$i];
				$_FILES['file']['tmp_name'] = $files['file']['tmp_name'][$i];
				$_FILES['file']['error'] = $files['file']['error'][$i];
				$_FILES['file']['size'] = $files['file']['size'][$i];

				// we have to initialize before upload
				$this->upload->initialize($config);

				if (!$this->upload->do_upload("file")) {
					$errors++;
				}
			}


			if ($errors > 0) {
				// echo $errors . "File(s) cannot be uploaded";
				header('Content-Type: application/json');
				echo json_encode(['error' => $errors . " file(s) cannot be uploaded"]);
				exit;
			} else {
				$this->listFiles();
			}
		} else {
			$this->listFiles();
		}
	}


	public function listFiles()
	{
		$this->load->helper('file');
		$files = get_filenames("./assets/uploadSV");
		// header('Content-Type: application/json');
		// file_put_contents('E:\xampp\htdocs\tinhdiem\result.json', json_encode($files));
		echo json_encode($files);
		exit;
	}

	public function removeFile()
	{
		$file_to_remove = $this->input->post("file_to_remove");
		unlink("./assets/uploadSV/" . $file_to_remove);
	}

	
}
