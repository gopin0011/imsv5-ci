<!-- start transaction_detail_report_new.view -->

<style>
table.detail {
    border-spacing: 1;
    border-collapse: separate;
}
table.detail td {

}
</style>
<script>
function textAreaAdjust(o) {
    o.style.height = "55px";
    o.style.height = (22+o.scrollHeight)+"px";
    tampil_data();
}
</script>
<script>
function textAreaAdjustOut(o) {
o.style.height = "77px";
o.style.border.right = "none" ;
o.style.border.bottom = "none" ;
o.style.border.top = "none" ;
tampil_data();
}
</script>

<script>
function bigImg(x) {
    x.style.height = "21px";
    x.style.width = "21px";
}

function normalImg(x) {
    x.style.height = "20px";
    x.style.width = "20px";
}
</script>
<input type="hidden" id="tgl1a" name="tgl1a" value="<?php echo $tgl1;?>">
<input type="hidden" id="tgl2b" name="tgl2b" value="<?php echo $tgl2;?>">
<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
	<th width="3%">No</th>
    <th width="34%">DocNum</th>
    <th width="25%">Customer</th>
    <th>DocDate</th>
    <th>Status</th>
    <th>ConfirmBy</th>
    <th width="6%">Qty</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
if($row->StatusConfirm == '1') $status = 'Confirm';
else if($row->StatusConfirm == '2') $status = 'UnConfirm';
else $status = 'Waiting';
?>
<tr id="span_<?php echo $row->RegID;?>">
<td align="left" width="6%"><?php echo $no; ?><a class="pull-right" href="javascript:void(0);" onclick="collapse(this,'<?php echo $no;?>');" data-ref="span_<?php echo $row->RegID;?>" data-id="<?php echo $row->RegID;?>"><img id="img_<?php echo $row->RegID;?>" src="<?php echo base_url();?>images/1494249007_bullet_toggle_plus.png"></a></td>
<td align="left"><?php echo $row->DocNum; ?></td>
<td align="left"><?php echo $row->PartnerCode; ?></td>
<td align="left"><?php echo $row->DocDate ; ?></td>
<td align="right"><?php echo $status ; ?></td>
<td align="left"><?php echo $row->UserConfirm ; ?></td>
<td align="right"><?php echo $row->qty ; ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>
<br /><br />

  <script>
  $(function () {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
  
    <script> $(function () { $("#t_transaction_detail_report").DataTable(); });</script>
    <script>
        function collapse(obj,no)
        {
            var id = $(obj).data('ref');
            var RegID = $(obj).data('id');
            var time = 100;
            if($('.expand'+id).length > 0)
            { 
                $('#img_'+$(obj).data('id')).attr('src','<?php echo base_url();?>images/1494249007_bullet_toggle_plus.png');
                $('.expand'+id).remove();
            }
            else
            {
                $('#img_'+$(obj).data('id')).attr('src','<?php echo base_url();?>images/1494250969_bullet_toggle_minus.png');
                $.ajax({
                    type	: 'POST',
                    url		: "<?php echo site_url(); ?>/SuratJalan/GetDetailFakturSJ",
                    data	: "RegID="+RegID+"&tgl1="+$('#tgl1a').val()+"&tgl2="+$('#tgl2b').val(),
                    cache	: false,
                    success	: function(data)
                    {
                        var y = 1;
                        var table = "<table width='100%' id='th_"+RegID+"' style='font-size:small;'></table>";                        
                        $('#'+id).after('<tr id="expand'+id+'" class="expand'+id+'" data-ref="'+id+'"><td>&nbsp;</td><td colspan="6" id="detail_'+RegID+'"></td></tr>');
                        $('#detail_'+RegID).html(table);
                        $.each($.parseJSON(data).list, function(i,el){
                            var string = '<tr id="list'+id+'" class="list'+id+'"><td width="20" style="padding:3px">'+no+'.'+y+'</td><td width="250">'+el.PartName+'</td><td width="150">'+el.JobNumber+'</td><td width="200">'+el.OrderReference+'</td><td width="75">'+el.code+'</td><td align="right" width="35">'+el.Quantity+'</td></tr>';
                            setTimeout(function(){
                                $('#th_'+RegID).append(string);
                            },time)
                            time+=100;
                            y++;
                        });
                        
                    } 
                });
            }
        }
    </script>
    
<!-- end transaction_detail_report_new.view -->