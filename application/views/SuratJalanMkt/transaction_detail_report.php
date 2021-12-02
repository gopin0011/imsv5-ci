<!-- start transaction_detail_report.view -->
<style>
table.detail {
    border-spacing: 1;
    border-collapse: separate;
}
table.detail td {
    padding: 5px;
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
    <th width="34%">Product</th>
    <th width="25%">Product No</th>
    <th width="6%">Qty</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
?>
<tr id="span_<?php echo $row->ItemID;?>">
<td align="left" width="6%"><?php echo $no; ?><a class="pull-right" href="javascript:void(0);" onclick="collapse(this,'<?php echo $no;?>');" data-ref="span_<?php echo $row->ItemID;?>" data-id="<?php echo $row->ItemID;?>"><img id="img_<?php echo $row->ItemID;?>" src="<?php echo base_url();?>images/1494249007_bullet_toggle_plus.png"></a></td>
<td align="left"><?php echo $row->PartName; ?></td>
<td align="left"><?php echo $row->PartNo; ?></td>
<td align="right"><?php echo $row->Quantity ; ?></td>
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
            var ItemID = $(obj).data('id');
            //$('.expand'+id).remove();
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
                    data	: "ItemID="+ItemID+"&tgl1="+$('#tgl1a').val()+"&tgl2="+$('#tgl2b').val(),
                    cache	: false,
                    success	: function(data)
                    {
                        //alert($.parseJSON(data).list);
                        $('#'+id).after('<tr id="expand'+id+'" class="expand'+id+'" data-ref="'+id+'"><td>&nbsp;</td><td colspan="3" id="detail_'+ItemID+'"></td></tr>');
                        //<tr><th style='border-bottom:#ccc solid 1px; text-align:center''>&nbsp;</th><th style='border-bottom:#ccc solid 1px; text-align:center''><strong>DocNum</strong></th><th style='border-bottom:#ccc solid 1px; text-align:center''><strong>Customer</strong></th><th style='border-bottom:#ccc solid 1px; text-align:center''><strong>DocDate</strong></th><th style='border-bottom:#ccc solid 1px; text-align:center''><strong>CarNum</strong></th><th style='border-bottom:#ccc solid 1px; text-align:center''><strong>CreateBy</strong></th><th style='border-bottom:#ccc solid 1px; text-align:center''><strong>Quantity</strong></th><th width='60'>&nbsp;</th></tr>
                        var table = "<table width='100%' id='th_"+ItemID+"' class='detail' cellspacing='2' cellpadding='2'></table>";
                        $('#detail_'+ItemID).html(table);
                        var y = 1;
                        $.each($.parseJSON(data).list, function(i,el){
                            //alert(el.DocNum);
                            var string = '<tr id="list'+id+'" class="list'+id+'"><td width="20">'+no+'.'+y+'</td><td>'+el.DocNum+'</td><td>'+el.PartnerCode+'</td><td>'+el.DocDate+'</td><td>'+el.CarNum+'</td><td>'+el.UserName+'</td><td align="right" width="35">'+el.Quantity+'</td></tr>';
                            $('#th_'+ItemID).append(string);
                            y++;
                        });
                        setTimeout(function(){
                            $('#expand'+id).attr('style','background-color:#ccc');
                        },300);
                    } 
                });
                
            }
        }
    </script>
<!-- end transaction_detail_report.view -->    