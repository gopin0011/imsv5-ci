<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
	<th width="3%">No</th>
    <th width="10%">Kode</th>
    <th width="10%">Supplier</th> 
    <th width="10%">DocDate</th>
    <th width="34%">Product</th>
    <th width="8%">Customer</th>
    <th width="10%">Qty</th>
    <?php  $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
    <th width="10%"></th><?php } ?>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
 $total = $row->QtyMat;
 $tgl = $this->app_model->tgl_str($row->DocDate);
 $CreateDate = $this->app_model->tgl_str($row->CreateDate);
 $cust = $row->Code;
 $supp = $row->partner_code ;
 $DocNum = md5($row->DocNum) ;
 $DocNumDetail = md5($row->DocNumDetail) ;
 $DocNumDetail1 = $row->DocNumDetail ;
 $PartName = substr($row->PartName,0,25) ;
 $MaterialType = $row->MaterialType ; 
 if($MaterialType==2){ $UOM = 'Sht' ; } ;
 if($MaterialType==1){ $UOM = 'Kg' ; } ;
?>
<tr>
 <td align="left"><?php echo $no ; ?></td> 
 <td align="left"><?php echo $row->CreateBy; ?><br /><?php echo $row->DocNumDetail; ?></td>
 <td align="left"><?php echo $supp ; ?><br /><?php echo $row->SJNum; ?></td> 
 <td align="left"><?php echo $tgl ; ?><br /><?php echo $CreateDate ; ?><br /><?php echo $row->DocTime ; ?></td>
 <td ><?php echo $row->PartNo ; ?><br /><?php echo $PartName ; ?><br /> <?php echo $row->Spec2; ?></td>
 <td align="left"><?php echo $cust; ?></td>
 <td align="left"><?php echo number_format($row->QtyMat); ?> <?php echo $UOM ; ?></td>
 <td align="left" width="30">
 <?php  $cek = $row->CanEdit=='0'; if(!empty($cek)){ ?>
 <?php  $cek2 = $this->Role_Model->TrcMaterialUp(); if(!empty($cek2)){ ?>
 <a onfocus="PilihEdit('<?php echo $DocNumDetail1 ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-edit"></i> </a>
 <?php } ?> <?php } ?> 
 <a style="CURSOR: pointer; COLOR: #ff0000" 
 onclick="window.open(&#39;<?php echo base_url();?>index.php/INMaterial/DetailPrint2/<?php echo $DocNumDetail1 ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
 <i class="glyphicon glyphicon-print"></i></a>
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