

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
<th>Barcode A</th>
<th>Barcode B</th>
<th>Log</th>
<th>Product</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$Total = $row->Qty_2 ;
$DocDate = $this->Sony_prod_model->tgl_str($row->DocDate) ; 
$DocDate2 = $this->Sony_prod_model->tgl_str($row->DocDate) ;
$CreateDate = $this->Sony_prod_model->tgl_str($row->CreateDate) ; 
$DocNum = md5($row->DocNum) ;
?>
<tr>
<td align="center" width="10"><?php echo $no ;?></td>
<td align="left" width="80"><?php echo $row->DocNum_Ext ; ?></td>
<td align="left" width="80"><?php echo $row->DocNum_Ext_D ; ?></td>
<td align="left" width="80"><?php echo $CreateDate ; ?> <?php echo $row->DocTime ; ?> ( <?php echo $row->CodeShift ; ?> )</td>
<td align="left" width="80"><?php echo $row->PartNo ; ?></td>
<td align="center" width="60"><strong>Success</strong></td>
<td align="center" width="10">
<button type="button" onfocus="PilihEditHead('<?php echo $row->ItemID ; ?>', '<?php echo $row->DocNum ; ?>', '<?php echo $row->DocNumDetail ; ?>', '<?php echo $DocDate2 ; ?>', '<?php echo $row->PartName ; ?>', '<?php echo $row->QCCheckID ; ?>', '<?php echo $row->DocNum_Ext ; ?>', '<?php echo $row->DocNum_Ext_D ; ?>', '<?php echo $row->ShiftID ; ?>', '<?php echo $row->Qty_2 ; ?>')" id="<?php echo $row->DocNumDetail ; ?>"  class="btn btn-xs" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-edit"></i> </button>

<button type="button" onfocus="HapusDetail('<?php echo $row->DocNumDetail ; ?>','<?php echo $row->PartNo ; ?> (<?php echo $row->DocNum_Ext_D ; ?>)', '<?php echo $row->DocNum_Ext ; ?>')" class="btn btn-xs" href="#tab_content1" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-trash"></i> </button>

</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 
function HapusDetail(SysID,PartNo,RefNum){
    $("#DocNumDetailDelete").val(SysID);
    $("#RefNumDelete").val(RefNum);
     $("#myModalDelete").modal('show');
     $("#pesan").text("Anda yakin menghapus bro ?");
     $("#PartNoDelete").text(PartNo); 
	};
    </script>

<script type="text/javascript"> 
function PilihEditHead(ItemID, DocNum, DocNumDetail, DocDate, PartName, QCCheckID, DocNum_Ext, DocNum_Ext_D, ShiftID, Qty_2){
	$("#SysID").val(ItemID);
    $("#DocNum").val(DocNum);
    
    var res = DocNumDetail.substr(11, 4);
    
    $("#DocNumDetail").val(res);
    $("#PartName").val(PartName);
    $("#QCCheckID").val(QCCheckID);
    $("#RefNum").val(DocNum_Ext);
    $("#RefNum_D").val(DocNum_Ext_D);
    $("#DocDate").val(DocDate);
    $("#ShiftID").val(ShiftID);
    $("#Qty_2").val(Qty_2);
    
   $('#'+DocNumDetail).on('click', function() {
    var $this = $(this);
  $this.button('loading');
  setTimeout(function() {
       $this.button('reset');
   }, 5000);
  });
    
    setTimeout(function(){
					$("#RefNum").focus();
					$("#RefNum").click();
                    
          setTimeout(function(){
					$("#RefNum").focus();
					$("#RefNum").click();
				},300) ;
				},500) 
			return false();
	 
    }
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
  
  
  <script type="text/javascript"> 
function LikeAdd(code, IDTes){
     
    $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/LikeAdd",
			data	: "&code="+code+"&IDTes="+IDTes,
			cache	: true,
			success	: function(data){
NotifSuccsess(data);
             setTimeout(function(){
                    LikeAdd2(code, IDTes);
				},200)
			}		
		});
                
	};
    
    
    function LikeAdd2(code, IDTes){
    $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/home/JumlahLike",
			data	: "&code="+code+"&IDTes="+IDTes,
			cache	: false,
			dataType : "json",
			success	: function(data){
                $("#"+code).val(data.QtyLike);
     }  });  
	}; 
    
          
   function NotifSuccsess(data){
        new PNotify({
        title: 'Info',
        type: 'Info',
        text: data,
        hide: true
      }); }; 
      

    
    </script>
    
    <script> $(function () { $("#t_transaction_detail").DataTable(); });</script>