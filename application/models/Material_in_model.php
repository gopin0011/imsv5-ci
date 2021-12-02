<?php class Material_in_model extends CI_Model{
 
function transaction_list(){
 $limit= 50; $offset = 0;
 return $this->db->query("SELECT * FROM QTH_Trace WITH (NOLOCK) WHERE TrcType=1000  ORDER BY SysID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY"); }

function transaction_detail($id){
 return $this->db->query("SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE DocNum='$id' ORDER BY SysIDDetail DESC"); }
 
function transaction_detail2($id){
 return $this->db->query("SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE DocNumDetail='$id' ORDER BY SysIDDetail DESC"); }

function MasterList(){
 return $this->db->query("SELECT * FROM Master_BOM WITH (NOLOCK) WHERE IsCommon=0 AND IsActiveDetail=1 AND PartTypeID LIKE '%RM%' ORDER BY SysID ASC"); }

function Stock_List(){
 return $this->db->query("SELECT * FROM RM_Stock WITH (NOLOCK) WHERE CustName LIKE '%SONY%' ORDER BY SysID2 ASC"); }

function transaction_detail_report($DocDateReport_1,$DocDateReport_2,$IDCust,$DocNum,$PartnerID){
 $where = " WHERE DocDate BETWEEN '$DocDateReport_1' AND '$DocDateReport_2' AND TrcType=1000";
 if(empty($DocNum)){
 if($IDCust!='semua'){
 if($PartnerID!='ALL'){
 $where .= "AND IDCust='$IDCust' AND PartnerID='$PartnerID'";}else{
 $where .= "AND IDCust='$IDCust' ";}
 }else{
 if($PartnerID!='ALL'){
 $where .= "AND PartnerID='$PartnerID'";} }
 }else{
 if($IDCust!='semua'){
 if($PartnerID!='ALL'){
 $where .= "AND PartNo LIKE '%$DocNum%' AND IDCust='$IDCust' AND PartnerID='$PartnerID'";}else{
 $where .= "AND PartNo LIKE '%$DocNum%' AND IDCust='$IDCust'";}
 }else{
 if($PartnerID!='ALL'){
 $where .= "AND PartNo LIKE '%$DocNum%' AND PartnerID='$PartnerID'";}
 else{ $where .= "AND PartNo LIKE '%$DocNum%'" ; }
 } } 
 $text = "SELECT * FROM QTD_Trace $where ORDER BY DocDate,DocTime ASC ";
 return $this->db->query($text); }
        
}