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
    $("#TutupComment").click(function(){
	$("#myModalCom").modal('hide');
    tampil_data();
	}); 

        
function reloadAja() {
tampil_data();
} ;

$("#DocNumSearch").keyup(function(event){
if(event.keyCode == 13){ $("#DocNumSearchButton").click(); } });
    
    
$("#QtyMat").focus(function(){
var  QtyMat = $("#QtyMat").val();
if(QtyMat == 0){ $("#QtyMat").val(""); return false(); }  });
$("#QtyMat").focusout(function(){ var  QtyMat = $("#QtyMat").val();
if(QtyMat.length==0){ $("#QtyMat").val("0"); return false(); }  });

$("#DocNumDetail2").focusout(function(){
	var  DocNumDetail2 = $("#DocNumDetail2").val();
    if(DocNumDetail2.length==0){
	AmbilForm(); 
    setTimeout(function(){
    tampil_data_detail();
    hitung();
    },300) ;
    }
	});    
    $("#DocNumDetail2").focus(function(e){
		var isi = $(e.target).val();
	AmbilFormEdit();
    setTimeout(function(){
    tampil_data_detail();
    hitung();
    },300) ;
	});
	$("#DocNumDetail2").keyup(function(){
	AmbilFormEdit(); 
    setTimeout(function(){
    tampil_data_detail();
    hitung();
    },300) ;
	});
    $("#DocNumDetail2").keydown(function(){
	AmbilFormEdit(); 
    setTimeout(function(){
    tampil_data_detail();
    hitung();
    },300) ;
	});
    
    $("#DocNumDetail2").click(function(e){
    var isi = $(e.target).val();
	AmbilFormEdit(); 
    setTimeout(function(){
    tampil_data_detail();
    hitung();
    },300) ;
	 });
     
    $("#Spec").click(function(e){
    var isi = $(e.target).val();
    tampil_data_detail();
	 });
    $("#Spec").focus(function(e){
	var isi = $(e.target).val();
    tampil_data_detail();
	});

function AmbilFormEdit(){
        var x = $("#DocNumDetail2").val();
        var y = "INM" ;
        
        if(x.match(y)){
        var kode = $("#DocNumDetail2").val();
        }else{
        var kode = "" ;    
        }
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Material_in/InfoDataEdit",
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
                $("#Spec").val(data.Spec2);
                $("#MatNum").val(data.MatNum);
                $("#PartnerID").val(data.PartnerID);
                $("#partner_code").val(data.partner_code);
                $("#MaterialTypeID").val(data.MaterialTypeID);
                $("#MaterialType").val(data.MaterialType);
                $("#PcsPerSheet").val(data.PcsPerSheet);
                $("#KgPerSheet").val(data.KgPerSheet);
                                                
                $("#QtyMat").val(data.Qty_1);
                $("#QtyPcs").val(data.Qty_2);
                
                $("#BalMatBe").val(data.Qty_3);
                $("#BalPcsBe").val(data.Qty_4);
                }  });  };
                        
$("#DocNum2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#DocNumDetail2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#SJNum").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#MatNum").keyup(function(e){var isi = $(e.target).val();$(e.target).val(isi.toUpperCase());});
$("#PcsPerSheet").keypress(function(data){if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { 
return false; } });
$("#KgPerSheet").keypress(function(data){ if (data.which!=46 && data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
return false; } });
$("#QtyMat").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
return false; } });
        
function hitung(){
var QtyMat = $("#QtyMat").val();
var QtyPcs = $("#QtyPcs").val();
var PcsPerSheet = $("#PcsPerSheet").val();
var KgPerSheet = $("#KgPerSheet").val();
var MaterialTypeID = $("#MaterialTypeID").val();
        
if(MaterialTypeID==2){
var QtyPcs = parseFloat (QtyMat) * parseFloat(PcsPerSheet) ;
$("#QtyPcs").val(QtyPcs); }

if(MaterialTypeID==1){
var QtyPcs = parseFloat (QtyMat) / parseFloat(KgPerSheet);
$("#QtyPcs").val(QtyPcs); }

var BalMat = (parseFloat (QtyMat));
$("#BalMat").val(BalMat);

var BalPcs = (parseFloat (QtyPcs));
$("#BalPcs").val(BalPcs); }
        
$("#QtyMat").keyup(function(){
hitung(); });

$("#PcsPerSheet").keyup(function(){
hitung(); });

$("#KgPerSheet").keyup(function(){
hitung(); });


    
$("#form-tab").click(function(){
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function () { 
        AmbilForm(); 
        tampil_data_detail();
     setTimeout(function(){
					$("#RefNum").focus();
					$("#RefNum").click();
                    waitingDialog3.hide();
				},300) ;
      ta}, 1000);
    
    });

