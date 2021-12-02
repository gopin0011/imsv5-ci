<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
	<th width="3%">No</th>
    <th width="10%">Reg</th> 
    <th width="10%">Created by</th>
    <th width="7%">Tanggal</th>
    <th width="34%">Product</th>
    <th width="10%">Received by</th>
    <th width="6%">Qty</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
 $total = $row->QtyMat;
 $tgl = $this->app_model->tgl_str($row->DocDate);
 $jam = $row->DocTime; 
 $Pic = $row->nama_singkat ;
 $dept = $row->Dept_Name ;
 $Category = $row->Category ;
 $UOM = $row->CodeUnit ;
?>
<tr>
 <td align="left"><?php echo $no; ?></td>
 <td align="left"><?php echo $row->DocNumDetail; ?><br /><?php echo $Category; ?></td>
 <td align="left"><?php echo $row->CreateBy; ?></td>
 <td align="left"><?php echo $tgl ; ?><br /><?php echo $jam ; ?></td>
 <td ><?php echo $row->PartNo ; ?><br /><?php echo $row->PartName; ?><br /> <?php echo $row->Spec2; ?></td>
 <td align="left"><?php echo $Pic; ?><br /><?php echo $dept ; ?></td>
 <td align="left"><?php echo number_format($row->QtyMat); ?> <?php echo $UOM ; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
<br /><br />

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
  
  
    
    <script> $(function () { $("#t_transaction_detail_report").DataTable(); });</script>