<?php
class MasterBom extends CI_Controller{
function __construct(){
 parent::__construct();
 $this->load->model(array('MasterBom_model','app_model'));
 $this->load->library(array('form_validation','template'));
 $cek = $this->Role_Model->MBom();
 if(!$this->session->userdata('UserName')){ redirect('welcome');  } 
 elseif(empty($cek)){ redirect('welcome'); }}


    
function index(){
$d['title']="Home";
//$text = "SELECT * FROM Master_BOM ORDER BY IDCust DESC" ;
//$d['MListStamping'] = $this->app_model->manualQuery($text);
$text2 = "SELECT * FROM M_Customer ORDER BY Code ASC";
$d['l_MCust'] = $this->app_model->manualQuery($text2);
$text3 = "SELECT * FROM M_Project ORDER BY ProjectName DESC";
$d['l_MProject'] = $this->app_model->manualQuery($text3);
$text4 = "SELECT * FROM M_MaterialType ";
$d['MaterialTypeList'] = $this->app_model->manualQuery($text4);
$text5 = "SELECT * FROM Q01_MProduct WHERE IsMaterial=1 AND IsActive='1' ORDER BY IDCust DESC" ;
$d['MListMaterial'] = $this->app_model->manualQuery($text5);
$text6 = "SELECT * FROM M_DetailStatus ORDER BY RegID DESC" ;
$d['l_MDetailStatus'] = $this->app_model->manualQuery($text6);
$text7 = "SELECT * FROM BOM6 WHERE PartType NOT LIKE '%FG%' AND PartType NOT LIKE '%RM%' ORDER BY SysID ASC" ;
$d['PartType2'] = $this->app_model->manualQuery($text7);
$text13 = "SELECT * FROM BOM6 WHERE PartType NOT LIKE '%FG%' AND PartType NOT LIKE '%RM%' ORDER BY SysID ASC" ;
$d['PartType'] = $this->app_model->manualQuery($text13);
$text14 = "SELECT * FROM BOM6 WHERE PartType LIKE '%RM%' ORDER BY SysID ASC" ;
$d['PartTypeRM'] = $this->app_model->manualQuery($text14);
$text15 = "SELECT * FROM BOM6 WHERE PartType NOT LIKE '%FG%' ORDER BY SysID ASC" ;
$d['PartTypeNew'] = $this->app_model->manualQuery($text15);
$text8 = "SELECT * FROM BOM6 WHERE PartType LIKE '%FG%' ORDER BY SysID ASC" ;
$d['PartTypeFg'] = $this->app_model->manualQuery($text8);
$text9 = "SELECT * FROM DetailMachine ORDER BY Line ASC";
$d['Machine'] = $this->app_model->manualQuery($text9);
$text10 = "SELECT * FROM M_Partner ORDER BY id DESC";
$d['MListPartner'] = $this->app_model->manualQuery($text10);

$text11 = "SELECT ItemID, PartNo FROM BOM2 WHERE IsDeleteDetail = 0 AND PartType LIKE 'RM%' ORDER BY PartNo";
$d['ListRM'] = $this->app_model->manualQuery($text11);    

$text12 = "SELECT ItemID, PartNo FROM BOM2 WHERE IsDeleteDetail = 0 AND PartType NOT LIKE 'FG%' ORDER BY PartNo";
$d['M_Parts'] =  $this->app_model->manualQuery($text12);
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');
$DocDate = date('d-m-Y');
$d['DocDateReport_2'] = date('d-m-Y');
$d['DocDateReport_1'] = strtotime('-1 day',strtotime($d['DocDateReport_2']));
$d['DocDateReport_1'] = date('d-m-Y', $d['DocDateReport_1']);
$d['DocDateReport_2'] = $DocDate ;
$this->template->display('MasterBom/index',$d); }

public function SaveEditHead(){
$up['SysID'] = $this->input->post('ItemIDEdit');
$up['PartNo'] = $this->input->post('PartNoEdit');
$up['PartName'] = $this->input->post('PartNameEdit');
$up['IDCust'] = $this->input->post('IDCustEdit');
$up['IDProject'] = $this->input->post('IDProjectEdit');
$up['PackingType'] = $this->input->post('PackingTypeEdit');
$up['StdPack'] = $this->input->post('StdPackEdit');
$up['PartTypeID'] = $this->input->post('PartTypeIDEdit');
$up['FGLocation'] = $this->input->post('FGLocationEdit');
$up['IsActive'] = $this->input->post('IsActiveEdit');
$up['CreateBy'] = $this->session->userdata('RegID');
$up['SupplierID'] = $this->input->post('SupplierIDHeadEdit');
$up['QtyPerCar'] = $this->input->post('QtyPerCarHeadEdit');
$id['SysID'] = $this->input->post('ItemIDEdit');
$data = $this->app_model->getSelectedData("BOM1",$id);
if($data->num_rows()>0){  
$this->app_model->updateData("BOM1",$up,$id);
echo 'Edit Success'; }  }

public function DetailBOM(){
 $kode = $this->input->post('kode');
 $DB = $this->MasterBom_model->DetailBom1($kode);
 $data['data']=$DB->result();
 $data['num'] = $DB->num_rows();

 //$DB2 = $this->MasterBom_model->DetailBom2($kode);
 $sql = "SELECT b.SysID as ItemSys, c.SysID, d.CustName, d.Code, e.ProjectName, a.SysID as SysID2,f.*,g.*, h.*,a.*, i.partner_name
                                       ,(CASE WHEN c.NameType = 1 AND a.IsRHLH = 1 THEN a.PartName+' RH' WHEN c.NameType = 2 AND a.IsRHLH = 1 THEN a.PartName+' LH' ELSE a.PartName END) AS PartName 
                                       ,(CASE WHEN c.NameType = 1 AND a.IsRHLH = 1 THEN a.PartNo2 ELSE a.PartNo END) AS PartNo
                                   FROM BOMBuild b 
                                   JOIN BOM2 a ON a.ItemID = b.ItemID
                                   JOIN BOM1 c ON c.SysID = b.LinkID
                                   LEFT JOIN M_Partner i ON i.id = a.SupplierID 
                                   LEFT JOIN M_Customer d ON d.RegID = c.IDCust
                                   LEFT JOIN M_Project e ON c.IDProject = e.RegID
                                   LEFT JOIN BOM3 f ON f.ItemID = a.ItemID 
                                   LEFT JOIN BOM4 g ON g.ItemID = a.ItemID 
                                   LEFT JOIN BOM5 h ON h.ItemID = a.ItemID
                                   WHERE c.IsDelete = 0 AND a.IsDeleteDetail = 0 AND b.LinkID = '$kode'
                                   ORDER BY b.SysID";
 $sql = "with rel_tree (ItemSys,LinkID,ItemID,ItemParent,PartType,ItemNo,SysID2,PartName,PartNo,num,Images,level,PackingType,StdPack,FGLocation,MaterialType,Spec,Thick,Width,Length,PcsPerSheet,KgPerSheet,PartWeight,SpecOrder1,SpecOrder2)
        AS 
        (
        	SELECT b.SysID as ItemSys,b.LinkID, a.ItemID, a.ItemID as ItemParent,a.PartType,a.ItemNo
        			,a.SysID AS SysID2
                    ,cast((CASE WHEN c.NameType = 1 AND a.IsRHLH = 1 THEN a.PartName+' RH' WHEN c.NameType = 2 AND a.IsRHLH = 1 THEN a.PartName+' LH' ELSE a.PartName END) AS TEXT) AS PartName
                    ,(CASE WHEN c.NameType = 1 AND a.IsRHLH = 1 THEN a.PartNo2 ELSE a.PartNo END) AS PartNo									   
        			,cast(a.ItemID as varchar) AS num,ISNULL(a.Images,'null') AS Images
        			,1 as level, a.PackingType, a.StdPack,a.FGLocation,a.MaterialType,a.Spec,a.Thick,a.Width,a.Length,a.PcsPerSheet,a.KgPerSheet,a.PartWeight,a.SpecOrder1,a.SpecOrder2
            FROM BOMBuild b 
            JOIN BOM2 a ON a.ItemID = b.ItemID
            JOIN BOM1 c ON c.SysID = b.LinkID
        	WHERE a.IsDeleteDetail = 0
        	UNION ALL
        	SELECT k.SysID AS ItemSys,p.LinkID,k.ItemChild AS ItemID, k.ItemID as ItemParent,l.PartType,l.ItemNo
        		,l.SysID AS SysID2,cast(l.PartName as text) as PartName,l.PartNo
        		,cast(cast(p.num as varchar)+'-'+cast(k.SysID as varchar) AS varchar) as num,ISNULL(l.Images,'null') AS Images
        		, level+1, l.PackingType, l.StdPack, l.FGLocation,l.MaterialType,l.Spec,l.Thick,l.Width,l.Length,l.PcsPerSheet,l.KgPerSheet,l.PartWeight,l.SpecOrder1,l.SpecOrder2
        	FROM BOMChild k
        	JOIN BOM2 l ON l.ItemID = k.ItemChild
        	INNER JOIN rel_tree p ON p.ItemID = k.ItemID
        )
        SELECT x.ItemSys,x.SysID2,x.LinkID,x.ItemID,x.ItemParent,x.PartName,x.PartNo,x.num,x.level,d.CustName, d.Code, e.ProjectName,c.SysID
        		,f.OP5M,f.OP10M,f.OP20M,f.OP30M,f.OP40M,f.OP50M,f.OP60M,f.OP70M
        		,g.OP5,g.OP10,g.OP20,g.OP30,g.OP40,g.OP50,g.OP60,g.OP70
        		,h.ProcessAssy,h.LineAssy, i.partner_name
                ,x.PartType,c.ItemNo,x.PackingType,x.StdPack,x.FGLocation,x.MaterialType,x.Spec,x.Thick,x.Width,x.Length,x.PcsPerSheet,x.KgPerSheet,x.PartWeight,x.SpecOrder1,x.SpecOrder2
                ,x.Images
        FROM rel_tree x
        JOIN BOM1 c ON c.SysID = x.LinkID
        LEFT JOIN M_Partner i ON i.id = c.SupplierID 
        LEFT JOIN M_Customer d ON d.RegID = c.IDCust
        LEFT JOIN M_Project e ON c.IDProject = e.RegID
        LEFT JOIN BOM3 f ON f.ItemID = x.ItemID 
        LEFT JOIN BOM4 g ON g.ItemID = x.ItemID 
        LEFT JOIN BOM5 h ON h.ItemID = x.ItemID
        WHERE x.LinkID = '$kode'
        ORDER BY x.num";                                  
 $DB2 = $this->app_model->dbQuery($sql);
 $data['data2'] = $DB2->result();
 $data['num2'] = $DB2->num_rows();
 //echo"<pre>";
 //print_r($sql);
 //echo"</pre>";
 $this->load->view('MasterBom/DetailBOM',$data); 
}   

public function ListProduct()
{
 $id = $this->input->post('id');
 $DB = $this->MasterBom_model->MasterList($id);
 $data['list'] = $DB->result();
 $this->load->view('MasterBom/master_list',$data); 
}
    
public function InfoTambahBOM()
{ 
 $kode = $this->input->post('kode');
 //die($this->input->post('SupplierIDHead'));
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
 $data['NameType'] = $this->input->post('NameType');
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
 $up['SupplierID'] = (intval($this->input->post('SupplierIDHead'))==0) ? 0 : $this->input->post('SupplierIDHead');
 $up['NameType'] = (intval($this->input->post('NameType'))==0) ? 0 : $this->input->post('NameType');
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
 
 $id['SysID'] = $this->app_model->DocNumBOM();
 $data2 = $this->app_model->getSelectedData("BOM1",$id);
 if($data2->num_rows()>0){ }else{
 $up2['ItemID'] = $this->app_model->dbQuery('SELECT NEXT VALUE FOR BOM2_Seq as ItemID')->row()->ItemID;
 $this->app_model->insertData("BOM1",$up);
 //$this->app_model->insertData("BOM2",$up2);
 //$this->app_model->db_get_one("SELECT ItemID FROM BOM2 WHERE PartName='".$ItemID."'"); //nyobaan
 //INSERT INTO (LinkID,ItemID) BOMBuild VALUES ($kode,$ItemiD)           
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
 $data['NameType'] = $this->input->post('NameType');
 $up['PartNo'] = $this->input->post('PartNo');
 $up['PartName'] = $this->input->post('PartName');
 $up['IDCust'] = $this->input->post('IDCust');
 $up['IDProject'] = $this->input->post('IDProject');
 $up['PackingType'] = $this->input->post('PackingType');
 $up['StdPack'] = $this->input->post('StdPack');
 $up['PartTypeID'] = $this->input->post('PartTypeID');
 $up['FGLocation'] = $this->input->post('FGLocation');
 $up['IsActive'] = $this->input->post('IsActive');
 $up['SupplierID'] = (intval($this->input->post('SupplierIDHead'))==0) ? 0 : $this->input->post('SupplierIDHead');
 $up['NameType'] = (intval($this->input->post('NameType'))==0) ? 0 : $this->input->post('NameType');
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
 //$this->app_model->updateData("BOM2",$up2,$id);
 $data['pesan'] = "Updating Success !!!";
 $data['NoUrut'] = $this->input->post('NoUrut') ; }  }
 echo json_encode($data); 
}

