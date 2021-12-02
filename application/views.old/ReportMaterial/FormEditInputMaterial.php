<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
 $(window).load(function(){
 setTimeout(function(){
 $("#DocNumDetail2").click();
 $("#DocNumDetail2").focus();  },1000) });
 });
</script>  
<script type="text/javascript">
$(document).ready(function(){
$("#DocNumDetail2").focus(function(e){
 var isi = $(e.target).val();
 AmbilFormEdit(); hitung();
 Detail_data(); });
 
$("#DocNumDetail2").keyup(function(){
 AmbilFormEdit(); hitung();
 Detail_data(); });

$("#DocNumDetail2").click(function(e){
 var isi = $(e.target).val();
 AmbilFormEdit(); hitung();
 Detail_data(); });
     
$("#Spec1").click(function(e){
 var isi = $(e.target).val();
 Detail_data(); });
 
$("#Spec1").focus(function(e){
 var isi = $(e.target).val();
 Detail_data(); });
    
    
function AmbilFormEdit(){
 var x = $("#DocNumDetail2").val();
 var y = "INM" ;
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
 $("#SJDate").val(data.SJDate);
 $("#SJNum").val(data.SJNum);
 $("#DocNum").val(data.DocNum); 
 $("#DocNumDetail").val(data.DocNumDetail);
 $("#DocNumDetail3").val(data.DocNumDetail3); 
 $("#ItemID").val(data.ItemID);
 $("#CanEdit").val(data.CanEdit);
 $("#PartNo").val(data.PartNo); 
 $("#PartName").val(data.PartName);  
 $("#IDCust").val(data.IDCust); 
 $("#CustName").val(data.Code);   
 $("#IDProject").val(data.IDProject); 
 $("#Spec1").val(data.Spec1);
 $("#Spec2").val(data.Spec2);
 $("#MatNum").val(data.MatNum);
 $("#PartnerID").val(data.PartnerID);
 $("#partner_code").val(data.partner_code);
 $("#MaterialType").val(data.MaterialType);
 $("#MaterialName").val(data.MaterialName);
 $("#PcsPerSheet").val(data.PcsPerSheet);
 $("#PcsPerKg").val(data.PcsPerKg);
 $("#PONum").val(data.SourceDocNum);
 $("#QtyMat").val(data.QtyMat);
 $("#QtyPcs").val(data.QtyPcs);
 $("#BalMatBe").val(data.BalMat);
 $("#BalPcsBe").val(data.BalPcs);
 }  });  };
    
$("#Save").click(function(){
 var DocNum = $("#DocNum").val();
 var ItemID = $("#ItemID").val();
 var SJNum = $("#SJNum").val();
 var SJDate = $("#SJDate").val();
 var MatNum = $("#MatNum").val();
 var PartnerID = $("#PartnerID").val();
 var PcsPerSheet = $("#PcsPerSheet").val();
 var PcsPerKg = $("#PcsPerKg").val(); 
 var BalMat = $("#BalMat").val();
 var QtyMat = $("#QtyMat").val();
 var MaterialType = $("#MaterialType").val();
 var CanEdit = $("#CanEdit").val();
 
 var string = $("#form").serialize();
 
 if(DocNum.length==0){
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Data Gagal di simpan, Silahkan Klik TUTUP dan coba lagi'); 
 return false(); }
 
 if(ItemID.length==0){ 
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Silahkan klik "PartNo" untuk mengisi product');
 return false(); }
 
 if(MaterialType==2){
 if(PcsPerSheet==0){
 $("#myModal_Fail").modal('show');    
 $("#pesanFail").text('Pcs Per Sheet Harus di isi');  
 return false();}
 if(PcsPerSheet.length==0){
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Pcs Per Sheet Harus di isi');  
 return false(); }   }
 
 if(MaterialType==1){
 if(PcsPerKg==0){
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Pcs Per Kg Harus di isi');  
 return false();}
 if(PcsPerKg.length==0){
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Pcs Per Kg Harus di isi');  
 return false(); } }
 
 if(SJNum.length==0){
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Surat Jalan harus diisi');  
 return false(); }
        
 if(SJDate.length==0){
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Tanggal Surat Jalan harus diisi');  
 return false(); }
 
 if(MatNum.length==0){
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('No Material harus diisi'); 
 return false(); }     
 
 if(PartnerID.length==0){
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Supplier harus di isi'); 
 return false(); 	}
 
 if(BalMat<0){
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Qty tidak boleh nol'); 
 return false(); }
 
 if(QtyMat<=0){
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Qty tidak boleh nol'); 
 return false(); }
 
 if(CanEdit>0){
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Dokumen ini tidak bisa diedit, sudah digunakan'); 
 return false(); }
 
 var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'}); 
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/INMaterial/SimpanMaterialIn",
 data	: string,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 waitingDialog3.hide();
 $("#myModal_Success").modal('show');
 $("#pesanSuccess").text(data); },1000) },
 
 error : function(xhr, teksStatus, kesalahan) {
 $("#myModal_Fail").modal('show');
 $("#pesanFail").text('Server tidak merespon :'+kesalahan); 	}
 }); return false(); });
  
