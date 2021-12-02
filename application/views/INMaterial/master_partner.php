<table id="t_list_master_partner" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>Code</th>  
    <th>Supplier</th>
</tr> 
</thead>
<tbody>

<?php $no=0; foreach($list as $row): 
$no++; 
$PartNo = substr($row->partner_code,0,15) ;
$PartName = substr($row->partner_name,0,20) ;
?>    
 <tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih2('<?php echo $row->id;?>')">
 <td width="150"><?php echo $PartNo ; ?></td>
 <td width="250"><?php echo $PartName; ?></td>
 </tr>
<?php endforeach;?>
 </tbody>
</table>

<script type="text/javascript">
function pilih2(id){
 $("#myModal_Partner").modal("hide");
 $("#PartnerID").val(id);
 $("#PartnerID").focus(); }
</script>
<script> $(function () { $("#t_list_master_partner").DataTable(); });</script>