<?php
class MasterCust extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterCust_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->MCust();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 
$this->template->display('MasterCust/index',$d); }

public function Save(){
 $up['Code'] = $this->input->post('Code');
 $up['CustName'] = $this->input->post('CustName'); 
 $id['Code'] = $this->input->post('Code');
 $id['CustName'] = $this->input->post('CustName'); 
 $id['IsDelete'] = 'X';     
 $RegID = $this->input->post('RegID');    
 $id2['RegID'] = $this->input->post('RegID');
 if(empty($RegID)){
 $data = $this->app_model->getSelectedData("M_Customer",$id);
 if($data->num_rows()>0){
 echo 'Data Sudah ada bro';
 }else{
 $this->app_model->insertData("M_Customer",$up);
 echo 'Data berhasil ditambah bro'; }
 }else{
 $data = $this->app_model->getSelectedData("M_Customer",$id2);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Customer",$up,$id2);
 echo 'Data berhasil diupdate bro';
 }else{
 echo 'Update Gagal !!!'; }  }   }

public function ListProduct(){
 $data['TotalItem'] = $this->app_model->TotalCust() ;
 $DB =$this->MasterCust_model->MasterList();
 $data['list']=$DB->result();
 $this->load->view('MasterCust/master_list',$data); }
    
public function Hapus_Product(){
 $up['IsDelete']           = "O" ;
 $id_d['RegID']            = $this->input->post('RegID'); 
 $data = $this->app_model->getSelectedData("M_Customer",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Customer",$up,$id_d);
 echo 'Data berhasil dihapus bro' ;
 }else{        
 echo 'Gagal Menghapus bro';		
 }	}
                       
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
       
}