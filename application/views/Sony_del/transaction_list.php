<table id="t_list_transaction" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Date</th>
<th>Shift</th>
<th>User</th>
<th>Qty</th>
<th>View</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$Total = $row->TotalDetail ;
$DocDate = $this->Sony_del_model->tgl_str($row->DocDate) ; 
$DocNum = md5($row->DocNum) ;
?>
<tr>
<td align="center" width="10"><?php echo $no ;?></td>
<td align="center" width="80"><?php echo $DocDate ; ?> <?php echo $row->DocTime ; ?></td>
<td align="center" width="80"><?php echo $row->Shift ; ?></td>
<td align="left" width="80"><?php echo $row->username ; ?></td>
<td align="right" width="60"><?php echo $Total ; ?> - Pack</td>
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
    $("#DocNumView").val(DocNum);
    setTimeout(function(){
					$("#DocNumView").focus();
					$("#DocNumView").click();
                    
          setTimeout(function(){
					$("#DocNumView").focus();
					$("#DocNumView").click();
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
   
          
   function NotifSuccsess(data){
        new PNotify({
        title: 'Info',
        type: 'Info',
        text: data,
        hide: true
      }); }; 
      

    
    </script>
    
    <script> $(function () { $("#t_list_transaction").DataTable(); });</script>