public function SaveImages()
{
    $data = $this->input->post();
    echo"<pre>";
    //print_r($_FILES["file"]);
    //print_r($_GET);
    print_r($data);
    echo"</pre>";
}

public function InfoTambahChild(){ 
 $type = $this->input->post('type');
 $kode = $this->input->post('LinkID');
 $ItemID = $this->input->post('ItemIDSys2');
 if(empty($kode)){
 $data2['pesan'] = "Error di luhur Om (LinkID)";
 }else{
 $data2['LinkID'] = $this->input->post('LinkID');
 $data2['PartNo2'] = $this->input->post('PartNo2');
 $data2['PartNo3'] = $this->input->post('PartNo3');
 $data2['IsRHLH'] = $this->input->post('IsRHLH');
 $data2['PartName2'] = $this->input->post('PartName2');
 $data2['LevelPart'] = $this->input->post('LevelPart');
 $data2['PackingTypeDetail'] = $this->input->post('PackingTypeDetail');
 $data2['StdPackDetail'] = $this->input->post('StdPackDetail');
 $data2['PartTypeID2'] = $this->input->post('PartTypeID2');
 $data2['QtyCar'] = $this->input->post('QtyCar');
 $data2['SupplierID'] = $this->input->post('SupplierID');
 $data2['MaterialType'] = $this->input->post('MaterialType');
 $data2['SpecOrder1'] = $this->input->post('SpecOrder1');
 $data2['SpecOrder2'] = $this->input->post('SpecOrder2');
 $data2['QtyPart'] = $this->input->post('QtyPart');
 $data2['Ratio'] = $this->input->post('Ratio');
 $data2['Spec'] = $this->input->post('Spec');
 $data2['IsCommon'] = $this->input->post('IsCommon');
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
 
 $data2['PartRM'] = $this->input->post('PartRM');
 $data2['PartNoMap'] = $this->input->post('PartNoMap');
 
 $up['LinkID'] = $this->input->post('LinkID');
 $up['ItemNo'] = $this->input->post('ItemNoDetail');
 $up['ItemNoSub'] = $this->input->post('ItemNoDetailSub');
 $up['NoUrut'] = $this->input->post('NoUrut');
 $up['PartNo'] = $this->input->post('PartNo2');
 $up['PartNo2'] = $this->input->post('PartNo3');
 $up['IsRHLH'] = $this->input->post('IsRHLH');
 $up['PartName'] = $this->input->post('PartName2');
 $up['LevelPart'] = $this->input->post('LevelPart');
 $up['PartType'] = $this->input->post('PartTypeID2');
 $up['QtyPerCar'] = $this->input->post('QtyCar');
 $up['SupplierID'] = $this->input->post('SupplierID');
 $up['StdPack'] = $this->input->post('StdPackDetail');
 $up['PackingType'] = $this->input->post('PackingTypeDetail');
 $up['MaterialType'] = $this->input->post('MaterialType') ; 
 $up['SpecOrder1'] = $this->input->post('SpecOrder1');
 $up['SpecOrder2'] = $this->input->post('SpecOrder2');
 $up['QtyPart'] = $this->input->post('QtyPart');
 $up['Ratio'] = $this->input->post('Ratio');
 $up['Spec'] = $this->input->post('Spec');
 $up['IsCommon'] = $this->input->post('IsCommon');
 $up['Width'] = $this->input->post('Width');
 $up['Thick'] = $this->input->post('Thick');
 $up['Length'] = $this->input->post('Length');
 $up['PcsPerSheet'] = $this->input->post('PcsPerSheet');
 $up['KgPerSheet'] = $this->input->post('KgPerSheet');
 $up['PartWeight'] = $this->input->post('PartWeight');
 
 $up2['LinkID'] = $this->input->post('LinkID');
 $up2['OP5'] = $this->input->post('OP5'); 
 $up2['OP10'] = $this->input->post('OP10'); 
 $up2['OP20'] = $this->input->post('OP20'); 
 $up2['OP30'] = $this->input->post('OP30'); 
 $up2['OP40'] = $this->input->post('OP40');
 $up2['OP50'] = $this->input->post('OP50');
 $up2['OP60'] = $this->input->post('OP60');
 $up2['OP70'] = $this->input->post('OP70'); 
 
 $up4['LinkID'] = $this->input->post('LinkID');
 $up4['OP5M'] = $this->input->post('OP5M');
 $up4['OP10M'] = $this->input->post('OP10M');
 $up4['OP20M'] = $this->input->post('OP20M');
 $up4['OP30M'] = $this->input->post('OP30M');
 $up4['OP40M'] = $this->input->post('OP40M');
 $up4['OP50M'] = $this->input->post('OP50M');
 $up4['OP60M'] = $this->input->post('OP60M');
 $up4['OP70M'] = $this->input->post('OP70M'); 
 
 $up5['LinkID'] = $this->input->post('LinkID');
 $up5['ProcessAssy'] = $this->input->post('ProcessAssy'); 
 $up5['LineAssy'] = $this->input->post('ProcessAssyM');
 $id['ItemID'] = $ItemID;
 $data = $this->app_model->getSelectedData("BOM2",$id);
 
 $ItemIDNew = ($ItemID!="") ? $ItemID : $this->app_model->dbQuery("SELECT NEXT VALUE FOR BOM2_Seq as ItemID")->row()->ItemID;
 //if($data->num_rows()>0){
    
 if(isset($_FILES["file"]) && $_FILES["file"]["error"]== UPLOAD_ERR_OK){
    ############ Edit settings ##############
    $UploadDirectory    = './uploads/'; //specify upload directory ends with / (slash)
    ##########################################
   
    /*
    Note : You will run into errors or blank page if "memory_limit" or "upload_max_filesize" is set to low in "php.ini".
    Open "php.ini" file, and search for "memory_limit" or "upload_max_filesize" limit
    and set them adequately, also check "post_max_size".
    */
    
    //check if this is an ajax request
    if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])){
        die();
    }
   
    //Is file size is less than allowed size.
    if ($_FILES["file"]["size"] > 5242880) {
        die("File size is too big!");
    }
    
    //allowed file type Server side check
    switch(strtolower($_FILES['file']['type']))
    {
        //allowed file types
        case 'image/png':
        case 'image/gif':
        case 'image/jpeg':
        case 'image/pjpeg':
            break;
        default:
            die('Unsupported File!'); //output error
    }
   
    $File_Name          = strtolower($_FILES['file']['name']);
    $File_Ext           = substr($File_Name, strrpos($File_Name, '.')); //get file extention
    $Random_Number      = rand(0, 9999);
    $NewFileName        = $ItemIDNew.'_'.date('Ym').$Random_Number.$File_Ext; //new file name
    $up['Images']       = $NewFileName;
    if(move_uploaded_file($_FILES['file']['tmp_name'], $UploadDirectory.$NewFileName ))
    {
        // do other stuff
        //die('Success! File Uploaded.');
    }else{
        //die('error uploading File!');
    }
 }
 else
 {
    //die('Something wrong with upload! Is "upload_max_filesize" set correctly?');
 }
   
 if($ItemID!=""){   
     //$up5['SysID'] = $this->input->post('kode');
     //$up4['SysID'] = $this->input->post('kode');
     //$up['SysID'] = $this->input->post('kode');
     //$up2['SysID'] = $this->input->post('kode');
     $this->app_model->updateData("BOM2",$up,$id);
     $this->app_model->updateData("BOM3",$up4,$id);
     $this->app_model->updateData("BOM4",$up2,$id);
     $this->app_model->updateData("BOM5",$up5,$id);
     $data2['ItemID2'] = $this->input->post('kode') ;
     $data2['NoUrut'] = $this->input->post('NoUrut') ;           
     $data2['pesan'] = "Updating Success !!!";
 }else{
    $up['ItemID'] = $up4['ItemID'] = $up2['ItemID'] = $up5['ItemID'] = $ItemIDNew;
    $TotalChildSum = $this->app_model->CariJumlahChild($kode);
    $TotalChild = $TotalChildSum + 1 ;
    $up5['SysID'] = $up4['SysID'] = $up['SysID'] = $up2['SysID'] = $kode .'-'. $TotalChild ;
    
    $this->app_model->insertData("BOM2",$up); 
    $this->app_model->insertData("BOM3",$up4);
    $this->app_model->insertData("BOM4",$up2);
    $this->app_model->insertData("BOM5",$up5);
    $data2['ItemID2'] = $this->input->post('kode') ;
    $data2['NoUrut'] = $this->input->post('NoUrut') ;
    $data2['pesan'] = "Save Success !!!"; 
    //add ke bombuild
    if($type == "0")
        $this->app_model->insertData("BOMBuild",array('LinkID'=>$kode,'ItemID'=>$ItemIDNew));
 } 
 
 $data2['ItemID'] = $ItemIDNew;
    //delete raw build
    /*
    $ItemRM = array();
    $old_Item = array();
    $old_Item = $this->GetListItemChild(array('ItemID'=>$ItemID));
    $this->MasterBom_model->DeleteBomBuild("BomRM",array('ItemID'=>$ItemID));
    if($this->input->post('PartRM') != "null")
    {
        $RawM = explode(',',$this->input->post('PartRM'));
        foreach($RawM as $row => $val)
        {
           $sys2['ItemRM'] = $val;
           $sys2['ItemID'] = $ItemID;
           $this->app_model->insertData("BomRM",$sys2);
           $ItemRM[] = $val;
        }
    }
    $rebuild = array('LinkID'=>$kode,'ItemID'=>$ItemID,'ItemRM'=>$ItemRM,'old_item'=>$old_Item);
    $this->rebuild_bom_add($rebuild);
    */
    //child
    if($type == "0")
    {
        $this->MasterBom_model->DeleteBomBuild("BOMChild",array('ItemID'=>$ItemIDNew));
        if($this->input->post('PartNoMap') != "null")
        {
            $PartChild = explode(',',$this->input->post('PartNoMap'));
            foreach($PartChild as $row => $val)
            {
                $sys3['ItemChild'] = $val;
                $sys3['ItemID'] = $ItemIDNew;
                $this->app_model->insertData("BOMChild",$sys3);
            }
        }
    }
    
 }  
 echo json_encode($data2);   
}
    
    public function GetListItemChild($data)
    {
        $return = array();
        $sql = "SELECT ItemRM FROM BomRM WHERE ItemID = ".$data['ItemID'];
        $rs = $this->app_model->dbQuery($sql);
        foreach($rs->result() as $row)
        {
            $return[] = $row->ItemRM;
        }
        return $return;
    }
    
    public function rebuild_bom_add($data)
    {
        $LinkID2 = array();
        $sql = "SELECT LinkID FROM BOMBuild WHERE ItemID=".$data['ItemID']."";
        $rs = $this->app_model->dbQuery($sql)->result();
        foreach($rs as $row => $val)
        {
            $LinkID2[] = $val->LinkID;
            $this->MasterBom_model->DeleteBomBuild("BOMBuild",array('LinkID'=>$val->LinkID,'ItemID'=>$data['ItemID']));
        }
        
        for($i=0;$i<count($LinkID2);$i++)
        {
            foreach($data['old_item'] as $row => $val)
            {
                $del['LinkID'] = $LinkID2[$i];
                $del['ItemID'] = $val;
                $this->MasterBom_model->DeleteBomBuild("BOMBuild",$del);
            }
        }
        
        for($i=0;$i<count($LinkID2);$i++)
        {
            $ins['ItemID'] = $data['ItemID'];
            $ins['LinkID'] = $LinkID2[$i];
            $this->app_model->insertData("BOMBuild",$ins);
            if(count($data['ItemRM'])>0)
            {
                foreach($data['ItemRM'] as $row => $val)
                {
                    $ins2['ItemID'] = $val;
                    $ins2['LinkID'] = $LinkID2[$i];
                    $this->app_model->insertData("BOMBuild",$ins2);
                }
            }
        }
        return false;
    }
    
    
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
 $data['SpecOrder1'] = $t->SpecOrder1 ;
 $data['SpecOrder2'] = $t->SpecOrder2 ;
 $data['QtyPart'] = $t->QtyPart ;
 $data['Ratio'] = $t->Ratio ;
 $data['Spec'] = $t->Spec ;
 $data['IsCommon'] = $t->IsCommon ;
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
 
 
 //$DB = $this->MasterBom_model->ExportProduct($CustID);
 $sql = "SELECT c.*, d.CustName, d.Code, e.ProjectName
         FROM BOM1 c 
         LEFT JOIN M_Customer d ON d.RegID = c.IDCust
         LEFT JOIN M_Project e ON c.IDProject = e.RegID
         WHERE 
            c.IDCust = $CustID AND c.IsDelete = 0
         ORDER BY c.SysID";
 $sql = "WITH rel_tree (LinkID,Child,level,ItemID,PartNo,num,PartType,SupplierID,MaterialType,ItemNo,FGLocation,Code,CustName,ProjectName,PartName)
            AS
            (
            	SELECT a.SysID AS LinkID,CAST(a.SysID AS VARCHAR) AS Child,0 AS level,CAST(0 AS BIGINT) AS ItemID,a.PartNo
            		,CAST(a.SysID AS VARCHAR) AS num, a.PartTypeID AS PartType,CAST(0 AS BIGINT) AS SupplierID,CAST(0 AS BIGINT) AS MaterialType
                    ,a.ItemNo,a.FGLocation,b.Code,b.CustName,c.ProjectName
                    ,a.PartName
            	FROM BOM1 a
                LEFT JOIN M_Customer b ON b.RegID = a.IDCust
                LEFT JOIN M_Project c ON c.RegID = a.IDProject
            	WHERE a.IDCust = $CustID AND a.IsDelete = 0
            	UNION ALL
            	SELECT b.LinkID,CAST('0' AS VARCHAR) as Child,level+1,a.ItemID,a.PartNo
            		,CAST(CAST(p.num AS VARCHAR)+'-'+CAST(a.ItemID AS VARCHAR) AS VARCHAR) AS num
                    ,a.PartType,a.SupplierID,a.MaterialType
                    ,p.ItemNo,a.FGLocation,p.Code,p.CustName,p.ProjectName
                    ,a.PartName
            	FROM BOMBuild b
            	JOIN BOM2 a ON a.ItemID = b.ItemID
            	INNER JOIN rel_tree p ON p.Child = b.LinkID
            	--WHERE a.IsDeleteDetail = 0
            	UNION ALL
            	SELECT CAST(p.LinkID AS VARCHAR) AS LinkID,CAST('0' AS VARCHAR) AS Child,level+1,l.ItemID,l.PartNo
            		,CAST(CAST(p.num AS VARCHAR)+'-'+CAST(k.SysID AS VARCHAR) AS VARCHAR) AS num
                    ,l.PartType,l.SupplierID,l.MaterialType
                    ,p.ItemNo,l.FGLocation,p.Code,p.CustName,p.ProjectName
                    ,l.PartName
            	FROM BOMChild k
                JOIN BOM2 l ON l.ItemID = k.ItemChild
            	--JOIN BOMBuild m ON m.ItemID = k.ItemID
                INNER JOIN rel_tree p ON p.ItemID = k.ItemID 
            )
            SELECT x.LinkID,x.Child,x.level,x.ItemID,x.PartNo,x.num,x.PartType,x.SupplierID,g.MaterialName
				,y.QtyPerCar,y.Spec,y.Thick,y.Width,y.Length,y.PcsPerSheet,y.PartWeight
                ,y.KgPerSheet,e.OP5,e.OP10,e.OP20,e.OP30,e.OP40,e.OP50,e.OP60,e.OP70,d.OP5M,d.OP10M,d.OP20M,d.OP30M,d.OP40M
                ,d.OP50M,d.OP60M,d.OP70M,f.LineAssy,f.ProcessAssy,y.PackingType,y.StdPack,x.FGLocation,c.partner_name,x.ItemNo
                ,x.Code,x.CustName,x.ProjectName,x.MaterialType,x.PartName
            FROM rel_tree x
            LEFT JOIN BOM2 y ON y.ItemID = x.ItemID
            LEFT JOIN M_Partner c ON c.id = x.SupplierID 
            LEFT JOIN BOM3 d ON d.ItemID = x.ItemID 
            LEFT JOIN BOM4 e ON e.ItemID = x.ItemID 
            LEFT JOIN BOM5 f ON f.ItemID = x.ItemID
            LEFT JOIN M_MaterialType g ON g.RegID = y.MaterialType
            ORDER BY x.num";
 $DB = $this->app_model->dbQuery($sql);
 $data['data']=$DB->result(); 
 $data['num'] = $DB->num_rows();
 $data['sql'] = $sql;
 
 //echo"<pre>";
 //print_r($data);
 //echo"</pre>";
 $this->load->view('MasterBom/ExportProduct',$data); 
 }  

