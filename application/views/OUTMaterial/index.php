<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function(){
    ion.sound({ sounds: [
    {name: "metal_plate"},
    {name: "water_droplet"}
            ],
    path: "<?php echo base_url(); ?>assets/sounds/",
    preload: true,
    volume: 1.0 });
    });
</script>
  
<script type="text/javascript">
$(document).ready(function(){

tampil_data();
$('#reload').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data(); });
 
$('#Reload1').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 setTimeout(function() {
 $this.button('reset');
 Detail_data();
 Detail_data2();
 }, 500);
 });
 
function tampil_data(){
 var kode = "" ;
 $('#reload').button('loading');
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/OUTMaterial/TransactionList",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#tampil_data").html(data); $('#reload').button('reset');
 $("#myModal100").modal('hide'); } }); };
    
$("#DocNumSearch").keyup(function(event){
 if(event.keyCode == 13){
 $("#DocNumSearchButton").click(); } });

$("#DocNumExt").click(function(){
 List_Material(); });	
                

$('#Reload2').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 List_Material(); });
      
function List_Material(){
 var kode = "" ;
 $("#List_Material").html("");
 $('#Reload2').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OUTMaterial/List_Material",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#Reload2').button('reset'); }, 900);
 setTimeout(function() {
 $("#List_Material").html(data); }, 700); } }); };
    
    
    $("#DocNumDetail2").focusout(function(){
	var  DocNumDetail2 = $("#DocNumDetail2").val();
    if(DocNumDetail2.length==0){
	AmbilForm();
    Detail_data();}
	});    
    $("#DocNumDetail2").focus(function(e){
		var isi = $(e.target).val();
	AmbilFormEdit();  hitung();
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
  
    
    $("#ItemIDExt").click(function(e){
    var isi = $(e.target).val();
    Detail_data();
	 });
    $("#ItemIDExt").focus(function(e){
	var isi = $(e.target).val();
    Detail_data();
	});
    
    function AmbilFormEdit(){
		var x = $("#DocNumDetail2").val();
        var y = "BSTM" ;
        
        if(x.match(y)){
        var kode = $("#DocNumDetail2").val();
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
   
                 
                $("#CreateDate").val(data.CreateDate);
                $("#CreateTime").val(data.CreateTime);
                $("#DocDate").val(data.DocDate);
                $("#SJDate").val(data.SJDate);
                $("#SJNum").val(data.SJNum);
                
                $("#DocNum").val(data.DocNum); 
                $("#DocNumDetail").val(data.DocNumDetailOut);
                $("#DocNumDetail3").val(data.DocNumDetail3); 
                $("#ItemID").val(data.ItemID);
                $("#ItemIDExt").val(data.ItemIDExt);
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
                                
                $("#DocNumExt").val(data.SourceDocNum);
                
                $("#QtyMat").val(data.QtyMat);
                $("#QtyPcs").val(data.QtyPcs);
                
                $("#NGMat").val(data.NGMat);
                
                $("#BalMatBe").val(data.QtyMat);
                $("#BalPcsBe").val(data.QtyPcs);
                
                $("#BalMatSource").val(data.BalMatSource);
                $("#BalPcsSource").val(data.BalPcsSource);
                
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
        var y = "BSTM" ;
        
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
                $("#DocNumDetailSearch").val(data.DocNumDetailOut);
                $("#DocNumDetail3Search").val(data.DocNumDetail3); 
                $("#ItemIDSearch").val(data.ItemID);
                $("#ItemIDExtSearch").val(data.ItemIDExt);
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
                                
                $("#DocNumExtSearch").val(data.SourceDocNum);
                
                $("#QtyMatSearch").val(data.QtyMat);
                $("#QtyPcsSearch").val(data.QtyPcs);
                
                $("#NGMatSearch").val(data.NGMat);
                
                $("#BalMatBeSearch").val(data.QtyMat);
                $("#BalPcsBeSearch").val(data.QtyPcs);
                
                $("#BalMatSourceSearch").val(data.BalMatSource);
                $("#BalPcsSourceSearch").val(data.BalPcsSource);
                
                waitingDialog3.hide();  
                         
			 }  });  };
             
             
