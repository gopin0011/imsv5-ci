<?php
class Material_in_GA extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('Material_in_GA_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->TrcGA();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 
 $text5 = "SELECT * FROM M_QCCheck WITH (NOLOCK) WHERE Category LIKE '%STP%' ";
 $d['M_QCCheck'] = $this->app_model->manualQuery($text5);
 $MasterList=$this->Material_in_GA_model->MasterList();
 $d['MListProduct'] = $MasterList->result(); 
 $text6 = "SELECT * FROM M_Shift2 WITH (NOLOCK)";
 $d['M_Shift'] = $this->app_model->manualQuery($text6);
 $text2 = "SELECT * FROM M_Partner ORDER BY id DESC" ;
 $d['MListPartner'] = $this->app_model->manualQuery($text2);
 $MListPartner = $this->Material_in_GA_model->MListPartner();
 $d['MasterPartner'] = $MListPartner->result(); 
 $text3 = "SELECT * FROM M_customer ";
 $d['l_cust'] = $this->app_model->manualQuery($text3);
 $text4 = "SELECT * FROM M_Category WHERE GroupBy='TR' ORDER BY id DESC" ;
 $d['MListCategory'] = $this->app_model->manualQuery($text4);
        
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$DocDate	            = date('d-m-Y');
$d['DocDateReport_2']= date('d-m-Y');
$d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
$d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
$d['DocDateReport_2']= $DocDate ;
$this->template->display('Material_in_GA/index',$d);  }
    
function MasterList(){
 $DB=$this->Material_in_GA_model->MasterList();
 $data['MListProduct']=$DB->result();
 $this->load->view('Material_in_GA/master_list',$data); } 
 
function MasterList2(){
 $DB=$this->Material_in_GA_model->MasterList();
 $data['MListProduct']=$DB->result();
 $this->load->view('Material_in_GA/master_list2',$data); }    
 
function MasterListPartner(){
 $DB=$this->Material_in_GA_model->MListPartner();
 $data['MasterListPartner']=$DB->result();
 $this->load->view('Material_in_GA/master_partner',$data); }
    
