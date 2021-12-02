<!-- start index.view -->


<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa  fa-plus"></i>&nbsp; New</a><?php } ?>

<a href="#tab_content5" role="tab" id="report-tab" data-toggle="tab" aria-expanded="false" class="btn btn-info">
<i class="fa fa-folder-open"></i>&nbsp; Report</a>
<button type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>

<div class="col-xs-3 pull-right">
<div class="input-group">
<input type="text" class="form-control" id="DocNumSearch" name="DocNumSearch" placeholder="Barcode">
<span class="input-group-btn">
<a  onclick="Search()" href="#" >
<button class="btn btn-default" id="DocNumSearchButton" type="button">Go!</button></a>
</span>
</div></div>

</div></div></div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">

<div id="tampil_data"></div>

</div></div></div></div>





<div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="report-tab">



<div class="box-body">
<div class="box">
<div class="box-body">

<form class="form-horizontal" name="form_report" id="form_report">
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
<label class="col-xs-4 control-label">Customer</label>
<div class="col-xs-8">
<select id="IDCust" name="IDCust" class="form-control" style="width: 100%;">
<?php if(empty($IDCust)){ ?>
<option value="semua">All</option>
<?php } foreach($l_cust->result() as $t){ if($IDCust==$t->Code){ ?>
<option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Code;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option>
<?php } } ?>  
</select>
</div></div>

<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-8">
<input type="text" id="PartNo2" name="PartNo2"  class="form-control" >
</div></div>
</div></div>
</div></div></div>
</form>
</div>
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="Search" id="Search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
<button type="button" class="btn btn-info" id="PrintList3" name="PrintList3" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>
<a href="#tab_content1" id="Home44" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-warning">
<i class="fa fa-reply"></i> Closed</a>

</div></div></div></div></div>
</div></div>
<div class="box-body">
<div class="box">
<div class="box-body">
<div id="list_report_bpfg">
<!-- list report -->

</div>
</div></div></div>
</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="form-tab">

<div class="box-body">
<div class="box">
<div class="box-body">


<div class="panel-group" id="accordion">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#product"><span class="glyphicon ">
</span> Data WareHouse FG In &nbsp; 
<span style="float: right;"><i class="glyphicon glyphicon-tasks"></i></span></a></h4></div>
<div id="product" class="collapse in">
<div class="panel-body">

<div class="col-md-12">
<!-- list -->
<div id="tampil_data_produksi"></div>
<!-- list -->
</div> 


</div></div></div></div></form>


<div class="box-body panel-footer">
<div class="box-tools pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle"> 

<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){  } ?>  
<a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
<i class="fa fa-mail-reply"></i> Closed</a>

</div></div>
<form class="pull-right" role="search">
<div class="form-group">
<input type="text" id="DocNumDetail2" name="DocNumDetail2" class="form-control" placeholder="Search"></div>

</div>
</div></div></div>
<div class="box-body"><div class="box"><div class="box-body">
<div id="Detail_data"></div>
</div></div></div></div>


<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="view-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">

<button type="button" name="ExportList3" id="ExportList3" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..."><i class="fa fa-file-excel-o"></i>&nbsp; Download</button>
<button type="button" name="print" id="print" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..."><i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>
<button type="button" class="btn btn-info" id="reload2" name="reload2" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing..." >
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>
<a href="#tab_content1" role="tab" id="Home2"  data-toggle="tab" aria-expanded="false" class="btn btn-warning" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-reply"></i>&nbsp; Closed</a> </div> </div>
<div class="pull-right">
<div class="input-group">
<!--<input type="text" class="form-control" id="DocNum2" name="DocNumSearch" placeholder="Barcode">-->
<span class="input-group-btn">
</span>
</div></div>
</div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body"> 
<div id="list_d"></div> 
</div></div></div>
</div>

<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="view-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<a href="#tab_content2" role="tab" id="Home22"  data-toggle="tab" aria-expanded="false" class="btn btn-warning" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-reply"></i>&nbsp; Closed</a> </div> </div>
<div class="pull-right">
<div class="input-group">
<input type="text" class="form-control" id="DocNum2" name="DocNumSearch" placeholder="Barcode">
<span class="input-group-btn">
</span>
</div></div>
</div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body"> 
<!-- list_detail_prod-->
<div id="list_detail_prod"></div> 
</div></div></div>
</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="report-tab">



<div class="box-body">
<div class="box">
<div class="box-body">

