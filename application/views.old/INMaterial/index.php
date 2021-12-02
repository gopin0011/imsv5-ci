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
 url		: "<?php echo site_url(); ?>/INMaterial/TransactionList",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#tampil_data").html(data);  $('#reload').button('reset');
 $("#myModal100").modal('hide'); 
 } }); };
    
    $("#DocNumSearch").keyup(function(event){
    if(event.keyCode == 13){
        $("#DocNumSearchButton").click();
    } });
    
    $("#DocNumDetail2").focusout(function(){
	var  DocNumDetail2 = $("#DocNumDetail2").val();
    if(DocNumDetail2.length==0){
	AmbilForm(); hitung();
    Detail_data();}
	});    
    $("#DocNumDetail2").focus(function(e){
		var isi = $(e.target).val();
	AmbilFormEdit(); hitung();
    Detail_data();
	});
	$("#DocNumDetail2").keyup(function(){
	AmbilFormEdit(); hitung();
    Detail_data();
	});
    
    $("#DocNumDetail2").click(function(e){
    var isi = $(e.target).val();
	AmbilFormEdit(); hitung();
    Detail_data();
	 });
     
    $("#Spec1").click(function(e){
    var isi = $(e.target).val();
    Detail_data();
	 });
    $("#Spec1").focus(function(e){
	var isi = $(e.target).val();
    Detail_data();
	});
    
    
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
                
                hitung();
        
                  
                         
			 }  });  };
    
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
			url		: "<?php echo site_url(); ?>/ref_json/InfoDataEdit",
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
                $("#Spec1Search").val(data.Spec1);
                $("#Spec2Search").val(data.Spec2);
                
                $("#MatNumSearch").val(data.MatNum);
                
                $("#PartnerIDSearch").val(data.PartnerID);
                $("#partner_codeSearch").val(data.partner_code);
                
                $("#MaterialTypeSearch").val(data.MaterialType);
                $("#MaterialNameSearch").val(data.MaterialName);
                
                $("#PcsPerSheetSearch").val(data.PcsPerSheet);
                $("#PcsPerKgSearch").val(data.PcsPerKg);
                                
                $("#PONumSearch").val(data.SourceDocNum);
                
                $("#QtyMatSearch").val(data.QtyMat);
                $("#QtyPcsSearch").val(data.QtyPcs);
                
                $("#BalMatBeSearch").val(data.BalMat);
                $("#BalPcsBeSearch").val(data.BalPcs);
                waitingDialog3.hide();
                         
			 }  });  };         
             
 $("#DocNum2").focus(function(e){ var isi = $(e.target).val(); Detail_data2(); });
 $("#DocNum2").keyup(function(){ Detail_data2(); });
 $("#DocNum2").keyup(function(){ Detail_data2(); });
 
function Detail_data2(){
 var kode = $("#DocNum2").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/INMaterial/DataDetailMatIn2",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#Detail_data2").html(data);
 waitingDialog3.hide(); } }); }
    
$("#QtyMat").focus(function(){ var  QtyMat = $("#QtyMat").val();
 if(QtyMat == 0){ $("#QtyMat").val(""); hitung(); return false(); }  });
        
$("#QtyMat").focusout(function(){
 var  QtyMat = $("#QtyMat").val();
 if(QtyMat.length==0){
 $("#QtyMat").val("0"); hitung();
 return false(); }  });
    
$("#DocNum2").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });
$("#DocNumDetail2").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });

$("#SJNum").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
    $("#PONum").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
    $("#MatNum").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
         $("#PcsPerSheet").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		} });
        $("#PcsPerKg").keypress(function(data){
		if (data.which!=46 && data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		} });
          $("#QtyMat").keypress(function(data){
		if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		} });
        
        
        
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
		$("#BalPcs").val(BalPcs);
        }
        
$("#QtyMat").keyup(function(){
hitung(); });

$("#PcsPerSheet").keyup(function(){
hitung(); });

