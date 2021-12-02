<?php
class BPFG extends CI_Controller{
 function __construct()
 {
    parent::__construct();
    $this->load->model(array('app_model'));
    $this->load->library(array('form_validation','template'));
    $cek = $this->Role_Model->TrcBPFG();
    if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
    elseif(empty($cek)){ redirect('welcome'); }
    date_default_timezone_set('Asia/Jakarta');
 }
 
 function index()
 {
    $d['title']="Home";
    $text5 = "SELECT * FROM M_QCCheck WITH (NOLOCK) WHERE Category LIKE '%STP%' ";
    $d['M_QCCheck'] = $this->app_model->manualQuery($text5);
    
    $sql_product = 'SELECT * FROM Q01_MProduct WHERE IsDelivery=1 AND IsActive=1 ORDER BY IDCust DESC';
    $MasterList=$this->app_model->dbQuery($sql_product);
    $d['MListProduct'] = $MasterList->result(); 
    $text6 = "SELECT * FROM M_Shift2 WITH (NOLOCK)";
    $d['M_Shift'] = $this->app_model->manualQuery($text6);
    $text2 = "SELECT * FROM M_Partner WHERE Category='RM' ORDER BY id DESC" ;
    $d['MListPartner'] = $this->app_model->manualQuery($text2); 
    $text3 = "SELECT * FROM M_customer ";
    $d['l_cust'] = $this->app_model->manualQuery($text3);
    
    $DocDate	            = date('d-m-Y');
    $d['DocDateReport_2']= date('d-m-Y');
    $d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
    $d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
    $d['DocDateReport_2']= $DocDate ;
    
    $sql_location = "SELECT * FROM M_Location WHERE Category NOT LIKE 'ASSET' ORDER BY Category,Location";
    $d['area'] = $this->app_model->dbQuery($sql_location)->result();
    
    $this->template->display('BPFG/index',$d);
 }
 
     function TransactionList()
     {
        $sql = 'SELECT * FROM QTH_RawMaterial WHERE IDTrcType=605 ORDER BY RegID DESC OFFSET 0 ROWS FETCH NEXT 50 ROWS ONLY';
        $DB=$this->app_model->dbQuery($sql);
        $data['list']=$DB->result();
        $this->load->view('BPFG/TransactionList',$data); 
     }
 
    public function InfoTambahFormInFG()
	{ 
        $id = $this->input->post('kode');
        if(empty($id)){
            $DocNumDetail = '001'   ; 
            $DocNum = $this->app_model->DocNumMaterialCreateBPFGOther();
        }else{
            $DocNumDetail = $this->app_model->DocNumDetailCreateBPFG($id);
            //$id = $this->input->post('kode');  
            $DocNum = $id;
        }
        //Time SERVER,
        	    
        $CreateDate = date('d-m-Y');
        $DocDate = date('d-m-Y');
        $CreateDateSQL = date('Y-m-d');
        $CreateTime = date("H:i:s");
        $data['DocNumDetail'] = $DocNumDetail; 
        $data['DocNum'] = $DocNum;
        $data['CreateDate']	= $CreateDate;
        $data['DocDate'] = $DocDate;
        $data['CreateTime']	= $CreateTime;
        
        //$data['ShiftID'] = $this->app_model->db_get_one("SELECT b.ShiftID FROM TH_RawMaterial b WHERE b.RegID='".$RegID."'");
        //$data['Shift'] = $this->app_model->db_get_one("SELECT a.Shift FROM TH_RawMaterial b JOIN M_Shift2 a ON a.SysID = b.ShiftID WHERE b.RegID='".$RegID."'");
        
        
        echo json_encode($data);
        //Time SERVER,
        	
        $CreateDate	            = date('d-m-Y');
        $DocDate	            = date('d-m-Y');
        $CreateDateSQL	        = date('Y-m-d');
        $CreateTime	            = date("H:i:s") ;
        if(empty($id))
        {
            $up['DocNum'] = $this->app_model->DocNumMaterialCreateSJGeneralOther();
            $up['CreateDate'] = $CreateDateSQL;
            $up['DocDate'] = $CreateDateSQL;
            $up['CreateBy'] = $this->session->userdata('RegID');
            $up['CreateTime'] = $CreateTime;
            $id['DocNum'] = $this->app_model->DocNumMaterialCreateBPFGOther();
            $id['CreateBy'] = $this->session->userdata('RegID');
            $data2 = $this->app_model->getSelectedData("G_DocNumMat",$id);
            if($data2->num_rows()>0){
            }
            else
            {
                $this->app_model->insertData("G_DocNumMat",$up);
            }
        }
    }
    
