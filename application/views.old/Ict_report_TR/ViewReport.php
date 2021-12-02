<!-- start ViewReport.view -->

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
 <th>Product</th>
 <th>Spec</th>  
 <th>IN</th>
 <th>OUT</th>
 <th align="center">Bal</th>
 <!--<th>&nbsp;</th>-->
 <!--<th align="center">Amount</th>-->
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
 $no++;
 $tgl_awal  = $this->app_model->tgl_sql($tgl_1);
 $tgl_akhir = $this->app_model->tgl_sql($tgl_2);
 $tgl_pembanding = $tgl_2 ;        
 //Time SERVER,
 date_default_timezone_set('Asia/Jakarta');
 $tgl_sekarang	= date('d-m-Y');
 $tgl_akhir_22	= strtotime('+1 day',strtotime($tgl_pembanding));
 $tgl_akhir_23 = date('d-m-Y',$tgl_akhir_22 );
 $tgl_sekarang2 = $this->app_model->tgl_sql($tgl_sekarang);
 $tgl_akhir_2 = $this->app_model->tgl_sql($tgl_akhir_23);
 $IN  = $this->app_model->QtyICTTR_IN($row->ItemID,$tgl_awal,$tgl_akhir);
 $OUT  = $this->app_model->QtyICTTR_OUT($row->ItemID,$tgl_awal,$tgl_akhir);
 $IN_F  = $this->app_model->QtyICTTR_IN($row->ItemID,$tgl_awal,$tgl_akhir);
 $OUT_F  = $this->app_model->QtyICTTR_OUT($row->ItemID,$tgl_awal,$tgl_akhir);
 if($IN_F==0){$IN_R='-';}else{$IN_R= number_format($IN_F);}
 if($OUT_F==0){$OUT_R='-';}else{$OUT_R= number_format($OUT_F);}
 $IN_2  = $this->app_model->QtyICTTR_IN($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
 $OUT_2  = $this->app_model->QtyICTTR_OUT($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
 $IN_Amount  = $this->app_model->QtyAmount_IN($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
 $OUT_Amount = $this->app_model->QtyAmount_OUT($row->ItemID,$tgl_akhir_2,$tgl_sekarang2);
 if($tgl_pembanding == $tgl_sekarang){
 $Stock      = $row->BalMat;
 $BalAmount  = $row->BalAmount;
 }else{
 $Stock2     = $row->BalMat;
 $Stock      = ($Stock2 - $IN_2) + $OUT_2  ;
 $BalAmount2  = $row->BalAmount;
 $BalAmount  = ($BalAmount2 - $IN_Amount) + $OUT_Amount  ;
 }             
 if($Stock==0){$Stock_R='-';}else{$Stock_R = number_format($Stock);}
 if($BalAmount==0){$BalAmount_R='-';}else{$BalAmount_R = number_format($BalAmount);}
?>
<tr>
 <td align="left" width="20"><?php echo $no; ?></td>
 <td width="250" ><?php echo $row->PartNo; ?><br /><?php echo $row->PartName; ?></td>
 <td align="left" width="150" ><?php echo $row->Category; ?> <br /><?php echo $row->Spec1; ?> &nbsp;<?php echo $row->Spec2; ?></td>  
 <td align="left" width="80" ><?php echo $IN_R; ?> </td>
 <td align="left" width="80" ><?php echo $OUT_R; ?> </td>
 <td align="left" width="80" ><span id="EditStock_<?php echo $row->ItemID;?>"><?php if($this->session->userdata('CanEditDoc')=='1') { ?><a href="javascript:void(0);" onclick="editBal(this,'<?php echo $row->StockWIP2 ; ?>');" data-ref="<?php echo $row->ItemID;?>"><?php echo $row->StockWIP2 ; ?> </a><?php } else { echo $row->StockWIP2; } ?></span></td>
 <!--<td align="center" width="20" ><a onfocus="PilihEdit('<?php echo $row->ItemID ; ?>')" href="#tab_content3" data-toggle="tab" aria-expanded="false"><i class="glyphicon glyphicon-edit"></i></a></td>-->
 <!--<td align="left" width="80" ><?php echo $BalAmount_R ; ?> </td>-->  
</tr>
<?php endforeach;?>
</tbody>
</table>


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
type: 'info',
text: data,
hide: true
}); };

function PilihEdit(id){
 $("#ItemID").val(id);
 setTimeout(function(){
 $("#ItemID").focus();
 $("#ItemID").click(); },700) 
 return false(); }
 
function NotifFail(data){
new PNotify({
title: 'Info',
type: 'error',
text: data,
hide: true
}); }; 

    function updateBal(obj,stock)
    {
        //alert($(obj).data('ref'));
        var targetObj = 'EditStock_'+$(obj).data('ref');
        var id = $(obj).data('ref');
        
        if ($(obj).val().length==0) 
        {
            $("#"+targetObj).html('<a href="javascript:void(0);" onclick="editBal(this,'+stock+');" data-ref="'+id+'">'+stock+'</a>');
            return false; 
        } 
             
        setTimeout(function(){
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/Ict_report_TR/UpdateBalance",
                data	: "ItemID="+$(obj).data('ref')+"&val="+$(obj).val()+"&stock="+stock,
                cache	: false,
                success	: function(data)
                {
                     //alert(data);
                     //NotifSuccsess(data); 
                     //return false();
                     $("#"+targetObj).html('<a href="javascript:void(0);" onclick="editBal(this,'+$(obj).val()+');" data-ref="'+id+'">'+data+'</a>');
                } 
            });
            //alert($(obj).data('ref'));
            //$("#"+targetObj).html('<a href="javascript:void(0);" onclick="editBal(this,'+$(obj).val()+');" data-ref="'+id+'">'+$(obj).val()+'</a>');
        },300);
    }
    
    function editBal(obj,val)
    {
        //alert($(obj).data('ref'));
        //cek(val);
        var id = $(obj).data('ref');
        var targetObj = 'EditStock_'+$(obj).data('ref');
        $("#"+targetObj).html('<input id="txt_'+id+'" name="bal[]" class="form-control cek" value="'+val+'" type="text" onblur="updateBal(this,\''+val+'\')" data-ref="'+id+'" >');
        $("#txt_"+id).focus();
        
        $("#txt_"+id).keypress(function(data){
             if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) 
             {
                return false; 
             } 
             
        });
    }
    
    

 
 </script>    
    <script> $(function () { $("#t_transaction_detail").DataTable(); });</script>
    
<!-- end ViewReport.view -->    