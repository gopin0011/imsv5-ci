<?php
class m_tracer extends CI_Model{
    private $table="T500_Node";
    private $primary="C050_DocNum";
    
    
    function manualQuery($q)
	{
		return $this->db->query($q);
	}
    
    public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->m_tracer->getBulan(substr($tgl,5,2));
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
    

    function trace($Code){
        $this->db->like("DocNum",$Code);
        return $this->db->get("TraceTransG5");
    }
    
        
     public function StatusDocName($TrcTypeID,$Month,$SysID,$Rev){
		$t = "SELECT * FROM T500_Node WHERE C010_TrcTypeID='$TrcTypeID' AND 
        C011_Month='$Month' AND C000_SysID='$SysID' AND C050_Rev='$Rev'";
		$d = $this->m_tracer->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->C013_DraftReadyApprCancel;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    public function PartnerName($id){
		$t = "SELECT * FROM T010_Partner WHERE SysID='$id'";
		$d = $this->m_tracer->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->PartnerCode;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    public function TrcTypeName($id){
		$t = "SELECT * FROM TG5_DocType WHERE SysID='$id'";
		$d = $this->m_tracer->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->ObjTitle;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    
}