$("#PcsPerKg").keyup(function(){
hitung(); });

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
					$("#Spec1").focus();
					$("#Spec1").click();
                    waitingDialog3.hide();
				},300) ;
      ta}, 1000);
    
    });	
    
    $("#form-tab2").click(function(){
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function () { 
     AmbilForm(); 
     setTimeout(function(){
					$("#Spec1").focus();
					$("#Spec1").click();
                    
				},300) ;
     ta}, 1000);
    
    });
    
    $("#form-tab3").click(function(){
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function () { 
     AmbilForm(); 
     setTimeout(function(){
					$("#Spec1").focus();
					$("#Spec1").click();
                    
				},300) ;
     ta}, 1000);
    
    });
    
    
   function AmbilForm(){
		var kode = "";
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoTambahFormMatIn",
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
                $("#PcsPerKg").val("");
                $("#SJNum").val("");
                $("#PONum").val("");
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
			url		: "<?php echo site_url(); ?>/ref_json/InfoTambahFormDetailMatIN",
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
                $("#Spec1").val("");
                $("#Spec2").val("");
                $("#PcsPerDay").val("");
                $("#PcsPerSheet").val("");
                $("#PcsPerKg").val("");
                $("#SJNum").val("");
                $("#PONum").val("");
                $("#MatNum").val("");
                $("#PartnerID").val(data.PartnerID);
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
                
                CariProfilPartner();           
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
			url		: "<?php echo site_url(); ?>/INMaterial/DataDetailMatIn",
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
                $("#CustName").val(data.CustName)
                $("#Spec1").val(data.Spec1);
                $("#Spec2").val(data.Spec2);
                $("#PcsPerDay").val(data.PcsPerday);
                $("#PcsPerSheet").val(data.PcsPerSheet);
                $("#PcsPerKg").val(data.PcsPerKg);
                $("#MaterialType").val(data.MaterialType);
                $("#MaterialName").val(data.MaterialName);
                $("#CanEdit").val("0");
                $("#QtyMat").val("0");
                $("#QtyPcs").val("0");                
			 }  });  };
             
    $("#PartnerID").focus(function(e){
		var isi = $(e.target).val();
		CariProfilPartner();
	});
	$("#PartnerID").keyup(function(){
		CariProfilPartner();	
	});
	
	function CariProfilPartner(){
		var kode = $("#PartnerID").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoPartner",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#partner_code").val(data.partner_code);
                $("#partner_name").val(data.partner_name);
			 }  });  };
             
             
             
    $("#PartnerID2").focus(function(e){
		var isi = $(e.target).val();
		CariProfilPartner2();
	});
	$("#PartnerID2").keyup(function(){
		CariProfilPartner2();	
	});
	
	function CariProfilPartner2(){
		var kode = $("#PartnerID2").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoPartner",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#partner_code2").val(data.partner_code);
                $("#partner_name2").val(data.partner_name);
			 }  });  };
             
             
    
    $("#code").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});
    
     $("#unit").keyup(function(e){
		var isi = $(e.target).val();
		$(e.target).val(isi.toUpperCase());
	});

    
    $("#telp").keypress(function(data){
		if (data.which!=8 && data.which!=32 && data.which!=43 && data.which!=0 && (data.which<48 || data.which>57)) {
			return false;
		}
	});
  
	
	$("#simpan").click(function(){
		var DocNum 	    = $("#DocNum").val();
		var ItemID		    = $("#ItemID").val();
        var SJNum		    = $("#SJNum").val();
        var SJDate		    = $("#SJDate").val();
        var MatNum	        = $("#MatNum").val();
        var PartnerID       = $("#PartnerID").val();
        var PcsPerSheet     = $("#PcsPerSheet").val();
        var PcsPerKg        = $("#PcsPerKg").val(); 
        var BalMat          = $("#BalMat").val();
        var QtyMat          = $("#QtyMat").val();
        var MaterialType    = $("#MaterialType").val();
        var CanEdit         = $("#CanEdit").val();
		
		var string = $("#form").serialize();
		
		if(DocNum.length==0){
            NotifFail('Data Gagal di simpan, Silahkan Klik TUTUP dan coba lagi'); 
			return false();
		}
        if(ItemID.length==0){ 
          NotifFail('Silahkan klik "PartNo" untuk mengisi product');
			return false();
		}

        if(MaterialType==2){
            if(PcsPerSheet==0){
            NotifFail('Pcs Per Sheet Harus di isi');  
			return false();}
            if(PcsPerSheet.length==0){
            NotifFail('Pcs Per Sheet Harus di isi');  
			return false();
		}  
		}
        if(MaterialType==1){
            if(PcsPerKg==0){
            NotifFail('Pcs Per Kg Harus di isi');  
			return false();}
            if(PcsPerKg.length==0){
            NotifFail('Pcs Per Kg Harus di isi');  
			return false();
		}
		}
        if(SJNum.length==0){
            NotifFail('Surat Jalan harus diisi');  
			return false();
		}
        if(SJDate.length==0){
            NotifFail('Tanggal Surat Jalan harus diisi');  
			return false();
		}
		if(MatNum.length==0){
            NotifFail('No Material harus diisi'); 
			return false();
		}     
         if(PartnerID.length==0){
            NotifFail('Supplier harus di isi'); 
			return false();
		}
        if(BalMat<0){
            NotifFail('Qty tidak boleh nol'); 
			return false();
		}
        if(QtyMat<=0){
            NotifFail('Qty tidak boleh nol'); 
			return false();
		}
        if(CanEdit>0){
            NotifFail('Dokumen ini tidak bisa diedit, sudah digunakan'); 
			return false();
		}
        
       var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'}); 
        $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/INMaterial/SimpanMaterialIn",
			data	: string,
			cache	: false,
			success	: function(data){
            setTimeout(function(){
    waitingDialog3.hide();
    Detail_data(); AmbilFormDetail();
    NotifSuccsess(data);
				},1000)
			},
			error : function(xhr, teksStatus, kesalahan) {
				$("#myModal4").modal('show');
                $("#pesan4").text('Server tidak merespon :'+kesalahan);
			}
		});
		return false();		
	});
    
    
       function NotifSuccsess(data){
        new PNotify({
        title: 'Info',
        type: 'info',
        text: data,
        hide: true
      }); };
      
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
 var IDCust2 = $("#IDCust2").val();
 var PartNo3= $("#PartNo3").val();
 var PartnerID2 = $("#PartnerID2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = "&IDCust2="+IDCust2+"&tgl1="+tgl1+"&tgl2="+tgl2+"&PartNo3="+PartNo3+"&PartnerID2="+PartnerID2;
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
 url		: "<?php echo site_url(); ?>/INMaterial/ReadReport",
 data	: string,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 waitingDialog3.hide();
 $("#transaction_detail_report").html(data); },1000) } }); return false(); });

    
