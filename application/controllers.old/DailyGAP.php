<?php
class DailyGAP extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('DailyGAP_model','app_model'));
 $this->load->library(array('form_validation','template'));
}
    
function index(){
 $d['title']="Home";
 $text = "SELECT * FROM M_Level ORDER BY id_level DESC" ;
 $d['l_MLevel'] = $this->app_model->manualQuery($text);
 $text2 = "SELECT * FROM M_Department ORDER BY id DESC" ;
 $d['l_MDept'] = $this->app_model->manualQuery($text2);
 $text3 = "SELECT * FROM M_DetailStatus ORDER BY RegID DESC" ;
 $d['l_MDetailStatus'] = $this->app_model->manualQuery($text3);
 
 //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$DocDate	            = date('d-m-Y');
$d['DocDateReport_2']= date('d-m-Y');
$d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
$d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
$d['DocDateReport_2']= $DocDate ;

$this->template->display('DailyGAP/index',$d); }


public function ListProduct(){
 $id = $this->app_model->tgl_sql($this->input->post('id'));
 $DB =$this->DailyGAP_model->MasterList($id);
 $data['list']=$DB->result();
 $this->load->view('DailyGAP/master_list',$data); }
 
public function ExportList(){
  //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$DocDate_now	            = date('d-m-Y h:m');

 $UserDownloadX = $this->session->userdata('nama_lengkap');
 if(empty($UserDownloadX)){$data['UserDownload'] = 'Guest';}else{$data['UserDownload'] = $UserDownloadX ;}
 $id = $this->app_model->tgl_sql($this->uri->segment(3));
 $DB =$this->DailyGAP_model->MasterList($id);
 $data['DocDate']= $this->uri->segment(3);
 $data['DocDate_now']= $DocDate_now ;
 $data['list']= $DB->result();
 $data['num']= $DB->num_rows();
 $this->load->view('DailyGAP/ExportList',$data); }
    