public function Hapus_Detail_old(){
 $level = $this->input->post('LevelDetailDelete2');   
 $up['IsDeleteDetail'] = "1" ;
 $id_d['SysID'] = $this->input->post('DocNumDetailDelete2'); 
 $data = ($level > 1) ? $this->app_model->getSelectedData("BOMChild",$id_d) : $this->app_model->getSelectedData("BOM2",$id_d);
 if($data->num_rows()>0){
    if($level > 1)
        $this->app_model->updateData("BOMChild",$up,$id_d);
    else
        $this->app_model->updateData("BOM2",$up,$id_d);
 echo 'Data berhasil dihapus bro' ;
 }else{        
 echo 'Gagal Menghapus bro'; } }
 
 public function Hapus_Detail()
 {
     $level = $this->input->post('LevelDetailDelete2');
     $id_d['SysID'] = $SysID = $this->input->post('DocNumDetailDelete2'); 
     $ItemID = ($level > 1) ? $this->app_model->db_get_one("SELECT ItemID FROM BOMChild WHERE SysID='$SysID'") : $this->app_model->db_get_one("SELECT ItemID FROM BOMBuild WHERE SysID='$SysID'");
     $ok = ($level > 1) ? $this->MasterBom_model->DeleteBomBuild("BOMChild",$id_d) : $this->MasterBom_model->DeleteBomBuild("BOMBuild",$id_d);
     if($ok){
        $data['status'] = 1;
        $data['msg'] = 'Data berhasil dihapus' ;
     }else{        
        $data['msg'] = 'Gagal Menghapus';
        $data['status'] = 0; 
     }
     $data['ItemID'] = $ItemID;
     echo json_encode($data);
 }
    
