<?php
class home extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('forums','app_user'));
 $this->load->library(array('form_validation','template'));
 if(!$this->session->userdata('UserName')){ redirect('welcome'); } }
    
function index(){
 $d['title']="Home";
 

 $this->template->display('home/index',$d); }
    
function data_detail(){
 $data['title']="forums";
 $data['forums']=$this->forums->forums()->result();
 $this->load->view('home/view',$data); }

public function ViewComment(){ 
 $id = $this->input->post('kode');
 $d['list']=$this->forums->ViewComment($id)->result();
 $this->load->view('home/view2',$d); }
 
 
function simpan(){
 require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'mail.summitadyawinsa.co.id';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'support@summitadyawinsa.co.id';          // SMTP username
$mail->Password = 'GoL14th572'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                          // TCP port to connect to

$mailAddress  = $this->input->post('Email');
$User = $this->session->userdata('UserName');
$Comment = $this->input->post('coment');

$mail->setFrom('no-reply@summitadyawinsa.co.id', 'IMS Notif');
$mail->addAddress('aji.sanjaya@summitadyawinsa.co.id', 'Administrator');
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
font-weight: 900; font-size: 17px; margin: 0px 0px 20px; padding: 0px;">Info:</h5>
<hr style="border-width: 3px 0px 1px; border-top-style: solid; border-top-color: rgb(208, 208, 208); border-bottom-style: solid; border-bottom-color: rgb(255, 255, 255); margin: 20px 0px; padding: 0px;">


<div style="padding: 20px; border-width: 1px; border-style: dashed; border-color: rgb(201, 201, 114); background-color: rgb(253, 253, 245); border-radius: 5px; margin-bottom: 20px;"><div style="margin: 0px; padding: 0px;">


<div style="margin: 0px 0px 20px; padding: 0px;">
<table style="width: 100%; max-width: 100%; border-collapse: collapse; border-spacing: 0px; background-color: transparent; margin: 5px 0px; padding: 0px;" bgcolor="transparent">
<tbody style="margin: 0px; padding: 0px;">
<tr style="margin: 0px; padding: 0px;">
<td style="font-family: helveticaneue-light, &quot;helvetica neue light&quot;, &quot;helvetica neue&quot;, helvetica, arial, &quot;lucida grande&quot;, sans-serif;width: 50%; font-size: 13px; vertical-align: top; line-height: 18px; margin: 0px; padding: 0px 10px 0px 0px;" valign="top">'.$User.' komen nih !!!</td>
<td style="font-size: 13px; vertical-align: top; line-height: 18px; margin: 0px; padding: 0px 10px 0px 0px;" valign="top">
</td>
</tr></tbody> 
</table>
<div style="border-bottom: 1px solid rgb(238, 238, 238); margin: 0px; padding: 0px;"></div>
</div>

<div style="margin: 0px 0px 20px; padding: 0px;">
<table style="width: 100%; max-width: 100%; border-collapse: collapse; border-spacing: 0px; background-color: transparent; margin: 5px 0px; padding: 0px;" bgcolor="transparent">
<tbody style="margin: 0px; padding: 0px;">
<tr style="margin: 0px; padding: 0px;">
<td style="font-family: helveticaneue-light, &quot;helvetica neue light&quot;, &quot;helvetica neue&quot;, helvetica, arial, &quot;lucida grande&quot;, sans-serif;width: 100%; font-size: 13px; vertical-align: top; line-height: 18px; margin: 0px; padding: 0px 10px 0px 0px;" valign="top">'.$Comment.'</td>
<td style="font-size: 13px; vertical-align: top; line-height: 18px; margin: 0px; padding: 0px 10px 0px 0px;" valign="top">
</td>
</tr></tbody> 
</table>
<div style="border-bottom: 1px solid rgb(238, 238, 238); margin: 0px; padding: 0px;"></div>
</div>

</div>

<div style="text-align: left; margin: 20px; padding: 0px;" align="center"><span style="font-family: helveticaneue-light, &quot;helvetica neue light&quot;, &quot;helvetica neue&quot;, helvetica, arial, &quot;lucida grande&quot;, sans-serif;">
<a class="btn" href="http://192.168.1.6:8888/IMS/" style="color: rgb(255, 255, 255); text-decoration: none; display: inline-block; margin-bottom: 0px; vertical-align: middle; cursor: pointer; padding: 7px 17px; line-height: 20px; font-size: 13px; font-weight: 600; text-align: center; white-space: nowrap; border-radius: 2px; background-color: rgb(87, 177, 80);" target="_blank">Lihat Komentar</a></span></div>


<p style="font-weight: normal; font-size: 14px; line-height: 1.6; margin: 40px 0px 0px; padding: 10px 0px 0px; border-top: 3px solid rgb(208, 208, 208);">
<small style="color: rgb(153, 153, 153);">Email ini dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</small></p></td></tr></tbody>
</table></div></td><td style="margin: 0px; padding: 0px;"></td></tr></tbody>


';

$mail->Subject = 'IMS Notif';
$mail->Body    = $bodyContent;
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');
 $DocDate	            = $this->app_model->tgl_sql(date('d-m-Y'));
 $JamAsup	            = date ("H:i:s") ;
 $up['topic']= 'IMS'; 
 $up['QtyComent']= '0';
 $up['coment']=$this->input->post('coment'); 
 $up['tgl_in']		= $DocDate ;
 $up['username']		= $this->session->userdata('UserName');
 $up['foto']		= $this->session->userdata('Image');
 $up['jam'] = $JamAsup ;
 $id['coment']=$this->input->post('coment');
 $id['username']		= $this->session->userdata('UserName');
 $id['tgl_in']		= $DocDate ;
 $id['jam'] = $JamAsup ;
$data = $this->app_model->getSelectedData("D_Comment",$id);
 if($data->num_rows()>0){
 echo 'Failed !';
 }else{
 $this->app_model->insertData("D_Comment",$up);
 if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else { echo 'Success !'; }		
		} }
 
 
