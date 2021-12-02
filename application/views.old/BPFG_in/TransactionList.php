<!-- start TransactionList.view -->
<div>
<table id="t_list_transaction" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Document No.</th>
<th>Dari Area</th>
<th>Diterima</th>
<th>Tanggal</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
//$TotalMaterialInMPC = $this->app_model->TotalMaterialInMPC($row->DocNum);
//$DocDate = $this->app_model->tgl_str($row->DocDate) ; 
//$DocNum = md5($row->DocNum) ;
?>
<tr class="odd gradeX" style="cursor: pointer;" href="#tab_content3" onclick="javascript:PilihListTrcBPFG('<?php echo $row->RegID;?>')" aria-expanded="false" data-toggle="tab" role="row">
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="200" ><?php echo $row->DocNum; ?></td>
<td align="left" width="300"><?php echo $row->from_area ; ?></td>
<td align="left" width="40" ><?php echo $row->username; ?></td>
<td align="left" width="40" ><?php echo $row->DocDate; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
</div>


<script>

    
    function PilihListTrcBPFG(RegID)
    {
        waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
        setTimeout(function()
        {
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/BPFG_in/List_d",
                data	: "RegID="+RegID,
                cache	: false,
                success	: function(data)
                {
                    waitingDialog3.hide();
                    $('#list_d').html(data);
                    //var e = $.parseJSON(data);
                } 
            }); 
        },800) ; 
        return false();
    }
</script>
<script> $(function () { $("#t_list_transaction").DataTable(); });</script>
<!-- end TransactionList.view -->