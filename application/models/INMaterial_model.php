<?php class INMaterial_model extends CI_Model{
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
		$d = $this->INMaterial_model->manualQuery($t);
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
			$bulan = $this->INMaterial_model->getBulan(substr($tgl,5,2));
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
    
function transaction_list(){
 $limit= 50; $offset = 0;
 return $this->db->query("SELECT * FROM QTH_RawMaterial WHERE IDTrcType=100 ORDER BY RegID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY"); }
    
function transaction_detail($id){
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE DocNum='$id' AND QtyMat!=0 ORDER BY RegID DESC"); }
 
function transaction_detail_2($id){
 return $this->db->query("SELECT * FROM QTD_RawMaterial WHERE DocNumDetail='$id'"); }
    
function MasterList(){ 
 return $this->db->query("SELECT * FROM Q01_MProduct WHERE IsMaterial=1 AND IsActive=1 ORDER BY IDCust DESC"); }

function MasterListPartner(){ 
 return $this->db->query("SELECT * FROM M_Partner ORDER BY id DESC"); }
    
function transaction_detail_report($tgl1,$tgl2,$IDCust,$DocNum,$PartnerID){
 $where = "WHERE DocDate BETWEEN '$tgl1' AND '$tgl2' AND IDTrcType=100";
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
 else{ $where .= "AND PartNo LIKE '%$DocNum%'" ; } } 	 } 
 $text = "SELECT * FROM QTD_RawMaterial $where ORDER BY DocDate,DocTime ASC ";
 return $this->db->query($text); }

    
}