<table id="t_masterList" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>Code</th>
<th>Category</th>
<th></th></tr> 
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
?>
<tr>
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="200" ><?php echo $row->code ; ?></td>
<td align="left" width="300"><?php echo $row->unit ; ?></td>
<td align="center" width="10">
<?php  $cek = $this->Role_Model->MUnitUp(); if(!empty($cek)){ ?>
<a onfocus="Pilih(<?php echo $row->id ; ?>)" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i title="Edit" class="fa fa-edit"></i> </a><?php } ?>
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