public function InfoMaterial_product(){
 $kode = $this->input->post('kode');
 $text = "SELECT * FROM Q01_MProduct WHERE RegID='$kode' AND IsDelete='X'";
 $tabel = $this->app_model->manualQuery($text);
 $row = $tabel->num_rows();
 if($row>0){ foreach($tabel->result() as $t){
 $data['PartNo'] = $t->PartNo;
 $data['PartName'] = $t->PartName;
 $data['IDCust'] = $t->IDCust;
 $data['IDProject'] = $t->IDProject;
 $data['CustName'] = $t->CustName;
 $data['CustName2'] = $t->CustName .' '. $t->ProjectName;
 $data['Spec1'] = $t->Spec1;
 $data['Spec2'] = $t->Spec2;
 $data['Spec'] = $t->Spec1.' '.$t->Spec2;
 $data['PcsPerday'] = $t->PcsPerday;
 $data['PcsPerSheet'] = $t->PcsPerSheet;
 $data['PcsPerKg'] = $t->PcsPerKg;
 $data['Category'] = $t->category_name;
 $data['Unit'] = $t->unit;
 $data['Price'] = $t->Price;
 $data['StockWip'] = $t->StockWip;
 $data['StockFG'] = $t->StockFG;
 $data['StockWIP2'] = $t->StockWIP2;
 $data['MaterialType'] = $t->MaterialType;
 $data['Min'] = $t->Min;
 $data['Max'] = $t->Max;
 $data['IsActive'] = $t->IsActive;
 $data['MaterialNum'] = $t->MaterialNum;
 $data['DeliveryNum'] = $t->DeliveryNum;
 $data['MaterialName'] = $t->MaterialName;
 $data['StdPack'] = $t->StdPack;
 $data['CP1'] = $t->CP1;
 $data['CP2'] = $t->CP2;
 $data['CP3'] = $t->CP3;
 $data['CP4'] = $t->CP4;
 $data['CP5'] = $t->CP5;
 $data['CP6'] = $t->CP6;
 $data['CP7'] = $t->CP7;
 $data['CP8'] = $t->CP8;
 $data['CP9'] = $t->CP9;
 $data['CP10'] = $t->CP10;
 $data['CP11'] = $t->CP11;
 $data['CP12'] = $t->CP12;
 $data['IDCategory'] = $t->IDCategory;
 $data['IDUnit'] = $t->IDUnit;
 $data['IsWIP'] = $t->IsWIP; 
 echo json_encode($data); }
 }else{  
 $data['PartNo'] = '' ;
 $data['PartName'] = '' ;
 $data['IDCust'] = '' ;
 $data['IDProject'] = '' ;
 $data['CustName'] = '' ;
 $data['Spec1'] = '' ;
 $data['Spec2'] = '' ;
 $data['PcsPerday'] = '' ;
 $data['PcsPerSheet'] = '' ;
 $data['PcsPerKg'] = '' ;
 $data['Category'] = '' ;
 $data['Unit'] = '' ;
 $data['Price'] = '' ;
 $data['StockWip'] = '' ;
 $data['StockFG'] = '' ;
 $data['StockWIP2'] = '' ;
 $data['MaterialType'] = '' ;
 $data['Min'] = '' ;
 $data['Max'] = '' ;
 $data['IsActive'] = '' ;
 $data['MaterialNum'] = '' ;
 $data['DeliveryNum'] = '' ;
 $data['MaterialName'] = '' ;
 $data['CP1'] = '' ;
 $data['CP2'] = '' ;
 $data['CP3'] = '' ;
 $data['CP4'] = '' ;
 $data['CP5'] = '' ;
 $data['CP6'] = '' ;
 $data['CP7'] = '' ;
 $data['CP8'] = '' ;
 $data['CP9'] = '' ;
 $data['CP10'] = '' ;
 $data['CP11'] = '' ;
 $data['CP12'] = '' ;
 $data['IDCategory'] = '' ;
 $data['IDUnit'] = '' ;
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
  
public function InfoTambahFormDetailTRMatIN(){
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');		    
 $CreateDate = date('d-m-Y');
 $DocDate = date('d-m-Y');
 $CreateDateSQL = date('Y-m-d');
 $CreateTime = date ("H:i:s") ;
 $id = $this->input->post('kode');
 $DocNumDetail = $this->app_model->DocNumDetailMaterialINTR($id);
 $data['DocNumDetail'] = $DocNumDetail ; 
 $data['CreateDate'] = $CreateDate ;
 $data['DocDate'] = $DocDate ;
 $data['CreateTime'] = $CreateTime ;
 echo json_encode($data); }            
    
function transaction_list(){
 $cek=$this->Material_in_GA_model->transaction_list();
 $data['list']=$cek->result();
 $this->load->view('Material_in_GA/transaction_list',$data); }
    
public function DetailPrint(){
 $d['judul'] = "Data Material Masuk";
 $id = $this->uri->segment(3);
 $cek =$this->Material_in_GA_model->transaction_detail($id);
 $d['data']=$cek->result();					
 $this->load->view('Material_in_GA/PrintMaterialIn',$d);  }
    
public function PrintList(){
 $d['judul'] = "Data Material Masuk";
 $id = $this->uri->segment(3);
 $text = "SELECT * FROM QTH_RawMaterial WHERE DocNum='$id'";
 $data2 = $this->app_model->manualQuery($text);
 if($data2->num_rows() > 0){
 foreach($data2->result() as $db){
 $d['DocNum']	= $id;
 $d['DocDate']	= $this->app_model->tgl_str($db->DocDate);
 $d['judul']= "Transaksi Material Masuk" ; 
 $d['UserName']	= $db->CreateBy; }
 }else{
 $d['DocNum']		='';
 $d['DocDate']	='';
 $d['judul']= "Transaksi Material Masuk" ; 
 $d['UserName']	= ''; } 
 $cek =$this->Material_in_GA_model->transaction_detail($id);
 $d['data']=$cek->result();
 $d['num'] = $cek->num_rows();					
 $this->load->view('Material_in_GA/ExportList',$d); }
    
public function PrintList2(){
 $DocDateReport_1 = $this->app_model->tgl_sql($this->uri->segment(3));
 $DocDateReport_2 = $this->app_model->tgl_sql($this->uri->segment(4));
 $IDCust = $this->uri->segment(5);
 $PartnerID = $this->uri->segment(6);
 $DocNum = $this->uri->segment(7);

 $d['judul'] = "";
 $d['filter'] = $this->app_model->tgl_str($DocDateReport_1).' ~ '.$this->app_model->tgl_str($DocDateReport_2);
 $d['filter2'] = 'Tgl '.$this->app_model->tgl_str($DocDateReport_1).' - '.$this->app_model->tgl_str($DocDateReport_2);
 if($IDCust!='semua'){
 $d['IDCust'] = $this->app_model->CariCustName($this->uri->segment(5));}else{
            $d['IDCust'] = "All Customer";
          }
          if($PartnerID!='ALL'){
          $d['PartnerID'] = $this->app_model->CariPartnerName($this->uri->segment(6));}else{
            $d['PartnerID'] = "All Supplier";
          }
          $d['ItemID'] = $this->app_model->CariProductName($this->uri->segment(7));           
			
			
            $cek = $this->Material_in_GA_model->transaction_detail_report($DocDateReport_1,$DocDateReport_2,$IDCust,$DocNum,$PartnerID);
            $Stock = $this->Material_in_GA_model->Stock_List();
            $d['data']=$cek->result(); 
            $d['num'] = $cek->num_rows();                
			$this->load->view('Material_in_GA/PrintList2',$d);
	}
                     
function transaction_detail(){
 $id = $this->input->post('kode');
 $cek =$this->Material_in_GA_model->transaction_detail($id);
 $data['list']=$cek->result();
 $this->load->view('Material_in_GA/transaction_detail',$data); }
    
function transaction_detail_2(){
 $id = $this->input->post('kode');
 $cek =$this->Material_in_GA_model->transaction_detail($id);
 $data['list']=$cek->result();
 $this->load->view('Material_in_GA/transaction_detail_2',$data); }
    

public function ReadReport(){
 $tgl1 = $this->app_model->tgl_sql($this->input->post('tgl1'));
 $tgl2 = $this->app_model->tgl_sql($this->input->post('tgl2'));
 $IDCategory = $this->input->post('IDCategory');
 $ItemID = $this->input->post('ItemID2');
 $PartnerID = $this->input->post('PartnerID2');       
			
 $cek = $this->Material_in_GA_model->transaction_detail_report($tgl1,$tgl2,$IDCategory,$ItemID,$PartnerID);
 $d['list']=$cek->result();              
 $this->load->view('Material_in_GA/transaction_detail_report',$d);
	}
    
public function ExportReport(){
 $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
 $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
 $IDCategory = $this->uri->segment(6);
 $PartnerID = $this->uri->segment(5);
 $ItemID = $this->uri->segment(7);
 $filter = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);
 if($IDCategory!='semua'){
 $d['IDCategory'] = $this->app_model->CariCategoryName($this->uri->segment(6));}else{
 $d['IDCategory'] = "ALL";  }
 if($PartnerID!='ALL'){
 $d['PartnerID'] = $this->app_model->CariPartnerName($this->uri->segment(5));}else{
 $d['PartnerID'] = "ALL"; }
 $d['ItemID'] = $this->app_model->CariProductName($this->uri->segment(7));  
 $d['judul'] = "TR Product - IN"  ;
 $d['filter'] = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);        

 $cek = $this->Material_in_GA_model->transaction_detail_report($tgl1,$tgl2,$IDCategory,$ItemID,$PartnerID);
 $d['data']=$cek->result(); 
 $d['num'] = $cek->num_rows();                
 $this->load->view('Material_in_GA/ExportListReport',$d); }
    
   
    public function RegDocNumSony_Head(){
        
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '0001'   ; 
            $DocNum                 = $this->app_model->DocNumInSony();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailInSony($id);
             $id = $this->input->post('kode');             
            }

			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            
            $CreateTime2	            = date ("H:i") ;
            
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['DocNum'] = $DocNum ;
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;
                
                echo json_encode($data);

            //Time SERVER,
