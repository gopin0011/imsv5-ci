<!-- start master_list2.view -->

<table id="t_list_master" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>PartName</th>  
    <th>Spec</th>  
    <th>Unit</th> 
    <th>Category</th>
</tr> 
</thead>
<tbody>

<?php $no=0; foreach($MListProduct as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,15) ;
$PartName = $row->PartName; //substr($row->PartName,0,20) ;
$Spec = $row->Spec2 ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilihReport('<?php echo $row->RegID ;?>','<?php echo $row->PartNo ;?>','<?php echo $row->PartName ;?>','<?php echo $Spec ;?>')">
<td width="300"><?php echo $PartName ; ?></td>
<td width="150"><?php echo $Spec; ?></td>
<td width="120"><?php echo $row->unit ; ?></td>          
<td align="center" width="120" ><?php echo $row->CodeCategory  ; ?></td>
<?php endforeach;?>
 </tbody>
</table>

    <script type="text/javascript"> 
function pilihReport(RegID,PartNo,PartName,Spec){
 $("#myModal_product2").modal('hide');
 $("#ItemID2").val(RegID); 
 $("#PartNo2").val(PartNo);
 $("#PartName2").val(PartName); 
 $("#SpecReport").val(Spec);
  }
</script>

    
    <script> $(function () { $("#t_list_master").DataTable(); });</script>
    
    <!-- end master_list2.view -->