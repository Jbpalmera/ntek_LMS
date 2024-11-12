<?php
defined('BASEPATH') OR exit ('No direct scripts allowed');

class Kiosk extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->model('BookDetails_model');
        $this->load->model('Kiosk_model');
        $this->load->model('Student_model');
    }
    public function GetBorrowedBook($bookID)
    {
        $data = $this->Kiosk_model->getIssuedBookInfo($bookID);

        if($data == NULL){
            $json_data = array(
                'accession' => null,
                'bookName' => null,
                'authorName' => null,
                'categoryName' => null,
                'issuesDate' => null,
                'expectedReturnDate' => null,
                'fullName' => null,
                'emailID' => null,
                'mobileNumber' => null
            );
        } else {
            $json_data = array(
                'accessionNumber' => $data['accessionNumber'],
                'bookName' => $data['bookName'],
                'authorName' => $data['authorName'],
                'categoryName' => $data['categoryName'],
                'issuesDate' => $data['issuesDate'],
                'expectedReturnDate' => $data['expectedReturnDate'],
                'fullName' => $data['fullName'],
                'emailID' => $data['emailID'],
                'mobileNumber' => $data['mobileNumber']
            );
        }
        
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($json_data));
    }
    public function ReturnBorrowedBook()
    {
        $json_data = file_get_contents('php://input');
        $response = json_decode($json_data, true);

        $nonExistingCodes = [];
        $existingNotIssued = [];
        $validCodes = [];

        foreach ($response['codes'] as $code) {
            $book = $this->db->get_where('tblbooks', ['isbnNumber' => $code])->row_array();
            
            if (!$book) {
                $nonExistingCodes[] = $code;
            } elseif ($book['bookStatus'] == 1) {
                $existingNotIssued[] = $code;
            } elseif ($book['bookStatus'] == 0) {
                $validCodes[] = $code;
            }
        }

        if (!empty($nonExistingCodes) || !empty($existingNotIssued)) {
            $details = array_merge($nonExistingCodes, $existingNotIssued);
            $response = [
                "message" => "Failed",
                "details" => $details
            ];
        } elseif (!empty($validCodes)) {
            foreach ($validCodes as $codes) {
                $returnStatus = [
                    "returnStatus" => 1,
                    "fine" => 2
                ];

                $id = $this->db->get_where('tblbooks', ['isbnNumber' => $codes])->row_array();
                $this->db->where('bookID', $id['id'])->update('tblissuedbookdetails', $returnStatus);

                $bookStatus = [
                    "bookStatus" => 1
                ];
                $this->db->where('isbnNumber', $codes)->update('tblbooks', $bookStatus);
            }

            if ($this->db->affected_rows() > 0) {
                $response = [
                    "message" => "Success",
                    "details" => ""
                ];
            }
        }

        return $this->output
            ->set_content_type('application/json')
            ->set_status_header(200)
            ->set_output(json_encode($response));
    }

    public function info(){
        $data = $this->Kiosk_model->getBookInfo();
        print_r(json_encode($data));
    }
    
    // KIOSK BULSU CONTROLLER
    public function GetSmallImageList()
    {
        $imgList = glob('assets/images_S/*.png');
        foreach($imgList as $filename){
        if(is_file($filename)){
            echo base_url().$filename.'|';
        }   
        }

    }
    public function GetBigImageList()
    {
        $imgList = glob('assets/images_L/*.png');
        foreach($imgList as $filename){
        if(is_file($filename)){
            echo base_url().$filename.'|';
        }   
        }

    }
    public function GetVideoList()
    {
        $imgList = glob('assets/videos/*.mp4');
        foreach($imgList as $filename){
            if(is_file($filename)){
                echo base_url().$filename.'|';
            }   
        }
    }
    // public function UserGetInfo() Old Controller Name from BulSu API
    public function OldUserGetInfo()
    {
        $code_type = $this->input->get("code_type");
        $code = $this->input->get("code");
        
        if($code_type=='QR')
            $data  =$this->db->get_where('tblstudents', ['qrcode' => $code])->row_array();
        else 
            $data  =$this->db->get_where('tblstudents', ['rfid' => $code])->row_array();
        
        if($data == NULL){
        if($code_type=='QR')
            $data  =$this->db->get_where('faculty', ['qrcode' => $code])->row_array();
        else 
            $data  =$this->db->get_where('faculty', ['rfid' => $code])->row_array();
        if($data==NULL){
            if($code_type=='QR')
            $data  =$this->db->get_where('visitor', ['qrcode' => $code])->row_array();
            else 
            $data  =$this->db->get_where('visitor', ['rfid' => $code])->row_array();
            if($data==NULL)
            $data['category'] ="null";
            else
            $data['category'] ="visitor";        
        }
        else 
            $data['category'] ="faculty";
        }
        else{
        $data['category'] ="student";
        }

        echo json_encode($data) ;   
    }
    public function UserGetInfo()
    {
        $code_type = $this->input->get("code_type");
        $code = $this->input->get('code');
        if($code_type == 'QR'){
            $data = $this->db->get_where('tblstudents',['qrcode' => $code])->row_array();

            echo json_encode($data);
        } else {
            echo "No QRcode Provided";
        }
        
    }
    public function GetUserBookAllList()
    {
        $code_type =  $this->input->get("code_type");
        $code =  $this->input->get("code");        
        
        $d = $this->db->get_where('tblbooking',['code_type'=>$code_type,'code'=>$code])->result_array();        
        if ($d != NULL )
            echo  json_encode($d);  
        else
            echo  json_encode("No Data");
    }
    public function GetAreaList() 
    {
        $floorname =  $this->input->get("floorname");
        // $this->db->select('DISTINCT(room)');
        $d = $this->db->get_where('tblarea',['floor'=>$floorname])->result_array();        
        if ($d != NULL )
            echo  json_encode($d);  
        else
            echo  json_encode("No Data");
    }
    public function TapQRPair()
    {
    date_default_timezone_set("Asia/Manila");
    $Sdate = date('Y-m-d', time());
    $date = date('Y-m-d H:i:s', time());
    $code_type = $this->input->get("code_type");    
    $code = $this->input->get("code");    
    $kiosk_id = $this->input->get("kiosk_id");            

    if($code_type == 'QR'){
        $data = $this->db->order_by('id', 'desc')->get_where('tblattend', ['qrcode' => $code,'date'=>$Sdate])->row_array();
    }else 
    {
        $data  =$this->db->order_by('id', 'desc')->get_where('tblattend', ['rfid' => $code,'date'=>$Sdate])->row_array();
    }

        if($data == NULL)
        {
        if($code_type=='QR')
            $data  =$this->db->get_where('tblstudents', ['qrcode' => $code])->row_array();
        else 
            $data  =$this->db->get_where('tblstudents', ['rfid' => $code])->row_array();

        if($data == NULL)
        {
            echo "No QR Data";
            return;
        }

        $srcode = $data['studentID'];
            $username = ($data['fullName']) ;         
            $data = array(            
            'username' => $username,
            'srcode' => $srcode,
            'qrcode' =>"",
            'RFID' =>"",          
            'kiosk' => $kiosk_id,
            'in_time' => $date,
            'date' => $Sdate
            );        
            if($code_type=='QR')
            $data['qrcode'] = $code;
            else 
            $data['RFID'] = $code;
            $this->db->insert('tblattend', $data);
            echo "time in success";
        }
        else
        {
        if(empty($data['out_time']))
        {
            $id =$data['id'];
            $queryUpdate = "UPDATE `tblattend` SET `out_time` = '$date', `kiosk` = '$kiosk_id' WHERE `id` = '$id'";
            // $queryUpdate = "UPDATE `tblattend`  SET `out_time` = '" .$date. "'   WHERE  `id` = '$id'";
            // $queryUpdate = "UPDATE `tblattend`  SET `kiosk` = '" .$kiosk_id. "'  WHERE  `id` = '$id'";
            $this->db->query($queryUpdate);
            echo "time out success";   
        }
        else
        {
            if($code_type=='QR')
            $data  =$this->db->get_where('tblstudents', ['qrcode' => $code])->row_array();
            else 
            $data  =$this->db->get_where('tblstudents', ['rfid' => $code])->row_array();

            if($data == NULL){
            echo "No QR Data";
            return;
            }

            $srcode = $data['studentID'];
            $username = ($data['fullName']) ;         
            $data = array(            
            'username' => $username,
            'srcode' => $srcode,
            'qrcode' =>"",
            'RFID' =>"",          
            'kiosk' => $kiosk_id,
            'in_time' => $date,
            'date' => $Sdate
            );        
            if($code_type=='QR')
            $data['qrcode'] = $code;
            else 
            $data['RFID'] = $code;
            $this->db->insert('tblattend', $data);
            echo "time in success";
        }
        }   
    }
    public function ReqBookSeat()
    {    
        
        // if($this->input->post("device") != null) {      
        $device = $this->input->post("device");
        $user_id = $this->input->post("user_id");
        $code_type = $this->input->post("code_type");
        $code = $this->input->post("code");        
        $floor = $this->input->post("floor"); // desired floor
        $room = $this->input->post("room");// desired room
        $slot = $this->input->post("slot");// desired slot
        $date = $this->input->post("date");  // desired date       
        $stime = $this->input->post("stime");// desired stiem
        $etime = $this->input->post("etime");// desired etime
        
        $data = array(
            'device' => $this->input->post("device"),
            'user_id' => $this->input->post("user_id"),
            'code_type' => $this->input->post("code_type"),
            'code' => $this->input->post("code"),
            'floor' => $this->input->post("floor"),
            'room' => $this->input->post("room"),
            'slot_id' => $this->input->post("slot"),
            'date' => $this->input->post("date"),
            'start_time' => $this->input->post("stime"),
            'end_time' => $this->input->post("etime"),
            'at_time' => date("Y-m-d H:i:s", strtotime("today"))
            );
            
            $this->db->insert('tblbooking', $data);
            
            $slotdata = $this->db->get_where('tblslot', ['date'=>$date,'floor' =>$floor,'room' =>$room,'slot' =>$slot])->row();
            if($slotdata != NULL){
            // echo gettype($slotdata);
            // echo json_encode($slotdata);
            //$timeslot = explode(",",$slotdata->status) ;
            $slottemp = trim($slotdata->status, "[");
            $slottemp = trim($slottemp, "]");
            //  $timeslot = explode(",",$slotdata->status) ;
            $timeslot = explode(",",$slottemp) ;
            // echo gettype($timeslot);
            //  print_r($timeslot);          
            
                if($timeslot[$stime] =='1' ){  // occupied 
                    echo "already reserved";              
                }
                else {     // vacant 
                echo "reserved successfully";
                for($i=$stime; $i<$etime; $i++)            
                    $timeslot[$i] = '1';
                $data = array(                
                    'status' => '['.implode(',',$timeslot).']'
                );              
                $this->db->where('id', $slotdata->id);
                $this->db->update('tblslot', $data);              
                }     
            }
            else {
            echo "no slot information";
            }    
    }

    public function GetFloorList() 
    {
        $this->db->select('DISTINCT(floor)');
        $d = $this->db->get('tblarea')->result_array();        
        if ($d != NULL )
            echo  json_encode($d);  
        else
            echo  json_encode("No Data");
    }
    public function GetSeatList() 
    {
        
        if(!isset($_GET['date'])){
        echo "no date";
        return;
        }else{
        $date = $this->input->get("date"); 
        }
        /*$date = date("Y-m-d", strtotime("today")); */
        $floorname =  $this->input->get("floorname");
        $roomname =  $this->input->get("roomname"); 
        $d = $this->db->get_where('tblslot',['date'=>$date,'floor'=>$floorname,'room'=>$roomname])->result_array();        
        $roominfo = $this->db->get_where('tblarea',['floor'=>$floorname,'room'=>$roomname])->row();
        
        if ($d != NULL )
            echo  json_encode($d);  
        else{      
            $slot=0;
            $data = array(
                'date' => $date,
                'floor' => $floorname,
                'room' => $roomname,
                'slot' => $slot,
                'status' => "[0,0,0,0,0,0,0,0,0,0,0]"      
            );
            
            $Max_slot=$roominfo->slotNumber;
            for ($slot=1;$slot<=$Max_slot;$slot++){
            $data['slot'] =$slot;
            $this->db->insert('tblslot', $data);
            }               
            $d = $this->db->get_where('tblslot',['date'=>$date,'floor'=>$floorname,'room'=>$roomname])->result_array();        
            echo  json_encode($d);  
        }
    }
    // KIOSK TEST
    public function getStudentInfo(){
        $rfid = $this->input->get('rfid');
        
        $info = $this->Student_model->getStudentByRfid($rfid)->row_array();
        if($info){
            $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($info));
        } else {
            $error = [
                "status" => 'Error'
            ];
            $this->output
                ->set_content_type('application/json')
                ->set_output(json_encode($error));
        }
        
    }
}