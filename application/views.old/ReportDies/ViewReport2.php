<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
 <th>No</th>
 <th>Product</th>
 <th>Customer</th>
 <th>Proses</th>
 <th>Stroke</th>
</tr>
</thead>
<tbody>
<?php
 if($num>0){
 $g_total = 0;
 $no =1;
 foreach($list as $db){  
 $tgl_awal = $tgl_1;
 $tgl_akhir = $tgl_2;
 $ProsesD = $db->ProsesD  ;
 $ItemID = $db->ItemID ;
 $cust = $db->Code ;
 $Qty = $this->app_model->QtyStrokeDies($ItemID,$ProsesD,$tgl_awal,$tgl_akhir);
 $total = $Qty ;
?> 
        
<tr>
 <td align="left"><?php echo $no; ?></td> 
 <td ><?php echo $db->PartNo  ; ?><br /><?php echo $db->PartName ; ?></td>
 <td align="left"><?php echo $cust; ?></td>
 <td align="left"><?php echo $db->ProsesD  ; ?>/<?php echo $db->ProsesH  ; ?></td>
 <td align="left"><?php echo number_format($total); ?></td>
</tr>
<?php $no++; } }  ?>
</tbody>
</table>
<br /><br />
<script> $(function () { $("#t_transaction_detail_report").DataTable(); });</script>