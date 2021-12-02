<!-- start SearchDocNumReport.view -->
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
<table id="t_transaction_detail_report" class="table table-bordered table-striped">
<thead>
<tr>
	<th width="3%">No</th>
    <th width="15%">DocNum</th>
    <th width="10%">DocDate</th>
    <th width="13%">Customer</th>
    <th width="15%">User</th>
    <th width="6%">Total</th>
    <!--<th width="3%">Action</th>-->
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
?>
<tr id="span_<?php ?>">
<td align="left"><?php echo $no; ?></td>
<td align="left"><?php echo $row->DocNum; ?></td>
<td align="left"><?php echo $row->DocDate; ?></td>
<td align="left"><?php echo $row->PartnerCode; ?></td>
<td align="left"><?php echo $row->UserName; ?></td>
<td align="right"><?php echo $row->Total; ?> - Item</td>
<!--<td align="center"><a href="javascript:void(0);" onclick="detail_suratjalan('<?php echo $row->DocNum;?>');"><i class="fa fa-list-alt"></i></a></td>-->
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
        
        function detail_suratjalan(kode)
        {
            $("#List_Doc").html('');
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/SuratJalanSbc/GetData",
                data	: "from=report&kode="+kode,
                cache	: false,
                success	: function(data){
                    $("#List_Doc").html(data);
                }
            });
            setTimeout(function(){
                $.ajax({
                    type	: 'POST',
                    url		: "<?php echo site_url(); ?>/SuratJalanSbc/DataDetailMatIn2",
                    data	: "from=report&kode="+kode,
                    cache	: false,
                    success	: function(data){
                        $("#List_Doc").append(data);
                    } 
                });
            },500);
            $("#myModal_Search").modal("show");
        }
    </script>
<!-- end SearchDocNumReport.view -->    