$("#Download").click(function(){
 var IDCust2 = $("#IDCust2").val();
 var PartNo3= $("#PartNo3").val();
 var PartnerID2 = $("#PartnerID2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = tgl1+"/"+tgl2+"/"+IDCust2+"/"+PartnerID2+"/"+PartNo3;
 if(tgl1.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong') ; return false(); }
 if(tgl2.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong'); return false(); }

$("#Download").button('loading');
setTimeout(function(){
$("#Download").button('reset'); }, 1000);

 window.open('<?php echo site_url();?>/INMaterial/ExportReport/'+string); 
 
 return false(); });
    
$("#Print4").click(function(){
 var IDCust2 = $("#IDCust2").val();
 var PartNo3= $("#PartNo3").val();
 var PartnerID2 = $("#PartnerID2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = tgl1+"/"+tgl2+"/"+IDCust2+"/"+PartnerID2+"/"+PartNo3;
 if(tgl1.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong'); return false(); }
 
 if(tgl2.length == 0){
 $("#myModal2").modal('show');
 $("#pesan").text('Tanggal tidak boleh kosong'); return false(); } 

$("#Print4").button('loading');
setTimeout(function(){
$("#Print4").button('reset'); }, 1000);

 window.open('<?php echo site_url();?>/INMaterial/PrintList2/'+string , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
    
             
        function BackHome(){
        window.location.replace("<?php echo base_url();?>index.php/INMaterial/");
        }
             
    
	
    
$("#HapusDetail").click(function(){
 var DocNumDetailDelete	    = $("#DocNumDetailDelete").val();
 var CanEditDelete         = $("#CanEditDelete").val();
 if(CanEditDelete>0){ NotifFail('Dokumen ini tidak bisa dihapus, sudah digunakan');  return false(); }
        
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/INMaterial/Hapus_Transaksi",
 data	: "DocNumDetailDelete="+DocNumDetailDelete,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 NotifFail(data);
 $("#Reload1").click(); $("#tab_tambah_detail").click();  },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 $("#myModal4").modal('show');
 $("#pesan4").text('Server tidak merespon :'+kesalahan); } }); return false(); });
    

        $("#Print").click(function(){
		var kode	= $("#DocNum").val();
		window.open('<?php echo site_url();?>/INMaterial/DetailPrint/'+kode , 'myWindow', 
        'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
        });
    
        $("#Print2").click(function(){
		var kode	= $("#DocNum2").val();
		window.open('<?php echo site_url();?>/INMaterial/DetailPrint/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
    
    $("#Print3").click(function(){
		var kode	= $("#DocNum2").val();
		window.open('<?php echo site_url();?>/INMaterial/PrintList/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});

function MasterList(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/INMaterial/MasterList",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterList").html(data);	} }); };

function MasterListPartner(){
var kode = "";
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/INMaterial/MasterListPartner",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#MasterListPartner").html(data);	} }); };
    
    $("#Tutup").click(function(){
	$("#myModal3").modal('hide');
	}); 
    
    
    $("#ItemID").click(function(){
		$("#myModal_product").modal('show'); MasterList();
	});
    $("#PartNo").click(function(){
		$("#myModal_product").modal('show'); MasterList();
	});
    $("#PartnerID").click(function(){
		$("#myModal_Partner").modal('show'); MasterListPartner();
	});
 
     $("#PartnerID2").click(function(){
		$("#myModal_Partner2").modal('show'); MasterListPartner();
	});
    

    	
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

<div id="tampil_data"></div>

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
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<button type="button" name="simpan" id="simpan" class="btn btn-warning"><i class="fa fa-save"></i> Save</button>
<button type="button" id="tab_tambah_detail" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-plus"></i>&nbsp; Add</button>
<?php } ?>
<button type="button" name="Print" id="Print" class="btn btn-info"><i class="glyphicon glyphicon-print"></i> Print</button>
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?> <?php } ?>  
<a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
<i class="fa fa-mail-reply"></i> Closed</a>
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
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
<?php  $cek = $this->session->userdata('CanEditDoc')=='1'; if(!empty($cek)){ ?>
<a onfocus="PilihTambah()" href="#tab_content2" data-toggle="tab" aria-expanded="false" class="btn btn-warning" ><i class="glyphicon glyphicon-plus"></i> Add</a>
<?php } ?>
<button type="button" name="Print2" id="Print2" class="btn btn-primary"><i class="glyphicon glyphicon-print"></i> Label</button>
<button type="button" name="Print3" id="Print3" class="btn btn-success"><i class="glyphicon glyphicon-print"></i> Print</button>
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
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-8">
<input type="text" id="PartNo3" name="PartNo3"  class="form-control" >
</div></div>

</div></div>
</div></div></div>
</form>
</div>
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="Search" id="Search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
<button type="button" class="btn btn-success" id="Download" name="Download" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="glyphicon glyphicon-import"></i>&nbsp; Download</button>
<button type="button" class="btn btn-info" id="Print4" name="Print4" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
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

<div class="modal fade" id="myModal_Partner" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">List Product</h4>
</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="MasterListPartner"></div>
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
<label class="col-xs-4 control-label">DocNum</label>
<div class="col-xs-4">
<input type="text" id="DocNum2Search" name="DocNum2Search"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="DocNumDetailSearch" name="DocNumDetailSearch"  class="form-control" readonly="readonly">
</div> </div> 
<div class="form-group">
<label class="col-xs-4 control-label">Balance Before</label>
<div class="col-xs-4">
<input type="text" id="BalMatBeSearch" name="BalMatBeSearch"  class="form-control" readonly="readonly" value="0">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcsBeSearch" name="BalPcsBeSearch"  class="form-control" readonly="readonly" value="0">
</div> </div>
<div class="form-group">
<label class="col-xs-4 control-label">Balance After</label>
<div class="col-xs-4">
<input type="text" id="BalMatSearch" name="BalMatSearch"  class="form-control" readonly="readonly" value="0">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcsSearch" name="BalPcsSearch"  class="form-control" readonly="readonly" value="0">
</div> </div>
<div class="form-group">
<label class="col-xs-4 control-label">Material Type</label>
<div class="col-xs-4">
<input type="text" id="MaterialTypeSearch" name="MaterialTypeSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="MaterialNameSearch" name="MaterialNameSearch"  class="form-control" readonly="readonly">
</div> </div>
</div>

<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">CreateDate</label>
<div class="col-xs-8">
<input type="text" id="CreateDateSearch" name="CreateDateSearch"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">DocTime</label>
<div class="col-xs-8">
<input type="text" id="CreateTimeSearch" name="CreateTimeSearch"  class="form-control" readonly="readonly">
</div></div> 
<div class="form-group">
<label class="col-xs-4 control-label">DocDate</label>
<div class="col-xs-8">
<input type="text" id="DocDateSearch" name="DocDateSearch"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">DocNumDetail</label>
<div class="col-xs-4">
<input type="text" id="DocNumDetail3Search" name="DocNumDetail3Search"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
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
<label class="col-xs-4 control-label">Created By</label>
<div class="col-xs-8">
<input type="text" id="CreateBy" name="CreateBy"  class="form-control" readonly="readonly">
</div>
</div>

<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-2">
<input type="text" id="ItemIDSearch" name="ItemIDSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-6">
<input type="text" id="PartNoSearch" name="PartNoSearch"  class="form-control" readonly="readonly">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">Part Name</label>
<div class="col-xs-8">
<input type="text" id="PartNameSearch" name="PartNameSearch"  class="form-control" readonly="readonly">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Spec</label>
<div class="col-xs-8">
<input type="text" id="Spec2Search" name="Spec2Search"  class="form-control" readonly="readonly">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">ID Customer</label>
<div class="col-xs-4">
<input type="text" id="IDCustSearch" name="IDCustSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="CustNameSearch" name="CustNameSearch"  class="form-control" readonly="readonly">
</div> </div> 
    <div class="form-group">
<label class="col-xs-4 control-label">PCS/(Sht/Kg)</label>
<div class="col-xs-4">
<input type="text" id="PcsPerSheetSearch" name="PcsPerSheetSearch"  class="form-control" placeholder="Per Sheet" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="PcsPerKgSearch" name="PcsPerKgSearch"  class="form-control" placeholder="Per Kg" readonly="readonly">
</div>
</div>
</div> 

<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">No. Surat Jalan</label>
<div class="col-xs-4">
<input type="text" id="SJNumSearch" name="SJNumSearch"  class="form-control" placeholder="No SJ" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="PONumSearch" name="PONumSearch"  class="form-control" placeholder="No PO" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Tgl Surat Jalan</label>
<div class="col-xs-8">
<input type="text" id="SJDateSearch" name="SJDateSearch"  class="date-picker form-control col-md-7 col-xs-12" readonly="true" >
</div>
</div>

    <div class="form-group">
<label class="col-xs-4 control-label">No. Material</label>
<div class="col-xs-8">
<input type="text" id="MatNumSearch" name="MatNumSearch"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Qty</label>
<div class="col-xs-4">
<input type="text" id="QtyMatSearch" name="QtyMatSearch"  class="form-control" value="0" placeholder="Qty Masuk" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="QtyPcsSearch" name="QtyPcsSearch"  class="form-control" readonly="true" value="0">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">Supplier</label>
<div class="col-xs-2">
<input type="text" id="PartnerIDSearch" name="PartnerIDSearch"  class="form-control" readonly="true">
</div>
<div class="col-xs-6">
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
    //Initialize Select2 Elements PartnerID2 PartnerID2
    $("#PartnerID2").select2();  $("#IDCust2").select2();

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
	
	$('#tgl_1').datepicker({
      autoclose: true,
      format: "dd-mm-yyyy"
    });
    $('#tgl_2').datepicker({
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
