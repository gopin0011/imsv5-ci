<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
	<th width="3%">No</th>
    <th width="10%">Reg</th> 
    <th width="10%">Created by</th>
    <th width="7%">Date</th>
    <th width="34%">Product</th>
    <th width="10%">Customer</th>
    <th width="6%">Qty</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
		$total = $row->QtyMat;
		$tgl = $this->app_model->tgl_str($row->DocDate);
        $tgl2 = $this->app_model->tgl_str($row->CreateDate);
         $cust = $row->Code;
         $supp = $row->partner_code ;
?>
<tr>
 <td align="left"><?php echo $no; ?></td> 
 <td align="left"><?php echo $row->DocNumDetail; ?><br /><?php echo $row->MatNum; ?></td> 
 <td align="left"><?php echo $row->CreateBy; ?><br /><?php echo $row->DocTime ; ?></td>
 <td align="left"><?php echo $tgl ; ?></td>
 <td ><?php echo $row->PartNo ; ?><br /><?php echo $row->PartName; ?></td>
 <td align="left"><?php echo $cust; ?></td>
 <td align="left"><?php echo number_format($row->QtyMat); ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
<br /><br />


<script type="text/javascript"> 
function PilihEdit(id){
	$("#DocNumDetail2").val(id);
    $("#DocNumDetail").val(id.substr(12,3));
    setTimeout(function(){
					$("#DocNumDetail2").focus();
					$("#DocNumDetail2").click();
                    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
          setTimeout(function(){
					$("#DocNumDetail2").focus();
					$("#DocNumDetail2").click();
				},300) ;
				},500) 
			return false();
	 
    }
</script>


  
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