date_default_timezone_set('Asia/Jakarta');	

            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            
            $up['DocNum']		    = $this->app_model->DocNumInSony() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumInSony();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
            
            
            public function RegDocNumSony_Detail(){
        
          $id = $this->input->post('kode');
          $DocNumDetail	        = $this->app_model->DocNumDetailInSony($id);
          $data['DocNumDetail'] = $DocNumDetail ;
             
          echo json_encode($data);
             }

public function InfoTambahFormTRMatIn(){ 
 $id = $this->input->post('kode');
 if(empty($id)){
 $DocNumDetail = '001'   ; 
 $DocNum = $this->app_model->DocNumMaterialINRMOther();
 }else{
 $DocNumDetail = $this->app_model->DocNumDetailMaterialINTR($id);
 $id = $this->input->post('kode');  }
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');		    
 $CreateDate = date('d-m-Y');
 $DocDate = date('d-m-Y');
 $CreateDateSQL = date('Y-m-d');
 $CreateTime = date ("H:i:s") ;
 $data['DocNumDetail'] = $DocNumDetail ; 
 $data['DocNum'] = $DocNum ;
 $data['CreateDate']	= $CreateDate ;
 $data['DocDate']	    = $DocDate ;
 $data['CreateTime']	= $CreateTime ;
 echo json_encode($data);
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');	
 $CreateDate	            = date('d-m-Y');
 $DocDate	            = date('d-m-Y');
 $CreateDateSQL	        = date('Y-m-d');
 $CreateTime	            = date ("H:i:s") ;
 $up['DocNum'] = $this->app_model->DocNumMaterialINRMOther() ;
 $up['CreateDate'] = $CreateDateSQL ;
 $up['DocDate'] = $CreateDateSQL ;
 $up['CreateBy'] = $this->session->userdata('RegID');
 $up['CreateTime'] = $CreateTime ;
 $id['DocNum'] = $this->app_model->DocNumMaterialINRMOther();
 $id['CreateBy'] = $this->session->userdata('RegID');
 $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
 if($data->num_rows()>0){
 }else{
 $this->app_model->insertData("G_DocNumMat",$up);
 }  }
                         
   
   public function DetailPrint2()
	{

            $id = $this->uri->segment(3);
			$kode = $this->uri->segment(4);
            
			$d['judul'] = "Data Material Masuk";
			
			$id = $this->uri->segment(3);
            $id2 = $this->uri->segment(4);
			$text = "SELECT * FROM QTD_Trace WHERE DocNumDetail='$id'";
			$data = $this->app_model->manualQuery($text);
			if($data->num_rows() > 0){
				foreach($data->result() as $db){
				    
					$d['DocNum']	= $id;
					$d['DocDate']	= $this->app_model->tgl_indo($db->DocDate);
                    			         	
				}
			}else{
					$d['DocNum']		=$id;
					$d['DocDate']	    ='';
				
			} 
            $cek =$this->Material_in_GA_model->transaction_detail2($id);
            $d['data']=$cek->result();					
			$this->load->view('Material_in_GA/PrintMaterialIn',$d);          
 	}
            
        
