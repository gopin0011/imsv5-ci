<table id="t_list_master" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>DocNum</th>  
    <th>Product</th>  
    <th>Spec</th> 
    <th>Cust</th>
    <th>Qty</th>
</tr> 
</thead>
<tbody>

<?php $no=0; foreach($list as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,15) ;
$PartName = substr($row->PartName,0,20) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih2('<?php echo $row->DocNumDetail;?>')">
<td width="150"><?php echo $row->DocNumDetail ; ?></td>
<td width="250"><?php echo $PartNo ; ?><br /><?php echo $PartName ; ?></td>
<td width="200"><?php echo $row->Spec.' '.$row->Thick.' X '.$row->Width.' X '.$row->Length ; ?></td>          
<td align="left" width="50" ><?php echo $row->Code ; ?></td>
<td width="30" align="left"><?php echo $row->Qty_3 ; ?></td> 
</tr>
<?php endforeach;?>
 </tbody>
</table>
<script> $(function () { $("#t_list_master").DataTable(); });</script>