function Save(){
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;

$mail->isSMTP();                            // Set mailer to use SMTP
$mail->Host = 'mail.summitadyawinsa.co.id';             // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                     // Enable SMTP authentication
$mail->Username = 'support@summitadyawinsa.co.id';          // SMTP username
$mail->Password = 'GoL14th572'; // SMTP password
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                          // TCP port to connect to

$mailAddress  = $this->input->post('Email');
$User = $this->session->userdata('UserName');
$Comment = $this->input->post('KomenX');

$mail->setFrom('no-reply@summitadyawinsa.co.id', 'IMS Notif');
$mail->addAddress('aji.sanjaya@summitadyawinsa.co.id', 'Administrator');
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
font-weight: 900; font-size: 17px; margin: 0px 0px 20px; padding: 0px;">Info:</h5>
<hr style="border-width: 3px 0px 1px; border-top-style: solid; border-top-color: rgb(208, 208, 208); border-bottom-style: solid; border-bottom-color: rgb(255, 255, 255); margin: 20px 0px; padding: 0px;">

<div style="padding: 20px; border-width: 1px; border-style: dashed; border-color: rgb(201, 201, 114); background-color: rgb(253, 253, 245); border-radius: 5px; margin-bottom: 20px;"><div style="margin: 0px; padding: 0px;">

<div style="margin: 0px 0px 20px; padding: 0px;">
<table style="width: 100%; max-width: 100%; border-collapse: collapse; border-spacing: 0px; background-color: transparent; margin: 5px 0px; padding: 0px;" bgcolor="transparent">
<tbody style="margin: 0px; padding: 0px;">
<tr style="margin: 0px; padding: 0px;">
<td style="font-family: helveticaneue-light, &quot;helvetica neue light&quot;, &quot;helvetica neue&quot;, helvetica, arial, &quot;lucida grande&quot;, sans-serif;width: 50%; font-size: 13px; vertical-align: top; line-height: 18px; margin: 0px; padding: 0px 10px 0px 0px;" valign="top">'.$User.' komen nih !!!</td>
<td style="font-size: 13px; vertical-align: top; line-height: 18px; margin: 0px; padding: 0px 10px 0px 0px;" valign="top">
</td>
</tr></tbody> 
</table>
<div style="border-bottom: 1px solid rgb(238, 238, 238); margin: 0px; padding: 0px;"></div>
</div>

<div style="margin: 0px 0px 20px; padding: 0px;">
<table style="width: 100%; max-width: 100%; border-collapse: collapse; border-spacing: 0px; background-color: transparent; margin: 5px 0px; padding: 0px;" bgcolor="transparent">
<tbody style="margin: 0px; padding: 0px;">
<tr style="margin: 0px; padding: 0px;">
<td style="font-family: helveticaneue-light, &quot;helvetica neue light&quot;, &quot;helvetica neue&quot;, helvetica, arial, &quot;lucida grande&quot;, sans-serif;width: 100%; font-size: 13px; vertical-align: top; line-height: 18px; margin: 0px; padding: 0px 10px 0px 0px;" valign="top">'.$Comment.'</td>
<td style="font-size: 13px; vertical-align: top; line-height: 18px; margin: 0px; padding: 0px 10px 0px 0px;" valign="top">
</td>
</tr></tbody> 
</table>
<div style="border-bottom: 1px solid rgb(238, 238, 238); margin: 0px; padding: 0px;"></div>
</div>

</div>

<div style="text-align: left; margin: 20px; padding: 0px;" align="center"><span style="font-family: helveticaneue-light, &quot;helvetica neue light&quot;, &quot;helvetica neue&quot;, helvetica, arial, &quot;lucida grande&quot;, sans-serif;">
<a class="btn" href="http://192.168.1.6:8888/IMS/" style="color: rgb(255, 255, 255); text-decoration: none; display: inline-block; margin-bottom: 0px; vertical-align: middle; cursor: pointer; padding: 7px 17px; line-height: 20px; font-size: 13px; font-weight: 600; text-align: center; white-space: nowrap; border-radius: 2px; background-color: rgb(87, 177, 80);" target="_blank">Lihat Komentar</a></span></div>


<p style="font-weight: normal; font-size: 14px; line-height: 1.6; margin: 40px 0px 0px; padding: 10px 0px 0px; border-top: 3px solid rgb(208, 208, 208);">
<small style="color: rgb(153, 153, 153);">Email ini dibuat secara otomatis. Mohon tidak mengirimkan balasan ke email ini.</small></p></td></tr></tbody>
</table></div></td><td style="margin: 0px; padding: 0px;"></td></tr></tbody>


';

$mail->Subject = 'IMS Notif';
$mail->Body    = $bodyContent;


          //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
 $DocDate	            = $this->app_model->tgl_sql(date('d-m-Y'));
 $JamAsup	            = date ("H:i:s") ;
            
 $up['topic']= 'IMS'; 
 $QtyComent = $this->forums->CariJumlahComent($this->input->post('IdComent'));
 $up2['QtyComent'] = $QtyComent + 1 ;
 $id2['idcoment']=$this->input->post('IdComent'); 
 $up['coment']=$this->input->post('KomenX');
 $up['idcoment_detail']=$this->input->post('IdComent'); 
 $up['tgl_in']		= $DocDate ;
 $up['username']		= $this->session->userdata('UserName');
 $up['foto']		= $this->session->userdata('Image');
 $up['jam'] = $JamAsup ;
 $id['coment']=$this->input->post('KomenX');
 $id['username']		= $this->session->userdata('UserName');
 $id['tgl_in']		= $DocDate ;
 $id['jam'] = $JamAsup ;
 
 $data = $this->app_model->getSelectedData("D_Comment",$id);
 if($data->num_rows()>0){
 echo 'Failed !';
 }else{
 $this->app_model->insertData("D_Comment",$up);
 $this->forums->updateData("D_Comment",$up2,$id2);
 if(!$mail->send()) {
 echo 'Message could not be sent.';
 echo 'Mailer Error: ' . $mail->ErrorInfo;
 }else{ echo 'Success !'; } }
 }
    
    
