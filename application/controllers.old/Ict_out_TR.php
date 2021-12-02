<?php
class Ict_out_TR extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model(array('Material_in_TR_model','app_model','Ict_out_TR_model'));
        
        $this->load->library(array('form_validation','template'));
        $cek = $this->session->userdata('TrcICT')=='1';
        if(!$this->session->userdata('username')){ redirect('welcome');  } 
        elseif(empty($cek)){ redirect('welcome'); }
    }    
    /**///**/
    
    function index(){
        $d['title']="Home";
        
        $text5 = "SELECT * FROM M_QCCheck WITH (NOLOCK) WHERE Category LIKE '%STP%' ";
        $d['M_QCCheck'] = $this->app_model->manualQuery($text5);
        $MasterList=$this->Ict_out_TR_model->MasterList();
        $d['MListProduct'] = $MasterList->result(); 
        $text6 = "SELECT * FROM M_Shift2 WITH (NOLOCK)";
        $d['M_Shift'] = $this->app_model->manualQuery($text6);
        $text2 = "SELECT * FROM M_Partner ORDER BY id DESC" ;
        $d['MListPartner'] = $this->app_model->manualQuery($text2);
        $MListPartner = $this->Ict_out_TR_model->MListPartner();
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
        $this->template->display('Ict_out_TR/index',$d);
    }
    /**///**/
    
    public function transaction_list()
    {
        $cek=$this->Ict_out_TR_model->transaction_list();
        $data['list']=$cek->result();
        $this->load->view('Ict_out_TR/transaction_list',$data);
    }    
    /**///**/
    
    
    function transaction_detail(){
        $id = $this->input->post('kode');
        $cek =$this->Ict_out_TR_model->transaction_detail($id);
                
        $data['list']=$cek->result();
        //echo $cek;                                        
        $this->load->view('Ict_out_TR/transaction_detail',$data); 
    }
    /**{{}}**/
    
        public function InfoTambahFormTRMatIn(){ 
        $id = $this->input->post('kode');
        if(empty($id)){
            $DocNumDetail = '001'   ; 
            $DocNum = $this->app_model->DocNumMaterialOUTICTOther();
        }else{
            $DocNumDetail = $this->app_model->DocNumDetailictOUTTR($id);
            $id = $this->input->post('kode');  
        }
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
        $up['DocNum'] = $this->app_model->DocNumMaterialOUTICTOther() ;
        $up['CreateDate'] = $CreateDateSQL ;
        $up['DocDate'] = $CreateDateSQL ;
        $up['CreateBy'] = $this->session->userdata('RegID');
        $up['CreateTime'] = $CreateTime ;
        $id['DocNum'] = $this->app_model->DocNumMaterialOUTICTOther();
        $id['CreateBy'] = $this->session->userdata('RegID');
        $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
        if($data->num_rows()>0){
        }else{
            $this->app_model->insertData("G_DocNumMat",$up);
        }  
    }
    
    /**{{}}**/
    
     function MasterList(){
        $DB=$this->Ict_out_TR_model->MasterList();
        $data['MListProduct']=$DB->result();
        $this->load->view('Ict_out_TR/master_list',$data); 
     } 
    /**{{}}**/
    
    public function InfoMaterial_product()
    {
        $kode = $this->input->post('kode');
        $text = "SELECT * FROM Q01_MProduct WHERE RegID='$kode' AND IsDelete='X'";
        $tabel = $this->app_model->manualQuery($text);
        $row = $tabel->num_rows();
         if($row>0)
         { 
             foreach($tabel->result() as $t)
             {
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
                 echo json_encode($data); 
             }
         }
         else
         {  
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
             echo json_encode($data); 
         } 
     }   
     
     /**{{}}**/
     
    function Save(){
        $Header['DocNum'] = $this->input->post('DocNum');
        $Header['DocDate']         = $this->app_model->tgl_sql($this->input->post('DocDate'));
        $Header['DocTime']         = $this->input->post('CreateTime');
        $Header['CreateBy']        = $this->session->userdata('RegID') ;
        $Header['CreateDate']      = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
        $Header['HideH']           = md5($this->input->post('DocNum')) ;
        $Header['IDTrcType']       = '2020';
        $Detail['CreateBy']             = $this->session->userdata('RegID') ;
        $Detail['DocNum']               = $this->input->post('DocNum') ;
        $Detail['DocNumDetail']         = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ;
        $Detail['HideH']                = md5($this->input->post('DocNum')) ;
        $Detail['HideD']                = md5($this->input->post('DocNum') ."". $this->input->post('DocNumDetail')) ;
        $Detail['DocDate']              = $this->app_model->tgl_sql($this->input->post('DocDate'));
        $Detail['DocTime']              = $this->input->post('CreateTime');
        $Detail['CreateDate']           = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
        $Detail['ItemID']               = $this->input->post('ItemID') ;
        $Detail['QtyMat']               = $this->input->post('QtyMat') ;  
        $Detail['BalMat']               = $this->input->post('QtyMat') ;  
        $Detail['Amount']               = $this->input->post('Amount') ;
        $Detail['BalAmount'] = $this->input->post('Amount') ;
        $Detail['SourceDocNum']         = $this->input->post('PONum') ;
        
        $Detail['IDPic'] = $this->input->post('IDPic') ;
        
        //$Detail['SJNum']                = $this->input->post('SJNum') ;
        //$Detail['SJDate']               = $this->app_model->tgl_sql($this->input->post('SJDate')) ;
        $Detail['PartnerID']            = $this->input->post('PartnerID') ;  
        //$Detail2['Price']          = $this->input->post('Price') ;
        $Detail2['StockWip']          = $this->input->post('Balance') ;            
        $IndexHeader['DocNum']               = $this->input->post('DocNum');
        $IndexHeader['CreateBy']             = $this->session->userdata('RegID') ;
        $IndexDetail['DocNum']               = $this->input->post('DocNum');
        $IndexDetail['DocNumDetail']         = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ; 
        $IndexDetail2['RegID']               = $this->input->post('ItemID') ; 
        $IndexDetail3['DocNumDetail'] = $this->input->post('DocNumDetail3') ;
        $IndexDetail3['CreateBy']      = $this->session->userdata('RegID') ;
        $IndexHeader2['DocNum']               = $this->input->post('DocNum');
        $DocNumDetail2 = $this->input->post('DocNumDetail3') ;
        
        //cek stok
        $stockdb = $this->app_model->db_get_one("SELECT StockWip FROM M_Product WHERE RegID='".$this->input->post('ItemID')."'");
        if(floatval($this->input->post('StockWIP2')) != floatval($stockdb))
        {
            echo "Silahkan Ulangi Kembali, Transaksi telah digunakan.. Stock Berubah";
            die();
        }
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
                }	
            }else{
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
        } } 	 
    }     
    
    /**{{}}**/   
    function transaction_detail_2(){
     $id = $this->input->post('kode');
     $cek =$this->Ict_out_TR_model->transaction_detail($id);
     $data['list']=$cek->result();
     $this->load->view('Ict_out_TR/transaction_detail_2',$data); 
    }
    /**{{}}**/
    
    public function InfoTambahFormDetailTRMatIN()
    {
        //Time SERVER,
        date_default_timezone_set('Asia/Jakarta');		    
        $CreateDate = date('d-m-Y');
        $DocDate = date('d-m-Y');
        $CreateDateSQL = date('Y-m-d');
        $CreateTime = date ("H:i:s") ;
        $id = $this->input->post('kode');
        $DocNumDetail = $this->app_model->DocNumDetailictOUTTR($id);
        $data['DocNumDetail'] = $DocNumDetail ; 
        $data['CreateDate'] = $CreateDate ;
        $data['DocDate'] = $DocDate ;
        $data['CreateTime'] = $CreateTime ;
        echo json_encode($data); 
    }  
 
    /**{{}}**/ 
    
    public function Hapus_Detail()
    {
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
        
        $QtyMat = $this->app_model->db_get_one("SELECT QtyMat FROM TD_RawMaterial WHERE DocNumDetail LIKE '".$this->input->post('DocNumDetailDelete')."'");
        $ItemID = $this->app_model->db_get_one("SELECT ItemID FROM TD_RawMaterial WHERE DocNumDetail LIKE '".$this->input->post('DocNumDetailDelete')."'");
        
        $stock = $this->app_model->db_get_one("SELECT StockWip FROM M_Product WHERE RegID LIKE '".$ItemID."'");
        $new_stock = floatval($stock) + floatval($QtyMat);
        
        if($data->num_rows()>0)
        {
            $this->app_model->updateData("TD_RawMaterial",$up,$id_d);
            $this->app_model->updateData("M_Product",array('StockWip'=>$new_stock),array('RegID'=>$ItemID));
            echo 'Data berhasil d hapus bro' ;
        }
        else
        {        
            echo 'Anda bukan User Data';		
        } 
    }
    /**{{}}**/ 
 
    public function ReadReport()
    {
        $tgl1 = $this->app_model->tgl_sql($this->input->post('tgl1'));
        $tgl2 = $this->app_model->tgl_sql($this->input->post('tgl2'));
        $IDCategory = $this->input->post('IDCategory');
        $ItemID = $this->input->post('ItemID2');
        $PartnerID = $this->input->post('PartnerID2');       
        
        $cek = $this->Ict_out_TR_model->transaction_detail_report($tgl1,$tgl2,$IDCategory,$ItemID,$PartnerID);
        $d['list']=$cek->result();              
        $this->load->view('Ict_out_TR/transaction_detail_report',$d);
    }
    /**{{}}**/
    
    public function ExportReport()
    {
        $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
        $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
        $IDCategory = $this->uri->segment(6);
        $PartnerID = $this->uri->segment(5);
        $ItemID = $this->uri->segment(7);
        $filter = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);
        if($IDCategory!='semua')
        {
            $d['IDCategory'] = $this->app_model->CariCategoryName($this->uri->segment(6));
        }
        else
        {
            $d['IDCategory'] = "ALL";  
        }
        if($PartnerID!='ALL')
        {
            $d['PartnerID'] = $this->app_model->CariPartnerName($this->uri->segment(5));
        }
        else
        {
            $d['PartnerID'] = "ALL"; 
        }
        $d['ItemID'] = $this->app_model->CariProductName($this->uri->segment(7));  
        $d['judul'] = "TR ICT - Out"  ;
        $d['filter'] = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);        
        
        $cek = $this->Ict_out_TR_model->transaction_detail_report($tgl1,$tgl2,$IDCategory,$ItemID,$PartnerID);
        $d['data']=$cek->result(); 
        $d['num'] = $cek->num_rows();                
        $this->load->view('Ict_out_TR/ExportListReport',$d); 
    }
    /**{{}}**/    
    
    function MasterListPic()
    {
        $DB=$this->Ict_out_TR_model->MasterListPic();
        $data['MListProduct']=$DB->result();
        $this->load->view('Ict_out_TR/master_list_pic',$data); 
    }
    /**{{}}**/
    
    function MasterList2()
    {
        $DB=$this->Ict_out_TR_model->MasterList();
        $data['MListProduct']=$DB->result();
        $this->load->view('Ict_out_TR/master_list2',$data); 
    }     
    /**{{}}**/      
 }