<?php
class Material_in extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('Material_in_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->TrcMaterial();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 $text5 = "SELECT * FROM M_QCCheck WITH (NOLOCK) WHERE Category LIKE '%STP%' ";
 $d['M_QCCheck'] = $this->app_model->manualQuery($text5);
 $MasterList=$this->Material_in_model->MasterList();
 $d['MListProduct'] = $MasterList->result(); 
 $text6 = "SELECT * FROM M_Shift2 WITH (NOLOCK)";
 $d['M_Shift'] = $this->app_model->manualQuery($text6);
 $text2 = "SELECT * FROM M_Partner WHERE Category='RM' ORDER BY id DESC" ;
 $d['MListPartner'] = $this->app_model->manualQuery($text2); 
 $text3 = "SELECT * FROM M_customer ";
 $d['l_cust'] = $this->app_model->manualQuery($text3);
        
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');
 $DocDate	            = date('d-m-Y');
 $d['DocDateReport_2']= date('d-m-Y');
 $d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
 $d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
 $d['DocDateReport_2']= $DocDate ;
 $this->template->display('Material_in/index',$d); }
    
    function MasterList(){
        $DB=$this->Material_in_model->MasterList();
        $data['MListProduct']=$DB->result();
        $this->load->view('Material_in/master_list',$data); }    
    
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
                $data['CustName2'] = $t->Code .' - '. $t->ProjectName;
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
                echo json_encode($data);
				}} 
                
    
                
    public function InfoTambahFormDetailMatIN(){
			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            $id = $this->input->post('kode');
            
            $DocNumDetail	        = $this->app_model->DocNumDetailMaterialIN_New($id);
            $data['DocNumDetail'] = $DocNumDetail ; 
            $data['CreateDate']	= $CreateDate ;
            $data['DocDate']	    = $DocDate ;
            $data['CreateTime']	= $CreateTime ;
            echo json_encode($data);
            }            
    
    function transaction_list(){
        $cek=$this->Material_in_model->transaction_list();
        $data['list']=$cek->result();
        $this->load->view('Material_in/transaction_list',$data);
    }
    
    function transaction_detail(){
        $id = $this->input->post('id');
        $cek =$this->Material_in_model->transaction_detail($id);
        $data['list']=$cek->result();
        $this->load->view('Material_in/transaction_detail',$data);
        
    }
    
    public function DetailPrint(){

			$d['judul'] = "Data Material Masuk";
			
			$id = $this->uri->segment(3);

            $cek =$this->Material_in_model->transaction_detail($id);
            $d['data']=$cek->result();					
			$this->load->view('Material_in/PrintMaterialIn',$d);          

		 	}
    
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
                    $d['UserName']	= $db->username ;
                    			         	
				}
			}else{
					$d['DocNum']		='';
					$d['DocDate']	='';
                    $d['judul']= "Transaksi Material Masuk" ; 
                    $d['UserName']	= '';
				
			} 
			
            $cek =$this->Material_in_model->transaction_detail($id);
            $d['data']=$cek->result();
            $d['num'] = $cek->num_rows();					
			$this->load->view('Material_in/PrintList',$d);          

		 	}
    
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
			
			
            $cek = $this->Material_in_model->transaction_detail_report($DocDateReport_1,$DocDateReport_2,$IDCust,$DocNum,$PartnerID);
            $Stock = $this->Material_in_model->Stock_List();
            $d['data']=$cek->result(); 
            $d['num'] = $cek->num_rows();                
			$this->load->view('Material_in/PrintList2',$d);
	}
                     
    
    function transaction_detail_2(){
        $id = $this->input->post('id');
        $cek =$this->Material_in_model->transaction_detail($id);
        $data['list']=$cek->result();
        $this->load->view('Material_in/transaction_detail_2',$data);
        
    }
    

    public function ReadReport(){
        
			$DocDateReport_1 = $this->app_model->tgl_sql($this->input->post('DocDateReport_1'));
			$DocDateReport_2 = $this->app_model->tgl_sql($this->input->post('DocDateReport_2'));
            $IDCust = $this->input->post('IDCust2');
			$DocNum = $this->input->post('PartNo3');
            $PartnerID = $this->input->post('PartnerID2');            
			
			
            $cek = $this->Material_in_model->transaction_detail_report($DocDateReport_1,$DocDateReport_2,$IDCust,$DocNum,$PartnerID);
            $Stock = $this->Material_in_model->Stock_List();
            $d['list']=$cek->result();              
			$this->load->view('Material_in/transaction_detail_report',$d);
	}
    
    public function ExportReport(){
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
			
			
            $cek = $this->Material_in_model->transaction_detail_report($DocDateReport_1,$DocDateReport_2,$IDCust,$DocNum,$PartnerID);
            $Stock = $this->Material_in_model->Stock_List();
            $d['data']=$cek->result(); 
            $d['num'] = $cek->num_rows();                
			$this->load->view('Material_in/ExportListReport',$d);
	}
    
   
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
             
   public function InfoTambahFormMatIn()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumMaterialINMPC();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailMaterialINMPC($id);
             $id = $this->input->post('kode');             
            }
            
            

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
            
            $up['DocNum']		    = $this->app_model->DocNumMaterialINMPC() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumMaterialINMPC();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
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
            $cek =$this->Material_in_model->transaction_detail2($id);
            $d['data']=$cek->result();					
			$this->load->view('Material_in/PrintMaterialIn',$d);          
 	}
            
        
    function Save(){
          //Time SERVER,
date_default_timezone_set('Asia/Jakarta');


            $date_time = $this->app_model->tgl_sql(date('d-m-Y H:i:s'));
            $month =  $this->app_model->ambilBln2($this->input->post('DocDate'));
            $year = $this->app_model->ambilThn2($this->input->post('DocDate'));
            $ItemID_Ext = substr($this->input->post('ItemID'),0,10);

                $Header['DocNum']          = $this->input->post('DocNum');
                $Header['DocDate']         = $this->app_model->tgl_sql($this->input->post('DocDate'));
                $Header['DocTime']         = $this->input->post('CreateTime');
                $Header['CreateBy']        = $this->session->userdata('RegID') ;
                $Header['CreateDate']      = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
                $Header['LastUpdate'] = $date_time ;
                $Header['HideH']           = md5($this->input->post('DocNum')) ;
                $Header['TrcType']       = '1000';
                
				$Detail['CreateBy'] = $this->session->userdata('RegID') ;
                $Detail['DocNum'] = $this->input->post('DocNum') ;
                $Detail['DocNumDetail'] = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ;
                $Detail['HideH'] = md5($this->input->post('DocNum')) ;
                $Detail['HideD'] = md5($this->input->post('DocNum') ."". $this->input->post('DocNumDetail')) ;
                $Detail['DocDate'] = $this->app_model->tgl_sql($this->input->post('SJDate'));
                $Detail['DocTime'] = $this->input->post('CreateTime');
                $Detail['CreateDate'] = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
                $Detail['ItemID'] = $this->input->post('ItemID') ;
                $Detail['Qty_1'] = $this->input->post('QtyMat') ;
                $Detail['Qty_2'] = $this->input->post('QtyPcs') ;
                $Detail['Qty_3'] = $this->input->post('BalMat') ;
                $Detail['Qty_4'] = $this->input->post('BalPcs') ;
                $Detail['DocNum_Ext'] = $this->input->post('SJNum') ;
                $Detail['DocNum_Ext_D'] = $this->input->post('MatNum') ;
                $Detail['PartnerID'] = $this->input->post('PartnerID') ;
                $Detail['PcsPerSheet'] = $this->input->post('PcsPerSheet') ;
                $Detail['KgPerSheet'] = $this->input->post('KgPerSheet') ;  
                $Detail['ItemID_Ext'] = $ItemID_Ext ; 
                
                $Detail['MonthID'] = $month ;
                $Detail['YearID'] = $year ;             
                
				$IndexHeader['DocNum']               = $this->input->post('DocNum');
                $IndexHeader['CreateBy']             = $this->session->userdata('RegID') ;
                
                $IndexHeader2['DocNum']               = $this->input->post('DocNum');
                
                $IndexDetail['DocNum']               = $this->input->post('DocNum');
                $IndexDetail['DocNumDetail']         = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ;
                $IndexDetail['ItemID']               = $this->input->post('ItemID') ;
                $IndexDetail['DocNum_Ext_D']                = $this->input->post('SJNum') ;
                $IndexDetail['DocDate']               = $this->app_model->tgl_sql($this->input->post('SJDate')) ;
                 
				$IndexDetail3['DocNumDetail'] = $this->input->post('DocNumDetail3') ;
                $IndexDetail3['CreateBy']      = $this->session->userdata('RegID') ;
                
                $DocNumDetail2 = $this->input->post('DocNumDetail3') ;
                
                $data1 = $this->app_model->getSelectedData("TH_Trace",$IndexHeader);
				if($data1->num_rows()>0){
				    if(empty($DocNumDetail2)){
                    $data2 = $this->app_model->getSelectedData("QTD_Trace",$IndexDetail);
						if($data2->num_rows()>0){
					echo 'Data sudah diinput' ;
						}else{
                    $this->app_model->insertData("TD_Trace",$Detail); 
                    echo 'Tambah data Sukses' ;
					}	}else{
					   $data3 = $this->app_model->getSelectedData("QTD_Trace",$IndexDetail3);
						if($data3->num_rows()>0){
					$this->app_model->updateData("TD_Trace",$Detail,$IndexDetail3);
                    echo 'Data berhasil diupdate' ;
						}else{
                    echo 'Silahkan Login Menggunakan User Data !!!' ;}
					}
				}else{ 
				    if(empty($DocNumDetail2)){
                    $data4 = $this->app_model->getSelectedData("TH_Trace",$IndexHeader2);
						if($data4->num_rows()>0){
						  echo 'Silahkan Login Menggunakan User Data !!!' ;
                          }else{
                    $data5 = $this->app_model->getSelectedData("QTD_Trace",$IndexDetail);
						if($data5->num_rows()>0){
					echo 'Data sudah diinput' ;
						}else{ 
					$this->app_model->insertData("TH_Trace",$Header);
                    $this->app_model->insertData("TD_Trace",$Detail); 
                    echo 'Simpan data Sukses' ;
					} 
                    }
                    }else{
					   echo 'Silahkan Login Menggunakan User Data !!!' ;
					}
                    } 	
                }
       
       
       public function Hapus_Detail(){
            //Time SERVER,
date_default_timezone_set('Asia/Jakarta');

            $DocDate	            = $this->app_model->tgl_sql(date('d-m-Y'));
            $up['IsDelete'] = "1" ; 
            $up['CreateDate'] = $DocDate ;        
            $id_d['DocNumDetail'] = $this->input->post('DocNumDetailDelete');
            $id_d['CreateBy'] = $this->session->userdata('RegID');
          
          	$data = $this->app_model->getSelectedData("QTD_Trace",$id_d);
				if($data->num_rows()>0){
					$this->app_model->updateData("TD_Trace",$up,$id_d);
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
                $data['DocNumDetail'] = substr($t->DocNumDetail,12,3) ;
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
                $data['SJNum'] = $t->DocNum_Ext;
                $data['MatNum'] = $t->DocNum_Ext_D;
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