<?php class MasterBom_model extends CI_Model{
    private $table="D_Comment";
    
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

function MasterList($id){ return $this->db->query("SELECT * FROM Master_BOM1 WHERE IDCust='$id' ORDER BY SysID DESC"); }
function DetailBom2($kode){ return $this->db->query("SELECT * FROM Master_BOM WHERE SysID='$kode' ORDER BY SysID,NoUrut,ItemNoSub ASC"); }
function DetailBom1($kode){ return $this->db->query("SELECT * FROM Master_BOM1 WHERE SysID='$kode' ORDER BY SysID DESC"); }
function ExportProduct($CustID){ return $this->db->query("SELECT * FROM Master_BOM WHERE IDCust='$CustID' ORDER BY IDCust DESC"); }     
    
function DeleteBomBuild($table,$index)
{
    $this->db->delete($table, $index);
    return $this->db->affected_rows();
}    
}