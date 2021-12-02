<!-- start transaction_detail_report.view -->

<script>
function textAreaAdjust(o) {
    o.style.height = "55px";
    o.style.height = (22+o.scrollHeight)+"px";
    tampil_data();
}
</script>
<script>
function textAreaAdjustOut(o) {
o.style.height = "77px";
o.style.border.right = "none" ;
o.style.border.bottom = "none" ;
o.style.border.top = "none" ;
tampil_data();
}
</script>

<script>
function bigImg(x) {
    x.style.height = "21px";
    x.style.width = "21px";
}

function normalImg(x) {
    x.style.height = "20px";
    x.style.width = "20px";
}
</script>

<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
	<th width="3%">No</th>
    <th width="10%">Reg</th> 
    <th width="10%">Created by</th>
    <th width="7%">Date</th>
    <th width="34%">Product</th>
    <th width="10%">Supplier</th>
    <th width="6%">Qty</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$total = $row->QtyMat;
$tgl = $this->app_model->tgl_str($row->DocDate);
$tgl2 = $this->app_model->tgl_str($row->CreateDate);
$jam = $row->DocTime; 
$SJNum = $row->SJNum ;
$Partner = $row->partner_code ;
$Category = $row->Category ;
?>
<tr>
<td align="left"><?php echo $no; ?></td>
<td align="left"><?php echo $row->DocNumDetail; ?><br /><?php echo $Category; ?></td>
<td align="left"><?php echo $row->CreateBy; ?><br /><?php echo $tgl2 ; ?><br /><?php echo $jam ; ?> WIB</td>
<td align="left"><?php echo $tgl ; ?></td>
<td ><?php echo $row->PartNo ; ?><br /><?php echo $row->PartName; ?><br /> <?php echo $row->Spec2; ?></td>
<td align="left"><?php echo $SJNum ; ?><br /><?php echo $Partner ; ?></td>
<td align="left"><?php echo number_format($row->QtyMat); ?></td>
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
    
<!-- end transaction_detail_report.view -->    