function Save(){
 $Header['DocNum'] = $this->input->post('DocNum');
 $Header['DocDate']         = $this->app_model->tgl_sql($this->input->post('SJDate'));
 $Header['DocTime']         = $this->input->post('CreateTime');
 $Header['CreateBy']        = $this->session->userdata('RegID') ;
 $Header['CreateDate']      = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
 $Header['HideH']           = md5($this->input->post('DocNum')) ;
 $Header['IDTrcType']       = '130';
 $Detail['CreateBy']             = $this->session->userdata('RegID') ;
 $Detail['DocNum']               = $this->input->post('DocNum') ;
 $Detail['DocNumDetail']         = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ;
 $Detail['HideH']                = md5($this->input->post('DocNum')) ;
 $Detail['HideD']                = md5($this->input->post('DocNum') ."". $this->input->post('DocNumDetail')) ;
 $Detail['DocDate']              = $this->app_model->tgl_sql($this->input->post('SJDate'));
 $Detail['DocTime']              = $this->input->post('CreateTime');
 $Detail['CreateDate']           = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
 $Detail['ItemID']               = $this->input->post('ItemID') ;
 $Detail['QtyMat']               = $this->input->post('QtyMat') ;  
 $Detail['BalMat']               = $this->input->post('QtyMat') ;  
 $Detail['Amount']               = $this->input->post('Amount') ;
 $Detail['BalAmount'] = $this->input->post('Amount') ;
 $Detail['SourceDocNum']         = $this->input->post('PONum') ;
 $Detail['SJNum']                = $this->input->post('SJNum') ;
 $Detail['SJDate']               = $this->app_model->tgl_sql($this->input->post('SJDate')) ;
 $Detail['PartnerID']            = $this->input->post('PartnerID') ;  
 $Detail2['Price']          = $this->input->post('Price') ;              
 $IndexHeader['DocNum']               = $this->input->post('DocNum');
 $IndexHeader['CreateBy']             = $this->session->userdata('RegID') ;
 $IndexDetail['DocNum']               = $this->input->post('DocNum');
 $IndexDetail['DocNumDetail']         = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ; 
 $IndexDetail2['RegID']               = $this->input->post('ItemID') ; 
 $IndexDetail3['DocNumDetail'] = $this->input->post('DocNumDetail3') ;
 $IndexDetail3['CreateBy']      = $this->session->userdata('RegID') ;
 $IndexHeader2['DocNum']               = $this->input->post('DocNum');
 $DocNumDetail2 = $this->input->post('DocNumDetail3') ;
 $data = $this->app_model->getSelectedData("TH_RawMaterial",$IndexHeader);
 if($data->num_rows()>0){
 if(empty($DocNumDetail2)){
 $data = $this->app_model->getSelectedData("TD_RawMaterial",$IndexDetail);
 if($data->num_rows()>0){
 echo 'Data sudah diinput' ;
 }else{
 $this->app_model->insertData("TD_RawMaterial",$Detail);
 $this->app_model->updateData("M_Product",$Detail2,$IndexDetail2); 
 echo 'Tambah data Sukses' ;
 }	}else{
 $data = $this->app_model->getSelectedData("TD_RawMaterial",$IndexDetail3);
 if($data->num_rows()>0){
 $this->app_model->updateData("TD_RawMaterial",$Detail,$IndexDetail3);
 $this->app_model->updateData("M_Product",$Detail2,$IndexDetail2);
 echo 'Data berhasil diupdate' ;
 }else{
 echo 'Silahkan Login Menggunakan User Data !!!' ;} }
 }else{ 
 if(empty($DocNumDetail2)){
 $data = $this->app_model->getSelectedData("TH_RawMaterial",$IndexHeader2);
 if($data->num_rows()>0){
 echo 'Silahkan Login Menggunakan User Data !!!' ;
 }else{
 $data = $this->app_model->getSelectedData("TD_RawMaterial",$IndexDetail);
 if($data->num_rows()>0){
 echo 'Data sudah diinput' ;
 }else{ 
 $this->app_model->insertData("TH_RawMaterial",$Header);
 $this->app_model->insertData("TD_RawMaterial",$Detail);
 $this->app_model->updateData("M_Product",$Detail2,$IndexDetail2); 
 echo 'Simpan data Sukses' ; }   } }else{
 echo 'Silahkan Login Menggunakan User Data !!!' ;
 } } 	 }
       
       
