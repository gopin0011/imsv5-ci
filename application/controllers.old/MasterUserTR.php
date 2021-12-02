<?php
class MasterUserTR extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterUserTR_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->session->userdata('MUserTR')=='1';
 if(!$this->session->userdata('username')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 $text = "SELECT * FROM M_Level ORDER BY id_level DESC" ;
 $d['l_MLevel'] = $this->app_model->manualQuery($text);
 $text2 = "SELECT * FROM M_Department ORDER BY id DESC" ;
 $d['l_MDept'] = $this->app_model->manualQuery($text2);
 $text3 = "SELECT * FROM M_DetailStatus ORDER BY RegID DESC" ;
 $d['l_MDetailStatus'] = $this->app_model->manualQuery($text3);
$this->template->display('MasterUserTR/index',$d); }

public function Save(){
 $up['Code']               = $this->input->post('code');
 $up['nama_lengkap']         = $this->input->post('nama_lengkap');
 $up['id_dept']            = $this->input->post('id_dept');
 $up['blokir']            = $this->input->post('IsActive');
 $up['IsStoreRoom']            = '1';
 $id['RegID']               = $this->input->post('RegID'); 
 $id2['Code']               = $this->input->post('code');
 $id2['nama_lengkap']         = $this->input->post('nama_lengkap'); 
 $id2['id_dept']            = $this->input->post('id_dept');
 $id2['blokir']            = $this->input->post('IsActive');
 $id2['IsStoreRoom']            = '1';
 $RegID               = $this->input->post('RegID');  
 if(empty($RegID)){
 $data = $this->app_model->getSelectedData("M_User",$id2);
 if($data->num_rows()>0){
 echo 'Data Sudah Ada';
 }else{
 $this->app_model->insertData("M_User",$up);
 echo 'Data berhasil ditambah bro';		
 } }else{
 $data = $this->app_model->getSelectedData("M_User",$id);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_User",$up,$id);
 echo 'Edit Data Sukses';
 }else{ 
 echo 'Data Tidak Ada';	 }  }  }

public function ListProduct(){
 $id = $this->input->post('id');
 $data['TotalItem'] = $this->app_model->TotalUserTR('1',$id) ;
 $DB =$this->MasterUserTR_model->MasterList($id);
 $data['list']=$DB->result();
 $this->load->view('MasterUserTR/master_list',$data); }
    
public function Hapus_Product(){
 $up['IsDelete']           = "O" ;
 $id_d['RegID']            = $this->input->post('RegID'); 
 $data = $this->app_model->getSelectedData("M_User",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_User",$up,$id_d);
 echo 'Data berhasil d hapus bro' ;
 }else{        
 echo 'Gagal Menghapus bro'; }	}
                       
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
       
}