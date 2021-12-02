<table id="t_masterList" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>Code</th>
<th>Partner Name</th>
<th>Address</th>
<th></th></tr> 
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
?>
<tr>
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="200" ><?php echo $row->PartnerCode ; ?></td>
<td align="left" width="300"><?php echo $row->PartnerName ; ?></td>
<td align="left" width="300"><?php echo $row->Address ; ?> - <?php echo $row->Telp ; ?></td>
<td align="center" width="10">

<a onfocus="Pilih(<?php echo $row->SysID ; ?>)" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i title="Edit" class="fa fa-edit"></i> </a>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 
function Pilih(id){
 $("#id").val(id);
 setTimeout(function(){
 $("#id").focus();
 $("#id").click(); },700) 
 return false(); }
</script>


    
    <script> $(function () { $("#t_masterList").DataTable(); });</script>