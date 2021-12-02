<?php
class Material_return extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('Material_return_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->TrcMaterialUp();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 $text5 = "SELECT * FROM M_QCCheck WITH (NOLOCK) WHERE Category LIKE '%STP%' ";
 $d['M_QCCheck'] = $this->app_model->manualQuery($text5);
 $MasterList=$this->Material_return_model->MasterList();
 $d['MListProduct'] = $MasterList->result(); 
 $text6 = "SELECT * FROM M_Shift2 WITH (NOLOCK)";
 $d['M_Shift'] = $this->app_model->manualQuery($text6);
 $text2 = "SELECT * FROM M_Partner WHERE Category='RM' ORDER BY id DESC" ;
 $d['MListPartner'] = $this->app_model->manualQuery($text2); 
 $text3 = "SELECT * FROM M_customer ";
 $d['l_cust'] = $this->app_model->manualQuery($text3);      
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');
 $DocDate = date('d-m-Y');
 $d['DocDateReport_2']= date('d-m-Y');
 $d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
 $d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
 $d['DocDateReport_2']= $DocDate ;
 $this->template->display('Material_return/index',$d); }

function MasterList(){
 $DB=$this->Material_return_model->MasterList();
 $data['MListProduct']=$DB->result();
 $this->load->view('Material_return/master_list',$data); }    
    
public function InfoMaterial_product(){
 $kode = $this->input->post('kode');
 $text = "SELECT * FROM Master_BOM WHERE SysID2='$kode' AND IsDelete='0'";
 $tabel = $this->app_model->manualQuery($text);
 $row = $tabel->num_rows();
 if($row>0){
 foreach($tabel->result() as $t){
 $data['PartNo'] = $t->PartNo;
 $data['PartName'] = $t->PartName;
 $data['Spec2'] = $t->Spec .' '. $t->Thick .' X '. $t->Width .' X '. $t->Length;
 $data['Spec'] = $t->Spec;
 $data['SpecOrder'] = $t->SpecOrder1 .' '. $t->SpecOrder2 ;
 $data['Thick'] = $t->Thick;
 $data['Width'] = $t->Width;
 $data['Length'] = $t->Length;
 $data['IDCust'] = $t->IDCust;
 $data['IDProject'] = $t->IDProject;
 $data['CustName'] = $t->CustName;
 $data['CustName2'] = $t->CustName .' '. $t->ProjectName;
 $data['PcsPerSheet'] = $t->PcsPerSheet;
 $data['KgPerSheet'] = $t->KgPerSheet;
 $data['MaterialTypeID'] = $t->MaterialTypeID;
 $data['MaterialType'] = $t->MaterialType;
 echo json_encode($data); }
 }else{
 $data['PartNo'] = "";
 $data['PartName'] = "";
 $data['Spec2'] = "";
 $data['Spec'] = "";
 $data['SpecOrder'] = "";
 $data['Thick'] = "";
 $data['Width'] = "";
 $data['Length'] = "";
 $data['IDCust'] = "";
 $data['IDProject'] = "";
 $data['CustName'] = "";
 $data['CustName2'] = "";
 $data['PcsPerSheet'] = "";
 $data['KgPerSheet'] = "";
 $data['MaterialTypeID'] = "";
 $data['MaterialType'] = ""; 
 echo json_encode($data); }} 
                
public function InfoTambahFormDetail(){
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
 $CreateDate	            = date('d-m-Y');
 $DocDate	            = date('d-m-Y');
 $CreateDateSQL	        = date('Y-m-d');
 $CreateTime	            = date ("H:i:s") ;
 $id = $this->input->post('kode');
 $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOUT_New($id);
 $data['DocNumDetail'] = $DocNumDetail ; 
 $data['CreateDate']	= $CreateDate ;
 $data['DocDate']	    = $DocDate ;
 $data['CreateTime']	= $CreateTime ;
 echo json_encode($data); }            

function List_Material(){
 $cek=$this->Material_return_model->List_Material();
 $data['list']=$cek->result();
 $this->load->view('Material_return/List_Material',$data); }

function transaction_list(){
 $cek=$this->Material_return_model->transaction_list();
 $data['list']=$cek->result();
 $this->load->view('Material_return/transaction_list',$data); }
    
function transaction_detail(){
 $id = $this->input->post('id');
 $cek =$this->Material_return_model->transaction_detail($id);
 $data['list']=$cek->result();
 $this->load->view('Material_return/transaction_detail',$data); }
    
