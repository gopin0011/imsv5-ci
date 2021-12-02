<table id="t_masterList" class="table table-bordered table-striped">
<thead>
<tr>
<th>No.</th>
<th>Part No</th>
<th>Part Name</th>
<th>Customer</th>
<th>Project</th>
<th></th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
?>
<tr>
<td align="center" width="20"><?php echo $row->ItemNo ; ?></td>
<td align="left" width="80"><?php echo $row->PartNo ; ?></td>
<td align="left" width="80"><?php echo $row->PartName ; ?></td>
<td align="left" width="40"><?php echo $row->Code ; ?></td>
<td align="left" width="30"><?php echo $row->ProjectName ; ?></td>
<td align="center" width="20">
<a onclick="PilihEdit('<?php echo $row->SysID ; ?>')" href="#tab_content_DetailBOM" data-toggle="tab" aria-expanded="false">
Detail </a>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 
function PilihEdit(id){
$("#SysIDDetail").val(id);
setTimeout(function(){
$("#SysIDDetail").focus();
$("#SysIDDetail").click();
setTimeout(function(){
$("#SysIDDetail").focus();
$("#SysIDDetail").click();
},300) ;
},500) 
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