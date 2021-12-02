<?php
class MasterPartner2 extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterPartner_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->MPartner2() ;
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }
 //print_r($this->session->userdata());
 }
 
    
function index(){
 $d['title']="Home";
 
$this->template->display('MasterPartner2/index',$d); }

public function Save(){
 $up['PartnerCode'] = $this->input->post('partner_code');
 $up['PartnerName'] = $this->input->post('partner_name'); 
 $up['Address'] = $this->input->post('address');
 $up['Telp'] = $this->input->post('telp');
 
 if($this->session->userdata('SysID')==1){
   $up['IsCustomer'] = 1;
   $up['IsVendor'] = 1;
 }
 else{
     if($this->session->userdata('DeptID')==27)
        $up['IsCustomer'] = 1;
     else
        $up['IsVendor'] = 1;
 }
 
 $id['PartnerCode'] = $this->input->post('partner_code');
 $id['PartnerName'] = $this->input->post('partner_name');
 $id2['SysID']       = $this->input->post('id');
 $RegID = $this->input->post('id');
 if(empty($RegID)){
 $data = $this->app_model->getSelectedData("T010_Partner",$id);
 if($data->num_rows()>0){
 echo 'Data Sudah ada';
 }else{
    //$this->app_model->dbQuery('SELECT NEXT VALUE FOR T010_Partner_Seq as SysID')->row()->SysID;
    $up['SysID'] = $this->app_model->dbQuery("SELECT CASE WHEN min(SysID) = 1 THEN 0 ELSE min(SysID) END -1 as SysID FROM T010_Partner")->row()->SysID;
    //die(print_r($up));
 $this->app_model->insertData("T010_Partner",$up);
 echo 'Data berhasil ditambah'; }
 }else{
 $data = $this->app_model->getSelectedData("T010_Partner",$id2);
 if($data->num_rows()>0){
 $this->app_model->updateData("T010_Partner",$up,$id2);
 echo 'Data berhasil diupdate';
 }else{
 echo 'Update Gagal !!!'; } } }

public function ListProduct(){
 $data['TotalItem'] = $this->app_model->TotalCust() ;
 $sql = "SELECT * FROM T010_Partner WHERE IsVendor=1 AND ISNULL(PartnerCode,'') <> '' AND IsDelete=0 ORDER BY PartnerCode ASC";
 //$DB =$this->MasterPartner_model->MasterList();
 $DB = $this->app_model->dbQuery($sql);
 $data['list']=$DB->result();
 $this->load->view('MasterPartner2/master_list',$data); }
    
public function Hapus_Product(){
 $up['IsDelete'] = "1" ;
 $id_d['SysID'] = $this->input->post('id'); 
 $data = $this->app_model->getSelectedData("T010_Partner",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("T010_Partner",$up,$id_d);
 echo 'Data berhasil dihapus' ;
 }else{        
 echo 'Gagal Menghapus'; }	}
                       
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
       
}