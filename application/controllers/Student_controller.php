<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Student_controller extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Student_model');
        $this->load->model('Membership_model');
        $this->load->library('form_validation');
        $this->load->library('PHPExcel');

    }
	public function index()
	{
		$this->load->view('Admin/dashboard');
	}
    public function student_list()
    {
        $data['title'] = 'Student List';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{
        
        // $data['studentInfo'] = $this->Student_model->getStudent()->result_array();
        $data['studentInfo'] = $this->Membership_model->getMembershipType()->result_array();
        $this->load->view('Templates/head', $data);
        $this->load->view('Admin/Student/student-list', $data);
        $this->load->view('Templates/foot');
        }
    }
    public function register_student()
    {
        $data['title'] = 'Register Student';
        $membership = $this->Membership_model->getMembership()->result_array();
        $exclude = 'Admin';

        $data['membership'] = array_filter($membership, function($row) use ($exclude) {
            return $row['membershipType'] !== $exclude;
        });
        
        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{
            $this->load->library('form_validation');

            $this->form_validation->set_rules('studentname', 'Student Name', 'required');
            $this->form_validation->set_rules('phonenumber', 'Phone Number', 'required');
            $this->form_validation->set_rules('membership', 'Membership', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('confirmpass', 'Confirm Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('Templates/head', $data);
            $this->load->view('Admin/Student/register-student', $data);
            $this->load->view('Templates/foot');
        }
        else 
        {
            
            $latestStudentId = $this->db->select_max('StudentId')->get('tblstudents')->row()->StudentId;

            $numericPart = (int) substr($latestStudentId, 3);
            $newNumericPart = $numericPart + 1;

            $newStudentId = 'SID' . sprintf('%03d', $newNumericPart);

            $data = array(
                'studentID' => $newStudentId,
                'fullName' => $this->input->post('studentname'),
                'mobileNumber' => $this->input->post('phonenumber'),
                'membershipID' => $this->input->post('membership'),
                'emailID' => $this->input->post('email'),
                'status' => '1',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT)
            );

            $this->db->insert('tblstudents', $data);
            $rows = $this->db->affected_rows();
            if ($rows > 0) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    An <strong> Account </strong> has been Created Successfully!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Failed to Create New Account!</div>');
            }
            redirect('Student_controller/reg_student');
        }   
        }
    }
    public function editStudent()
    {
        $data['title'] = 'Update Student';

        if (strlen($this->session->userdata('alogin')) == 0) {
            redirect('');
        }else{
            $id = $this->input->get('id');
            if($id)
            {
                // $data['student_info'] = $this->db->get_where('tblstudents', ['id' => $id])->result_array();
                $data['student_info'] = $this->Membership_model->getMembershipTypeByID($id)->row_array();
                $data['membership_category'] = $this->Membership_model->getMembership()->result_array();
                if($this->input->post()){
                    $studentName = $this->input->post('studentname');
                    $phoneNumber = $this->input->post('phonenumber');
                    $email = $this->input->post('email');
                    $membership = $this->input->post('membership');

                    $this->db->where(['id' => $id])->update('tblstudents', ['fullName' => $studentName, 'mobileNumber' => $phoneNumber, 'emailID' => $email, 'membershipID' => $membership]);

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Update Successful! </div>');
                    redirect('studentList');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Failed to Update!</div>');;
                }
                $this->load->view('Templates/head', $data);
                $this->load->view('Admin/Student/edit-student', $data);
                $this->load->view('Templates/foot');
            } else {
                echo "ID is not provided";
            }
           
        }
    }
    public function activateStudent()
    {
        $id = $this->input->get('id');
        $update = $this->db->where(['id' => $id])->update('tblstudents', ['Status' => 1]);
        if($update)
        {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> <strong> Student </strong> has been set as Active!</div>');
            redirect('studentList');
        }
    }
    public function deActivateStudent()
    {
        $id = $this->input->get('id');
        $update = $this->db->where(['id' => $id])->update('tblstudents', ['Status' => 0]);
        if($update)
        {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> <strong> Student </strong> has been <strong> Blocked! </strong> </div>');
            redirect('studentList');
        }
    }
    public function export_csv() 
    {
        require_once APPPATH.'third_party/vendor/autoload.php';
    
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    
        $spreadsheet->getProperties()->setCreator("NTEK Systems")
                                    ->setLastModifiedBy("NTEK Systems")
                                    ->setTitle("Reg Students Export")
                                    ->setSubject("Reg Students Data")
                                    ->setDescription("Exported Reg Students data");
    
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', '#')
                    ->setCellValue('B1', 'Student ID')
                    ->setCellValue('C1', 'Student Name')
                    ->setCellValue('D1', 'Email ID')
                    ->setCellValue('E1', 'Mobile Number')
                    ->setCellValue('F1', 'Reg Date')
                    ->setCellValue('G1', 'Status');
    
        $studentinfo = $this->Student_model->getStudent()->result_array();
        $row = 2;
        foreach ($studentinfo as $info) {
            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $row, $info['id'])
                        ->setCellValue('B' . $row, $info['studentID'])
                        ->setCellValue('C' . $row, $info['fullName'])
                        ->setCellValue('D' . $row, $info['emailID'])
                        ->setCellValue('E' . $row, $info['mobileNumber'])
                        ->setCellValue('F' . $row, $info['regDate'])
                        ->setCellValue('G' . $row, ($info['status'] == 1) ? 'Active' : 'Blocked');
    
            $row++;
        }
    
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment;filename="reg_students.csv"');
        header('Cache-Control: max-age=0');
    
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Csv($spreadsheet);
        $writer->setDelimiter(',');
        $writer->setEnclosure('"');
        $writer->setLineEnding("\r\n");
        $writer->setSheetIndex(0);
        $writer->save('php://output');
    
        exit;
    }
    
}