public function Hapus_Detail(){
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');
 $DocDate = $this->app_model->tgl_sql(date('d-m-Y'));
 $up['QtyMat'] = "0" ;
 $up['QtyPcs'] = "0" ;
 $up['BalMat'] = "0" ;
 $up['BalPcs'] = "0" ;
 $up['Amount'] = "0" ;
 $up['IsDelete'] = "O" ;
 $up['BalAmount'] = "0" ;
 $up['CreateBy'] = $this->session->userdata('RegID');
 $up['DocDate'] = $DocDate ;
 $id_d['DocNumDetail'] = $this->input->post('DocNumDetailDelete'); 
 $id_d['CreateBy'] = $this->session->userdata('RegID') ;
 $data = $this->app_model->getSelectedData("TD_RawMaterial",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("TD_RawMaterial",$up,$id_d);
 echo 'Data berhasil d hapus bro' ;
 }else{        
 echo 'Anda bukan User Data';		
 } }
    
    
public function InfoDataEdit() {
 $kode = $this->input->post('kode');
 $text = "SELECT * FROM QTD_RawMaterial WHERE DocNumDetail='$kode' " ;
 $tabel = $this->app_model->manualQuery($text);
 $row = $tabel->num_rows();
 if($row>0){
 foreach($tabel->result() as $t){ 
 //Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
 $CreateDate	            = date('d-m-Y');
 $DocDate	            = date('d-m-Y');
 $CreateDateSQL	        = date('Y-m-d');
 $CreateTime	            = date ("H:i:s") ;
 $data['CreateBy'] = $t->CreateBy;
 $data['DocNum']		       = $t->DocNum ;
 $data['DocNumDetail']	   = substr($t->DocNumDetail,12,3) ;
 $data['DocNumDetailOut']   = substr($t->DocNumDetail,13,3) ;
 $data['DocNumDetailRet']   = substr($t->DocNumDetail,12,3) ;
 $data['DocNumDetailTR']   = substr($t->DocNumDetail,13,3) ;
 $data['DocNumDetailTROUT']   = substr($t->DocNumDetail,14,3) ;
 $data['DocNumDetailGAIn']   = substr($t->DocNumDetail,15,3) ;
 $data['DocNumDetailGAOut']   = substr($t->DocNumDetail,15,3) ;
 $data['DocNumDetailInFG']   = substr($t->DocNumDetail,13,3) ;
 $data['DocNumDetail3']	   = $t->DocNumDetail ;
 $data['CreateTime']	       = $this->app_model->tgl_str($t->DocTime) ;
 $data['CreateDate']	       = $this->app_model->tgl_str($t->CreateDate) ;
 $data['DocDate']	       = $this->app_model->tgl_str($t->DocDate) ;
                $data['SJDate']	           = $this->app_model->tgl_str($t->SJDate) ;
                $data['ItemID']            = $t->ItemID;
                $data['PartNo']            = $t->PartNo;
                $data['PartName']          = $t->PartName;
                $data['IDCust']            = $t->IDCust;
                $data['Code']              = $t->Code;
                $data['Code2']              = $t->Code .' '. $t->ProjectName;
                $data['Spec1']             = $t->Spec1;
                $data['Spec2'] = $t->Spec2;
                $data['IDProject'] = $t->IDProject;
                $data['ProjectName'] = $t->ProjectName;
                $data['SJNum'] = $t->SJNum;
                $data['MatNum'] = $t->MatNum;
                $data['PartnerID'] = $t->PartnerID;
                $data['partner_code'] = $t->partner_code;
                $data['SourceDocNum'] = $t->SourceDocNum;
                $data['MaterialType'] = $t->MaterialType;
                $data['MaterialName'] = $t->MaterialName;
                $data['PcsPerSheet'] = $t->PcsPerSheet;
                $data['PcsPerKg'] = $t->PcsPerKg;
                $data['Category'] = $t->category_name;
                $data['Price'] = $t->Price;
                $data['Amount'] = $t->Amount;
                $data['StockWIP2'] = $t->StockWIP2;
                $data['StockFG'] = $t->StockFG;
                $data['Remark'] = $t->Remark;
                
                $data['QtyMat']	= $t->QtyMat ;
                $data['QtyPcs']	= $t->QtyPcs ;
                $data['BalMat']	= $t->BalMat ;
                $data['BalPcs']	= $t->BalPcs ;
                $data['BalAmount']	= $t->BalAmount ;
                
                
                
                
                $data['BalMatSource']	= $t->BalMatSource ;
                $data['BalPcsSource']	= $t->BalPcsSource ;
                $data['BalAmountSource']	= $t->BalAmountSource ;
                $data['ItemIDExt']	= $t->ItemIDExt ;
                
                $data['IDPic']	= $t->IDPic ;
                $data['nama_singkat']	= $t->nama_singkat ;
                
                $data['NGMat']	= $t->NGMatSheet ;
                
                $data['Qty2']	= $t->QtyMat + $t->NGPcsSheet ;
                
                $data['NGMatPcs']	= $t->NGPcsSheet ;
                $data['CanEdit'] = $t->CanEdit; 
                
                
                    
					echo json_encode($data);
				}
			}else{ 
			 
                $data['DocNum']		    = '' ;
                $data['DocNumDetail']	= '' ;
                $data['CreateTime']	= '' ;
                $data['CreateDate']	= '' ;
                $data['DocDate']	= '' ;
                $data['SJDate']	= '' ;
                $data['ItemID'] = '' ;
                $data['PartNo'] = '' ;
                $data['PartName'] = '' ;
                $data['IDCust'] = '' ;
                $data['Code'] = '' ;
                $data['Spec1'] = '' ;
                $data['Spec2'] = '' ;
                $data['IDProject'] = '' ;
                $data['ProjectName'] = '' ;
                $data['SJNum']= '' ;
                $data['MatNum'] = '' ;
                $data['PartnerID'] = '' ;
                $data['partner_code'] = '' ;
                $data['SourceDocNum'] = '' ;
                $data['MaterialType'] = '' ;
                $data['MaterialName'] = '' ;
                $data['PcsPerSheet'] = '' ;
                $data['PcsPerKg'] = '' ;
                
                $data['QtyMat']	= '' ;
                $data['QtyPcs']	= '' ;
                $data['BalMat']	= '' ;
                $data['BalPcs']	= '' ;
				echo json_encode($data);
			} }

function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }
    
function bikin_barcode($kode){
$this->load->library('zend');
$this->zend->load('Zend/Barcode');
Zend_Barcode::render('code128', 'image', array('text'=>$kode), array());
}       
       
}