public function DetailPrint(){
 $d['judul'] = "Data Material Masuk";
 $id = $this->uri->segment(3);
 $cek =$this->Material_return_model->transaction_detail($id);
 $d['data']=$cek->result();					
 $this->load->view('Material_return/PrintMaterialIn',$d);  }
    
public function PrintList(){
 $d['judul'] = "Data Material Masuk";
 $id = $this->uri->segment(3);
 $text = "SELECT * FROM QTH_Trace WHERE DocNum='$id'";
 $data2 = $this->app_model->manualQuery($text);
 if($data2->num_rows() > 0){
 foreach($data2->result() as $db){
 $d['DocNum']	= $id;
 $d['DocDate']	= $this->app_model->tgl_str($db->DocDate);
 $d['judul']= "Transaksi Material Masuk" ; 
 $d['UserName']	= $db->username ; }
 }else{
 $d['DocNum']		='';
 $d['DocDate']	='';
 $d['judul']= "Transaksi Material Masuk" ; 
 $d['UserName']	= ''; } 
 $cek =$this->Material_return_model->transaction_detail($id);
 $d['data']=$cek->result();
 $d['num'] = $cek->num_rows();					
 $this->load->view('Material_return/PrintList',$d);   }
    
public function PrintList2(){
 $DocDateReport_1 = $this->app_model->tgl_sql($this->uri->segment(3));
 $DocDateReport_2 = $this->app_model->tgl_sql($this->uri->segment(4));
 $IDCust = $this->uri->segment(5);
 $DocNum = $this->uri->segment(6);
 $d['judul'] = "";
 $d['filter'] = $this->app_model->tgl_str($DocDateReport_1).' ~ '.$this->app_model->tgl_str($DocDateReport_2);
 $d['filter2'] = 'Tgl '.$this->app_model->tgl_str($DocDateReport_1).' - '.$this->app_model->tgl_str($DocDateReport_2);
 if($IDCust!='semua'){
 $d['IDCust'] = $this->app_model->CariCustName($this->uri->segment(5));}else{
 $d['IDCust'] = "All Customer"; }
 $d['ItemID'] = $this->app_model->CariProductName($this->uri->segment(7));           
 $cek = $this->Material_return_model->transaction_detail_report($DocDateReport_1,$DocDateReport_2,$IDCust,$DocNum);
 $Stock = $this->Material_return_model->Stock_List();
 $d['data']=$cek->result(); 
 $d['num'] = $cek->num_rows();                
 $this->load->view('Material_return/PrintList2',$d); }

function transaction_detail_2(){
 $id = $this->input->post('id');
 $cek =$this->Material_return_model->transaction_detail($id);
 $data['list']=$cek->result();
 $this->load->view('Material_return/transaction_detail_2',$data); }

public function ReadReport(){
 $DocDateReport_1 = $this->app_model->tgl_sql($this->input->post('DocDateReport_1'));
 $DocDateReport_2 = $this->app_model->tgl_sql($this->input->post('DocDateReport_2'));
 $IDCust = $this->input->post('IDCust2');
 $DocNum = $this->input->post('PartNo3');          
 $cek = $this->Material_return_model->transaction_detail_report($DocDateReport_1,$DocDateReport_2,$IDCust,$DocNum);
 $Stock = $this->Material_return_model->Stock_List();
 $d['list']=$cek->result();              
 $this->load->view('Material_return/transaction_detail_report',$d); }
    
public function ExportReport(){
 $DocDateReport_1 = $this->app_model->tgl_sql($this->uri->segment(3));
 $DocDateReport_2 = $this->app_model->tgl_sql($this->uri->segment(4));
 $IDCust = $this->uri->segment(5);
 $DocNum = $this->uri->segment(6);
 $d['filter'] = $this->app_model->tgl_str($DocDateReport_1).' ~ '.$this->app_model->tgl_str($DocDateReport_2);
 $d['filter2'] = 'Tgl '.$this->app_model->tgl_str($DocDateReport_1).' - '.$this->app_model->tgl_str($DocDateReport_2);
 if($IDCust!='semua'){
 $d['IDCust'] = $this->app_model->CariCustName($this->uri->segment(5));}else{
 $d['IDCust'] = "All Customer"; }
 $d['ItemID'] = $this->uri->segment(6);           
 $cek = $this->Material_return_model->transaction_detail_report($DocDateReport_1,$DocDateReport_2,$IDCust,$DocNum);
 $Stock = $this->Material_return_model->Stock_List();
 $d['data']=$cek->result(); 
 $d['num'] = $cek->num_rows();                
 $this->load->view('Material_return/ExportListReport',$d); }
    
