<?php
class Sony_del extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('Sony_del_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->session->userdata('TrcSony')=='1';
 if(!$this->session->userdata('username')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}
    
function index(){
 $d['title']="Home";
 $text5 = "SELECT * FROM M_QCCheck WITH (NOLOCK) WHERE Category LIKE '%STP%' ";
 $d['M_QCCheck'] = $this->app_model->manualQuery($text5);
 $text = "SELECT * FROM Master_BOM WITH (NOLOCK) WHERE CustName LIKE '%SONY%' AND IsActiveDetail=1 AND PartTypeID LIKE '%PC%' ORDER BY SysID ASC" ;
 $d['MListProduct'] = $this->app_model->manualQuery($text); 
 $text6 = "SELECT * FROM M_Shift2 WITH (NOLOCK)";
 $d['M_Shift'] = $this->app_model->manualQuery($text6);
        
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$DocDate	            = date('d-m-Y');
$d['DocDateReport_2']= date('d-m-Y');
$d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
$d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
$d['DocDateReport_2']= $DocDate ;
        $this->template->display('Sony_del/index',$d);
    }
    
    public function InfoMaterial_product(){
			$kode = $this->input->post('kode');
			$text = "SELECT * FROM Master_BOM WHERE SysID2='$kode' AND IsDelete='0'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
			foreach($tabel->result() as $t){
                $data['PartName'] = $t->PartName;
                echo json_encode($data); }
				}else{
                $data['PartName'] = ""; 
                echo json_encode($data);
				}} 
                
                
                
    
    function transaction_list(){
        $cek=$this->Sony_del_model->transaction_list();
        $data['list']=$cek->result();
        $this->load->view('Sony_del/transaction_list',$data);
    }
    
    function transaction_detail(){
        $id = $this->input->post('id');
        $cek =$this->Sony_del_model->transaction_detail($id);
        $data['list']=$cek->result();
        $this->load->view('Sony_del/transaction_detail',$data);
        
    }
    
    function print_list(){
        
        $id = $this->uri->segment(3);
			$text2 = "SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE DocNum='$id' ORDER BY SysIDDetail DESC";
			$data2 = $this->app_model->manualQuery($text2);
			if($data2->num_rows() > 0){
				foreach($data2->result() as $db){
				    
					$data['DocNum']	= $id ;
					$data['DocDate']	= $this->app_model->tgl_str($db->DocDate);
                    $data['judul']= "Transaksi Material Masuk" ; 
                    $data['Shift']	= $db->Shift;
                    			         	
				}
			}else{
					$data['DocNum']		='';
					$data['DocDate']	='';
                    $data['judul']= "Transaksi Material Masuk" ; 
                    $data['Shift']	= '';
				
			} 
            
        $cek =$this->Sony_del_model->transaction_detail($id);
        $data['data']= $cek->result();
        
        $data['num'] = $cek->num_rows();
        $this->load->view('Sony_del/PrintList',$data);
        
    }
    
    
    function export_list(){
        
        $id = $this->uri->segment(3);
			$text2 = "SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE DocNum='$id' ORDER BY SysIDDetail DESC";
			$data2 = $this->app_model->manualQuery($text2);
			if($data2->num_rows() > 0){
				foreach($data2->result() as $db){
				    
                    $DocDate2 = $this->Sony_del_model->tgl_str($db->DocDate) ;
					$data['DocNum']	= $id ;
					$data['DocDate']	= $this->app_model->tgl_str($db->DocDate);
                    $data['Shift']	= $db->Shift;
                    $data['DocDate']	= $DocDate2;
                    			         	
				}
			}else{
					$data['DocNum']		='';
					$data['DocDate']	='';
                    $data['Shift']	= '';
                    $data['DocDate']	= '';
				
			} 
            
        $cek =$this->Sony_del_model->transaction_detail($id);
        $data['data']= $cek->result();
        $data['judul']= "Product - IN" ;
        $data['num'] = $cek->num_rows();
        $this->load->view('Sony_del/ExportList',$data);
        
    }
    
    function transaction_detail_2(){
        $id = $this->input->post('id');
        $cek =$this->Sony_del_model->transaction_detail($id);
        $data['list']=$cek->result();
        $this->load->view('Sony_del/transaction_detail_2',$data);
        
    }
    
    function export_list_report(){
        
        $DocDateReport_1 = $this->app_model->tgl_sql($this->uri->segment(3));
		$DocDateReport_2 = $this->app_model->tgl_sql($this->uri->segment(4));
		$ShiftIDReport = $this->uri->segment(5);
		$RefNumReport = $this->uri->segment(6);
        
        $d['Filter'] = $this->app_model->tgl_str($this->uri->segment(3)).' ~ '.$this->app_model->tgl_str($this->uri->segment(4));
          
          if($ShiftIDReport!='ALL'){
          $d['Shift'] = $this->app_model->CariShift($this->uri->segment(5));}else{
          $d['Shift'] = "ALL Shift";
          }
        $cek = $this->Sony_del_model->transaction_detail_report($DocDateReport_1,$DocDateReport_2,$RefNumReport,$ShiftIDReport);
        $d['data']=$cek->result();  
        $d['num'] = $cek->num_rows();   
        $this->load->view('Sony_del/ExportListReport',$d);
        
    }
    
    public function ReadReport(){
        
			$DocDateReport_1 = $this->app_model->tgl_sql($this->input->post('DocDateReport_1'));
			$DocDateReport_2 = $this->app_model->tgl_sql($this->input->post('DocDateReport_2'));
			$RefNumReport = $this->input->post('RefNumReport');
			$ShiftIDReport = $this->input->post('ShiftIDReport');
                        
            $cek = $this->Sony_del_model->transaction_detail_report($DocDateReport_1,$DocDateReport_2,$RefNumReport,$ShiftIDReport);
            $d['list']=$cek->result();             
			$this->load->view('Sony_del/transaction_detail_report',$d);
	}
    
    public function print_list_report(){
        
			$DocDateReport_1 = $this->app_model->tgl_sql($this->uri->segment(3));
			$DocDateReport_2 = $this->app_model->tgl_sql($this->uri->segment(4));
			$ShiftIDReport = $this->uri->segment(5);
			$RefNumReport = $this->uri->segment(6);
            
          $d['judul'] = "";
          $d['Filter'] = $this->app_model->tgl_str($this->uri->segment(3)).' ~ '.$this->app_model->tgl_str($this->uri->segment(4));
          
          if($ShiftIDReport!='ALL'){
          $d['Shift'] = $this->app_model->CariShift($this->uri->segment(5));}else{
          $d['Shift'] = "ALL Shift";
          }
          
                      
            $cek = $this->Sony_del_model->transaction_detail_report($DocDateReport_1,$DocDateReport_2,$RefNumReport,$ShiftIDReport);
            $d['data']=$cek->result();  
            $d['num'] = $cek->num_rows();           
			$this->load->view('Sony_del/PrintListReport',$d);
	}
    
    
    
    
    public function RegDocNumSony_Head(){
        
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '0001'   ; 
            $DocNum                 = $this->app_model->DocNumDelSony();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailProdSony($id);
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
            
            $up['DocNum']		    = $this->app_model->DocNumProdSony() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumProdSony();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
            
            
            public function RegDocNumSony_Detail(){
        
          $id = $this->input->post('kode');
          $DocNumDetail	        = $this->app_model->DocNumDetailProdSony($id);
          $data['DocNumDetail'] = $DocNumDetail ;
             
          echo json_encode($data);
             }
             
             
             public function RegDocNumSony_Add(){
			$id = $this->input->post('id');
            $DocNumDetail	        = $this->app_model->DocNumDetailProdSony($id);
            $data['DocNumDetail'] = $DocNumDetail ;
			$text = "SELECT * FROM QTH_Trace WHERE DocNum='$id'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
			foreach($tabel->result() as $t){
			 
                
                $data['DocDate'] = $this->Sony_del_model->tgl_str($t->DocDate);
                $data['ShiftID'] = $t->ShiftID;
                 }
				}else{
                $data['DocDate'] = "";
                $data['DocDate'] = "";
                
				}
               echo json_encode($data); 
                } 
            
                
        
    function Save(){
          //Time SERVER,
date_default_timezone_set('Asia/Jakarta');

            $date = $this->app_model->tgl_sql(date('d-m-Y'));
            $date2 = $this->input->post('DocDate');
            $date_time = $this->app_model->tgl_sql(date('d-m-Y H:i:s'));
            $month =  $this->app_model->ambilBln2($this->input->post('DocDate'));
            $year = $this->app_model->ambilThn2($this->input->post('DocDate'));
            $time = date ("H:i:s") ;
            
            $ItemID_Ext = substr($this->input->post('SysID'),0,10);
            
            $ID =$this->input->post('RefNum');
            $Balance1 = $this->Sony_del_model->CariBalanceProd($ID);
            $DocNum_Ext = $this->Sony_del_model->CariTrcType($ID);
            $Balance = $Balance1 - 1 ;
            
            
		  	
				$head['DocNum']=$this->input->post('DocNum');
                $head['DocDate'] = $this->app_model->tgl_sql($this->input->post('DocDate')) ;
                $head['CreateDate'] = $date ;
                $head['DocTime'] = $time ;
                $head['LastUpdate'] = $date_time ;
                $head['CreateBy'] = $this->session->userdata('RegID');
                $head['ShiftID'] = $this->input->post('ShiftID');
                $head['TrcType']='20';
                
                $head2['DocDate'] = $this->app_model->tgl_sql($this->input->post('DocDate')) ;
                $head2['LastUpdate'] = $date_time ;
                $head2['ShiftID'] = $this->input->post('ShiftID');
                
                
                $detail['DocNum']=$this->input->post('DocNum');
                $detail['DocNumDetail']= $this->input->post('DocNum').''.$this->input->post('DocNumDetail'); 
                $detail['DocNum_Ext'] =$this->input->post('RefNum');
                $detail['DocNum_Ext_D'] =$this->input->post('RefNum_D');
                $detail['Rev'] = 0 ;
                $detail['ItemID'] = $this->input->post('SysID');
                $detail['ItemID_Ext'] = $ItemID_Ext ;
                $detail['CreateBy'] = $this->session->userdata('RegID');
                $detail['CreateDate'] = $date ;
                $detail['DocDate'] = $this->app_model->tgl_sql($this->input->post('DocDate')) ;
                $detail['MonthID'] = $month ;
                $detail['YearID'] = $year ;
                $detail['DocTime'] = $time ; 
                $detail['QCCheckID'] = $this->input->post('QCCheckID');
                
                $BalanceDetail['Qty_3'] = $Balance ;
                $BalanceDetail_id['DocNumDetail'] = $DocNum_Ext ;
                
                 
                $detail2['DocNum_Ext'] =$this->input->post('RefNum');
                $detail2['DocNum_Ext_D'] =$this->input->post('RefNum_D');
                $detail2['ItemID'] = $this->input->post('SysID');
                $detail2['ItemID_Ext'] = $ItemID_Ext ;
                $detail2['CreateBy'] = $this->session->userdata('RegID');
                $detail2['CreateDate'] = $date ;
                $detail2['DocDate'] = $this->app_model->tgl_sql($this->input->post('DocDate')) ;
                $detail2['MonthID'] = $month ;
                $detail2['YearID'] = $year ;
                $detail2['DocTime'] = $time ; 
                $detail2['QCCheckID'] = $this->input->post('QCCheckID');
                
				
                $id_head['DocNum'] = $this->input->post('DocNum');
                $id_detail['DocNumDetail'] = $this->input->post('DocNum').''.$this->input->post('DocNumDetail') ;
                
                $id_head_id['DocNumDetail'] = $this->input->post('DocNum').''.$this->input->post('DocNumDetail') ;
                $id_head_id['DocNum_Ext_D'] =$this->input->post('RefNum_D');
                
                $id_head_id2['DocNum_Ext_D'] =$this->input->post('RefNum_D');
                
                
                    
				$data = $this->app_model->getSelectedData("QTH_Trace",$id_head);
				if($data->num_rows()>0){
				
                $data_head = $this->app_model->getSelectedData("QTD_Trace",$id_head_id2);
                if($data_head->num_rows()>0){ 
                    
                $data_head2 = $this->app_model->getSelectedData("QTD_Trace",$id_head_id);
                if($data_head2->num_rows()>0){     
                    $this->app_model->updateData("TH_Trace",$head2,$id_head);
                    $this->app_model->updateData("TD_Trace",$detail2,$id_detail);
                    echo 'Success Update !!!';
                    echo '<script type="text/javascript">ion.sound.play("bell_ring");</script>';
                    }else{
                    echo 'Barcode is already existing !!!';  
                    echo '<script type="text/javascript">ion.sound.play("metal_plate");</script>';  
                    }
                    
                    }else{
                        
                    $data2 = $this->app_model->getSelectedData("QTD_Trace",$id_detail);
                    if($data2->num_rows()>0){
                    $this->app_model->updateData("TH_Trace",$head2,$id_head);    
                    $this->app_model->updateData("TD_Trace",$detail2,$id_detail);    
                    echo 'Success Update !!!';  
                    echo '<script type="text/javascript">ion.sound.play("bell_ring");</script>';  
                    }else{
                    $this->app_model->updateData("TH_Trace",$head2,$id_head);    
                    $this->app_model->insertData("TD_Trace",$detail);
                    $this->app_model->updateData("TD_Trace",$BalanceDetail,$BalanceDetail_id);
                    echo 'Success !!!';
                    echo '<script type="text/javascript">ion.sound.play("bell_ring");</script>';
                    }    }
					
				}else{
	
    $data_head = $this->app_model->getSelectedData("QTD_Trace",$id_head_id2);
    if($data_head->num_rows()>0){ 
        
    $data_head2 = $this->app_model->getSelectedData("QTD_Trace",$id_head_id);
    if($data_head2->num_rows()>0){  
        
        $this->app_model->updateData("TH_Trace",$head2,$id_head);
        $this->app_model->updateData("TD_Trace",$detail2,$id_Detail);
        echo 'Success Update !!!';
        echo '<script type="text/javascript">ion.sound.play("bell_ring");</script>';
        }else{
        echo 'Barcode is already existing !!!'; 
        echo '<script type="text/javascript">ion.sound.play("metal_plate");</script>';       
        }
                    
        }else{
                    
					$this->app_model->insertData("TH_Trace",$head);
                    $this->app_model->insertData("TD_Trace",$detail);
                    $this->app_model->updateData("TD_Trace",$BalanceDetail,$BalanceDetail_id);
                    echo 'Success !';
                    echo '<script type="text/javascript">ion.sound.play("bell_ring");</script>';
       } }	}
       
       
       public function Hapus_Detail(){
        
        $ID =$this->input->post('RefNumDelete');
        $Balance1 = $this->Sony_del_model->CariBalanceProd($ID);
        $DocNum_Ext = $this->Sony_del_model->CariTrcType($ID);
        $Balance = $Balance1 + 1 ;
            
            $BalanceDetail['Qty_3'] = $Balance ;
            $BalanceDetail_id['DocNumDetail'] = $DocNum_Ext ;
                
            $up['IsDelete'] = "1" ; 
            $id_d['DocNumDetail'] = $this->input->post('DocNumDetailDelete');
            $id_d['CreateBy'] = $this->session->userdata('RegID');
          
          	$data = $this->app_model->getSelectedData("QTD_Trace",$id_d);
				if($data->num_rows()>0){
				    $this->app_model->updateData("TD_Trace",$BalanceDetail,$BalanceDetail_id);
					$this->app_model->updateData("TD_Trace",$up,$id_d);
					echo 'Success !!!' ;
                    echo '<script type="text/javascript">ion.sound.play("bell_ring");</script>';
				}else{        
                    echo 'Gagal Menghapus bro';		
                    echo '<script type="text/javascript">ion.sound.play("metal_plate");</script>'; 
				} }
    
    
    
    function _set_rules(){
        $this->form_validation->set_rules('user','username','required|trim');
        $this->form_validation->set_rules('password','password','required|trim');
        $this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>");
    }
    
       
    
         
}