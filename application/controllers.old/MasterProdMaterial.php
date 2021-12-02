<?php
class MasterProdMaterial extends CI_Controller{

function __construct(){
 parent::__construct();
 $this->load->model(array('MasterProdMaterial_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->session->userdata('MProdMaterial')=='1';
 if(!$this->session->userdata('username')){ redirect('welcome');  } 
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

public function Save(){
 $up['PartNo']               = $this->input->post('PartNo');
 $up['PartName']             = $this->input->post('PartName');
 $up['IDCust']               = $this->input->post('IDCust');
 $up['IDProject']            = $this->input->post('IDProject');
 $up['Spec1']                = $this->input->post('Spec1');
 $up['Spec2']                = $this->input->post('Spec2');
 $up['PcsPerDay']            = $this->input->post('PcsPerDay');
 $up['PcsPerSheet']          = $this->input->post('PcsPerSheet');
 $up['PcsPerKg']             = $this->input->post('PcsPerKg');
 $up['MaterialType']         = $this->input->post('MaterialType');
 $up['Price']                = $this->input->post('Price');
 $up['Min']                  = $this->input->post('Min');
 $up['Max']                  = $this->input->post('Max');
 $up['StockFG']              = $this->input->post('StockFG');
 $up['StockWip']             = $this->input->post('StockWip');
 $up['IsActive']             = $this->input->post('IsActive');
 $up['IsMaterial']           = '1' ;
 $up['MasterBy']           = '1' ;
 $id['PartNo']               = $this->input->post('PartNo');
 $id['PartName']             = $this->input->post('PartName');
 $id['IDCust']               = $this->input->post('IDCust');
 $id['IsMaterial']           = '1' ;
 $id['Spec1']                = $this->input->post('Spec1');
 $id['Spec2']                = $this->input->post('Spec2');
 $id['PcsPerDay']            = $this->input->post('PcsPerDay');
 $id['PcsPerSheet']          = $this->input->post('PcsPerSheet');
 $id['PcsPerKg']             = $this->input->post('PcsPerKg');
 $id['MasterBy']           = '1' ;
 $id['IsDelete']         = 'X';
 $id2['RegID']       = $this->input->post('ItemID');
 $RegID               = $this->input->post('ItemID');
 if(empty($RegID)){
 $data = $this->app_model->getSelectedData("M_Product",$id);
 if($data->num_rows()>0){
 echo 'Data Sudah ada bro';
 }else{
 $this->app_model->insertData("M_Product",$up);
 echo 'Data berhasil ditambah bro'; }
 }else{
 $data = $this->app_model->getSelectedData("M_Product",$id2);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Product",$up,$id2);
 echo 'Data berhasil diupdate bro';
 }else{
 echo 'Update Gagal !!!'; }  }  }

public function DetailBOM(){
 $kode = $this->input->post('kode');
 $DB = $this->MasterProdMaterial_model->DetailBom1($kode);
 $data['data']=$DB->result();
 $data['num'] = $DB->num_rows();

 $DB2 = $this->MasterProdMaterial_model->DetailBom2($kode);
 $data['data2']=$DB2->result();
 $data['num2'] = $DB2->num_rows();
 $this->load->view('MasterProdMaterial/DetailBOM',$data); }   

public function ListProduct(){
 $id = $this->input->post('id');
 $data['TotalItemMaterial'] = $this->app_model->ItemMMaterial('1',$id) ;
 $DB =$this->MasterProdMaterial_model->MasterList($id);
 $data['list']=$DB->result();
 $this->load->view('MasterProdMaterial/master_list',$data); }
    
public function InfoTambahBOM(){ 
 $kode = $this->input->post('kode');
 if(empty($kode)){
 $Cust = $this->input->post('IDCust');  
 $DocNum = $this->app_model->DocNumBOM();
 $ItemNo = $this->app_model->ItemNoBOM($Cust);
          
 $ItemNoDetail = $this->app_model->CariJumlahItemNo($kode);
 $ItemNoDetailSub = $ItemNoDetail + 1;
 $data['ItemNoDetailSub'] = $ItemNoDetailSub ;
 $data['ItemID'] = $DocNum ;
 $data['ItemNo'] = $ItemNo ;
 $data['ItemID2'] = $DocNum .'-'. 1 ;
 $data['PartNo'] = $this->input->post('PartNo');
 $data['PartName'] = $this->input->post('PartName');
 $data['IDCust'] = $this->input->post('IDCust');
 $data['IDProject'] = $this->input->post('IDProject');
 $data['PackingType'] = $this->input->post('PackingType');
 $data['StdPack'] = $this->input->post('StdPack');
 $data['FGLocation'] = $this->input->post('FGLocation');
 $data['PartTypeID'] = $this->input->post('PartTypeID');
 $data['IsActive'] = $this->input->post('IsActive');
 $data['SupplierIDHead'] = $this->input->post('SupplierIDHead');
 $data['SupplierNameHead'] = $this->input->post('SupplierNameHead');
 $data['QtyPerCarHead'] = $this->input->post('QtyPerCarHead');
 $Cust2 = $this->input->post('IDCust'); 
 $up['SysID'] = $this->app_model->DocNumBOM();
 $up['ItemNo'] = $this->app_model->ItemNoBOM($Cust2);
 $up['PartNo'] = $this->input->post('PartNo');
 $up['PartName'] = $this->input->post('PartName');
 $up['IDCust'] = $this->input->post('IDCust');
 $up['IDProject'] = $this->input->post('IDProject');
 $up['PackingType'] = $this->input->post('PackingType');
 $up['StdPack'] = $this->input->post('StdPack');
 $up['PartTypeID'] = $this->input->post('PartTypeID');
 $up['FGLocation'] = $this->input->post('FGLocation');
 $up['IsActive'] = $this->input->post('IsActive');
 $up['SupplierID'] = $this->input->post('SupplierIDHead');
 $up['QtyPerCar'] = $this->input->post('QtyPerCarHead');
 $up['CreateBy']         = $this->session->userdata('RegID');
 $up2['SysID'] = $this->app_model->DocNumBOM();
 $up2['LinkID'] = $this->app_model->DocNumBOM();
 $up2['ItemNo'] = $this->app_model->ItemNoBOM($Cust2);
 $up2['NoUrut'] = 1 ;
 $up2['ItemNoSub'] = '0';
 $up2['PartNo'] = $this->input->post('PartNo');
 $up2['PartName'] = $this->input->post('PartName');
 $up2['LevelPart'] = '1';
 $up2['PartType'] = $this->input->post('PartTypeID');
 $up2['QtyPerCar'] = $this->input->post('QtyPerCarHead');
 $up2['SupplierID'] = $this->input->post('SupplierIDHead');
 $up2['PackingType'] = $this->input->post('PackingTypeHead');
 $up2['StdPack'] = $this->input->post('StdPackHead');
 $up2['FGLocation'] = $this->input->post('FGLocationHead');
 $id['SysID']         = $this->app_model->DocNumBOM();
 $data2 = $this->app_model->getSelectedData("BOM1",$id);
 if($data2->num_rows()>0){ }else{
 $this->app_model->insertData("BOM1",$up);
 $this->app_model->insertData("BOM2",$up2);
            
 $NoUrut2 = $this->app_model->CariNoUrut($DocNum);
 $NoUrut = $NoUrut2 + 1 ;
 $data['NoUrut'] = $NoUrut ;
 $data['pesan'] = "Success !!!";  } 
 }else{
 $ItemNo = $this->input->post('ItemNo');
 $ItemNoDetail = $this->app_model->CariJumlahItemNo($kode);
 $ItemNoDetailSub = $ItemNoDetail + 1;
 $TotalChildSum = $this->app_model->CariJumlahChild($kode);
 $TotalChild = $TotalChildSum + 1 ;
 $data['ItemID'] = $kode ;
 $data['ItemID2'] = $kode .'-'. $TotalChild ;
 $data['ItemNo'] = $ItemNo ;
 $data['ItemNoDetailSub'] = $ItemNoDetailSub ;
 $data['NoUrut'] = $this->input->post('NoUrut');
 $data['PartNo'] = $this->input->post('PartNo');
 $data['PartName'] = $this->input->post('PartName');
 $data['IDCust'] = $this->input->post('IDCust');
 $data['IDProject'] = $this->input->post('IDProject');
 $data['PackingType'] = $this->input->post('PackingType');
 $data['StdPack'] = $this->input->post('StdPack');
 $data['FGLocation'] = $this->input->post('FGLocation');
 $data['PartTypeID'] = $this->input->post('PartTypeID');
 $data['IsActive'] = $this->input->post('IsActive');
 $up['PartNo'] = $this->input->post('PartNo');
 $up['PartName'] = $this->input->post('PartName');
 $up['IDCust'] = $this->input->post('IDCust');
 $up['IDProject'] = $this->input->post('IDProject');
 $up['PackingType'] = $this->input->post('PackingType');
 $up['StdPack'] = $this->input->post('StdPack');
 $up['PartTypeID'] = $this->input->post('PartTypeID');
 $up['FGLocation'] = $this->input->post('FGLocation');
 $up['IsActive'] = $this->input->post('IsActive');
 $up['SupplierID'] = $this->input->post('SupplierIDHead');
 $up['QtyPerCar'] = $this->input->post('QtyPerCarHead');
 $up['CreateBy']         = $this->session->userdata('RegID');
 $up2['SysID'] = $kode;
 $up2['LinkID'] = $kode;
 $up2['ItemNo'] = $ItemNo ;
 $up2['PartNo'] = $this->input->post('PartNo');
 $up2['PartName'] = $this->input->post('PartName');
 $up2['NoUrut'] = '1';
 $up2['LevelPart'] = '1';
 $up2['PartType'] = $this->input->post('PartTypeID');
 $up2['QtyPerCar'] = $this->input->post('QtyPerCarHead');
 $up2['SupplierID'] = $this->input->post('SupplierIDHead');
 $up2['PackingType'] = $this->input->post('PackingTypeHead');
 $up2['StdPack'] = $this->input->post('StdPackHead');
 $up2['FGLocation'] = $this->input->post('FGLocationHead');
 $id['SysID'] = $kode ;
 $data22 = $this->app_model->getSelectedData("BOM1",$id);
 if($data22->num_rows()>0){
 $this->app_model->updateData("BOM1",$up,$id); 
 $this->app_model->updateData("BOM2",$up2,$id);
 $data['pesan'] = "Updating Success !!!";
 $data['NoUrut'] = $this->input->post('NoUrut') ; }  }
 echo json_encode($data); }


public function InfoTambahChild(){ 
 $kode = $this->input->post('LinkID');
 if(empty($kode)){
 $data2['pesan'] = "Error di luhur Om";
 }else{
 $data2['LinkID'] = $this->input->post('LinkID');      
 $data2['PartNo2'] = $this->input->post('PartNo2');
 $data2['PartName2'] = $this->input->post('PartName2');
 $data2['LevelPart'] = $this->input->post('LevelPart');
 $data2['PackingTypeDetail'] = $this->input->post('PackingTypeDetail');
 $data2['StdPackDetail'] = $this->input->post('StdPackDetail');
 $data2['PartTypeID2'] = $this->input->post('PartTypeID2');
 $data2['QtyCar'] = $this->input->post('QtyCar');
 $data2['SupplierID'] = $this->input->post('SupplierID');
 $data2['MaterialType'] = $this->input->post('MaterialType');
 $data2['Spec'] = $this->input->post('Spec');
 $data2['Width'] = $this->input->post('Width');
 $data2['Thick'] = $this->input->post('Thick');
 $data2['Length'] = $this->input->post('Length');
 $data2['PcsPerSheet'] = $this->input->post('PcsPerSheet');
 $data2['KgPerSheet'] = $this->input->post('KgPerSheet');
 $data2['PartWeight'] = $this->input->post('PartWeight');
 $data2['OP5'] = $this->input->post('OP5'); 
 $data2['OP10'] = $this->input->post('OP10'); 
 $data2['OP20'] = $this->input->post('OP20'); 
 $data2['OP30'] = $this->input->post('OP30'); 
 $data2['OP40'] = $this->input->post('OP40'); 
 $data2['OP50'] = $this->input->post('OP50'); 
 $data2['OP60'] = $this->input->post('OP60');
 $data2['OP70'] = $this->input->post('OP70');
 $data2['OP5M'] = $this->input->post('OP5M');
 $data2['OP10M'] = $this->input->post('OP10M');
 $data2['OP20M'] = $this->input->post('OP20M');
 $data2['OP30M'] = $this->input->post('OP30M');
 $data2['OP40M'] = $this->input->post('OP40M');
 $data2['OP50M'] = $this->input->post('OP50M');
 $data2['OP60M'] = $this->input->post('OP60M');
 $data2['OP70M'] = $this->input->post('OP70M');
 $data2['ProcessAssy'] = $this->input->post('ProcessAssy');
 $data2['ProcessAssyM'] = $this->input->post('ProcessAssyM');

 $data2['ItemNo'] = $this->input->post('ItemNoDetail');
 $data2['ItemNoDetailSub'] = $this->input->post('ItemNoDetailSub');
 $up['SysID'] = $this->input->post('kode');
 $up['LinkID'] = $this->input->post('LinkID');
 $up['ItemNo'] = $this->input->post('ItemNoDetail');
 $up['ItemNoSub'] = $this->input->post('ItemNoDetailSub');
 $up['NoUrut'] = $this->input->post('NoUrut');
 $up['PartNo'] = $this->input->post('PartNo2');
 $up['PartName'] = $this->input->post('PartName2');
 $up['LevelPart'] = $this->input->post('LevelPart');
 $up['PartType'] = $this->input->post('PartTypeID2');
 $up['QtyPerCar'] = $this->input->post('QtyCar');
 $up['SupplierID'] = $this->input->post('SupplierID');
 $up['StdPack'] = $this->input->post('StdPackDetail');
 $up['PackingType'] = $this->input->post('PackingTypeDetail');
 $up['MaterialType'] = $this->input->post('MaterialType') ; 
 $up['Spec'] = $this->input->post('Spec');
 $up['Width'] = $this->input->post('Width');
 $up['Thick'] = $this->input->post('Thick');
 $up['Length'] = $this->input->post('Length');
 $up['PcsPerSheet'] = $this->input->post('PcsPerSheet');
 $up['KgPerSheet'] = $this->input->post('KgPerSheet');
 $up['PartWeight'] = $this->input->post('PartWeight');
 $up2['SysID'] = $this->input->post('kode');
 $up2['LinkID'] = $this->input->post('LinkID');
 $up2['OP5'] = $this->input->post('OP5'); 
 $up2['OP10'] = $this->input->post('OP10'); 
 $up2['OP20'] = $this->input->post('OP20'); 
 $up2['OP30'] = $this->input->post('OP30'); 
 $up2['OP40'] = $this->input->post('OP40');
 $up2['OP50'] = $this->input->post('OP50');
 $up2['OP60'] = $this->input->post('OP60');
 $up2['OP70'] = $this->input->post('OP70'); 
 $up4['SysID'] = $this->input->post('kode');
 $up4['LinkID'] = $this->input->post('LinkID');
 $up4['OP5M'] = $this->input->post('OP5M');
 $up4['OP10M'] = $this->input->post('OP10M');
 $up4['OP20M'] = $this->input->post('OP20M');
 $up4['OP30M'] = $this->input->post('OP30M');
 $up4['OP40M'] = $this->input->post('OP40M');
 $up4['OP50M'] = $this->input->post('OP50M');
 $up4['OP60M'] = $this->input->post('OP60M');
 $up4['OP70M'] = $this->input->post('OP70M');
 $up5['SysID'] = $this->input->post('kode');
 $up5['LinkID'] = $this->input->post('LinkID');
 $up5['ProcessAssy'] = $this->input->post('ProcessAssy'); 
 $up5['LineAssy'] = $this->input->post('ProcessAssyM');
 $id['SysID'] = $this->input->post('kode');
 $data = $this->app_model->getSelectedData("BOM2",$id);
 if($data->num_rows()>0){
 $this->app_model->updateData("BOM2",$up,$id);
 $this->app_model->updateData("BOM3",$up4,$id);
 $this->app_model->updateData("BOM4",$up2,$id);
 $this->app_model->updateData("BOM5",$up5,$id);
 $data2['ItemID2'] = $this->input->post('kode') ;
 $data2['NoUrut'] = $this->input->post('NoUrut') ;           
 $data2['pesan'] = "Updating Success !!!";
 }else{
 $this->app_model->insertData("BOM2",$up); 
 $this->app_model->insertData("BOM3",$up4);
 $this->app_model->insertData("BOM4",$up2);
 $this->app_model->insertData("BOM5",$up5);
 $data2['ItemID2'] = $this->input->post('kode') ;
 $data2['NoUrut'] = $this->input->post('NoUrut') ;
 $data2['pesan'] = "Save Success !!!"; } }  
 echo json_encode($data2);   }


public function InfoTambahChild_add(){ 
  $kode = $this->input->post('LinkID');
  if(empty($kode)){ }else{
  $TotalChildSum = $this->app_model->CariJumlahChild($kode);
  $TotalChild = $TotalChildSum + 1 ;
  $data2['ItemID2'] = $kode .'-'. $TotalChild ;
  $data2['LinkID'] = $this->input->post('LinkID');
  $ItemNo = $this->input->post('ItemNo');
  $ItemNoDetail = $this->app_model->CariJumlahItemNo($kode);
  $ItemNoDetailSub = $ItemNoDetail + 1;
  $NoUrut2 = $this->app_model->CariNoUrut($this->input->post('LinkID'));
  $NoUrut = $NoUrut2 + 1 ;
  $data2['NoUrut'] = $NoUrut ;
  $data2['ItemNo'] = $ItemNo ;
  $data2['ItemNoDetailSub'] = $ItemNoDetailSub ;
  $data2['pesan'] = "Save Success !!!";
  echo json_encode($data2);  }   }

public function InfoBOM_Head(){
 $kode = $this->input->post('kode');
 $text = "SELECT * FROM Master_BOM1 WHERE SysID='$kode' AND IsDelete='0'";
 $tabel = $this->app_model->manualQuery($text);
 $row = $tabel->num_rows();
 if($row>0){
 foreach($tabel->result() as $t){
 $data['PartNo'] = $t->PartNo;
 $data['ItemNo'] = $t->ItemNo;
 $data['PartName'] = $t->PartName;
 $data['IDCust'] = $t->IDCust;
 $data['Code'] = $t->Code;
 $data['IDProject'] = $t->IDProject;
 $data['PackingType'] = $t->PackingType;
 $data['StdPack'] = $t->StdPack;
 $data['PartTypeID'] = $t->PartTypeID;
 $data['FGLocation'] = $t->FGLocation;
 $data['SupplierID'] = $t->SupplierID;
 $data['QtyPerCar'] = $t->QtyPerCar;
 $data['SupplierName'] = $t->partner_code;
 $data['IsActive'] = $t->IsActive;
 echo json_encode($data); }
 }else{  
 $data['PartNo'] = '' ;
 $data['PartName'] = '' ;
 $data['IDCust'] = '' ;
 $data['IDProject'] = '' ;
 echo json_encode($data); } }
    
public function InfoBOM_Detail(){
 $kode = $this->input->post('kode');
 $text = "SELECT * FROM Master_BOM WHERE SysID2='$kode'";
 $tabel = $this->app_model->manualQuery($text);
 $row = $tabel->num_rows();
 if($row>0){
 foreach($tabel->result() as $t){
 $data['LinkID'] = $t->SysID ;
 $data['NoUrut'] = $t->NoUrut ;
 $data['ItemNoDetail'] = $t->ItemNo ;
 $data['ItemNoDetailSub'] = $t->ItemNoSub ;      
 $data['PartNo'] = $t->PartNo ;
 $data['PartName'] = $t->PartName ;
 $data['PackingType'] = $t->PackingType ;
 $data['StdPack'] = $t->StdPack ;
 $data['LevelPart'] = $t->LevelPart ;
 $data['PartTypeID'] = $t->PartTypeID ;
 $data['QtyPerCar'] = $t->QtyPerCar ;
 $data['SupplierID'] = $t->SupplierID ;
 $data['SupplierName'] = $t->partner_name ;
 $data['MaterialType'] = $t->MaterialTypeID ;
 $data['Spec'] = $t->Spec ;
 $data['Width'] = $t->Width ;
 $data['Thick'] = $t->Thick ;
 $data['Length'] = $t->Length ;
 $data['PcsPerSheet'] = $t->PcsPerSheet ;
 $data['KgPerSheet'] = $t->KgPerSheet ;
 $data['PartWeight'] = $t->PartWeight ;
 $data['OP5'] = $t->OP5 ; 
 $data['OP10'] = $t->OP10 ; 
 $data['OP20'] = $t->OP20 ; 
 $data['OP30'] = $t->OP30 ; 
 $data['OP40'] = $t->OP40 ; 
 $data['OP50'] = $t->OP50 ; 
 $data['OP60'] = $t->OP60 ;
 $data['OP70'] = $t->OP70 ;
 $data['OP5M'] = $t->OP5M ;
 $data['OP10M'] = $t->OP10M ;
 $data['OP20M'] = $t->OP20M ;
 $data['OP30M'] = $t->OP30M ;
 $data['OP40M'] = $t->OP40M ;
 $data['OP50M'] = $t->OP50M ;
 $data['OP60M'] = $t->OP60M ;
 $data['OP70M'] = $t->OP70M ;
 $data['ProcessAssy'] = $t->ProcessAssy ;
 $data['ProcessAssyM'] = $t->LineAssy ;
 echo json_encode($data); }
 }else{  
 $data['PartNo'] = '' ;
 $data['PartName'] = '' ;
 $data['IDCust'] = '' ;
 $data['IDProject'] = '' ;
 echo json_encode($data); } }
 
public function InfoPartner(){
 $kode = $this->input->post('kode');
 $text = "SELECT * FROM M_Partner WHERE id='$kode' AND IsDelete='X'";
 $tabel = $this->app_model->manualQuery($text);
 $row = $tabel->num_rows();
 if($row>0){
 foreach($tabel->result() as $t){ 
 $data['partner_code']= $t->partner_code;
 $data['partner_name']= $t->partner_name;
 $data['address']= $t->address;
 $data['telp']= $t->telp;
 echo json_encode($data); }
 }else{
 $data['partner_code']= '';
 $data['partner_name']= '';
 $data['address']= '';
 $data['telp']= '';
 echo json_encode($data); } }
 
public function ExportProduct(){
 $data['judul']="Master Product";
 $CustID =$this->uri->segment(3);
 $DB = $this->MasterProdMaterial_model->ExportProduct($CustID);
 $data['data']=$DB->result();
 $data['num'] = $DB->num_rows();
 $this->load->view('MasterProdMaterial/ExportProduct',$data); }   

public function Hapus_Product(){
 $up['IsDelete'] = "O" ;
 $id_d['RegID'] = $this->input->post('ItemID'); 
 $data = $this->app_model->getSelectedData("M_Product",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("M_Product",$up,$id_d);
 echo 'Data berhasil dihapus bro' ;
 }else{        
 echo 'Gagal Menghapus bro';		
 } 	}
    

                       
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
       
}