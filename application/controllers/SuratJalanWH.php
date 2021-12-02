<?php
class SuratJalanWH extends CI_Controller{
    public $DeptID;
    public $TypeID;
    public $STypeID;
    public $DocGen;
    
 function __construct()
 {
    parent::__construct();
    $this->load->model(array('app_model'));
    $this->load->library(array('form_validation','template'));
    $cek = $this->Role_Model->TrcSJWH();
    if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
    elseif(empty($cek)){ redirect('welcome'); }
    date_default_timezone_set('Asia/Jakarta');
    $this->DeptID = $this->session->userdata('DeptID');
    $this->TypeID = 1;
    $this->STypeID = 1;
 }
 
 function index()
 {
    $d['title']="Home";    
    //echo"<pre>";
    //print_r(substr('SAI/SJ/G/170002',-4,4));
    //echo"</pre>";
    $sql_p = "SELECT * FROM T010_Partner WHERE IsCustomer = '1' ORDER BY PartnerCode"; 
    $d['Partner'] = $this->app_model->dbQuery($sql_p)->result();
    $d['PartnerID'] = '';
    $d['Shipper'] = $this->app_model->dbQuery("SELECT * FROM T014_Shipper ORDER BY Shipper")->result();
    $d['ShipperID'] = '';
    $DocDate	            = date('d-m-Y');
    $d['DocDateReport_2']= date('d-m-Y');
    $d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
    $d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
    $d['DocDateReport_2']= $DocDate ;
    $text3 = "SELECT * FROM T010_Partner WHERE ISNULL(PartnerCode,'') <> '' AND IsCustomer = '1' ORDER BY PartnerCode";
    $d['l_cust'] = $this->app_model->manualQuery($text3);
    $this->template->display('SuratJalanWH/index',$d);    
 }

 function TransactionList()
 {
    //$DeptID = $this->app_model->db_get_one("SELECT DeptID FROM M_UserG5 WHERE SysID='".$this->session->userdata('SysID')."'");
    $sql = "SELECT a.RegID, a.DocNum,a.CreateTime,a.DocDate, b.UserName as CreateBy, (SELECT COUNT(*) FROM TD_SuratJalan WHERE IsDelete = '0' AND TH_RegID = a.RegID) AS TotalDetail, a.StatusConfirm
                FROM TH_SuratJalan a 
                JOIN M_UserG5 b ON b.SysID = a.CreateBy
                WHERE a.TypeID IN (".$this->STypeID.")
                ORDER BY a.RegID DESC OFFSET 0 ROWS FETCH NEXT 50 ROWS ONLY";
    
    $DB=$this->app_model->dbQuery($sql);
    $data['list']=$DB->result();
    $data['sql'] = $sql;
    
    //echo'<pre>';
    //print_r($data);
    //echo'</pre>';
    
    $this->load->view('SuratJalanWH/TransactionList',$data);
 } 
 
 function InfoTambahFormInFG()
 {
    $id = $this->input->post('kode');
    if(empty($id)){
        $DocNumDetail = '001'   ; 
        $DocNum = $this->app_model->DocNumMaterialCreateSJGeneralOther();
    }else{
        $DocNumDetail = $this->app_model->DocNumDetailCreateSJ($id);
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
    $data['Username'] = $this->session->userdata('UserName');
    $data['ShipTime']	= date("H:i");
    //$data['ShiftID'] = $this->app_model->db_get_one("SELECT b.ShiftID FROM TH_SuratJalan b WHERE b.RegID='".$RegID."'");
    //$data['Shift'] = $this->app_model->db_get_one("SELECT a.Shift FROM TH_SuratJalan b JOIN M_Shift2 a ON a.SysID = b.ShiftID WHERE b.RegID='".$RegID."'");
    $sql_p = "SELECT * FROM T010_Partner WHERE IsCustomer = '1' AND ISNULL(PartnerCode,'') <> '' ORDER BY PartnerCode";
    $d['Partner'] = $this->app_model->dbQuery($sql_p)->result();
    $d['PartnerID'] = '';
    $data['Templates'] = $this->load->view('SuratJalanWH/tab_content2',$d,true);
    
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
        $up['CreateBy'] = $this->session->userdata('SysID');
        $up['CreateTime'] = $CreateTime;
        $id['DocNum'] = $this->app_model->DocNumMaterialCreateSJGeneralOther();
        $id['CreateBy'] = $this->session->userdata('SysID');
        $data2 = $this->app_model->getSelectedData("G_DocNumMat",$id);
        if($data2->num_rows()>0){
        }
        else
        {
            $this->app_model->insertData("G_DocNumMat",$up);
        }
    }
 }
 
