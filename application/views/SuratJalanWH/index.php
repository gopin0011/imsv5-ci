<!-- start index.view -->

<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script>
    function NotifSuccsess(data){
    new PNotify({
    title: 'Info',
    type: 'info',
    text: data,
    hide: true
    }); };
    
    $(document).ready(function()
    {
       ion.sound({
            sounds: [
                {name: "metal_plate"},
                {name: "water_droplet"}
            ],
            path: "<?php echo base_url(); ?>assets/sounds/",
            preload: true,
            volume: 1.0
        });
        
        tampil_data();
        Detail_data();
        
        function tampil_data()
        {
            var kode = "" ;
            $('#reload').button('loading');
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/SuratJalanWH/TransactionList",
                data	: "kode="+kode,
                cache	: false,
                success	: function(data)
                {
                    $("#tampil_data").html(data);  
                    $('#reload').button('reset');
                    $("#myModal100").modal('hide'); 
                } 
            }); 
        }
        
        function Detail_data()
        {
            var kode = "";
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/SuratJalanWH/DetailData",
                data	: "kode="+kode,
                cache	: false,
                success	: function(data)
                {
                    $("#Detail_data").html(data); 
                } 
            });
        }
        
        $('#form-tab').click(function(){
            waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
            $('#PartnerID').removeAttr('disabled');
            $('#DlvAddress, #SectionHead, #ShipTime, #DriverName, #CarNum, #Remark').removeAttr('readonly');
            $('#DocDate').val('');
            $('#DocNum').val('');
            $('#DocNumDetail').val('');
            $('#DlvAddress').val('');
            $('#ReleaseDate').val('');
            $('#PartnerID').val('');
            $('#ShipDate').val('');
            $('#SectionHead').val('');
            $('#CarNum').val('');
            $('#ShipTime').val('');
            $('#DriverName').val('');
            $('#Remark').val('');
            $('#Username').val('');
            $('#PartnerName').val('');
            $('#Address').val('');
            //$('#SectionHead').removeAttr('readonly');
            //$('#CarNum')
            $('#t_list_sj tbody').empty();
            setTimeout(function () 
            { 
                AmbilForm(); 
                setTimeout(function(){
                //$("#tab_tambah_detail").click();
                waitingDialog3.hide(); },300);
            }, 1000);
        });
        
        function AmbilForm()
        {
            var kode = "";
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/SuratJalanWH/InfoTambahFormInFG",
                data	: "kode="+kode,
                cache	: false,
                dataType : "json",
                success	: function(data)
                {
                    $('#form_tabcontent2').html(data.Templates);
                    $("#DocNum").val(data.DocNum);
                    $("#DocNumDetail").val(data.DocNumDetail); 
                    $("#CreateDate").val(data.CreateDate);
                    $("#DocDate").val(data.DocDate);
                    $("#CreateTime").val(data.CreateTime);
                    $("#SJDate").val(data.CreateDate);
                    $("#DocNumDetail3").val(""); 
                    $("#DocNumDetail2").val("");
                    $("#PickupDate").val(data.CreateDate);
                    $("#ShipDate").val(data.CreateDate);
                    $("#ReleaseDate").val(data.CreateDate);
                    $("#ShipTime").val(data.ShipTime);
                    $("#PickupTime").val(data.CreateTime);
                    $("#Username").val(data.Username);
                }
            });
        }
        
        $("#ItemID").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
        $("#PartNo").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
        
        $('#Reload2').on('click', function() 
        {
            var $this = $(this);
            $this.button('loading');
            MasterList(); 
        });
        
        
        
        function cek_qty()
        {
            var hasil = true;
            var itemID = document.getElementsByName('list_d[]');
            $.each(itemID,function(){
                //alert(this.value);
                var id = this.value;
                if($('#Quantity_'+id).val()=="")
                {
                    alert('Quantity belum di isi');
                    hasil = false;
                    return false;
                }
                if($('#IDUnit_'+id).val()=="")
                {
                    alert('Unit belum di pilih');
                    hasil = false;
                    return false;
                }
           });
           
           return hasil;
        }
        
        
        $('#simpan').click(function(){           
           if($('#DocDate').val()=="")
           {
            alert('DocDate Tidak Boleh Kosong');
            return false;
           }             
           
           if($('#DocNum').val()=="")
           {
            alert('DocNum Tidak Boleh Kosong');
            return false;
           }           
                                
           if($('#PartnerName').val()=="")
           {
            alert('Customer Tidak Boleh Kosong');
            return false;
           }
           
           if($('#DlvAddress').val()=="")
           {
            alert('Dlv Address Tidak Boleh Kosong');
            return false;
           }
           
           var detail = $("#t_list_sj > tbody > tr");
           if($(detail).length < 1)
           {
                alert('Product Belum Di Tambahkan');
                return false;
           }
           else 
           {
            if (!cek_qty()) return false;
           }
           
            waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'}); 
            
            var string = $('#formSJ').serialize();
            string += '&'+$('#detailSJ').serialize();
            
            $.ajax({
                type	: 'POST',
                url	: "<?php echo site_url(); ?>/SuratJalanWH/simpan",
                data	: string,
                cache	: false,
                success	: function(data){
                    var d = JSON.parse(data);
                    if(d['status']!= '0')
                    {
                        setTimeout(function(){
                            $.ajax({
                                type	: 'POST',
                                url	: "<?php echo site_url(); ?>/SuratJalanWH/SendMailSuratJalan",
                                data	: "RegID="+d['RegID']+"&status="+d['status']+"&CreateBy="+d['CreateBy'],
                                cache	: false,
                                success	: function(d){
                                    
                                }
                           });
                        },500);
                    }                    
                    setTimeout(function(){
                        $('#Home2').trigger('click');
                        $('#reload').trigger('click');
                        waitingDialog3.hide();
                        //Detail_data(); 
                        //AmbilFormDetail();
                    //NotifSuccsess(data); 
                    },1000) 
                },
                error : function(xhr, teksStatus, kesalahan) {
                    $("#myModal4").modal('show');
                    $("#pesan4").text('Server tidak merespon :'+kesalahan); 
                } 
            });
            return false;
        });
        
        $("#PrintList1").click(function()
        {
            var kode	= $("#DocNum").val();
            window.open('<?php echo site_url();?>/SuratJalanWH/PrintList/'+kode , 'myWindow', 
            'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
            return false(); 
        });
        
        $("#DocNum2").keydown(function(){ Detail_data2(); });
        $("#DocNum2").keyup(function(){ Detail_data2(); });
        $("#DocNum2").click(function(){ Detail_data2(); });
        $("#DocNum2").focus(function(){ Detail_data2(); });
        
        function Detail_data2()
        {
            var kode = $("#DocNum2").val();
                        
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/SuratJalanWH/GetData",
                data	: "kode="+kode,
                cache	: false,
                success	: function(data){
                    $("#header_data").html(data);
                } 
            });
            
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/SuratJalanWH/DataDetailMatIn2",
                data	: "kode="+kode,
                cache	: false,
                success	: function(data){
                $("#Detail_data2").html(data);
                    waitingDialog3.hide(); 
                } 
            });
        }
        
        $('#b_tambah').click(function(){
            $('#form-tab').trigger('click');
        });
        
        $('#PrintList2').click(function(){
           window.open('<?php echo site_url();?>/SuratJalanWH/PrintList/'+$(this).attr('data-ref'),'',' scrollbars=yes,menubar=no,width=1100,height=600, resizable=yes,toolbar=no,location=no,status=no'); 
        });
        
        $('#reload').click(function(){
            var $this = $(this);
            $this.button('loading');
            tampil_data();
        });
        
        $("#PartNo2, #ItemID2").click(function(){ $("#myModal_product2").modal('show'); MasterList2(); });
        
        function MasterList2()
        {
            var kode = "";
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/SuratJalanWH/MasterList2",
                data	: "kode="+kode,
                cache	: false,
                success	: function(data)
                {
                    $("#MasterList2").html(data);	
                } 
            }); 
        }
        
        
        $("#Search").click(function()
        {
            var IDCust2 = $("#IDCust2").val();
            var tgl1 = $("#tgl1").val();
            var tgl2 = $("#tgl2").val();
            var string = "&tgl1="+tgl1+"&tgl2="+tgl2+"&IDCust2="+IDCust2;
            
            if(tgl1.length==0){ NotifFail('Tanggal tidak boleh kosong'); return false(); }
            if(tgl2.length==0){ NotifFail('Tanggal tidak boleh kosong'); return false(); }
            var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
            $("#transaction_detail_report").html('');
            $.ajax({
                type	 : 'POST',
                url	 : "<?php echo site_url(); ?>/SuratJalanWH/ReadReport",
                data	 : string,
                cache	: false,
                success	: function(data){
                setTimeout(function()
                {
                    waitingDialog3.hide();
                        $("#transaction_detail_report").html(data); 
                    },2000);
                } 
            });
            return false(); 
        });
        
        $('#empty').click(function(){
           $('#ItemID2').val('');
           $('#PartNo2').val('');
        });
    
        $('#Home3a').click(function(){
            //$('#reload').button('loading');
            tampil_data();
        });
        
        $('#form-tab3').click(function(){
            $('#form-tab').trigger('click');
        });
        
        $('#PrintList3').click(function(){
            var IDCust2= $("#IDCust2").val();
            var tgl1 = $("#tgl1").val();
            var tgl2 = $("#tgl2").val();
            var string = tgl1+"/"+tgl2+"/"+IDCust2;
            if(tgl1.length == 0){
                $("#myModal2").modal('show');
                $("#pesan").text('Tanggal tidak boleh kosong'); return false(); }
            
            if(tgl2.length == 0){
                $("#myModal2").modal('show');
                $("#pesan").text('Tanggal tidak boleh kosong'); return false(); } 
            
            $("#PrintList3").button('loading');
            setTimeout(function(){
            $("#PrintList3").button('reset'); }, 1000);
            
            window.open('<?php echo site_url();?>/SuratJalanWH/PrintListReport/'+string , 'myWindow', 
            'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
            return false();
        });
        
        $('#ExportList').click(function(){
            var string = $(this).data('ref');
            window.open('<?php echo site_url();?>/SuratJalanWH/ExportReport/'+string); 
            return false();
        });
        
        $('#report-tab').click(function(){
            $('#transaction_detail_report').html('');
        });
    });