$("#DocNum2").focus(function(e){ var isi = $(e.target).val(); Detail_data2(); });
$("#DocNum2").keyup(function(){ Detail_data2();	 });
$("#DocNum2").keyup(function(){ Detail_data2();	 });
function Detail_data2(){
 var kode = $("#DocNum2").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OUTMaterial/DataDetailMatIn2",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#Detail_data2").html(data);
 waitingDialog3.hide(); } }); }
    
    
     $("#QtyMat").focus(function(){
		var  QtyMat = $("#QtyMat").val();
  
        if(QtyMat == 0){
		$("#QtyMat").val(""); 
        return false();
		} 
        });
        
        $("#QtyMat").focusout(function(){
            var  QtyMat = $("#QtyMat").val();
  
        if(QtyMat.length==0){
		$("#QtyMat").val("0"); hitung();
        return false();
		} 
        });
        
     $("#NGMat").focus(function(){
		var  NGMat = $("#NGMat").val();
  
        if(NGMat == 0){
		$("#NGMat").val("");
        return false();
		} 
        });
        
        $("#NGMat").focusout(function(){
            var  NGMat = $("#NGMat").val();
  
        if(NGMat.length==0){
		$("#NGMat").val("0"); hitung();
        return false();
		} 
        });
    
    
    
    
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
        var BalMatSource      = $("#BalMatSource").val();
        var BalPcsSource     = $("#BalPcsSource").val();
        
        var NGMat     = $("#NGMat").val();
        var NGMatBe     = $("#NGMatBe").val();
        
        var BalMatSourceAf      = $("#BalMatSourceAf").val();
        var BalPcsSourceAf     = $("#BalPcsSourceAf").val();
        
        var BalMatBe      = $("#BalMatBe").val();
        var BalPcsBe      = $("#BalPcsBe").val();
        
        var BalMatAf      = $("#BalMatAf").val();
        var BalPcsAf      = $("#BalPcsAf").val();
        
        var PcsPerSheet = $("#PcsPerSheet").val();
        var PcsPerKg    = $("#PcsPerKg").val();
        var MaterialType         = $("#MaterialType").val();
        
        
        var BalMatSourceAf = (parseFloat(BalMatSource) +  parseFloat(BalMatBe)) - parseFloat(QtyMat);
		$("#BalMatSourceAf").val(BalMatSourceAf);
        
        var BalMatAf = (parseFloat(QtyMat) - parseFloat(NGMat)) + parseFloat(NGMatBe);
		$("#BalMatAf").val(BalMatAf);                
        
        if(MaterialType==2){
        var BalPcsSourceAf = (parseFloat(BalPcsSource) + parseFloat(BalPcsBe)) - (parseFloat(QtyMat) * parseFloat(PcsPerSheet));
		$("#BalPcsSourceAf").val(BalPcsSourceAf); 
        }                
        
        if(MaterialType==1){
        var BalPcsSourceAf = (parseFloat(BalPcsSource) + parseFloat(BalPcsBe)) - (parseFloat(QtyMat) / parseFloat(PcsPerKg));
		$("#BalPcsSourceAf").val(BalPcsSourceAf);        
        }
        
        if(MaterialType==2){
        var BalPcsAf = parseFloat(BalMatAf) * parseFloat(PcsPerSheet);
		$("#BalPcsAf").val(BalPcsAf);
        }    
        
        if(MaterialType==1){
        var BalPcsAf = parseFloat(BalMatAf) / parseFloat(PcsPerKg);
		$("#BalPcsAf").val(BalPcsAf);        
        }
        
        if(MaterialType==2){
        var QtyPcs = parseFloat(QtyMat) * parseFloat(PcsPerSheet);
		$("#QtyPcs").val(QtyPcs);
        }    
        
        if(MaterialType==1){
        var QtyPcs = parseFloat(QtyMat) / parseFloat(PcsPerKg);
		$("#QtyPcs").val(QtyPcs);        
        }
        
        }
        
$("#QtyMat").keyup(function(){
hitung(); });

$("#PcsPerSheet").keyup(function(){
hitung(); });