 function DetailData()
 {
    $this->load->view('SuratJalanWH/DetailData');
 } 
 
 function GetInfoPartner()
 {
    $DB=$this->app_model->dbQuery("SELECT * FROM T010_Partner WHERE SysID='".$this->input->post('SysID')."'")->result();
    echo json_encode($DB);
 }

 function MasterList()
 {
    $sql = "SELECT * FROM Q01_MProduct WHERE IsActive=1 AND IsDelivery=1 AND IsDelete='X' ORDER BY IDCust DESC";
    $DB=$this->app_model->dbQuery($sql);
    $data['MListProduct']=$DB->result();
    $this->load->view('SuratJalanWH/master_list',$data); 
 }  
 
 function MasterList2()
 {
    //$DB=$this->Ict_in_TR_model->MasterList();
    $sql = "SELECT * FROM Q01_MProduct WHERE IsDelivery=1 AND IsActive=1 AND IsDelete='X' ORDER BY IDCust DESC";
    $DB = $this->app_model->dbQuery($sql);
    $data['MListProduct']=$DB->result();
    $this->load->view('SuratJalanWH/master_list2',$data); 
 } 
 
 function simpan()
 {
    $warning = "";
    $status = 0;
    $data = $this->input->post();
        
    $Itemdetail = $data['list_d'];
    
    $head['TypeID'] = $this->TypeID;
    $head['DocNum'] = $data['DocNum'];
    $head['DocNumDetail'] = $data['Rev'];
    //$head['PONum'] = $data['PONum'];
    $head['PartnerID'] = $data['PartnerID'];
    $head['DlvAddress'] = $data['DlvAddress'];
    $head['DocDate'] = date('Y-m-d',strtotime($data['DocDate']));
    //$head['DNRef'] = $data['DNRef'];
    $head['ReleaseDate'] = date('Y-m-d',strtotime($data['ReleaseDate']));
    $head['ShipDate'] = date('Y-m-d',strtotime($data['ShipDate']));
    //$head['ShipCycle'] = $data['ShipCycle'];
    $head['ShipTime'] = $data['ShipTime'];
    //$head['PickupDate'] = date('Y-m-d',strtotime($data['PickupDate']));
    //$head['PickupCycle'] = $data['PickupCycle'];
    //$head['PickupTime'] = $data['PickupTime'];
    //$head['ShipperID'] = $data['ShipperID'];
    $head['DriverName'] = $data['DriverName'];
    $head['CarNum'] = $data['CarNum'];
    $head['SectionHead'] = $data['SectionHead'];
    $head['Remark'] = $data['Remark'];
    $head['CreateBy'] = $this->session->userdata('SysID');
    $head['CreateDate'] = date('Y-m-d');
    $head['CreateTime'] = date('H:i:s');
    
    
    //die();
    $cek = $this->app_model->dbQuery("SELECT * FROM TH_SuratJalan WHERE DocNum LIKE '".$data['DocNum']."'");
    $ok = false;
    
    if($cek->num_rows() < 1)
    {
        $currval = $this->app_model->db_get_one("SELECT NEXT VALUE FOR TH_SuratJalan_Seq as regid");
        $head['RegID'] = $RegID = $currval;
        $ok = $this->app_model->insertData("TH_SuratJalan",$head);
    
        if($ok)
        {           
            $status = 1;
            $warning = "Sukses";
            foreach($Itemdetail as $row)
            {
                $detail['TH_RegID'] = $currval;
                $detail['ItemID'] = $row;
                $detail['JobNumber'] = $data['JobNumber'][$row];
                $detail['OrderReference'] = $data['OrderReference'][$row];
                $detail['Quantity'] = $data['Quantity'][$row];
                $detail['IDUnit'] = $data['IDUnit'][$row];
                $detail['IsDelete'] = '0';
                $ok2 = $this->app_model->insertData("TD_SuratJalan",$detail);
                if($ok2)
                {
                    $this->app_model->updateData("M_Product",array('IDUnit'=>$detail['IDUnit']),array('RegID'=>$row));
                }
                else
                {
                    $warning = "Simpan gagal (a)";
                    break;
                }
            }            
        }
        else 
        {
            $warning = "Simpan gagal (b)";
        }        
    }
    else
    {
        //update
        //unset($head['RegID']);
        $RegID = $data['TH_RegID'];
        $date = date('Y-m-d');
        $time = date('H:i:s');
        $userid = $this->session->userdata('SysID');
        
        $ok = $this->app_model->updateData("TH_SuratJalan",$head,array('RegID'=>$RegID));
        
        //echo"<pre>";
        //print_r($this->db->last_query());
        //print_r($head);
        //echo"</pre>";

        $sql = "--INSERT INTO TD_SuratJalan_Backup (TD_RegID,TH_RegID,ItemID,JobNumber,OrderReference,Quantity,IDUnit,IsDelete,UpdateDate,UpdateTime,UpdateID)
                SELECT RegID as TD_RegID,TH_RegID,ItemID,JobNumber,OrderReference,Quantity,IDUnit,IsDelete,'$date' as UpdateDate,'$time' as UpdateTime,'$userid' as UpdateID
                FROM TD_SuratJalan
                WHERE TH_RegID='$RegID'
                ORDER BY RegID";
        $rs = $this->app_model->dbQuery($sql)->result_array();
        if($ok)
        {
            $status = 2;
            $warning = "Update Sukses";
            foreach($rs as $row)
            {
                $ok2 = $this->app_model->insertData("TD_SuratJalan_Backup",$row);
                if(!$ok2) 
                {
                    $warning = "Update Gagal (c)";
                    break;
                }
                else 
                {
                    $this->app_model->deleteData("TD_SuratJalan",array('RegID'=>$row['TD_RegID']));
                }
            }
            
            //if($ok)
            //{
                //didie besok lanjut
                
                foreach($Itemdetail as $row)
                {
                    $detail['TH_RegID'] = $RegID;
                    $detail['ItemID'] = $row;
                    $detail['JobNumber'] = $data['JobNumber'][$row];
                    $detail['OrderReference'] = $data['OrderReference'][$row];
                    $detail['Quantity'] = $data['Quantity'][$row];
                    $detail['IDUnit'] = $data['IDUnit'][$row];
                    $detail['IsDelete'] = '0';
                    
                    //echo "<pre>";
                    //print_r($detail);
                    //echo "</pre>";
                    $ok3 = $this->app_model->insertData("TD_SuratJalan",$detail);
                    if($ok3)
                    {
                        $this->app_model->updateData("M_Product",array('IDUnit'=>$detail['IDUnit']),array('RegID'=>$row));
                    }
                    else
                    {
                        $warning = "Simpan gagal (d)";
                        break;
                    }
                }                
            //}            
        }
        else
        {
            $warning = "Update Gagal (d)";
        }

        //$ok = $this->app_model->updateData("TH_SuratJalan",$head,array('RegID'=>$RegID));
        
        
    }
    
    $out['warning'] = $warning;
    $out['RegID'] = $RegID;
    $out['status'] = $status;
    $out['CreateBy'] = $this->app_model->db_get_one("SELECT Username FROM M_UserG5 WHERE SysID='".$this->session->userdata('SysID')."'");
    
    //if($ok) echo "Sukses";
    //else echo "Gagal, hubungi ICT"; 
    echo json_encode($out);
 }
 