<form class="form-horizontal" name="formid" id="formid">
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
<label class="col-xs-4 control-label">Customer</label>
<div class="col-xs-8">
<select id="IDCust" name="IDCust" class="form-control" style="width: 100%;">
<?php if(empty($IDCust)){ ?>
<option value="semua">All</option>
<?php } foreach($l_cust->result() as $t){ if($IDCust==$t->Code){ ?>
<option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Code;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option>
<?php } } ?>  
</select>
</div></div>

<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-8">
<input type="text" id="PartNo2" name="PartNo2"  class="form-control" >
</div></div>
</div></div>
</div></div></div>
</form>
</div>
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="Search" id="Search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
<button type="button" class="btn btn-success" id="Download3" name="Download3" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="glyphicon glyphicon-import"></i>&nbsp; Download</button>
<button type="button" class="btn btn-info" id="PrintList3" name="PrintList3" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>
<a href="#tab_content1" id="Home4" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-warning">
<i class="fa fa-reply"></i> Closed</a>
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab3" data-toggle="tab" aria-expanded="false" class="btn btn-success">
<i class="fa  fa-plus"></i> Transaction</a><?php } ?>

</div></div></div></div></div>
</div></div>
<div class="box-body">
<div class="box">
<div class="box-body">

<div id="transaction_detail_report">
<!-- list report -->

</div>
</div></div></div>
</div>
<script>
    $('#Search').click(function(event){
        var string = $("#form_report").serialize();
        $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/BPFG_in/ReportBPFG",
            data	: string,
            success	: function(data){
                $('#list_report_bpfg').html(data);
            } 
        });
    });
    
</script>

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


 <div class="modal fade" id="myModal_Search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="ReloadSearch" name="ReloadSearch" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>

<input hidden="true" type="text" id="DocNumModalSearch" name="DocNumModalSearch" placeholder="Search">

</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="List_Material"></div>
</div> </div> </div> </div> </div> </div> </div>

<script>
$(document).ready(function()
{
    tampil_data();
    function tampil_data()
    {
        var kode = "" ;
        $('#reload').button('loading');
        $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/BPFG_in/TransactionList",
        data	: "kode="+kode,
        cache	: false,
        success	: function(data){
        $("#tampil_data").html(data);  
        $('#reload').button('reset');
        //$("#myModal100").modal('hide'); 
        } }); 
    };
    
    function tampil_data_warehouseIN()
    {
        var kode = "" ;
        $('#reload').button('loading');
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
    
    
    $("#form-tab").click(function()
    {
        waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
        setTimeout(function () 
        { 
            //AmbilForm(); 
            tampil_data_warehouseIN();
        }, 1000); 
    });
    
    $('#reload').click(function(){ tampil_data(); });
    
    function AmbilForm()
    {
        var kode = "";
        $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/ref_json/InfoTambahFormInBPFG",
            data	: "kode="+kode,
            cache	: false,
            dataType : "json",
            success	: function(data){
                $("#DocNum").val(data.DocNum);
                $("#DocNumDetail").val(data.DocNumDetail); 
                $("#CreateDate").val(data.CreateDate);
                $("#DocDate").val(data.DocDate);
                $("#CreateTime").val(data.CreateTime);
                $("#SJDate").val(data.CreateDate);
                $("#DocNumDetail3").val(""); 
                $("#DocNumDetail2").val("");
                $("#ItemID").val("");
                $("#PartNo").val("");
                $("#PartName").val("");
                $("#IDCust").val("");
                $("#CustName").val("");
                $("#PcsPerDay").val("");
                $("#Qty").val("0");
                $("#QtyBefore").val("0");
                $("#Balance").val("0");
                $("#StockFG").val("0");
                $("#Remark ").val("");
            }  
        });  
     };
     
    $('#tgl1').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#tgl2').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
	
	$('#PrintList3').click(function(){
		var IDCust = $("#IDCust").val();
		var PartNo2= $("#PartNo2").val();
		var tgl1 = $("#tgl1").val();
		var tgl2 = $("#tgl2").val();
		var string = tgl1+"/"+tgl2+"/"+IDCust+"/"+PartNo2;
		if(tgl1.length == 0){
			$("#myModal2").modal('show');
			$("#pesan").text('Tanggal tidak boleh kosong'); return false(); 
		}

		if(tgl2.length == 0){
			$("#myModal2").modal('show');
			$("#pesan").text('Tanggal tidak boleh kosong'); return false(); 
		} 
		window.open('<?php echo site_url();?>/BPFG_in/PrintList2/'+string , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
	});
});
</script>
<!-- end index.view -->