$("#form-tab3").click(function(){
waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
setTimeout(function () { 
AmbilForm(); 
setTimeout(function(){
$("#Spec").focus();
$("#Spec").click();},300) ;
ta}, 1000); });
        
$("#Add_2").click(function(){
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    var DocNum = $("#DocNumView").val() ;
    $("#DocNum").val(DocNum) ;
    
    setTimeout(function () { 
        AmbilFormAdd(); 
        tampil_data_detail();
     setTimeout(function(){
					$("#RefNum").focus();
					$("#RefNum").click();
                    waitingDialog3.hide();
				},300) ;
      ta}, 1000);
    
    });
    
    
    $("#Home").click(function() {
    setTimeout(function() {
       $('#reload').click();
   }, 100);
});

    $("#Home2").click(function() {
    setTimeout(function() {
       $('#reload').click();
   }, 100);
});

    $("#Home3").click(function() {
    setTimeout(function() {
       $('#reload').click();
   }, 100);
});

    

    $('#Add').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
       AmbilForm(); $("#Spec").click(); $("#Spec").focus();
   }, 500);
});

    $('#Save').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
   }, 500);
});
    
    function AmbilForm(){
		var kode = "";
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Material_in/InfoTambahFormMatIn",
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
                $("#Spec1").val("");
                $("#Spec2").val("");
                $("#PcsPerDay").val("");
                $("#PcsPerSheet").val("");
                $("#KgPerSheet").val("");
                $("#SJNum").val("");
                $("#MatNum").val("");
                $("#PartnerID").val("");
                $("#partner_code").val("");
                $("#QtyMat").val("0");
                $("#QtyPcs").val("0");
                $("#BalMat").val("0");
                $("#BalPcs").val("0");
                $("#BalMatBe").val("0");
                $("#BalPcsBe").val("0");
                $("#CanEdit").val("0");
                
                $("#MaterialType").val("");
                $("#MaterialName").val("");                                                                        
                
        setTimeout(function(){
        tampil_data_detail();
        },300) ;
                
                }  });  };
                
function AmbilFormDetail(){
		var kode = $("#DocNum").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Material_in/InfoTambahFormDetailMatIN",
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
				$("#ItemID").val("");
				$("#PartNo").val("");
                $("#PartName").val("");
                $("#IDCust").val("");
                $("#CustName").val("");
                $("#Spec").val("");
                $("#PcsPerDay").val("");
                $("#PcsPerSheet").val("");
                $("#KgPerSheet").val("");
                $("#SJNum").val("");
                $("#PONum").val("")
                $("#MatNum").val("");
                $("#PartnerID").val("");
                $("#partner_code").val("");
                $("#QtyMat").val("0");
                $("#QtyPcs").val("0");
                $("#BalMat").val("0");
                $("#BalPcs").val("0");
                $("#BalMatBe").val("0");
                $("#BalPcsBe").val("0");
                $("#CanEdit").val("0"); 
                
                $("#MaterialTypeID").val("");
                $("#MaterialType").val("");            
			 }  });  };
                
function AmbilFormAdd(){
		var id = $("#DocNum").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Material_in/RegDocNumSony_Add",
			data	: "id="+id,
			cache	: false,
			dataType : "json",
			success	: function(data){
			 $("#DocNumDetail").val(data.DocNumDetail);
                $("#DocDate").val(data.DocDate); 
                $("#ShiftID").val(data.ShiftID);
                $("#Qty_2").val("4"); 
                }  });  };
    

tampil_data();
function tampil_data(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_in/transaction_list",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#transaction_list").html(data);

  
  	} }); };

function tampil_data_detail(){
var id = $("#DocNum").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_in/transaction_detail",
data	: "id="+id,
cache	: false,
success	: function(data){
$("#transaction_detail").html(data);
waitingDialog3.hide();	} }); };


$("#DocNum2").click(function(){
    tampil_data_detail_2();
    });
$("#DocNum2").keyup(function(){
    tampil_data_detail_2();
    });
$("#DocNum2").keydown(function(){
    tampil_data_detail_2();
    });
    $("#DocNum2").focus(function(){
    tampil_data_detail_2();
    });
function tampil_data_detail_2(){
var id = $("#DocNum2").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_in/transaction_detail_2",
data	: "id="+id,
cache	: false,
success	: function(data){
$("#transaction_detail_2").html(data);	} }); };


$('#reload').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
       tampil_data();
   }, 500);
});

