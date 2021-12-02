<!-- start master_list.view -->

<div class="box-body"><div class="box box-success"><div class="box-body">
<div class="pull-left" data-toggle="tooltip">
<h4><small><span style="color: red;"><strong><?php echo $TotalItem ; ?></strong></span> - Product Active</small></h4>

<div class="clearfix"></div></div></div></div></div>
<table id="t_masterList" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>Part Name</th>
<th>Spec</th>
<th>UOM</th>
<th>Category</th>
<th></th></tr> 
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
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="200" ><?php echo $row->PartName ; ?></td>
<td align="left" width="40" ><?php echo $row->Spec2 ; ?></td>
<td align="left" width="40" ><?php echo $row->unit ; ?></td>
<td align="left" width="150" ><?php echo $row->category_name ; ?></td>
<td align="center" width="10">
<i style="cursor: pointer;" class="<?php echo $Status ; ?>" title="<?php echo $TitStatus ; ?>"></i>

<?php  $cek = $this->session->userdata('CanEditMaster')=='1'; if(!empty($cek)){ ?>
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
 $("#ItemID").focus();
 $("#ItemID").click(); },700) 
 return false(); }
</script>
<script type="text/javascript"> 
function PilihHapusHead(SysID){
$("#DocNumDetailDelete").val(SysID);
$("#myModalHead").modal('show');
$("#pesan3").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(SysID); };
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

    
    <script> $(function () { $("#t_masterList").DataTable(); });</script>
<!-- end master_list.view -->