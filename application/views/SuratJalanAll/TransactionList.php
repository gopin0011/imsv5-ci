<!-- TransactionList.view -->

<table id="t_list_transaction" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Document No.</th>
<th>Date</th>
<th>User</th>
<th>Total</th>
<th>Status</th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$TotalMaterialInMPC = $this->app_model->TotalMaterialInMPC($row->DocNum);
$DocDate = $this->app_model->tgl_str($row->DocDate) ; 
$DocNum = md5($row->DocNum) ;
if($row->StatusConfirm == 1)
{
    $status = '<span class="pull-right-container"><small class="label pull-right bg-green">Confirmed</small></span>';
} else if ($row->StatusConfirm == 2)
{
    $status = '<span class="pull-right-container"><small class="label pull-right bg-yellow">Un Confirmed</small></span>';
} else 
{
    $status = '<span class="pull-right-container"><small class="label pull-right bg-navy">Waiting</small></span>';
}
?>
<tr class="odd gradeX">
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="200" ><?php echo $row->DocNum; ?></td>
<td align="left" width="300"><?php echo $DocDate ; ?> <?php echo $row->CreateTime; ?></td>
<td align="left" width="40" ><?php echo $row->CreateBy; ?></td>
<td align="left" width="40" ><?php echo $row->TotalDetail ; ?> - Item</td>
<td align="right" width="17" ><?php echo $status; ?></td>
<td align="center" width="10">
<a onclick="javascript:PilihListTrc('<?php echo $row->DocNum;?>')" href="#tab_content3" data-toggle="tab" aria-expanded="false">
<i class="fa fa-list-alt"></i>
</a>
<a style="CURSOR: pointer; COLOR: #ff0000" onclick="print_this('<?php echo $row->RegID;?>');">
<i class="glyphicon glyphicon-print"></i>
</a>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 


function PilihListTrc(id)
{
    $("#DocNum2").val(id);
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function(){
        $("#DocNum2").focus();
        $("#DocNum2").click();
    },800) ; 
    return false(); 
}

function print_this(RegID)
{
    window.open('<?php echo site_url();?>/SuratJalanAll/PrintList/'+RegID,'',' scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no');
}
</script>

<script> $(function () { $("#t_list_transaction").DataTable(); });</script>

<!-- TransactionList.view -->