public function RegDocNumSony_Head(){
 $id = $this->input->post('kode');
 if(empty($id)){
 $DocNumDetail	        = '0001'   ; 
 $DocNum                 = $this->app_model->DocNumInSony();
 }else{
 $DocNumDetail	        = $this->app_model->DocNumDetailInSony($id);
 $id = $this->input->post('kode');      }
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
 $DocNumDetail	        = $this->app_model->DocNumDetailRetSony($id);
 $data['DocNumDetail'] = $DocNumDetail ;
 echo json_encode($data); }
             
public function InfoTambahFormMatRet(){ 
 $id = $this->input->post('kode');
 if(empty($id)){
 $DocNumDetail	        = '001'   ; 
 $DocNum                 = $this->app_model->DocNumMaterialRetMPC();
 }else{
 $DocNumDetail	        = $this->app_model->DocNumDetailMaterialRet_New($id);
  $id = $this->input->post('kode');  }
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');		    
 $CreateDate	            = date('d-m-Y');
 $DocDate	            = date('d-m-Y');
 $CreateDateSQL	        = date('Y-m-d');
 $CreateTime	            = date ("H:i:s") ;
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
 $up['DocNum']		    = $this->app_model->DocNumMaterialRetMPC() ;
 $up['CreateDate']		= $CreateDateSQL ;
 $up['DocDate']		    = $CreateDateSQL ;
 $up['CreateBy']         = $this->session->userdata('RegID');
 $up['CreateTime']       = $CreateTime ;
 $id['DocNum']           = $this->app_model->DocNumMaterialRetMPC();
 $id['CreateBy']         = $this->session->userdata('RegID');
 $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
 if($data->num_rows()>0){
 }else{
 $this->app_model->insertData("G_DocNumMat",$up);  }  }
            
