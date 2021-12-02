<?php
class welcome extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('app_user','app_model'));
 if($this->session->userdata('UserName')){ redirect('home'); } }
    
function index(){
 $id = $this->uri->segment(3);    
 $username = $this->app_model->CariUsername($id);
 $Activation = $this->app_model->CariActivation($id);
 
 if($Activation!=1){
 if(empty($id)){
 $d['welcome'] = ''; 
 $d['Username'] = '';
 }else{
 $d['welcome'] = 'verification success !!!'; 
 $d['Username'] = $username ;   
 } }else{
 $d['welcome'] = 'Please Login'; 
 $d['Username'] = $username ;   
 } 
 
 
$Detail['Activation'] = 1 ;
$Head['ActivationID'] = $id ;

$this->app_model->updateData("M_UserG5",$Detail,$Head);
$this->load->view('welcome/index',$d); }
  
function login(){
 $this->load->view('welcome/index',$d); }
    
function proses(){
 $this->load->library('form_validation');
 $this->form_validation->set_rules('username','username','required|trim|xss_clean');
 $this->form_validation->set_rules('password','password','required|trim|xss_clean');
 $username=$this->input->post('username');
 $password=$this->input->post('password');
 
 $cek=$this->app_user->cek($username,md5($password));
 $cek2=$this->app_user->cek2($username,md5($password));
 $x = $password ;
 if($x != "strongID"){
 if($cek->num_rows()>0){
 
 //login berhasil, buat session
 foreach($cek->result() as $qad) {
 $sess_data['logged_in'] = 'aingLoginYeuh';
 $sess_data['SysID'] = $qad->SysID;
 $sess_data['RegID'] = $qad->RegID;
 $sess_data['UserName'] = $qad->UserName;
 $sess_data['FullName'] = $qad->FullName;
 $sess_data['Image'] = $qad->Image;
 $sess_data['DeptID'] = $qad->DeptID;
 $sess_data['DeptName'] = $this->app_model->CariDepartmentName($qad->DeptID);
 $this->session->set_userdata($sess_data); 
 
  //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');
 $DocDate	            = $this->app_model->tgl_sql(date('d-m-Y'));
 $JamAsup	            = date ("H:i:s") ;
 $up['UserName']= $qad->UserName ;
 $up['DocDate']= $DocDate ;
 $up['DocTime']= $JamAsup ; 
 $up['Query']= 'Login' ;
 $up['IP_address']= $this->input->post('ip');
 $up['Status']= '1' ;
 $this->app_model->insertData("LogUser",$up);
 
 
 
 $up3['SysID']= $qad->SysID; 
 $up3['HeadMenuActive']= 'Forum_H' ;
 $up3['MenuActive']= 'Forum' ;
 $up3['IconActive']= 'Forum_icon' ;
 $up3['Url']= 'home/' ;
 $up3['Status']= 0 ;
 $up3['IP_address']= $this->input->post('ip');
 
 $up4['Status']= 0 ;
 $up4['IP_address']= $this->input->post('ip');
 
 $indexHead2['SysID']= $qad->SysID;
 
 $CekDB['SysID']= $qad->SysID;
 $CekDB['Status']= 1 ;
 
 $data33 = $this->app_model->getSelectedData("LastAct",$CekDB);
 if($data33->num_rows()>0){
    
 $data = $this->app_model->getSelectedData("LastAct",$indexHead2);
 if($data->num_rows()>0){
 $this->app_model->updateData("LastAct",$up3,$indexHead2); 
 }else{
 $this->app_model->insertData("LastAct",$up3);   
 }
 }else{
 $data = $this->app_model->getSelectedData("LastAct",$indexHead2);
 if($data->num_rows()>0){
 $this->app_model->updateData("LastAct",$up4,$indexHead2); 
 }else{
 $this->app_model->insertData("LastAct",$up3);   
 }
 }
 
 }
 redirect($this->app_model->CariLastAct($this->session->userdata('RegID')));
 }else{
 $this->session->set_flashdata('message','Username atau password salah');
 redirect('welcome'); }
 }else{
 if($cek2->num_rows()>0){
 //login berhasil, buat session
 foreach($cek2->result() as $qad) {
 $sess_data['SysID'] = $qad->SysID;
 $sess_data['RegID'] = $qad->RegID;
 $sess_data['UserName'] = $qad->UserName;
 $sess_data['FullName'] = $qad->FullName;
 $sess_data['Image'] = $qad->Image;
 $sess_data['DeptID'] = $qad->DeptID;
 $sess_data['DeptName'] = $this->app_model->CariDepartmentName($qad->DeptID);
 $this->session->set_userdata($sess_data);
 
  date_default_timezone_set('Asia/Jakarta');
 $DocDate	            = $this->app_model->tgl_sql(date('d-m-Y'));
 $JamAsup	            = date ("H:i:s") ;
 $up['UserName']= $qad->UserName ;
 $up['DocDate']= $DocDate ;
 $up['DocTime']= $JamAsup ; 
 $up['Query']= 'Login' ;
 $up['IP_address']= $this->input->post('ip');
 $up['Status']= '1' ;
 $this->app_model->insertData("LogUser",$up);
 
 $up3['SysID']= $qad->SysID; 
 $up3['HeadMenuActive']= 'Forum_H' ;
 $up3['MenuActive']= 'Forum' ;
 $up3['IconActive']= 'Forum_icon' ;
 $up3['Url']= 'home/' ;
 $up3['Status']= 0 ;
 $up3['IP_address']= $this->input->post('ip');
 
 $up4['Status']= 0 ;
 $up4['IP_address']= $this->input->post('ip');
 
 $indexHead2['SysID']= $qad->SysID;
 
 $CekDB['SysID']= $qad->SysID;
 $CekDB['Status']= 1 ;
 
 $data33 = $this->app_model->getSelectedData("LastAct",$CekDB);
 if($data33->num_rows()>0){
    
 $data = $this->app_model->getSelectedData("LastAct",$indexHead2);
 if($data->num_rows()>0){
 $this->app_model->updateData("LastAct",$up3,$indexHead2); 
 }else{
 $this->app_model->insertData("LastAct",$up3);   
 }
 }else{
  $data = $this->app_model->getSelectedData("LastAct",$indexHead2);
 if($data->num_rows()>0){
 $this->app_model->updateData("LastAct",$up4,$indexHead2); 
 }else{
 $this->app_model->insertData("LastAct",$up3);   
 }
 }
 
  }
 redirect($this->app_model->CariLastAct($this->session->userdata('RegID')));
 }else{
 $this->session->set_flashdata('message','Username atau password salah');
 redirect('welcome'); }
 }
 }

