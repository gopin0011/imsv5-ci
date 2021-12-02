<?php class OUTWip_model extends CI_Model{
function transaction_list(){
 $limit= 50; $offset = 0;
 return $this->db->query("SELECT * FROM QTH_RawMaterial WHERE IDTrcType=3000 ORDER BY RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY"); }
    
function transaction_detail($id){
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE DocNum='$id' AND QtyMat!=0 ORDER BY RegID DESC"); }
 
function transaction_detail_2($id){
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE DocNumDetail='$id'"); }
    
function MasterList(){ 
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsStamping=1 AND IsActive=1 ORDER BY IDCust DESC"); }
    
function transaction_detail_report($tgl1,$tgl2,$IDCust,$PartNo2){
 $where = " WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND IDTrcType=3000";
 if(empty($PartNo2)){
 if($IDCust!='semua'){ 
 $where .= "AND IDCust='$IDCust' ";}
 }else{
 if($IDCust!='semua'){ 
 $where .= "AND PartNo LIKE '%$PartNo2%' AND IDCust='$IDCust'";}
 else{ $where .= "AND PartNo LIKE '%$PartNo2%'" ; 
 }  } 
 $text = "SELECT * FROM QTD_RawMaterial $where ORDER BY DocDate,DocTime ASC ";
 return $this->db->query($text); }

    
}