public function DetailPrint2(){
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
 $cek =$this->Material_return_model->transaction_detail2($id);
 $d['data']=$cek->result();					
 $this->load->view('Material_return/PrintMaterialIn',$d);   }
            
        
    function Save(){
        
        $QtySource = $this->app_model->CariJumlahSource($this->input->post('DocNumExt'));
        $QtySource2 = $this->input->post('BalMatSource');
            
            if($QtySource == $QtySource2){
          //Time SERVER,
date_default_timezone_set('Asia/Jakarta');


            $date_time = $this->app_model->tgl_sql(date('d-m-Y H:i:s'));
            $month =  $this->app_model->ambilBln2($this->input->post('DocDate'));
            $year = $this->app_model->ambilThn2($this->input->post('DocDate'));
            $ItemID_Ext = substr($this->input->post('ItemID'),0,10);

                $Header['DocNum'] = $this->input->post('DocNum');
                $Header['DocDate'] = $this->app_model->tgl_sql($this->input->post('DocDate'));
                $Header['DocTime'] = $this->input->post('CreateTime');
                $Header['CreateBy'] = $this->session->userdata('RegID') ;
                $Header['CreateDate'] = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
                $Header['LastUpdate'] = $date_time ;
                $Header['HideH'] = md5($this->input->post('DocNum')) ;
                $Header['TrcType'] = '3000';
                
				$Detail['CreateBy'] = $this->session->userdata('RegID') ;
                $Detail['DocNum'] = $this->input->post('DocNum') ;
                $Detail['DocNumDetail'] = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ;
                $Detail['HideH']  = md5($this->input->post('DocNum')) ;
                $Detail['HideD'] = md5($this->input->post('DocNum') ."". $this->input->post('DocNumDetail')) ;
                $Detail['DocDate'] = $this->app_model->tgl_sql($this->input->post('DocDate'));
                $Detail['DocTime'] = $this->input->post('CreateTime');
                $Detail['CreateDate'] = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
                $Detail['ItemID'] = $this->input->post('ItemID') ;
                $Detail['ItemID_Ext'] = $ItemID_Ext ;
                $Detail['Qty_1'] = $this->input->post('QtyMat') ;
                $Detail['Qty_2'] = $this->input->post('QtyPcs') ;
                $Detail['Qty_5'] = $this->input->post('NGMat') ;
                $Detail['Qty_3'] = $this->input->post('BalMatAf') ;
                $Detail['Qty_4'] = $this->input->post('BalPcsAf') ;
                $Detail['DocNum_Ext'] = $this->input->post('DocNumExt') ;   
                $Detail['PcsPerSheet'] = $this->input->post('PcsPerSheet') ;
                $Detail['KgPerSheet'] = $this->input->post('KgPerSheet') ;
                $Detail['MonthID'] = $month ;
                $Detail['YearID'] = $year ;    
                
                $Detail4['Qty_3'] = $this->input->post('BalMatSourceAf') ;
                $Detail4['Qty_4'] = $this->input->post('BalPcsSourceAf') ;           
                
                $IndexDetail4['DocNumDetail'] = $this->input->post('DocNumExt') ;
                
				$IndexHeader['DocNum'] = $this->input->post('DocNum');
                $IndexHeader['CreateBy'] = $this->session->userdata('RegID') ;
                
                $IndexHeader2['DocNum'] = $this->input->post('DocNum');
                
                $IndexDetail['DocNum'] = $this->input->post('DocNum');
                $IndexDetail['DocNumDetail'] = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ;
                 
				$IndexDetail3['DocNumDetail'] = $this->input->post('DocNumDetail3') ;
                $IndexDetail3['CreateBy'] = $this->session->userdata('RegID') ;
                
                $DocNumDetail2 = $this->input->post('DocNumDetail3') ;
                
				$data1 = $this->app_model->getSelectedData("TH_Trace",$IndexHeader);
				if($data1->num_rows()>0){
				if(empty($DocNumDetail2)){
                $data2 = $this->app_model->getSelectedData("TD_RawMaterial",$IndexDetail);
				if($data2->num_rows()>0){
				echo 'Data sudah diinput' ;
				}else{
                $this->app_model->insertData("TD_Trace",$Detail); 
                $this->app_model->updateData("TD_Trace",$Detail4,$IndexDetail4);
                echo 'Tambah data Sukses' ;
				}	}else{
				$data3 = $this->app_model->getSelectedData("TD_Trace",$IndexDetail3);
				if($data3->num_rows()>0){
				$this->app_model->updateData("TD_Trace",$Detail,$IndexDetail3);
                $this->app_model->updateData("TD_Trace",$Detail4,$IndexDetail4);
                echo 'Data berhasil diupdate' ;
				}else{
                echo 'Silahkan Login Menggunakan User Data !!!' ;}
				}
                    
				}else{ 
				if(empty($DocNumDetail2)){
				$this->app_model->insertData("TH_Trace",$Header);
                $this->app_model->insertData("TD_Trace",$Detail);
                $this->app_model->updateData("TD_Trace",$Detail4,$IndexDetail4);
                echo 'Simpan data Sukses' ;
                 }else{
				echo 'Gagal Simpan data' ; }
                }  
                }else{
                echo 'Gagal Simpan data, Doc Update' ;    
                } 
                }
       
       
       public function Hapus_Detail(){
            //Time SERVER,
date_default_timezone_set('Asia/Jakarta');

            $DocDate	            = $this->app_model->tgl_sql(date('d-m-Y'));
            $up['IsDelete'] = "1" ; 
            $up['CreateDate'] = $DocDate ;
            $up['Qty_1'] = 0 ;
            $up['Qty_2'] = 0 ;
            $up['Qty_3'] = 0 ;
            $up['Qty_4'] = 0 ;
            $up['Qty_5'] = 0 ;
            
            $up2['Qty_3'] = $this->input->post('QtyMatDelete') ;
            $up2['Qty_4'] = $this->input->post('QtyPcsDelete') ; 
                   
            $id_d2['DocNumDetail'] = $this->input->post('DocNum_ExtDelete');
            
            $id_d['DocNumDetail'] = $this->input->post('DocNumDetailDelete');
            $id_d['CreateBy'] = $this->session->userdata('RegID');
          
          	$data = $this->app_model->getSelectedData("QTD_Trace",$id_d);
				if($data->num_rows()>0){
					$this->app_model->updateData("TD_Trace",$up,$id_d);
                    $this->app_model->updateData("TD_Trace",$up2,$id_d2);
					echo 'Success !!!' ;
                    echo '<script type="text/javascript">ion.sound.play("water_droplet");</script>';
				}else{        
                    echo 'Gagal Menghapus bro';	
                    echo '<script type="text/javascript">ion.sound.play("metal_plate");</script>';
                    	
				} }
    
    
    public function InfoDataEdit(){

			$kode = $this->input->post('kode');
            $text = "SELECT * FROM QTD_Trace WHERE DocNumDetail='$kode' " ;
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){ foreach($tabel->result() as $t){ 
			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            
            
                $data['CreateByID'] = $t->CreateBy;
                $data['CreateBy'] = $t->username;
                $data['DocNum'] = $t->DocNum ;
                $data['DocNumDetail'] = substr($t->DocNumDetail,13,3) ;
                $data['DocNumDetailOut'] = substr($t->DocNumDetail,13,3) ;
                $data['DocNumDetailRet'] = substr($t->DocNumDetail,12,3) ;
                $data['DocNumDetailTR'] = substr($t->DocNumDetail,13,3) ;
                $data['DocNumDetailTROUT'] = substr($t->DocNumDetail,14,3) ;
                $data['DocNumDetailGAIn'] = substr($t->DocNumDetail,15,3) ;
                $data['DocNumDetailGAOut'] = substr($t->DocNumDetail,15,3) ;
                $data['DocNumDetailInFG'] = substr($t->DocNumDetail,13,3) ;
                $data['DocNumDetail3'] = $t->DocNumDetail ;
                $data['CreateTime'] = $this->app_model->tgl_str($t->DocTime) ;
                $data['CreateDate'] = $this->app_model->tgl_str($t->CreateDate) ;
                $data['DocDate'] = $this->app_model->tgl_str($t->DocDate) ;
                $data['SJDate'] = $this->app_model->tgl_str($t->DocDate) ;
                $data['ItemID'] = $t->ItemID;
                $data['ItemID_Ext'] = $t->ItemID_Ext;
                $data['PartNo'] = $t->PartNo;
                $data['PartName'] = $t->PartName;
                $data['IDCust'] = $t->IDCust;
                $data['Code'] = $t->Code;
                $data['Code2'] = $t->Code .' '. $t->ProjectName;
                $data['SpecOrder'] = $t->SpecOrder1 .' '. $t->SpecOrder2 ;
                $data['Spec1'] = $t->Spec ;
                $data['Spec2'] = $t->Spec .' '. $t->Thick .' X '. $t->Width .' X '. $t->Length;
                $data['IDProject'] = $t->IDProject;
                $data['ProjectName'] = $t->ProjectName;
                $data['DocNum_Ext'] = $t->DocNum_Ext;
                $data['DocNum_Ext_D'] = $t->DocNum_Ext_D;
                $data['PartnerID'] = $t->PartnerID;
                $data['partner_code'] = $t->partner_code;
                $data['MaterialTypeID'] = $t->MaterialTypeID;
                $data['MaterialType'] = $t->MaterialType;
                $data['PcsPerSheet'] = $t->PcsPerSheet;
                $data['KgPerSheet'] = $t->KgPerSheet;
                $data['Remark'] = $t->Remark;
                
                $data['Qty_1']	= $t->Qty_1 ;
                $data['Qty_2']	= $t->Qty_2 ;
                $data['Qty_3']	= $t->Qty_3 ;
                $data['Qty_4']	= $t->Qty_4 ;
                $data['Qty_5']	= $t->Qty_5 ;
                $data['BalMatSource']	= $t->BalMatSource ;
                $data['BalPcsSource']	= $t->BalPcsSource ;
                
                $data['CanEdit'] = $t->CanEdit; 
                echo json_encode($data);
				}
			}else{ 
			 
                $data['CreateBy'] = '';
                $data['DocNum']= '';
                $data['DocNumDetail']= '';
                $data['DocNumDetailOut']= '';
                $data['DocNumDetailRet']= '';
                $data['DocNumDetailTR']= '';
                $data['DocNumDetailTROUT']= '';
                $data['DocNumDetailGAIn']= '';
                $data['DocNumDetailGAOut']= '';
                $data['DocNumDetailInFG']= '';
                $data['DocNumDetail3']= '';
                $data['CreateTime']= '';
                $data['CreateDate']= '';
                $data['DocDate']= '';
                $data['SJDate']= '';
                $data['ItemID']= '';
                $data['PartNo']= '';
                $data['PartName']= '';
                $data['IDCust']= '';
                $data['Code']= '';
                $data['Code2']= '';
                $data['Spec1'] = '';
                $data['Spec2']= '';
                $data['SpecOrder']= '';
                $data['IDProject']= '';
                $data['ProjectName']= '';
                $data['SJNum']= '';
                $data['MatNum']= '';
                $data['PartnerID']= '';
                $data['partner_code']= '';
                $data['MaterialTypeID']= '';
                $data['MaterialType']= '';
                $data['PcsPerSheet']= '';
                $data['PcsPerKg']= '';
                $data['Remark']= '';
                
                $data['Qty_1']= '0';
                $data['Qty_2']= '0';
                $data['Qty_3']= '0';
                $data['Qty_4']= '0';
                
                $data['CanEdit']= '';
			echo json_encode($data);
			}}

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