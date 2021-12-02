<?php class OutNonSTP_model extends CI_Model{
function transaction_list(){
 $limit= 50; $offset = 0;
 return $this->db->query("SELECT * FROM QTH_Production WITH (NOLOCK) WHERE IDTrcType=3000  ORDER BY RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY"); }
    
function transaction_detail($id){
 return $this->db->query("SELECT * FROM QTD_Production WITH (NOLOCK) WHERE DocNum='$id' AND IsDelete=0 ORDER BY RegID DESC"); }
 
function transaction_detail_2($id){
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE DocNumDetail='$id'"); }
 
 function transaction_detail_3($id){
 return $this->db->query("SELECT * FROM QTD_Production WITH (NOLOCK) WHERE HideD='$id' ORDER BY RegID DESC"); }
    
function MasterList(){ 
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsWelding=1 AND IsActive=1 ORDER BY IDCust DESC"); }
    
function transaction_detail_report($tgl1,$tgl2,$IDCust,$Factory,$PartNo,$IDLine){
 $where = " WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND IDTrcType=3000";
 if(empty($PartNo)){
 if($IDCust!='ALL'){  
 if($Factory !='ALL'){
 if($IDLine!='ALL'){
 $where .= "AND IDLine='$IDLine' AND Factory='$Factory' AND IDCust='$IDCust'";
 }else{
 $where .= "AND Factory='$Factory' AND IDCust='$IDCust'";}
 }else{
 if($IDLine!='ALL'){
 $where .= "AND IDLine='$IDLine' AND IDCust='$IDCust'";
 }else{
 $where .= "AND IDCust='$IDCust'";} }
 }else{
 if($Factory !='ALL'){
 if($IDLine!='ALL'){
 $where .= "AND IDLine='$IDLine' AND Factory='$Factory'";
 }else{
 $where .= "AND Factory='$Factory'";} }  }
 }else{
 if($IDCust!='ALL'){  
 if($Factory !='ALL'){
 if($IDLine!='ALL'){
 $where .= "AND IDLine='$IDLine' AND Factory='$Factory' AND IDCust='$IDCust' AND PartNo LIKE '%$PartNo%'";
 }else{
 $where .= "AND Factory='$Factory' AND IDCust='$IDCust' AND PartNo LIKE '%$PartNo%'";}
 }else{
 if($IDLine!='ALL'){
 $where .= "AND IDLine='$IDLine' AND IDCust='$IDCust' AND PartNo LIKE '%$PartNo%'";
 }else{
 $where .= "AND IDCust='$IDCust'";}
 } }else{
 if($Factory !='ALL'){
 if($IDLine!='ALL'){
 $where .= "AND IDLine='$IDLine' AND Factory='$Factory' AND PartNo LIKE '%$PartNo%'";
 }else{
 $where .= "AND Factory='$Factory' AND PartNo LIKE '%$PartNo%'";}
 }else{
 $where .= "AND PartNo LIKE '%$PartNo%'"; }}}  
 
 $text = "SELECT * FROM QTD_Production $where ORDER BY DocDate ASC ";
 return $this->db->query($text); }

    
}