<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.style4 {font-size: 14px}
.style5 {font-size: 10px}
.style6 {font-size: 12px}
.style7 {font-size: 12px}
.style9 {font-size: 12%}
.style11 {font-size: 36%}
.table { 
    float: top;
    margin-bottom: 2cm;
}
.style13 {font-size: 36px}
.style15 {font-size: 12px; font-weight: bold; }
.style16 {
	font-size: 18px;
	font-weight: bold;
}
.style17 {font-size: 22px}
.style20 {font-size: 16px}


.style21 {
	font-family: Arial, Helvetica, sans-serif;
	font-weight: bold;
}
.style22 {font-family: Arial, Helvetica, sans-serif}
.style29 {font-size: 16px; font-family: Arial, Helvetica, sans-serif; }
.style32 {font-size: medium}
-->
</style>
</head>

<body>

<?php
$no=0;

foreach($data as $db):  
$no++;
        $total =  $db->QtyMat;
        $kodeinput_mpc =  $db->DocNum;
        $id =  $db->DocNumDetail;
        $nosj =  $db->SJNum;
        $part_no =  $db->PartNo;
        $part_name =  $db->PartName;
        $jmlinput_mpc =  $db->BalPcs;
        $tgl = $this->app_model->tgl_indo($db->DocDate);
        $jml = $db->QtyPcs;
        $supp = $db->partner_name;
        $cust = $db->Code;
        $MaterialType = $db->MaterialType ;
        
        $pcs_kg = number_format($db->PcsPerKg,4);
        if($MaterialType==1){
            $UOM = $pcs_kg ;
        } ;
        
        $pcs_sheet = number_format($db->PcsPerSheet,0);
        if($MaterialType==2){
            $UOM = $pcs_sheet;
        } 
        
    
		?>
        
<table class="table" width="912" border="1" cellspacing="0">
  <tr>
    <td colspan="8" rowspan="2"><div align="center" class="style6"><img src="<?php echo base_url();?>assets/images/adw.png" width="250" height="59"></div></td>
    <td colspan="6" rowspan="2"><pre class="style6"><span class="style16">PT SUMMIT ADYAWINSA INDONESIA</span>
Jl. By Pass Pangkal Perjuangan No. 98
Tanjung Mekar Karawang 41316

Phone : (0267) 415 815 </pre></td>
    <td width="99" colspan="3"><div align="center" class="style15">
      <div align="center"><span class="style7"><span class="style9"><span class="style11"><span class="style13"><span class="style6">QTY</span></span></span></span></span></div>
    </div></td>
    <td width="99" colspan="3"><div align="center"><span class="style15">Convertion</span></div></td>
    <td width="99" colspan="3"><div align="center" class="style15">
      <div align="center"><span class="style7"><span class="style9"><span class="style11"><span class="style13"><span class="style6">TOTAL PCS</span></span></span></span></span></div>
    </div></td>
  </tr>
  <tr>
    <td colspan="3"><div align="center"><span class="style17"><?php echo number_format($total); ?></span></div></td>
    <td colspan="3"><div align="center"><span class="style17"><?php echo $UOM ; ?></div></td>
    <td colspan="3"><div align="center"><span class="style17"><?php echo number_format($jml); ?></span></div></td>
  </tr>
  <tr>
    <td colspan="14"><div align="center" class="style6">LABEL RAW MATERIAL SIAP PRODUKSI</div></td>
    <td colspan="9" rowspan="6"><div align="center"><span class="style32">

<img src="<?php echo site_url();?>/INMaterial/bikin_barcode/<?php echo $id ;?>" style="width: 280px;">
    
    
    
    </span></div></td>
  </tr>
  <tr>
    <td colspan="7"><span class="style6">TANGGAL MASUK</span></td>
    <td colspan="6" class="style21"><span class="style21"><?php echo $tgl; ?></span></td>
    <td width="110" class="style21"><?php echo $db->DocTime; ?></td>
  </tr>
  <tr>
    <td colspan="7"><span class="style6">NAMA PART </span></td>
    <td colspan="7" class="style21"><?php echo $part_name ; ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><span class="style6">NOMOR PART</span></td>
    <td colspan="6" class="style21"><?php echo $part_no ; ?>&nbsp;</td>
    <td class="style21"><?php echo $cust; ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><span class="style6">SPEC &amp; UKURAN R/M </span></td>
    <td colspan="7" class="style21"><?php echo $db->Spec1; ?>&nbsp;<?php echo $db->Spec2; ?></td>
  </tr>
  <tr>
    <td colspan="7"><span class="style6">SUPPLIER MATERIAL </span></td>
    <td colspan="7" class="style21"><?php echo $supp ; ?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="7"><span class="style6">NO COIL </span></td>
    <td colspan="7" class="style21"><?php echo $db->MatNum; ?>&nbsp;</td>
    <td colspan="4"><span class="style21"><?php echo $db->DocNumDetail ; ?></span></td>
    <td colspan="5" class="style21"><?php echo $db->CreateBy; ?>&nbsp;</td>
  </tr>
  <tr><span>
  SAI/RC/PPIC/03/01</span>
  </tr>
<br />
<br />

</table>


  
<?php endforeach;?>




    


<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>
</body></html>