<?php class ReportWip_model extends CI_Model{
function MasterList($id){
 $IDCust = "" ;
 if($id!='All'){$IDCust .= "AND IDCust='$id'" ; }else{$IDCust .= "" ; } 
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsStamping=1 AND IsActive=1 $IDCust ORDER BY IDCust DESC"); }

function MasterList2(){
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsStamping=1 AND IsActive=1 ORDER BY IDCust DESC"); }

function transaction_detail($ItemID){
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE ItemID='$ItemID' AND Balmat!=0 AND (IDTrcType='100' OR IDTrcType='105') ORDER BY DocDate,DocTime ASC"); }
    
function transaction_detail_report($IDCust,$ItemID){
 $where = "";
 if(empty($ItemID)){
 if($IDCust!='All'){
 $where .= "WHERE IDCust='$IDCust'"; }else{ $where = "";}
 }else{
 if($IDCust!='All'){
 $where .= "WHERE ItemID='$ItemID' AND IDCust='$IDCust'";
 }else{
 $where .= "WHERE ItemID='$ItemID'" ;   } 	 } 
 $text = "SELECT * FROM WIPStock $where ORDER BY IDCust ASC ";
return $this->db->query($text);  }
    
function ReadStockCard($tgl1,$tgl2,$ItemID){  
 $where = "WHERE ItemID='$ItemID' AND DocDate BETWEEN '$tgl1' AND '$tgl2'";     
 $text = "SELECT* FROM SCWip $where ORDER BY DocDate, DocTime ASC ";
 return $this->db->query($text); }
    
 }