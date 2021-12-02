<?php class ReportMaterial_model extends CI_Model{
function ListMaterialIn($id){
 $limit= 2000;
 $offset = 0;
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE ItemID='$id' AND IDTrcType = 100
 ORDER BY DocDate DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY"); }
 
function ListMaterialOut($id){
 $limit= 2000;
 $offset = 0;
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE ItemID='$id' AND IDTrcType = 200
 ORDER BY DocDate DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY"); }
 
function ListMaterialRet($id){
 $limit= 2000;
 $offset = 0;
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE ItemID='$id' AND IDTrcType = 105
 ORDER BY DocDate DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY"); }
 
function MasterList($id){
 $IDCust = "" ;
 if($id!='All'){$IDCust .= "AND IDCust='$id'" ; }else{$IDCust .= "" ; } 
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsMaterial=1 AND IsActive=1 $IDCust ORDER BY IDCust DESC"); }

function MasterList2(){
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsMaterial=1 AND IsActive=1 ORDER BY IDCust DESC"); }

function transaction_detail($ItemID){
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE ItemID='$ItemID' AND Balmat!=0 AND (IDTrcType='100' OR IDTrcType='105') ORDER BY DocDate,DocTime ASC"); }
    
function transaction_detail_report($IDCust,$part_no,$spec){
 $where = "";
 if(empty($part_no)){
 if($IDCust!='All'){
 if($spec!='All'){
 $where .= "WHERE IDCust='$IDCust' AND (Spec2 LIKE '%$spec%' OR Spec1 LIKE '%$spec%')";}else{
 $where .= "WHERE IDCust='$IDCust' ";}
 }else{
 if($spec!='All'){
 $where .= "WHERE Spec2 LIKE '%$spec%' OR Spec1 LIKE '%$spec%'";} }
 }else{
 if($IDCust!='All'){
 if($spec!='All'){
 $where .= "WHERE PartNo LIKE '%$part_no%' AND IDCust='$IDCust' AND (Spec2 LIKE '%$spec%' OR Spec1 LIKE '%$spec%')";}else{
 $where .= "WHERE PartNo LIKE '%$part_no%' AND IDCust='$IDCust'";}
 }else{
 if($spec!='All'){
 $where .= "WHERE PartNo LIKE '%$part_no%' AND (Spec2 LIKE '%$spec%' OR Spec1 LIKE '%$spec%')";}
 else{ $where .= "WHERE PartNo LIKE '%$part_no%'" ; } } } 
 $text = "SELECT * FROM RMStock $where ORDER BY IDCust ASC ";
return $this->db->query($text);  }

function QtyRM_IN($kode,$tgl_awal,$tgl_akhir){
 $d = $this->db->query("SELECT ItemID,SUM(QtyMat) as jml FROM SumRM_100 WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') GROUP BY ItemID");
 $r = $d->num_rows();
 if($r>0){ foreach($d->result() as $h){
 $hasil = $h->jml; }
 }else{
 $hasil = 0; }
 return $hasil; }
 
function QtyRM_OUT($kode,$tgl_awal,$tgl_akhir){
 $d = $this->db->query("SELECT ItemID,SUM(QtyMat) as jml FROM SumRM_200 WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') GROUP BY ItemID");
 $r = $d->num_rows();
 if($r>0){ foreach($d->result() as $h){
 $hasil = $h->jml; }
 }else{
 $hasil = 0; }
 return $hasil; }
 
function QtyRM_RET($kode,$tgl_awal,$tgl_akhir){
 $d = $this->db->query("SELECT ItemID,SUM(QtyMat) as jml FROM SumRM_105 WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') GROUP BY ItemID");
 $r = $d->num_rows();
 if($r>0){ foreach($d->result() as $h){
 $hasil = $h->jml; }
 }else{
 $hasil = 0; }
 return $hasil; }    
        
function ReadStockCard($tgl1,$tgl2,$ItemID){  
$where = "WHERE DocDate BETWEEN '$tgl1' AND '$tgl2'";     
if(!empty($ItemID)){
$where .= "AND ItemID='$ItemID' ";	}   
$text = "SELECT* FROM SCRawMaterial $where ORDER BY DocDate, DocTime ASC";
return $this->db->query($text);
    }
    
}