$('#reload1').on('click', function() {
    var $this = $(this);
  $this.button('loading');
    setTimeout(function() {
       $this.button('reset');
       tampil_data_detail_2();
   }, 500);
});

$('#AddDetail').on('click', function() {
var $this = $(this);
$this.button('loading');
setTimeout(function() {
$this.button('reset');
AmbilFormDetail();
tampil_data_detail();
}, 300);
});

$('#AddDetail_2').on('click', function() {
var DocNum = $("#DocNum2").val() ; $("#DocNum").val(DocNum);
var $this = $(this);
$this.button('loading');
setTimeout(function() {
$this.button('reset');
AmbilFormDetail();
tampil_data_detail();

}, 300);
});

function textAreaAdjust2() {
style.height = "5px";
style.height = (22+scrollHeight)+"px"; };

$("#Save").click(function(){
var BalMatBe = $("#BalMatBe").val(); var BalPcsBe = $("#BalPcsBe").val();
var BalMat = $("#BalMat").val(); var BalPcs = $("#BalPcs").val();
var MaterialTypeID = $("#MaterialTypeID").val(); var MaterialType = $("#MaterialType").val();
var CreateDate = $("#CreateDate").val(); var CreateTime = $("#CreateTime").val();
var DocDate = $("#DocDate").val(); var DocNumDetail3 = $("#DocNumDetail3").val();
var CanEdit = $("#CanEdit").val(); var ItemID = $("#ItemID").val();
var PartNo = $("#PartNo").val(); var PartName = $("#PartName").val();
var Spec = $("#Spec").val(); var IDCust = $("#IDCust").val();
var CustName = $("#CustName").val(); var PcsPerSheet = $("#PcsPerSheet").val();
var KgPerSheet = $("#KgPerSheet").val(); var SJNum = $("#SJNum").val();
var SJDate = $("#SJDate").val();
var MatNum = $("#MatNum").val(); var QtyMat = $("#QtyMat").val();
var QtyPcs = $("#QtyPcs").val(); var PartnerID = $("#PartnerID").val();
var DocNumDetail2 = $("#DocNumDetail2").val();
var DocNum = $("#DocNum").val(); var DocNumDetail = $("#DocNumDetail").val();

if(DocNum.length==0){
NotifFail('Silahkan Log out dan coba lagi !!!');
return false();	}	
if(ItemID.length==0){
NotifFail('Silahkan klik "PartNo" untuk mengisi product');
return false();	}
if(MaterialType==2){
if(PcsPerSheet==0){
NotifFail('Pcs Per Sheet Harus di isi');  
return false();}
if(PcsPerSheet.length==0){
NotifFail('Pcs Per Sheet Harus di isi');  
return false(); } }
if(MaterialType==1){
if(KgPerSheet==0){
NotifFail('Pcs Per Kg Harus di isi');  
return false();}
if(KgPerSheet.length==0){
NotifFail('Pcs Per Kg Harus di isi');  
return false();}}
if(SJNum.length==0){
NotifFail('Surat Jalan harus diisi');  
return false();}
if(SJDate.length==0){
NotifFail('Tanggal Surat Jalan harus diisi');  
return false();}
if(MatNum.length==0){
NotifFail('No Material harus diisi'); 
return false();}     
if(PartnerID.length==0){
NotifFail('Supplier harus di isi'); 
return false();}
if(BalMat<0){
NotifFail('Qty tidak boleh nol'); 
return false();}
if(QtyMat<=0){
NotifFail('Qty tidak boleh nol'); 
return false(); }
if(CanEdit>0){
NotifFail('Dokumen ini tidak bisa diedit, sudah digunakan'); 
return false(); }
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_in/Save",
data	: "&BalMatBe="+BalMatBe+"&BalPcsBe="+BalPcsBe+"&BalMat="+BalMat+"&BalPcs="+BalPcs+"&MaterialTypeID="+MaterialTypeID+"&MaterialType="+MaterialType+"&CreateDate="+CreateDate+"&CreateTime="+CreateTime+"&DocDate="+DocDate+"&DocNumDetail3="+DocNumDetail3+"&CanEdit="+CanEdit+"&ItemID="+ItemID+"&PartNo="+PartNo+"&PartName="+PartName+"&Spec="+Spec+"&IDCust="+IDCust+"&CustName="+CustName+"&PcsPerSheet="+PcsPerSheet+"&KgPerSheet="+KgPerSheet+"&SJNum="+SJNum+"&SJDate="+SJDate+"&MatNum="+MatNum+"&QtyMat="+QtyMat+"&QtyPcs="+QtyPcs+"&PartnerID="+PartnerID+"&DocNumDetail2="+DocNumDetail2+"&DocNum="+DocNum+"&DocNumDetail="+DocNumDetail,
cache	: false,
success	: function(data){
    setTimeout(function(){
    tampil_data_detail(); AmbilFormDetail();
    NotifSuccsess(data); },1000) },
                
	error : function(xhr, teksStatus, kesalahan) {
    NotifFail('Server tidak merespon :'+kesalahan);
	} 	}); return false();	 });

    
    function NotifSuccsess(data){
        new PNotify({
        title: 'Info',
        type: 'info',
        text: data,
        addclass: 'stack-bottomright',
        nonblock: {
          nonblock: true
        },
        hide: true
      }); };
      
      function NotifProses(data){
        new PNotify({
        title: 'Info',
        type: 'dark',
        text: data,
        addclass: 'stack-bottomright',
        nonblock: {
          nonblock: true
        },
        hide: true
        
        
      }); };
      
   function NotifFail(data){
        new PNotify({
        title: 'Info',
        type: 'error',
        text: data,
        addclass: 'stack-bottomright',
        nonblock: {
          nonblock: true
        },
        hide: true
      }); }; 
      
      
      $("#ItemID").focus(function(e){
		var isi = $(e.target).val();
        CariProfilProduct();
	});
    
    $("#ItemID").click(function(e){
		var isi = $(e.target).val();
        CariProfilProduct();
	});
	
	function CariProfilProduct(){
		var kode = $("#ItemID").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Material_in/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#PartNo").val(data.PartNo);
                $("#PartName").val(data.PartName);
                $("#IDCust").val(data.IDCust);
                $("#CustName").val(data.CustName)
                $("#Spec").val(data.Spec2);
                $("#PcsPerSheet").val(data.PcsPerSheet);
                $("#KgPerSheet").val(data.KgPerSheet);
                $("#MaterialType").val(data.MaterialType);
                $("#MaterialTypeID").val(data.MaterialTypeID);
                $("#MaterialName").val(data.MaterialName);
                $("#CanEdit").val("0");
                $("#QtyMat").val("0");
                $("#QtyPcs").val("0");                
			 }  });  };
             
             
             
$("#HapusDetail").click(function(){
    var DocNumDetailDelete	    = $("#DocNumDetailDelete").val();
    var CanEditDelete         = $("#CanEditDelete").val();
    if(CanEditDelete>0){
    NotifFail('Dokumen ini tidak bisa dihapus, sudah digunakan');  return false(); }
    $("#myModalDelete").modal('hide');  
	$.ajax({
	type	: 'POST',
	url		: "<?php echo site_url(); ?>/Material_in/Hapus_Detail",
	data	: "DocNumDetailDelete="+DocNumDetailDelete,
	cache	: false,
	success	: function(data){
    setTimeout(function(){
    NotifSuccsess(data); 
    $("#DocNum2").click(); $("#DocNum2").focus();
    AmbilFormDetail(); tampil_data_detail() ; },300) },
	
    error : function(xhr, teksStatus, kesalahan) {
	$("#myModal4").modal('show');
    $("#pesan4").text('Server tidak merespon :'+kesalahan); 	} }); return false(); });
  
$("#DocNumDetail2Search").focus(function(e){
	var isi = $(e.target).val();
	AmbilFormSearch();
	});
    $("#DocNumDetail2Search").click(function(e){
    var isi = $(e.target).val();
	AmbilFormSearch();
	 });
     
    function AmbilFormSearch(){
        var x = $("#DocNumDetail2Search").val();
        var y = "INM" ;
        
        if(x.match(y)){
        var kode = $("#DocNumDetail2Search").val();
        }else{
        var kode = "" ;    
        }
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Material_in/InfoDataEdit",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
 
                $("#CreateBy").val(data.CreateBy);
                $("#CreateDateSearch").val(data.CreateDate);
                $("#CreateTimeSearch").val(data.CreateTime);
                $("#DocDateSearch").val(data.DocDate);
                $("#SJDateSearch").val(data.SJDate);
                $("#SJNumSearch").val(data.SJNum);
                
                $("#DocNum2Search").val(data.DocNum); 
                $("#DocNumDetailSearch").val(data.DocNumDetail);
                $("#DocNumDetail3Search").val(data.DocNumDetail3); 
                $("#ItemIDSearch").val(data.ItemID);
                $("#CanEditSearch").val(data.CanEdit);
                  
                
                $("#PartNoSearch").val(data.PartNo); 
                $("#PartNameSearch").val(data.PartName);  
                $("#IDCustSearch").val(data.IDCust); 
                $("#CustNameSearch").val(data.Code);   
                $("#IDProjectSearch").val(data.IDProject); 
                $("#Spec2Search").val(data.Spec2);
                
                $("#MatNumSearch").val(data.MatNum);
                
                $("#PartnerIDSearch").val(data.PartnerID);
                $("#partner_codeSearch").val(data.partner_code);
                
                $("#MaterialTypeSearch").val(data.MaterialTypeID);
                $("#MaterialNameSearch").val(data.MaterialType);
                
                $("#PcsPerSheetSearch").val(data.PcsPerSheet);
                $("#PcsPerKgSearch").val(data.KgPerSheet);
                                                
                $("#QtyMatSearch").val(data.Qty_1);
                $("#QtyPcsSearch").val(data.Qty_2);
                
                $("#BalMatBeSearch").val(data.Qty_3);
                $("#BalPcsBeSearch").val(data.Qty_4);
                
                waitingDialog3.hide();
                         
			 }  });  };
             
        $("#Search").click(function(){
		var IDCust2 = $("#IDCust2").val();
		var PartNo3 = $("#PartNo3").val();
        var PartnerID2 = $("#PartnerID2").val();
		var DocDateReport_1 = $("#DocDateReport_1").val();
		var DocDateReport_2 = $("#DocDateReport_2").val();
			
		var string = "&IDCust2="+IDCust2+"&DocDateReport_1="+DocDateReport_1+"&DocDateReport_2="+DocDateReport_2+"&PartNo3="+PartNo3+"&PartnerID2="+PartnerID2;
		
		if(DocDateReport_1.length==0){
           $("#myModal4").modal('show');
           $("#pesan4").text('Tanggal tidak boleh kosong');
		   return false();
         }
		 if(DocDateReport_2.length==0){
           $("#myModal4").modal('show');
           $("#pesan4").text('Tanggal tidak boleh kosong');
		   return false();
         }
   
         var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
		 $("#detail_report").html('');
		 $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Material_in/ReadReport",
			data	: string,
			cache	: false,
			success	: function(data){
			setTimeout(function(){
			waitingDialog3.hide();
			$("#transaction_detail_report").html(data); },1000) } }); return false();	 });
            
            
   $("#cetak").click(function(){
        var IDCust2 = $("#IDCust2").val();
		var PartNo3= $("#PartNo3").val();
        var PartnerID2 = $("#PartnerID2").val();
		var DocDateReport_1 = $("#DocDateReport_1").val();
		var DocDateReport_2 = $("#DocDateReport_2").val();
		var string = DocDateReport_1+"/"+DocDateReport_2+"/"+IDCust2+"/"+PartnerID2+"/"+PartNo3;
        
		if(DocDateReport_1.length == 0){
           $("#myModal2").modal('show');
           $("#pesan").text('Tanggal tidak boleh kosong');
		   return false(); }
		 if(DocDateReport_2.length == 0){
           $("#myModal2").modal('show');
           $("#pesan").text('Tanggal tidak boleh kosong');
		   return false();} 
           
        window.open('<?php echo site_url();?>/Material_in/ExportReport/'+string); return false();	 });
    
    
    $("#Print4").click(function(){
        var IDCust2 = $("#IDCust2").val();
		var PartNo3= $("#PartNo3").val();
        var PartnerID2 = $("#PartnerID2").val();
		var DocDateReport_1 = $("#DocDateReport_1").val();
		var DocDateReport_2 = $("#DocDateReport_2").val();
			
		var string = DocDateReport_1+"/"+DocDateReport_2+"/"+IDCust2+"/"+PartnerID2+"/"+PartNo3;
		
		if(DocDateReport_1.length == 0){
           $("#myModal2").modal('show');
           $("#pesan").text('Tanggal tidak boleh kosong');
		   return false();
         }
		 if(DocDateReport_2.length == 0){
           $("#myModal2").modal('show');
           $("#pesan").text('Tanggal tidak boleh kosong');
		   return false();
         } 
         
		window.open('<?php echo site_url();?>/Material_in/PrintList2/'+string , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
        
    

$("#Print").click(function(){
var kode	= $("#DocNum").val();
window.open('<?php echo site_url();?>/Material_in/DetailPrint/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
return false();
});

$("#Print2").click(function(){
		var kode	= $("#DocNum2").val();
		window.open('<?php echo site_url();?>/Material_in/DetailPrint/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
    
    $("#Print3").click(function(){
		var kode	= $("#DocNum2").val();
		window.open('<?php echo site_url();?>/Material_in/PrintList/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
            
function MasterList(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Material_in/MasterList",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterList").html(data);	} }); };
    
         
$("#ItemID").click(function(){
$("#myModal_product").modal('show');
MasterList(); });
$("#PartNo").click(function(){
$("#myModal_product").modal('show');
MasterList(); });
        
    
});	
</script>

<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
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

<div id="transaction_list"></div>

</div></div>`

</div>
</div>

<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="form-tab">

<div class="box-body">
<div class="box">
<div class="box-body">
<form class="form-horizontal">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h5 class="panel-title">
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
<input type="text" id="MaterialTypeID" name="MaterialTypeID"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="MaterialType" name="MaterialType"  class="form-control" readonly="readonly">
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
<input type="text" id="DocDate" name="DocDate"  class="form-control" readonly="readonly" value="<?php echo $DocDateReport_2 ; ?>">
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
<div class="col-xs-8">
<input type="text" id="Spec" name="Spec"  class="form-control" readonly="readonly">
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
<input type="text" id="KgPerSheet" name="KgPerSheet"  class="form-control" placeholder="Per Kg">
</div>
</div>
</div> 

<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">No. Surat Jalan</label>
<div class="col-xs-8">
<input type="text" id="SJNum" name="SJNum"  class="form-control" placeholder="No SJ" >
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Tgl Surat Jalan</label>
<div class="col-xs-8">
<input type="text" id="SJDate" name="SJDate"  class="date-picker form-control col-md-7 col-xs-12" readonly="true" value="<?php echo $DocDateReport_2 ; ?>">
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
<div class="col-xs-8">
<select id="PartnerID" name="PartnerID" class="form-control" style="width: 100%;">
<?php if(empty($PartnerID)){ ?>
<option value="">Select</option>
<?php } foreach($MListPartner->result() as $t){ if($PartnerID==$t->partner_name){ ?>
<option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->partner_name;?></option>
<?php }else { ?>
<option value="<?php echo $t->id;?>"><?php echo $t->partner_name;?></option>
<?php } } ?>  
</select>
</div></div>

</div>


</div></div></div></div>


</form>


<div class="box-body panel-footer">

<div class="box-tools pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle"> 
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<button type="button" id="Save" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-save"></i>&nbsp; Save</button>
<button type="button" id="AddDetail" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-plus"></i>&nbsp; Add</button>
<?php } ?>
<button type="button" name="Print" id="Print" class="btn btn-info"><i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>
<a href="#tab_content1" role="tab" id="Home"  data-toggle="tab" aria-expanded="false" class="btn btn-warning" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-reply"></i>&nbsp; Closed</a>
</div></div>


<form class="pull-right" role="search">
<div class="form-group">
<input type="text" id="DocNumDetail2" name="DocNumDetail2" class="form-control" placeholder="Search"></div>
</form>

</div>

</div></div></div>

<div class="box-body"><div class="box"><div class="box-body">

<div id="transaction_detail"></div>

</div></div></div>

</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="view-tab">


<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="AddDetail_2" data-toggle="tab" aria-expanded="false" class="btn btn-success">
<i class="fa fa-plus"></i>&nbsp; Add</a> <?php } ?>
<button type="button" name="Print2" id="Print2" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i>&nbsp; Label</button>
<button type="button" name="Print3" id="Print3" class="btn btn-success"><i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>
<button type="button" class="btn btn-info" id="reload1" name="reload1" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>
<a href="#tab_content1" role="tab" id="Home2"  data-toggle="tab" aria-expanded="false" class="btn btn-warning" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
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

<div id="transaction_detail_2"></div>

</div></div>`

</div>

</div>


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
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_1 ; ?>" id="DocDateReport_1" name="DocDateReport_1">
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
<input type="text" class="form-control pull-right" readonly="" value="<?php echo $DocDateReport_2 ; ?>" id="DocDateReport_2" name="DocDateReport_2">
</div>
                
</div>
</div>

<div class="form-group">
<label class="col-xs-4 control-label">Supplier</label>
<div class="col-xs-8">
<select id="PartnerID2" name="PartnerID2" class="form-control" style="width: 100%;">
<?php if(empty($PartnerID)){ ?>
<option value="ALL">All</option>
<?php } foreach($MListPartner->result() as $t){ if($PartnerID==$t->partner_name){ ?>
<option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->partner_name;?></option>
<?php }else { ?>
<option value="<?php echo $t->id;?>"><?php echo $t->partner_name;?></option>
<?php } } ?>  
</select>
</div></div>

</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">Customer</label>
<div class="col-xs-8">
<select id="IDCust2" name="IDCust2" class="form-control" style="width: 100%;">
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
<label class="col-lg-4 control-label">Part No</label>
<div class="col-lg-8">
<input type="text" id="PartNo3" name="PartNo3"  class="form-control" >
</div></div>

</div></div>
</div></div></div>

</form>


</div>

<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="Search" id="Search" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
<button type="button" name="cetak" id="cetak" class="btn btn-primary"><i class="glyphicon glyphicon-import"></i> Download</button>
<button type="button" name="Print4" id="Print4" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Print</button>
         
<a href="#tab_content1" id="Home3" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-info">
<i class="fa fa-reply"></i> Closed</a>
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab3" data-toggle="tab" aria-expanded="false" class="btn btn-success">
<i class="fa  fa-plus"></i> Transaction</a><?php } ?>

</div></div></div></div></div>
</div></div>

<div class="box-body">
<div class="box">
<div class="box-body">

<div id="transaction_detail_report"></div>

</div></div></div>

</div>

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
    <input hidden="true" type="text" id="CanEditDelete" name="CanEditDelete" readonly="true" >
    <input type="text" id="DocNumDetailDelete" name="DocNumDetailDelete" class="form-control" readonly="true" ></div>
    </form>
    
    </div>
    
    
</div></div></div></div></div><!-- /.modal -->


<div class="modal fade" id="myModal_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">List Product</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterList"></div>
</div> </div> </div> </div> </div> </div> </div>

<div class="modal fade" id="myModal_Search" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">Detail Transaction</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">


<form class="form-horizontal"  name="formSearch" id="formSearch">
<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksiSearch"><span class="glyphicon ">
</span> Document Properties &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="transaksiSearch" class="collapse">
<div class="panel-body">
    
<div class="col-md-6">        
<div class="form-group">
<label class="col-lg-4 control-label">DocNum</label>
<div class="col-lg-4">
<input type="text" id="DocNum2Search" name="DocNum2Search"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="DocNumDetailSearch" name="DocNumDetailSearch"  class="form-control" readonly="readonly">
</div> </div> 
<div class="form-group">
<label class="col-lg-4 control-label">Balance Before</label>
<div class="col-lg-4">
<input type="text" id="BalMatBeSearch" name="BalMatBeSearch"  class="form-control" readonly="readonly" value="0">
</div>
<div class="col-lg-4">
<input type="text" id="BalPcsBeSearch" name="BalPcsBeSearch"  class="form-control" readonly="readonly" value="0">
</div> </div>
<div class="form-group">
<label class="col-lg-4 control-label">Balance After</label>
<div class="col-lg-4">
<input type="text" id="BalMatSearch" name="BalMatSearch"  class="form-control" readonly="readonly" value="0">
</div>
<div class="col-lg-4">
<input type="text" id="BalPcsSearch" name="BalPcsSearch"  class="form-control" readonly="readonly" value="0">
</div> </div>
<div class="form-group">
<label class="col-lg-4 control-label">Material Type</label>
<div class="col-lg-4">
<input type="text" id="MaterialTypeSearch" name="MaterialTypeSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="MaterialNameSearch" name="MaterialNameSearch"  class="form-control" readonly="readonly">
</div> </div>
</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-lg-4 control-label">CreateDate</label>
<div class="col-lg-8">
<input type="text" id="CreateDateSearch" name="CreateDateSearch"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">DocTime</label>
<div class="col-lg-8">
<input type="text" id="CreateTimeSearch" name="CreateTimeSearch"  class="form-control" readonly="readonly">
</div></div> 
<div class="form-group">
<label class="col-lg-4 control-label">DocDate</label>
<div class="col-lg-8">
<input type="text" id="DocDateSearch" name="DocDateSearch"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">DocNumDetail</label>
<div class="col-lg-4">
<input type="text" id="DocNumDetail3Search" name="DocNumDetail3Search"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="CanEditSearch" name="CanEditSearch"  class="form-control" readonly="readonly">
</div></div>
</div>
</div></div></div></div>

<div class="panel-group" id="accordion">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#productSearch"><span class="glyphicon ">
</span> Data Product &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
<div id="productSearch" class="collapse in">
<div class="panel-body">


<div class="col-md-6">
<div class="form-group">
<label class="col-lg-4 control-label">Created By</label>
<div class="col-lg-8">
<input type="text" id="CreateBy" name="CreateBy"  class="form-control" readonly="readonly">
</div>
</div>

<div class="form-group">
<label class="col-lg-4 control-label">Part No</label>
<div class="col-lg-2">
<input type="text" id="ItemIDSearch" name="ItemIDSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-6">
<input type="text" id="PartNoSearch" name="PartNoSearch"  class="form-control" readonly="readonly">
</div>
</div>
 <div class="form-group">
<label class="col-lg-4 control-label">Part Name</label>
<div class="col-lg-8">
<input type="text" id="PartNameSearch" name="PartNameSearch"  class="form-control" readonly="readonly">
</div></div>
 <div class="form-group">
<label class="col-lg-4 control-label">Spec</label>
<div class="col-lg-8">
<input type="text" id="Spec2Search" name="Spec2Search"  class="form-control" readonly="readonly">
</div>
</div>
 <div class="form-group">
<label class="col-lg-4 control-label">ID Customer</label>
<div class="col-lg-4">
<input type="text" id="IDCustSearch" name="IDCustSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="CustNameSearch" name="CustNameSearch"  class="form-control" readonly="readonly">
</div> </div> 
    <div class="form-group">
<label class="col-lg-4 control-label">PCS/(Sht/Kg)</label>
<div class="col-lg-4">
<input type="text" id="PcsPerSheetSearch" name="PcsPerSheetSearch"  class="form-control" placeholder="Per Sheet" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="PcsPerKgSearch" name="PcsPerKgSearch"  class="form-control" placeholder="Per Kg" readonly="readonly">
</div>
</div>
</div> 

<div class="col-md-6">

<div class="form-group">
<label class="col-lg-4 control-label">No. Surat Jalan</label>
<div class="col-lg-4">
<input type="text" id="SJNumSearch" name="SJNumSearch"  class="form-control" placeholder="No SJ" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="PONumSearch" name="PONumSearch"  class="form-control" placeholder="No PO" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-lg-4 control-label">Tgl Surat Jalan</label>
<div class="col-lg-8">
<input type="text" id="SJDateSearch" name="SJDateSearch"  class="date-picker form-control col-md-7 col-xs-12" readonly="true" >
</div>
</div>

    <div class="form-group">
<label class="col-lg-4 control-label">No. Material</label>
<div class="col-lg-8">
<input type="text" id="MatNumSearch" name="MatNumSearch"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-lg-4 control-label">Qty</label>
<div class="col-lg-4">
<input type="text" id="QtyMatSearch" name="QtyMatSearch"  class="form-control" value="0" placeholder="Qty Masuk" readonly="readonly">
</div>
<div class="col-lg-4">
<input type="text" id="QtyPcsSearch" name="QtyPcsSearch"  class="form-control" readonly="true" value="0">
</div></div>
<div class="form-group">
<label class="col-lg-4 control-label">Supplier</label>
<div class="col-lg-2">
<input type="text" id="PartnerIDSearch" name="PartnerIDSearch"  class="form-control" readonly="true">
</div>
<div class="col-lg-6">
<input type="text" id="partner_codeSearch" name="partner_codeSearch"  class="form-control" readonly="true">
</div></div> 
</div>


</div></div></div></div></form>

    <div class="panel-footer">
    <?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
    <a  onclick="PilihEditSearch()" href="#tab_content2" data-toggle="tab" aria-expanded="false"  class="btn btn-warning">
    <i class="glyphicon glyphicon-edit"></i> Edit</a>
    <?php } ?>  
    <form class="navbar-right" role="search">
    <div class="form-group">
    <input type="text" id="DocNumDetail2Search" name="DocNumDetail2Search" class="form-control" placeholder="Search"></div>
    </form>
          
    </div>
    
    

 </div> </div> </div> </div> </div> </div> </div> 

    <script type="text/javascript">     
function Search(){
    var DocNumSearch 	    = $("#DocNumSearch").val();
    if(DocNumSearch.length==0){
      $("#myModal4").modal('show');
      $("#pesan4").text('Masukan No Barcode');  
    }else{
    $("#myModal_Search").modal("show");
	$("#DocNumDetail2Search").val(DocNumSearch);
    $("#DocNumDetailSearch").val(DocNumSearch.substr(12,3));
    setTimeout(function(){
					$("#DocNumDetail2Search").focus();
					$("#DocNumDetail2Search").click();
                    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
          setTimeout(function(){
					$("#DocNumDetail2Search").focus();
					$("#DocNumDetail2Search").click();
				},300) ;
				},500) 
			return false(); 
	 }
    }
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
  $(function () {
    //Initialize Select2 Elements
    $("#PartnerID").select2(); $("#PartnerID2").select2(); $("#IDCust2").select2();
    $("#SysID").select2();

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
    $('#DocDateReport_1').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#DocDateReport_2').datepicker({
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

<script> $(function () { $("#t_list_master").DataTable(); });</script>