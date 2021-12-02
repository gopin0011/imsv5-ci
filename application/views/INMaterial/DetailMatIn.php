<table id="t_transaction_detail" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Reg</th>
<th>Log</th>
<th>Product</th>
<th>Customer</th>
<th>Qty</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
 $QtyMat =  $row->QtyMat ;  
 $CreateID =  $row->CreateByID ;  
 $PartNo =  substr($row->PartNo,0,15);
 $PartName =  $row->PartName;
 $MatNum =  $row->MatNum;
 $DocNum = md5($row->DocNum) ;
 $DocNumDetail = $row->DocNumDetail ;
?>
 <tr>
 <td align="left" width="20"><?php echo $no; ?></td>
 <td align="left" width="40"><?php echo $row->DocNumDetail ; ?> </td>
 <td align="left" width="50"><?php echo $row->SJNum ; ?> 
 <br /> <?php echo $MatNum ;?></td>
 <td width="200"><?php echo $PartNo ; ?>
 <br /> <?php echo $PartName ; ?></td>
 <td align="left" width="60" ><?php echo $row->Code; ?></td> 
 <td align="left" width="20" ><?php echo number_format($QtyMat); ?></td>
 <td align="center" width="60">
 <?php  $cek = $row->CanEdit=='0'; if(!empty($cek)){ ?>
 <?php  $cek2 = $this->Role_Model->TrcMaterialUp(); if(!empty($cek2)){ ?>
 <a onfocus="PilihEdit('<?php echo $DocNumDetail ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-edit"></i> </a><?php } ?> 
 <?php  $cek3 = $this->Role_Model->TrcMaterialDel(); if(!empty($cek3)){ ?>
 <a onfocus="PilihHapus('<?php echo $DocNumDetail ; ?>', '<?php echo $PartNo ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
 <i class="glyphicon glyphicon-trash"></i> </a>
 <?php } ?> <?php } ?> 
 <a style="CURSOR: pointer; COLOR: #ff0000" 
 onclick="window.open(&#39;<?php echo base_url();?>index.php/INMaterial/DetailPrint2/<?php echo $DocNumDetail ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
 <i class="glyphicon glyphicon-print"></i></a>
 </td>
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
 },500) ;
 return false();
 }
</script>
<script type="text/javascript"> 
function PilihHapus(DocNumDetail,PartNo,CanEdit){
$("#DocNumDetailDelete").val(DocNumDetail);
$("#myModalDelete").modal('show');
$("#CanEditDelete").val(CanEdit);
$("#pesan").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(PartNo);  };
</script>


    
    <script> $(function () { $("#t_transaction_detail").DataTable(); });</script>