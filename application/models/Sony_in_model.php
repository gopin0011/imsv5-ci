<?php
class Sony_in_model extends CI_Model{
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
		$d = $this->Sony_in_model->manualQuery($t);
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
			$bulan = $this->Sony_in_model->getBulan(substr($tgl,5,2));
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
        return $this->db->query("SELECT * FROM QTH_Trace WITH (NOLOCK) WHERE TrcType=10  ORDER BY SysID DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY");
    }
    
    function transaction_detail($id){
        return $this->db->query("SELECT * FROM QTD_Trace WITH (NOLOCK) WHERE DocNum='$id' ORDER BY SysIDDetail DESC");
    }
    
    function Stock_List(){
        return $this->db->query("SELECT * FROM RM_Stock WITH (NOLOCK) WHERE CustName LIKE '%SONY%' ORDER BY SysID2 ASC");
    }
    
    
    function transaction_detail_report($DocDateReport_1, $DocDateReport_2, $RefNumReport, $ShiftIDReport){
    $where = "WHERE DocDate BETWEEN '$DocDateReport_1' AND '$DocDateReport_2' AND TrcType=10 ";
    if(empty($RefNumReport)){
	if($ShiftIDReport!='ALL'){
	$where .= "AND ShiftID='$ShiftIDReport'";
    }
    }else{
    if($ShiftIDReport!='ALL'){
	$where .= "AND ShiftID='$ShiftIDReport' AND DocNum_Ext LIKE '%$RefNumReport%'";
    }else{
    $where .= "AND DocNum_Ext LIKE '%$RefNumReport%'";  } } 
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
    
    public function CariJumlahLike($id){
        $t = "SELECT * FROM D_Comment WHERE idcoment='$id'";
		$d = $this->forums->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->LikeCom;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}        
    
    function hapus($kode){
        $this->db->where("idcoment",$kode);
        $this->db->delete("forums");
    }
    
}