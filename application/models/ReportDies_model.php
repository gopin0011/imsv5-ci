<?php class ReportDies_model extends CI_Model{
function MasterList($id){
 $IDCust = "" ;
 if($id!='ALL'){$IDCust .= "AND IDCust='$id'" ; }else{$IDCust .= "" ; } 
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsStamping=1 AND IsActive=1 $IDCust"); }

function transaction_detail_report_1($tgl1,$tgl2,$ItemID,$ProsesD){
 $where = "WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND ItemID='$ItemID' AND IDTrcType=1000 AND QtyStroke>0";
 if($ProsesD!='ALL'){ $where .="AND ProsesD='$ProsesD'" ; }else{ $where .=""; }
 $text = "SELECT * FROM QTD_Production $where ORDER BY DocDate ASC";
return $this->db->query($text);  }

function transaction_detail_report_2($ItemID,$ProsesD,$IDCust){
 $where="";
 if(empty($ItemID)){ 
 if($ProsesD!='ALL'){
 if($IDCust!='ALL'){
 $where .= "WHERE ProsesD='$ProsesD' AND IDCust='$IDCust'";}else{
 $where .= "WHERE ProsesD='$ProsesD'";} }else{
 if($IDCust!='ALL'){
 $where .= "WHERE IDCust='$IDCust'";
 }else{ $where .=""; } } 
 }else{
 if($ProsesD!='ALL'){
 if($IDCust!='ALL'){
 $where .= "WHERE ItemID='$ItemID' AND ProsesD='$ProsesD' AND IDCust='$IDCust'";}else{
 $where .= "WHERE ItemID='$ItemID' AND ProsesD='$ProsesD'";} }else{
 if($IDCust!='ALL'){    
 $where .= "WHERE ItemID='$ItemID' AND IDCust='$IDCust'" ; }else{
 $where .= "WHERE ItemID='$ItemID'";}
 } }
 $text = "SELECT * FROM QSumStrokeDies $where ORDER BY IDCust ASC ";
return $this->db->query($text);  }

    
}