 function GetData()
 {
    $DocNum = $this->input->post('kode');
    
    $sql = "SELECT b.*,c.PartnerCode,c.PartnerName,c.Address,NULL AS Shipper 
            FROM TH_SuratJalan b
            JOIN T010_Partner c ON c.SysID = b.PartnerID
            WHERE b.DocNum='$DocNum'";
    $data['header'] = $this->app_model->dbQuery($sql)->row();
    $data['header']->DocDate = date('d-m-Y',strtotime($data['header']->DocDate));
    $data['header']->ShipDate = date('d-m-Y',strtotime($data['header']->ShipDate));
    //$data['header']->PickupDate = date('d-m-Y',strtotime($data['header']->PickupDate));
    $data['header']->ReleaseDate = date('d-m-Y',strtotime($data['header']->ReleaseDate));
    $data['header']->UserName = $this->app_model->db_get_one("SELECT UserName FROM M_UserG5 WHERE SysID = '".$data['header']->CreateBy."'");
    
    $this->load->view('SuratJalanWH/HeaderDetail',$data);
 }
 
 function DataDetailMatIn2()
 {
    $id = $this->input->post('kode');
    $from = $this->input->post('from');
    $sql = "SELECT a.*,c.PartNo, c.PartName, e.unit, b.CreateBy AS CreateByID
            FROM TD_SuratJalan a 
            JOIN TH_SuratJalan b ON a.TH_RegID = b.RegID 
            JOIN M_Product c ON c.RegID = a.ItemID
            JOIN M_Unit e ON e.id = a.IDUnit
            WHERE b.DocNum='$id' AND a.IsDelete = '0' 
            ORDER BY a.RegID ASC";
    //echo"<pre>";
    //print_r($sql);
    //echo"</pre>";
    $DB =$this->app_model->dbQuery($sql);
    
    $sql2 = "SELECT b.* FROM TH_SuratJalan b WHERE b.DocNum='$id'";
    $data['list']=$DB->result();
    $data['head']=$this->app_model->dbQuery($sql2)->row();
    $data['from'] = $from;
    $data['b_edit'] = ($data['head']->StatusConfirm == '1') ? '<a class="btn btn-warning disabled" id="BEdit" name="BEdit" href="#tab_content2" data-toggle="tab" aria-expanded="false">' : '<a class="btn btn-warning" id="BEdit" name="BEdit" href="#tab_content2" data-toggle="tab" aria-expanded="false">';    
    
    $this->load->view('SuratJalanWH/DetailMatIn2',$data);
 }
 
