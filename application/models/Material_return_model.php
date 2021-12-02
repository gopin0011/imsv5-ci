<?php class Material_return_model extends CI_Model{
function transaction_list(){
 $limit= 50; $offset = 0;
 return $this->db->query("SELECT * FROM QTH_Trace WITH (NOLOCK) WHERE TrcType=3000  ORDER BY SysID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY"); }
    
function transaction_detail($id){
 return $this->db->query("SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE DocNum='$id' ORDER BY SysIDDetail DESC"); }

function List_Material(){
 return $this->db->query("SELECT * FROM List_Material WITH (NOLOCK) WHERE TrcType='2000' ORDER BY SysIDDetail ASC"); }

function transaction_detail2($id){
 return $this->db->query("SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE DocNumDetail='$id' ORDER BY SysIDDetail DESC"); }
    
function MasterList(){
 return $this->db->query("SELECT * FROM Master_BOM WITH (NOLOCK) WHERE IsActiveDetail=1 AND PartTypeID LIKE '%RM%' ORDER BY SysID ASC"); }
    
function Stock_List(){
 return $this->db->query("SELECT * FROM RM_Stock WITH (NOLOCK) WHERE CustName LIKE '%SONY%' ORDER BY SysID2 ASC"); }
    
function transaction_detail_report($DocDateReport_1,$DocDateReport_2,$IDCust,$DocNum){
 $where = " WHERE DocDate BETWEEN '$DocDateReport_1' AND '$DocDateReport_2' AND TrcType=3000";
 if(empty($DocNum)){
 if($IDCust!='semua'){
 $where .= "AND IDCust='$IDCust' "; }
 }else{
 if($IDCust!='semua'){
 $where .= "AND PartNo LIKE '%$DocNum%' AND IDCust='$IDCust'";
 }else{
 $where .= "AND PartNo LIKE '%$DocNum%'" ; } } 
 $text = "SELECT * FROM QTD_Trace $where ORDER BY DocDate,DocTime ASC ";
 return $this->db->query($text); }
    
function cekId($kode){
 $this->db->where("idcoment",$kode);
 return $this->db->get("D_Comment"); }

function update($id,$info){
 $this->db->where("idcoment",$id);
 $this->db->update("D_Comment",$info); }
    
function simpan($id){
 $this->db->insert($this->table,$jenis);
 return $this->db->insert_id(); }        

function hapus($kode){
 $this->db->where("idcoment",$kode);
 $this->db->delete("forums"); }
    
}