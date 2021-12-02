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
$kanan = "
 <table class='kanan' width='100%'>
 <tr>
 <td colspan='2'>Downloaded by</td>
 <td width='5'  colspan='4'>: ".$UserDownload."</td>
 </tr>
  <tr>
 <td colspan='2'>Date</td>
 <td width='5' colspan='4'>: ".$DocDate_now."</td>
 </tr>
 
 <tr>
 <td colspan='2'>Doc. Date</td>
 <td width='5' colspan='4'>: ".$DocDate."</td>
 </tr>

 <tr>
 <td colspan='2'>Source</td>
 <td width='5' colspan='4'>: IMS</td>
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
<th>No.</th>
<th>Customer</th>
<th>So Number</th>
<th>Promise Date</th>
<th>Line</th>
<th>PartNumber</th>
<th>PartName</th>
<th>Qty SO</th>
<th>Amount SO</th>
<th>Qty Delivery</th>
<th>Amount Delivery</th>
<th>Qty Gap</th>
<th>Amount Gap</th>
</tr>   
<?php } 
function myfooter(){	
	echo "</table>";
}

$g_total=0;
$no=1;
$page =1;
foreach($list as $row){  
$DocDateX = substr($row->DelivDate,0,10) ;
$DocDate = $this->app_model->tgl_str($DocDateX);
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
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="100" ><?php echo $row->PartnerCode ; ?></td>
<td align="left" width="40" ><?php echo $row->C050_DocNum ; ?></td>
<td align="left" width="40" ><?php echo $DocDate ; ?></td>
<td align="left" width="20"><?php echo $row->Line ; ?></td>
<td align="left" width="300"><?php echo $row->ItemNum ; ?></td>
<td align="left" width="300"><?php echo $row->ItemName ; ?></td>
<td align="left" width="40" ><?php echo number_format($row->QtySO) ; ?></td>
<td align="left" width="40" ><?php echo number_format($row->AmountSO) ; ?></td>
<td align="left" width="40" ><?php echo number_format($row->QtyDelivery) ; ?></td>
<td align="left" width="40" ><?php echo number_format($row->AmountDelivery) ; ?></td>
<td align="left" width="40" ><?php echo number_format($row->GapQty) ; ?></td>
<td align="left" width="40" ><?php echo number_format($row->GapAmount) ; ?></td>
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
		header("Content-Disposition: attachment; filename=DailyGAP_$DocDate.xls");
		header("Pragma: no-cache");
		header("Expires: 0");
?>
<?php }else{ echo "<div><center><h1>No data GAP</h1></center></div>"; } ?>

