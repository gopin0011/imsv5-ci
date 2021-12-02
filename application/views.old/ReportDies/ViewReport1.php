<table id="t_transaction_detail" class="table table-bordered table-striped">
<thead>
<tr>
 <th>No</th>
 <th>DocDate</th>
 <th>Product</th>
 <th>Customer</th>
 <th>Shift</th>
 <th>Line</th>
 <th>Proses</th>
 <th>Stroke</th>
 <th>Remark</th>
 <th></th>
</tr>
</thead>
<tbody>
<?php
 if($num>0){
 $g_total = 0;
 $no =1;
 foreach($list as $db){  
 $total = $db->QtyStroke ;
 $tgl = $this->app_model->tgl_str($db->DocDate);
 $tgl2 = $this->app_model->tgl_str($db->CreateDate);
 $cust = $db->CustName ;
 $DocNumDetail = md5($db->DocNumDetail) ;
 $DocNumDetail2 = $db->DocNumDetail ;
?>  
<tr>
 <td align="left"><?php echo $no; ?></td> 
 <td align="left"><?php echo $tgl ; ?></td>
 <td ><?php echo $db->PartNo  ; ?><br /><?php echo $db->PartName ; ?></td>
 <td align="left"><?php echo $cust; ?></td>
 <td align="left"><?php echo $db->Shift ; ?></td>
 <td align="left"><?php echo $db->Line  ; ?> - <?php echo $db->IDLineDetail  ; ?></td>
 <td align="left"><?php echo $db->ProsesD  ; ?>/<?php echo $db->ProsesH  ; ?></td>
 <td align="left"><?php echo number_format($db->QtyStroke); ?></td>
 <td align="left"><?php echo $db->Remark ; ?></td>
 <td><a style="CURSOR: pointer; COLOR: #ff0000"
 onclick="window.open(&#39;<?php echo base_url();?>index.php/OutSTP/PrintLabel/<?php echo $DocNumDetail ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
 <i class="glyphicon glyphicon-print"></i></a></td>
</tr>
<?php $no++; } }  ?>
</tbody>
</table>
<script> $(function () { $("#t_transaction_detail").DataTable(); });</script>