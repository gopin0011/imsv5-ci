<?php
class app_user extends CI_Model{
    private $table="M_UserG5";

function cek($username,$password){
        $this->db->where("UserName",$username);
        $this->db->where("Password",$password);
        return $this->db->get("QM_UserG5");
    }
    function CekProfile($username){
        $this->db->where("UserName",$username);
        return $this->db->get("M_UserG5");
    }
    function cek2($username,$password){
        $this->db->where("UserName",$username);
        $this->db->where("PasswordX",$password);
        return $this->db->get("M_UserG5");
    }
    
    function semua(){
        return $this->db->get("M_UserG5");
    }
    
public function TotalUser($id){
		$t = "SELECT SysID FROM M_UserG5 WHERE IsActive='$id'";
		$d = $this->db->query($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

    function list_user(){
        $this->db->where("IsActive",'1');
        return $this->db->get("M_UserG5");
    }
    
    function cekKode($kode){
        $this->db->where("UserName",$kode);
        return $this->db->get("M_UserG5");
    }
    
    function cekId($kode){
        $this->db->where("SysID",$kode);
        return $this->db->get("M_UserG5");
    }
    
    function update($id,$info){
        $this->db->where("SysID",$id);
        $this->db->update("M_UserG5",$info);
    }
    
    function simpan($info){
        $this->db->insert("M_UserG5",$info);
    }
    
    function hapus($kode){
        $this->db->where("SysID",$kode);
        $this->db->delete("M_UserG5");
    }
        
}