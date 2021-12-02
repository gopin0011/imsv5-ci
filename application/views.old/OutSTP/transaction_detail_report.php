<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
	<th width="3%">No</th>
    <th width="8%">Created By</th> 
    <th width="34%">Product</th>
    <th width="10%">Customer</th>
    <th width="8%">Line</th>
    <th width="8%">Plan</th>
    <th width="5%">OK</th>
    <th width="5%">NG</th>
    <th width="8%">Proses</th>
    <th width="5%"></th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
 $total = $row->Qty ;
 $tgl = $this->app_model->tgl_str($row->DocDate );
 $tgl2 = $this->app_model->tgl_str($row->CreateDate );
 $cust = $row->CustName ;
 $DocNumDetail = md5($row->DocNumDetail ) ;
 $DocNumDetail2 = $row->DocNumDetail  ;
?>
<tr>
 <td align="left"><?php echo $no; ?></td> 
 <td align="left"><?php echo $row->CreateBy ; ?><br /><?php echo $row->DocNumDetail ; ?><br /><?php echo $tgl ; ?></td> 
 <td ><?php echo $row->PartNo  ; ?><br /><?php echo $row->PartName ; ?></td>
 <td align="left"><?php echo $cust; ?></td>
 <td align="left"><?php echo $row->Line  ; ?> - <?php echo $row->IDLineDetail  ; ?></td>
 <td align="left"><?php echo number_format($row->QtyPlan ); ?></td>
 <td align="left"><?php echo number_format($row->Yield ); ?></td>
 <td align="left"><?php echo number_format($row->NG ); ?></td>
 <td align="left"><?php echo $row->ProsesD  ; ?>/<?php echo $row->ProsesH  ; ?> <?php echo $row->ProsesProduction  ; ?></td>
 <td> <a style="CURSOR: pointer; COLOR: #ff0000"
onclick="window.open(&#39;<?php echo base_url();?>index.php/OutSTP/PrintLabel/<?php echo $DocNumDetail ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
 <i class="glyphicon glyphicon-print"></i></a>
 <?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
 <a onfocus="PilihEdit('<?php echo $DocNumDetail2 ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-edit"></i></a><?php } ?>
 </td>
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