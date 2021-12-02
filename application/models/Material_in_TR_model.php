<?php class Material_in_TR_model extends CI_Model{
	public function getAllData($table){ return $this->db->get($table); }
	public function getAllDataLimited($table,$limit,$offset) { return $this->db->get($table, $limit, $offset); }
	public function getSelectedDataLimited($table,$data,$limit,$offset){ return $this->db->get_where($table, $data, $limit, $offset);}
	public function getSelectedData($table,$data){return $this->db->get_where($table, $data); }
	function updateData($table,$data,$field_key) { $this->db->update($table,$data,$field_key); }
	function deleteData($table,$data) { $this->db->delete($table,$data); }
	function insertData($table,$data){ $this->db->insert($table,$data); }
	function manualQuery($q){ return $this->db->query($q); }

public function tgl_str($date){
$exp = explode('-',$date);
if(count($exp) == 3) { $date = $exp[2].'-'.$exp[1].'-'.$exp[0]; } return $date; }

public function tgl_indo($tgl){
$jam = substr($tgl,11,10);
$tgl = substr($tgl,0,10);
$tanggal = substr($tgl,8,2);
$bulan = $this->MasterBom_model->getBulan(substr($tgl,5,2));
$tahun = substr($tgl,0,4);
return $tanggal.' '.$bulan.' '.$tahun.' '.$jam; }
    
public function getBulan($bln){
switch ($bln){ 
case 1: return "Januari"; break;
case 2: return "Februari"; break;
case 3: return "Maret"; break;
case 4: return "April"; break;
case 5: return "Mei"; break;
case 6: return "Juni"; break;
case 7: return "Juli"; break;
case 8: return "Agustus"; break;
case 9: return "September"; break;
case 10: return "Oktober"; break;
case 11: return "November"; break;
case 12: return "Desember"; break; } } 
    
function transaction_list(){
$limit= 50; $offset = 0;
return $this->db->query("SELECT * FROM QTH_RawMaterial WHERE IDTrcType=110 ORDER BY RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY");
}

function MListPartner(){
return $this->db->query("SELECT * FROM M_Partner ORDER BY id DESC");
}
    
function transaction_detail($id){
return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE DocNum='$id' AND QtyMat!=0 ORDER BY RegID DESC"); }
    
function transaction_detail2($id){
return $this->db->query("SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE DocNumDetail='$id' ORDER BY SysIDDetail DESC"); }
    
function MasterList(){
return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsStoreRoom=1 AND IsActive=1 AND IsDelete='X' ORDER BY PartName DESC"); }
    
function Stock_List(){
return $this->db->query("SELECT * FROM RM_Stock WITH (NOLOCK) WHERE CustName LIKE '%SONY%' ORDER BY SysID2 ASC"); }
    
    
function transaction_detail_report($tgl1,$tgl2,$IDCategory,$ItemID,$PartnerID){
 $where = "WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND IDTrcType='110'" ; 
 if(empty($ItemID)){
 if($IDCategory!='semua'){
 if($PartnerID!='ALL'){
 $where .= "AND PartnerID='$PartnerID' AND IDCategory='$IDCategory'";}else{
 $where .= "AND IDCategory='$IDCategory' ";}
 }else{
 if($PartnerID!='ALL'){
 $where .= "AND PartnerID='$PartnerID'";}
 }
 }else{
 if($IDCategory!='semua'){
 if($PartnerID!='ALL'){
 $where .= "AND ItemID='$ItemID' AND PartnerID='$PartnerID' AND IDCategory='$IDCategory'";}else{
 $where .= "AND ItemID='$ItemID' AND IDCategory='$IDCategory'";}
 }else{
 if($PartnerID!='ALL'){
 $where .= "AND ItemID='$ItemID' AND PartnerID='$PartnerID'";}
 else{ $where .= "AND ItemID='$ItemID'" ; } } 	 } 
   
 $text = "SELECT * FROM QTD_RawMaterial $where ORDER BY RegID ASC ";

    return $this->db->query($text);
    }
    
    
    
}