</script>
  
<script type="text/javascript">
</script>

<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php $cek = $this->Role_Model->TrcSJWH(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa  fa-plus"></i>&nbsp; New</a><?php } ?>

<a href="#tab_content4" role="tab" id="report-tab" data-toggle="tab" aria-expanded="false" class="btn btn-info">
<i class="fa fa-folder-open"></i>&nbsp; Report</a>
<button type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>

<!--
<div class="col-xs-3 pull-right">
<div class="input-group">
<input type="text" class="form-control" id="DocNumSearch" name="DocNumSearch" placeholder="Barcode">
<span class="input-group-btn">
<a  onclick="Search()" href="#" >
<button class="btn btn-default" id="DocNumSearchButton" type="button">Go!</button></a>
</span>
</div></div>
-->

</div></div></div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">

<?php $cek = $this->Role_Model->TrcSJWH(); if(!empty($cek)){ ?>
<div id="tampil_data"></div>
<?php } ?>
</div></div></div></div>

<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="form-tab">

<div class="box-body">
<div class="box">
<div class="box-body">

<div id="form_tabcontent2">

</div>
</div></div></div>
<div class="box-body"><div class="box"><div class="box-body">
<div id="Detail_data"></div>
</div></div>



<div class="box-body panel-footer">
<div class="box-tools pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle"> 
<?php $cek = $this->Role_Model->TrcSJWH(); if(!empty($cek)){ ?>
<button type="button" name="simpan" id="simpan" class="btn btn-warning"><i class="fa fa-save"></i> Save</button>
<!--<button type="button" id="tab_tambah_detail" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-plus"></i>&nbsp; Add</button>-->
<?php } ?>
<a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
<i class="fa fa-mail-reply"></i> Closed</a>
</div></div>
</div>

</div></div>


<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="view-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php $cek = $this->Role_Model->TrcSJWH(); if(!empty($cek)){ ?>
<a id="b_tambah" onfocus="" href="#tab_content2" data-toggle="tab" aria-expanded="false" class="btn btn-warning" ><i class="glyphicon glyphicon-plus"></i> New</a>
<?php } ?>
<button type="button" name="PrintList2" id="PrintList2" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Print</button>
<button id="ExportList" class="btn btn-primary" type="button" name="ExportList" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-file-excel-o"></i>
  Download