    function MasterList()
    {
        $DB=$this->app_model->dbQuery("SELECT * FROM Q01_MProduct WHERE IsDelivery=1 AND IsActive=1 ORDER BY IDCust DESC");
        $data['MListProduct']=$DB->result();
        //echo"<pre>";
        //print_r($data);
        //echo"</pre>";
        $this->load->view('BPFG/master_list',$data); 
    } 
    
    function GetInfoItem()
    {
        $RegID = $this->input->post('RegID');
        $DB=$this->app_model->dbQuery("SELECT * FROM Q01_MProduct WHERE IsDelivery=1 AND IsActive=1 AND RegID='".$RegID."' ORDER BY IDCust DESC");
        $data=$DB->result();
        echo json_encode($data);
    }

    function DataDetailMatIn()
    {
        $id = $this->input->post('kode');
        $sql = "SELECT * FROM QTD_RawMaterial WHERE DocNum='$id' AND QtyMat!=0 ORDER BY RegID DESC";
        $DB =$this->app_model->dbQuery($sql);
        $data['list']=$DB->result();
        $this->load->view('BPFG/DetailMatIn',$data); 
    }
    
    function simpan()
    {
        $id = $this->input->post('ItemID');
        $Stock = $this->input->post('StockFG');
        $STOFG = $this->app_model->CariStockFG($this->input->post('ItemID')) ; 
        if($STOFG != $Stock && 1==2){
            echo 'Silahkan Klik ReCheck Lalu lanjutkan klik Simpan';
        }else{
        $Header['DocNum']          = $this->input->post('DocNum');
        $Header['DocDate']         = $this->app_model->tgl_sql($this->input->post('DocDate'));
        $Header['DocTime']         = $this->input->post('CreateTime');
        $Header['CreateBy']        = $this->session->userdata('RegID') ;
        $Header['CreateDate']      = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
        $Header['HideH']           = md5($this->input->post('DocNum')) ;
        $Header['IDTrcType']       = '605';
        $Detail['CreateBy']             = $this->session->userdata('RegID') ;
        $Detail['DocNum']               = $this->input->post('DocNum') ;
        $Detail['DocNumDetail']         = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ;
        $Detail['HideH']                = md5($this->input->post('DocNum')) ;
        $Detail['HideD']                = md5($this->input->post('DocNum') ."". $this->input->post('DocNumDetail')) ;
        $Detail['DocDate']              = $this->app_model->tgl_sql($this->input->post('DocDate'));
        $Detail['DocTime']              = $this->input->post('CreateTime');
        $Detail['CreateDate']           = $this->app_model->tgl_sql($this->input->post('CreateDate')) ;
        $Detail['ItemID']               = $this->input->post('ItemID') ; 
        $Detail['QtyPcs']               = $this->input->post('Qty') ;
        $Detail['QtyMat']               = $this->input->post('Qty') ;
        $Detail['BalPcs']               = $this->input->post('Qty') ;
        $Detail['BalMat']               = $this->input->post('Qty') ;
        $Detail['Remark']               = $this->input->post('Remark') ;
        $Detail['ShiftID'] = $this->input->post('ShiftID');
        $Detail['FromArea'] = $this->input->post('FromArea');
        $Detail['SourceDocNum']         = $this->input->post('DocNumExt') ;
        $Detail2['StockFG']           = $this->input->post('Balance') ;
        $IndexHeader2['RegID']        = $this->input->post('ItemID');
        $IndexHeader['DocNum']               = $this->input->post('DocNum');
        $IndexHeader['CreateBy']             = $this->session->userdata('RegID') ;
        $IndexDetail['DocNum']               = $this->input->post('DocNum');
        $IndexDetail['DocNumDetail']         = $this->input->post('DocNum') ."". $this->input->post('DocNumDetail') ; 
        $IndexDetail2['RegID']               = $this->input->post('ItemID') ; 
        $IndexHeader3['DocNum']               = $this->input->post('DocNum');
        $IndexDetail3['DocNumDetail'] = $this->input->post('DocNumDetail3') ;
        $IndexDetail3['CreateBy']      = $this->session->userdata('RegID') ;
        $DocNumDetail2 = $this->input->post('DocNumDetail3') ;
        $data = $this->app_model->getSelectedData("TH_RawMaterial",$IndexHeader);
        if($data->num_rows()>0){
        if(empty($DocNumDetail2)){
        $data = $this->app_model->getSelectedData("TD_RawMaterial",$IndexDetail);
        if($data->num_rows()>0){
        echo 'Data sudah diinput' ;
        }else{
        $this->app_model->insertData("TD_RawMaterial",$Detail); 
        //$this->app_model->updateData("M_Product",$Detail2,$IndexHeader2);
        echo 'Tambah data Sukses' ;
        }	}else{
        $data = $this->app_model->getSelectedData("TD_RawMaterial",$IndexDetail3);
        if($data->num_rows()>0){
        $this->app_model->updateData("TD_RawMaterial",$Detail,$IndexDetail3);
        //$this->app_model->updateData("M_Product",$Detail2,$IndexHeader2);
        echo 'Data berhasil diupdate' ;
        }else{
        echo 'Silahkan Login Menggunakan User Data !!!' ;} }
        }else{ 
        if(empty($DocNumDetail2)){
        $data = $this->app_model->getSelectedData("TH_RawMaterial",$IndexHeader3);
        if($data->num_rows()>0){
        echo 'Silahkan Login Menggunakan User Data !!!' ;
        }else{
        $data = $this->app_model->getSelectedData("TD_RawMaterial",$IndexDetail);
        if($data->num_rows()>0){
        echo 'Data sudah diinput';
        }else{ 
        $this->app_model->insertData("TH_RawMaterial",$Header);
        $this->app_model->insertData("TD_RawMaterial",$Detail); 
        //$this->app_model->updateData("M_Product",$Detail2,$IndexHeader2);
        echo 'Simpan data Sukses' ; }  }
        }else{
        echo 'Silahkan Login Menggunakan User Data !!!' ; } } }
    }
    
