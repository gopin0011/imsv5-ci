<!-- start master_list_pic.view -->

<table id="t_list_master_pic" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>Nama</th>  
    <th>Code</th>  
    <th>Dept</th>
</tr> 
</thead>
<tbody>
<?php $no=0; foreach($MListProduct as $row): 
$no++; 
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih3('<?php echo $row->id;?>','<?php echo $row->code;?>','<?php echo $type;?>')">
            <td width="150"><?php echo $row->nama_lengkap ; ?></td>
            <td width="250"><?php echo $row->code ; ?></td>        
            <td align="center" width="180" ><?php echo $row->Dept_Name ; ?></td>
<?php endforeach;?>
</tbody>
</table>

<script> 

    $(function () { $("#t_list_master_pic").DataTable(); });
    function pilih3(id,name,type)
    {
        $("#myModalListTrans").modal("hide");
        $("#"+type).val(id);
        if(type == 'picFrom') $('#picFromName').val(name); 
        else $('#picToName').val(name); 
        //$("#"+type).focus();
    }

</script>
<!-- end master_list_pic.view -->