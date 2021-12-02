<!-- master_list.view -->

<table id="t_list_master" class="table table-bordered table-striped">
<thead>
<tr class="headings">
    <th>PartNo</th>  
    <th>PartName</th>  
    <th>Cust</th>
    <th>Std Pack</th>
</tr> 
</thead>
<tbody>

<?php $no=0; foreach($MListProduct as $row): 
$no++; 
$PartNo = substr($row->PartNo,0,25) ;
$PartName = substr($row->PartName,0,40) ;
?>    
<tr class="odd gradeX" style="cursor:pointer" onclick="javascript:pilih('<?php echo $row->RegID;?>')">
<td width="150"><?php echo $PartNo ; ?></td>
<td width="250"><?php echo $PartName ; ?></td>         
<td align="left" width="80" ><?php echo $row->CustName ; ?></td>
<td align="left" width="50" ><?php echo $row->StdPack ; ?></td>
</tr>
<?php endforeach;?>
 </tbody>
</table>

<script type="text/javascript"> 
function pilih(id){
 $("#myModal_product").modal('hide');
 $("#ItemID").val(id);
 //$("#PartNo").val(partNo);
 //$("#PartName").val(partName);
 //$("#CustName").val(CustName);
 //$("#StockFG").val(StockFG);
 $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/BPFG/GetInfoItem",
        data	: "RegID="+id,
        cache	: false,
        dataType : "json",
        success	: function(data)
        {    
            //alert(data[0].StockFG);
            $("#PartNo").val(data[0].PartNo);
            $("#PartName").val(data[0].PartName);
            $("#CustName").val(data[0].CustName);
            //if(data[0].StockFG == null) $("#StockFG").val("0");
            //else $("#StockFG").val(data[0].StockFG);
        }
 });
 $("#ItemID").focus(); }
</script>

    
    <script> $(function () { $("#t_list_master").DataTable(); });</script>

<!-- master_list.view -->