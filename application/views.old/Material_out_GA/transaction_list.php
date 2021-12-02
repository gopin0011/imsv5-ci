

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


<table id="t_list_transaction" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Document No.</th>
<th>Date</th>
<th>Created By</th>
<th>Total</th>
<th>View</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$DocDate = $this->app_model->tgl_str($row->CreateDate) ;  ?>

<tr class="odd gradeX" onclick="javascript:PilihListTrc('<?php echo $row->DocNum ;?>')" href="#tab_content3" data-toggle="tab" aria-expanded="false">
<td align="center" width="20"><?php echo $no ; ?></td>
<td align="left" width="200" ><?php echo $row->DocNum; ?></td>
<td align="left" width="250"><?php echo $DocDate ; ?> <?php echo $row->DocTime; ?></td>
<td align="left" width="70" ><?php echo $row->CreateBy; ?></td>
<td align="left" width="40" ><?php echo $row->TotalDetail ; ?> - Item</td>
<td align="center" width="20">
<a onclick="javascript:PilihListTrc('<?php echo $row->DocNum;?>')" href="#tab_content3" data-toggle="tab" aria-expanded="false" >
<i class="fa fa-list-alt"></i> </a>
</td></tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 
function PilihListTrc(id){
$("#DocNum2").val(id);
waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
setTimeout(function(){
$("#DocNum2").focus();
$("#DocNum2").click(); },800) 
return false(); }
</script>
  
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
    <script> $(function () { $("#t_list_transaction").DataTable(); });</script>