 function GetData2()
 {
    $RegID = $this->input->post('RegID');
    $sql = "SELECT a.*,c.PartNo, c.PartName, e.unit, b.CreateBy AS CreateByID
            FROM TD_SuratJalan a 
            JOIN TH_SuratJalan b ON a.TH_RegID = b.RegID 
            JOIN M_Product c ON c.RegID = a.ItemID
            JOIN M_Unit e ON e.id = a.IDUnit
            WHERE b.RegID='$RegID' AND a.IsDelete = '0' 
            ORDER BY a.RegID ASC";
    $data['list'] = $this->app_model->dbQuery($sql)->result();
    
    $sql2 = "SELECT a.*,b.PartnerName,b.Address FROM TH_SuratJalan a JOIN T010_Partner b ON b.SysID = a.PartnerID WHERE a.RegID='$RegID'";
    $data['head'] = $this->app_model->dbQuery($sql2)->row();
    $data['head']->DocDate = date('d-m-Y',strtotime($data['head']->DocDate));
    $data['head']->ReleaseDate = date('d-m-Y',strtotime($data['head']->ReleaseDate));
    $data['head']->ShipDate = date('d-m-Y',strtotime($data['head']->ShipDate));
    $data['head']->Username = $this->app_model->db_get_one("SELECT UserName FROM M_UserG5 WHERE SysID='".$this->session->userdata('SysID')."'");
    $data['head']->DocNumDetail = sprintf('%03s',intval($data['head']->DocNumDetail)+1);
    
    $sql_p = "SELECT * FROM T010_Partner WHERE IsCustomer = '1' AND ISNULL(PartnerCode,'') <> '' ORDER BY PartnerCode";
    $d['Partner'] = $this->app_model->dbQuery($sql_p)->result();
    $d['PartnerID'] = '';
    $FinalOutput = "";
    $FinalOutput .= $this->load->view('SuratJalanWH/tab_content2',$d, true);
    //$FinalOutput .= $this->load->view('SuratJalan/DetailMatIn2',$data, true);
    $data['Templates'] = $FinalOutput;
    //$this->load->view('SuratJalan/HeaderDetail',$data);
    echo json_encode($data);
 }
 