    function DataDetailMatIn2()
    {
        $id = $this->input->post('kode');
        $sql = "SELECT *,dbo.fn_numrows_bpfg_confirm(QTD_RawMaterial.RegID) as confirm FROM QTD_RawMaterial WHERE DocNum='$id' AND QtyMat!=0 ORDER BY RegID DESC";
        //echo"<pre>";
        //print_r($sql);
        //echo"</pre>";
        $DB =$this->app_model->dbQuery($sql);
        $data['list']=$DB->result();
        $this->load->view('BPFG/DetailMatIn2',$data);
    }
    
    public function ReadReport()
    {
        $tgl1 = $this->app_model->tgl_sql($this->input->post('tgl1'));
        $tgl2 = $this->app_model->tgl_sql($this->input->post('tgl2'));
        $IDCust = $this->input->post('IDCust');
        $PartNo2 = $this->input->post('PartNo2');
        
        $where = " WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND IDTrcType=605";
        if(empty($PartNo2))
        {
            if($IDCust!='semua')
            { 
                $where .= "AND IDCust='$IDCust' ";
            }
        }
        else
        {
            if($IDCust!='semua')
            { 
                $where .= "AND PartNo LIKE '%$PartNo2%' AND IDCust='$IDCust'";
            }
            else
            { 
                $where .= "AND PartNo LIKE '%$PartNo2%'" ; 
            }  
        } 
        $text = "SELECT * FROM QTD_RawMaterial $where ORDER BY DocDate,DocTime ASC ";
        $DB = $this->app_model->dbQuery($text);
        //$DB = $this->INFinishGood_model->transaction_detail_report($tgl1,$tgl2,$IDCust,$PartNo2);
        $d['list']=$DB->result();              
        $this->load->view('BPFG/transaction_detail_report',$d); 
    }
    
