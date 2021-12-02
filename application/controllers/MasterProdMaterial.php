<?php
class MasterProdMaterial extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterProdMaterial_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->MProdMaterial();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 $text = "SELECT * FROM Q01_MProduct WHERE IsMaterial=1 ORDER BY IDCust DESC" ;
 $d['MListMaterial'] = $this->app_model->manualQuery($text);
 $text5 = "SELECT * FROM M_MaterialType";
 $d['l_MaterialType'] = $this->app_model->manualQuery($text5);
 $text2 = "SELECT * FROM M_Customer ORDER BY Code ASC";
 $d['l_MCust'] = $this->app_model->manualQuery($text2);
 $text3 = "SELECT * FROM M_Project ORDER BY ProjectName ASC";
 $d['l_MProject'] = $this->app_model->manualQuery($text3);
 $text4 = "SELECT * FROM M_MaterialType ";
 $d['l_MMaterialType'] = $this->app_model->manualQuery($text4);
 $text6 = "SELECT * FROM M_DetailStatus ORDER BY RegID DESC" ;
 $d['l_MDetailStatus'] = $this->app_model->manualQuery($text6);
            
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$DocDate = date('d-m-Y');
$d['DocDateReport_2'] = date('d-m-Y');
$d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
$d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
$d['DocDateReport_2'] = $DocDate ;
$this->template->display('MasterProdMaterial/index',$d); }

function ListProduct1(){
 $IDCust = $this->input->post("IDCust");   
 //$DB=$this->MasterProdMaterial_model->ListProduct();
 $sql = "SELECT * FROM BOM2 WHERE IsActiveDetail=1 AND IsDeleteDetail=0 AND PartType LIKE '%RM%' ORDER BY SysID ASC";
 //echo"<pre>";
 //print_r($sql);
 //echo"</pre>";
 $DB = $this->app_model->dbQuery($sql);
 $data['List']=$DB->result();
 $this->load->view('MasterProdMaterial/ListProduct',$data); }

public function SelectBOM(){
 $Detail['ItemID_Product'] = $this->input->post('ItemID');
 $Detail['ItemID_BOM'] = $this->input->post('SysID');
 $Detail['PartTypeID'] = $this->input->post('PartTypeID');
 $Head['ItemID_Product'] = $this->input->post('ItemID');
 $Head['ItemID_BOM'] = $this->input->post('SysID');
 $Head['PartTypeID'] = $this->input->post('PartTypeID');
 $data = $this->app_model->getSelectedData("CMProduct_BOM",$Head);
 if($data->num_rows()>0){
    //echo"<pre>";
    //print_r($Detail);
    //echo"</pre>";
 }else{ $this->app_model->insertData("CMProduct_BOM",$Detail);  }  }

public function DeleteConecting(){
 $Head['SysID'] = $this->input->post('SysID');
 $SysID = $this->input->post('SysID');
 $data = $this->app_model->getSelectedData("CMProduct_BOM",$Head);
 if($data->num_rows()>0){
 $this->MasterProdMaterial_model->DeleteConecting($SysID);
 }}

public function ConectingBomList(){
 $id = $this->input->post('id');
 $DB = $this->MasterProdMaterial_model->ConectingBomList($id);
 $d['list']=$DB->result();
 $this->load->view('MasterProdMaterial/ConectingBomList',$d); }
  
public function Save()
{
 $up['PartNo']               = $this->input->post('PartNo');
 $up['PartName']             = $this->input->post('PartName');
 $up['IDCust']               = $this->input->post('IDCust');
 $up['IDProject']            = $this->input->post('IDProject');
 $up['Spec1']                = $this->input->post('Spec1');
 $up['Spec2']                = $this->input->post('Spec2');
 $up['PcsPerday']            = $this->input->post('PcsPerDay');
 $up['PcsPerSheet']          = $this->input->post('PcsPerSheet');
 $up['PcsPerKg']             = $this->input->post('PcsPerKg');
 $up['MaterialType']         = $this->input->post('MaterialType');
 $up['Price']                = $this->input->post('Price');
 $up['Min']                  = $this->input->post('Min');
 $up['Max']                  = $this->input->post('Max');
 $up['IsActive']             = $this->input->post('IsActive');
 $up['IsMaterial']           = '1' ;
 $up['MasterBy']           = '1' ;
 $id['PartNo']               = $this->input->post('PartNo');
 $id['PartName']             = $this->input->post('PartName');
 $id['IDCust']               = $this->input->post('IDCust');
 $id['IsMaterial']           = '1' ;
 $id['Spec1']                = $this->input->post('Spec1');
 $id['Spec2']                = $this->input->post('Spec2');
 $id['PcsPerday']            = $this->input->post('PcsPerDay');
 $id['PcsPerSheet']          = $this->input->post('PcsPerSheet');
 $id['PcsPerKg']             = $this->input->post('PcsPerKg');
 $id['MasterBy']           = '1' ;
 $id['IsDelete']         = 'X';
 $id2['RegID']       = $this->input->post('ItemID');
 $RegID               = $this->input->post('ItemID');
 if(empty($RegID))
 {
     $data = $this->app_model->getSelectedData("M_Product",$id);
     if($data->num_rows()>0){
         echo 'Data Sudah ada bro';
     }else{
         $this->app_model->insertData("M_Product",$up);
         echo 'Data berhasil ditambah bro'; 
     }
 } else {
    $data = $this->app_model->getSelectedData("M_Product",$id2);
    if($data->num_rows()>0)
    {
        $this->app_model->updateData("M_Product",$up,$id2);
        echo 'Data berhasil diupdate bro';
    } else {
        echo 'Update Gagal !!!'; 
    }  
 }  
}


public function ListProduct()
{
    $id = $this->input->post('id');
    $data['TotalItemMaterial'] = $this->app_model->ItemMMaterial($id);
    $DB =$this->MasterProdMaterial_model->MasterList($id);
    $data['list']=$DB->result();
    $this->load->view('MasterProdMaterial/master_list',$data);
}

public function ExportProduct()
{
    $data['judul']="Master Product";
    $CustID =$this->uri->segment(3);
    $DB = $this->MasterProdMaterial_model->ExportProduct($CustID);
    $data['data']=$DB->result();
    $data['num'] = $DB->num_rows();
    $this->load->view('MasterProdMaterial/ExportProduct',$data);
}

public function Hapus_Product()
{
     $up['IsDelete'] = "O" ;
     $id_d['RegID'] = $this->input->post('ItemID'); 
     $data = $this->app_model->getSelectedData("M_Product",$id_d);
     if($data->num_rows()>0)
     {
        $this->app_model->updateData("M_Product",$up,$id_d);
        echo 'Data berhasil dihapus bro';
     } else {
        echo 'Gagal Menghapus bro';		
     }
}
                       
function _set_rules()
{
    $this->form_validation->set_rules('user','username','required|trim');
    $this->form_validation->set_rules('password','password','required|trim');
    $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); 
}
       
}