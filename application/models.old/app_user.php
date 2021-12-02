<?php
class app_user extends CI_Model{
    private $table="M_User";
    
    
    function cek($username,$password){
        $this->db->where("username",$username);
        $this->db->where("password",$password);
        return $this->db->get("IMSUser");
    }
    function CekProfile($username){
        $this->db->where("username",$username);
        return $this->db->get("IMSUser");
    }
    function cek2($username,$password){
        $this->db->where("username",$username);
        $this->db->where("password2",$password);
        return $this->db->get("IMSUser");
    }
    
    function semua(){
        return $this->db->get("M_User");
    }
    
    public function TotalUser($id){
		$t = "SELECT RegID FROM M_User WHERE blokir='$id' AND IsStoreRoom=NULL AND IsDelete='X'";
		$d = $this->db->query($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function TotalUserTR($id){
		$t = "SELECT RegID FROM M_User WHERE blokir='$id' AND IsStoreRoom='1' AND IsDelete='X'";
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
        $this->db->where("IsStoreRoom",NULL);
        $this->db->where("IsDelete",'X');
        return $this->db->get("IMSUser");
    }
    
    function cekKode($kode){
        $this->db->where("username",$kode);
        return $this->db->get("M_User");
    }
    
    function cekId($kode){
        $this->db->where("RegID",$kode);
        return $this->db->get("IMSUser");
    }
    
    function update($id,$info){
        $this->db->where("RegID",$id);
        $this->db->update("M_User",$info);
    }
    
    function simpan($info){
        $this->db->insert("M_User",$info);
    }
    
    function hapus($kode){
        $this->db->where("RegID",$kode);
        $this->db->delete("M_User");
    }
    
        public function InfoMasterUser(){
			$kode = $this->input->post('kode');
			$text = "SELECT * FROM IMSUser WHERE RegID='$kode' AND IsDelete='X'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){    
				$data['code']               = $t->Code ;
				$data['username']               = $t->username;
                $data['nama_lengkap']         = $t->nama_lengkap;
                $data['IDLevel']               = $t->IDLevel;
                $data['level']               = $t->level;
                $data['id_dept']            = $t->id_dept;
                $data['dept']            = $t->dept;
                $data['IDBlokir']            = $t->IDBlokir ;
                $data['Blokir']            = $t->Blokir ;
                
                $data['MUser']            = $t->MUser ;
                $data['MUserIMS']            = $t->MUserIMS ;
                $data['MUserTR']            = $t->MUserTR ;
                $data['MProdMaterial']            = $t->MProdMaterial ;
                $data['MProdStamping']            = $t->MProdStamping ;
                $data['MProdWelding']            = $t->MProdWelding ;
                $data['MProdDelivery']            = $t->MProdDelivery ;
                $data['MProdStoreRoom']            = $t->MProdStoreRoom ;
                $data['MPartner']            = $t->MPartner ;
                $data['MCategory']            = $t->MCategory ;
                $data['MUnit']            = $t->MUnit ;
                $data['MProdICT']            = $t->MProdICT ;
                $data['MProdGA']            = $t->MProdGA ;
                $data['MProdMTNM']            = $t->MProdMTNM ;
                $data['MProdMTNT']            = $t->MProdMTNT ;
                $data['MCust']            = $t->MCust ;
                $data['MProduct']            = $t->MProduct ;
                $data['MUtility']            = $t->MUtility ;
                
                $data['TrcMaterial']            = $t->TrcMaterial ;
                $data['TrcStamping']            = $t->TrcStamping ;
                $data['TrcWelding']            = $t->TrcWelding ;
                $data['TrcWH']            = $t->TrcWH ;
                $data['TrcStoreRoom']            = $t->TrcStoreRoom ;
                $data['TrcGA']            = $t->TrcGA ;
                $data['TrcMTC']            = $t->TrcMTC ;
                $data['CanEditMaster']            = $t->CanEditMaster ;
                $data['TrcICT']            = $t->TrcICT ;
                $data['TrcGA']              = $t->TrcGA ;
                $data['TrcMTNM']            = $t->TrcMTNM ;
                $data['TrcMTNT']            = $t->TrcMTNT ;
                $data['CanEditDoc']            = $t->CanEditDoc ;
                $data['CanEditMaster']            = $t->CanEditMaster ;
				$data['CanEditDocAdmin']            = $t->CanEditDocAdmin ;
                $data['TrcWIP']            = $t->TrcWIP ;
                     
					echo json_encode($data);
				}
			}else{ 
                $data['RegID']               = '' ; 
                $data['username']            = '' ;
                $data['nama_lengkap']        = '' ;
                $data['id_level']            = '' ;
                $data['level']               = '' ;
                $data['id_dept']             = '' ;
                $data['dept']                = '' ;
                $data['IDBlokir']            = '' ;
                $data['blokir']              = '' ;
                
                $data['MUser']               = '' ;
                $data['MUserIMS']            = '' ;
                $data['MUserTR']             = '' ;
                $data['MProdMaterial']       = '' ;
                $data['MProdStamping']       = '' ;
                $data['MProdWelding']        = '' ;
                $data['MProdDelivery']       = '' ;
                $data['MProdStoreRoom']      = '' ;
                $data['MPartner']            = '' ;
                $data['MCategory']           = '' ;
                $data['MUnit']               = '' ;
                $data['MProdICT']            = '' ;
                $data['MProdGA']             = '' ;
                $data['MProdMTNM']           = '' ;
                $data['MProdMTNT']           = '' ;
                $data['MCust']               = '' ;
                $data['MProduct']            = '' ;
                $data['MUtility']            = '' ;
                
                $data['TrcMaterial']         = '' ;
                $data['TrcStamping']         = '' ;
                $data['TrcWelding']          = '' ;
                $data['TrcWH']               = '' ;
                $data['TrcStoreRoom']        = '' ;
                $data['TrcGA']               = '' ;
                $data['TrcMTC']              = '' ;
                $data['CanEditMaster']       = '' ;
                $data['TrcICT']              = '' ;
                $data['TrcGA']               = '' ;
                $data['TrcMTNM']             = '' ;
                $data['TrcMTNT']             = '' ;
                $data['CanEditDoc']          = '' ;
                $data['CanEditMaster']       = '' ;
                $data['TrcWIP']              = '' ;
				echo json_encode($data);
			} }
    
}