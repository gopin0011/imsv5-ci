<?php class ReturnMaterial_model extends CI_Model{
    
function transaction_list(){
 $limit= 50; $offset = 0;
 return $this->db->query("SELECT * FROM QTH_RawMaterial WHERE IDTrcType=105 ORDER BY RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY"); }
    
function transaction_detail($id){
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE DocNum='$id' AND QtyMat!=0 ORDER BY RegID DESC"); }

function List_Material(){
 $limit= 1500; $offset = 0;
 return $this->db->query("SELECT * FROM ListMaterialOut WHERE IDTrcType=200 ORDER BY RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY"); }
    
function transaction_detail_2($id){
 return $this->db->query("SELECT * FROM QTD_RawMaterial WITH (NOLOCK) WHERE DocNumDetail='$id' ORDER BY RegID DESC"); }
    
function MasterList(){
 return $this->db->query("SELECT * FROM Master_BOM WITH (NOLOCK) WHERE IsActiveDetail=1 AND PartTypeID LIKE '%RM%' ORDER BY SysID ASC"); }

function transaction_detail_report($tgl1,$tgl2,$IDCust,$PartNo){
$where = "WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND IDTrcType=105";
 if(empty($PartNo)){
 if($IDCust!='semua'){
 $where .= "AND IDCust='$IDCust' ";}
 }else{ 
 if($IDCust!='semua'){ 
 $where .= "AND PartNo LIKE '%$PartNo%' AND IDCust='$IDCust'";
 }else{ 
 $where .= "AND PartNo LIKE '%$PartNo%'" ; } } 
 $text = "SELECT * FROM QTD_RawMaterial $where ORDER BY DocDate,DocTime ASC ";
 return $this->db->query($text); }

    
}