$("#PcsPerKg").keyup(function(){
hitung(); });

$("#NGMat").keyup(function(){
hitung(); });

$("#NGMat").focusout(function(){
hitung(); });

$("#QtyMat").focusout(function(){
hitung(); });

$("#QtyMat").focus(function(){
hitung(); });

$("#PcsPerSheet").focus(function(){
hitung(); });

$("#PcsPerKg").focus(function(){
hitung(); });

$("#NGMat").focus(function(){
hitung(); });

$("#NGMat").focus(function(){
hitung(); });

$("#QtyMat").focus(function(){
hitung(); });

$("#DocNumDetail2").focus(function(){
hitung(); });
$("#DocNumDetail2").focusout(function(){
hitung(); });
$("#DocNumDetail2").click(function(){
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
 $("#tab_tambah_detail").focus();
 $("#tab_tambah_detail").click();
 waitingDialog3.hide(); },300) ; ta}, 1000); });	
    
$("#form-tab2").click(function(){
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function () { 
 AmbilForm(); 
 setTimeout(function(){
					$("#ItemIDExt").focus();
					$("#ItemIDExt").click();
                    
				},300) ;
     ta}, 1000);
    
    });
    
        $("#form-tab3").click(function(){
    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
    setTimeout(function () { 
     AmbilForm(); 
     setTimeout(function(){
					$("#ItemIDExt").focus();
					$("#ItemIDExt").click();
                    
				},300) ;
     ta}, 1000);
    
    });
    
   
     
   function AmbilForm(){
		var kode = "";
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoTambahFormMatOut",
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
                $("#CanEdit").val("0");
                
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
                $("#DocNumExt").val("");
                $("#MatNum").val("");
                $("#PartnerID").val("");
                $("#partner_code").val("");
                $("#QtyMat").val("0");
                $("#QtyPcs").val("0");
                $("#BalMat").val("0");
                $("#BalPcs").val("0");
                $("#BalMatBe").val("0");
                $("#BalPcsBe").val("0");
                
                $("#BalMatSourceAf").val("0");
                $("#BalPcsSourceAf").val("0");
                $("#BalMatSource").val("0");
                $("#BalPcsSource").val("0");                
                $("#BalMatBe").val("0");
                $("#BalPcsBe").val("0");
                $("#BalMatAf").val("0");
                $("#BalPcsAf").val("0");
                $("#NGMat").val("0");
                $("#ItemIDExt").val("");
                

                
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
 url		: "<?php echo site_url(); ?>/ref_json/InfoTambahFormDetailMatOut",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#DocNumDetail").val(data.DocNumDetail); 
 $("#CreateDate").val(data.CreateDate);
 $("#CreateTime").val(data.CreateTime);
 $("#DocDate").val(data.DocDate);
 $("#SJDate").val(data.CreateDate);
 $("#CanEdit").val("0");
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
                $("#DocNumExt").val("");
                $("#MatNum").val("");
                $("#QtyMat").val("0");
                $("#QtyPcs").val("0");
                $("#BalMat").val("0");
                $("#BalPcs").val("0");
                $("#BalMatBe").val("0");
                $("#BalPcsBe").val("0"); 
                
                $("#BalMatSourceAf").val("0");
                $("#BalPcsSourceAf").val("0");
                $("#BalMatSource").val("0");
                $("#BalPcsSource").val("0");                
                $("#BalMatBe").val("0");
                $("#BalPcsBe").val("0");
                $("#BalMatAf").val("0");
                $("#BalPcsAf").val("0");
                $("#NGMat").val("0");
                
                $("#ItemIDExt").val("");
                
                $("#MaterialType").val("");
                $("#MaterialName").val("");            
			 }  });  };
             
$("#tab_tambah_detail").focus(function(e){
 var isi = $(e.target).val();
 Detail_data(); AmbilFormDetail();  });
$("#tab_tambah_detail").keyup(function(){
 Detail_data(); AmbilFormDetail(); });
    
