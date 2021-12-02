<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style1 {
	font-weight: bold;
	font-size: 9px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
}
.style2 {font-size: 9}
.style4 {font-weight: bold; font-size: 9; }
.style5 {
	font-size: 16px;
	font-family: Geneva, Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style6 {font-family: Geneva, Arial, Helvetica, sans-serif}
.style7 {font-weight: bold; font-size: 9; font-family: Geneva, Arial, Helvetica, sans-serif; }
.style9 {font-family: Geneva, Arial, Helvetica, sans-serif; font-weight: bold; }
.style10 {font-weight: bold}
.space {margin-top: 100px;}
-->
</style>
</head>

<body>

<?php
$no=0;

foreach($data as $row):  
$no++;
$total =  $row->QtyMat ;
 $kodeoutput_bprm =  $row->DocNumDetail;
 $bprmno =  $row->DocNum;
 $kode_id_material =  $row->SourceDocNum ;
 $part_no =  $row->PartNo;
 $MaterialType = $row->MaterialType ;
 $pcs_kg = number_format($row->PcsPerKg,4);
 if($MaterialType==1){ $UOM = $pcs_kg ; } ;
 $pcs_sheet = number_format($row->PcsPerSheet,0);
 if($MaterialType==2){ $UOM = $pcs_sheet; } ;
 $part_name =  $row->PartName;
 $jmloutput =  ($row->QtyPcs);
 $cust = $row->Code;
 $tgl = $this->app_model->tgl_indo($row->DocDate);
 $ng = $row->NGMatSheet + $row->NGMatCoil;
 $total_keluar = $total + $ng  ;
 ?>
        
<table width="1000" border="1" cellpadding="3" cellspacing="0">
  <tr>
    <td colspan="3"><div align="center" class="style6"><img src="<?php echo base_url();?>assets/images/adw.png" width="250" height="64"></div></td>
    <td colspan="12"><div align="center" class="style6">
      <h4>FORM BUKTI SERAH TERIMA MATERIAL </h4>
    </div>      <div align="center" class="style6"></div>      
    <div align="center" class="style6">Inventory Raw Material - Production </div></td>
  </tr>
  <tr class="style6">
    <td colspan="3"><div align="center" class="style6"></div>      
        <div align="center" class="style6">SPEC</div>
    <span class="style9"></span></div>          
     </td>
    <td colspan="12"><div align="center">PART</div></td>
  </tr>
  <tr class="style6">
    <td colspan="3" rowspan="2"><div align="center" class="style9"></div>      
    <div align="center" class="style9"><?php echo $row->Spec1; ?> <?php echo $row->Spec2; ?></div>      
    <div align="center" class="style9"></div>      
     </td>
    <td colspan="12"><div align="center" class="style9"><?php echo $part_no ; ?></div></td>
  </tr>
  <tr>
    <td colspan="12"><div align="center" class="style9"><?php echo $part_name ; ?></div></td>
  </tr>
  <tr class="style6" height="15">
    <td width="100" class="style2" height="15"><div align="center" class="style9" height="15">
            <div align="center" height="15">
                    <pre>QTY</pre>
        </div>
    </div></td>
    <td width="100" class="style2" height="15"><div align="center" class="style9" height="15">
            <div align="center" height="15">
                    <pre>PCS/UNIT</pre>
        </div>
    </div></td>
    <td width="100" class="style2" height="15"><div align="center" class="style9" height="15">
          <div align="center" height="15">
                <pre>TOTAL</pre>
        </div>
    </div></td>
    <td width="300" rowspan="3"><div align="center" class="style9"><img src="<?php echo site_url();?>/OUTMaterial/bikin_barcode/<?php echo $kodeoutput_bprm ;?>" style="width: 280px;"></div>    
    <td width="366" colspan="10" height="15"><div align="center" class="style6">PETUGAS</div>            
    <div align="center" class="style9"></div></td>
  </tr>
  <tr class="style6">
    <td rowspan="2"><div align="center" class="style9"><?php echo number_format($total) ; ?></div></td>
    <td rowspan="2"><div align="center" class="style9"><?php echo $UOM ; ?></div></td>
    <td rowspan="2"><div align="center" class="style9"><?php echo number_format($jmloutput,0) ; ?></div></td>
    <td colspan="10" height="20" ><div align="center" class="style9"><?php echo $row->CreateBy; ?></div>   </tr>
  <tr>
    <td colspan="10" height="15"><div align="center" class="style6">PENERIMA</div>   
    </tr>
  <tr>
  <td colspan="3"><div align="center" class="style6"></div>           
     <div align="center" class="style6"></div>      
      <div align="center" class="style6">
        <div align="left">NG RM : <strong><?php echo $ng ; ?></strong> / Total : <strong><?php echo $total_keluar ; ?></strong></div>
    </div></td>
    
    <td colspan="1"><div align="center" class="style6"></div>           
     <div align="center" class="style6"></div>      
      <div align="center" class="style6">
        <div align="left"><?php echo $row->DocTime; ?> / <?php echo $tgl ; ?></div>
    </div></td>
    <td colspan="10" height="20">
    <div align="center" class="style6"></div>      
    </td>
  </tr>
  
   <tr>
   <div class="style7">
        <div align="left">SAI/RC/PPIC/03/04</div>
    </div>
  </tr></table>
<div class="space"></div>


  
<?php endforeach;?>




    


<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>
</body></html>