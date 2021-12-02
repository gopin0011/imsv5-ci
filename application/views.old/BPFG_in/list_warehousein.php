<table id="t_list_trans" class="table table-bordered table-striped">
<thead>
<tr>
<th>No</th>
<th>Document No.</th>
<th>Date</th>
<th>User</th>
<th>Total</th>
</tr>
</thead>
<tbody>
<?php $no=0; foreach($list as $row): 
$no++;
$TotalMaterialInMPC = $this->app_model->TotalMaterialInMPC($row->DocNum);
$DocDate = $this->app_model->tgl_str($row->DocDate) ; 
$DocNum = md5($row->DocNum) ;
?>
<tr class="odd gradeX" style="cursor: pointer;" onclick="javascript:PilihListTrc_d('<?php echo $row->RegID;?>','<?php echo $row->NewDocNum;?>')" href="#tab_content4" data-toggle="tab" aria-expanded="false" >
<td align="center" width="20"><?php echo $no; ?></td>
<td align="left" width="200" ><?php echo $row->DocNum; ?></td>
<td align="left" width="300"><?php echo $DocDate ; ?> <?php echo $row->DocTime; ?></td>
<td align="left" width="40" ><?php echo $row->CreateBy; ?></td>
<td align="left" width="40" ><?php echo $row->TotalDetail ; ?> - Item</td>
</tr>
<?php endforeach;?>
</tbody>
</table>

<!--
<div class="panel-group" id="accordion_d">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion_d" href="#product_d"><span class="glyphicon ">
</span> Detail &nbsp; 
<span style="float: right;"><i class="glyphicon glyphicon-tasks"></i></span></a></h4></div>
<div id="product_d" class="collapse in">
<div class="panel-body">

<div class="col-md-12">

    <div id="list_detail_prod">
        
    </div>

</div> 


</div></div></div></div>

-->
<div class="modal fade" id="myModalListTrans" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg ativa-scroll">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">Info</h4></div><div class="modal-body"><div>              
<div id="DetailModal">
<!-- isi -->
</div>
<div style="font-size: larger; font-weight: bold;" id=""></div>
<br /><br /><br />
<div class="panel-footer">
<button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Closed</button>
<form class="navbar-right" role="search">
<div class="form-group">
<input hidden="true" type="text" id="" name="" readonly="true" >
<input hidden="true" type="text" id="" name="" readonly="true" >
</div>
</form>
</div>
</div></div></div></div></div><!-- /.modal -->

<script type="text/javascript"> 
/*
$('#picFrom').focus(function(event){
    ambilListPic($(this).attr('id'));
    $("#myModalListTrans").modal('show');
});

$('#picTo').focus(function(event){
    ambilListPic($(this).attr('id'));
    $("#myModalListTrans").modal('show');
});
*/
$('#DocDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });

$('#product_d').hide();

function ambilListPic(type)
{
    $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/BPFG_in/MasterListPic",
            data	: "type="+type,
            cache	: false,
            success	: function(data)
            {
                $('#DetailModal').html(data);
            } 
        });
}

function PilihListTrc_d(RegID,DocNum)
{
    $('#product_d').show();
    $('#TH_RawMaterialID').val(RegID);
    //$("#t_list_transaction_d tbody").empty();
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/BPFG_in/DetailTrc",
        data	: "kode="+DocNum+"&RegID="+RegID,
        cache	: false,
        success	: function(data)
        {
            //var detail = $.parseJSON(data);
            var no = 1;
            //$.each(detail.list, function(index, value) {
                //$("#t_list_transaction_d tbody").append("<tr><th><input type='hidden' value='"+value.RegID+"' name='dbRegId[]'><input type='hidden' value='"+value.ItemID+"' name='ItemID["+value.RegID+"]'>"+no+"</th><th>"+value.PartNo+"</th><th>"+value.PartName+"</th><th>"+value.Code+"</th><th><div class='col-xs-8'><input id='' name='QtyMat["+value.RegID+"]' class='form-control Qty' type='text' value='"+value.QtyMat+"' placeholder='"+value.QtyMat+"' onkeypress='return onlynumber(event);' ></div></th><th><input id='' name='ket["+value.RegID+"]' class='form-control' type='text' value='"+value.Remark+"'></th></tr>");
                //no++;
            //});
            waitingDialog3.hide();
            $('#list_detail_prod').html(data);
            //$('#tampil_data_produksi').html(data);            
        } 
    });
}

function put_header(RegID,DocNum)
{
    
    setTimeout(function()
    {        
    $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/BPFG_in/InfoTambahFormTRMatIn",
            data	: "kode="+DocNum+"&RegID="+RegID,
            cache	: false,
            success	: function(data)
            {
                setTimeout(function()
                { 
                    var detail = $.parseJSON(data);
                    alert($('#DocNum'));
                    $('#DocNum').val(detail.DocNum);
                    $('#DocNumDetail').val(detail.DocNumDetail);
                    $('#ShiftID').val(detail.ShiftID);
                    $('#Shift').val(detail.Shift);
                    $('#DocDate').val(detail.DocDate);
                    
                    
                },800);
                return detail;
            } 
        }); 
        
       $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/BPFG_in/get_header",
        data	: "RegID="+RegID,
        cache	: false,
        success	: function(data)
        {
            var detail = $.parseJSON(data);
            $('#picFrom').val(detail.diserahkan[0]);
            $('#picFromName').val(detail.diserahkan[1]);
            $('#FromArea').val(detail.diserahkan[2]);
            
            
            $('#picTo').val(detail.diterima[0]);
            $('#picToName').val(detail.diterima[1]);
            $('#ToArea').val(detail.diterima[2]);
        } 
    });
     },800);  
}



function PilihListTrc_old(RegID)
{
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function()
    {
        $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/BPFG_in/DetailTrc",
            data	: "RegID="+RegID,
            cache	: false,
            success	: function(data)
            {
                $(".ativa-scroll").css({"height":$(window).height()-50,"overflow-y":"auto"});
                $('#DetailWareHouse').html(data);
                waitingDialog3.hide();
                $("#myModalListTrans").modal('show');
            } 
        }); 
    },800) ; 
    return false(); 
}

function onlynumber(event) {
    if (event.which!=8 && event.which!=0 && (event.which<48 || event.which>57)) 
    {
        return false; 
    }
}

    function tampil_data_warehouseIN()
    {
        var kode = "" ;
        $('#reload').button('loading');
        waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
        $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/BPFG_in/TransactionListProductionIn",
        data	: "kode="+kode,
        cache	: false,
        success	: function(data){
        $("#tampil_data_produksi").html(data);  
        //$('#reload').button('reset');
        //$("#myModal100").modal('hide'); 
        waitingDialog3.hide(); 
        } }); 
    };


</script>

<script> $(function () { $("#t_list_trans").DataTable(); });</script>