

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
<th>User</th>
<th>Total</th>
<th>View</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$Total = $row->TotalDetail ;
$DocDate = $this->Material_out_model->tgl_str($row->DocDate) ; 
$DocNum = md5($row->DocNum) ;
?>
<tr>
<td align="center" width="10"><?php echo $no ;?></td>
<td align="center" width="80"><?php echo $row->DocNum ; ?></td>
<td align="center" width="80"><?php echo $DocDate ; ?></td>
<td align="left" width="80"><?php echo $row->username ; ?></td>
<td align="right" width="60"><?php echo $Total ; ?> - Item</td>
<td align="center" width="10">
<a onfocus="view_detail('<?php echo $row->DocNum ; ?>')" href="#tab_content3" data-toggle="tab" aria-expanded="false">
Detail </a>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<script type="text/javascript"> 
function view_detail(DocNum){
    $("#DocNum2").val(DocNum);
    setTimeout(function(){
					$("#DocNum2").focus();
					$("#DocNum2").click();
                    
          setTimeout(function(){
					$("#DocNum2").focus();
					$("#DocNum2").click();
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
    
    <script> $(function () { $("#t_list_transaction").DataTable(); });</script>