    function PrintList()
    {
        $d['judul'] = "Data Material Masuk";
        $id = $this->uri->segment(3);
        $text = "SELECT * FROM QTH_RawMaterial WHERE DocNum='$id'";
        $data2 = $this->app_model->manualQuery($text);
        if($data2->num_rows() > 0){
        foreach($data2->result() as $db){
        $d['DocNum']	= $id;
        $d['DocDate']	= $this->app_model->tgl_str($db->DocDate);
        $d['judul']= "Transaksi Material Masuk" ; 
        $d['UserName']	= $db->CreateBy ; }
        }else{
        $d['DocNum']		='';
        $d['DocDate']	='';
        $d['judul']= "Transaksi Material Masuk" ; 
        $d['UserName']	= ''; } 
        
        $sql = "SELECT * FROM QTD_RawMaterial WHERE DocNum='$id' AND QtyMat!=0 ORDER BY RegID DESC";
        $DB =$this->app_model->dbQuery($sql);
        $d['data']=$DB->result();
        $d['num'] = $DB->num_rows();					
        $this->load->view('BPFG/PrintListNew',$d);
    }
    
    function PrintListKecil()
    {
        $id = $this->uri->segment(3);
        $d['judul'] = "Print Label";
        $text = "SELECT * FROM TH_RawMaterial WHERE DocNum LIKE '%$id%' AND IDTrcType='605'";
        $data = $this->app_model->manualQuery($text);
        if($data->num_rows() > 0)
        {
            foreach($data->result() as $db)
            {
                $d['DocNum'] = $id;
                $d['DocDate'] = $this->app_model->tgl_str($db->DocDate); 
            }        
        }
        else
        {
            $d['DocNum'] =$id;
            $d['DocDate'] =''; 
        } 
        $DB=$this->app_model->dbQuery("SELECT a.*, b.username, (SELECT COUNT (*) FROM TD_RawMaterial WHERE DocNum LIKE '$id' AND IsDelete='X') as JmlItem FROM TH_RawMaterial a JOIN M_User b ON b.RegID = a.CreateBy WHERE DocNum LIKE '$id' AND IDTrcType='605'");
        $d['data']=$DB->result();	
        
        //echo"<pre>";
        //print_r($d);
        //echo"</pre>";			
        $this->load->view('BPFG/PrintListKecil',$d);
    } 
    
    function PrintList2()
    {
        $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
        $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
        $IDCust = $this->uri->segment(5);
        $PartNo2 = $this->uri->segment(6);
        $d['judul'] = "";
        $d['filter'] = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);
        $d['filter2'] = 'Tgl '.$this->app_model->tgl_str($tgl1).' - '.$this->app_model->tgl_str($tgl2);
        if($IDCust!='semua'){ $d['IDCust'] = $this->app_model->CariCustName($this->uri->segment(5));}else{
        $d['IDCust'] = "Semua Customer"; }
        $d['ItemID'] = $this->uri->segment(7); 
        
