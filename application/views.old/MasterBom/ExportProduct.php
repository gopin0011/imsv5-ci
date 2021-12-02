<style type="text/css">
*{
font-family: Arial;
margin:0px;
padding:0px;
}
@page {
 margin-left:3cm 2cm 2cm 2cm;
}
table.grid{
width:20.99cm ;
font-size: 12px;
border-collapse:collapse;
}
table.grid th{
	padding:5px;
}
table.grid th{
background: #F0F0F0;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
text-align:center;
border:1px solid #000;
}
table.grid tr td{
	padding:2px;
	border-bottom:0.2mm solid #000;
	border:1px solid #000;
}
h1{
font-size: 18px;
}
h2{
font-size: 14px;
}
h3{
font-size: 12px;
}
p {
font-size: 10px;
}
center {
	padding:8px;
}
.atas{
display: block;
width:20.99cm ;
margin:0px;
padding:0px;
}
.kanan tr td{
	font-size:12px;
}
.attr{
font-size:9pt;
width: 100%;
padding-top:2pt;
padding-bottom:2pt;
border-top: 0.2mm solid #000;
border-bottom: 0.2mm solid #000;
}
.pagebreak {
width:20.99cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
width:20.99cm ;
font-size:13px;
}
.page {
width:20.99cm ;
font-size:12px;
padding:10px;
}

</style>


<?php
if($num >0){
$kanan = "<table class='kanan' width='100%'>
</table>";
function myheader($kanan){
?>
<div class="atas">
<table width="100%">
<tr>
	
    </td>
	<td width="100%" valign="top" style="alignment-adjust: left;">
    	<?php echo $kanan;?>
    </td>
</tr>    
</table>
<center><h1></h1></center>
</div>
<table class="grid" width="100%">
<tr>
    <th rowspan="2">Item<br />No.</th>
    <th colspan="4">Part Level</th>
    <th rowspan="2">Part No</th>
    <th rowspan="2">Part Name</th>
    <th rowspan="2">Part Type</th>
    <th rowspan="2">Qty/Car</th>
    <th colspan="6">Material</th>
    <th rowspan="2">Part Weight</th>
    <th rowspan="2">Kg/Sheet</th>
    <th colspan="8">Dies Process</th>
    <th colspan="8">Line Machine</th>
    <th rowspan="2">Process Assy</th>
    <th rowspan="2">Line Assy</th>
    <th colspan="2">Packing</th>
    <th rowspan="2">WH Location</th>
    <th rowspan="2">Model</th>
    <th rowspan="2">Customer</th>
    <th rowspan="2">Supplier</th>
  </tr>
  <tr>
    <th>1</th>
    <th>2</th>
    <th>3</th>
    <th>4</th>
    <th>Type</th>
    <th>Spec</th>
    <th>T</th>
    <th>W</th>
    <th>L</th>
    <th>Pcs/Sheet</th>
    <th>OP5</th>
    <th>OP10</th>
    <th>OP20</th>
    <th>OP30</th>
    <th>OP40</th>
    <th>OP50</th>
    <th>OP60</th>
    <th>OP70</th>
    <th>OP5</th>
    <th>OP10</th>
    <th>OP20</th>
    <th>OP30</th>
    <th>OP40</th>
    <th>OP50</th>
    <th>OP60</th>
    <th>OP70</th>
    <th>Type</th>
    <th>Qty</th>
  </tr>  
<?php
}
function myfooter(){	
	echo "</table>";
}
$g_total=0;
$no=1;
$page =1;
foreach($data as $db){  
		  
          $Thick_db = $db->Thick ; 
          if($Thick_db==0){$Thick = '' ;}else{$Thick = $Thick_db ;}
          $Width_db = $db->Width ; 
          if($Width_db==0){$Width = '' ;}else{$Width = $Width_db ;}
          $Length_db = $db->Length ; 
          if($Length_db==0){$Length = '' ;}else{$Length = $Length_db ;}
          $PcsPerSheet_db = $db->PcsPerSheet ; 
          if($PcsPerSheet_db==0){$PcsPerSheet = '' ;}else{$PcsPerSheet = $PcsPerSheet_db ;}
          
          $KgPerSheet_db = $db->KgPerSheet ; 
          if($KgPerSheet_db==0){$KgPerSheet = '' ;}else{$KgPerSheet = $KgPerSheet_db ;}
          
          $PcsWeight_db = $db->PartWeight ; 
          if($PcsWeight_db==0){$PartWeight = '' ;}else{$PartWeight = $PcsWeight_db ;}
          $PackingType_db = $db->PackingType ; 
          if($PackingType_db=='0'){$PackingType = '' ;}else{$PackingType = $db->PackingType ;}
          $StdPack_db = $db->StdPack ; 
          if($StdPack_db==0){$StdPack = '' ;}else{$StdPack = $StdPack_db ;}
          $FGLocation_db = $db->FGLocation ; 
          if($FGLocation_db=='0'){$FGLocation = '' ;}else{$FGLocation = $db->FGLocation ;}
          $QtyPerCar_db = $db->QtyPerCar ; 
          if($QtyPerCar_db=='0'){$QtyPerCar = '' ;}else{$QtyPerCar = $db->QtyPerCar ;}
          
          $LevelPart1_db = $db->LevelPart ; 
          if($LevelPart1_db==1){$LevelPart1 = 1 ;}else{$LevelPart1 = '' ;}
          $LevelPart2_db = $db->LevelPart ; 
          if($LevelPart2_db==2){$LevelPart2 = 2 ;}else{$LevelPart2 = '' ;}
          $LevelPart3_db = $db->LevelPart ; 
          if($LevelPart3_db==3){$LevelPart3 = 3 ;}else{$LevelPart3 = '' ;}
          $LevelPart4_db = $db->LevelPart ; 
          if($LevelPart4_db==4){$LevelPart4 = 4 ;}else{$LevelPart4 = '' ;}
          $ItemNo_db = $db->ItemNo ; if($ItemNo_db==0){$ItemNo = '';}else{$ItemNo = $ItemNo_db ;}
          $ItemNoSub_db = $db->ItemNoSub ; if($ItemNoSub_db == 0){$ItemNoSub = '';}else{$ItemNoSub = ".". $ItemNoSub_db  ;}
          if($ItemNoSub_db==0 && $ItemNo_db>0){$head = 'style="background: cyan;"' ;}else{$head = '' ;}
          
          
          
          $OP5M_db = $db->OP5M ; if($OP5M_db==0){$OP5M = '';}else{$OP5M = $this->app_model->CariMachine($OP5M_db) ;}
          $OP10M_db = $db->OP10M ; if($OP10M_db==0){$OP10M = '';}else{$OP10M = $this->app_model->CariMachine($OP10M_db) ;}
          $OP20M_db = $db->OP20M ; if($OP20M_db==0){$OP20M = '';}else{$OP20M = $this->app_model->CariMachine($OP20M_db) ;}
          $OP30M_db = $db->OP30M ; if($OP30M_db==0){$OP30M = '';}else{$OP30M = $this->app_model->CariMachine($OP30M_db) ;}
          $OP40M_db = $db->OP40M ; if($OP40M_db==0){$OP40M = '';}else{$OP40M = $this->app_model->CariMachine($OP40M_db) ;}
          $OP50M_db = $db->OP50M ; if($OP50M_db==0){$OP50M = '';}else{$OP50M = $this->app_model->CariMachine($OP50M_db) ;}
          $OP60M_db = $db->OP60M ; if($OP60M_db==0){$OP60M = '';}else{$OP60M = $this->app_model->CariMachine($OP60M_db) ;}
          $OP70M_db = $db->OP70M ; if($OP70M_db==0){$OP70M = '';}else{$OP70M = $this->app_model->CariMachine($OP70M_db) ;}
          $LineAssy_db = $db->LineAssy ; if($LineAssy_db==0){$LineAssy = '';}else{$LineAssy = $this->app_model->CariMachine($LineAssy_db) ;}

	if(($no%1500) == 1){
   	if($no > 1){
        myfooter();
        echo "<div class=\"pagebreak\" align='right'>
		<div class='page' align='center'>Page - $page</div>
		</div>";
		$page++;
  	}
   	myheader($kanan);
	}
	?>
    <tr <?php echo $head ; ?> >
    <td><?php echo $ItemNo ; ?><?php echo $ItemNoSub ; ?></td>
    <td align="center" width="20"><?php echo $LevelPart1 ; ?></td>
    <td align="center" width="20"><?php echo $LevelPart2 ; ?></td>
    <td align="center" width="20"><?php echo $LevelPart3 ; ?></td>
    <td align="center" width="20"><?php echo $LevelPart4 ; ?></td>
    <td width="200"><?php echo $db->PartNo ; ?></td>
    <td width="200"><?php echo $db->PartName ; ?></td>
    <td align="center" width="200"><?php echo $db->PartType ; ?></td>
    <td align="center" width="200"><?php echo $QtyPerCar ; ?></td>
    <td width="200"><?php echo $db->MaterialType ; ?></td>
    <td width="200"><?php echo $db->Spec ; ?></td>
    <td align="center" width="200"><?php echo $Thick ; ?></td>
    <td align="center" width="200"><?php echo $Width ; ?></td>
    <td align="center" width="200"><?php echo $Length ; ?></td>
    <td width="200"><?php echo $PcsPerSheet ; ?></td>
    <td align="center" width="200"><?php echo $PartWeight ; ?></td>
    <td align="center" width="200"><?php echo $KgPerSheet ; ?></td>
    <td width="200"><?php echo $db->OP5 ; ?></td>
    <td width="200"><?php echo $db->OP10 ; ?></td>
    <td width="200"><?php echo $db->OP20 ; ?></td>
    <td width="200"><?php echo $db->OP30 ; ?></td>
    <td width="200"><?php echo $db->OP40 ; ?></td>
    <td width="200"><?php echo $db->OP50 ; ?></td>
    <td width="200"><?php echo $db->OP60 ; ?></td>
    <td width="200"><?php echo $db->OP70 ; ?></td>
    <td align="center" width="200"><?php echo $OP5M ; ?></td>
    <td align="center" width="200"><?php echo $OP10M ; ?></td>
    <td align="center" width="200"><?php echo $OP20M ; ?></td>
    <td align="center" width="200"><?php echo $OP30M ; ?></td>
    <td align="center" width="200"><?php echo $OP40M ; ?></td>
    <td align="center" width="200"><?php echo $OP50M ; ?></td>
    <td align="center" width="200"><?php echo $OP60M ; ?></td>
    <td align="center" width="200"><?php echo $OP70M ; ?></td>
    <td align="center" width="200"><?php echo $db->ProcessAssy ; ?></td>
    <td width="200"><?php echo $LineAssy ; ?></td>
    <td width="200"><?php echo $PackingType ; ?></td>
    <td width="200"><?php echo $StdPack ; ?></td>
    <td width="200"><?php echo $FGLocation ; ?></td>
    <td width="200"><?php echo $db->ProjectName ; ?></td>
    <td width="200"><?php echo $db->CustName ; ?></td>
    <td width="200"><?php echo $db->partner_name ; ?></td>
  </tr>
    <?php
	$no++;
	$g_total = $g_total;
	}
	echo "";
echo "";
myfooter();	
	echo "</table>";	
	echo "<div class='page' align='center'>Page - ".$page."</div>";


 header("Content-type: application/x-msdownload");
		header("Content-Disposition: attachment; filename=BOM.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
        
?>
<?php
}else{	
echo "<div><center><h1>No data available</h1></center></div>";

	} ?>

