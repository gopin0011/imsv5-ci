<!-- start PrintListReport.view -->

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
width: auto ;
}


</style>
<?php
if($num>0){
$kanan = "
<tr>
    <td class='tg-lntm' colspan='3' rowspan='2' style='border-bottom: none;'><img src=".base_url()."assets/images/adw.png width='250' height='59'></td>
    <td class='tg-efv9' style='border-right: none; border-bottom: none;'>Print By</td>
    <td class='tg-8fc1' style='border-left: none; border-bottom: none;'>: ".$this->session->userdata('FullName')."</td>
    <td class='tg-lntm' colspan='3' rowspan='3'>Surat Jalan</td>
  </tr>
  <tr>
    <td class='tg-efv9' style='border-right: none;border-top: none; border-bottom: none;'>Sort By</td>
    <td class='tg-8fc1' style='border-left: none; border-top: none; border-bottom: none;'>:  </td>
  </tr>
  <tr>
    <td class='tg-l77s' style='border-top: none;' colspan='3'>PT SUMMIT ADYAWINSA INDONESIA</td>
    <td class='tg-efv9' colspan='2' style='border-top: none;'></td>
  </tr>
  <tr>
    <td class='tg-h31u' colspan='8'></td>
  </tr>";
//$kanan = '';  
function myheader($kanan){
?>

<table class='tg' style='undefined;width: 100%'>

    	<?php echo $kanan;?>

  

  <tr>
    <th class="tg-l77s" colspan="2">No</th>
    <th class="tg-l77s" colspan="3">Part Name</th>
    <th class="tg-l77s" colspan="2">Part No.</th>
    <th class="tg-a2cf">Qty</th>
  </tr>   
<?php } 
function myfooter(){	
	echo "</table>";
}
$g_total=0;
$no=1;
$page =1;
$jml = 1;
foreach($data as $row => $val){  
	     //$QtyMat =  $row->QtyMat ;  
        //$PartNo =  substr($row->PartNo,0,15);
        //$PartName =  substr($row->PartName,0,42);
         //$MatNum =  $row->MatNum;
         //$DocNum = md5($row->DocNum) ;
         //$DocNumDetail = $row->DocNumDetail ;
         //$MaterialType = $row->MaterialType ;
         
	if(($jml%21) == 1){
   	if($jml > 1){
   	    $ofPage = ceil(($num) / 21);
        myfooter();
        echo "<div class='pagebreak' align='center' colspan='8'>Page ".$page." of ".$ofPage."</div>";
		$page++;
  	} 
      myheader($kanan);
      //echo "<tr><td colspan='8'>aaa</td></tr>";
      }
	?>
    <tr>
    <td class="tg-h31u" colspan="2"><strong><?php echo $no; ?></strong></td>
    <td class="tg-h31u" colspan="3"><strong><?php echo $val['PartName'] ; ?></strong></td>
    <td class="tg-h31u" colspan="2"><strong><?php echo $val['PartNo'] ; ?></strong></td>
    <td class="tg-h31u"><strong><?php echo $val['Quantity'] ; ?></strong></td>
  </tr>
  <?php
    $no2 = 1;
    foreach($val['detail'] as $row2 => $val2)
    {
        if(($jml%21) == 0){
            if($jml > 1){
           	    $ofPage = ceil(($num) / 21);
                myfooter();
                echo "<div class='pagebreak' align='center' colspan='8'>Page ".$page." of ".$ofPage."</div>";
        		$page++;
          	}
            myheader($kanan);
        }
        ?>
        <tr>
            <td class="tg-h31u" width="10">&nbsp;</td>
            <td class="tg-h31u" width="10"><?php echo $no.'.'.$no2; ?></td>
            <td class="tg-h31u"><?php echo $val2['DocNum'] ; ?></td>
            <td class="tg-h31u"><?php echo $val2['PartnerCode'] ; ?></td>
            <td class="tg-h31u"><?php echo $this->app_model->tgl_str($val2['DocDate']) ; ?></td>
            <td class="tg-h31u"><?php echo $val2['CarNum'] ; ?></td>
            <td class="tg-h31u"><?php echo $val2['UserName'] ; ?></td>
            <td class="tg-h31u"><?php echo $val2['Quantity'] ; ?></td>
        </tr>       
        <?php
        $no2++;
        $jml++;
    }
    $no3=$no+$no2;
  ?>
<?php
$no++;
$jml++;
	$g_total = $g_total;
    $ofPage = ceil(($num) / 21);
	}
echo "";
echo "";
myfooter();
echo "</table>";	
echo "<div class='pagebreak' align='center' colspan='8'>Page ".$page." of ".$ofPage."</div>";

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


<!-- end PrintListReport.view -->