 function GetAllUnit()
 {
    $DB=$this->app_model->dbQuery("SELECT id,unit FROM M_Unit WHERE IsDelete='X' Order BY id")->result_array();
    echo json_encode($DB);
 }
 
 function PrintList()
 {
    $RegID = $this->uri->segment(3);
    
    
    $sql = "SELECT a.*,b.ItemID,b.OrderReference,b.Quantity,b.IDUnit,c.*,d.*,ISNULL(b.JobNumber,c.PartNo) AS JobNumber
            FROM TH_SuratJalan a 
            JOIN TD_SuratJalan b ON a.RegID = b.TH_RegID 
            JOIN M_Product c ON c.RegID = b.ItemID
            JOIN M_Unit d ON d.id = b.IDUnit
            WHERE a.RegID='$RegID' AND TypeID IN (".$this->STypeID.") AND b.IsDelete = '0'";
    $DB = $this->app_model->dbQuery($sql);
    
    $sql2 = "SELECT a.*,b.*,c.username, NULL as Shipper, e.Dept_Name
            FROM TH_SuratJalan a 
            JOIN T010_Partner b ON b.SysID = a.PartnerID
            JOIN M_UserG5 c ON c.SysID = a.CreateBy
            JOIN M_Department e ON e.id = c.DeptID
            WHERE a.RegID='$RegID' AND TypeID IN (".$this->STypeID.")";
    $DB2 = $this->app_model->dbQuery($sql2);
    
    $d['data']=$DB->result();
    $d['head']=$DB2->row();
    $d['head']->DocDate = date('d-m-Y',strtotime($d['head']->DocDate));
    $d['head']->ShipTime = date('d-m-Y',strtotime($d['head']->ShipDate)).' '.$d['head']->ShipTime;
    $d['num'] = $DB->num_rows();
    
    $sql_qty = "SELECT SUM(a.Quantity) as total FROM TD_SuratJalan a JOIN TH_SuratJalan b ON b.RegID = a.TH_RegID WHERE b.RegID='$RegID' AND a.IsDelete = '0'";
    $d['TotalQty'] = $this->app_model->dbQuery($sql_qty)->row()->total;
    
    $this->load->view('SuratJalanWH/PrintList2',$d);
 }
 
    function ReadReport()
    {
        $tgl1 = date('Y-m-d',strtotime($this->input->post('tgl1')));
        $tgl2 = date('Y-m-d',strtotime($this->input->post('tgl2')));
        $IDCust2 = $this->input->post('IDCust2');
        
        $where = "AND b.DocDate BETWEEN '$tgl1' AND '$tgl2' AND b.TypeID IN (".$this->STypeID.")" ; 
        if(empty($IDCust2))
        {
            
        }
        else
        {
            $where .= " AND c.SysID='$IDCust2'" ;
        }
        
        $text = "SELECT * 
                    FROM 
                    (SELECT b.*,c.PartnerCode,d.UserName as UserConfirm, (SELECT SUM(Quantity) FROM TD_SuratJalan WHERE TH_RegID=b.RegID AND IsDelete='0') as qty
                     FROM TH_SuratJalan b
                     JOIN T010_Partner c ON c.SysID = b.PartnerID
                     LEFT JOIN M_UserG5 d ON d.SysID = b.ConfirmBy
                     WHERE 1=1 
                        $where 
                     ) a";
        $cek = $this->app_model->dbQuery($text);
        $d['list']=$cek->result();
        foreach($d['list'] as $row)
        {
            $row->DocDate = date('d-m-Y',strtotime($row->DocDate));
        }
        $d['tgl1'] = $tgl1;
        $d['tgl2'] = $tgl2;
        $this->load->view('SuratJalanWH/transaction_detail_report',$d);
    }
    