public function Hapus_Head(){
 $up['IsDelete'] = "1" ;
 $id_d['SysID'] = $this->input->post('DocNumDetailDelete'); 
 $data = $this->app_model->getSelectedData("BOM1",$id_d);
 if($data->num_rows()>0){
 $this->app_model->updateData("BOM1",$up,$id_d);
 echo 'Data berhasil dihapus' ;
 }else{        
 echo 'Gagal Menghapus'; } }
                       
function _set_rules(){
$this->form_validation->set_rules('user','username','required|trim');
$this->form_validation->set_rules('password','password','required|trim');
$this->form_validation->set_error_delimiters("<div class='alert alert-danger'>","</div>"); }

function GetListByPartLevel()
{
    $PartLevel = $this->input->post('PartLevel');
    $IDCust = $this->input->post('IDCust');
    $PartTypeID = $this->input->post('PartTypeID');
    $PartNo = $this->input->post('PartNo');
    /*
    $PartNo2 = "";
    foreach($PartNo as $row => $val)
    {
        if($row != 0) $PartNo2 .= ",'".$val."'";
        else $PartNo2 .= "'".$val."'";
    }
    */
    $data['PartNo'] = $PartNo;
    
    $where = "";
    if($PartNo!="") $where .= " AND a.PartNo LIKE '%$PartNo%'";
    if($PartLevel != "") $where .= " AND a.LevelPart='$PartLevel'";
    //if($IDCust != "") $where .= " AND b.IDCust = '$IDCust'";
    if($PartTypeID != "") $where .= " AND a.PartType= '$PartTypeID'";    
    if($PartNo=="" && $PartLevel=="" && $PartTypeID == "") $where .= "AND 1=2";
    
    $sql = "SELECT a.*
                ,(CASE WHEN a.IsRHLH = 1 THEN RIGHT(a.PartNo2,3) ELSE '' END) as PartNo2
                ,(CASE WHEN LEN(a.PartNo + ' - ' +a.PartName)>30 THEN LEFT(a.PartNo + ' - ' +a.PartName,30)+'..' ELSE LEFT(a.PartNo + ' - ' +a.PartName,30) END) as text 
                FROM BOM2 a WHERE a.IsDeleteDetail = 0 
                            AND a.PartType NOT LIKE 'FG%' 
                            AND a.PartType NOT LIKE 'RM%' $where 
                ORDER BY a.PartNo";    
    $data['sql'] = $sql;  
    $data['PartLevel'] = $PartLevel;
    $DB = $this->app_model->dbQuery($sql);
    $data['list'] = $DB->result();
    if($DB->num_rows()>0)
    {
        foreach($data['list'] as $row => $val)
        {
            if($val->IsRHLH == 1)
            {
                $str = $val->PartNo.'/'.$val->PartNo2.' - '.$val->PartName;
            } else 
            {
                $str = $val->PartNo.' - '.$val->PartName;
            }
            $val->text = $this->left($str,30);
        }
    }
    echo json_encode($data);
}