        $where = " WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND IDTrcType=600";
        if(empty($PartNo2)){
        if($IDCust!='semua'){ 
        $where .= "AND IDCust='$IDCust' ";}
        }else{
        if($IDCust!='semua'){ 
        $where .= "AND PartNo LIKE '%$PartNo2%' AND IDCust='$IDCust'";}
        else{ $where .= "AND PartNo LIKE '%$PartNo2%'" ; 
        }  } 
        $text = "SELECT * FROM QTD_RawMaterial $where ORDER BY DocDate,DocTime ASC ";
        $DB = $this->app_model->dbQuery($text);          
        //$DB = $this->INFinishGood_model->transaction_detail_report($tgl1,$tgl2,$IDCust,$PartNo2);
        $d['data']=$DB->result(); 
        $d['num'] = $DB->num_rows();                
        $this->load->view('BPFG/PrintList2',$d);
    }
    
    public function ExportReport()
    {
        $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
        $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
        $IDCust = $this->uri->segment(5);
        $PartNo2 = $this->uri->segment(6);
        $d['judul'] = "";
        $d['filter'] = $this->app_model->tgl_str($tgl1).' ~ '.$this->app_model->tgl_str($tgl2);
        $d['filter2'] = 'Tgl '.$this->app_model->tgl_str($tgl1).' - '.$this->app_model->tgl_str($tgl2);
        if($IDCust!='semua'){
        $d['IDCust'] = $this->app_model->CariCustName($this->uri->segment(5));}else{
        $d['IDCust'] = "All Customer"; }
        $d['ItemID'] = $this->uri->segment(7);           
        $where = " WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND IDTrcType=600";
        if(empty($PartNo2)){
        if($IDCust!='semua'){ 
        $where .= "AND IDCust='$IDCust' ";}
        }else{
        if($IDCust!='semua'){ 
        $where .= "AND PartNo LIKE '%$PartNo2%' AND IDCust='$IDCust'";}
        else{ $where .= "AND PartNo LIKE '%$PartNo2%'" ; 
        }  } 
        $text = "SELECT * FROM QTD_RawMaterial $where ORDER BY DocDate,DocTime ASC ";
        $DB = $this->app_model->dbQuery($text);  
        //$DB = $this->INFinishGood_model->transaction_detail_report($tgl1,$tgl2,$IDCust,$PartNo2);
        $d['data']= $DB->result(); 
        $d['num'] = $DB->num_rows();                
        $this->load->view('BPFG/ExportListReport',$d); 
    }
    
    public function Hapus_Transaksi()
    {
        //Time SERVER,
        //date_default_timezone_set('Asia/Jakarta');
        $DocDate	            = $this->app_model->tgl_sql(date('d-m-Y'));
        
        $Detail2['StockFG']           = $this->input->post('BalanceDelete') ;
        $IndexHeader2['RegID']        = $this->input->post('ItemIDDelete');
        
        $up['QtyMat']       = "0" ;
        $up['QtyPcs']       = "0" ;
        $up['BalMat']       = "0" ;
        $up['BalPcs']       = "0" ;
        $up['Amount']       = "0" ;
        $up['IsDelete']     = "O" ;
        $up['CreateBy']           = $this->session->userdata('RegID');
        $up['DocDate']            = $DocDate ;
        $id_d['DocNumDetail']            = $this->input->post('DocNumDetailDelete'); 
        $id_d['CreateBy']                = $this->session->userdata('RegID') ;
        $data = $this->app_model->getSelectedData("TD_RawMaterial",$id_d);
        if($data->num_rows()>0)
        {
            $this->app_model->updateData("TD_RawMaterial",$up,$id_d);
            //$this->app_model->updateData("M_Product",$Detail2,$IndexHeader2);
            echo 'Data berhasil di hapus bro' ;
        }else
        {        
            echo 'Anda bukan User Data';	 
        } 
    }
    
    function bikin_barcode($kode)
    {
        $this->load->library('zend');
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code128', 'image', array('text'=>$kode), array());
    }  

}
    