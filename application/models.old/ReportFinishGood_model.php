<?php class ReportFinishGood_model extends CI_Model{
function MasterList($id){
 $IDCust = "" ;
 if($id!='All'){$IDCust .= "AND IDCust='$id'" ; }else{$IDCust .= "" ; } 
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsDelivery=1 AND IsActive=1 $IDCust ORDER BY IDCust DESC"); }

function MasterList2(){
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsDelivery=1 AND IsActive=1 ORDER BY IDCust DESC"); }

function transaction_detail($ItemID){
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE ItemID='$ItemID' AND Balmat!=0 AND (IDTrcType='100' OR IDTrcType='105') ORDER BY DocDate,DocTime ASC"); }
    
function transaction_detail_report($IDCust,$ItemID){
 $where = "";
 if(!empty($ItemID)){
 if($IDCust!='All'){
 $where .= "WHERE ItemID='$ItemID' AND IDCust='$IDCust'"; }else{$where .= "WHERE ItemID='$ItemID'";}
 }else{
 if($IDCust!='All'){
 $where .= "WHERE IDCust='$IDCust'";
 }else{
 $where .= "WHERE IsActive=1" ;   }  }
  
 $text = "SELECT * FROM FGStock WITH (NOLOCK) $where ORDER BY IDCust ASC ";
return $this->db->query($text);  }

function FG_IN($kode,$tgl_awal,$tgl_akhir){
 $query = $this->db->query("SELECT ItemID,SUM(QtyMat) as jml FROM SumRM_600 WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') GROUP BY ItemID");
 $r = $query->num_rows();
 if($r>0){
 foreach($query->result() as $row){
 $hasil = $row->jml ; }
 }else{
 $hasil = 0; }
 return $hasil; }
    
function FG_OUT($kode,$tgl_awal,$tgl_akhir){
 $d = $this->db->query("SELECT ItemID,SUM(QtyMat) as jml FROM SumRM_700 WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') GROUP BY ItemID");
 $r = $d->num_rows();
 if($r>0){
 foreach($d->result() as $h){
 $hasil = $h->jml; }
 }else{
 $hasil = 0; }
 return $hasil; }
 
    
function ReadStockCard($tgl1,$tgl2,$ItemID){  
$where = "WHERE ItemID='$ItemID' AND DocDate BETWEEN '$tgl1' AND '$tgl2'";     
$text = "SELECT* FROM SCFG $where ORDER BY DocDate, DocTime ASC ";
return $this->db->query($text);
    }
    
}