function left($str, $length) {
    $len = strlen($str);
    if($len > $length) $text = substr($str, 0, $length).'..';
    else $text = substr($str, 0, $length);
    return $text;
}

function InsertBomBuild()
{
    $d['LinkID'] = $LinkID = $this->input->post('LinkID');
    $d['ItemID'] = $ItemID = $this->input->post('ItemID');
    $d['CreateBy'] = $this->session->userdata('SysID');
    $d['CreateDate'] = date('Y-m-d');
    $d['CreateTime'] = date('H:i:s');
    $this->app_model->insertData("BOMBuild",$d);
    
    $sql = "SELECT ItemRM FROM BomRM WHERE ItemID=".$d['ItemID'];
    $rs = $this->app_model->dbQuery($sql);
    if($rs->num_rows()>0)
    {
        foreach($rs->result() as $row => $val)
        {
            $d['LinkID'] = $LinkID;
            $d['ItemID'] = $val->ItemRM;
            $d['CreateBy'] = $this->session->userdata('SysID');
            $d['CreateDate'] = date('Y-m-d');
            $d['CreateTime'] = date('H:i:s');
            $this->app_model->insertData("BOMBuild",$d);
        }
    }

    
    $sql = "SELECT b.*, d.Code, e.ProjectName, a.SysID as ItemSys
            FROM BOMBuild a
            JOIN BOM2 b ON b.ItemID = a.ItemID
            JOIN BOM1 c ON c.SysID = a.LinkID
            JOIN M_Customer d ON d.RegID = c.IDCust
            JOIN M_Project e ON e.RegID = c.IDProject   
            WHERE a.ItemID = '$ItemID' AND a.LinkID = '$LinkID'";
    $data['list'] = $this->app_model->dbQuery($sql)->row();
    $data['sql'] = $sql;
    echo json_encode($data);
}

