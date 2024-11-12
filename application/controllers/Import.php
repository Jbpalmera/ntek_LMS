<?php
 
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Import extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // load model
        $this->load->model('Import_model', 'import');
        $this->load->helper(array('url','html','form'));
        $this->load->library('PHPExcel.php');
        $this->load->library('form_validation');
    }    
 
    public function index() {
    }
 
    public function import_Student_File(){

      date_default_timezone_set("Asia/Manila");
      $dateToday = date('Y-m-d H:i:s', time());

      if ($this->input->post('submit')) {
                 
                $path = 'assets/uploads/studentUploads/';
                require_once APPPATH . "/libraries/PHPExcel.php";
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'xlsx|xls|csv';
                $config['remove_spaces'] = TRUE;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);            
                if (!$this->upload->do_upload('uploadFile')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = array('upload_data' => $this->upload->data());
                }
                if(empty($error)){
                  if (!empty($data['upload_data']['file_name'])) {
                    $import_xls_file = $data['upload_data']['file_name'];
                } else {
                    $import_xls_file = 0;
                }
                $inputFileName = $path . $import_xls_file;
                $latestStudentId = $this->db->select_max('StudentId')->get('tblstudents')->row()->StudentId;

                $numericPart = (int) substr($latestStudentId, 3);
                $newNumericPart = $numericPart + 1;

                $newStudentId = 'SID' . sprintf('%03d', $newNumericPart);

                try {
                    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                    $objPHPExcel = $objReader->load($inputFileName);
                    $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                    $flag = true;
                    $i=0;
                    foreach ($allDataInSheet as $value) {
                      if($flag){
                        $flag =false;
                        continue;
                      }
                      $inserdata[$i]['StudentId'] = $newStudentId;
                      $inserdata[$i]['FullName'] = $value['A'];
                      $inserdata[$i]['EmailId'] = $value['B'];
                      $inserdata[$i]['MobileNumber'] = $value['C'];
                      $inserdata[$i]['Password'] = '$2y$10$hkxVzZwwoGPkq2c3tXHIEOVo5SlN6cvEnzwev8UZHgTKjb6A31Hqi';
                      $inserdata[$i]['Status'] = 1;
                      $inserdata[$i]['RegDate'] = $dateToday;
                      $i++;
                    }               
                    $result = $this->import->importData($inserdata);   
                    if($result){
                      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Import Successful!</div>');
                        redirect('Student_controller/reg_student');
                    }else{
                      $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Import Failed!</div>');
                      redirect('Student_controller/reg_student');
                    }             
      
              } catch (Exception $e) {
                   die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                            . '": ' .$e->getMessage());
                }
              }else{
                  echo $error['error'];
                }
                 
                 
        }
        
    }
}
?>