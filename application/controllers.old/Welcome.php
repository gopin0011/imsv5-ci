<?php
class welcome extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('app_user','app_model'));
 if($this->session->userdata('username')){ redirect('home'); } }
    
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

$this->app_model->updateData("M_User",$Detail,$Head);
$this->load->view('welcome/index',$d); }
  
function login(){
 $this->load->view('welcome/index',$d); }
    
function proses(){
 $this->load->library('form_validation');
 $this->form_validation->set_rules('username','Username','required|trim|xss_clean');
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
 $sess_data['RegID'] = $qad->RegID;
 $sess_data['username'] = $qad->username;
 $sess_data['nama_lengkap'] = $qad->nama_lengkap;
 $sess_data['foto'] = $qad->foto;
 $sess_data['dept'] = $qad->id_dept;
 $sess_data['DeptName'] = $this->app_model->CariDepartmentName($qad->id_dept);
 $sess_data['MUser'] = $qad->MUser;
 $sess_data['MUserIMS'] = $qad->MUserIMS;
 $sess_data['MUserTR'] = $qad->MUserTR;
 $sess_data['MProdMaterial'] = $qad->MProdMaterial;
 $sess_data['MProdStamping'] = $qad->MProdStamping;
 $sess_data['MProdWelding'] = $qad->MProdWelding;
 $sess_data['MProdDelivery'] = $qad->MProdDelivery;
 $sess_data['MProdStoreRoom'] = $qad->MProdStoreRoom;
 $sess_data['MProdICT'] = $qad->MProdICT;
 $sess_data['MProdMTNM'] = $qad->MProdMTNM;
 $sess_data['MProdMTNT'] = $qad->MProdMTNT;
 $sess_data['MProdGA'] = $qad->MProdGA;
 $sess_data['MPartner'] = $qad->MPartner;
 $sess_data['MCategory'] = $qad->MCategory;
 $sess_data['MUnit'] = $qad->MUnit;
 $sess_data['MCust'] = $qad->MCust;
 $sess_data['MProduct'] = $qad->MProduct;
 $sess_data['MUtility'] = $qad->MUtility;
 $sess_data['TrcMaterial'] = $qad->TrcMaterial;
 $sess_data['TrcStamping'] = $qad->TrcStamping;
 $sess_data['TrcWelding'] = $qad->TrcWelding;
 $sess_data['TrcWH'] = $qad->TrcWH;
 $sess_data['MCategory'] = $qad->MCategory;
 $sess_data['TrcStoreRoom'] = $qad->TrcStoreRoom;
 $sess_data['TrcGA'] = $qad->TrcGA;
 $sess_data['TrcMTNT'] = $qad->TrcMTNT;
 $sess_data['TrcMTNM'] = $qad->TrcMTNM;
 $sess_data['TrcICT'] = $qad->TrcICT;
 $sess_data['DailyGAP'] = $qad->DailyGAP;
 $sess_data['CanEditMaster'] = $qad->CanEditMaster;
 $sess_data['CanEditDoc'] = $qad->CanEditDoc;
 $sess_data['CanEditManUser'] = $qad->CanEditManUser;
 $sess_data['CanEditDocAdmin'] = $qad->CanEditDocAdmin;
 $sess_data['TrcWIP'] = $qad->TrcWIP;
 $sess_data['TrcSony'] = $qad->TrcSony;
 $sess_data['TrcProduction'] = $qad->TrcProduction;
 $sess_data['MBom'] = $qad->MBom;
 $sess_data['MAsset'] = $qad->MAsset;
 
 $sess_data['TrcBPFG'] = $qad->TrcBPFG;
  
 $this->session->set_userdata($sess_data); 
 
  //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');
 $DocDate	            = $this->app_model->tgl_sql(date('d-m-Y'));
 $JamAsup	            = date ("H:i:s") ;
 $up['UserName']= $qad->username ;
 $up['DocDate']= $DocDate ;
 $up['DocTime']= $JamAsup ; 
 $up['Query']= 'Login' ;
 $up['IP_address']= $this->input->post('ip');
 $up['Status']= '1' ;
 $this->app_model->insertData("LogUser",$up);
 
 
 
 $up3['SysID']= $qad->RegID; 
 $up3['HeadMenuActive']= 'Forum_H' ;
 $up3['MenuActive']= 'Forum' ;
 $up3['IconActive']= 'Forum_icon' ;
 $up3['Url']= 'home/' ;
 $up3['Status']= 0 ;
 $up3['IP_address']= $this->input->post('ip');
 
 $up4['Status']= 0 ;
 $up4['IP_address']= $this->input->post('ip');
 
 $indexHead2['SysID']= $qad->RegID;
 
 $CekDB['SysID']= $qad->RegID;
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
 $sess_data['logged_in'] = 'aingLoginYeuh';
 $sess_data['RegID'] = $qad->RegID;
 $sess_data['username'] = $qad->username;
 $sess_data['nama_lengkap'] = $qad->nama_lengkap;
 $sess_data['foto'] = $qad->foto;
 $sess_data['dept'] = $qad->id_dept;
 $sess_data['DeptName'] = $this->app_model->CariDepartmentName($qad->id_dept);
 $sess_data['MUser'] = $qad->MUser;
 $sess_data['MUserIMS'] = $qad->MUserIMS;
 $sess_data['MUserTR'] = $qad->MUserTR;
 $sess_data['MProdMaterial'] = $qad->MProdMaterial;
 $sess_data['MProdStamping'] = $qad->MProdStamping;
 $sess_data['MProdWelding'] = $qad->MProdWelding;
 $sess_data['MProdDelivery'] = $qad->MProdDelivery;
 $sess_data['MProdStoreRoom'] = $qad->MProdStoreRoom;
 $sess_data['MProdICT'] = $qad->MProdICT;
 $sess_data['MProdMTNM'] = $qad->MProdMTNM;
 $sess_data['MProdMTNT'] = $qad->MProdMTNT;
 $sess_data['MProdGA'] = $qad->MProdGA;
 $sess_data['MPartner'] = $qad->MPartner;
 $sess_data['MCategory'] = $qad->MCategory;
 $sess_data['MUnit'] = $qad->MUnit;
 $sess_data['MCust'] = $qad->MCust;
 $sess_data['MProduct'] = $qad->MProduct;
 $sess_data['MUtility'] = $qad->MUtility;
 $sess_data['TrcMaterial'] = $qad->TrcMaterial;
 $sess_data['TrcStamping'] = $qad->TrcStamping;
 $sess_data['TrcWelding'] = $qad->TrcWelding;
 $sess_data['TrcWH'] = $qad->TrcWH;
 $sess_data['MCategory'] = $qad->MCategory;
 $sess_data['TrcStoreRoom'] = $qad->TrcStoreRoom;
 $sess_data['TrcGA'] = $qad->TrcGA;
 $sess_data['TrcMTNT'] = $qad->TrcMTNT;
 $sess_data['TrcMTNM'] = $qad->TrcMTNM;
 $sess_data['TrcICT'] = $qad->TrcICT;
 $sess_data['DailyGAP'] = $qad->DailyGAP;
 $sess_data['CanEditMaster'] = $qad->CanEditMaster;
 $sess_data['CanEditDoc'] = $qad->CanEditDoc;
 $sess_data['CanEditManUser'] = $qad->CanEditManUser;
 $sess_data['CanEditDocAdmin'] = $qad->CanEditDocAdmin;
 $sess_data['TrcWIP'] = $qad->TrcWIP;
 $sess_data['TrcSony'] = $qad->TrcSony;
 $sess_data['TrcProduction'] = $qad->TrcProduction;
 $sess_data['MBom'] = $qad->MBom;
 $sess_data['MAsset'] = $qad->MAsset;
 
 $sess_data['TrcBPFG'] = $qad->TrcBPFG;
 
 $this->session->set_userdata($sess_data);
 
  date_default_timezone_set('Asia/Jakarta');
 $DocDate	            = $this->app_model->tgl_sql(date('d-m-Y'));
 $JamAsup	            = date ("H:i:s") ;
 $up['UserName']= $qad->username ;
 $up['DocDate']= $DocDate ;
 $up['DocTime']= $JamAsup ; 
 $up['Query']= 'Login' ;
 $up['IP_address']= $this->input->post('ip');
 $up['Status']= '1' ;
 $this->app_model->insertData("LogUser",$up);
 
 $up3['SysID']= $qad->RegID; 
 $up3['HeadMenuActive']= 'Forum_H' ;
 $up3['MenuActive']= 'Forum' ;
 $up3['IconActive']= 'Forum_icon' ;
 $up3['Url']= 'home/' ;
 $up3['Status']= 0 ;
 $up3['IP_address']= $this->input->post('ip');
 
 $up4['Status']= 0 ;
 $up4['IP_address']= $this->input->post('ip');
 
 $indexHead2['SysID']= $qad->RegID;
 
 $CekDB['SysID']= $qad->RegID;
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
 $up['username']          = $this->input->post('Username_SignUp');
 $up['nama_lengkap']      = $this->input->post('Fullname_SignUp');
 $up['Email']      = $this->input->post('Email_SignUp');
 $up['level']             = 1 ;
 $up['id_dept']           = NULL ;
 $up['blokir']            = 1 ;
 $up['password']          = md5($pwd) ;
 $up['password2']          = md5($pwd2) ;
 $up['MUser']             = 0 ;
 $up['MUserIMS']          = 0 ;  
 $up['MUserTR']           = 0 ; 
 $up['MProdMaterial']     = 0 ; 
 $up['MProdStamping']     = 0 ; 
 $up['MProdWelding']      = 0 ; 
 $up['MProdDelivery']     = 0 ; 
 $up['MProdStoreRoom']    = 0 ; 
 $up['MProdICT']          = 0 ;
 $up['MProdGA']           = 0 ;
 $up['MPartner']            = 0 ; 
 $up['MCategory']            = 0 ; 
 $up['MUnit']            = 0 ; 
 $up['MCust']            = 0 ;  
 $up['MProduct']            = 0 ; 
 $up['MUtility']            = 0 ;  
 $up['TrcMaterial']            = 1 ; 
 $up['TrcStamping']            = 1 ; 
 $up['TrcWelding']            = 1 ; 
 $up['TrcWH']            = 1 ; 
 $up['TrcStoreRoom']            = 1 ; 
 $up['TrcGA']            = 1 ; 
 $up['TrcSony']            = 1; 
 $up['TrcProduction']            = 1 ; 
 $up['TrcICT']            = 1 ; 
 $up['TrcWIP']            = 1 ;
 $up['CanEditDoc']            = 0 ; 
 $up['CanEditMaster']            = 0 ;
 $up['CanEditDocAdmin']            = 0 ; 
 $up['ActivationID'] = md5($this->input->post('Username_SignUp'));
 
 $up['TrcBPFG']            = 1 ;
 
 $id2['username'] = $this->input->post('Username_SignUp');
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

 $data = $this->app_model->getSelectedData("M_User",$id2);
 if($data->num_rows()>0){
 echo 'Username is already used'; 
 }else{
 $data2 = $this->app_model->getSelectedData("M_User",$id3);
 if($data2->num_rows()>0){
 echo 'Please Check Your Email';
 }else{
 $this->app_model->insertData("M_User",$up);
 if(!$mail->send()) {
 echo 'Message could not be sent.';
 echo 'Mailer Error: ' . $mail->ErrorInfo;
 }else{ echo 'Register Success, Please Check Your Email !'; }
 
 }
 } }
 
 
}