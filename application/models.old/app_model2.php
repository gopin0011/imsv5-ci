<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model {

	/**
	 * @author : Aji
	 
	 **/

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
    
    
    	public function CariLevel($id){
		$t = "SELECT * FROM M_Level WHERE level='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->level;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    	public function CariStockWIP2($id){
		$t = "SELECT * FROM M_Product WHERE RegID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->StockWIP2;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    	public function CariStockFG($id){
		$t = "SELECT * FROM M_Product WHERE RegID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->StockFG;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    public function GTProdTime($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = $h->GTProdTime;
        if($hasil2==0){$hasil='-' ;}else{$hasil = number_format($hasil2/60,2) ;} }
		}else{ $hasil = ''; } return $hasil; }
  
  public function GTStrokePlan($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->GTStrokePlan);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function GTStroke($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->GTStroke);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function NGScrap($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->NGScrap);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
    public function NGRepair($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->NGRepair);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}  }
		}else{ $hasil = ''; } return $hasil; }
        
  public function OverTimePlan($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = $h->OverTimePlan ;
        if($hasil2==0){$hasil='-' ;}else{$hasil = number_format($hasil2/60,2) ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function OverTime($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = $h->OverTime ;
        if($hasil2==0){$hasil='-' ;}else{$hasil = number_format($hasil2/60,2) ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function GSPH($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->GSPH);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function NSPH($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->NSPH);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function MB($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->MB);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
   public function LimaS($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->LimaS);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
    public function PM($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->PM);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function TR($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->TR);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function DC($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->DC);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function MC($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->MC);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function MBD($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->MBD);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function DB($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->DB);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function EB($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->EB);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function QC($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->QC); 
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}}
		}else{ $hasil = ''; } return $hasil; }
        
  public function FB($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->FB);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function CB($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->CB);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function NIP($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->NIP);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function NSP($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->NSP);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function MP($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->MP);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function UT($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->UT);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function UM($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->UM);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
  public function ACC($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil2 = number_format($h->ACC);
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;} }
		}else{ $hasil = ''; } return $hasil; }
        
 
        
  public function GTPLanStop($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil = number_format($h->GTPLanStop); }
		}else{ $hasil = ''; } return $hasil; }
        
  public function GTDownTime($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil = number_format($h->GTDownTime); }
		}else{ $hasil = ''; } return $hasil; }
        
    public function GTLossTime($Date,$Machine,$Shift){
		$t = "SELECT * FROM QMonitoringStrokeSTP WHERE DocDate='$Date' AND MachineID='$Machine' AND ShiftID='$Shift'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil = number_format($h->GTLossTime); }
		}else{ $hasil = ''; } return $hasil; }
        
  public function CariTotalProdTime($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(GTProdTime) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = $h->jml ; 
        if($hasil2==0){$hasil='-' ;}else{$hasil = number_format($hasil2/60,2) ;}
        } }else{ $hasil = 0; } return $hasil; }
    
    
    public function CariTotalStrokePlan($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(GTStrokePlan) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; 
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalStroke($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(GTStroke) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; 
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalNGScrap($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(NGScrap) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; 
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
    public function CariTotalNGRepair($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(NGRepair) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; 
        if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalOverTime($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(OverTime) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = $h->jml ;
        if($hasil2==0){$hasil='-' ;}else{$hasil = number_format($hasil2/60,2) ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalOverTimePlan($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(OverTimePlan) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = $h->jml ;
        if($hasil2==0){$hasil='-' ;}else{$hasil = number_format($hasil2/60,2) ;} } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalGSPH($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, AVG(GSPH) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalNSPH($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, AVG(NSPH) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
    public function CariTotalMB($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(MB) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
    public function CariTotalLimaS($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(LimaS) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; } 
        
     public function CariTotalPM($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(PM) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
     public function CariTotalTR($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(TR) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
    public function CariTotalDC($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(DC) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalMC($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(MC) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalMBD($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(MBD) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalDB($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(DB) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalEB($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(EB) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalQC($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(QC) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalFB($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(FB) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalCB($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(CB) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalNIP($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(NIP) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalNSP($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(NSP) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalMP($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(MP) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalUT($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(UT) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalUM($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(UM) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
        
  public function CariTotalACC($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(ACC) as jml
                FROM QMonitoringStrokeSTP
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){ foreach($d->result() as $h){
		$hasil2 = number_format($h->jml) ; if($hasil2==0){$hasil='-' ;}else{$hasil = $hasil2 ;}
        } }else{ $hasil = 0; } return $hasil; }
  

        public function QtyStrokeMachine($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT RegID,SUM(QtyStroke) as jml
				FROM QStrokeMachine
				WHERE RegID='$kode' 
				AND (DocDate BETWEEN '$tgl_awal' AND '$tgl_akhir')
				GROUP BY RegID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil = $h->jml; }
		}else{ $hasil = 0; } return $hasil; }
        
        public function QtyStrokeDies($kode,$ProsesD,$tgl_awal,$tgl_akhir){
		$t = "SELECT RegIDMc,SUM(QtyStroke) as jml
				FROM QTD_Production
				WHERE ItemID='$kode' AND ProsesD='$ProsesD'
				AND (DocDate BETWEEN '$tgl_awal' AND '$tgl_akhir')
				GROUP BY RegIDMc";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		foreach($d->result() as $h){
		$hasil = $h->jml; }
		}else{ $hasil = 0; } return $hasil; }
        
    
    	public function CariStockWIP($id){
		$t = "SELECT * FROM M_Product WHERE RegID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->StockWip;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    
    	public function total_cust_item($id){
		$t = "SELECT IDCust FROM MonitoringRM WHERE IDCust='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
        
        public function cari_percent_danger($id){
		$t = "SELECT hari FROM MonitoringRM WHERE (hari BETWEEN 0 AND 0.99) AND IDCust='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function cari_percent_warning($id){
		$t = "SELECT hari FROM MonitoringRM WHERE (hari BETWEEN 1 AND 2.999) AND IDCust='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function cari_percent_safe($id){
        
		$t = "SELECT hari FROM MonitoringRM WHERE (hari BETWEEN 3 AND 6.99) AND IDCust='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function cari_percent_warning_up($id){
		$t = "SELECT hari FROM MonitoringRM WHERE (hari BETWEEN 7.01 AND 10) AND IDCust='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function cari_percent_danger_up($id){
		$t = "SELECT hari FROM MonitoringRM WHERE hari > 10.01 AND IDCust='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    
    public function total_cust_item2(){
		$t = "SELECT ItemID FROM MonitoringFG2 ";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	    }
        
        public function cari_percent_danger2(){
		$t = "SELECT hari FROM MonitoringFG2 WHERE (hari BETWEEN 0 AND 0.99)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function cari_percent_warning2(){
		$t = "SELECT hari FROM MonitoringFG2 WHERE (hari BETWEEN 1 AND 1.999)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function cari_percent_safe2(){
		$t = "SELECT hari FROM MonitoringFG2 WHERE (hari BETWEEN 2 AND 3)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function cari_percent_warning_up2(){
		$t = "SELECT hari FROM MonitoringFG2 WHERE (hari BETWEEN 3.01 AND 5)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function cari_percent_danger_up2(){
		$t = "SELECT hari, ItemID FROM MonitoringFG2 WHERE (hari > 5.01)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    
     public function MaxKode_com(){
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(kode_com) as no FROM d_coment";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,5,5))+1;
				$hasil = 'KOM'.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = 'KOM'.'00001';
		}
		return $hasil;
	}
    
    public function CariDepartmentName($id){
		$t = "SELECT * FROM M_Department WHERE id='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->Dept_Name;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    

    
    public function CariCategoryName($id){
		$t = "SELECT * FROM M_Category WHERE id='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->category_name;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    public function CariMachine($id){
		$t = "SELECT * FROM DetailMachine WHERE RegID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->Line .'-'.$h->DetailLine;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    public function CariNamaProduct($id){
		$t = "SELECT * FROM Q01_MProduct WHERE RegID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->PartNo;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    public function CariNamaProduct2($id){
		$t = "SELECT * FROM Q01_MProduct WHERE RegID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->PartName;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    public function CariNamaProduct3($id){
		$t = "SELECT * FROM Q01_MProduct WHERE RegID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->CustName;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    public function CariLineName($id){
		$t = "SELECT * FROM M_Line WHERE IDLine='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->Line;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    public function NextIDCustMonitoringRM($id){
		$t = "SELECT * FROM MonitoringRMListCust WHERE NOMOR='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->RegID;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    public function CariCustName($id){
		$t = "SELECT * FROM M_Customer WHERE RegID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->CustName;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
     public function CariLocation($id){
		$t = "SELECT * FROM M_Location WHERE SysID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->Location;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    
     public function CariPartnerName($id){
		$t = "SELECT * FROM M_Partner WHERE id='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->partner_name;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
     public function CariProductName($id){
		$t = "SELECT * FROM M_Product WHERE RegID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->PartName;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    
    public function Nama_lengkap($id){
		$t = "SELECT * FROM M_User WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_lengkap;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    	public function ItemMMaterial($id,$id2){
		$t = "SELECT RegID FROM M_Product WHERE IsMaterial='$id' AND IsActive='1' AND IDCust='$id2'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function ItemMStamping($id,$id2){
		$t = "SELECT RegID FROM M_Product WHERE IsStamping='$id' AND IsActive='1' AND IDCust='$id2'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function ItemMWelding($id,$id2){
		$t = "SELECT RegID FROM M_Product WHERE IsWelding='$id' AND IsActive='1' AND IDCust='$id2'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function ItemMDelivery($id){
		$t = "SELECT RegID FROM M_Product WHERE IsDelivery='$id' AND IsActive='1'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function ItemMStoreRoom($id,$id2){
   $CategoryID = "" ;
   if($id2!='All'){$CategoryID .= "AND IDCategory='$id2'" ; }else{$CategoryID .= "" ; }
		$t = "SELECT RegID FROM M_Product WHERE IsStoreRoom='$id' AND IsActive='1' $CategoryID ";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
     public function ItemMICT($id){
		$t = "SELECT RegID FROM M_Product WHERE IsICT='$id' AND IsActive='1'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
     public function ItemMMTNM($id){
		$t = "SELECT RegID FROM M_Product WHERE IsMTNM='$id' AND IsActive='1'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function ItemMMTNT($id){
		$t = "SELECT RegID FROM M_Product WHERE IsMTNT='$id' AND IsActive='1'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function ItemMGA($id,$id2){
$CategoryID = "" ;
   if($id2!='All'){$CategoryID .= "AND IDCategory='$id2'" ; }else{$CategoryID .= "" ; }
		$t = "SELECT RegID FROM M_Product WHERE IsGA='$id' AND IsActive='1' $CategoryID ";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function TotalUser($id,$id2){
   $DeptID = "" ;
   if($id2!='All'){$DeptID .= "AND id_dept='$id2'" ; }else{$DeptID .= "" ; }
        $t = "SELECT RegID FROM M_User WHERE blokir='$id' AND IsStoreRoom IS NULL AND IsDelete='X' $DeptID ";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function TotalCategory(){
		$t = "SELECT count(id) as jml FROM M_Category WHERE IsDelete='X'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		  foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function TotalItemMAsset($LocationIDView,$DeptIDView){
 $where = "WHERE IsActive=1" ;
 if(empty($DeptIDView)){
 if($LocationIDView!='All'){
 $where .= "AND LocationID='$LocationIDView'" ; }else{
 $where .= "";
 } }else{
 if($LocationIDView!='All'){
 $where .= "AND id_dept='$DeptIDView' AND LocationID='$LocationIDView'";  
 }else{
 $where .= "AND id_dept='$DeptIDView'";   
 }  }
 $t = "SELECT count(SysID) as jml FROM QMaster_Asset $where ";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		  foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function TotalUnit(){
		$t = "SELECT count(id) as jml FROM M_Unit WHERE IsDelete='X' ";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		  foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
     public function TotalPartner(){
		$t = "SELECT count(id) as jml FROM M_Partner WHERE IsDelete='X'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		  foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
     public function TotalMaterialInMPC($kode){
		$t = "SELECT count(DocNum) as jml FROM TD_RawMaterial Where DocNum='$kode'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		  foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}    
    
     public function TotalCust(){
		$t = "SELECT count(RegID) as jml FROM M_Customer WHERE IsDelete='X'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
		  foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function TotalUserTR($id,$id2){
        $DeptID = "" ;
   if($id2!='All'){$DeptID .= "AND id_dept='$id2'" ; }else{$DeptID .= "" ; }
		$t = "SELECT RegID FROM M_User WHERE blokir='$id' AND IsStoreRoom='1' AND IsDelete='X' $DeptID ";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			$hasil = $r;
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
     public function DocNumOutSTP_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="STP".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,9,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialRetMPC_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="RET".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,9,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialOUTMPC_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="BSTM".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,10,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumOutSTP(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="STP".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,9,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
 
  public function DocNumOutWeld(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="NP".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,8,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialOUTMPC(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="BSTM".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,10,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
      public function DocNumMaterialRetMPC(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="RET".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,9,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function CariJumlahLike($id){
        $t = "SELECT * FROM D_Comment WHERE idcoment='$id'";
		$d = $this->app_model->manualQuery($t);
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
    
    public function CariJumlahChild($id){
        $kode = $id.'-' ;
        $t = "SELECT count(LinkID) AS jml FROM BOM2 WHERE SysID LIKE '%$kode%'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}      
    
     public function CariJumlahItemNo($id){
        $t = "SELECT max(ItemNoSub) AS jml FROM BOM2 WHERE LinkID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}       
    
    
    public function CariNoUrut($id){
        $t = "SELECT count(LinkID) AS jml FROM BOM2 WHERE LinkID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}    
    
    
     public function DocNumDetailOutSTP($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_Production WHERE DocNumDetail LIKE '%$id%' " ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,12,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
     public function DocNumDetailOutWELD($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_Production WHERE DocNumDetail LIKE '%$id%' " ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,11,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumDetailMaterialOUTMPC($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '%$id%' " ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,13,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    
    public function DocNumDetailMaterialRetMPC($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '%$id%' " ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,12,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialINMTNM(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="INMTNM".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,12,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
     public function DocNumMaterialINMTNT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="INMTNT".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,12,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialINGA(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="IN-GA-".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,12,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    
    public function DocNumMaterialINRMOther(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="INTR".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,10,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
      public function DocNumMaterialOUTMTNM(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="OUTMTNM".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,13,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialOUTMTNT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="OUTMTNT".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,13,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialOUTRMOther(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="OUTTR".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,11,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialOUTGA(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="OUT-GA".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,12,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    public function CariIDPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM M_User WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->RegID;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    
    
    public function ImageRev($id){
		$t = "SELECT * FROM M_Asset WHERE ItemID='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->ImageRev;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    
    public function CariNamaPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM M_User WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->nama_lengkap;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    public function CariFFPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM M_User WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->foto;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialOUTWip(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="OUT".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,10,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}      
    
    
    
    public function DocNumMaterialINWip(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="WIP".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,10,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}            
    
    
    
    public function DocNumMaterialINFinishGood(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="BPFG".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,10,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    public function DocNumMaterialOutFinishGood(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="DELI".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,10,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumAsset(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="SAI-ASSET".date('ym');
		$text = "select max(ItemID) as last from M_Asset WHERE ItemID LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,13,4);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%04s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
     public function DocNumBOM(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="SAI".date('y');
		$text = "select max(SysID) as last from BOM1 WHERE SysID LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,5,5);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%05s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    public function ItemNoBOM($Cust){
		$text = "select max(ItemNo) as last from BOM1 WHERE IDCust='$Cust' AND IsDelete='0'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $nextNoUrut=$lastNoINS+1;
				$hasil = $nextNoUrut;
			}
		}else{
			$hasil = $nextNoUrut ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialINMPC(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="INM".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,9,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    public function DocNumMaterialOUTTR_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="OUTTR".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,11,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialOUTGA_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="OUT-GA".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,13,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
     public function DocNumMaterialOUTMTNM_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="OUTMTNM".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,13,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    
    
     public function DocNumMaterialOUTMTNT_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="OUTMTNT".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,13,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
     public function DocNumMaterialINGA_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="IN-GA-".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,12,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialINTR_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="INTR".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,10,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
     public function DocNumMaterialINMTNT_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="INMTNT".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,12,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
     public function DocNumMaterialINMTNM_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="INMTNM".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,12,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
      public function DocNumMaterialOUTWip_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="WIP".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,9,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
     public function DocNumMaterialINWip_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="WIP".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,9,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialINFinishGood_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="BPFG".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,10,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumMaterialINMPC_EXT(){
        //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="INM".date('ymd');
		$text = "select max(DocNum) as last from G_DocNumMat WHERE DocNum LIKE '%$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoINS=$t->last;
                $lastNoUrut=substr($lastNoINS,9,3);
                $nextNoUrut=$lastNoUrut;
                $nextNoTransaksi=$today.sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
     public function DocNumDetailMaterialINMTNM(){
         //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="INMTNM".date('ymd');
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,15,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumDetailMaterialINMTNT(){
         //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="INMTNT".date('ymd');
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,15,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
        
    
    public function DocNumDetailMaterialINGA($id){
        $text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '%$id%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,15,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumDetailMaterialINTR($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '%$id%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,13,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumDetailMaterialOUTTR($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '%$id%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,14,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumDetailMaterialOUTGA($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '%$id%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,15,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
      public function DocNumDetailMaterialOUTMTNM(){
         //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="OUTMTNM".date('ymd');
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,16,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    
    
    public function DocNumDetailMaterialOUTMTNT(){
         //Time SERVER,
date_default_timezone_set('Asia/Jakarta');
        $today="OUTMTNT".date('ymd');
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '$today%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,16,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
    public function DocNumDetailMaterialOUTWip($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '%$id%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,12,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi; } }else{ $hasil = $nextNoTransaksi ; }
                return $hasil; }
                
                
    public function DocNumDetailMaterialINWip($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '%$id%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,12,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi; } }else{ $hasil = $nextNoTransaksi ; }
                return $hasil; }
                
     public function DocNumDetailMaterialOutFinishGood($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '%$id%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,13,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi; } }else{ $hasil = $nextNoTransaksi ; }
                return $hasil; }
    
    
    public function DocNumDetailMaterialINFinishGood($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '%$id%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,13,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi; } }else{ $hasil = $nextNoTransaksi ; }
                return $hasil; }
    
    
    
    public function DocNumDetailMaterialINMPC($id){
		$text = "SELECT max(DocNumDetail) as last FROM TD_RawMaterial WHERE DocNumDetail LIKE '%$id%'" ;
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$lastNoIN=$t->last;
                $lastNoUrut=substr($lastNoIN,12,3);
                $nextNoUrut=$lastNoUrut+1;
                $nextNoTransaksi=sprintf('%03s',$nextNoUrut);
				$hasil = $nextNoTransaksi;
			}
		}else{
			$hasil = $nextNoTransaksi ;
		}
		return $hasil;
	}
    
    
     public function QtyMTNM_IN($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=140
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function QtyMTNT_IN($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=120
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function QtyGA_IN($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=130
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function QtyTR_IN($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=110
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function QtyAmountGA_IN($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(Amount) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=130
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function QtyAmount_IN($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(Amount) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=110
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function BPFG($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=600
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function WIP_IN($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=2000
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
     public function FG_IN($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=600
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function WIP_OUT($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=3000
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function FG_OUT($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=700
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function QtyRM_IN($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=100
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
     public function QtyMTNM_OUT($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=240
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function QtyMTNT_OUT($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=220
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
     public function QtyGA_OUT($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=230
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function QtyTR_OUT($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=210
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function QtyAmount_OUT($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(Amount) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=210
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    
     public function QtyAmountGA_OUT($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(Amount) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=230
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
     public function Delivery($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_WareHouse  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    
    public function QtyRM_OUT($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=200
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
      public function QtyRM_RET($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(QtyMat) as jml 
			FROM QTD_RawMaterial  
			WHERE ItemID='$kode' AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."') AND IDTrcType=105
			GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function FindBegBalMatTrc($kode){
		$t = "SELECT DocNumDetail,sum(BalMat) as jml
				FROM TD_RawMaterial
				WHERE DocNumDetail='$kode' 
				GROUP BY DocNumDetail";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
     public function CariJmlinputMTNM_ks1($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(INMat - OUTMat) as jml
				FROM SCMTNM
				WHERE ItemID='$kode' 
				AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function CariJmlinputMTNT_ks1($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(INMat - OUTMat) as jml
				FROM SCMTNT
				WHERE ItemID='$kode' 
				AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function CariJmlinputTR_ks1($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(INMat - OUTMat) as jml
				FROM SCToolRoom
				WHERE ItemID='$kode' 
				AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function CariJmlinputGA_ks1($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(INMat - OUTMat) as jml
				FROM SCGA
				WHERE ItemID='$kode' 
				AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function CariJmlBPFG($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(INMat - OUTMat) as jml
				FROM SCWareHouse
				WHERE ItemID='$kode' 
				AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    	public function CariJmlinput_ks1($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(INMat - OUTMat) as jml
				FROM SCRawMaterial
				WHERE ItemID='$kode' 
				AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    	public function CariTotalProduksi($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(Qty) as jml
                FROM QTD_Production
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn' AND Status='FG'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function CariTotalNGProduksi($bln,$thn){
		$t = "SELECT MONTH(DocDate) as bln, YEAR(DocDate) as th, SUM(NG) as jml
                FROM QTD_Production
                WHERE MONTH(DocDate) = '$bln' AND YEAR(DocDate) = '$thn' AND Status='FG'
                GROUP BY MONTH(DocDate),YEAR(DocDate)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    
    	public function CariJmlinput_FG($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(INMat - OUTMat) as jml
				FROM SCFG
				WHERE ItemID='$kode' 
				AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    	public function CariJmlinput_WIP($kode,$tgl_awal,$tgl_akhir){
		$t = "SELECT ItemID,sum(INMat - OUTMat) as jml
				FROM SCWip
				WHERE ItemID='$kode' 
				AND (DocDate BETWEEN '".$tgl_awal."' AND '".$tgl_akhir."')
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    

  	public function CariFotoPengguna(){
		$id = $this->session->userdata('username');
		$t = "SELECT * FROM M_User WHERE username='$id'";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->foto;
			}
		}else{
			$hasil = '';
		}
		return $hasil;
	}
    
    
     public function MTNMStock($kode){
		$t = "SELECT ItemID,sum(BalMat) as jml
				FROM MTNMStock
				WHERE ItemID='$kode' 
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function MTNTStock($kode){
		$t = "SELECT ItemID,sum(BalMat) as jml
				FROM MTNTStock
				WHERE ItemID='$kode' 
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function TRStock($kode){
		$t = "SELECT ItemID,sum(BalMat) as jml
				FROM StockTR
				WHERE ItemID='$kode' 
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function GAStock($kode){
		$t = "SELECT ItemID,sum(BalMat) as jml
				FROM StockGA
				WHERE ItemID='$kode' 
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    	public function RMStock($kode){
		$t = "SELECT ItemID,sum(BalMat) as jml
				FROM RMStock
				WHERE ItemID='$kode' 
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    public function FGStock($kode){
		$t = "SELECT ItemID,sum(StockFG) as jml
				FROM FGStock
				WHERE ItemID='$kode' 
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    public function WIPStock($kode){
		$t = "SELECT ItemID,sum(StockWIP2) as jml
				FROM WIPStock
				WHERE ItemID='$kode' 
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
    
    	public function WareHouseStock($kode){
		$t = "SELECT ItemID,sum(Stock) as jml
				FROM WareHouseStock
				WHERE ItemID='$kode' 
				GROUP BY ItemID";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
    
   
    	
	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->app_model->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $hasil;
	}
	
	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->app_model->getBulan(substr($tgl,5,2));
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
    
   
	
	public function hari_ini($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		//$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
	
    

    
    
    
    
    
    
    
    
    
    
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */