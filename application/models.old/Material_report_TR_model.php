<?php class Material_report_TR_model extends CI_Model{
    private $table="D_Comment";
    
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	
	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}
	
	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
		
	//select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	//update table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}
    
    public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
    
    
    
    public function CariShift($id){
		$t = "SELECT * FROM M_Shift WHERE id_shift='$id'";
		$d = $this->Material_report_TR_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil = $h->shift; }
		}else{
		$hasil = ''; }
		return $hasil; 	}
    
    public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->Material_report_TR_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}
    
    public function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	} 
    

function MasterList(){
 $text = "SELECT * FROM Q01_MProduct WHERE IsStoreRoom=1 AND IsActive=1 ORDER BY IDCategory DESC";    
 return $this->db->query($text); }

function transaction_detail($ItemID){
    return $this->db->query("SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE ItemID='$ItemID' AND Qty_3!=0 AND (TrcType='1000' OR TrcType='3000') ORDER BY SysIDDetail DESC"); }
    
function transaction_detail_report($IDCategory,$part_no,$spec){
 $where = "";
 if(empty($part_no)){
 if($IDCategory!='semua'){
 if(!empty($spec)){
 $where .= "WHERE IDCategory='$IDCategory' AND Spec2 LIKE '%$spec%'";}else{
 $where .= "WHERE IDCategory='$IDCategory' ";}
 }else{
 if(!empty($spec)){
 $where .= "WHERE Spec2 LIKE '%$spec%'";} }
 }else{
 if($IDCategory!='semua'){
 if(!empty($spec)){
 $where .= "WHERE PartName LIKE '%$part_no%' AND IDCategory='$IDCategory' AND Spec2 LIKE '%$spec%'";}else{
 $where .= "WHERE PartName LIKE '%$part_no%' AND IDCategory='$IDCategory'";}
 }else{
 if(!empty($spec)){
 $where .= "WHERE PartName LIKE '%$part_no%' AND Spec2 LIKE '%$spec%'";}
 else{ $where .= "WHERE PartName LIKE '%$part_no%'" ; } }  } 
            
$text = "SELECT * FROM StockTR $where ORDER BY PartNo ASC ";
return $this->db->query($text);  }
    
function ReadStockCard($tgl1,$tgl2,$ItemID){  
 $where = "WHERE DocDate BETWEEN '$tgl1' AND '$tgl2'";     
 if(!empty($ItemID)){
 $where .= "AND ItemID='$ItemID' "; }
 $text = "SELECT* FROM SCToolRoom $where ORDER BY DocDate, DocTime ASC ";
 return $this->db->query($text); }
    
}