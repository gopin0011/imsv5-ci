<?php
class forums extends CI_Model{
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
    
    	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
    
    function forums(){
        $offset = 0 ;
        $limit = 10 ;
        return $this->db->query("SELECT * FROM D_Comment WHERE idcoment_detail IS NULL ORDER BY idcoment DESC OFFSET $offset ROWS FETCH NEXT $limit ROWS ONLY");
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
    
    public function CariJumlahComent($id){
        $t = "SELECT * FROM D_Comment WHERE idcoment='$id'";
		$d = $this->forums->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->QtyComent;
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

function ViewComment($id){
 return $this->db->query("SELECT * FROM D_Comment Where idcoment_detail='$id'");
 }
        

 
}