function _set_rules(){
 $this->form_validation->set_rules('user','username','required|trim');
 $this->form_validation->set_rules('password','password','required|trim');
 $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
    
function logout(){

  date_default_timezone_set('Asia/Jakarta');
 $DocDate	            = $this->app_model->tgl_sql(date('d-m-Y'));
 $JamAsup	            = date ("H:i:s") ;
 $up['UserName']= $this->session->userdata('UserName') ;
 $up['DocDate']= $DocDate ;
 $up['DocTime']= $JamAsup ; 
 $up['Query']= 'Logout' ;
 $up['Status']= '0' ;
 $this->app_model->insertData("LogUser",$up);
 $this->session->unset_userdata('UserName');
 $this->session->unset_userdata('SysID');
 $this->session->unset_userdata('RegID');
 
 $up3['SysID']= $this->session->userdata('SysID') ;
 $up3['Status']= 1 ;
 $indexHead['SysID']= $this->session->userdata('SysID') ;
 $this->app_model->updateData("LastAct",$up3,$indexHead);
 
 
redirect('Welcome'); }
    
function ListUser(){
 $data['title']="List User";
 $data['TotalUser'] = $this->app_user->TotalUser('1') ;
 $data['data']=$this->app_user->list_user()->result();
 $this->load->view('IMSUser/ListUser',$data); }
    
public function JumlahLike(){
 $kode = $this->input->post('code');
 $text = "SELECT * FROM D_Comment WHERE idcoment='$kode'";
 $tabel = $this->forums->manualQuery($text);
 $row = $tabel->num_rows();
 if($row>0){
 foreach($tabel->result() as $t){
 $data['QtyLike'] = $t->LikeCom;
 $data['QtyKomen'] = $t->QtyComent;
 echo json_encode($data); } }
 }
              
public function LikeAdd(){
 $code = $this->input->post('code');
 $QtyLike = $this->forums->CariJumlahLike($code);
 $up['LikeCom'] = $QtyLike + 1 ;
 $ComID['idcoment'] = $code ;
 $id['SysID'] = $code ;
 $id['UserID']	= $this->session->userdata('RegID');
 $data = $this->forums->getSelectedData("LikeCheckList",$id);
 if($data->num_rows()>0){
 echo 'Success !';     
 }else{
 $this->forums->insertData("LikeCheckList",$id);
 $this->forums->updateData("D_Comment",$up,$ComID);  
 echo 'Success Like !'; } 
 } 


function MenuActive(){
 date_default_timezone_set('Asia/Jakarta');
 $DocDate	            = $this->app_model->tgl_sql(date('d-m-Y'));
 $JamAsup	            = date ("H:i:s") ;
 $up['UserName']= $this->session->userdata('UserName') ;
 $up['DocDate']= $DocDate ;
 $up['DocTime']= $JamAsup ; 
 $up['Query']= $this->input->post('MenuActive') ;
 $up['IP_address']= $this->input->post('IPX') ;
 $up['Status']= '1' ;
 $this->app_model->insertData("LogUser",$up);
 
 $up2['SysID']= $this->session->userdata('RegID') ;
 $up2['HeadMenuActive']= $this->input->post('HeadMenuActive') ;
 $up2['MenuActive']= $this->input->post('MenuActive') ;
 $up2['IconActive']= $this->input->post('IconActive') ;
 $up2['Url']= $this->input->post('Url') ;
 $up2['IP_address']= $this->input->post('IPX') ;
 $up2['Status']= 0 ; 
 $indexHead['SysID']= $this->session->userdata('RegID') ;
  
 $data = $this->app_model->getSelectedData("LastAct",$indexHead);
 if($data->num_rows()>0){
 $this->app_model->updateData("LastAct",$up2,$indexHead); }else{
 $this->app_model->insertData("LastAct",$up2);   
 }
    
  }   
         
}