</button>
<a href="#tab_content1" id="Home3" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-info">
<i class="fa fa-reply"></i> Closed</a>
</div></div>
<div class="pull-right">
<div class="input-group">
<input type="text" class="form-control" id="DocNum2" name="DocNum2" placeholder="Barcode">
<span class="input-group-btn">
</span>
</div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<div id="header_data"></div>
</div></div></div>


<div class="box-body">
<div class="box">
<div class="box-body">
<div id="Detail_data2"></div>
</div></div></div>
</div></div></div>

<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="report-tab">



<div class="box-body">
<div class="box">
<div class="box-body">

<form class="form-horizontal" name="form_id" id="form_id">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi3" ><span  class="glyphicon ">
</span> Properties&nbsp;
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
<div id="transaksi3" class="collapse in">
<div class="panel-body">
<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">Start</label>
<div class="col-xs-8">
<div class="input-group date">
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_1 ; ?>" id="tgl1" name="tgl1">
</div>
                
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">End</label>
<div class="col-xs-8">
<div class="input-group date">
<div class="input-group-addon">
<i class="fa fa-calendar"></i>
</div>
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_2 ; ?>" id="tgl2" name="tgl2">
</div></div></div>
</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Vendor</label>
<div class="col-xs-7">
<select id="IDCust2" name="IDCust2" class="form-control" style="width: 100%;">
<?php if(empty($IDCust)){ ?>
<option value="" selected="selected">All</option>
<?php } foreach($l_cust->result() as $t){ if(''==$t->SysID){ ?>
<option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->PartnerCode;?></option>
<?php }else { ?>
<option value="<?php echo $t->SysID;?>"><?php echo $t->PartnerCode;?></option>
<?php } } ?>  
</select>
</div>
</div>
</div>

