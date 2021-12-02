<table id="t_DetailRole" class="table table-bordered table-striped">
<thead>
<tr class="headings">
<th>No.</th>
<th>Activity</th>
<th>Update</th>
<th>Delete</th>
<th>Return</th>
<th>Jurnal</th>
<th>UserGroupFlow</th>
<th></th>
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($list as $row):  
$UpX = $row->UpData ;
if($UpX==1){ $Up = "fa fa-check-circle" ; }else{$Up = "fa fa-exclamation-triangle" ;   }

$DelX = $row->DelData ;
if($DelX==1){ $Del = "fa fa-check-circle" ; }else{$Del = "fa fa-exclamation-triangle" ;   }

$RetX = $row->RetData ;
if($RetX==1){ $Ret = "fa fa-check-circle" ; }else{$Ret = "fa fa-exclamation-triangle" ;   }

$ViewJurnalX = $row->ViewJurnal ;
if($ViewJurnalX==1){ $Jurnal = "fa fa-check-circle" ; }else{$Jurnal = "fa fa-exclamation-triangle" ;   }

$no++; ?>
<tr>
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="200" ><?php echo $row->ObjTitle ; ?></td>
<td align="center" width="40"><a style="cursor: pointer;" id="Update_<?php echo $row->NumOf ; ?>" data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i onclick="ActionUpdateRole('<?php echo $row->SysID ; ?>','<?php echo $row->NumOf ; ?>','<?php echo $row->UpData ; ?>')" class="<?php echo $Up ; ?>"></i> </a></td>
<td align="center" width="40"><a style="cursor: pointer;" id="Delete_<?php echo $row->NumOf ; ?>" data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i onclick="ActionDeleteRole('<?php echo $row->SysID ; ?>','<?php echo $row->NumOf ; ?>','<?php echo $row->DelData ; ?>')" class="<?php echo $Del ; ?>"></i> </a></td>
<td align="center" width="40"><a style="cursor: pointer;" id="Return_<?php echo $row->NumOf ; ?>" data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i onclick="ActionReturnRole('<?php echo $row->SysID ; ?>','<?php echo $row->NumOf ; ?>','<?php echo $row->RetData ; ?>')" class="<?php echo $Ret ; ?>"></i> </a></td>
<td align="center" width="40"><a style="cursor: pointer;" id="Jurnal_<?php echo $row->NumOf ; ?>" data-loading-text="<i class='fa fa-spinner fa-spin '></i>"><i onclick="ActionJurnalRole('<?php echo $row->SysID ; ?>','<?php echo $row->NumOf ; ?>','<?php echo $row->ViewJurnal ; ?>')" class="<?php echo $Jurnal ; ?>"></i> </a></td>
<td align="left" width="200" style="cursor: pointer;" onclick="myModalUserGrpFlow('<?php echo $row->UserID ; ?>','<?php echo $row->NumOf ; ?>')" >
<a id="Flow_<?php echo $row->NumOf ; ?>" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">
<i  class="fa fa-user"></i></a><a> &nbsp;<?php echo $row->UserGroupFlow ; ?></a></td>
<td align="center" width="10" ><a style="cursor: pointer;" id="Del_<?php echo $row->NumOf ; ?>" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">
<i onclick="ActionDelete('<?php echo $row->SysID ; ?>','<?php echo $row->NumOf ; ?>')" style="cursor: pointer;" title="Delete" class="fa fa-trash"></i></td>
</tr>
<?php endforeach;?>
</tbody>
</table>



<script> $(function () { $("#t_DetailRole").DataTable(); });</script>