function Detail_data(){
 var kode = $("#DocNum").val();
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/OUTMaterial/DataDetailMatIn",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 $("#Detail_data").html(data);
 waitingDialog3.hide(); } }); }
        
    $("#DocNumExt").focus(function(e){
		var isi = $(e.target).val();
        var DocNumDetail3 = $("#DocNumDetail3").val();
        if(DocNumDetail3.length==0){
		CariListMaterialOut(); }
	});
	$("#DocNumExt").keyup(function(){
	   var DocNumDetail3 = $("#DocNumDetail3").val();
	   if(DocNumDetail3.length==0){
		CariListMaterialOut();	}
	});
	
	function CariListMaterialOut(){
		var kode = $("#DocNumExt").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/ref_json/InfoDataEdit",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#ItemIDExt").val(data.ItemID);
                $("#ItemID").val(data.ItemID);
                $("#PartNo").val(data.PartNo);
                $("#PartName").val(data.PartName);
                $("#IDCust").val(data.IDCust);
                $("#CustName").val(data.Code)
                $("#Spec1").val(data.Spec1);
                $("#Spec2").val(data.Spec2);
                $("#PcsPerSheet").val(data.PcsPerSheet);
                $("#PcsPerKg").val(data.PcsPerKg);
                $("#BalMatSource").val(data.BalMat);
                $("#BalPcsSource").val(data.BalPcs);
                $("#MaterialType").val(data.MaterialType);
                $("#MaterialName").val(data.MaterialName);
                                
                $("#BalMatBe").val("0");
                $("#BalPcsBe").val("0");
                $("#BalMatAf").val("0");
                $("#BalPcsAf").val("0");
                $("#NGMat").val("0");
                
                $("#QtyMat").val(data.BalMat);
                $("#QtyPcs").val(data.BalPcs);
                $("#BalMat").val("0");
                $("#BalPcs").val("0");
                $("#BalMatBe").val("0");
                $("#BalPcsBe").val("0");
                $("#DocNumDetail2").val("");
                $("#DocNumDetail3").val("");
                
                setTimeout(function(){
                hitung(); 
                },500)
                
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
		var DocNum 	                = $("#DocNum").val();
		var ItemID		            = $("#ItemID").val();
        var DocNumExt		        = $("#DocNumExt").val();
        var ItemIDExt		        = $("#ItemIDExt").val();
        var QtyMat	                = $("#QtyMat").val();
        var BalMatAf                = $("#BalMatAf").val();
        var PcsPerSheet             = $("#PcsPerSheet").val();
        var PcsPerKg                = $("#PcsPerKg").val(); 
        var BalMatSourceAf          = $("#BalMatSourceAf").val();
        var MaterialType            = $("#MaterialType").val();
        var CanEdit         = $("#CanEdit").val(); 
		
		var string = $("#form").serialize();
		
		if(DocNum.length==0){
		  NotifFail('Data Gagal di simpan, Silahkan Klik TUTUP dan coba lagi'); 
			return false();
		}

        		if(DocNumExt.length==0){ 
          NotifFail('Ref No Harus di isi');
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
        if(QtyMat<=0){
            NotifFail('Qty tidak boleh kurang dari atau sama dengan nol ');  
			return false();
		}
        if(NGMat<0){
            NotifFail('Qty tidak boleh kurang dari');  
			return false();
		}
		if(BalMatSourceAf<0){
		  NotifFail('Material tidak cukup !'); 
			return false();
		} 
        
        if(isNaN(BalMatSourceAf)){
		  NotifFail('Isi sesuai perintah !'); 
			return false();
		}
        
        if(CanEdit>0){
            NotifFail('Dokumen ini tidak bisa diedit, sudah digunakan'); 
			return false();
		}
       var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});   
        $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/OUTMaterial/SimpanMaterialIn",
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
           
        function BackHome(){
        window.location.replace("<?php echo base_url();?>index.php/OUTMaterial/");
        }
             
    
    
