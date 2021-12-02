<table id="t_masterList" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>Initials</th>
<th>Customer Name</th>
<th></th></tr> 
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
?>
<tr>
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="50" ><?php echo $row->Code ; ?></td>
<td align="left" width="200" ><?php echo $row->CustName ; ?></td>
<td align="center" width="10">
<?php  $cek = $this->Role_Model->MCustUp(); if(!empty($cek)){ ?>
<a onfocus="Pilih(<?php echo $row->RegID ; ?>)" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i title="Edit" class="fa fa-edit"></i> </a><?php } ?>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 
function Pilih(id){
 $("#RegID").val(id);
 setTimeout(function(){
 $("#RegID").focus();
 $("#RegID").click(); },700) 
 return false(); }
</script>


    
    <script> $(function () { $("#t_masterList").DataTable(); });</script>