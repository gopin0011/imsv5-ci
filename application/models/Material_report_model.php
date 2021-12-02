<?php class Material_report_model extends CI_Model{
function MasterList($id){
 $IDCust = "" ;
 if($id!='All'){$IDCust .= "AND IDCust='$id'" ; }else{$IDCust .= "" ; } 
 return $this->db->query("SELECT * FROM Master_BOM WITH (NOLOCK) WHERE IsActiveDetail=1 AND PartTypeID LIKE '%RM%' $IDCust ORDER BY SysID ASC"); }

function MasterList2(){
 return $this->db->query("SELECT * FROM Master_BOM WITH (NOLOCK) WHERE IsActiveDetail=1 AND PartTypeID LIKE '%RM%' ORDER BY SysID ASC"); }

function transaction_detail($ItemID){
    return $this->db->query("SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE ItemID='$ItemID' AND Qty_3!=0 AND (TrcType='1000' OR TrcType='3000') ORDER BY SysIDDetail DESC"); }
    
function transaction_detail_report($IDCust,$ItemID,$SpecRM){
 $where = "WHERE PartTypeID LIKE '%RM%'";
 if(empty($ItemID)){
 if($IDCust!='All'){
 if($SpecRM!='All'){
 $where .= "AND IDCust='$IDCust' AND (SpecOrder1 LIKE '%$SpecRM%' OR SpecOrder2 LIKE '%$SpecRM%')";}else{
 $where .= "AND IDCust='$IDCust' ";}
 }else{
 if($SpecRM!='All'){
 $where .= "AND SpecOrder1 LIKE '%$SpecRM%' OR SpecOrder2 LIKE '%$SpecRM%'";} }
 }else{
 if($IDCust!='All'){
 if($SpecRM!='All'){
 $where .= "AND ItemID='$ItemID' AND IDCust='$IDCust' AND (SpecOrder1 LIKE '%$SpecRM%' OR SpecOrder2 LIKE '%$SpecRM%')";}else{
 $where .= "AND ItemID='$ItemID' AND IDCust='$IDCust'";}
 }else{
 if($SpecRM!='All'){
 $where .= "AND ItemID='$ItemID' AND (SpecOrder1 LIKE '%$SpecRM%' OR SpecOrder2 LIKE '%$SpecRM%')";}
 else{ $where .= "AND ItemID='$ItemID'" ; } } 	 } 
 $text = "SELECT * FROM RM_Stock_01 $where ORDER BY IDCust ASC";
 return $this->db->query($text);  }
    
function ReadStockCard($tgl1,$tgl2,$ItemID){  
 $where = "WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND ItemID='$ItemID'";       
 $text = "SELECT* FROM StockCardRM_01 $where ORDER BY DocDate, DocTime ASC ";
 return $this->db->query($text); }
    
}