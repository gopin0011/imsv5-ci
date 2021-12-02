<?php
class MasterAsset extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterAsset_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->MAsset();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
 
function index(){
 $d['title']="Home";
 $text2 = "SELECT * FROM M_Category WHERE GroupBy='Asset' ";
 $d['l_nama_category'] = $this->app_model->manualQuery($text2);
 $text3 = "SELECT * FROM M_Unit";
 $d['l_unit_name'] = $this->app_model->manualQuery($text3);
 $text4 = "SELECT * FROM M_DetailStatus ORDER BY RegID DESC" ;
 $d['l_MDetailStatus'] = $this->app_model->manualQuery($text4);
 $text5 = "SELECT * FROM M_Location WHERE Category LIKE '%ASSET%' ORDER BY SysID ASC" ;
 $d['Location'] = $this->app_model->manualQuery($text5);
 $text6 = "SELECT * FROM M_DetailICT WHERE Category='OS' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListOS'] = $this->app_model->manualQuery($text6);
 $text7 = "SELECT * FROM M_DetailICT WHERE Category='MSO' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListMSO'] = $this->app_model->manualQuery($text7);
 $text8 = "SELECT * FROM M_DetailICT WHERE Category='ACAD' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListACAD'] = $this->app_model->manualQuery($text8);
 $text9 = "SELECT * FROM M_DetailICT WHERE Category='NX' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListNX'] = $this->app_model->manualQuery($text9);
 $text10 = "SELECT * FROM M_DetailICT WHERE Category='SW' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListSW'] = $this->app_model->manualQuery($text10);
 $text11 = "SELECT * FROM M_DetailICT WHERE Category='FB' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListFB'] = $this->app_model->manualQuery($text11);
 $text12 = "SELECT * FROM M_DetailICT WHERE Category='DB' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListDB'] = $this->app_model->manualQuery($text12);
 $text12 = "SELECT * FROM M_DetailICT WHERE Category='CAT' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListCatia'] = $this->app_model->manualQuery($text12);
 $text13 = "SELECT * FROM M_DetailICT WHERE Category='HW' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListHardware'] = $this->app_model->manualQuery($text13);
 $text14 = "SELECT * FROM M_DetailICT WHERE Category='RAM' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListRAM'] = $this->app_model->manualQuery($text14);
 $text15 = "SELECT * FROM M_DetailICT WHERE Category='HDD' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListHDD'] = $this->app_model->manualQuery($text15);
 $text16 = "SELECT * FROM M_DetailICT WHERE Category='VGA' OR Category='OB' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListVGA'] = $this->app_model->manualQuery($text16);
 $text17 = "SELECT * FROM M_DetailICT WHERE Category='NET' OR Category='OB' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListNET'] = $this->app_model->manualQuery($text17);
 $text18 = "SELECT * FROM M_DetailICT WHERE Category='PRO' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListProcessor'] = $this->app_model->manualQuery($text18);
 $text19 = "SELECT * FROM M_Partner ORDER BY id DESC" ;
 $d['MListPartner'] = $this->app_model->manualQuery($text19);
 $text20 = "SELECT * FROM M_DetailICT WHERE Category='PT' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListPT'] = $this->app_model->manualQuery($text20);
 $text21 = "SELECT * FROM M_DetailICT WHERE Category='SP' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListSP'] = $this->app_model->manualQuery($text21);
 $text22 = "SELECT * FROM M_DetailICT WHERE Category='CL' OR Category='ALL' ORDER BY SysID ASC" ;
 $d['ListCL'] = $this->app_model->manualQuery($text22);
 $text23 = "SELECT * FROM M_Department ";
 $d['DeptList'] = $this->app_model->manualQuery($text23);
 
 //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
 $this->template->display('MasterAsset/index',$d); }

public function Avatar(){ 
 $id = $this->input->post('kode');
 $DB =$this->MasterAsset_model->AvatarView($id);
 $d['list'] = $DB->result();
 $this->load->view('MasterAsset/Avatar',$d); }
 
public function PrintLabel(){ 
 $id = $this->uri->segment(3) ;
 $DB =$this->MasterAsset_model->PrintLabel($id);
 $d['list'] = $DB->result();
 $d['num'] = $DB->num_rows();
 $this->load->view('MasterAsset/PrintLabel',$d); }
 
public function Upload(){
 require_once 'class.upload.php';
 $ImageRev = $this->app_model->ImageRev($this->input->post('ItemID2'));
 if($ImageRev>0){
 $No1 = $ImageRev + 1; 
 $Rev =$ImageRev + 1;   
 $ImageID = $this->input->post('ItemID2');
 $ImageFormat2 = $ImageID.''.$Rev.''.'.png';
 $ImageFormat = $ImageID.''.$Rev ;
 }
 if($ImageRev==null){
 $No1 = $ImageRev; 
 $Rev = '1'; 
 $ImageID = $this->input->post('ItemID2');
 $ImageFormat2 = $ImageID.''.$Rev.''.'.png';
 $ImageFormat = $ImageID.''.$Rev ;
 }
 $handle = new Upload($_FILES['file']);
 $handle->allowed = 'image/*';
 $handle->file_overwrite = true;
 $handle->image_convert   = 'png';
 $handle->file_new_name_body = $ImageFormat ;
 
 $up['ImageRev'] = $Rev ;
 $up['Image'] = $ImageFormat2 ;
 $id['ItemID'] = $this->input->post('ItemID2');
 
 $data = $this->app_model->getSelectedData("M_Asset",$id);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Asset",$up,$id);
 echo 'Upload Data Sukses';
 }else{
 echo 'Gagal Menyimpan Data';	 }
 if($handle->uploaded) {
 $handle->Process('images/FotoAsset');
 if($handle->processed) {
 echo 'Image uploaded';
 }else{
 echo 'error'; } } }
 
