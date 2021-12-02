<div class="box-body"><div class="box box-success"><div class="box-body">
<div class="pull-left" data-toggle="tooltip">
<h4><small><span style="color: red;"><strong><?php echo $TotalItemMaterial ; ?></strong></span> - Product Active</small></h4>

<div class="clearfix"></div></div></div></div></div>
<table id="t_masterList" class="table table-bordered table-striped">
<thead>
<tr>
<th>No.</th>
<th>Product</th>
<th>Customer</th>
<th>Spec</th>
<th></th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$StatusX = $row->DetailStatus ;
if($StatusX=='Active'){
 $Status = 'fa fa-check-circle' ;  
}else{
 $Status = 'fa fa-exclamation-triangle' ;    
}
if($StatusX=='Active'){
 $TitStatus = 'Active' ;  
}else{
 $TitStatus = 'No Active' ;    
}
?>
<tr>
<td align="center" width="20"><?php echo $no ; ?></td>
<td align="left" width="80"><?php echo $row->PartNo ; ?><br /><?php echo $row->PartName ; ?></td>
<td align="left" width="40"><?php echo $row->CustName.' '. $row->ProjectName ; ?></td>
<td align="left" width="30"><?php echo $row->Spec1 .' '. $row->Spec2; ?></td>
<td align="center" width="20">
<i style="cursor: pointer;" class="<?php echo $Status ; ?>" title="<?php echo $TitStatus ; ?>"></i>
<?php  $cek = $this->Role_Model->MProdMaterialUp(); if(!empty($cek)){ ?>
<a onfocus="Pilih(<?php echo $row->RegID ; ?>)" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i title="Edit" class="fa fa-edit"></i> </a><?php } ?>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>
<script type="text/javascript"> 
function Pilih(id){
 $("#ItemID").val(id);
 setTimeout(function(){
 $("#PartNo").focus();
 $("#PartNo").click(); },700) 
 return false(); }
</script>
    <script> $(function () { $("#t_masterList").DataTable(); });</script>