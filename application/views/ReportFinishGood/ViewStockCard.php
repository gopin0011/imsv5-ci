<table id="t_transaction_detail" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No</th>
<th>Reg</th>
<th>Date</th>
<th>Log</th>
<th>IN</th>
<th>OUT</th>
<th>Balance</th>  
</tr>
</thead>
<tbody>
<?php 
if($num>0){
$g_total=0;
$g_total_sheet_in=0;
$g_total_sheet_out=0;
$no =1;
        
foreach($list as $row){
$tgl_awal = $tgl_1;
$tgl_akhir = $tgl_2;
$tgl_akhir2 = $tgl_3 ;
        
        $total_sheet_in =  $row->INMat;
        $total_sheet_out =  $row->OUTMat;
        $total =  $row->INMat - $row->OUTMat;
        $balance = $row->INMat - $row->OUTMat ;
        $cust = $row->Code;
        
        $input = $this->app_model->CariJmlinput_FG($row->ItemID,$tgl_awal,$tgl_akhir);
        $input2 = $this->app_model->FGStock($row->ItemID);
        $input3 = $this->app_model->CariJmlinput_FG($row->ItemID,$tgl_awal,$tgl_akhir2);
        
        $g_total1 = ($input2-$input) ;
        $g_total2 = ($g_total +  $balance) ;
        $g_total3 = ($input -  $input3) ;
        $g_total4 = $g_total3 ;
        $hasil = $g_total1 + $g_total2 + $g_total3;
        
        $Reg1 = $row->DocNumDetail; 
        if(strpos($Reg1, 'BPFG')!== FALSE){$Reg='IN';}
        if(strpos($Reg1, 'DELI')!== FALSE){$Reg='OUT';}
        if(strpos($Reg1, 'BPFGIN')!== FALSE){$Reg='CONFIRM';}
        
        $IN1 = $row->INMat;
        if($IN1==0){$IN='-';}else{$IN = number_format($row->INMat);}
        
        $OUT1 = $row->OUTMat;
        if($OUT1==0){$OUT='-';}else{$OUT = number_format($row->OUTMat);}
?>
<tr>
 <td align="left" width="20"><?php echo $no; ?></td>
 <td width="130"><?php echo $row->DocNumDetail ; ?> ( <?php echo $Reg ; ?> )</td>
 <td align="left" width="100" ><?php echo $row->DocDate ;  ?></td>
 <td align="left" width="100" ><?php echo $row->DocTime ;  ?></td>
 <td align="left" width="80" ><?php echo $IN ; ?></td>
 <td align="left" width="80" ><?php echo $OUT ; ?></td>
 <td align="left" width="80" ><?php echo number_format($hasil) ; ?></td>
</tr>

<?php
$no++;
$g_total=$g_total+$total;
$g_total_sheet_in = $g_total_sheet_in+$total_sheet_in ;
$g_total_sheet_out = $g_total_sheet_out+$total_sheet_out ; }
}else{
$g_total=0;
$g_total_sheet_in=0;
$g_total_sheet_out=0; ?>
<?php } ;?>
</tbody>


<tr>
	<th colspan="4" style="text-align: center;">Total</th>
    <th align="left"><?php echo number_format($g_total_sheet_in);?></th>
    <th align="left"><?php echo number_format($g_total_sheet_out);?></th>
</tr> 

</table>

<script> $(function () { $("#t_transaction_detail").DataTable(); });</script>