<!-- start bpfg_report.view -->

<table id="t_transaction_detail_2" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Part No</th>
<th>Part Name</th>
<th>Customer</th>
<th>Qty</th>
<th>Stock</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
?>
 <tr>
 <td align="left" width="20"><?php echo $no; ?></td>
 <td align="left" width="150"><?php echo $row->PartNo ; ?></td>
 <td width="200"><?php echo $row->PartName ; ?></td>
 <td align="left" width="60" ><?php echo $row->Code; ?></td> 
 <td align="right" width="20" ><?php echo number_format($row->total); ?></td>
 <td align="right" width="20" ><?php echo number_format($row->StockFG); ?></td>
 </tr>
<?php endforeach;?>
</tbody>
</table>

<script> $(function () { $("#t_transaction_detail_2").DataTable(); });</script>

<!-- end bpfg_report.view -->