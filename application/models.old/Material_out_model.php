<?php class Material_out_model extends CI_Model{
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
		$d = $this->Material_out_model->manualQuery($t);
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
			$bulan = $this->Material_out_model->getBulan(substr($tgl,5,2));
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
        $limit= 50;
		$offset = 0;
        return $this->db->query("SELECT * FROM QTH_Trace WITH (NOLOCK) WHERE TrcType=2000  ORDER BY SysID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY");
    }
    
    function transaction_detail($id){
        return $this->db->query("SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE DocNum='$id' ORDER BY SysIDDetail DESC");
    }
    function List_Material(){
    return $this->db->query("SELECT * FROM List_Material WITH (NOLOCK) WHERE TrcType='1000' OR TrcType='3000' ORDER BY SysIDDetail ASC"); }
    
    function transaction_detail2($id){
        return $this->db->query("SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE DocNumDetail='$id' ORDER BY SysIDDetail DESC");
    }
    
    function MasterList(){
        return $this->db->query("SELECT * FROM Master_BOM WITH (NOLOCK) WHERE IsActiveDetail=1 AND PartTypeID LIKE '%RM%' ORDER BY SysID ASC");
    }
    
    function Stock_List(){
        return $this->db->query("SELECT * FROM RM_Stock WITH (NOLOCK) WHERE CustName LIKE '%SONY%' ORDER BY SysID2 ASC");
    }
    
    
    function transaction_detail_report($DocDateReport_1,$DocDateReport_2,$IDCust,$DocNum){
    $where = " WHERE DocDate BETWEEN '$DocDateReport_1' AND '$DocDateReport_2' AND TrcType=2000";
    if(empty($DocNum)){
	if($IDCust!='semua'){
    $where .= "AND IDCust='$IDCust' "; }
	}else{
	if($IDCust!='semua'){
    $where .= "AND PartNo LIKE '%$DocNum%' AND IDCust='$IDCust'";
    }else{
    $where .= "AND PartNo LIKE '%$DocNum%'" ; }
    } 
   
	$text = "SELECT * FROM QTD_Trace $where ORDER BY DocDate,DocTime ASC ";
    return $this->db->query($text);
    }
    
    function cekId($kode){
        $this->db->where("idcoment",$kode);
        return $this->db->get("D_Comment");
    }
    
    function update($id,$info){
        $this->db->where("idcoment",$id);
        $this->db->update("D_Comment",$info);
    }
    
    
    function simpan($id){
        $this->db->insert($this->table,$jenis);
        return $this->db->insert_id();
    }        
    
       
    
    function hapus($kode){
        $this->db->where("idcoment",$kode);
        $this->db->delete("forums");
    }
    
}