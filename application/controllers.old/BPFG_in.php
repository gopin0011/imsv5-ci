<?php
class BPFG_in extends CI_Controller{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('BPFG_in_model','app_model'));
 
        $this->load->library(array('form_validation','template'));
        $cek = $this->session->userdata('TrcBPFG')=='1';
        if(!$this->session->userdata('username')){ redirect('welcome');  } 
        elseif(empty($cek)){ redirect('welcome'); }
        
        date_default_timezone_set('Asia/Jakarta');
    }
    
    /**{{}}**/
    function index()
    {
        $d['title']="Home";
        $text5 = "SELECT * FROM M_QCCheck WITH (NOLOCK) WHERE Category LIKE '%STP%' ";
        $d['M_QCCheck'] = $this->app_model->manualQuery($text5);
        $MasterList=$this->BPFG_in_model->MasterList();
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
        $this->template->display('BPFG_in/index',$d);
    }
    /**{{}}**/
    
    function TransactionList()
    {
        $DB=$this->BPFG_in_model->transaction_list();
        $data['list']=$DB->result();
        foreach($data['list'] as $row => $v)
        {
            $v->DocDate = date('d-m-Y',strtotime($v->DocDate));
            //echo"<pre>";
            //print_r($v);
            //echo"</pre>";
        }
        $this->load->view('BPFG_in/TransactionList',$data);
    }
    /**{{}}**/
    
    function TransactionListProductionIn()
    {
        //$DB=$this->BPFG_in_model->transaction_list_warehouseIn();
        //$data['list']=$DB->result();
        $limit = 50;
        $offset = 0;
        $sql = "SELECT a.*, dbo.fn_newDocNum(a.RegID) as NewDocNum
                FROM QTH_RawMaterial a 
                WHERE a.IDTrcType=600 AND dbo.fn_row_detail_bpfg(a.RegID) > 0 
                ORDER BY RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY";
        //echo"<pre>";
        //print_r($sql);
        //echo"</pre>";
        
        $data['list']=$this->app_model->dbQuery($sql)->result();
        $this->load->view('BPFG_in/list_warehousein',$data);
    }
    /**{{}}**/    
    
    function DetailTrc()
    {
        $RegID = $this->input->post('RegID');
        $DocNum = $this->input->post('kode');
        //$DB=$this->BPFG_in_model->transaction_list_d_warehouseIn($RegID);
        
        $sql = "SELECT bb.ItemID,bb.RegID,bb.PartNo,bb.PartName,bb.Code,(bb.QtyMat-ISNULL(aa.QtyMat,0)) as QtyMat, bb.Remark
                FROM
                	(SELECT SUM(b.QtyMat) AS QtyMat,b.TD_RawMaterial
                                    FROM	TH_Trans a 
                                    LEFT JOIN TD_Transdetail b ON a.RegID=b.TH_RegID 
                                    WHERE CASE WHEN b.isDelete = 1 THEN 'True' ELSE 'False' END = 'False'
                					GROUP BY b.TD_RawMaterial
                    ) aa
                RIGHT JOIN 
                    (
                        SELECT b.* 
                        FROM QTH_RawMaterial a 
                        LEFT JOIN QTD_RawMaterial b ON a.DocNum=b.DocNum 
                        WHERE a.IDTrcType=600 AND a.RegID = '$RegID' 
                    ) bb ON bb.RegID = aa.TD_RawMaterial
                WHERE (CASE WHEN aa.QtyMat IS NULL THEN 'true'
							WHEN aa.QtyMat < bb.QtyMat THEN 'true'
							ELSE 'false' END ) = 'true'";
    
        $data['list']=$this->app_model->dbQuery($sql)->result();
        $data['head'] = $this->InfoTambahFormTRMatIn($RegID,$DocNum);
        $data['RegID'] = $RegID;
        //$data['NewDocNum'] = $this->InfoTambahFormTRMatIn($DocNum)['DocNum'];
        //$data['NewDocNumDetail'] = $this->InfoTambahFormTRMatIn($DocNum)['DocNumDetail'];
        //echo"<pre>";
        //print_r($data);
        //echo"</pre>";
        $this->load->view('BPFG_in/DetailTrc',$data);
        //echo json_encode($data);
    }
    /**{{}}**/ 
    
    public function InfoTambahFormTRMatIn($RegID,$id){ 
        //$RegID = $this->input->post('RegID');
        //$id = $this->input->post('kode');
        if(empty($id)){
            $DocNumDetail = '001'   ; 
            $DocNum = $this->app_model->DocNumMaterialBPFGINOther();
        }else{
            $DocNumDetail = $this->app_model->DocNumDetailBPFGIN($id);
            //$id = $this->input->post('kode');  
            $DocNum = $id;
        }
        //Time SERVER,
        	    
        $CreateDate = date('d-m-Y');
        $DocDate = date('d-m-Y');
        $CreateDateSQL = date('Y-m-d');
        $CreateTime = date ("H:i:s") ;
        $data['DocNumDetail'] = $DocNumDetail ; 
        $data['DocNum'] = $DocNum ;
        $data['CreateDate']	= $CreateDate ;
        $data['DocDate']	    = $DocDate ;
        $data['CreateTime']	= $CreateTime ;
        
        $data['ShiftID'] = $this->app_model->db_get_one("SELECT b.ShiftID FROM TH_RawMaterial b WHERE b.RegID='".$RegID."'");
        $data['Shift'] = $this->app_model->db_get_one("SELECT a.Shift FROM TH_RawMaterial b JOIN M_Shift2 a ON a.SysID = b.ShiftID WHERE b.RegID='".$RegID."'");
        
        
        //echo json_encode($data);
        //Time SERVER,
        	
        $CreateDate	            = date('d-m-Y');
        $DocDate	            = date('d-m-Y');
        $CreateDateSQL	        = date('Y-m-d');
        $CreateTime	            = date ("H:i:s") ;
        if(empty($id))
        {
            $up['DocNum'] = $this->app_model->DocNumMaterialBPFGINOther() ;
            $up['CreateDate'] = $CreateDateSQL ;
            $up['DocDate'] = $CreateDateSQL ;
            $up['CreateBy'] = $this->session->userdata('RegID');
            $up['CreateTime'] = $CreateTime ;
            $id['DocNum'] = $this->app_model->DocNumMaterialBPFGINOther();
            $id['CreateBy'] = $this->session->userdata('RegID');
            $data2 = $this->app_model->getSelectedData("G_DocNumMat",$id);
            if($data2->num_rows()>0){
            }else{
                $this->app_model->insertData("G_DocNumMat",$up);
            }   
        }
        
        //$RegID = $this->input->post('RegID');
        $sql = "SELECT a.*,b.nama_lengkap,b.area,b.RegID as id FROM QTH_RawMaterial a JOIN M_User b ON b.RegID = a.CreateByID  WHERE a.RegID='".$RegID."'";
        $q = $this->app_model->dbQuery($sql)->row();
        $data['diserahkan'] = array($q->id,$q->nama_lengkap,$q->area);
        
        $byID = $this->session->userdata('RegID');
        $sql = "SELECT b.nama_lengkap,b.area,b.RegID as id FROM M_User b WHERE b.RegID='".$byID."'";
        $q = $this->app_model->dbQuery($sql)->row();
        $data['diterima'] = array($q->id,$q->nama_lengkap,$q->area);
        
        return $data;
    }
    /**{{}}**/
    
    function MasterListPic()
    {
        $DB=$this->BPFG_in_model->MasterListPic();
        $data['type'] = $this->input->post('type');
        $data['MListProduct']=$DB->result();
        $this->load->view('BPFG_in/master_list_pic',$data);
    }
    /**{{}}**/ 
    
    function Save()
    {
        $data = $this->input->post();        
        
        $th['from_area'] = $data['FromArea'];
        $th['to_area'] = $data['ToArea'];
        $th['DocDate'] = date('Y-m-d',strtotime($data['DocDate']));
        $th['pic_from'] = $data['picFrom']; 
        $th['pic_to'] = $data['picTo'];
        $th['DocNum'] = $data['DocNum'];
        $th['DocNumDetail'] = $data['DocNumDetail'];
        $th['TH_RawMaterialID'] = $data['TH_RawMaterialID'];
        //$th['trans_date'] = $data['DocDate'];
        $th['create_date'] = date('Y-m-d');
        $th['create_time'] = date ("H:i:s");
        $th['create_id'] = $this->session->userdata('RegID');
        $th['RegID'] = $this->app_model->dbQuery('SELECT NEXT VALUE FOR TH_Trans_Seq as regid')->row()->regid;
        $th['IDTrcType'] = '2211';
        $th['ShiftID'] = $data['ShiftID'];
        //echo"<pre>";
        //print_r($th);
        //echo"</pre>";
        //die();
        $ok = $this->app_model->insertData("TH_Trans",$th);
        
        if($ok)
        {
            foreach($data['dbRegId'] as $key => $v)
            {
                //echo"<pre>";
                //print_r($data['QtyMat'][$v]);
                //echo"</pre>";
                $td['QtyMat'] = $data['QtyMat'][$v];
                $td['ket'] = $data['ket'][$v];
                $td['TD_RawMaterial'] = $v;
                $td['trans_date'] = date('Y-m-d',strtotime($data['DocDate']));
                $td['create_date'] = date('Y-m-d');
                $td['create_time'] = date ("H:i:s");
                $td['TH_RegID'] = $th['RegID'];
                $td['ItemID'] = $data['ItemID'][$v];
                $td['create_id'] = $this->session->userdata('RegID');
                $td['DocNum'] = $data['DocNum'];
                $td['DocNumDetail'] = $data['DocNumDetail'];
                
                if($data['QtyMat'][$v]>0)
                {
                    $ok2 = $this->app_model->insertData("TD_Transdetail",$td);
                    if(!$ok2) break;
                }
            }
        }
        else
        {
            echo "Simpan Gagal";
        }
        if($ok2)
        {
            echo "Simpan Sukses";
        }
        else
        {
            echo "Simpan Gagal";
        }
    }
    /**{{}}**/
    
    function get_header($RegID)
    {
        
        $RegID = $this->input->post('RegID');
        $sql = "SELECT a.*,b.nama_lengkap,b.area,b.RegID as id FROM QTH_RawMaterial a JOIN M_User b ON b.RegID = a.CreateByID  WHERE a.RegID='".$RegID."'";
        $q = $this->app_model->dbQuery($sql)->row();
        $data['diserahkan'] = array($q->id,$q->nama_lengkap,$q->area);
        
        $byID = $this->session->userdata('RegID');
        $sql = "SELECT b.nama_lengkap,b.area,b.RegID as id FROM M_User b WHERE b.RegID='".$byID."'";
        $q = $this->app_model->dbQuery($sql)->row();
        $data['diterima'] = array($q->id,$q->nama_lengkap,$q->area);
        //return $data;
        echo json_encode($data);
    }
    
    function List_d_old()
    {
        $RegID = $this->input->post('RegID');
        $sql = "SELECT a.*,b.PartNo, b.PartName, b.IDCust, c.Code
                    FROM TD_Transdetail a
                    JOIN M_Product b ON a.ItemID = b.RegID
                    JOIN M_Customer c ON c.RegID = b.IDCust
                    WHERE a.TH_RegID='".$RegID."'
                    ORDER BY a.RegID";
        $data['list'] = $this->app_model->dbQuery($sql)->result();
        $this->load->view('BPFG_in/List_d',$data);
    }
    
    function List_d()
    {
        $DocNum = $this->input->post('DocNum');
        $RegID = $this->input->post('RegID');
        $sql = "SELECT a.*
                FROM TH_Trans a
                WHERE a.RegID LIKE '".$RegID."'
                ORDER BY a.RegID Desc";
        $data['list'] = $this->app_model->dbQuery($sql)->result();
        
        foreach($data['list'] as $v)
        {
            $sql2 = "SELECT a.*,b.PartNo, b.PartName, b.IDCust, c.Code, d.DocNum as Raw_DocNum
                    FROM TD_Transdetail a
                    JOIN TD_RawMaterial d ON d.RegID = a.TD_RawMaterial
                    JOIN M_Product b ON a.ItemID = b.RegID
                    JOIN M_Customer c ON c.RegID = b.IDCust
                    WHERE a.TH_RegID='".$v->RegID."'
                        AND CASE WHEN a.isDelete = 1 THEN 'True' ELSE 'False' END = 'False'
                    ORDER BY a.RegID";
                 
            $isi['list'][$v->RegID] = array($v->DocNum,$v->DocNumDetail,'data'=>$this->app_model->dbQuery($sql2)->result());
        }
        $isi['RegID'] = $RegID;
        $isi['DocNum'] = $DocNum;
        //echo json_encode($isi);
        //echo"<pre>";
        //print_r($isi);
        //echo"</pre>";
        $this->load->view('BPFG_in/List_d',$isi);
    }
    /**{{}}**/
    
    function get_header_trans()
    {
        
        $RegID = $this->input->post('RegID');
        $sql = "SELECT a.*,b.nama_lengkap,a.from_area as area, a.to_area,b.RegID as id FROM TH_Trans a JOIN M_User b ON b.RegID = a.create_id WHERE a.RegID='".$RegID."'";
        $q = $this->app_model->dbQuery($sql)->row();
        $data['DocNum'] = $q->DocNum;
        $data['DocDate'] = $this->app_model->tgl_str($q->DocDate);
        $data['DocNumDetail'] = $q->DocNumDetail;
        $data['diserahkan'] = array($q->id,$q->nama_lengkap,$q->area);
        $to_area = $q->to_area;
        $byID = $this->session->userdata('RegID');
        $sql = "SELECT b.nama_lengkap,b.area,b.RegID as id FROM M_User b WHERE b.RegID='".$byID."'";
        $q = $this->app_model->dbQuery($sql)->row();
        $data['diterima'] = array($q->id,$q->nama_lengkap,$to_area);
        
        $data['ShiftID'] = $this->app_model->db_get_one("SELECT ShiftID FROM TH_Trans WHERE RegID='$RegID'");
        $data['Shift'] = $this->app_model->db_get_one("SELECT b.Shift FROM TH_Trans a LEFT JOIN M_Shift2 b ON b.SysID = a.ShiftID WHERE RegID='$RegID'");
        echo json_encode($data);
    }
    /**{{}}**/
    
    function hapus_trans_detail()
    {
        $RegID = $this->input->post('RegID');
        $ok = $this->app_model->updateData("TD_Transdetail",array('IsDelete'=>1),array('RegID'=>$RegID));
        if($ok)
        {
            echo "Delete Sukses";
        } 
        else 
        {
            echo "Delete gagal, hubungi ICT";
        }
    }
    
    function update_detail()
    {
        $RegID = $this->input->post('RegID');
        $data['QtyMat'] = $this->input->post('QtyMat');
        $data['ket'] = $this->input->post('Ket');
        $ok = $this->app_model->updateData("TD_Transdetail",$data,array('RegID'=>$RegID));
        if($ok)
        {
            echo "Data Terupdate";
        }
        else
        {
            echo "Gagal Update, hubungi ICT";
        }
    }
    
    function ExportReport()
    {
        $RegID = $this->uri->segment(3);
        //$DocNum = $this->app_model->db_get_one("SELECT DocNum FROM TH_Trans WHERE RegID='$RegID'");
        //$RegID = $this->input->post('RegID');
        $sql = "SELECT a.*
                FROM TH_Trans a
                WHERE a.RegID LIKE '".$RegID."'
                ORDER BY a.RegID Desc";
        $data['list'] = $this->app_model->dbQuery($sql)->result();
        
        foreach($data['list'] as $v)
        {
            $sql2 = "SELECT a.*,b.PartNo, b.PartName, b.IDCust, c.Code, d.DocNum as Raw_DocNum
                    FROM TD_Transdetail a
                    JOIN TD_RawMaterial d ON d.RegID = a.TD_RawMaterial
                    JOIN M_Product b ON a.ItemID = b.RegID
                    JOIN M_Customer c ON c.RegID = b.IDCust
                    WHERE a.TH_RegID='".$v->RegID."'
                        AND CASE WHEN a.isDelete = 1 THEN 'True' ELSE 'False' END = 'False'
                    ORDER BY a.RegID";
            $isi['list'][$v->RegID] = array($v->DocNum,$v->DocNumDetail,'data'=>$this->app_model->dbQuery($sql2)->result());
        }
        $isi['RegID'] = $RegID;
        //$isi['DocNum'] = $DocNum;
        
        $sql = "SELECT a.*,b.nama_lengkap,b.area,b.RegID as id_from,c.nama_lengkap as nama_lengkap_to,c.area as area_to,c.RegID as id_to, d.Shift
                FROM TH_Trans a 
                JOIN M_User b ON b.RegID = a.pic_from 
                JOIN M_User c ON c.RegID = a.pic_to 
                JOIN M_Shift2 d ON d.SysID = a.ShiftID
                WHERE a.RegID='".$RegID."'";
        $q = $this->app_model->dbQuery($sql)->row();
        $isi['diserahkan'] = array($q->id_from,$q->nama_lengkap,$q->area);
        $isi['diterima'] = array($q->id_to,$q->nama_lengkap_to,$q->area_to);
        $isi['shift'] = $q->Shift;
        $isi['DocDate'] = date('d-m-Y',strtotime($q->DocDate));
        $isi['DocNumDetail'] = $q->DocNumDetail;
        $isi['DocNum'] = $q->DocNum;
        //echo json_encode($isi);
        //echo"<pre>";
        //print_r($isi);
        //echo"</pre>";
        $this->load->view('BPFG_in/ExportListReport',$isi); 
    }
    
    function ReportBPFG()
    {
        $tgl1 = date('Y-m-d',strtotime($this->input->post('tgl1')));
        $tgl2 = date('Y-m-d',strtotime($this->input->post('tgl2')));
        $IDCust = $this->input->post('IDCust');
        $PartNo2 = $this->input->post('PartNo2');        
        
        $where = ($IDCust != 'semua') ? " AND c.IDCust = '".$IDCust."'" : '';
        $where .= ($PartNo2!='') ? " AND c.PartNo LIKE '%".$PartNo2."%'" : ''; 
        $where .= " AND a.DocDate BETWEEN '".$tgl1."' AND '".$tgl2."' ";
        $sql = "SELECT SUM(b.QtyMat) as total, c.PartNo, c.PartName, e.Code
                FROM TH_Trans a
                JOIN TD_Transdetail b ON b.TH_RegID = a.RegID
                JOIN M_Product c ON c.RegID = b.ItemID
                JOIN TD_RawMaterial d ON d.RegID = b.TD_RawMaterial
                JOIN M_Customer e ON e.RegID = c.IDCust
                WHERE CASE WHEN b.IsDelete = 1 THEN 'True' ELSE 'False' END = 'False'
                    AND a.IDTrcType = '2211'
                    ".$where." 
                GROUP BY c.PartNo, c.PartName, e.Code";
        $data['list'] = $this->app_model->dbQuery($sql)->result();
		$this->load->view('BPFG_in/bpfg_report',$data);
    }
    
    function PrintList2()
    {
        $tgl1 = $this->app_model->tgl_sql($this->uri->segment(3));
		$tgl2 = $this->app_model->tgl_sql($this->uri->segment(4));
		$IDCust = $this->uri->segment(5);
		$PartNo2 = $this->uri->segment(6);
		
		$where = ($IDCust != 'semua') ? " AND c.IDCust = '".$IDCust."'" : '';
        $where .= ($PartNo2!='') ? " AND c.PartNo LIKE '%".$PartNo2."%'" : ''; 
        $where .= " AND a.DocDate BETWEEN '".$tgl1."' AND '".$tgl2."' ";
		
        $sql = "SELECT SUM(b.QtyMat) as total, c.PartNo, c.PartName, e.Code, e.CustName
                FROM TH_Trans a
                JOIN TD_Transdetail b ON b.TH_RegID = a.RegID
                JOIN M_Product c ON c.RegID = b.ItemID
                JOIN TD_RawMaterial d ON d.RegID = b.TD_RawMaterial
                JOIN M_Customer e ON e.RegID = c.IDCust
                WHERE CASE WHEN b.IsDelete = 1 THEN 'True' ELSE 'False' END = 'False'
                    AND a.IDTrcType = '2211'
                    ".$where." 
                GROUP BY c.PartNo, c.PartName, e.Code, e.CustName";
		$rs = $this->app_model->dbQuery($sql);
		$d['list'] = $rs->result();
		$d['num'] = $rs->num_rows(); 
		$this->load->view('BPFG_in/PrintList2',$d);
    }
}    