$("#QtyMat").focus(function(){ var  QtyMat = $("#QtyMat").val();
 if(QtyMat == 0){ $("#QtyMat").val(""); return false(); }  });
        
$("#QtyMat").focusout(function(){
 var  QtyMat = $("#QtyMat").val();
 if(QtyMat.length==0){
 $("#QtyMat").val("0");
 hitung();
 return false(); }  });

$("#SJNum").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });

$("#PONum").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });

$("#MatNum").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });
$("#PcsPerSheet").keypress(function(data){
 if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
 return false; } });
$("#PcsPerKg").keypress(function(data){
 if (data.which!=46 && data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
 return false; } });

$("#QtyMat").keypress(function(data){
 if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
 return false; } });

function hitung(){
 var QtyMat      = $("#QtyMat").val();
 var QtyPcs     = $("#QtyPcs").val();
 var PcsPerSheet = $("#PcsPerSheet").val();
 var PcsPerKg    = $("#PcsPerKg").val();
 var MaterialType         = $("#MaterialType").val();
        
 if(MaterialType==2){
 var QtyPcs = parseFloat (QtyMat) * parseFloat(PcsPerSheet) ;
 $("#QtyPcs").val(QtyPcs); }
        
 if(MaterialType==1){
 var QtyPcs = parseFloat (QtyMat) / parseFloat(PcsPerKg);
 $("#QtyPcs").val(QtyPcs); }

 var BalMat = (parseFloat (QtyMat));
 $("#BalMat").val(BalMat);

 var BalPcs = (parseFloat (QtyPcs));
 $("#BalPcs").val(BalPcs); }
        
 $("#QtyMat").keyup(function(){ hitung(); });
 $("#PcsPerSheet").keyup(function(){ hitung(); });

 $("#PcsPerKg").keyup(function(){ hitung(); });

   
function MasterListPartner(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/INMaterial/MasterListPartner",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterListPartner").html(data);	} }); };        
 
$("#Hapus_User").click(function(){
        var DocNumDetail2	    = $("#DocNumDetail2").val();
        var PartNo	    = $("#PartNo").val();
        var BalMatBe	    = $("#BalMatBe").val();
    
    if(DocNumDetail2.length==0){
    }else{
        if(BalMatBe>0){
     $("#myModal3").modal('show');
     $("#pesan3").text("Anda yakin menghapus bro ?");
     $("#PartNoDelete").text(PartNo); 
     }  
    }
	});
    
   
    
$("#PartnerID").click(function(){
		$("#myModal_Partner").modal('show'); MasterListPartner();
	});
 
     $("#PartnerID2").click(function(){
		$("#myModal_Partner2").modal('show'); MasterListPartner();
	});
	
	
});	
</script>

 

</head>
<body>

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
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="transaksi" class="collapse">
<div class="panel-body">
    
<div class="col-md-6">        
<div class="form-group">
<label class="col-xs-4 control-label">DocNum</label>
<div class="col-xs-4">
<input type="text" id="DocNum" name="DocNum"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="DocNumDetail" name="DocNumDetail"  class="form-control" readonly="readonly">
</div> </div> 
<div class="form-group">
<label class="col-xs-4 control-label">Balance Before</label>
<div class="col-xs-4">
<input type="text" id="BalMatBe" name="BalMatBe"  class="form-control" readonly="readonly" value="0">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcsBe" name="BalPcsBe"  class="form-control" readonly="readonly" value="0">
</div> </div>
<div class="form-group">
<label class="col-xs-4 control-label">Balance After</label>
<div class="col-xs-4">
<input type="text" id="BalMat" name="BalMat"  class="form-control" readonly="readonly" value="0">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcs" name="BalPcs"  class="form-control" readonly="readonly" value="0">
</div> </div>
<div class="form-group">
<label class="col-xs-4 control-label">Material Type</label>
<div class="col-xs-4">
<input type="text" id="MaterialType" name="MaterialType"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="MaterialName" name="MaterialName"  class="form-control" readonly="readonly">
</div> </div>
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
<input type="text" id="DocDate" name="DocDate"  class="form-control" value="<?php echo $DocDateReport_2 ; ?>" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">DocNumDetail</label>
<div class="col-xs-4">
<input type="text" id="DocNumDetail3" name="DocNumDetail3"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="CanEdit" name="CanEdit"  class="form-control" readonly="readonly">
</div></div>
</div>
</div></div></div></div>

<div class="panel-group" id="accordion">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#product"><span class="glyphicon ">
</span> Data Product &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
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
<label class="col-xs-4 control-label">Spec</label>
<div class="col-xs-4">
<input type="text" id="Spec1" name="Spec1"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="Spec2" name="Spec2"  class="form-control" readonly="readonly">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">ID Customer</label>
<div class="col-xs-4">
<input type="text" id="IDCust" name="IDCust"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="CustName" name="CustName"  class="form-control" readonly="readonly">
</div> </div> 
    <div class="form-group">
<label class="col-xs-4 control-label">PCS/(Sht/Kg)</label>
<div class="col-xs-4">
<input type="text" id="PcsPerSheet" name="PcsPerSheet"  class="form-control" placeholder="Per Sheet">
</div>
<div class="col-xs-4">
<input type="text" id="PcsPerKg" name="PcsPerKg"  class="form-control" placeholder="Per Kg">
</div>
</div>
</div> 

<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">No. Surat Jalan</label>
<div class="col-xs-4">
<input type="text" id="SJNum" name="SJNum"  class="form-control" placeholder="No SJ">
</div>
<div class="col-xs-4">
<input type="text" id="PONum" name="PONum"  class="form-control" placeholder="No PO">
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Tgl Surat Jalan</label>
<div class="col-xs-8">
<input type="text" id="SJDate" name="SJDate"  class="form-control" value="<?php echo $DocDateReport_2 ; ?>" readonly="true" >
</div>
</div>

    <div class="form-group">
<label class="col-xs-4 control-label">No. Material</label>
<div class="col-xs-8">
<input type="text" id="MatNum" name="MatNum"  class="form-control" >
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Qty</label>
<div class="col-xs-4">
<input type="text" id="QtyMat" name="QtyMat"  class="form-control" value="0" placeholder="Qty Masuk">
</div>
<div class="col-xs-4">
<input type="text" id="QtyPcs" name="QtyPcs"  class="form-control" readonly="true" value="0" >
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">Supplier</label>
<div class="col-xs-2">
<input type="text" id="PartnerID" name="PartnerID"  class="form-control" readonly="true">
</div>
<div class="col-xs-6">
<input type="text" id="partner_code" name="partner_code"  class="form-control" readonly="true">
</div></div> 
</div>


</div></div></div></div></form>
 
 <div class="box-body panel-footer">
 <div class="box-tools pull-left" data-toggle="tooltip">
 <div class="btn-group" data-toggle="btn-toggle"> 
 <button type="button" id="Save" name="Save" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
 <a href="<?php echo base_url();?>index.php/ReportMaterial/DataRecord/<?php echo $ItemID ; ?>" class="btn btn-primary"><i class="fa fa-mail-reply"></i> Tutup</a>
 </div></div>
 <form class="pull-right" role="search">
<div class="form-group">
 <input type="text" id="DocNumDetail2" name="DocNumDetail2" value="<?php echo $DocNumDetail2 ; ?>" readonly="true" class="form-control" placeholder="Search"></div>
 </form>
 
 </div>


 </div></div></div>

<div class="modal fade" id="myModal_Partner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">List Product</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterListPartner"></div>
</div> </div> </div> </div> </div> </div> </div>

<div class="modal fade" id="myModal_Success" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title"><img style="height: 30px; height: 30px;" src="<?php echo base_url(); ?>images/INDOKATOR/Success.png" /> Info</h4></div><div class="modal-body"><div>                  
<div id="pesanSuccess"></div>  
</div></div></div></div></div><!-- /.modal -->

<div class="modal fade" id="myModal_Fail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title"><img style="height: 30px; height: 30px;" src="<?php echo base_url(); ?>images/INDOKATOR/Warning.png" /> Info</h4></div><div class="modal-body"><div>
                        
<div id="pesanFail"></div>


    
</div></div></div></div></div><!-- /.modal -->



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
			return false();
    }
</script>


    <script type="text/javascript">

function pilih2(id){
	$("#myModal_Partner").modal("hide");
	$("#PartnerID").val(id);
	$("#PartnerID").focus();
	
}
</script>

    <script type="text/javascript"> 
function pilih(id){
	$("#myModal_product").modal('hide');
	$("#ItemID").val(id);
	$("#ItemID").focus(); }
</script>
    <script type="text/javascript">

function pilih3(id){
	$("#myModal_Partner2").modal("hide");
	$("#PartnerID2").val(id);
	$("#PartnerID2").focus();
	
}
</script>

<script>
  $(function () {

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
	
	$('#tgl_1').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#tgl_2').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });

  });
</script> 
        
        
</body>

</html>