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
$StatusX = $row->IsActive ;
if($StatusX=='1'){
 $Status = 'fa fa-check-circle' ;  
}else{
 $Status = 'fa fa-exclamation-triangle' ;    
}
if($StatusX=='1'){
 $TitStatus = 'Active' ;  
}else{
 $TitStatus = 'No Active' ;    
}
?>
<tr>
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="200" ><?php echo $row->UserName ; ?></td>
<td align="left" width="300"><?php echo $row->FullName ; ?></td>
<td align="left" width="40" ><?php echo $row->Dept_Name ; ?></td>
<td align="center" width="10">
<i style="cursor: pointer;" class="<?php echo $Status ; ?>" title="<?php echo $TitStatus ; ?>"></i>
<?php  $cek = $this->Role_Model->MasterUserUp() ; if($cek==1){ ?>
<a onfocus="Select('<?php echo $row->SysID ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i title="Edit" class="fa fa-edit"></i> </a><?php } ?>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script> $(function () { $("#t_masterList").DataTable(); });</script>