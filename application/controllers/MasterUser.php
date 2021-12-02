<?php
class MasterUser extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterUser_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->MasterUser();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif($cek==0){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 $text = "SELECT * FROM M_Level ORDER BY id_level DESC" ;
 $d['l_MLevel'] = $this->app_model->manualQuery($text);
 $text2 = "SELECT * FROM M_Department ORDER BY id DESC" ;
 $d['l_MDept'] = $this->app_model->manualQuery($text2);
 $text3 = "SELECT * FROM M_DetailStatus ORDER BY RegID DESC" ;
 $d['l_MDetailStatus'] = $this->app_model->manualQuery($text3);
 $this->template->display('MasterUser/index',$d); }

public function AddActList(){
 $Detail['DelData'] = '1' ;
 $Detail['UpData'] = '1' ;
 $Detail['RetData'] = '1' ;
 $Detail['ViewJurnal'] = '1' ;
 $Detail['ActivityID'] = $this->input->post('SysID');
 $Detail['UserID'] = $this->input->post('SysID2');
 $Detail['NumOf'] = $this->app_model->FindNumOfUserRole($this->input->post('SysID2'));
 
 $Head['ActivityID'] = $this->input->post('SysID');
 $Head['UserID'] = $this->input->post('SysID2');
 $data = $this->app_model->getSelectedData("M_UserRole",$Head);
 if($data->num_rows()>0){
 }else{
 $this->app_model->insertData("M_UserRole",$Detail);   
 }  }

public function AddUserGrpFlow(){
 $Detail['UserGroupFlow'] = $this->input->post('SysID');
 $Head['UserID'] = $this->input->post('UserID');
 $Head['NumOf'] = $this->input->post('NumOf');

 $data = $this->app_model->getSelectedData("M_UserRole",$Head);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_UserRole",$Detail,$Head);
 }  }
  
public function UpdateRoleUp(){
 $Detail['UpData'] = $this->input->post('UpDataX');
 $Head['UserID'] = $this->input->post('SysID');
 $Head['NumOf'] = $this->input->post('NumOf');

 $data = $this->app_model->getSelectedData("M_UserRole",$Head);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_UserRole",$Detail,$Head);
 }  }
 
public function UpdateRoleDel(){
 $Detail['DelData'] = $this->input->post('UpDataX');
 $Head['UserID'] = $this->input->post('SysID');
 $Head['NumOf'] = $this->input->post('NumOf');

 $data = $this->app_model->getSelectedData("M_UserRole",$Head);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_UserRole",$Detail,$Head);
 }  }

public function UpdateRoleRet(){
 $Detail['RetData'] = $this->input->post('UpDataX');
 $Head['UserID'] = $this->input->post('SysID');
 $Head['NumOf'] = $this->input->post('NumOf');

 $data = $this->app_model->getSelectedData("M_UserRole",$Head);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_UserRole",$Detail,$Head);
 }  } 
 
public function UpdateRoleJurnal(){
 $Detail['ViewJurnal'] = $this->input->post('UpDataX');
 $Head['UserID'] = $this->input->post('SysID');
 $Head['NumOf'] = $this->input->post('NumOf');

 $data = $this->app_model->getSelectedData("M_UserRole",$Head);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_UserRole",$Detail,$Head);
 }  } 
 
public function DeleteRole(){
 $Head['UserID'] = $this->input->post('SysID');
 $Head['NumOf'] = $this->input->post('NumOf');
 
 $UserID = $this->input->post('SysID');
 $NumOf = $this->input->post('NumOf');

 $data = $this->app_model->getSelectedData("M_UserRole",$Head);
 if($data->num_rows()>0){
 $this->MasterUser_model->DeleteRole($UserID,$NumOf);
 }  } 
 
public function Save(){
 $pwd = $this->input->post('PasswordX');
 $pwd2 = "strongID";
 $up['UserName'] = $this->input->post('UserName');
 $up['FullName'] = $this->input->post('FullName');
 $up['DeptID'] = $this->input->post('DeptID');
 $up['IsActive'] = $this->input->post('IsActive');
 $up['Password'] = md5($pwd) ;
 $up['PasswordX'] = md5($pwd2) ;
 
 $up2['UserName'] = $this->input->post('UserName');
 $up2['FullName'] = $this->input->post('FullName');
 $up2['DeptID'] = $this->input->post('DeptID');
 $up2['IsActive'] = $this->input->post('IsActive');
 
 $id['SysID'] = $this->input->post('SysID'); 
 $id2['UserName'] = $this->input->post('UserName');
 $id2['IsActive'] = 1 ;
 $SysID               = $this->input->post('SysID'); 
 if(empty($SysID)){
 $data = $this->app_model->getSelectedData("M_UserG5",$id2);
 if($data->num_rows()>0){
 echo 'Data Sudah Ada';
 }else{
 $this->app_model->insertData("M_UserG5",$up);
 echo 'Data berhasil ditambah bro';	 } }else{
 $data = $this->app_model->getSelectedData("M_UserG5",$id);
 if($data->num_rows()>0){
 if(empty($pwd)){
 $this->app_model->updateData("M_UserG5",$up2,$id);
 echo 'Edit Data Sukses';
 }else{
 $this->app_model->updateData("M_UserG5",$up,$id);
 echo 'Edit Data Sukses'; }
 }else{
 echo 'Data Tidak Ada';	 }  }  }

public function ListUser(){
 $id = $this->input->post('id');
 $data['TotalItem'] = $this->app_model->TotalUser('1',$id) ;
 $DB =$this->MasterUser_model->MasterList($id);
 $data['list']=$DB->result();
 $this->load->view('MasterUser/master_list',$data); }
 
public function DetailRole(){
 $id = $this->input->post('id');
 $DB = $this->MasterUser_model->DetailRole($id);
 $d['list']=$DB->result();
 $this->load->view('MasterUser/DetailRole',$d); }
 
public function ActivityList(){
 $DB = $this->MasterUser_model->ActivityList();
 $d['list']=$DB->result();
 $this->load->view('MasterUser/ActivityList',$d); }
 
public function ListUserGrpFlow(){
 $DB = $this->MasterUser_model->ListUserGrpFlow();
 $d['list']=$DB->result();
 $this->load->view('MasterUser/UserGrpFlow',$d); }
    
public function Hapus(){
 $ID = $this->input->post('SysIDDelete'); 
 $Head['SysID'] = $this->input->post('SysIDDelete'); 
 if($ID!=1){
 $data = $this->app_model->getSelectedData("M_UserG5",$Head);
 if($data->num_rows()>0){
 $this->MasterUser_model->UserDelete($ID);
 $this->MasterUser_model->UserRoleDelete($ID);
 echo 'Data berhasil d hapus bro' ;
 }else{        
 echo 'Gagal Menghapus bro'; } }else{ echo 'Administrator Login'; }	}


public function InfoMasterUser(){
 $ID = $this->input->post('ID');
 $text = "SELECT * FROM QM_UserG5 WHERE SysID='$ID'";
 $tabel = $this->app_model->manualQuery($text);
 $row = $tabel->num_rows();
 if($row>0){
 foreach($tabel->result() as $t){    
 $data['UserName'] = $t->UserName;
 $data['FullName'] = $t->FullName;
 $data['DeptID'] = $t->DeptID;
 $data['IsActive'] = $t->IsActive;
 echo json_encode($data); }
 }else{ 
 $data['UserName'] = '';
 $data['FullName'] = '';
 $data['DeptID'] = '';
 $data['IsActive'] = '';
 echo json_encode($data);
 } }
                    
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
       
}