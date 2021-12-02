<?php
class ref_json extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('app_model'));
 $this->load->library(array('form_validation','template'));
 if(!$this->session->userdata('UserName')){ redirect('welcome'); } }
    
	/**
	* @author : Aji

	 **/
    	public function InfoMaterial_product(){

			$kode = $this->input->post('kode');
			$text = "SELECT * FROM Q01_MProduct WHERE RegID='$kode' AND IsDelete='X'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
			foreach($tabel->result() as $t){
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
                
				echo json_encode($data);
			}

	}

     public function GetNotif()
     {
        $kode = $this->input->post('kode');
        $sql1= "SELECT SUM(a.Waiting_MKT) AS Waiting_MKT
                FROM
                (
                    SELECT ISNULL(SUM(CASE WHEN IsNull(a.StatusConfirm,0) = 0 THEN 1 ELSE 0 END),0) AS Waiting_MKT
                    FROM TH_SuratJalan a
                    WHERE a.TypeID IN (1)
                    GROUP BY a.RegID
                    ORDER BY a.RegID DESC OFFSET 0 ROWS FETCH NEXT 50 ROWS ONLY
                ) a"; 
        $data['Waiting_MKT'] = $this->app_model->db_get_one($sql1);
        
        $sql2= "SELECT SUM(a.Waiting_WH) AS Waiting_WH
                FROM
                (
                    SELECT ISNULL(SUM(CASE WHEN IsNull(a.StatusConfirm,0) = 0 THEN 1 ELSE 0 END),0) AS Waiting_WH
                    FROM TH_SuratJalan a
                    WHERE a.TypeID NOT IN (1)
                    GROUP BY a.RegID
                    ORDER BY a.RegID DESC OFFSET 0 ROWS FETCH NEXT 50 ROWS ONLY
                ) a"; 
        $data['Waiting_WH'] = $this->app_model->db_get_one($sql2);
        echo json_encode($data);
     }
     
public function simpanFoto()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$config['upload_path'] = './images/foto_profil/';
			$config['allowed_types'] = 'bmp|gif|jpg|jpeg|png|jp2';
			$config['max_size'] = '2000';
			$config['max_width'] = '2400';
			$config['max_height'] = '2400';	
			$config['create_thumb'] = TRUE;
		   	$config['maintain_ratio'] = TRUE;					
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload('foto')){
				
				$tp=$this->upload->data();
				$res = $tp['full_path'];
				$ori = $tp['file_name'];
				
				$id['username']	= $this->session->userdata('username');
				
				$up['foto']		= $ori;
				
				$data = $this->app_model->getSelectedData("M_User",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("M_User",$up,$id);
                    
				
				}
				header('location:'.base_url().'index.php/');
			}else{
				header('location:'.base_url().'index.php/');
			}
		}else{
				header('location:'.base_url().'index.php/login/');
		}
	
	}
       
public function SimpanEditByUser(){
 $pwd = $this->input->post('pwd');
 $up['username']               = $this->input->post('username2');
 $up['nama_lengkap']         = $this->input->post('nama_lengkap2');
 $up['password']            = md5($pwd) ;
 $up2['username']               = $this->input->post('username2');
 $up2['nama_lengkap']         = $this->input->post('nama_lengkap2');
 $id['RegID']               = $this->input->post('RegID2'); 
 $data = $this->app_model->getSelectedData("M_User",$id);
 if($data->num_rows()>0){
 if(empty($pwd)){
 $this->app_model->updateData("M_User",$up2,$id);
 echo 'Edit Profile User Sukses';
 }else{
 $this->app_model->updateData("M_User",$up,$id);
 echo 'Edit Profile User Sukses'; }
 }else{
 echo 'Data Tidak Ada';	 }    } 
    
