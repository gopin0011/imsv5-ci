<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        ion.sound({
            sounds: [
                {name: "metal_plate"},
                {name: "water_droplet"}
            ],
            path: "<?php echo base_url(); ?>assets/sounds/",
            preload: true,
            volume: 1.0
        });

    });
</script>
  
<script type="text/javascript">
$(document).ready(function(){

tampil_data();

$('#Reload1').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
       Detail_data();
       Detail_data2();
   }, 500);
});

$('#reload').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data(); });
    
 function tampil_data(){
 var kode = "" ;
 $('#reload').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OUTFinishGood/TransactionList",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#tampil_data").html(data);  $('#reload').button('reset');
 $("#myModal100").modal('hide'); 
 } }); };
    
 $("#DocNumDetail2").focusout(function(){
	var  DocNumDetail2 = $("#DocNumDetail2").val();
    if(DocNumDetail2.length==0){
	AmbilForm();
    Detail_data();
    hitung();}
	});    
    $("#DocNumDetail2").focus(function(e){
		var isi = $(e.target).val();
	AmbilFormEdit();
    Detail_data();
    hitung();
	});
	$("#DocNumDetail2").keyup(function(){
	AmbilFormEdit();
    Detail_data();
    hitung();
	});
    
    $("#DocNumDetail2").click(function(e){
    var isi = $(e.target).val();
	AmbilFormEdit();
    Detail_data();
    hitung();
	 });
     
    $("#StockFG").click(function(e){
    var isi = $(e.target).val();
    Detail_data();
	 });
    $("#StockFG").focus(function(e){
	var isi = $(e.target).val();
    Detail_data();
	});
    
    
function AmbilFormEdit(){
 var x = $("#DocNumDetail2").val();
 var y = "DELI" ;
 if(x.match(y)){
 var kode = $("#DocNumDetail2").val();
 }else{
 var kode = "" ;  }
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoDataEdit",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#CreateDate").val(data.CreateDate);
 $("#CreateTime").val(data.CreateTime);
 $("#DocDate").val(data.DocDate);
 $("#DocNum").val(data.DocNum); 
 $("#DocNumDetail").val(data.DocNumDetailInFG);
 $("#DocNumDetail3").val(data.DocNumDetail3); 
 $("#ItemID").val(data.ItemID);  
 $("#PartNo").val(data.PartNo); 
 $("#PartName").val(data.PartName);  
 $("#IDCust").val(data.IDCust); 
 $("#CustName").val(data.Code2);   
 $("#IDProject").val(data.IDProject); 
 $("#StockFG").val(data.StockFG);
 $("#Remark").val(data.Remark);
 $("#DocNumExt").val(data.SourceDocNum);
 $("#Qty").val(data.QtyMat);
 $("#QtyBefore").val(data.QtyMat);
 }  });  };
    

    
        
             
$("#DocNum2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#DocNum2").keydown(function(){ Detail_data2(); });
$("#DocNum2").keyup(function(){ Detail_data2(); });
$("#DocNum2").click(function(){ Detail_data2(); });
$("#DocNum2").focus(function(){ Detail_data2(); });

 
$("#DocNumDetail2").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });
$("#ReCheck").click(function(){ hitung(); });

function Detail_data2(){
 var kode = $("#DocNum2").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OUTFinishGood/DataDetailMatIn2",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#Detail_data2").html(data);
 waitingDialog3.hide(); } }); }
    
function hitung(){
  var Balance = $("#Balance").val();
  var StockFG = $("#StockFG").val();
  var Qty = $("#Qty").val();
  var QtyBefore = $("#QtyBefore").val();

 var Balance = (parseFloat(StockFG) + parseFloat(QtyBefore)) - parseFloat(Qty) ;
 $("#Balance").val(Balance);

  }

  $("#Qty").keyup(function(){
  hitung();
  });
  
  $("#Qty").focus(function(){
		var  Qty = $("#Qty").val();  
        if(Qty == 0){
		$("#Qty").val("");
        hitung();
        return false(); }  }); 
        $("#Qty").focusout(function(){
            var  Qty = $("#Qty").val(); 
        if(Qty.length==0){
		$("#Qty").val("0");
        hitung();
        return false(); }  });
  

    
    $("#ReCheck").click(function(){
          var win = $("#myModal2").modal('show');
             $("#pesan").text('ReCheck  ..........');
				setTimeout(function(){
					$("#myModal2").modal('hide');
				},1000) 
			return false();
		});
              

	$("#Qty").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		} });

$("#Home2").click(function() {
 setTimeout(function() {
 $('#reload').click(); }, 100); });
 
$("#Home3").click(function() {
 setTimeout(function() {
 $('#reload').click(); }, 100); });
 
$("#Home4").click(function() {
 setTimeout(function() {
 $('#reload').click(); }, 100); });
        
    
$("#form-tab").click(function(){
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function () { 
 AmbilForm(); 
 setTimeout(function(){
 $("#tab_tambah_detail").click();
 waitingDialog3.hide(); },300) ; ta}, 1000); });	
    
$("#form-tab2").click(function(){
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function () { 
 AmbilForm(); 
 setTimeout(function(){
 $("#tab_tambah_detail").click(); },300) ;
     ta}, 1000);  });
    
$("#form-tab3").click(function(){
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function () { 
 AmbilForm(); 
 setTimeout(function(){
 $("#tab_tambah_detail").click();
 },300) ; ta}, 1000); });
    
function AmbilForm(){
 var kode = "";
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoTambahFormOutFG",
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
 }  });  };
             
  
$('#tab_tambah_detail').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 setTimeout(function() {
 $this.button('reset');
 AmbilFormDetail();
 Detail_data(); Detail_data2();
 }, 300); });
       
   function AmbilFormDetail(){
		var kode = $("#DocNum").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoTambahFormDetailOutFG",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
   
                $("#DocNumDetail").val(data.DocNumDetail); 
                $("#CreateDate").val(data.CreateDate);
                $("#CreateTime").val(data.CreateTime);
                $("#DocDate").val(data.DocDate);
                $("#SJDate").val(data.CreateDate);
                
                $("#DocNumDetail2").val("");
                $("#DocNumDetail3").val("");
                $("#QtyMatBefore").val("0"); 
                
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
			 }  });  };
             
$("#tab_tambah_detail").focus(function(e){
 var isi = $(e.target).val();
 Detail_data();  AmbilFormDetail(); });
 
$("#tab_tambah_detail").keyup(function(){
 Detail_data(); AmbilFormDetail();	 });
    
	function Detail_data(){
		var kode = $("#DocNum").val();
		//alert(kode);
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/OUTFinishGood/DataDetailMatIn",
			data	: "kode="+kode,
			cache	: false,
			success	: function(data){
				$("#Detail_data").html(data);
                waitingDialog3.hide();
			}
		});
		//return false();
	}
    
    
    
    
    $("#ItemID").focus(function(e){
		var isi = $(e.target).val();
		CariProfilProduct();
	});
	$("#ItemID").keyup(function(){
		CariProfilProduct();	
	});
	
	function CariProfilProduct(){
		var kode = $("#ItemID").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#PartNo").val(data.PartNo);
                $("#PartName").val(data.PartName);
                $("#IDCust").val(data.IDCust);
                $("#CustName").val(data.CustName2);
                $("#PcsPerDay").val(data.PcsPerday);
                $("#StockFG").val(data.StockFG);
                $("#Qty").val("0"); 
                $("#Balance").val(data.StockFG);             
			 }  });  };
             
   $("#Remark").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
    
     $("#DocNumExt").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
  
$("#simpan").click(function(){
 var DocNum = $("#DocNum").val();
 var ItemID = $("#ItemID").val();
 var Qty = $("#Qty").val();
 var NG = $("#NG").val();
 var string = $("#form").serialize();
 if(DocNum.length==0){ NotifFail('Data Gagal di simpan, Silahkan Klik TUTUP dan coba lagi'); return false();  }
 if(ItemID.length==0){ NotifFail('Silahkan klik "PartNo" untuk mengisi product'); return false(); }
 if(Qty<=0){ NotifFail('Qty tidak boleh kurang dari nol'); return false(); }
 if(NG<0){ NotifFail('NG tidak Kurang dari nol');  return false(); }
 if(Qty<NG){ NotifFail('NG tidak boleh lebih besar dari Qty');  return false(); }
 var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'}); 
  $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/OUTFinishGood/SimpanMaterialIn",
 data	: string,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 waitingDialog3.hide();
 Detail_data(); AmbilFormDetail();
 NotifSuccsess(data); },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 $("#myModal4").modal('show');
 $("#pesan4").text('Server tidak merespon :'+kesalahan); } }); return false();	 });
    
 function NotifSuccsess(data){
 new PNotify({
 title: 'Info',
 type: 'info',
 text: data,
 hide: true }); };
      
 function NotifFail(data){
 new PNotify({
 title: 'Info',
 type: 'error',
 text: data,
 hide: true
 }); }; 
      
 function NotifProses(data){
 new PNotify({
 title: 'Info',
 type: 'dark',
 text: data,
 hide: true
 }); };
      
      
    
$("#Search").click(function(){
 var IDCust = $("#IDCust").val();
 var PartNo2= $("#PartNo2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = "&IDCust="+IDCust+"&tgl1="+tgl1+"&tgl2="+tgl2+"&PartNo2="+PartNo2;
 if(tgl1.length==0){
 $("#myModal4").modal('show');
 $("#pesan4").text('Tanggal tidak boleh kosong'); return false(); }
 if(tgl2.length==0){
 $("#myModal4").modal('show');
 $("#pesan4").text('Tanggal tidak boleh kosong'); return false(); }
 var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 $("#transaction_detail_report").html('');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OUTFinishGood/ReadReport",
 data	: string,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 waitingDialog3.hide();
 $("#transaction_detail_report").html(data); },1000) } }); return false(); });

    
$("#Download3").click(function(){
 var IDCust = $("#IDCust").val();
 var PartNo2= $("#PartNo2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = tgl1+"/"+tgl2+"/"+IDCust+"/"+PartNo2;
 if(tgl1.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong') ; return false(); }
 if(tgl2.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong'); return false(); }

$("#Download3").button('loading');
setTimeout(function(){
$("#Download3").button('reset'); }, 1000);



 window.open('<?php echo site_url();?>/OUTFinishGood/ExportReport/'+string); 
 
 return false(); });
    
$("#PrintList3").click(function(){
 var IDCust = $("#IDCust").val();
 var PartNo2= $("#PartNo2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = tgl1+"/"+tgl2+"/"+IDCust+"/"+PartNo2;
 if(tgl1.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong'); return false(); }
 
 if(tgl2.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong'); return false(); } 

$("#PrintList3").button('loading');
setTimeout(function(){
$("#PrintList3").button('reset'); }, 1000);

 window.open('<?php echo site_url();?>/OUTFinishGood/PrintList2/'+string , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
    
             
        function BackHome(){
        window.location.replace("<?php echo base_url();?>index.php/OUTFinishGood/");
        }
             
    
	
    
$("#HapusDetail").click(function(){
 var DocNumDetailDelete	    = $("#DocNumDetailDelete").val();
 var BalanceDelete = $("#BalanceDelete").val();
 var ItemIDDelete = $("#ItemIDDelete").val();
 
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OUTFinishGood/Hapus_Transaksi",
 data	: "&DocNumDetailDelete="+DocNumDetailDelete+"&BalanceDelete="+BalanceDelete+"&ItemIDDelete="+ItemIDDelete,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 NotifFail(data);
 $("#Reload1").click(); $("#tab_tambah_detail").click();  },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 $("#myModal4").modal('show'); $("#ReloadSearch").click();
 $("#pesan4").text('Server tidak merespon :'+kesalahan); } }); return false(); });

$("#PrintList1").click(function(){
 var kode	= $("#DocNum").val();
 window.open('<?php echo site_url();?>/OUTFinishGood/PrintList/'+kode , 'myWindow', 
 'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
 return false(); });

$("#PrintList2").click(function(){
 var kode	= $("#DocNum2").val();
 window.open('<?php echo site_url();?>/OUTFinishGood/PrintList/'+kode , 'myWindow', 
 'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
 return false(); });

$("#Download2").click(function(){
 var kode = $("#DocNum2").val();
 $("#Download2").button('loading');
 setTimeout(function(){
 $("#Download2").button('reset'); }, 1000);
 
 window.open('<?php echo site_url();?>/OUTFinishGood/ExportList/'+kode); 
 return false(); });
 

$('#Reload2').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 MasterList(); });
      
function MasterList(){
 var kode = "" ;
 $("#MasterList").html("");
 $('#Reload2').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OUTFinishGood/MasterList",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#Reload2').button('reset'); }, 900);
 setTimeout(function() {
 $("#MasterList").html(data); }, 700); } }); };
 
$('#ReloadSearch').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 List_Material(); });

$("#DocNumModalSearch").focus(function(e){
 var isi = $(e.target).val(); List_Material(); });
$("#DocNumModalSearch").keyup(function(){ List_Material(); });
$("#DocNumModalSearch").keyup(function(){ List_Material(); });
          
function List_Material(){
 var kode = $("#DocNumModalSearch").val();
 $("#List_Material").html("");
 $('#ReloadSearch').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OUTFinishGood/DataDetailMatIn3",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#ReloadSearch').button('reset'); }, 900);
 setTimeout(function() {
 $("#List_Material").html(data); }, 700); } }); };
 
 $("#DocNumSearch").keyup(function(event){
 if(event.keyCode == 13){
 $("#DocNumSearchButton").click();
    } });

$("#Tutup").click(function(){ $("#myModal3").modal('hide'); }); 
$("#ItemID").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
$("#PartNo").click(function(){ $("#myModal_product").modal('show'); MasterList(); });
   
});	
</script>

<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php $cek = $this->Role_Model->TrcWHUp(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa  fa-plus"></i>&nbsp; New</a><?php } ?>

<a href="#tab_content4" role="tab" id="report-tab" data-toggle="tab" aria-expanded="false" class="btn btn-info">
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
<?php $cek = $this->Role_Model->TrcWHView(); if(!empty($cek)){ ?>
<div id="tampil_data"></div>
<?php } ?>
</div></div></div></div>

<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="form-tab">

<div class="box-body">
<div class="box">
<div class="box-body">
<form class="form-horizontal"  name="form" id="form">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi"><span class="glyphicon ">
</span> Document Properties &nbsp; 
<span style="float: right;"><i class="glyphicon glyphicon-tasks"></i></span></a></h5></div>

<div id="transaksi" class="collapse">
<div class="panel-body">
    
<div class="col-md-6">        
<div class="form-group">
<label class="col-xs-4 control-label">DocNum</label>
<div class="col-xs-5">
<input type="text" id="DocNum" name="DocNum"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-3">
<input type="text" id="DocNumDetail" name="DocNumDetail"  class="form-control" readonly="readonly">
</div> </div> 
<div class="form-group">
<label class="col-xs-4 control-label">DocNumDetail</label>
<div class="col-xs-8">
<input type="text" id="DocNumDetail3" name="DocNumDetail3"  class="form-control" readonly="readonly">
</div></div>

<div class="form-group">
<label class="col-xs-4 control-label"></label>
<div class="col-xs-8">
<input type="text" id="QtyBefore" name="QtyBefore"  class="form-control" value="0" readonly="true">
</div></div>

</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">CreateDate</label>
<div class="col-xs-8">
<input type="text" id="CreateDate" name="CreateDate"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">DocTime</label>
<div class="col-xs-8">
<input type="text" id="CreateTime" name="CreateTime"  class="form-control" readonly="readonly">
</div></div> 
<div class="form-group">
<label class="col-xs-4 control-label">DocDate</label>
<div class="col-xs-8">
<input type="text" id="DocDate" name="DocDate"  class="form-control" readonly="readonly">
</div></div>
</div>
</div></div></div></div>

<div class="panel-group" id="accordion">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#product"><span class="glyphicon ">
</span> Data Product &nbsp; 
<span style="float: right;"><i class="glyphicon glyphicon-tasks"></i></span></a></h4></div>
<div id="product" class="collapse in">
<div class="panel-body">
<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-2">
<input type="text" id="ItemID" name="ItemID"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-6">
<input type="text" id="PartNo" name="PartNo"  class="form-control" readonly="readonly">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">Part Name</label>
<div class="col-xs-8">
<input type="text" id="PartName" name="PartName"  class="form-control" readonly="readonly">
</div></div> 
 <div class="form-group">
<label class="col-xs-4 control-label">ID Customer</label>
<div class="col-xs-8">
<input type="text" id="CustName" name="CustName"  class="form-control" readonly="readonly">
</div> </div>  
</div> 

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Stock</label>
<div class="col-xs-4">
<input type="text" id="StockFG" name="StockFG"  class="form-control" value="0" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="Balance" name="Balance"  class="form-control" value="0" readonly="true">
</div> </div>
<div class="form-group">
<label class="col-xs-4 control-label">Qty</label>
<div class="col-xs-8">
<input type="text" id="Qty" name="Qty"  class="form-control" value="0" placeholder="Qty Keluar">
</div> </div>
<div class="form-group">
<label class="col-xs-4 control-label">Remark</label>
<div class="col-xs-8">
<input type="text" id="Remark" name="Remark"  class="form-control">
</div></div>
</div>
</div></div></div></div></form>


<div class="box-body panel-footer">
<div class="box-tools pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle"> 
<?php $cek = $this->Role_Model->TrcWHUp(); if(!empty($cek)){ ?>
<button type="button" name="simpan" id="simpan" class="btn btn-warning"><i class="fa fa-save"></i> Save</button>
<button type="button" id="tab_tambah_detail" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-plus"></i>&nbsp; Add</button>
<?php } ?>
<button type="button" name="PrintList1" id="PrintList1" class="btn btn-info"><i class="glyphicon glyphicon-print"></i> Print</button>
<a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
<i class="fa fa-mail-reply"></i> Closed</a>
<?php $cek = $this->Role_Model->TrcWHUp(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab2" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa  fa-file-o"></i> New</a><?php } ?>
</div></div>
<form class="pull-right" role="search">
<div class="form-group">
<input type="text" id="DocNumDetail2" name="DocNumDetail2" class="form-control" placeholder="Search"></div>
</form>
</div>
</div></div></div>
<div class="box-body"><div class="box"><div class="box-body">
<div id="Detail_data"></div>
</div></div></div></div>


<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="view-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            
<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php $cek = $this->Role_Model->TrcWHUp(); if(!empty($cek)){ ?>
<a onfocus="PilihTambah()" href="#tab_content2" data-toggle="tab" aria-expanded="false" class="btn btn-warning" ><i class="glyphicon glyphicon-plus"></i> Add</a>
<?php } ?>
<button type="button" name="Download2" id="Download2" class="btn btn-primary"><i class="fa fa-file-excel-o"></i> Download</button>
<button type="button" name="PrintList2" id="PrintList2" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Print</button>
<a href="#tab_content1" id="Home3" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-info">
<i class="fa fa-reply"></i> Closed</a>
<button type="button" class="btn btn-success" id="Reload1" name="Reload1" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>
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
<?php $cek = $this->Role_Model->TrcWHUp(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab3" data-toggle="tab" aria-expanded="false" class="btn btn-success">
<i class="fa  fa-plus"></i> Transaction</a><?php } ?>

</div></div></div></div></div>
</div></div>
<div class="box-body">
<div class="box">
<div class="box-body">
<div id="transaction_detail_report"></div>
</div></div></div>
</div></div></div>


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
 $("#DocNumDetail2").click();   $("#myModal_Search").modal("hide");
 },300) ;
 },500) ;
 return false();
 }
</script>
<script type="text/javascript"> 
function PilihHapus(DocNumDetail,PartNo,BalanceDelete,ItemIDDelete,QtyDelete){
$("#DocNumDetailDelete").val(DocNumDetail);
$("#myModalDelete").modal('show');
var BalanceDeleteX = parseFloat(BalanceDelete) + parseFloat(QtyDelete) ;
$("#BalanceDelete").val(BalanceDeleteX);
$("#ItemIDDelete").val(ItemIDDelete);
$("#pesan").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(PartNo);  };
</script>
 
<script type="text/javascript"> 
function PilihTambah(){
 var  DocNum2 = $("#DocNum2").val(); 
 setTimeout(function(){
 $("#DocNum").val(DocNum2);
 setTimeout(function(){
 $("#tab_tambah_detail").focus();
 $("#tab_tambah_detail").click();
 Detail_data();
 },300) ;
 },500) 
 return false(); }
</script>

<script type="text/javascript">     
function Search(){
    var DocNumSearch = $("#DocNumSearch").val();
    if(DocNumSearch.length==0){
      $("#myModal4").modal('show');
      $("#pesan4").text('Masukan No Barcode');  
    }else{
    $("#myModal_Search").modal("show");
	$("#DocNumModalSearch").val(DocNumSearch);
    setTimeout(function(){
    $("#ReloadSearch").click(); },300) ;
return false(); } }
</script>
    <script type="text/javascript">     
function PilihEditSearch(){
    var DocNumDetail2Search 	    = $("#DocNumDetail2Search").val();
    $("#myModal_Search").modal("hide");
	$("#DocNumDetail2").val(DocNumDetail2Search);
    $("#DocNumDetail").val(DocNumDetail2Search.substr(12,3));
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
    $('#DocDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#SJDate').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
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