    function ReadReport_old()
    {
        $tgl1 = date('Y-m-d',strtotime($this->input->post('tgl1')));
        $tgl2 = date('Y-m-d',strtotime($this->input->post('tgl2')));
        $ItemID2 = $this->input->post('ItemID2');
        
        $where = "AND b.DocDate BETWEEN '$tgl1' AND '$tgl2' AND b.TypeID IN (".$this->STypeID.")" ; 
        if(empty($ItemID2))
        {
            
        }
        else
        {
            $where .= " AND a.ItemID='$ItemID2'" ;
        }
        
        $text = "SELECT * 
                    FROM 
                    (SELECT a.ItemID, SUM(a.Quantity) AS Quantity, c.PartName, c.PartNo
                     FROM TD_SuratJalan a 
                     JOIN TH_SuratJalan b ON a.TH_RegID = b.RegID
                     JOIN M_Product c ON c.RegID = a.ItemID
                     WHERE a.Quantity <> 0 AND a.IsDelete = 0 
                        $where 
                     GROUP BY a.ItemID, c.PartName, c.PartNo) a
                 ORDER BY a.PartName";
        $cek = $this->app_model->dbQuery($text);
        $d['list']=$cek->result();      
        $d['tgl1'] = $tgl1;
        $d['tgl2'] = $tgl2;        
        $this->load->view('SuratJalanWH/transaction_detail_report',$d);
    }
    
    function GetDetailFakturSJ()
    {
        $RegID = $this->input->post('RegID');
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');
        $sql = "SELECT b.*,c.PartNo, c.PartName,d.code
                FROM TD_SuratJalan b
                JOIN M_Product c ON c.RegID = b.ItemID
                JOIN M_Unit d ON d.id = b.IDUnit
                WHERE b.TH_RegID = '$RegID' AND b.IsDelete = '0' 
                ORDER BY b.RegID";
        $data['list'] = $this->app_model->dbQuery($sql)->result();
        $data['sql'] = $sql;
        foreach($data['list'] as $row)
        {
            //$row->DocDate = date('d-m-Y',strtotime($row->DocDate));
        }
        echo json_encode($data); 
    }
    
    function GetDocNumReport()
    {
        $DocNum = $this->input->post('DocNum');
        $sql = "SELECT a.*, b.PartnerCode, c.UserName, (SELECT COUNT(*) FROM TD_SuratJalan WHERE IsDelete = '0' AND TH_RegID = a.RegID) AS Total
                FROM TH_SuratJalan a
                JOIN T010_Partner b ON b.SysID = a.PartnerID 
                JOIN M_UserG5 c ON c.SysID = a.CreateBy
                WHERE a.DocNum LIKE '%$DocNum%'
                    AND TypeID IN (".$this->STypeID.")
                ORDER BY a.DocDate DESC, a.RegID DESC";
        $DB = $this->app_model->dbQuery($sql);
        $data['list'] = $DB->result();
        foreach($data['list'] as $row)
        {
            $row->DocDate = date('d-m-Y',strtotime($row->DocDate));
        }
        //echo json_encode($data['list']);
        //echo"<pre>";
        //print_r($data);
        //echo"</pre>";
        $this->load->view('SuratJalanWH/SearchDocNumReport',$data);
    }
    
    function PrintListReport()
     {
        $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
        $tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
        $IDCust2 = $this->uri->segment(5);
        $num = 0;
        $where = "AND b.DocDate BETWEEN '$tgl1' AND '$tgl2' AND b.TypeID IN (".$this->STypeID.")" ; 
        if(empty($IDCust2))
        {
            
        }
        else
        {
            $where .= " AND c.SysID='$IDCust2'" ;
        }
        
        $text = "SELECT b.*, c.PartnerCode, d.UserName as ConfirmBy, (SELECT SUM(Quantity) FROM TD_SuratJalan WHERE TH_RegID = b.RegID AND IsDelete='0') as totalqty
                 FROM TH_SuratJalan b
                 JOIN T010_Partner c ON c.SysID = b.PartnerID
                 LEFT JOIN M_UserG5 d ON d.SysID = b.ConfirmBy
                 WHERE 1=1 $where";
                 
        $cek = $this->app_model->dbQuery($text);
        $data['list'] = $cek->result_array();
        $num = $cek->num_rows();
        foreach($data['list'] as $row => $val)
        {
            $sql = "SELECT a.*, c.code, b.PartName
                    FROM TD_SuratJalan a
                    JOIN M_Product b ON b.RegID = a.ItemID
                    JOIN M_Unit c ON c.id = a.IDUnit
                    WHERE a.TH_RegID IN
                    (".$val['RegID'].")
                    ORDER BY a.RegID";
       
            $rs = $this->app_model->dbQuery($sql);
            $d['data'][$row]['DocNum'] = $val['DocNum'];
            $d['data'][$row]['PartnerCode'] = $val['PartnerCode'];
            $d['data'][$row]['DocDate'] = $val['DocDate'];
            $d['data'][$row]['StatusConfirm'] = $val['StatusConfirm'];
            $d['data'][$row]['ConfirmBy'] = $val['ConfirmBy'];
            $d['data'][$row]['totalqty'] = $val['totalqty'];
            $d['data'][$row]['detail'] = $rs->result_array();
            $num += $rs->num_rows();
            //$data['list']['detail'] = $rs;
        }
        
        //echo"<pre>";
        //print_r($d);
        //echo"</pre>";
        $d['num'] = $num;
        
        $this->load->view('SuratJalanWH/PrintListReport',$d);
     }
     
