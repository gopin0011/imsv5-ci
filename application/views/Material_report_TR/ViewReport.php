<table id="t_transaction_detail" class="table table-bordered table-striped">
<thead>
<tr>
 <th>No</th>
 <th>Product</th>
 <th>Spec</th>  
 <th>IN</th>
 <th>OUT</th>
 <th align="center">Bal</th>
 <th align="center">Amount</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
 $tgl_awal  = $this->app_model->tgl_sql($tgl_1);
 $tgl_akhir = $this->app_model->tgl_sql($tgl_2);
 $tgl_pembanding = $tgl_2 ;        
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');
 $tgl_sekarang	= date('d-m-Y');
 $tgl_akhir_22	= strtotime('+1 day',strtotime($tgl_pembanding));
 $tgl_akhir_23 = date('d-m-Y',$tgl_akhir_22 );
 $tgl_sekarang2 = $this->app_model->tgl_sql($tgl_sekarang);
 $tgl_akhir_2 = $this->app_model->tgl_sql($tgl_akhir_23);
 $IN  = $this->app_model->QtyTR_IN($row->ItemID,$tgl_awal,$tgl_akhir);
 $OUT  = $this->app_model->QtyTR_OUT($row->ItemID,$tgl_awal,$tgl_akhir);
 $IN_F  = $this->app_model->QtyTR_IN($row->ItemID,$tgl_awal,$tgl_akhir);
 $OUT_F  = $this->app_model->QtyTR_OUT($row->ItemID,$tgl_awal,$tgl_akhir);
 if($IN_F==0){$IN_R='-';}else{$IN_R= number_format($IN_F);}
 if($OUT_F==0){$OUT_R='-';}else{$OUT_R= number_format($OUT_F);}
 $IN_2  = $this->app_model->QtyTR_IN($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
 $OUT_2  = $this->app_model->QtyTR_OUT($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
 $IN_Amount  = $this->app_model->QtyAmount_IN($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
 $OUT_Amount = $this->app_model->QtyAmount_OUT($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
 if($tgl_pembanding == $tgl_sekarang){
 $Stock      = $row->BalMat;
 $BalAmount  = $row->BalAmount;
 }else{
 $Stock2     = $row->BalMat;
 $Stock      = ($Stock2 - $IN_2) + $OUT_2  ;
 $BalAmount2  = $row->BalAmount;
 $BalAmount  = ($BalAmount2 - $IN_Amount) + $OUT_Amount  ;
 }             
 if($Stock==0){$Stock_R='-';}else{$Stock_R = number_format($Stock);}
 if($BalAmount==0){$BalAmount_R='-';}else{$BalAmount_R = number_format($BalAmount);}
?>
<tr>
 <td align="left" width="20"><?php echo $no; ?></td>
 <td width="250" ><?php echo $row->PartNo; ?><br /><?php echo $row->PartName; ?></td>
 <td align="left" width="150" ><?php echo $row->Category; ?> <br /><?php echo $row->Spec1; ?> &nbsp;<?php echo $row->Spec2; ?></td>  
 <td align="left" width="80" ><?php echo $IN_R; ?> </td>
 <td align="left" width="80" ><?php echo $OUT_R; ?> </td>
 <td align="left" width="80" ><?php echo $Stock_R ; ?> </td>
 <td align="left" width="80" ><?php echo $BalAmount_R ; ?> </td>  
</tr>
<?php endforeach;?>
</tbody>
</table>


<script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
    
    <script> $(function () { $("#t_transaction_detail").DataTable(); });</script>