public function InfoBOM_Head() {
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
                    $data['IDProject'] = $t->IDProject;
                    $data['PackingType'] = $t->PackingType;
                    $data['StdPack'] = $t->StdPack;
                    $data['PartTypeID'] = $t->PartTypeID;
                    $data['FGLocation'] = $t->FGLocation;
                    $data['SupplierID'] = $t->SupplierID;
                    $data['QtyPerCar'] = $t->QtyPerCar;
                    $data['SupplierName'] = $t->partner_code;
                    
                    $data['IsActive'] = $t->IsActive;
                    
                                       
					echo json_encode($data);
				}
			}else{  
                    $data['PartNo'] = '' ;
                    $data['PartName'] = '' ;
                    $data['IDCust'] = '' ;
                    $data['IDProject'] = '' ;
                    
                
				echo json_encode($data);
			}

	}
    
    public function InfoBOM_Detail()
	{

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
                    
                                       
					echo json_encode($data);
				}
			}else{  
                    $data['PartNo'] = '' ;
                    $data['PartName'] = '' ;
                    $data['IDCust'] = '' ;
                    $data['IDProject'] = '' ;
                    
                
				echo json_encode($data);
			}

	}
    
    
    public function InfoAsset()
	{

			$kode = $this->input->post('kode');
			$text = "SELECT * FROM QMaster_Asset WHERE ItemID='$kode'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
			foreach($tabel->result() as $t){
                    $data['ItemNo'] = $t->ItemNo;
                    $data['ItemName'] = $t->ItemName;
                    $data['Spec'] = $t->Spec;
                    $data['LocationID'] = $t->LocationID;
                    $data['CategoryID'] = $t->CategoryID;
                    $data['UnitID'] = $t->UnitID;
                    $data['IsActive'] = $t->IsActive;
                    $data['Remark'] = $t->Remark;
                    $data['PurchaseDate'] = $this->app_model->tgl_str($t->PurchaseDate);
                    $data['Department'] = $t->Dept_Name;
                    $data['CreatedBy'] = $t->username;
                    $data['Qty'] = $t->Qty;
                    $data['Price'] = $t->Price;
                    $data['Amount'] = $t->Amount;
                    $data['PartnerID'] = $t->VendorID;
                    $data['partner_name'] = $t->partner_code;
                    
                    $data['PrinterType'] = $t->PrinterType;
                    $data['SizePaper'] = $t->SizePaper;
                    $data['ColorType'] = $t->ColorType;
                    
                    $data['Hardware'] = $t->Hardware;
                    $data['RAM'] = $t->RAM;
                    $data['HDD'] = $t->HDD;
                    $data['VGACard'] = $t->VGACard;
                    $data['NetCard'] = $t->NetCard;
                    $data['Processor'] = $t->Processor;
                    
                    $data['OS'] = $t->OS;
                    $data['Office'] = $t->Office;
                    $data['Autocad'] = $t->Autocad;
                    $data['NX'] = $t->NX;
                    $data['SW'] = $t->SW;
                    $data['Catia'] = $t->Catia;
                    $data['FB'] = $t->FB;
                    $data['DB'] = $t->DB;
                    $data['RemarkDetail'] = $t->RemarkDetail;
                    $data['IDDept'] = $t->id_dept;
                    echo json_encode($data);
				}
			}else{  
                    $data['ItemNo'] ='';
                    $data['ItemName'] ='';
                    $data['Spec'] ='';
                    $data['LocationID'] ='';
                    $data['CategoryID'] ='';
                    $data['UnitID'] ='';
                    $data['IsActive'] ='';
                    $data['Remark'] ='';
                    $data['PurchaseDate']  ='';
                $data['Department'] ='';
                $data['CreatedBy'] = '';
                $data['Qty'] = '';
                $data['Price'] = '';
                $data['Amount'] = '';
				echo json_encode($data);
			}

	}
                    
    public function InfoMachine2()
	{

			$kode = $this->input->post('kode');
			$text = "SELECT * FROM DetailMachine WHERE RegID='$kode'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
			foreach($tabel->result() as $t){
                    $data['MachineName'] = $t->McName .' '. $t->Tonage .' '. 'Ts'; 
                    $data['Tonage'] = $t->Tonage;
                    $data['IDLineReport'] = $t->Line .'-'. $t->DetailLine;  
                    $data['DetailLineReport'] = $t->DetailLine;       
					echo json_encode($data);
				}
			}else{  
                    $data['MachineName'] = '' ;
                    $data['Tonage'] = '' ;
                    $data['IDLineReport'] = '' ; 
                    $data['DetailLineReport'] = '' ;
                  
				echo json_encode($data);
			}

	}
    
    public function InfoDataEdit()
	{

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
				$data['DocNumDetailInICT']   = substr($t->DocNumDetail,14,3) ;
                $data['DocNumDetailOutICT']   = substr($t->DocNumDetail,15,3) ;
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
                
                $data['unit'] = $t->CodeUnit;
                
                if($t->ItemID!='')
                {
                    $data['StockWIP'] = $this->app_model->db_get_one("SELECT StockWip FROM M_Product WHERE RegID='".$t->ItemID."'");
                }                
                    
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
				
				$data['StockWIP'] = '';
                
                $data['unit'] = '';
				echo json_encode($data);
			} }
        
        public function InfoDataEditProd()
	{

			$kode = $this->input->post('kode');
            $text = "SELECT * FROM QTD_Production WHERE DocNumDetail='$kode' AND IsDelete=0 " ;
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
            $CreateTime2	            = date ("H:i") ;
            
            
            
            
                $data['DocNum']		       = $t->DocNum ;
                $data['DocNumDetail']	   = substr($t->DocNumDetail,12,3) ;
                $data['DocNumDetailWeld']	   = substr($t->DocNumDetail,11,3) ;
                $data['DocNumDetail3']	   = $t->DocNumDetail ;
                $data['CreateTime']	       = $this->app_model->tgl_str($t->CreateTime) ;
                $data['CreateDate']	       = $this->app_model->tgl_str($t->CreateDate) ;
                $data['DocDate']	       = $this->app_model->tgl_str($t->DocDate) ;
                $data['ItemID']            = $t->ItemID;
                $data['PartNo']            = $t->PartNo;
                $data['PartName']          = $t->PartName;
                $data['IDCust']            = $t->IDCust;
                $data['CustName2']              = $t->CustName .' '. $t->ProjectName;
                $data['CustName']              = $t->CustName;
                $data['IDProject'] = $t->IDProject;
                $data['ProjectName'] = $t->ProjectName;
                $data['StockWip'] = $t->StockWip;
                $data['ShiftID'] = $t->ShiftID;
                $data['QtyStroke'] = $t->QtyStroke;
                $data['QtyStrokePlan'] = $t->QtyStrokePlan;
                $data['Separating'] = $t->Separating;
                
                $data['Qty']	= $t->Qty ;
                $data['QtyPlan']	= $t->QtyPlan ;
                $data['NG']	= $t->NG ;
                $data['Yield']	= $t->Yield ;
                $data['Achievement']	= $t->Achievement ;
                
                
                $data['ProsesProduction']	= $t->Proses ;
                $data['Durasi']	= $t->Durasi ;
                $data['Proses']	= $t->ProsesProduction ;
                
                
                $data['QCCheck']	= $t->QCCheck ;
                $data['OP1']	= $t->OP1 ;
                $data['OP2']	= $t->OP2 ;
                $data['StatusID']	= $t->StatusID ;
                $data['StdPack']	= $t->StdPack ;
                $data['Remark']	= $t->Remark ;
                
                $data['IDLine']	= $t->IDLine ;
                $data['IDLineDetail']	= $t->IDLineDetail ;
                $data['Line']	= $t->Line ;
                
                $data['ProsesD']	= $t->ProsesD ;
                $data['ProsesH']	= $t->ProsesH ;
                
                $data['LotNo']	= $t->LotNo ;
                $data['VanNo']	= $t->VanNo ;
                
                
                $DocDateRe1 = substr($t->DocDate,0,10);
                $DocDateRe2 = substr($t->DocDate,0,7);
                $Thn3 = substr($DocDateRe1,0,4);
                $tgl3 = substr($DocDateRe1,8,2);
                $bln3 = substr($DocDateRe2,5,2);
                
                $Start = $bln3.'/'.$tgl3.'/'.$Thn3 .' '. $CreateTime2 ;
                $Finish = $bln3.'/'.$tgl3.'/'.$Thn3 .' '. $CreateTime2 ;
                
                
                $StartTime1 = substr($t->Start,11,8) ;
                $StartTime = substr($StartTime1,0,5) ;
                
                $StartDate1 = substr($t->Start,0,10);
                $StartDate2 = substr($t->Start,0,7);
                $Thn2 = substr($StartDate1,0,4);
                $tgl2 = substr($StartDate1,8,2);
                $bln2 = substr($StartDate2,5,2);
                $StartDate = $bln2.'/'.$tgl2.'/'.$Thn2 ;
                
                $FinishTime1 = substr($t->Finish,11,8) ;
                $FinishTime = substr($FinishTime1,0,5) ;
                
                $FinishDate1 = substr($t->Finish,0,10);
                $FinishDate2 = substr($t->Finish,0,7);
                $Thn = substr($FinishDate1,0,4);
                $tgl = substr($FinishDate1,8,2);
                $bln = substr($FinishDate2,5,2);
                $FinishDate = $bln.'/'.$tgl.'/'.$Thn ;
                
                if(empty($StartDate1)){
                $data['Start'] = $Start ;
                $data['Finish'] = $Finish ;    
                }else{
                $data['Start'] = $StartDate .' '. $StartTime ;
                $data['Finish'] = $FinishDate .' '. $FinishTime ;
                }
                
                
                
                
                    
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
                $data['Start'] = $DocDate;
                $data['Finish'] = $DocDate;
                
                $data['QtyMat']	= '' ;
                $data['QtyPcs']	= '' ;
                $data['BalMat']	= '' ;
                $data['BalPcs']	= '' ;
				echo json_encode($data);
			}  }
        
        public function InfoDataEditProd2()
	{

			$kode = $this->input->post('kode');
            $text = "SELECT * FROM QListDraft_LKH_STP WHERE DocNumDetail='$kode' " ;
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){ 
			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i") ;
            
            
            
            
                $data['DocNum']		       = $t->DocNum ;
                $data['DocNumDetail']	   = substr($t->DocNumDetail,12,3) ;
                $data['DocNumDetailWeld']  = substr($t->DocNumDetail,13,3) ;
                $data['DocNumDetail3']	   = $t->DocNumDetail ;
                $data['CreateTime']	       = $this->app_model->tgl_str($t->CreateTime) ;
                $data['CreateDate']	       = $this->app_model->tgl_str($t->CreateDate) ;
                $data['DocDate']	       = $this->app_model->tgl_str($t->DocDate) ;
                $data['ItemID']            = $t->ItemID;
                $data['PartNo']            = $t->PartNo;
                $data['PartName']          = $t->PartName;
                $data['IDCust']            = $t->IDCust;
                $data['CustName2']              = $t->CustName .' '. $t->ProjectName;
                $data['CustName']              = $t->CustName;
                $data['IDProject'] = $t->IDProject;
                $data['ProjectName'] = $t->ProjectName;
                $data['StockWip'] = $t->StockWip;
                $data['ShiftID'] = $t->ShiftID;
                
                
                $data['ItemIDSecond']            = $t->ItemIDSp;
                $data['PartNoSecond']            = $t->PartNoSp;
                $data['PartNameSecond']          = $t->PartNameSp;
                
                $data['ItemIDDies']            = $t->ItemIDDies;
                $data['PartNoDies']            = $t->PartNoDies;
                $data['PartNameDies']          = $t->PartNameDies;
                $data['CustIDDies']              = $t->CustIDDies;
                
                
                $data['Qty']	= $t->Qty ;
                $data['NG']	= $t->NG ;
                $data['Yield']	= $t->Yield ;
                
                $data['Sparating']	= $t->Separating ;
                $data['GTStroke']	= $t->GTStroke ;
                $data['GTStrokePlan']	= $t->GTStrokePlan ;
                $data['QtyStroke']	= $t->QtyStroke ;
                $data['QtyStrokePlan']	= $t->QtyStrokePlan ;
                $data['QtyPlan']	= $t->QtyPlan ;
                $data['GTProdTime']	= $t->GTProdTime ;
                $data['GTDownTime']	= $t->GTDownTime ;
                $data['GTPlanStop']	= $t->GTPLanStop ;
                $data['GTDurasi']	= $t->GTDurasi ;
                $data['TotalDT']	= $t->TotalDT ;
                $data['TotalPS']	= $t->TotalPS ;
                $data['OverTime']	= $t->OverTime ;
                $data['OverTimePlan']	= $t->OverTimePlan ;
                $data['GSPH']	= $t->GSPH ;
                $data['NSPH']	= $t->NSPH ;
                                
                
                $data['QCCheck']	= $t->QCCheck ;
                $data['OP1']	= $t->OP1 ;
                $data['OP2']	= $t->OP2 ;
                $data['StatusID']	= $t->StatusID ;
                $data['StdPack']	= $t->StdPack ;
                $data['Remark']	= $t->Remark ;
                
                $data['IDLine']	= $t->IDLine ;
                $data['IDLineDetail']	= $t->IDLineDetail ;
                
                $data['ProsesD']	= $t->ProsesD ;
                $data['ProsesH']	= $t->ProsesH ;
                $data['ProsesDH']	= $t->ProsesD.'/'.$t->ProsesH ;
                
                $data['Proses'] = $t->Proses;   $data['Durasi'] = $t->Durasi;
                $data['QtyPlan'] = $t->QtyPlan; $data['MB'] = $t->MB; $data['SS'] = $t->LimaS; $data['PM'] = $t->PM; $data['TR'] = $t->TR;
                $data['DC'] = $t->DC; $data['MC'] = $t->MC; $data['MBD'] = $t->MBD; $data['DB'] = $t->DB; $data['EB'] = $t->EB; $data['QC'] = $t->QC;
                $data['FB'] = $t->FB; $data['CB'] = $t->CB; $data['NIP'] = $t->NIP; $data['NSP'] = $t->NSP; $data['MP'] = $t->MP; $data['UT'] = $t->UT; 
                $data['UM'] = $t->UM;
                
                
                $data['DetailMc']	= $t->DetailMc ;
                
                $data['DocDate2']	       = $this->app_model->tgl_str($t->DocDate2);
                $data['CreateDateLKH']	       = $CreateDate;
                $data['CreateTimeLKH']	       = $CreateTime;
                
                $DocDateRe1 = substr($t->DocDate2,0,10);
                $DocDateRe2 = substr($t->DocDate2,0,7);
                $Thn3 = substr($DocDateRe1,0,4);
                $tgl3 = substr($DocDateRe1,8,2);
                $bln3 = substr($DocDateRe2,5,2);
                
                $Start = $bln3.'/'.$tgl3.'/'.$Thn3 .' '. $CreateTime ;
                $Finish = $bln3.'/'.$tgl3.'/'.$Thn3 .' '. $CreateTime ;
                
                
                $StartTime1 = substr($t->Start,11,8) ;
                $StartTime = substr($StartTime1,0,5) ;
                
                $StartDate1 = substr($t->Start,0,10);
                $StartDate2 = substr($t->Start,0,7);
                $Thn2 = substr($StartDate1,0,4);
                $tgl2 = substr($StartDate1,8,2);
                $bln2 = substr($StartDate2,5,2);
                $StartDate = $bln2.'/'.$tgl2.'/'.$Thn2 ;
                
                $FinishTime1 = substr($t->Finish,11,8) ;
                $FinishTime = substr($FinishTime1,0,5) ;
                
                $FinishDate1 = substr($t->Finish,0,10);
                $FinishDate2 = substr($t->Finish,0,7);
                $Thn = substr($FinishDate1,0,4);
                $tgl = substr($FinishDate1,8,2);
                $bln = substr($FinishDate2,5,2);
                $FinishDate = $bln.'/'.$tgl.'/'.$Thn ;
                
                if(empty($StartDate1)){
                $data['Start'] = $Start ;
                $data['Finish'] = $Finish ;    
                }else{
                $data['Start'] = $StartDate .' '. $StartTime ;
                $data['Finish'] = $FinishDate .' '. $FinishTime ;
                }
                    
                    
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
                $data['Start'] = $DocDate;
                $data['Finish'] = $DocDate;
                
                $data['QtyMat']	= '' ;
                $data['QtyPcs']	= '' ;
                $data['BalMat']	= '' ;
                $data['BalPcs']	= '' ;
				echo json_encode($data);
			}  }
        
        
        
        

        
   public function Trc_View(){
			$kode = $this->input->post('kode');
            $text = "SELECT * FROM QMonitoringStrokeSTP WHERE SysID='$kode' " ;
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){ 
                $data['DocDate']		 = $this->app_model->tgl_str($t->DocDate);
                $data['MachineID']		 = $t->MachineID;
                $data['ShiftID']		 = $t->ShiftID;
                echo json_encode($data);
                }
			}else{
			 
                $data['DocDate']		 = '';
                $data['MachineID']		 = '';
                $data['ShiftID']		= '';
                
             	echo json_encode($data);
			} }
        
        
  public function InfoDataEditDelivery()
	{

			$kode = $this->input->post('kode');
            $text = "SELECT * FROM WareHouseStock WHERE ItemID='$kode' " ;
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){ 
			
                $data['PartNo']		 = $t->PartNo;
                $data['PartName']	 = $t->PartName;
                $data['IDCust']		 = $t->IDCust;
                $data['CustName']	 = $t->Code;  
				$data['PcsPerday']	 = $t->PcsPerday; 
				$data['StockFG']	 = $t->StockFG; 
                $data['Stock']	     = $t->Stock; 
                $data['IsActive']	 = $t->IsActive;
                $data['DetailStatus']	=$t->DetailStatus;
                
                    
                    
					echo json_encode($data);
				}
			}else{ 
			 
                $data['DocNum']		= '' ;
                $data['RegID']		= '' ;
                $data['PartNo']		= '' ;
                $data['PartName']	= '' ;
                $data['IDCust']		= '' ;
                $data['CustName']	= '' ;
				$data['PcsPerday']	= '' ;
				$data['StockFG']	= '' ;
                $data['Stock']	= '' ;
                $data['IsActive']	= '' ;
                $data['DetailStatus']	= '' ;
                
				echo json_encode($data);
			} }
    
    
    public function InfoMaterial_product2()
	{

			$kode = $this->input->post('kode');
				$text = "SELECT * FROM Q01_MProduct WHERE RegID='$kode' AND IsDelete='X'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
                    $data['PartNo'] = $t->PartNo;
                    $data['PartName'] = $t->PartName;
					echo json_encode($data);
				}
			}else{                   
				echo json_encode($data);
			} }
    
    
    
    public function InfoMasterUser()
	{

			$kode = $this->input->post('kode');
				$text = "SELECT * FROM IMSUser WHERE RegID='$kode' AND IsDelete='X'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){    
				$data['code']               = $t->Code ;
				$data['username']               = $t->username;
                $data['nama_lengkap']         = $t->nama_lengkap;
                $data['IDLevel']               = $t->IDLevel;
                $data['level']               = $t->level;
                $data['id_dept']            = $t->id_dept;
                $data['dept']            = $t->dept;
                $data['IDBlokir']            = $t->IDBlokir ;
                $data['Blokir']            = $t->Blokir ;
                
                $data['MUser']            = $t->MUser ;
                $data['MUserIMS']            = $t->MUserIMS ;
                $data['MUserTR']            = $t->MUserTR ;
                $data['MProdMaterial']            = $t->MProdMaterial ;
                $data['MProdStamping']            = $t->MProdStamping ;
                $data['MProdWelding']            = $t->MProdWelding ;
                $data['MProdDelivery']            = $t->MProdDelivery ;
                $data['MProdStoreRoom']            = $t->MProdStoreRoom ;
                $data['MPartner']            = $t->MPartner ;
                $data['MCategory']            = $t->MCategory ;
                $data['MUnit']            = $t->MUnit ;
                $data['MProdICT']            = $t->MProdICT ;
                $data['MProdGA']            = $t->MProdGA ;
                $data['MCust']            = $t->MCust ;
                $data['MProduct']            = $t->MProduct ;
                $data['MUtility']            = $t->MUtility ;
                
                $data['TrcMaterial']            = $t->TrcMaterial ;
                $data['TrcStamping']            = $t->TrcStamping ;
                $data['TrcWelding']            = $t->TrcWelding ;
                $data['TrcWH']            = $t->TrcWH ;
                $data['TrcStoreRoom']            = $t->TrcStoreRoom ;
                $data['TrcGA']            = $t->TrcGA ;
                $data['CanEditMaster']            = $t->CanEditMaster ;
                $data['TrcICT']            = $t->TrcICT ;
                $data['TrcGA']              = $t->TrcGA ;
                $data['CanEditDoc']            = $t->CanEditDoc ;
                $data['CanEditMaster']            = $t->CanEditMaster ;
				$data['CanEditDocAdmin']            = $t->CanEditDocAdmin ;
                $data['TrcWIP']            = $t->TrcWIP ;
                $data['TrcSony']            = $t->TrcSony ;
                $data['TrcProduction']            = $t->TrcProduction ;
                     
					echo json_encode($data);
				}
			}else{ 
                $data['RegID']               = '' ; 
                $data['username']            = '' ;
                $data['nama_lengkap']        = '' ;
                $data['id_level']            = '' ;
                $data['level']               = '' ;
                $data['id_dept']             = '' ;
                $data['dept']                = '' ;
                $data['IDBlokir']            = '' ;
                $data['blokir']              = '' ;
                
                $data['MUser']               = '' ;
                $data['MUserIMS']            = '' ;
                $data['MUserTR']             = '' ;
                $data['MProdMaterial']       = '' ;
                $data['MProdStamping']       = '' ;
                $data['MProdWelding']        = '' ;
                $data['MProdDelivery']       = '' ;
                $data['MProdStoreRoom']      = '' ;
                $data['MPartner']            = '' ;
                $data['MCategory']           = '' ;
                $data['MUnit']               = '' ;
                $data['MProdICT']            = '' ;
                $data['MProdGA']             = '' ;
                $data['MProdMTNM']           = '' ;
                $data['MProdMTNT']           = '' ;
                $data['MCust']               = '' ;
                $data['MProduct']            = '' ;
                $data['MUtility']            = '' ;
                
                $data['TrcMaterial']         = '' ;
                $data['TrcStamping']         = '' ;
                $data['TrcWelding']          = '' ;
                $data['TrcWH']               = '' ;
                $data['TrcStoreRoom']        = '' ;
                $data['TrcGA']               = '' ;
                $data['TrcMTC']              = '' ;
                $data['CanEditMaster']       = '' ;
                $data['TrcICT']              = '' ;
                $data['TrcGA']               = '' ;
                $data['TrcMTNM']             = '' ;
                $data['TrcMTNT']             = '' ;
                $data['CanEditDoc']          = '' ;
                $data['CanEditMaster']       = '' ;
                $data['TrcWIP']              = '' ;
                $data['TrcSony']            = '' ;
                $data['TrcProduction']     = '' ;
				echo json_encode($data);
			} }
    
    
    
    
    
    
    
    public function InfoMachine()
	{

			$kode = $this->input->post('kode3');
			$text = "SELECT * FROM Q01_MListMachine WHERE RegID='$kode'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){ 
                    $data['Code'] = $t->Code;
                    $data['McName'] = $t->McName .' '. $t->Tonage .' '. $t->Line.' - '.$t->DetailLine;
                    $data['line'] = $t->Line;
                    $data['Tonage'] = $t->Tonage;
                     
					echo json_encode($data);
				}
			}else{ 
                    $data['Code'] = '' ;
                    $data['McName'] = '' ;
                    $data['line'] = '' ;
                    $data['Tonage'] = '' ;
				echo json_encode($data);
			}  }
    
    
    	public function InfoPartner()
	{

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
                                        
					echo json_encode($data);
				}
			}else{
			 $data['partner_code']= '';
                $data['partner_name']= '';
                $data['address']= '';
                $data['telp']= '';
				echo json_encode($data);
			} }
            
    public function InfoPartner2()
	{

			$kode = $this->input->post('kode');
			$text = "SELECT * FROM T010_Partner WHERE SysID='$kode' AND IsDelete='0'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){ 
				$data['partner_code']= $t->PartnerCode;
                $data['partner_name']= $t->PartnerName;
                $data['address']= $t->Address;
                $data['telp']= $t->Telp;
                                        
					echo json_encode($data);
				}
			}else{
			 $data['partner_code']= '';
                $data['partner_name']= '';
                $data['address']= '';
                $data['telp']= '';
				echo json_encode($data);
			} }        
    
    
    	public function InfoCust()
	{ 
			$kode = $this->input->post('kode');
				$text = "SELECT * FROM M_Customer WHERE RegID='$kode' AND IsDelete='X'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){ 
				$data['Code']= $t->Code;
                $data['CustName']= $t->CustName;
                                        
					echo json_encode($data);
				}
			}else{
				echo json_encode($data);
			} 	}
    
    	public function InfoUnit()
	{ 
			$kode = $this->input->post('kode');
				$text = "SELECT * FROM M_Unit WHERE id='$kode' AND IsDelete='X'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){ 
				$data['code']= $t->code;
                $data['unit']= $t->unit;
                                        
					echo json_encode($data);
				}
			}else{
				echo json_encode($data);
			}  }
    
    	public function InfoCategory()
	{ 
			$kode = $this->input->post('kode');
				$text = "SELECT * FROM M_Category WHERE id='$kode' AND IsDelete='X'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){ 
				$data['code']= $t->code;
                $data['category_name']= $t->category_name;
                $data['GroupBy']= $t->GroupBy;                        
					echo json_encode($data);
				}
			}else{
				echo json_encode($data);
			} }
    
    
    public function InfoBalMatIn()
	{ 
			$kode2 = $this->input->post('kode2');
				$text = "SELECT * FROM QTD_RawMaterial WHERE DocNumDetail='$kode2'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
                    $data['BalMat'] = $t->BalMat;
                    $data['BalMatSheet'] = $t->BalMatSheet;
                    $data['BalMatCoil'] = $t->BalMatCoil;
                                        
					echo json_encode($data);
				}
			}else{
                    $data['BalMat'] ='';
                    $data['BalMatSheet'] ='';
                    $data['BalMatCoil'] ='';
				echo json_encode($data);
			} }
    
    
    public function InfoProductStamping()
	{ 
			$kode = $this->input->post('kode');
				$text = "SELECT * FROM Q01_MProduct WHERE RegID='$kode'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['RegID'] = $t->RegID;
                    $data['PartNo'] = $t->PartNo;
                    $data['PartName'] = $t->PartName;
                    $data['Spec1'] = $t->Spec1;
                    $data['Spec2'] = $t->Spec2;
                    $data['Spec1'] = $t->Spec1;
                    $data['PcsPerday'] = $t->PcsPerday;
                    $data['PcsPerSheet'] = $t->PcsPerSheet;
                    $data['PcsPerKg'] = $t->PcsPerKg;
                    
					echo json_encode($data);
				}
			}else{
					$data['RegID'] = '';
                    $data['PartNo'] = '';
                    $data['PartName'] = '';
                     $data['Spec1'] = '';
                    $data['Spec2'] = '';
                    $data['Spec1']= '';
                    $data['PcsPerDay'] = '';
                    $data['PcsPerSheet'] = '';
                    $data['PcsPerKg'] = '';
				echo json_encode($data);
			} }
    
    public function InfoListMaterialOut()
	{ 
			$kode = $this->input->post('kode');
				$text = "SELECT * FROM QTD_RawMaterial WHERE DocNumDetail='$kode'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
                    $data['ItemID'] = $t->ItemID;
                    $data['PartNo'] = $t->PartNo;
                    $data['PartName'] = $t->PartName;
                    $data['IDCust'] = $t->IDCust;
                    $data['CustName'] = $t->CustName;
                    $data['Spec1'] = $t->Spec1;
                    $data['Spec2'] = $t->Spec2;
                    $data['PcsPerSheet'] = $t->PcsPerSheet;
                    $data['PcsPerKg'] = $t->PcsPerKg;
                    $data['BalMat'] = $t->BalMat;
                    $data['BalPcs'] = $t->BalPcs;
                    $data['Category'] = $t->category_name;
                    $data['BalAmount'] = $t->BalAmount;
                    
                    
					echo json_encode($data);
				}
			} }
    
   public function InfoListPicTr()
	{ 
			$kode3 = $this->input->post('kode3');
				$text = "SELECT * FROM ListPicTR WHERE id='$kode3'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
                    $data['IDPic'] = $t->id;
                    $data['code'] = $t->Code;
                    $data['nama_lengkap'] = $t->nama_lengkap;
                    $data['Dept_Name'] = $t->Dept_Name;
					echo json_encode($data);
				}
			} }
    
    
    public function DataBarang_coil(){
		
			$cari= $this->input->post('cari');
		
				$cust = $this->session->userdata('cust');
                $coil = "1";
				if(empty($cari)){
					$text = "SELECT * FROM product_coil WHERE id_jenis_material='$coil'";
				}else{
					$text = "SELECT * FROM product_coil WHERE (spec LIKE '%$cari%' OR part_no LIKE '%$cari%') AND id_jenis_material='$coil'";
				}
			
			$d['data'] = $this->app_model->manualQuery($text);
			
            
			$this->load->view('data_barang_coil',$d);
	
	}
    
    public function InfoTambahAsset()
	{ 
          
            $DocNum                 = $this->app_model->DocNumAsset();
            $data['ItemID'] = $DocNum ;
             echo json_encode($data);   
            $up['ItemID']           = $this->app_model->DocNumAsset();
            $up['UserID']         = $this->session->userdata('RegID');
            $id['ItemID']         = $this->app_model->DocNumAsset();
            $id['UserID']         = $this->session->userdata('RegID');
            
            $up2['SysID']           = $this->app_model->DocNumAsset();
            
            $data = $this->app_model->getSelectedData("M_Asset",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("M_Asset",$up);
            $this->app_model->insertData("M_AssetICT",$up2);
            }  }
            
            
     public function InfoTambahBOM()
	{ 
          
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
		    if($data2->num_rows()>0){
		    
		    }else{
			$this->app_model->insertData("BOM1",$up);
            $this->app_model->insertData("BOM2",$up2);
            
            $NoUrut2 = $this->app_model->CariNoUrut($DocNum);
            $NoUrut = $NoUrut2 + 1 ;
            
            $data['NoUrut'] = $NoUrut ;
          
            $data['pesan'] = "Success !!!";
            } 
            
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
            $data['NoUrut'] = $this->input->post('NoUrut') ;
             
		    }  
                
            }
           
            
          
          
          echo json_encode($data);
                
            
          
     }
     
     
     
    public function InfoTambahChild()
	{ 
          
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
            $data2['pesan'] = "Save Success !!!";
          
             
            }
            }  
          echo json_encode($data2); 
     }
     
     
     public function InfoTambahChild_add()
	{ 
          
          $kode = $this->input->post('LinkID');
          if(empty($kode)){
            }else{
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
          echo json_encode($data2);     
          
            }  
          
     }
   
   public function InfoCopyAsset()
	{ 
          
          $DocNum    = $this->app_model->DocNumAsset();
          $data['ItemID'] = $DocNum ;
          
                                                  
             echo json_encode($data); 
               
            $up['ItemID']           = $this->app_model->DocNumAsset();
            $up['ItemNo']           = $this->input->post('ItemNo');
            $up['ItemName']           = $this->input->post('ItemName');
            $up['Spec']           = $this->input->post('Spec');
            $up['CategoryID']           = $this->input->post('CategoryID');
            $up['UnitID']           = $this->input->post('UnitID');
            $up['LocationID']           = $this->input->post('LocationID');
            $up['IsActive']           = $this->input->post('IsActive');
            $up['Remark']           = $this->input->post('Remark');
            $up['UserID']         = $this->session->userdata('RegID');
            $up['Image']           = $this->input->post('ItemID').''.'.png';
            
            $id['ItemID']           = $this->app_model->DocNumAsset();
            $id['UserID']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("M_Asset",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("M_Asset",$up);
            }  }
            
   
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
    
    
     public function InfoTambahFormWIPIn()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumMaterialINWip();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailMaterialINWip($id);
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
            
            $up['DocNum']		    = $this->app_model->DocNumMaterialINWip() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumMaterialINWip();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }   }
    
    
    
    public function InfoTambahFormWIPOut()
	{
 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumMaterialOUTWip();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOUTWip($id);
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
            
            $up['DocNum']		    = $this->app_model->DocNumMaterialOUTWip() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumMaterialOUTWip();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
    
    
    public function InfoTambahFormInFG()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumMaterialINFinishGood();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailMaterialINFinishGood($id);
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
            
            $up['DocNum']		    = $this->app_model->DocNumMaterialINFinishGood() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumMaterialINFinishGood();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
            
    public function InfoTambahFormOutFG()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumMaterialOutFinishGood();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOutFinishGood($id);
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
            
            $up['DocNum']		    = $this->app_model->DocNumMaterialOutFinishGood() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumMaterialOutFinishGood();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
    
    
    public function InfoTambahFormTRMatIn()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumMaterialINRMOther();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailMaterialINTR($id);
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
            
            $up['DocNum']		    = $this->app_model->DocNumMaterialINRMOther() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumMaterialINRMOther();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
    
    
     public function InfoTambahFormGAMatIn()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumMaterialINGA();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailMaterialINGA($id);
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
            
            $up['DocNum']		    = $this->app_model->DocNumMaterialINGA() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumMaterialINGA();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
    
    
    public function InfoTambahFormMatOut()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumMaterialOUTMPC();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOUTMPC($id);
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
            
            $up['DocNum']		    = $this->app_model->DocNumMaterialOUTMPC() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumMaterialOUTMPC();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  	}
    
    
    
     public function InfoTambahFormProdWeld()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumOutWeld();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailOutWELD($id);
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
            
            $up['DocNum']		    = $this->app_model->DocNumOutWeld() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumOutWeld();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
            
    
    public function InfoTambahFormProduction()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumOutSTP();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailOutSTP($id);
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
                
                $Thn3 = date('Y');
                $tgl3 = date('d');
                $bln3 = date('m');
                
                $Start = $bln3.'/'.$tgl3.'/'.$Thn3 .' '. $CreateTime2 ;
                $Finish = $bln3.'/'.$tgl3.'/'.$Thn3 .' '. $CreateTime2 ;
                
                
                $data['Start'] = $Start ;
                $data['Finish'] = $Finish ;    
                
                
                echo json_encode($data);

            //Time SERVER,
date_default_timezone_set('Asia/Jakarta');	

            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            
            $up['DocNum']		    = $this->app_model->DocNumOutSTP() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumOutSTP();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
    
    
    public function InfoTambahFormTRMatOut()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumMaterialOUTRMOther();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOUTTR($id);
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
            
            $up['DocNum']		    = $this->app_model->DocNumMaterialOUTRMOther() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumMaterialOUTRMOther();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
    
     public function InfoTambahFormGAMatOut()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumMaterialOUTGA();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOUTGA($id);
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
            
            $up['DocNum']		    = $this->app_model->DocNumMaterialOUTGA() ;
			$up['CreateDate']		= $CreateDateSQL ;
            $up['DocDate']		    = $CreateDateSQL ;
			$up['CreateBy']         = $this->session->userdata('RegID');
            $up['CreateTime']       = $CreateTime ;
            $id['DocNum']           = $this->app_model->DocNumMaterialOUTGA();
            $id['CreateBy']         = $this->session->userdata('RegID');
            
            $data = $this->app_model->getSelectedData("G_DocNumMat",$id);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
    
    
    
    public function InfoTambahFormRetMat()
	{ 
          $id = $this->input->post('kode');
          if(empty($id)){
            $DocNumDetail	        = '001'   ; 
            $DocNum                 = $this->app_model->DocNumMaterialRetMPC();
            }else{
             $DocNumDetail	        = $this->app_model->DocNumDetailMaterialRetMPC($id);
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
			$this->app_model->insertData("G_DocNumMat",$up);
            }  }
    
    
    public function InfoTambahFormDetailMatOut()
	{ 
			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            $id = $this->input->post('kode');
            
            $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOUTMPC($id);
            
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;

                     
					echo json_encode($data);

		 
	}
    
    
     public function InfoTambahFormDetailProduction()
	{ 

            $kode = $this->input->post('kode');
			$text = "SELECT * FROM DetailProduction WHERE DocNum='$kode'";
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
            $CreateTime2	            = date ("H:i") ;
            $id = $this->input->post('kode');
            $DocNumDetail	        = $this->app_model->DocNumDetailOutSTP($id);
                    
                    
                
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $this->app_model->tgl_str($t->DocDate) ;
                $data['CreateTime']	= $CreateTime ;
                $data['ItemID']	= $t->ItemID ;
                $data['PartNo'] = $t->PartNo;
                $data['PartName'] = $t->PartName;
                $data['IDCust'] = $t->IDCust;
                $data['IDProject'] = $t->IDProject;
                $data['CustName'] = $t->CustName;
                $data['CustName2'] = $t->Code .' '. $t->ProjectName;
                $data['ShiftID'] = $t->ShiftID;
                
                $Thn3 = date('Y');
                $tgl3 = date('d');
                $bln3 = date('m');
                
                $Start = $bln3.'/'.$tgl3.'/'.$Thn3 .' '. $CreateTime2 ;
                $Finish = $bln3.'/'.$tgl3.'/'.$Thn3 .' '. $CreateTime2 ;
                    
                 $data['Start'] = $Start ;
                $data['Finish'] = $Finish ;    
                    
                     
					echo json_encode($data);
				}
			}else{ 
                    
				echo json_encode($data);
			} }
            
            
            public function InfoTambahFormDetailProdWELD()
	{ 

            $kode = $this->input->post('kode');
			$text = "SELECT * FROM DetailProduction WHERE DocNum='$kode'";
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
            $id = $this->input->post('kode');
            $DocNumDetail	        = $this->app_model->DocNumDetailOutWELD($id);
                    
                    
                
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;
                $data['ItemID']	= $t->ItemID ;
                $data['PartNo'] = $t->PartNo;
                $data['PartName'] = $t->PartName;
                $data['IDCust'] = $t->IDCust;
                $data['IDProject'] = $t->IDProject;
                $data['CustName'] = $t->CustName;
                $data['CustName2'] = $t->Code .' '. $t->ProjectName;
                    
                    
                    
                     
					echo json_encode($data);
				}
			}else{ 
                    
				echo json_encode($data);
			} }
    
    
    public function InfoTambahFormDetailTRMatOut()
	{ 

			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            $id = $this->input->post('kode');
            
            $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOUTTR($id);
            
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;

                     
					echo json_encode($data);

		 }
    

    
    public function InfoTambahFormDetailRetMat()
	{ 

			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            $id = $this->input->post('kode');
            
            $DocNumDetail	        = $this->app_model->DocNumDetailMaterialRetMPC($id);
            
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;

                     
					echo json_encode($data);
 }
    
    
    public function InfoTambahFormDetailMatIN(){
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');		    
 $CreateDate	            = date('d-m-Y');
 $DocDate	            = date('d-m-Y');
 $CreateDateSQL	        = date('Y-m-d');
 $CreateTime	            = date ("H:i:s") ;
 $id = $this->input->post('kode');
 $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOUTMPC($id);
 $IDPartner	        = $this->app_model->CariPartnerByDoc($id);
 $data['DocNumDetail'] = $DocNumDetail ; 
 $data['PartnerID'] = $IDPartner ; 
 $data['CreateDate']	= $CreateDate ;
 $data['DocDate']	    = $DocDate ;
 $data['CreateTime']	= $CreateTime ;
 echo json_encode($data);
 }
    
    
     public function infoLike()
	{
 
		  
            $id4 = $this->input->post('kode');


            $jumlahlike	        = $this->app_model->TambahLike($id4);
            $hasil              = $jumlahlike ;
            
            
            $up['like'] = $hasil ;
            $id2['idcoment']         = $id4 ;
            
            $data = $this->app_model->getSelectedData("D_Comment",$id2);
		    if($data->num_rows()>0){
		      }else{
			$this->app_model->updateData("D_Comment",$up,$id2);
            } 

                     
					echo json_encode($data);

	 }
    
    public function InfoTambahFormDetailWIPIn()
	{ 
			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            $id = $this->input->post('kode');
            
            $DocNumDetail	        = $this->app_model->DocNumDetailMaterialINWip($id);
            
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;

                     
					echo json_encode($data);

	 }
    
    
    public function InfoTambahFormDetailWIPOut()
	{
 
			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            $id = $this->input->post('kode');
            
            $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOUTWip($id);
            
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;

                     
					echo json_encode($data);

		 }
         
    public function InfoTambahFormDetailOutFG()
	{
 

			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            $id = $this->input->post('kode');
            
            $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOutFinishGood($id);
            
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;

                     
					echo json_encode($data);

		 }
    
    
    public function InfoTambahFormDetailInFG()
	{
 

			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            $id = $this->input->post('kode');
            
            $DocNumDetail	        = $this->app_model->DocNumDetailMaterialINFinishGood($id);
            
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;

                     
					echo json_encode($data);

		 }
    
    
    public function InfoTambahFormDetailTRMatIN()
	{
 

			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            $id = $this->input->post('kode');
            $DocNumDetail	        = $this->app_model->DocNumDetailMaterialINTR($id);
            
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;

                     
					echo json_encode($data);

		 }
    
    public function InfoTambahFormDetailGAMatIN()
	{
 

			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            $id = $this->input->post('kode');
            
            $DocNumDetail	        = $this->app_model->DocNumDetailMaterialINGA($id);
            
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;

                     
					echo json_encode($data);

		 }
    
    public function InfoTambahFormDetailGAMatOut()
	{
 

			//Time SERVER,
date_default_timezone_set('Asia/Jakarta');		    
            $CreateDate	            = date('d-m-Y');
            $DocDate	            = date('d-m-Y');
            $CreateDateSQL	        = date('Y-m-d');
            $CreateTime	            = date ("H:i:s") ;
            $id = $this->input->post('kode');
            
            $DocNumDetail	        = $this->app_model->DocNumDetailMaterialOUTGA($id);
            
                $data['DocNumDetail'] = $DocNumDetail ; 
                $data['CreateDate']	= $CreateDate ;
                $data['DocDate']	    = $DocDate ;
                $data['CreateTime']	= $CreateTime ;

                     
					echo json_encode($data);

		 }
    
    public function JumlahLike()
	{

			$kode = $this->input->post('code');
			$text = "SELECT * FROM D_Comment WHERE idcoment='$kode'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
			foreach($tabel->result() as $t){
                    $data['QtyLike'] = $t->LikeCom;
                    echo json_encode($data);

		 } }
         }
    
   function GetInfoItem()
   {
        $RegID = $this->input->post('RegID');
        $DB=$this->app_model->dbQuery("SELECT *, ISNULL(IDUnit,28) AS IDUnitDefault FROM Q01_MProduct WHERE IsActive=1 AND RegID='".$RegID."' ORDER BY IDCust DESC");
        $data=$DB->result();
        echo json_encode($data);
   } 
    
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */