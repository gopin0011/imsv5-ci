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
if($num>0){
$kanan = "<table class='kanan' width='100%'>
		  <tr>
		  	<td colspan='2'>Download By</td>
			<td width='5'  colspan='4'>: ".$this->session->userdata('FullName')."</td>
		  </tr>
          <tr>
		  	<td colspan='2'>Filter</td>
			<td width='5' colspan='4'>: ".$filter."</td>
		  </tr>
          <tr>
		  	<td colspan='2'>Periode</td>
			<td width='5' colspan='4'>: ".$periode."</td>
		  </tr>
		  </table>";
function myheader($kanan){
?>
<div class="atas">
<table width="100%">
<tr>
	
    </td>
	<td width="100%" valign="top" style="alignment-adjust: middle;">
    	 <?php echo $kanan ;?>
    </td>
</tr>    
</table>
</div>
<table class="grid" width="100%">
<tr>
	<th>No</th>
    <th>Part No</th>
    <th>Part Name</th>
    <th>Customer</th>
    <th>Spec</th>
    <th style="width: 10%;">IN</th>
    <th style="width: 10%;">OUT</th>
    <th style="width: 10%;">RET</th>
    <th align="center">Ending <br /> Balance</th>
</tr>   
<?php } 
function myfooter(){	
	echo "</table>";
}

$g_total=0;
$no=1;
$page =1;
foreach($list as $row){  
$tgl_awal = $DocDateReport_1 ;
$tgl_akhir = $DocDateReport_2 ;
$tgl_pembanding = $DocDateReport_2 ;        
//Time SERVER,
date_default_timezone_set('Asia/Jakarta');

$tgl_sekarang	= date('d-m-Y');
$tgl_akhir_22	= strtotime('+1 day',strtotime($tgl_pembanding));
$tgl_akhir_23 = date('d-m-Y',$tgl_akhir_22 );
$tgl_sekarang2 = $this->app_model->tgl_sql($tgl_sekarang);
$tgl_akhir_2 = $this->app_model->tgl_sql($tgl_akhir_23);
$IN  = $this->app_model->QtyRM_IN($row->ItemID,$tgl_awal,$tgl_akhir);
$OUT  = $this->app_model->QtyRM_OUT($row->ItemID,$tgl_awal,$tgl_akhir);
$RET  = $this->app_model->QtyRM_RET($row->ItemID,$tgl_awal,$tgl_akhir);
$IN_2  = $this->app_model->QtyRM_IN($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
$OUT_2  = $this->app_model->QtyRM_OUT($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
$RET_2  = $this->app_model->QtyRM_RET($row->ItemID,$tgl_awal,$tgl_sekarang2);
$IN_F  = $this->app_model->QtyRM_IN($row->ItemID,$tgl_awal,$tgl_akhir);
$OUT_F  = $this->app_model->QtyRM_OUT($row->ItemID,$tgl_awal,$tgl_akhir);
$RET_F = $this->app_model->QtyRM_RET($row->ItemID,$tgl_awal,$tgl_akhir);
if($IN_F==0){$IN_R='-';}else{$IN_R= number_format($IN_F);}
if($OUT_F==0){$OUT_R='-';}else{$OUT_R= number_format($OUT_F);}
if($RET_F==0){$RET_R='-';}else{$RET_R= number_format($RET_F);}
if($tgl_pembanding == $tgl_sekarang){
$Stock = $row->BalMat;
}else{
$Stock2 = $row->BalMat;
$Stock = ($Stock2 - $IN_2) + $OUT_2  ;}       
$PartNo = substr($row->PartNo,0,20) ;
$PartName = substr($row->PartName,0,20) ;
$Spec2 = substr($row->Spec2,0,12) ;
$StockPcs = $row->BalPcs;
$PcsPerDay = $row->PcsPerday;
if($PcsPerDay == 0 ) { $StockDay = 0 ; }else{
$StockDay = $StockPcs / $PcsPerDay ;} ;  

	if(($no%100) == 1){
   	if($no > 1){
   	    $ofPage = ceil(($num) / 100);
        myfooter();
        echo "<div class=\"pagebreak\" align='right'>
		<div class='page' align='center' colspan='8'>Page $page of $ofPage</div>
		</div>";
		$page++;
  	} 
      myheader($kanan);
      }
	?>
   <tr>
    <td align="left"><?php echo $no; ?></td>
    <td ><?php echo $row->PartNo ; ?></td>
    <td ><?php echo $row->PartName; ?></td>
    <td align="left"><?php echo $row->CustName ; ?></td>    
    <td ><?php echo $row->Spec1 .' '. $row->Spec2 ; ?></td>
    <td align="left" width="80" ><?php echo $IN_R ; ?> </td>
    <td align="left" width="80" ><?php echo $OUT_R ; ?> </td>
    <td align="left" width="80" ><?php echo $RET_R ; ?> </td>
    <td align="left" width="80" ><?php echo number_format($Stock); ?> </td>   
  </tr>
    <?php
	$no++;
	$g_total = $g_total;
    $ofPage = ceil(($num) / 100);
	}
echo "";
echo "";
myfooter();
echo "</table>";	
echo "<div class='page' align='center' colspan='8'>Page ".$page." of ".$ofPage."</div>";
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=StockReport.xls");
header("Pragma: no-cache");
header("Expires: 0");

?>
<?php }else{	 echo "<div><center><h1>No data available</h1></center></div>"; } ?>