</div>
</div></div></div>
</form>
</div>
<div class="box-body"><div class="box box-success"><div class="box-body"> 
           
<div class="col-md-8">
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="Search" id="Search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
<!--<button type="button" class="btn btn-success" id="Download3" name="Download3" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="glyphicon glyphicon-import"></i>&nbsp; Download</button>-->
<button type="button" class="btn btn-info" id="PrintList3" name="PrintList3" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>
<a href="#tab_content1" id="Home4" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-warning">
<i class="fa fa-reply"></i> Closed</a>
<?php $cek = $this->Role_Model->TrcSJWH(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab3" data-toggle="tab" aria-expanded="false" class="btn btn-success">
<i class="fa  fa-plus"></i> Transaction</a><?php } ?>


</div></div></div>
<div class="col-md-3 col-md-offset-1">
<div class="input-group">
<input type="text" class="form-control" name="DocNumSearch" id="DocNumSearch" placeholder="DocNum">
<span class="input-group-btn">
<button type="button" class="btn btn-default" id="searchDocNum" name="searchDocNum" data-loading-text="<i class='fa fa-spinner fa-spin '></i>&nbsp;">
  Go
</button>
</span>
</div>
</div>
<script>
    $('#DocNumSearch').keypress(function(e){
        if(e.which == 13)
        {
            $('#searchDocNum').trigger('click');                       
        }
    });
    
    $('#searchDocNum').click(function(){
        if($('#DocNumSearch').val()!='')
        {
            cari_docnum();
        }
    });
    
    function cari_docnum()
    {
        $('#searchDocNum').button('loading');
        var val = $('#DocNumSearch').val();
        waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'}); 
        $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/SuratJalanWH/GetDocNumReport",
                data	: "DocNum="+val,
                cache	: false,
                success	: function(data)
                {
                    waitingDialog3.hide();
                    $('#searchDocNum').button('reset');
                    $('#transaction_detail_report').html(data);
                }
        });
    }
</script>

</div></div></div>
</div></div>
<div class="box-body">
<div class="box">
<div class="box-body">
<div id="transaction_detail_report"></div>
</div></div></div>
</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="view-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="confirm" id="confirm" class="btn btn-success"><i class="glyphicon glyphicon-ok" id="b_confirm"></i> Confirm</button>
<a href="#tab_content1" id="Home3a" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-info">
<i class="fa fa-reply"></i> Closed</a>
</div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<div class="col-md-10 col-md-offset-1">
<div id="header_data2"></div>
</div>
</div></div></div>

<script>
    function proses_confirm(obj,status)
    {
        waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
        var RegID = $('#RegIDConfirm').val();
        //alert(status);
        $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/SuratJalanWH/update_confirm/",
            data	: "RegID="+RegID+"&status="+status,
            cache	: false,
            success	: function(data)
            {
                NotifSuccsess(data);
                setTimeout(function(){
                    $('#Home3a').trigger('click');
                    waitingDialog3.hide();
                },500);
            } 
        });
    }
</script>

</div></div></div>

</div></div>


<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">Info</h4></div><div class="modal-body"><div>              
<div id="pesan"></div>
<div style="font-size: larger; font-weight: bold;" id="PartNoDelete"></div>
<br /><br /><br />
<div class="panel-footer">
<button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Closed</button>
<button type="button" name="HapusDetail" id="HapusDetail" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
<form class="navbar-right" role="search">
<div class="form-group">
<input hidden="true" type="text" id="BalanceDelete" name="BalanceDelete" readonly="true" >
<input hidden="true" type="text" id="ItemIDDelete" name="ItemIDDelete" readonly="true" >
<input type="text" id="DocNumDetailDelete" name="DocNumDetailDelete" class="form-control" readonly="true" ></div>
</form>
</div>
</div></div></div></div></div><!-- /.modal -->


<div class="modal fade" id="myModal_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="Reload2" name="Reload2" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList"></div>
</div> </div> </div> </div> </div> </div> </div>

<div class="modal fade" id="myModal_product2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">List Product</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList2"></div>
</div></div></div></div></div></div></div>


 <div class="modal fade" id="myModal_Search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" id="myModal_Searchb" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>

<input hidden="true" type="text" id="DocNumModalSearch" name="DocNumModalSearch" placeholder="Search">

</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="List_Doc"></div>
</div> </div> </div> </div> </div> </div> </div>


<script>

    
  $(function (){    
    //Initialize Select2 Elements PartnerID2 PartnerID2
    $("#PartnerID2").select2();  $("#IDCust2").select2(); $("#IDCust").select2();
    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    
    $('#tgl1').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#tgl2').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script> 

<!-- end index.view -->