function DeleteBomBuild()
{
    $id['LinkID'] = $this->input->post('LinkID');
    $id['ItemID'] = $this->input->post('ItemID');
    $d['IsDelete'] = 1;
    $this->MasterBom_model->DeleteBomBuild("BOMBuild",$id);
    /*
    $sql = "SELECT ItemRM FROM BomRM WHERE ItemID=".$id['ItemID'];
    $rs = $this->app_model->dbQuery($sql);
    if($rs->num_rows()>0)
    {
        foreach($rs->result() as $row => $val)
        {
            $de['LinkID'] = $id['LinkID'];
            $de['ItemID'] = $val->ItemRM;
            $this->MasterBom_model->DeleteBomBuild("BOMBuild",$de);
            //print_r ($de);
        }
    }
	*/
}

function GetListBomBuild()
{
    $LinkID = $this->input->post('LinkID');
    $sql = "SELECT b.*, (a.PartNo+' - '+a.PartName) AS text, a.PartType FROM BOM2 a JOIN BOMBuild b ON b.ItemID=a.ItemID WHERE b.LinkID='$LinkID'";
    $data['sql'] = $sql;
    $data['list'] = $this->app_model->dbQuery($sql)->result();
    echo json_encode($data);
}

function ViewMapping()
{
    $text2 = "SELECT * FROM M_Customer ORDER BY Code ASC";
    $data['l_MCust'] = $this->app_model->manualQuery($text2);    
    $text7 = "SELECT * FROM BOM6 WHERE PartType NOT LIKE '%FG%' ORDER BY SysID ASC" ;
    $data['PartType'] = $this->app_model->manualQuery($text7);
    $this->load->view('MasterBom/ViewMapping',$data);
}