$("#HapusDetail").click(function(){
    var DocNumDetailDelete	    = $("#DocNumDetailDelete").val();
    var CanEditDelete         = $("#CanEditDelete").val();
    var QtyMatDelete         = $("#QtyMatDelete").val();
    var QtyPcsDelete         = $("#QtyPcsDelete").val();
    var DocNum_ExtDelete         = $("#DocNum_ExtDelete").val();
    
if(CanEditDelete>0){
NotifFail('Dokumen ini tidak bisa dihapus, sudah digunakan');  return false(); }
$("#myModalDelete").modal('hide');  
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/OUTMaterial/Hapus_Detail",
data	: "&DocNumDetailDelete="+DocNumDetailDelete+"&CanEditDelete="+CanEditDelete+"&QtyMatDelete="+QtyMatDelete+"&QtyPcsDelete="+QtyPcsDelete+"&DocNum_ExtDelete="+DocNum_ExtDelete,
cache	: false,
success	: function(data){
setTimeout(function(){
NotifSuccsess(data); 
$("#DocNum2").click(); $("#DocNum2").focus();
AmbilFormDetail(); Detail_data() ; Detail_data2() ;},300) },
error : function(xhr, teksStatus, kesalahan) {
$("#myModal4").modal('show');
$("#pesan4").text('Server tidak merespon :'+kesalahan); } 	}); return false();	 });
 
$("#Search").click(function(){
 var IDCust2 = $("#IDCust2").val();
 var PartNo2 = $("#PartNo2").val(); 
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = "&IDCust2="+IDCust2+"&tgl1="+tgl1+"&tgl2="+tgl2+"&PartNo2="+PartNo2;
 if(tgl1.length==0){ NotifFail('Tanggal tidak boleh kosong');
 return false(); }
 if(tgl2.length==0){
 NotifFail('Tanggal tidak boleh kosong');
 return false(); }   
 var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 $("#transaction_detail_report").html('');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/OUTMaterial/ReadReport",
 data	: string,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 waitingDialog3.hide();
 $("#transaction_detail_report").html(data);
 },2000) }	 }); return false(); });
    
