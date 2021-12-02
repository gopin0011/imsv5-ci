<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;border-color:#999;margin:0px auto;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#444;background-color:#F7FDFA;}
.tg th{font-family:Arial, sans-serif;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#999;color:#00000;background-color:lightblue;}
.tg .tg-a2cf{font-weight:bold;font-family:Arial, Helvetica, sans-serif !important;;text-align:center;vertical-align:top}
.tg .tg-lntm{font-weight:bold;font-size:36px;font-family:Arial, Helvetica, sans-serif !important;;text-align:center}
.tg .tg-l77s{font-weight:bold;font-family:Arial, Helvetica, sans-serif !important;;text-align:center}
.tg .tg-h31u{font-family:Arial, Helvetica, sans-serif !important;;vertical-align:top}
.tg .tg-h31u1{font-family:Arial, Helvetica, sans-serif !important;;vertical-align:top;text-align:center}
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
if($num > 0){
$kanan = "
  <tr>
    <td class='tg-lntm' colspan='2' rowspan='2' style='border-bottom: none;'><img src=".base_url()."assets/images/adw.png width='250' height='59'></td>
    <td class='tg-efv9' style='border-right: none; border-bottom: none;'>Print By</td>
    <td class='tg-8fc1' style='border-left: none; border-bottom: none;'>: ".$this->session->userdata('nama_lengkap')."</td>
    <td class='tg-lntm' colspan='5' rowspan='3'>".$judul."</td>
  </tr>
  <tr>
    <td class='tg-efv9' style='border-right: none;border-top: none; border-bottom: none;'>Location</td>
    <td class='tg-8fc1' style='border-left: none; border-top: none; border-bottom: none;'>:  ".$LocationID."</td>
  </tr>
  <tr>
    <td class='tg-l77s' style='border-top: none;' colspan='2'>PT SUMMIT ADYAWINSA INDONESIA</td>
    <td class='tg-efv9' style='border-right: none;border-top: none; border-bottom: none;'>Cost Center</td>
    <td class='tg-8fc1' style='border-left: none; border-top: none; border-bottom: none;'>:  ".$DeptID."</td>
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
<col style='width: 124px'>
<col style='width: 247px'>
<col style='width: 240px'>
<col style='width: 125px'>
<col style='width: 140px'>
<col style='width: 180px'>
<col style='width: 100px'>
</colgroup>

<?php echo $kanan;?>

  
<strong><em>Source : IMS</em></strong>
  <tr>
    <th class="tg-l77s">No</th>
    <th class="tg-l77s">ID</th>
    <th class="tg-l77s" colspan="2">Asset Name</th>
    <th class="tg-a2cf">Location</th>
    <th class="tg-a2cf">Cost Center</th>
    <th class="tg-a2cf">Date</th>
    <th class="tg-a2cf">Vendor</th>
    <th class="tg-a2cf">Qty</th>
  </tr>   
<?php
}
function myfooter(){	
	echo "</table>";
}
 $g_total=0;
 $no=1;
 $page =1;
 foreach($list as $db){  
 $Qty =  $db->Qty  ;
 $Date = $this->app_model->tgl_str($db->PurchaseDate ) ;  
	if(($no%15) == 1){
   	if($no > 1){
   	    $ofPage = ceil(($num) / 15);
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
    <td class="tg-h31u"><?php echo $db->ItemID  ; ?></td>
    <td class="tg-h31u" colspan="2"><?php echo $db->ItemName  ; ?></td>
    <td class="tg-h31u1"><?php echo $db->Location ; ?></td>
    <td class="tg-h31u1"><?php echo $db->Dept_Name ; ?></td>
    <td class="tg-h31u1"><?php echo $Date ; ?></td>
    <td class="tg-h31u1"><?php echo $db->partner_code  ;?></td>
    <td class="tg-h31u12"><?php echo number_format($Qty); ?></td>
  </tr>
    <?php
	$no++;
	$g_total = $g_total;
    $ofPage = ceil(($num) / 16);
	}
	echo "";
echo "";
myfooter();	
	echo "</table>";	
	echo "<div class='page' align='center' colspan='8'>Page ".$page." of ".$ofPage."</div>";

?>

<?php
}else{
	
	?>
    	<div>
        <center><h1>No data available</h1></center>
</div>
    <?php	
	}
?>

<script>
		window.load = print_d();
		function print_d(){
			window.print();
		}
	</script>