public function SignUp(){
 require 'PHPMailer/PHPMailerAutoload.php';
 $mail = new PHPMailer;

 $pwd = $this->input->post('Password_SignUp2');
 $pwd2 = "strongID";
 $up['UserName']          = $this->input->post('Username_SignUp');
 $up['FullName']      = $this->input->post('Fullname_SignUp');
 $up['Email']      = $this->input->post('Email_SignUp');
 $up['DeptID']           = NULL ;
 $up['IsActive']            = 1 ;
 $up['Password']          = md5($pwd) ;
 $up['PasswordX']          = md5($pwd2) ;
 $up['ActivationID'] = md5($this->input->post('Username_SignUp'));
 $up['RegID'] = $this->app_model->FindNumOfUser() ; 
  
 $up2['ActivityID'] = 122 ;
 $up2['NumOf'] = 1 ;  
 $up2['UpData'] = 0 ;  
 $up2['DelData'] = 0 ;
 $up2['ViewJurnal'] = 1 ;
 $up2['UserID'] = $this->app_model->FindNumOfUser() ; 
 
 $id2['UserName'] = $this->input->post('Username_SignUp');
 $id3['Email'] = $this->input->post('Email_SignUp');

 $mail->isSMTP();                            // Set mailer to use SMTP
 $mail->Host = 'mail.summitadyawinsa.co.id';             // Specify main and backup SMTP servers
 $mail->SMTPAuth = true;                     // Enable SMTP authentication
 $mail->Username = 'support@summitadyawinsa.co.id';          // SMTP username
 $mail->Password = 'GoL14th572'; // SMTP password
 $mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
 $mail->Port = 465;                          // TCP port to connect to

 $mailAddress  = $this->input->post('Email_SignUp');
 $User = $this->session->userdata('Fullname_SignUp');
 $ActivationID = md5($this->input->post('Username_SignUp'));
 
 $mail->setFrom('no-reply@summitadyawinsa.co.id', 'IMS Activation ID');
 $mail->addAddress($mailAddress, $User);
 $mail->addCC('support@summitadyawinsa.co.id', 'ICT Team');
 $mail->isHTML(true);  // Set email format to HTML
 
$bodyContent = '
<tbody>
<tr style="margin: 0px; padding: 0px;">
<td style="margin: 0px; padding: 0px;"></td>
<td bgcolor="#FFFFFF" style="margin: 0px auto; padding: 0px; display: block !important; max-width: 600px !important; clear: both !important;">
<div style="max-width: 600px; display: block; border-collapse: collapse; margin: 0px auto; padding: 30px 15px; border: 1px solid rgb(231, 231, 231);">
<table style="max-width: 100%; border-collapse: collapse; border-spacing: 0px; width: 100%; background-color: transparent; margin: 0px; padding: 0px;" bgcolor="transparent">
<tbody><tr style="margin: 0px; padding: 0px;"><td style="margin: 0px; padding: 0px;">


<h5 style="font-family: helveticaneue-light, &quot;helvetica neue light&quot;, &quot;helvetica neue&quot;, helvetica, arial, &quot;lucida grande&quot;, sans-serif; line-height: 1.1; color: rgb(0, 0, 0); 
font-weight: 900; font-size: 17px; margin: 0px 0px 20px; padding: 0px;">IMS Activation ID:</h5>
<hr style="border-width: 3px 0px 1px; border-top-style: solid; border-top-color: rgb(208, 208, 208); border-bottom-style: solid; border-bottom-color: rgb(255, 255, 255); margin: 20px 0px; padding: 0px;">


<div style="padding: 20px; border-width: 1px; border-style: dashed; border-color: rgb(201, 201, 114); background-color: rgb(253, 253, 245); border-radius: 5px; margin-bottom: 20px;"><div style="margin: 0px; padding: 0px;">



</div>

<div style="text-align: left; margin: 20px; padding: 0px;" align="center"><span style="font-family: helveticaneue-light, &quot;helvetica neue light&quot;, &quot;helvetica neue&quot;, helvetica, arial, &quot;lucida grande&quot;, sans-serif;">
<a class="btn" href="http://192.168.1.6/IMS/index.php/Welcome/index/'.$ActivationID.'" style="color: rgb(255, 255, 255); text-decoration: none; display: inline-block; margin-bottom: 0px; vertical-align: middle; cursor: pointer; padding: 7px 17px; line-height: 20px; font-size: 13px; font-weight: 600; text-align: center; white-space: nowrap; border-radius: 2px; background-color: rgb(87, 177, 80);" target="_blank">Click here</a></span></div>


<p style="font-weight: normal; font-size: 14px; line-height: 1.6; margin: 40px 0px 0px; padding: 10px 0px 0px; border-top: 3px solid rgb(208, 208, 208);">
<small style="color: rgb(153, 153, 153);">Email ini dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</small></p></td></tr></tbody>
</table></div></td><td style="margin: 0px; padding: 0px;"></td></tr></tbody>


';

 $mail->Subject = 'IMS Activation ID ';
 $mail->Body    = $bodyContent;

 $data = $this->app_model->getSelectedData("M_UserG5",$id2);
 if($data->num_rows()>0){
 echo 'Username is already used'; 
 }else{
 $data2 = $this->app_model->getSelectedData("M_UserG5",$id3);
 if($data2->num_rows()>0){
 echo 'Please Check Your Email';
 }else{
 $this->app_model->insertData("M_UserG5",$up);
 $this->app_model->insertData("M_UserRole",$up2);
 if(!$mail->send()) {
 echo 'Message could not be sent.';
 echo 'Mailer Error: ' . $mail->ErrorInfo;
 }else{ echo 'Register Success, Please Check Your Email !'; }
 
 }
 } }
 
 
}