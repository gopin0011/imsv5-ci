<!-- start List_d.view -->

<?php foreach($list as $r =>$v)
{
    ?>
    <form class="form-horizontal" id="myForm">
    <input type="hidden" name="RegID" id="RegID" value="<?php echo $RegID;?>">
    <input type="hidden" name="DocNumID" id="DocNumID" value="<?php echo $DocNum;?>">
    <table id="aaa" class="table table-bordered table-striped" >
    <thead>
    <tr>
        <th colspan="8">
        <div class="panel-body">
            <div class="col-md-6">
                <div class="form-group">
                <label class="col-xs-4 control-label">Dari Area</label>
                <div class="col-xs-8">
                <input type="text" id="FromArea" name="FromArea"  class="form-control" readonly="readonly">
                                
                </div>
                </div>
                <div class="form-group">
                <label class="col-xs-4 control-label">Ke Area</label>
                <div class="col-xs-8">
                <input type="text" id="ToArea" name="ToArea"  class="form-control" readonly="readonly"></div></div>
                
                <div class="form-group">
                <label class="col-xs-4 control-label">Tanggal</label>
                <div class="col-xs-4">
                <input id="DocDate" class="form-control" name="DocDate" readonly="readonly" type="text">
                </div>
                </div>
                
                <div class="form-group">
                <label class="col-xs-4 control-label">Shift</label>
                <div class="col-xs-4">
                <input id="Shift" class="form-control" name="Shift" readonly="readonly" type="text">
                <input id="ShiftID" name="ShiftID" type="hidden">
                </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                <label class="col-xs-4 control-label">Diserahkan</label>
                <div class="col-xs-4">
                <input id="picFrom" class="form-control" name="picFrom" readonly="true" type="text">
                </div>
                <div class="col-xs-4">
                <input id="picFromName" class="form-control" name="picFromName" placeholder="Nama Pic" readonly="true" type="text">
                </div>
                </div>
                
                <div class="form-group">
                <label class="col-xs-4 control-label">Diterima</label>
                <div class="col-xs-4">
                <input id="picTo" class="form-control" name="picTo" readonly="true" type="text">
                </div>
                <div class="col-xs-4">
                <input id="picToName" class="form-control" name="picToName" placeholder="Nama Pic" readonly="true" type="text">
                </div>
                </div>
            
                <div class="form-group">
                <label class="col-xs-4 control-label">DocNum</label>
                <div class="col-xs-5">
                <input id="DocNum" class="form-control" name="DocNum" readonly="readonly" type="text">
                </div>
                <div class="col-xs-3">
                <input id="DocNumDetail" class="form-control" name="DocNumDetail" readonly="readonly" type="text">
                </div></div>
            </div>
        </div>
        </th>
    </tr>    
    <tr>
    <th width="20">No</th>
    <th width="100">DocNum</th>
    <th width="200">Part No.</th>
    <th width="300">Part Name</th>
    <th width="40">Customer</th>
    <th width="70">Total</th>
    <th>Keterangan</th>
    <th width="50">&nbsp;</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $no = 1;
        foreach($v['data'] as $vv)
        {
            echo'<tr id="'.$vv->RegID.'">
                     <th>'.$no.'</th>
                     <th>'.$vv->Raw_DocNum.'</th>
                     <th>'.$vv->PartNo.'</th>
                     <th>'.$vv->PartName.'</th>
                     <th>'.$vv->Code.'</th>
                     <th><span id="Qty_'.$vv->RegID.'">'.$vv->QtyMat.'</span></th>
                     <th><span id="Ket_'.$vv->RegID.'">'.$vv->ket.'</span></th>
                     <th><a onclick="PilihEdit(\''.$vv->RegID.'\',\''.$vv->QtyMat.'\',\''.$vv->ket.'\')" href="javascript:void(0);" data-toggle="tab" aria-expanded="false">
<i class="glyphicon glyphicon-edit"></i>
</a>
<a onfocus="PilihHapus(\''.$vv->RegID.'\')" href="javascript:void(0);">
<i class="glyphicon glyphicon-trash"></i>
</a></th>
                 </tr>';
            $no++;
        }
    ?>    
    </tbody>
    </table>   
    </form> 
    <?php
}
?>

<script>
    $(document).ready(function(){
        $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/BPFG_in/get_header_trans",
            data	: "RegID="+$('#RegID').val(),
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
                
                $('#Shift').val(detail.Shift);
                $('#ShiftID').val(detail.ShiftID);
                
                $('#DocNum').val(detail.DocNum);
                $('#DocNumDetail').val(detail.DocNumDetail);
                
                $('#DocDate').val(detail.DocDate);
            } 
        });   
    });
    
    function PilihHapus(RegID)
    {
        $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/BPFG_in/hapus_trans_detail",
            data	: "RegID="+RegID,
            cache	: false,
            success	: function(data)
            {
                $('#'+RegID).remove();
            } 
        });
    }
    
    function PilihEdit(RegID,QtyMat,Ket)
    {
        //QtyMat = parseInt($('#Qty_'+RegID).text());
        //Ket = $('#Ket_'+RegID).text();
        //console.log($('#Qty_'+RegID).text());
        QtyMat = (isNaN(parseInt($('#Qty_'+RegID).text()))) ? QtyMat : parseInt($('#Qty_'+RegID).text());
        var input_qty = '<input type="text" value="'+QtyMat+'" class="form-control" name="txt_qty_'+RegID+'" id="txt_qty_'+RegID+'" onblur="" placeholder="'+QtyMat+'" onkeypress="return onlynumber(event);">';
        var input_ket = '<div class="col-xs-6"><input width="100px" type="text" value="'+Ket+'" class="form-control" name="txt_ket_'+RegID+'" id="txt_ket_'+RegID+'" onblur="" placeholder="'+Ket+'" ></div>';
        input_ket += '<a class="btn btn-primary" href="javascript:void(0);" onclick="update_detail(\''+RegID+'\');"><i class="fa fa-save"></i></a>';
        input_ket += '<a class="btn btn-primary" href="javascript:void(0);" onclick="cancel_detail(\''+RegID+'\',\''+QtyMat+'\',\''+Ket+'\');"><i class="fa fa-reply"></i></a></div>';
        $('#Qty_'+RegID).html(input_qty);
        $('#Ket_'+RegID).html(input_ket);
        $('#txt_qty_'+RegID).focus();
    }
    
    function cancel_detail(RegID,QtyMat,Ket)
    {
        //var QtyMat = $('#txt_qty_'+RegID).val();
        //var Ket = $('#txt_ket_'+RegID).val();
        $('#Qty_'+RegID).html(QtyMat);
        $('#Ket_'+RegID).html(Ket);
    }
    
    function update_detail(RegID)
    {
        var QtyMat = $('#txt_qty_'+RegID).val();
        var Ket = $('#txt_ket_'+RegID).val();
        //console.log(QtyMat);
        waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
        setTimeout(function()
        {
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/BPFG_in/update_detail",
                data	: "RegID="+RegID+"&QtyMat="+QtyMat+"&Ket="+Ket,
                cache	: false,
                success	: function(data)
                {
                    //$('#'+RegID).remove();
                    waitingDialog3.hide();
                    $('#Qty_'+RegID).html(QtyMat);
                    $('#Ket_'+RegID).html(Ket);
                } 
            });
        },800); 
    }
    
    $('#reload2').click(function(e){
        PilihListTrcBPFG($('#RegID').val());
    });
    
    $("#ExportList3").click(function(){
        /*
        var IDCategory = $("#IDCategory").val();
        var PartnerID2 = $("#PartnerID2").val();
        var ItemID2 = $("#ItemID2").val();
        var tgl1 = $("#tgl1").val();
        var tgl2 = $("#tgl2").val();
        if(tgl1.length == 0){ NotifFail('Tanggal tidak boleh kosong'); return false(); }
        if(tgl2.length == 0){ NotifFail('Tanggal tidak boleh kosong'); return false(); } 
        if(PartnerID2.length==0){ $("#PartnerID2").val("ALL"); return false(); }
        */
        var string = $('#RegID').val()+"/"+$('#DocNumID').val();
        location.replace('<?php echo site_url();?>/BPFG_in/ExportReport/'+string); return false(); 
     });
     
     $('#print').click(function(e){   
        var string ='';
        window.open('<?php echo site_url();?>/BPFG_in/PrintList/'+string , 'myWindow', 
        'status = 1, height = 850, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
        return false();
     });
     
    function onlynumber(event) {
        //alert(event.which);
        if (event.which!=8 && event.which!=0 && (event.which<48 || event.which>57)) 
        {
            return false; 
        }
    }
</script>
<!-- start List_d.view -->