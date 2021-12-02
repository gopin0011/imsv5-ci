

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


<table id="t_transaction_detail" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Reg</th>
<th>Log</th>
<th>Product</th>
<th>Customer</th>
<th>Qty</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$Total = $row->Qty_2 ;
$DocDate = $this->Material_in_model->tgl_str($row->DocDate) ; 
$DocDate2 = $this->Material_in_model->tgl_str($row->DocDate) ;
$CreateDate = $this->Material_in_model->tgl_str($row->CreateDate) ; 
$PartNo =  substr($row->PartNo,0,15);
$PartName =  $row->PartName;
$DocNum = md5($row->DocNum) ;
$DocNumDetail = $row->DocNumDetail ;
?>
<tr>
<td align="center" width="10"><?php echo $no ;?></td>
<td align="left" width="40"><?php echo $row->DocNumDetail ; ?></td>
<td align="left" width="80"><?php echo $CreateDate ; ?> <?php echo $row->DocTime ; ?><br /><?php echo $row->DocNum_Ext ; ?></td>
<td align="left" width="90"><?php echo $PartNo ; ?><br /><?php echo $PartName ; ?></td>
<td align="left" width="50"><?php echo $row->CustName ; ?><br /></td>
<td align="right" width="40"><?php echo $Total ; ?></td>
<td align="center" width="10">
<?php  $cek = $row->CanEdit=='0'; if(!empty($cek)){ ?>
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
            <a onfocus="PilihEdit('<?php echo $DocNumDetail ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
            <i class="glyphicon glyphicon-edit"></i> </a> 
            <a onfocus="PilihHapus('<?php echo $DocNumDetail ; ?>', '<?php echo $PartNo ; ?>', '<?php echo $row->CanEdit ; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
            <i class="glyphicon glyphicon-trash"></i> </a>
            
            
            <?php } ?> <?php } ?> 
            <a style="CURSOR: pointer; COLOR: #ff0000" 
            onclick="window.open(&#39;<?php echo base_url();?>index.php/Material_in/DetailPrint2/<?php echo $DocNumDetail ;?>&#39;,&#39;&#39;,&#39; scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no&#39;)">
			<i class="glyphicon glyphicon-print"></i></a>

</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 
function PilihEdit(id){
	$("#DocNumDetail2").val(id);
    $("#DocNumDetail").val(id.substr(12,3));
    setTimeout(function(){
					$("#DocNumDetail2").focus();
					$("#DocNumDetail2").click();
                    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
          setTimeout(function(){
					$("#DocNumDetail2").focus();
					$("#DocNumDetail2").click();
				},300) ;
				},500) 
			return false();
	 
    }
</script>
<script type="text/javascript"> 
function PilihHapus(DocNumDetail,PartNo,CanEdit){
$("#DocNumDetailDelete").val(DocNumDetail);
$("#myModalDelete").modal('show');
$("#CanEditDelete").val(CanEdit);
$("#pesan").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(PartNo);  };
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
    
    <script> $(function () { $("#t_transaction_detail").DataTable(); });</script>