public function Save(){
 //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
 $Date	    = date('Y-m-d');
 $up['ItemNo']     = $this->input->post('ItemNo');
 $up['ItemName']   = $this->input->post('ItemName');
 $up['Spec'] = $this->input->post('Spec');
 $up['LocationID']   = $this->input->post('LocationID');
 $up['CategoryID']   = $this->input->post('CategoryID');
 $up['UnitID']      = $this->input->post('UnitID');
 $up['Remark']      = $this->input->post('Remark');
 $up['IsActive']     = $this->input->post('IsActive');
 $up['VendorID']     = $this->input->post('PartnerID');
 $up['Qty']     = str_replace(',','',$this->input->post('Qty'));
 $up['LastUpdate']		    = $Date ;
 $up['PurchaseDate']		    = $this->app_model->tgl_sql($this->input->post('PurchaseDate')) ;
 $up1['OS'] = $this->input->post('OS');
 $up1['Office'] = $this->input->post('Office');
 $up1['Autocad'] = $this->input->post('Autocad');
 $up1['NX'] = $this->input->post('NX');
 $up1['SW'] = $this->input->post('SW');
 $up1['Catia'] = $this->input->post('Catia');
 $up1['FB'] = $this->input->post('FB');
 $up1['DB'] = $this->input->post('DB');
 $up1['Hardware'] = $this->input->post('Hardware');
 $up1['RAM'] = $this->input->post('RAM');
 $up1['HDD'] = $this->input->post('HDD');
 $up1['VGACard'] = $this->input->post('VGACard');
 $up1['NetCard'] = $this->input->post('NetCard');
 $up1['Processor'] = $this->input->post('Processor');
 $up1['Remark'] = $this->input->post('RemarkDetail');
 $up1['PrinterType'] = $this->input->post('PrinterType');
 $up1['SizePaper'] = $this->input->post('SizePaper');
 $up1['ColorType'] = $this->input->post('ColorType');
 $up1['SysID']   = $this->input->post('ItemID');
 $id2['SysID']   = $this->input->post('ItemID');
 $up['Price']     = str_replace(',','',$this->input->post('Price')) ;
 $up['Amount']     = str_replace(',','',$this->input->post('Amount')) ;
 $id['ItemID']   = $this->input->post('ItemID');
 $id['UserID']     = $this->session->userdata('RegID');
 $data = $this->app_model->getSelectedData("M_Asset",$id);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Asset",$up,$id);
 $this->app_model->updateData("M_AssetICT",$up1,$id2);
 echo 'Sukses Menyimpan !!!';
 }else{
 echo 'Silahkan Login Administrator bro !!!'; }  }

public function ListProduct(){
 $LocationIDView = $this->input->post('LocationIDView');
 $DeptIDView = $this->input->post('DeptIDView');
 $data['TotalItem'] = $this->app_model->TotalItemMAsset($LocationIDView,$DeptIDView);
 $DB =$this->MasterAsset_model->MasterList($LocationIDView,$DeptIDView);
 $data['list']=$DB->result();
 $this->load->view('MasterAsset/master_list',$data); }
 
public function PrintList(){
 $LocationIDView = $this->uri->segment(3) ;
 $DeptIDView = $this->uri->segment(4);
 $data['judul'] = "Asset List";
 if($LocationIDView!='All'){
 $data['LocationID'] = $this->app_model->CariLocation($this->uri->segment(3));}else{
 $data['LocationID'] = "All Location"; }
 if($DeptIDView!='ALL'){
 $data['DeptID'] = $this->app_model->CariDepartmentName($this->uri->segment(4));}else{
 $data['DeptID'] = "All Department";  }
 
 $DB = $this->MasterAsset_model->MasterList($LocationIDView,$DeptIDView);
 $data['list'] = $DB->result();
 $data['num'] = $DB->num_rows();
 $this->load->view('MasterAsset/PrintList',$data); }
 
public function ExportProduct(){
 $LocationIDView = $this->uri->segment(3) ;
 $DeptIDView = $this->uri->segment(4);
 $data['judul'] = "Asset List";
 if($LocationIDView!='All'){
 $data['LocationID'] = $this->app_model->CariLocation($this->uri->segment(3));}else{
 $data['LocationID'] = "All Location"; }
 if($DeptIDView!='ALL'){
 $data['DeptID'] = $this->app_model->CariDepartmentName($this->uri->segment(4));}else{
 $data['DeptID'] = "All Department";  }
 
 $DB = $this->MasterAsset_model->MasterList($LocationIDView,$DeptIDView);
 $data['list'] = $DB->result();
 $data['num'] = $DB->num_rows();
 $this->load->view('MasterAsset/ExportProduct',$data); }

public function ListProduct2(){
 $ID_Dept = $this->session->userdata('DeptID') ;
 $DB =$this->MasterAsset_model->MasterList2($ID_Dept);
 $data['list']=$DB->result();
 $this->load->view('MasterAsset/master_list2',$data); }
 
function MasterListPartner(){
 $DB=$this->MasterAsset_model->MasterListPartner();
 $data['list']=$DB->result();
 $this->load->view('MasterAsset/master_partner',$data); }
 
public function Hapus_Product(){
 $up['IsActive']           = "0" ;  
 $id_d['ItemID'] = $this->input->post('DocNumDetailDelete'); 
 $id_d['UserID'] = $this->session->userdata('RegID'); 
 $data = $this->app_model->getSelectedData("M_Asset",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Asset",$up,$id_d);
 echo 'Data berhasil dihapus bro' ;
 }else{        
 echo 'Gagal, Login Administrator bro';	 }	}
    
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
    
}