     function ExportReport()
     {
        $RegID = $this->uri->segment(3);
    
    
        $sql = "SELECT a.*,b.ItemID,b.OrderReference,b.Quantity,b.IDUnit,c.*,d.*,ISNULL(b.JobNumber,c.PartNo) AS JobNumber
                FROM TH_SuratJalan a 
                JOIN TD_SuratJalan b ON a.RegID = b.TH_RegID 
                JOIN M_Product c ON c.RegID = b.ItemID
                JOIN M_Unit d ON d.id = b.IDUnit
                WHERE a.RegID='$RegID' AND TypeID IN (".$this->STypeID.") AND b.IsDelete = '0'";
        $DB = $this->app_model->dbQuery($sql);
        
        $sql2 = "SELECT a.*,b.*,c.username, NULL as Shipper, e.Dept_Name
                FROM TH_SuratJalan a 
                JOIN T010_Partner b ON b.SysID = a.PartnerID
                JOIN M_UserG5 c ON c.SysID = a.CreateBy
                JOIN M_Department e ON e.id = c.DeptID
                WHERE a.RegID='$RegID' AND TypeID IN (".$this->STypeID.")";
        $DB2 = $this->app_model->dbQuery($sql2);
        
        $d['data']=$DB->result();
        $d['head']=$DB2->row();
        $d['head']->DocDate = date('d-m-Y',strtotime($d['head']->DocDate));
        $d['head']->ShipTime = date('d-m-Y',strtotime($d['head']->ShipDate)).' '.$d['head']->ShipTime;
        $d['num'] = $DB->num_rows();
        
        $sql_qty = "SELECT SUM(a.Quantity) as total FROM TD_SuratJalan a JOIN TH_SuratJalan b ON b.RegID = a.TH_RegID WHERE b.RegID='$RegID' AND a.IsDelete = '0'";
        $d['TotalQty'] = $this->app_model->dbQuery($sql_qty)->row()->total;
        $this->load->view('SuratJalanWH/ExportListReport',$d); 
     }