function getTemplatesDetail()
{
    $text2 = "SELECT * FROM M_Customer ORDER BY Code ASC";
    $data['l_MCust'] = $this->app_model->manualQuery($text2);    
    $text7 = "SELECT * FROM BOM6 WHERE PartType NOT LIKE '%FG%' ORDER BY SysID ASC" ;
    $data['PartType'] = $this->app_model->manualQuery($text7);
    $this->load->view('MasterBom/tab_content11',$data);
}

function GetInfoChild()
{
    $kode = $this->input->post('kode');
    $ItemID = $this->input->post('ItemID');
    $d['ItemID'] = $ItemID;
    $d['kode'] = $kode;
    
    $PartTypeRM = $this->app_model->dbQuery("SELECT SysID, PartType FROM BOM6 WHERE PartType NOT LIKE '%FG%' ORDER BY SysID ASC")->result();
    foreach($PartTypeRM as $row => $val)
    {
        $data['PartTypeRM'][] = array('id'=>$val->SysID,'text'=>$val->PartType);
    }
    $data['list'] = array();
    $data['ItemRM'] = array();
    $data['PartChild'] = [];
    $sql = '';
    
    if($ItemID != '')
    {
        $sql = "SELECT b.*,c.*,d.*,a.SysID AS SysIDA,a.LinkID AS LinkIDA,a.*
                FROM BOM2 a
                LEFT JOIN BOM3 b ON b.ItemID = a.ItemID
                LEFT JOIN BOM4 c ON c.ItemID = a.ItemID 
                LEFT JOIN BOM5 d ON d.ItemID = a.ItemID 
                WHERE a.ItemID = '$ItemID'";
        $db = $this->app_model->dbQuery($sql);
        $data['list'] = $db->row();
        $data['ItemRM'] = $this->GetItemRM($data['list']->ItemID);
        
        $db2 = $this->app_model->dbQuery("SELECT * FROM BOMChild WHERE ItemID='$ItemID' ORDER BY SysID");
        foreach($db2->result() as $row)
        {
            array_push($data['PartChild'],$row->ItemChild);
        }
    } 
    
    
    $data['sql'] = $sql;
    //$data['templates'] = $this->load->view('MasterBom/FormAddItem',$d,true);
    
    echo json_encode($data);
}
    public function GetListPartType()
    {
        $sql = "SELECT '' as SysID, '' as PartType UNION ALL SELECT SysID, PartType FROM BOM6 WHERE PartType NOT LIKE '%FG%' ORDER BY SysID ASC";
        $rs = $this->app_model->dbQuery($sql);
        foreach($rs->result() as $row => $val)
        {
            $data[] = array('id'=>$val->SysID,'text'=>$val->PartType);
        }
        echo json_encode($data);
    }
    public function GetItemRM($q)
    {
        //$q = $this->input->get('q');
        $rs = $this->app_model->dbQuery("SELECT b.ItemID,b.PartNo FROM BomRM a JOIN BOM2 b ON b.ItemID = a.ItemRM WHERE a.ItemID='$q'");
        $json = [];
        if($rs->num_rows()>0)
        {
            foreach($rs->result() as $row)
            {
                $json[] = ['id'=>$row->ItemID, 'text'=>$row->PartNo];
            }
        }
        return $json;    
    }

    public function GetInfoData()
    {
        $kode = $this->input->post('kode');
        $sql = "SELECT a.* FROM BOM1 a WHERE a.SysID='$kode'";
        $db = $this->app_model->dbQuery($sql)->row();
        $data['list'] = $db;
        $data['sql'] = $sql;
        echo json_encode($data);
    }
    
    public function searchkomponen()
    {
        $q = $this->input->get('q');
        $json = [];
        if($q!="")
        {
            $sql = "SELECT ItemID,PartNo FROM BOM2 WHERE IsDeleteDetail = 0 AND PartNo LIKE '%$q%' AND PartType NOT LIKE '%FG%'";
            $rs = $this->app_model->dbQuery($sql);
            
            foreach($rs->result() as $row){
                $json[] = ['id'=>$row->ItemID, 'text'=>$row->PartNo];
            }            
        }

        echo json_encode($json);
    }
    
    public function searchkomponenRM()
    {
        $q = $this->input->get('q');
        $json = [];
        if($q!="")
        {
            $sql = "SELECT ItemID,PartNo FROM BOM2 WHERE PartNo LIKE '%$q%' AND PartType LIKE '%RM%'";
            $rs = $this->app_model->dbQuery($sql);
            
            foreach($rs->result() as $row){
                $json[] = ['id'=>$row->ItemID, 'text'=>$row->PartNo];
            } 
        }

        echo json_encode($json);
    }
    
    public function search()
    {
        $ItemParent = $this->input->post('ItemParent');
        $ItemID = $this->input->post('ItemID');
        $q = $this->input->post('query');
        $where = "";
        if($ItemID!="") $where = "AND ItemID NOT IN (".$ItemID.")";
        if($ItemParent!="") { 
            $where .= " AND ItemID NOT IN (".$ItemParent.")";
            $where .= " AND ItemID NOT IN (SELECT ItemID FROM BOMChild WHERE ItemChild IN(".$ItemParent."))";
        }
        
        $sql = "SELECT PartNo, PartName, ItemID
                FROM BOM2
                WHERE PartNo LIKE '%".$q."%' AND PartType NOT LIKE '%FG%' ".$where." AND IsDeleteDetail = 0 ORDER BY PartNo"; 
        $rs = $this->app_model->dbQuery($sql);
        $data['list'] = $rs->result();
        
        $where2 = "1=2";
        if($ItemID!="") $where2 = "ItemID IN (".$ItemID.")";
        $d['listchild'] = $this->app_model->dbQuery("SELECT ItemID, PartNo, PartName FROM BOM2 WHERE ".$where2." ORDER BY (CASE WHEN PartNo LIKE '%-R' THEN 1 ELSE 2 END) DESC, PartNo,ItemID DESC")->result();
        $data['sql'] = $sql;
        $data['templates'] = $this->load->view('MasterBom/modalchild',$d,true);
        echo json_encode($data);
    }

    public function getChildTemplates()
    {
        $d['PartType'] = $this->app_model->dbQuery("SELECT SysID, PartType FROM BOM6 WHERE PartType NOT LIKE '%FG%' ORDER BY SysID ASC")->result();
        $d['Partner'] = $this->app_model->dbQuery("SELECT id,partner_name FROM M_Partner ORDER BY id DESC")->result();
        $data['templates'] = $this->load->view('MasterBom/FormChild',$d,true);
        echo json_encode($data);
    }
}