$("#Print4").click(function(){
 var IDCust2 = $("#IDCust2").val();
 var PartNo2 = $("#PartNo2").val(); 
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = tgl1+"/"+tgl2+"/"+IDCust2+"/"+PartNo2;
 if(tgl1.length == 0){ NotifFail('Tanggal tidak boleh kosong'); return false(); }
 if(tgl2.length == 0){ NotifFail('Tanggal tidak boleh kosong'); return false(); } 
 $("#Print4").button('loading');
 setTimeout(function(){
 $("#Print4").button('reset'); }, 1000);
 window.open('<?php echo site_url();?>/OUTMaterial/PrintList2/'+string , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
 return false();
	});
    
$("#Download").click(function(){
 var IDCust2 = $("#IDCust2").val();
 var PartNo2 = $("#PartNo2").val();
 var tgl1 = $("#tgl1").val();
 var tgl2 = $("#tgl2").val();
 var string = tgl1+"/"+tgl2+"/"+IDCust2+"/"+PartNo2;
 if(tgl1.length == 0){ NotifFail('Tanggal tidak boleh kosong'); return false(); }
 if(tgl2.length == 0){ NotifFail('Tanggal tidak boleh kosong'); return false(); } 
 $("#Download").button('loading');
 setTimeout(function(){
 $("#Download").button('reset'); }, 1000);
 window.open('<?php echo site_url();?>/OUTMaterial/ExportReport/'+string);
 return false(); });
    
    $("#Print").click(function(){
		var kode	= $("#DocNum").val();
		window.open('<?php echo site_url();?>/OUTMaterial/DetailPrint/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
    
        $("#Print2").click(function(){
		var kode	= $("#DocNum2").val();
		window.open('<?php echo site_url();?>/OUTMaterial/DetailPrint/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
    
    $("#Print3").click(function(){
		var kode	= $("#DocNum2").val();
		window.open('<?php echo site_url();?>/OUTMaterial/PrintList/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
		return false();
	});
    

$("#DocNumExt").click(function(){
 var DocNumDetail3 = $("#DocNumDetail3").val();
 if(DocNumDetail3.length==0){
 $("#myModal_MaterialList").modal('show'); $("#Reload2").click();
 return false(); } });
});	
</script>

<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php  $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
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
<?php  $cek = $this->Role_Model->TrcMaterialView(); if(!empty($cek)){ ?>
<div id="tampil_data"></div>
<?php } ?>
</div></div>`

</div>
</div>

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
<div class="col-xs-5">
<input type="text" id="DocNum" name="DocNum"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-3">
<input type="text" id="DocNumDetail" name="DocNumDetail"  class="form-control" readonly="readonly">
</div> </div> 
<div class="form-group">
<label class="col-xs-4 control-label">Balance Material</label>
<div class="col-xs-4">
<input type="text" id="BalMatSourceAf" name="BalMatSourceAf"  class="form-control" readonly="true" value="0">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcsSourceAf" name="BalPcsSourceAf"  class="form-control" readonly="true" value="0">
</div> </div>
<div class="form-group">
<label class="col-xs-4 control-label">Balance Before</label>
<div class="col-xs-4">
<input type="text" id="BalMatBe" name="BalMatBe"  class="form-control" readonly="true" value="0">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcsBe" name="BalPcsBe"  class="form-control" readonly="true" value="0">
</div> </div> 
<div class="form-group">
<label class="col-xs-4 control-label">Balance After</label>
<div class="col-xs-4">
<input type="text" id="BalMatAf" name="BalMatAf"  class="form-control" readonly="true" value="0">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcsAf" name="BalPcsAf"  class="form-control" readonly="true" value="0">
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
<input type="text" id="DocDate" name="DocDate"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">DocNumDetail</label>
<div class="col-xs-4">
<input type="text" id="DocNumDetail3" name="DocNumDetail3"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="CanEdit" name="CanEdit"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">NG Before</label>
<div class="col-xs-8">
<input type="text" id="NGMatBe" name="NGMatBe"  class="form-control" readonly="true" value="0">
</div> </div> 
<div class="form-group">
<label class="col-xs-4 control-label">Qty Pcs</label>
<div class="col-xs-8">
<input type="text" id="QtyPcs" name="QtyPcs"  class="form-control" readonly="true" value="0">
</div> </div>
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
<label class="col-xs-4 control-label">Ref. No</label>
<div class="col-xs-5">
<input type="text" id="DocNumExt" name="DocNumExt"  class="form-control" readonly="true">
</div>
<div class="col-xs-3">
<input type="text" id="ItemIDExt" name="ItemIDExt"  class="form-control" readonly="true">
</div></div>
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
<div class="col-xs-4">
<input type="text" id="IDCust" name="IDCust"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="CustName" name="CustName"  class="form-control" readonly="readonly">
</div> </div> 
</div> 

<div class="col-md-6">
    <div class="form-group">
<label class="col-xs-4 control-label">PCS/sheet</label>
<div class="col-xs-4">
<input type="text" id="PcsPerSheet" name="PcsPerSheet"  class="form-control">
</div>
<div class="col-xs-4">
<input type="text" id="PcsPerKg" name="PcsPerKg"  class="form-control">
</div>
</div>
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
<label class="col-xs-4 control-label">Stock</label>
<div class="col-xs-4">
<input type="text" id="BalMatSource" name="BalMatSource"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcsSource" name="BalPcsSource"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Qty Material</label>
<div class="col-xs-4">
<input type="text" id="QtyMat" name="QtyMat"  class="form-control" value="0" placeholder="Harus di isi">
</div>
<div class="col-xs-4">
<input type="text" id="NGMat" name="NGMat"  class="form-control" value="0" placeholder="NG">
</div></div>
</div>


</div></div></div></div></form>


<div class="box-body panel-footer">

<div class="box-tools pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle"> 
<?php  $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
<button type="button" name="simpan" id="simpan" class="btn btn-warning"><i class="fa fa-save"></i> Save</button>
<button type="button" id="tab_tambah_detail" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-plus"></i>&nbsp; Add</button>
<?php } ?>
<button type="button" name="Print" id="Print" class="btn btn-info"><i class="glyphicon glyphicon-print"></i> Print</button>
<a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
<i class="fa fa-mail-reply"></i> Closed</a>
<?php  $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
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
</div></div></div>
</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="view-tab">


<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php  $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
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
<input type="text" class="form-control" id="DocNum2" name="DocNumSearch" placeholder="Barcode">
<span class="input-group-btn">
</span>
</div></div>

</div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">

<div id="Detail_data2"></div>

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
<input type="text" id="PartNo2" name="PartNo2"  class="form-control" >
</div></div>

</div></div>
</div></div></div>

</form>


</div>

<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<button type="button" name="Search" id="Search" class="btn btn-success"><i class="fa fa-search"></i> Search</button>
<button type="button" class="btn btn-info" id="Download" name="Download" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="glyphicon glyphicon-import"></i>&nbsp; Download</button>
<button type="button" class="btn btn-warning" id="Print4" name="Print4" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>         
<a href="#tab_content1" id="Home4" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-primary">
<i class="fa fa-reply"></i> Closed</a>
<?php  $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
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
 <input hidden="true" type="text" id="QtyMatDelete" name="QtyMatDelete" readonly="true" >
 <input hidden="true" type="text" id="QtyPcsDelete" name="QtyPcsDelete" readonly="true" >
 <input hidden="true" type="text" id="DocNum_ExtDelete" name="DocNum_ExtDelete" readonly="true" >
 <input type="text" id="DocNumDetailDelete" name="DocNumDetailDelete" class="form-control" readonly="true" ></div>
 </form>
 </div>
 </div></div></div></div></div>

<div class="modal fade" id="myModalDelete2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">Info</h4></div><div class="modal-body"><div>
                        
<div id="pesan2"></div>
<div style="font-size: larger; font-weight: bold;" id="PartNoDelete2"></div>
<br /><br /><br />
<div class="panel-footer">
<button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Closed</button>
<button type="button" name="HapusDetail2" id="HapusDetail2" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
    
<form class="navbar-right" role="search">
<div class="form-group">
<input type="text" id="DocNumDetailDelete2" name="DocNumDetailDelete2" class="form-control" readonly="true" ></div>
</form></div>
</div></div></div></div></div><!-- /.modal -->

<div class="modal fade" id="myModal_MaterialList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="Reload2" name="Reload2" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Product</button>

</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div id="List_Material"></div>
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
<div class="col-xs-5">
<input type="text" id="DocNum2Search" name="DocNum2Search"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-3">
<input type="text" id="DocNumDetailSearch" name="DocNumDetailSearch"  class="form-control" readonly="readonly">
</div> </div> 
<div class="form-group">
<label class="col-xs-4 control-label">Balance Material</label>
<div class="col-xs-4">
<input type="text" id="BalMatSourceAfSearch" name="BalMatSourceAfSearch"  class="form-control" readonly="true" value="0">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcsSourceAfSearch" name="BalPcsSourceAfSearch"  class="form-control" readonly="true" value="0">
</div> </div>
<div class="form-group">
<label class="col-xs-4 control-label">Balance Before</label>
<div class="col-xs-4">
<input type="text" id="BalMatBeSearch" name="BalMatBeSearch"  class="form-control" readonly="true" value="0">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcsBeSearch" name="BalPcsBeSearch"  class="form-control" readonly="true" value="0">
</div> </div> 
<div class="form-group">
<label class="col-xs-4 control-label">Balance After</label>
<div class="col-xs-4">
<input type="text" id="BalMatAfSearch" name="BalMatAfSearch"  class="form-control" readonly="true" value="0">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcsAfSearch" name="BalPcsAfSearch"  class="form-control" readonly="true" value="0">
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
<input type="text" id="CreateDate" name="CreateDate"  class="form-control" readonly="readonly">
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
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">DocNumDetail</label>
<div class="col-xs-4">
<input type="text" id="DocNumDetail3Search" name="DocNumDetail3Search"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="CanEditSearch" name="CanEditSearch"  class="form-control" readonly="readonly">
</div></div>
<div class="form-group">
<label class="col-xs-4 control-label">NG Before</label>
<div class="col-xs-8">
<input type="text" id="NGMatBeSearch" name="NGMatBeSearch"  class="form-control" readonly="true" value="0">
</div> </div> 
<div class="form-group">
<label class="col-xs-4 control-label">Qty Pcs</label>
<div class="col-xs-8">
<input type="text" id="QtyPcsSearch" name="QtyPcsSearch"  class="form-control" readonly="true" value="0">
</div> </div>
</div>
</div></div></div></div>

<div class="panel-group" id="accordion">
<div class="panel panel-success">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#productSearch"><span class="glyphicon ">
</span> Data Product &nbsp; 
<span style="float: right;"><i class="glyphicon glyphicon-tasks"></i></span></a></h4></div>
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
<label class="col-xs-4 control-label">Ref. No</label>
<div class="col-xs-5">
<input type="text" id="DocNumExtSearch" name="DocNumExtSearch"  class="form-control" readonly="true">
</div>
<div class="col-xs-3">
<input type="text" id="ItemIDExtSearch" name="ItemIDExtSearch"  class="form-control" readonly="true">
</div></div>
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
<label class="col-xs-4 control-label">ID Customer</label>
<div class="col-xs-4">
<input type="text" id="IDCustSearch" name="IDCustSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="CustNameSearch" name="CustNameSearch"  class="form-control" readonly="readonly">
</div> </div> 
</div> 

<div class="col-md-6">
    <div class="form-group">
<label class="col-xs-4 control-label">PCS/sheet</label>
<div class="col-xs-4">
<input type="text" id="PcsPerSheetSearch" name="PcsPerSheetSearch"  class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="PcsPerKgSearch" name="PcsPerKgSearch"  class="form-control" readonly="true">
</div>
</div>
 <div class="form-group">
<label class="col-xs-4 control-label">Spec</label>
<div class="col-xs-4">
<input type="text" id="Spec1Search" name="SpecSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="Spec2Search" name="SpecSearch"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Stock</label>
<div class="col-xs-4">
<input type="text" id="BalMatSourceSearch" name="BalMatSourceSearch"  class="form-control" readonly="readonly">
</div>
<div class="col-xs-4">
<input type="text" id="BalPcsSourceSearch" name="BalPcsSourceSearch"  class="form-control" readonly="readonly">
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Qty Material</label>
<div class="col-xs-4">
<input type="text" id="QtyMatSearch" name="QtyMatSearch"  class="form-control" value="0" placeholder="Harus di isi" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="NGMatSearch" name="NGMatSearch"  class="form-control" value="0" placeholder="NG" readonly="true">
</div></div>
</div>


</div></div></div></div></form>

    <div class="panel-footer">
    <?php  $cek = $this->Role_Model->TrcMaterialUp(); if(!empty($cek)){ ?>
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
			return false();
    }
</script>


<script type="text/javascript"> 
function PilihEdit(id){
 $("#DocNumDetail2").val(id);
 setTimeout(function(){
 $("#DocNumDetail2").focus();
 $("#DocNumDetail2").click();
 waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
 setTimeout(function(){
 $("#DocNumDetail2").focus();
 $("#DocNumDetail2").click();
 },300) ;
 },500) 
 return false(); }
</script>
<script type="text/javascript"> 
function PilihHapus(DocNumDetail,PartNo,QtyMat,QtyPcs,BalMatSource,BalPcsSource,CanEditDelete,DocNum_Ext){
var BalMatSourceX = parseFloat(QtyMat) + parseFloat(BalMatSource) ;
var BalPcsSourceX = parseFloat(QtyPcs) + parseFloat(BalPcsSource) ;
$("#myModalDelete").modal('show');
$("#DocNumDetailDelete").val(DocNumDetail);
$("#CanEditDelete").val(CanEditDelete);
$("#QtyMatDelete").val(BalMatSourceX);
$("#QtyPcsDelete").val(BalPcsSourceX);
$("#DocNum_ExtDelete").val(DocNum_Ext);
$("#pesan").text("Anda yakin menghapus bro ?");
$("#PartNoDelete").text(PartNo);  };
</script>
 
<script type="text/javascript">
function pilih2(id){
$("#myModal_MaterialList").modal("hide");
$("#DocNumExt").val(id);
$("#DocNumExt").focus(); }
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

<script> $(function () { $("#t_list_master").DataTable(); });</script>