    public function SendMailSuratJalan()
    {
        $RegID = $this->input->post('RegID');
        $status = $this->input->post('status');
        $CreateBy = $this->input->post('CreateBy');
        
        require 'PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;
        
        $mail->isSMTP(); 
        $mail->Host = 'mail.summitadyawinsa.co.id'; 
        $mail->SMTPAuth = true; 
        $mail->Username = 'support@summitadyawinsa.co.id'; 
        $mail->Password = 'GoL14th572'; 
        $mail->SMTPSecure = 'ssl'; 
        $mail->Port = 465 ; 
        
        $recipients = array(
            //'support@summitadyawinsa.co.id' => 'ICT Support',
            //'marketing-group@summitadyawinsa.co.id' => 'Marketing Group'
            'erfin.gustaman@summitadyawinsa.co.id' => 'Tes'
        );
        
        //$RegID = $this->input->post('RegID');
        //$DocNum = $this->app_model->db_get_one("SELECT DocNum FROM TH_SuratJalan WHERE RegID='$RegID'");
        //$DocDate = date('d-m-Y',strtotime($this->app_model->db_get_one("SELECT ConfirmDate FROM TH_SuratJalan WHERE RegID='$RegID'")));
        //$DocDate = $this->input->post('id');
        //$DocDate_sql = $this->app_model->tgl_sql($this->input->post('id'));
        //$mail->setFrom('aji.sanjaya@summitadyawinsa.co.id', 'Confirm SuratJalan General');
        $mail->setFrom('erfin.gustaman@summitadyawinsa.co.id', 'Surat Jalan General');
        //$mail->addAddress('anton@summitadyawinsa.co.id@summitadyawinsa.co.id', 'SuratJalan WareHouse');
        $mail->addAddress('erfin.gustaman@summitadyawinsa.co.id', 'Surat Jalan WareHouse');
        
        foreach($recipients as $email => $name)
        {
            $mail->AddCC($email, $name); 
        }
        
        $mail->isHTML(true);
        
        $bodyContent = ($status == 1) ? "Surat Jalan General Baru Telah di Buat oleh User:".$CreateBy."<hr>" : "Revisi Surat Jalan General oleh User:".$CreateBy."<hr>";
        $bodyContent .= '&nbsp;<a style="color: rgb(255, 255, 255); text-decoration: none; display: inline-block; margin-bottom: 0px; vertical-align: middle; cursor: pointer; padding: 7px 17px; line-height: 20px; font-size: 13px; font-weight: 600; text-align: center; white-space: nowrap; border-radius: 2px; background-color: rgb(17, 177, 10);" href="'.site_url().'/ref_mail/confirm_surat_jalan/'.$RegID.'" target="_blank">confirm</a><br><br>';
        $bodyContent .= $this->contentEmail($RegID);
        
        $mail->Subject = ($status == 1) ? 'Surat Jalan General' : 'Revisi Surat Jalan General';
        $mail->Body    = $bodyContent;
        //$mail->msgHTML(file_get_contents($bodyContent), dirname(__FILE__));
        
        if(!$mail->send()) 
        {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } 
        else
        { 
            echo 'Send Success !';
        }
    }
    
    public function contentEmail($RegID)
    {
        $sql = "SELECT a.*,b.ItemID,b.OrderReference,b.Quantity,b.IDUnit,c.*,d.*,ISNULL(b.JobNumber,c.PartNo) AS JobNumber
                FROM TH_SuratJalan a 
                JOIN TD_SuratJalan b ON a.RegID = b.TH_RegID 
                JOIN M_Product c ON c.RegID = b.ItemID
                JOIN M_Unit d ON d.id = b.IDUnit
                WHERE a.RegID='$RegID' AND b.IsDelete = '0'";
        $DB = $this->app_model->dbQuery($sql);
        
        $sql2 = "SELECT a.*,b.*,c.username, NULL as Shipper, e.Dept_Name
                 FROM TH_SuratJalan a
                 JOIN T010_Partner b ON b.SysID = a.PartnerID
                 JOIN M_UserG5 c ON c.SysID = a.CreateBy
                 JOIN M_Department e ON e.id = c.DeptID
                 WHERE a.RegID='$RegID'";
        $DB2 = $this->app_model->dbQuery($sql2);
        
        $d['data']=$DB->result();
        $d['head']=$DB2->row();
        $d['head']->DocDate = date('d-m-Y',strtotime($d['head']->DocDate));
        $d['head']->ShipTime = date('d-m-Y',strtotime($d['head']->ShipDate)).' '.$d['head']->ShipTime;
        $d['num'] = $DB->num_rows();
        
        $sql_qty = "SELECT SUM(a.Quantity) as total FROM TD_SuratJalan a JOIN TH_SuratJalan b ON b.RegID = a.TH_RegID WHERE b.RegID='$RegID' AND a.IsDelete = '0'";
        $d['TotalQty'] = $this->app_model->dbQuery($sql_qty)->row()->total;
        $d['RegID'] = $RegID;
        $d['IsConfirm'] = $this->app_model->db_get_one("SELECT IsConfirm FROM TH_SuratJalan WHERE RegID='$RegID'");
        $layout = $this->load->view('SuratJalanWH/PrintListNewEmail',$d,true);
        return $layout;
    }
 
} 