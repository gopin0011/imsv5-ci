<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#999;margin:0px auto;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#00000;background-color:lightblue;}
.tg .tg-a2cf{font-weight:bold;font-family:Arial, Helvetica, sans-serif !important;;text-align:center;vertical-align:top}
.tg .tg-lntm{font-weight:bold;font-size:36px;font-family:Arial, Helvetica, sans-serif !important;;text-align:center}
.tg .tg-l77s{font-weight:bold;font-family:Arial, Helvetica, sans-serif !important;;text-align:center}
.tg .tg-h31u{font-family:Arial, Helvetica, sans-serif !important;;vertical-align:top}
.tg .tg-h31u1{font-family:Arial, Helvetica, sans-serif !important;;vertical-align:top;text-align:left}
.tg .tg-h31u12{font-family:Arial, Helvetica, sans-serif !important;;vertical-align:top;text-align:right}
.tg .tg-8fc1{font-weight:bold;font-family:Arial, Helvetica, sans-serif !important;;vertical-align:top}
.tg .tg-efv9{font-family:Arial, Helvetica, sans-serif !important;}
.pagebreak {
font-family:Arial, sans-serif;font-size:14px;font-weight:bold;
width:20.99cm ;
page-break-after: always;
margin-bottom:10px;
}
.akhir {
font-family:Arial, sans-serif;font-size:14px;font-weight:bold;
width:20.99cm ;
font-size:13px;
}
.page {
font-family:Arial, sans-serif;font-size:14px;font-weight:bold;
font-size:12px;
padding:10px;
text-align:center;
width: 1444px ;
}
</style>
<?php
if($num>0){
$kanan = "
    <tr>
    <td class='tg-lntm' colspan='2' rowspan='2' style='border-bottom: none;'><img src=".base_url()."assets/images/adw.png width='250' height='59'></td>
    <td class='tg-lntm' colspan='3' rowspan='3'>Production</td>
    <td class='tg-efv9' colspan='2' style='border-right: none; border-bottom: none;'>".$this->session->userdata('nama_lengkap')."</td>
    <td class='tg-8fc1' colspan='2' style='border-left: none; border-bottom: none;'></td>
    
  </tr>
  <tr>
    <td class='tg-efv9' colspan='2' style='border-right: none;border-top: none; border-bottom: none;'>".$filter."</td>
    <td class='tg-8fc1' colspan='2' style='border-left: none; border-top: none; border-bottom: none;'></td>
  </tr>
  <tr>
    <td class='tg-l77s' style='border-top: none;' colspan='2'>PT SUMMIT ADYAWINSA INDONESIA</td>
    <td class='tg-efv9' colspan='4' style='border-top: none;'></td>
  </tr>
  <tr>
    <td class='tg-h31u' colspan='9'></td>
  </tr>";
function myheader($kanan){
?>

<table class='tg' style='undefined;table-layout: fixed; width: 1444px'>
<colgroup>
<col style='width: 33px'>
<col style='width: 255px'>
<col style='width: 500px'>
<col style='width: 119px'>
<col style='width: 100px'>
<col style='width: 100px'>
<col style='width: 100px'>
<col style='width: 100px'>
<col style='width: 141px'>
</colgroup>
    	<?php echo $kanan;?>
  <tr>
    <th class="tg-l77s">No</th>
    <th class="tg-l77s">Created By</th> 
    <th class="tg-l77s">Product</th>
    <th class="tg-l77s">Customer</th>
    <th class="tg-l77s">Line</th>
    <th class="tg-l77s">Plan</th>
    <th class="tg-l77s">OK</th>
    <th class="tg-l77s">NG</th>
    <th class="tg-l77s">Proses</th>
    
  </tr>   
<?php } 
function myfooter(){	
	echo "</table>";
}
$g_total=0;
$no=1;
$page =1;
foreach($data as $row){  
 $total = $row->Qty ;
 $tgl = $this->app_model->tgl_str($row->DocDate );
 $tgl2 = $this->app_model->tgl_str($row->CreateDate );
 $cust = $row->CustName ;
 $DocNumDetail = md5($row->DocNumDetail ) ;
 $DocNumDetail2 = $row->DocNumDetail  ;
	if(($no%11) == 1){
   	if($no > 1){
   	    $ofPage = ceil(($num) / 11);
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
 <td class="tg-h31u"><?php echo $no; ?></td> 
 <td class="tg-h31u"><?php echo $row->CreateBy ; ?><br /><?php echo $row->DocNumDetail ; ?><br /><?php echo $tgl ; ?></td> 
 <td class="tg-h31u"><?php echo $row->PartNo  ; ?><br /><?php echo $row->PartName ; ?></td>
 <td class="tg-h31u"><?php echo $cust; ?></td>
 <td class="tg-h31u"><?php echo $row->Line  ; ?> - <?php echo $row->IDLineDetail  ; ?></td>
 <td class="tg-h31u12"><?php echo number_format($row->QtyPlan ); ?></td>
 <td class="tg-h31u12"><?php echo number_format($row->Yield ); ?></td>
 <td class="tg-h31u12"><?php echo number_format($row->NG ); ?></td>
 <td class="tg-h31u"><?php echo $row->ProsesD  ; ?>/<?php echo $row->ProsesH  ; ?> <?php echo $row->ProsesProduction  ; ?></td>
</tr>
<?php
$no++;
	$g_total = $g_total;
    $ofPage = ceil(($num) / 11);
	}
echo "";
echo "";
myfooter();
echo "</table>";	
echo "<div class='page' align='center' colspan='8'>Page ".$page." of ".$ofPage."</div>";

?>

    </table>
    
    
<?php }else{ ?>
<div> <center><h1>No data available</h1></center> </div>
<?php } ?>

<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>