public function SendMailGAP(){
 require 'PHPMailer/PHPMailerAutoload.php';
 $mail = new PHPMailer;
 
 $mail->isSMTP(); 
 $mail->Host = 'mail.summitadyawinsa.co.id'; 
 $mail->SMTPAuth = true; 
 $mail->Username = 'support@summitadyawinsa.co.id'; 
 $mail->Password = 'GoL14th572'; 
 $mail->SMTPSecure = 'ssl'; 
 $mail->Port = 465 ; 

 $recipients = array(
   'fauziah.fajrin@summitadyawinsa.co.id' => 'Fauziah Fajrin',
   'aji.sanjaya@summitadyawinsa.co.id' => 'Aji Sanjaya',
   'support@summitadyawinsa.co.id' => 'ICT Support'
);

 $DocDate = $this->input->post('id');
 $DocDate_sql = $this->app_model->tgl_sql($this->input->post('id'));
 $mail->setFrom('aji.sanjaya@summitadyawinsa.co.id', 'Daily GAP '.$DocDate.'');
 $mail->addAddress('report-sales@summitadyawinsa.co.id', 'Report Sales');
 foreach($recipients as $email => $name)
 {$mail->AddCC($email, $name); }
 $mail->isHTML(true);
 
 $bodyContent = '
<tbody>
<tr style="margin: 0px; padding: 0px;">
<td style="margin: 0px; padding: 0px;"></td>
<td bgcolor="#FFFFFF" style="margin: 0px auto; padding: 0px; display: block !important; max-width: 600px !important; clear: both !important;">
<div style="max-width: 600px; display: block; border-collapse: collapse; margin: 0px auto; padding: 30px 15px; border: 1px solid rgb(231, 231, 231);">
<table style="max-width: 100%; border-collapse: collapse; border-spacing: 0px; width: 100%; background-color: transparent; margin: 0px; padding: 0px;" bgcolor="transparent">
<tbody><tr style="margin: 0px; padding: 0px;"><td style="margin: 0px; padding: 0px;">
<h5 style="font-family: helveticaneue-light, &quot;helvetica neue light&quot;, &quot;helvetica neue&quot;, helvetica, arial, &quot;lucida grande&quot;, sans-serif; line-height: 1.1; color: rgb(0, 0, 0); 
font-weight: 900; font-size: 17px; margin: 0px 0px 20px; padding: 0px;">Daily GAP:</h5>
<hr style="border-width: 3px 0px 1px; border-top-style: solid; border-top-color: rgb(208, 208, 208); border-bottom-style: solid; border-bottom-color: rgb(255, 255, 255); margin: 20px 0px; padding: 0px;">
<div style="padding: 20px; border-width: 1px; border-style: dashed; border-color: rgb(201, 201, 114); background-color: rgb(253, 253, 245); border-radius: 5px; margin-bottom: 20px;"><div style="margin: 0px; padding: 0px;">
</div>
<div style="text-align: left; margin: 20px; padding: 0px;" align="center"><span style="font-family: helveticaneue-light, &quot;helvetica neue light&quot;, &quot;helvetica neue&quot;, helvetica, arial, &quot;lucida grande&quot;, sans-serif;">
<a class="btn" href="http://192.168.1.6/IMS/index.php/DailyGAP/ExportList/'.$DocDate.'" style="color: rgb(255, 255, 255); text-decoration: none; display: inline-block; margin-bottom: 0px; vertical-align: middle; cursor: pointer; padding: 7px 17px; line-height: 20px; font-size: 13px; font-weight: 600; text-align: center; white-space: nowrap; border-radius: 2px; background-color: rgb(87, 177, 80);" target="_blank">Download GAP</a></span>
<span style="font-family: helveticaneue-light, &quot;helvetica neue light&quot;, &quot;helvetica neue&quot;, helvetica, arial, &quot;lucida grande&quot;, sans-serif;">
<a class="btn" href="http://192.168.1.6/IMS/" style="color: rgb(255, 255, 255); text-decoration: none; display: inline-block; margin-bottom: 0px; vertical-align: middle; cursor: pointer; padding: 7px 17px; line-height: 20px; font-size: 13px; font-weight: 600; text-align: center; white-space: nowrap; border-radius: 2px; background-color: rgb(17, 177, 10);" target="_blank">Login IMS</a></span></div>
<p style="font-weight: normal; font-size: 14px; line-height: 1.6; margin: 40px 0px 0px; padding: 10px 0px 0px; border-top: 3px solid rgb(208, 208, 208);">
<small style="color: rgb(153, 153, 153);">Data Yang di download akan selalu update sesuai jam saat anda mendownload. <em>IMS 2017</em></small></p></td></tr></tbody>
</table></div></td><td style="margin: 0px; padding: 0px;"></td></tr></tbody>
';

 $mail->Subject = 'Daily GAP '.$DocDate.'';
 $mail->Body    = $bodyContent;
 
 $up['SysID'] = 1 ; 
 $up['Description'] = 'DailyGAP' ;
 $up['DocDate'] = $DocDate_sql ; 
 $up['Status'] = 1 ;
 $id['SysID']= 1 ;
 $id['DocDate'] = $DocDate_sql ;
 
 $data = $this->app_model->getSelectedData("ActionButton",$id);
 if($data->num_rows()>0){
 echo 'Send GAP Already !';
 }else{
 $this->app_model->insertData("ActionButton",$up);   
 if(!$mail->send()) {
 echo 'Message could not be sent.';
 echo 'Mailer Error: ' . $mail->ErrorInfo;
 }else{ echo 'Send GAP Success !'; }
 }
 
 }

function CheckStatusDailyGAP(){
 $id = $this->app_model->tgl_sql($this->input->post('id'));
 $id_2 = '1' ;
 $text = "SELECT * FROM ActionButton WHERE SysID='$id_2' AND DocDate='$id'";
 $tabel = $this->app_model->manualQuery($text);
 $row = $tabel->num_rows();
 if($row>0){
 foreach($tabel->result() as $t){
 $data['Status'] = $t->Status;
 echo json_encode($data);
 }
 }else{
 $data['Status'] = '0';
 echo json_encode($data);			 
 }
 }            
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); } 
     
}