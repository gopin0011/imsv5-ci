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
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih2('<?php echo $row->id;?>')">
            <td width="150"><?php echo $row->nama_lengkap ; ?></td>
            <td width="250"><?php echo $row->code ; ?></td>        
            <td align="center" width="180" ><?php echo $row->Dept_Name ; ?></td>
<?php endforeach;?>
</tbody>
</table>

<script> $(function () { $("#t_list_master_pic").DataTable(); });</script>