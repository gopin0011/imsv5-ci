<table id="t_transaction_detail" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Reg</th>
<th>DocDate</th>
<th>Product</th>
<th>Customer</th>
<th>Qty</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$total = $row->Qty_1;
$tgl = $this->app_model->tgl_str($row->DocDate);
$CreateDate = $this->app_model->tgl_str($row->CreateDate);
$cust = $row->Code;
$supp = $row->partner_code ;
$DocNum = md5($row->DocNum) ;
$DocNumDetail = md5($row->DocNumDetail) ;
$DocNumDetail1 = $row->DocNumDetail ;
$PartName = substr($row->PartName,0,25) ;
$MaterialType = $row->MaterialTypeID ;
if($MaterialType==1){ $UOM = 'Kg' ; }else{ $UOM = 'Sht' ; } ;
?>
<tr>
<td align="left"><?php echo $no ; ?></td> 
<td align="left"><?php echo $row->username; ?><br /><?php echo $row->DocNumDetail; ?></td>
<td align="left"><?php echo $tgl ; ?><br /><?php echo $row->DocTime ; ?></td>
<td ><?php echo $row->PartNo ; ?><br /><?php echo $PartName ; ?><br /> <?php echo $row->SpecOrder1 .' '. $row->SpecOrder2 ; ?></td>
<td align="left"><?php echo $cust; ?></td>
<td align="left"><?php echo number_format($row->Qty_3); ?> <?php echo $UOM ; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>

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
<script type="text/javascript"> 
function PilihHapus(DocNumDetail,PartNo,Qty_1,Qty_2,Qty_5,BalMat,BalPcs,CanEditDelete,DocNum_Ext){
var BalMatSource = parseFloat(Qty_1) + parseFloat(BalMat) + parseFloat(Qty_5) ;
var BalPcsSource = parseFloat(Qty_2) + parseFloat(BalPcs) + parseFloat(Qty_5) ;
$("#myModalDelete").modal('show');
$("#DocNumDetailDelete").val(DocNumDetail);
$("#CanEditDelete").val(CanEditDelete);
$("#QtyMatDelete").val(BalMatSource);
$("#QtyPcsDelete").val(BalPcsSource);
$("#DocNum_ExtDelete").val(DocNum_Ext);
$("#pesan").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(PartNo);  };
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
    
    <script> $(function () { $("#t_transaction_detail").DataTable(); });</script>