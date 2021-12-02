<div class="box-body"><div class="box box-success"><div class="box-body">
<div class="pull-left" data-toggle="tooltip">
<h4><small><span style="color: red;"><strong><?php echo $TotalItem ; ?></strong></span> - User Active</small></h4>

<div class="clearfix"></div></div></div></div></div>
<table id="t_masterList" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>UserName</th>
<th>Full Name</th>
<th>Departement</th>
<th></th></tr> 
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$StatusX = $row->Blokir ;
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
<td align="left" width="200" ><?php echo $row->Code ; ?></td>
<td align="left" width="300"><?php echo $row->nama_lengkap ; ?></td>
<td align="left" width="40" ><?php echo $row->dept ; ?></td>
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
 $("#RegID").val(id);
 setTimeout(function(){
 $("#RegID").focus();
 $("#RegID").click(); },700) 
 return false(); }
</script>


    
    <script> $(function () { $("#t_masterList").DataTable(); });</script>