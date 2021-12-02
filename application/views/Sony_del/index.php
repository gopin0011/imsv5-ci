<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script>
    $(document).ready(function(){

        ion.sound({
            sounds: [
                {name: "metal_plate"},
                {name: "bell_ring"},
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

$("#print_list").click(function(){
var kode	= $("#DocNumView").val();
window.open('<?php echo site_url();?>/Sony_del/print_list/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
return false(); });

$("#print_list2").click(function(){
var kode	= $("#DocNum").val();
window.open('<?php echo site_url();?>/Sony_del/print_list/'+kode , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
return false(); });


$("#RefNum").keyup(function(event){
var RefNum = $("#RefNum").val();
if(event.keyCode == 13){
if(RefNum.length>=10){
$("#RefNum_D").focus();
ion.sound.play("water_droplet");
}else{
NotifFail('Barcode Invalid !!!'); 
ion.sound.play("metal_plate");
$("#RefNum").val("");
return false(); }
} });

$("#RefNumReport").keyup(function(event){
var RefNumReport = $("#RefNumReport").val();
if(event.keyCode == 13){
$("#Search").click();
} });
    
$("#RefNum_D").keyup(function(event){
var RefNum_D = $("#RefNum_D").val();
var RefNum = $("#RefNum").val();
if(event.keyCode == 13){
if(RefNum_D.length>=10){
if(RefNum_D!=RefNum){
$("#Save").click();
}else{
NotifFail('Barcode Invalid !!!'); 
ion.sound.play("metal_plate");
$("#RefNum_D").val("");
return false(); }    
}else{
if(RefNum_D!=RefNum){
$("#Save").click();
}else{
NotifFail('Barcode Invalid !!!'); 
ion.sound.play("metal_plate");
$("#RefNum_D").val("");
return false(); }     
} } });
    
$("#RefNum").focus(function(){ tampil_data_detail(); });
    
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
       AmbilForm(); 
       $("#RefNum").focus();
	$("#RefNum").click();
   }, 500);
});
    
function AmbilForm(){
		var kode = "";
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Sony_del/RegDocNumSony_Head",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
			     
                $("#DocNum").val(data.DocNum);
                $("#DocNumDetail").val(data.DocNumDetail); 
                $("#DocDate").val(data.DocDate);
                
                $("#RefNum").val("");
                $("#RefNum_D").val("");
                $("#ShiftID").val("");
                $("#PartNo").val("");
                $("#PartName").val("");
                $("#Qty_2").val("4"); 
                $("#QCCheckID").val("");                                                                               
                
                setTimeout(function(){
        tampil_data_detail();
        },300) ;
                
                }  });  };
                
function AmbilFormDetail(){
		var kode = $("#DocNum").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Sony_del/RegDocNumSony_Detail",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
                $("#DocNumDetail").val(data.DocNumDetail);
                $("#Qty_2").val("4");  
                
                }  });  };
                
function AmbilFormAdd(){
		var id = $("#DocNum").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Sony_del/RegDocNumSony_Add",
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
url		: "<?php echo site_url(); ?>/Sony_del/transaction_list",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#transaction_list").html(data);	} }); };

function tampil_data_detail(){
var id = $("#DocNum").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Sony_del/transaction_detail",
data	: "id="+id,
cache	: false,
success	: function(data){
$("#transaction_detail").html(data);	} }); };


$("#DocNumView").click(function(){
    tampil_data_detail_2();
    });
$("#DocNumView").keyup(function(){
    tampil_data_detail_2();
    });
$("#DocNumView").keydown(function(){
    tampil_data_detail_2();
    });
    $("#DocNumView").focus(function(){
    tampil_data_detail_2();
    });
function tampil_data_detail_2(){
var id = $("#DocNumView").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Sony_del/transaction_detail_2",
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

function textAreaAdjust2() {
style.height = "5px";
style.height = (22+scrollHeight)+"px"; };

$("#Save").click(function(){
var DocNum 	    = $("#DocNum").val();
var DocNumDetail = $("#DocNumDetail").val();
var SysID 	    = $("#SysID").val();
var DocDate = $("#DocDate").val();
var QCCheckID = $("#QCCheckID").val();
var RefNum = $("#RefNum").val();
var RefNum_D = $("#RefNum_D").val();
var ShiftID = $("#ShiftID").val();


if(DocNum.length==0){
NotifFail('Silahkan Log out dan coba lagi !!!');
ion.sound.play("metal_plate");
return false();	}

if(DocNumDetail.length==0){
NotifFail('Silahkan Log out dan coba lagi !!!');
ion.sound.play("metal_plate");
return false();	}
		
if(SysID.length==0){
NotifFail('Part No Harus di isi !!!');
ion.sound.play("metal_plate");
return false();	}
if(QCCheckID.length==0){
NotifFail('QC Check harus di isi !!!');
ion.sound.play("metal_plate");
return false();	}
if(DocDate.length==0){
NotifFail('Doc Date harus di isi !!!');
ion.sound.play("metal_plate");
return false();	}
if(ShiftID.length==0){
NotifFail('Shift harus di isi !!!');
ion.sound.play("metal_plate");
return false();	}

if(RefNum.length<10){
$("#RefNum").val(""); $("#RefNum").focus();
NotifFail('Barcode A Invalid !!!');
ion.sound.play("metal_plate");
return false();	
}

if(RefNum_D.length<10){
NotifFail('Barcode B Invalid !!!');
$("#RefNum_D").val(""); $("#RefNum_D").focus();
ion.sound.play("metal_plate");
return false();	}


$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/Sony_del/Save",
data	: "&DocNum="+DocNum+"&DocNumDetail="+DocNumDetail+"&SysID="+SysID+"&DocDate="+DocDate+"&QCCheckID="+QCCheckID+"&RefNum="+RefNum+"&ShiftID="+ShiftID+"&RefNum_D="+RefNum_D,
cache	: false,
success	: function(data){
setTimeout(function(){
NotifSuccsess(data);
tampil_data_detail();
$("#RefNum").val("") ;
$("#RefNum_D").val("");
AmbilFormDetail();
$("#RefNum").focus() ;	},200) },

error : function(xhr, teksStatus, kesalahan) {
NotifFail('Server tidak merespon :'+kesalahan);	}		
}); return false();		});

    
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
      
      
      $("#SysID").change(function(e){
		var isi = $(e.target).val();
        CariProfilProduct();
	});
	
	function CariProfilProduct(){
		var kode = $("#SysID").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Sony_del/InfoMaterial_product",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
                $("#PartName").val(data.PartName);
                $("#Qty_2").val("4"); 
                $("#RefNum").focus();
                            
			 }  });  };
             
             
             
$("#HapusDetail").click(function(){
		var DocNumDetailDelete	    = $("#DocNumDetailDelete").val();
        var RefNumDelete	    = $("#RefNumDelete").val();

        $("#myModalDelete").modal('hide');  
		
	
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Sony_del/Hapus_Detail",
			data	: "&DocNumDetailDelete="+DocNumDetailDelete+"&RefNumDelete="+RefNumDelete,
			cache	: false,
			success	: function(data){
            setTimeout(function(){
            NotifFail(data); 
             $("#RefNum").click(); $("#RefNum").focus();  $("#RefNum").val("");
             AmbilFormDetail(); tampil_data_detail() ;
            },300)
			},
			error : function(xhr, teksStatus, kesalahan) {
				$("#myModal4").modal('show');
                 $("#pesan4").text('Server tidak merespon :'+kesalahan);
			}
		});
		return false();		
	});
    
 $("#HapusDetail2").click(function(){
		var DocNumDetailDelete	    = $("#DocNumDetailDelete2").val();
        var RefNumDelete	    = $("#RefNumDelete2").val();

        $("#myModalDelete2").modal('hide');  
		
	
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Sony_del/Hapus_Detail",
			data	: "&DocNumDetailDelete="+DocNumDetailDelete+"&RefNumDelete="+RefNumDelete,
			cache	: false,
			success	: function(data){
            setTimeout(function(){
            NotifFail(data); 
             $("#DocNumView").click(); $("#DocNumView").focus(); 
             tampil_data_detail_2() ;
            },300)
			},
			error : function(xhr, teksStatus, kesalahan) {
				$("#myModal4").modal('show');
                 $("#pesan4").text('Server tidak merespon :'+kesalahan);
			}
		});
		return false();		
	});
    
    
    $("#export_list").click(function(){
        var DocNum = $("#DocNum").val();
		var string = DocNum+"/"+DocNum ;
		window.open('<?php echo site_url();?>/Sony_del/export_list/'+string);
		return false();	
	});
    
    $("#export_list2").click(function(){
        var DocNum = $("#DocNumView").val();
		var string = DocNum+"/"+DocNum ;
		window.open('<?php echo site_url();?>/Sony_del/export_list/'+string);
		return false();	
	});
    
    
$("#export_list3").click(function(){
       var ShiftIDReport = $("#ShiftIDReport").val();
		var RefNumReport= $("#RefNumReport").val();
		var DocDateReport_1 = $("#DocDateReport_1").val();
		var DocDateReport_2 = $("#DocDateReport_2").val();
			
		var string = DocDateReport_1+"/"+DocDateReport_2+"/"+ShiftIDReport+"/"+RefNumReport;
        
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
         if(DocDateReport_2<DocDateReport_1){
           $("#myModal4").modal('show');
           $("#pesan4").text('Check tanggal !!!');
		   return false();
         }
         
		window.open('<?php echo site_url();?>/Sony_del/export_list_report/'+string);
		return false();	
	});
       
$("#print_list3").click(function(){
var ShiftIDReport = $("#ShiftIDReport").val();
		var RefNumReport= $("#RefNumReport").val();
		var DocDateReport_1 = $("#DocDateReport_1").val();
		var DocDateReport_2 = $("#DocDateReport_2").val();
        
        var string = DocDateReport_1+"/"+DocDateReport_2+"/"+ShiftIDReport+"/"+RefNumReport;
        
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
         if(DocDateReport_2<DocDateReport_1){
           $("#myModal4").modal('show');
           $("#pesan4").text('Check tanggal !!!');
		   return false();
         }
         
window.open('<?php echo site_url();?>/Sony_del/print_list_report/'+string , 'myWindow', 
'status = 1, height = 650, width = 1100, resizable = 0, toolbar=no, location=no, status=no&#39, menubar=no, address bar=no' );
return false(); });    
    
    $("#Search").click(function(){
		var ShiftIDReport = $("#ShiftIDReport").val();
		var RefNumReport= $("#RefNumReport").val();
		var DocDateReport_1 = $("#DocDateReport_1").val();
		var DocDateReport_2 = $("#DocDateReport_2").val();
			
		var string = "&ShiftIDReport="+ShiftIDReport+"&DocDateReport_1="+DocDateReport_1+"&DocDateReport_2="+DocDateReport_2+"&RefNumReport="+RefNumReport;
		
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
         if(DocDateReport_2<DocDateReport_1){
           $("#myModal4").modal('show');
           $("#pesan4").text('Check tanggal !!!');
		   return false();
         }
   
         var win = waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
		 $("#detail_report").html('');
		 $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/Sony_del/ReadReport",
			data	: string,
			cache	: false,
			success	: function(data){
				setTimeout(function(){
					 waitingDialog3.hide();
					$("#transaction_detail_report").html(data);
				},1000)
			}		
		});
		return false();	
	});
    
             
    
});	
</script>
<div class="content-wrapper">

<div id="myTabContent" class="tab-content">
<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

<div class="row">
<section class="col-lg-12 ">
<div class="box box-success">
<div class="box-header">
<i class="fa fa-files-o"></i>
<h3 class="box-title">Transaction List</h3>

<div class="box-tools pull-right" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<?php $cek = $this->Role_Model->TrcSonyUp(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa  fa-plus"></i>&nbsp; New</a><?php } ?>

<a href="#tab_content4" role="tab" id="report-tab" data-toggle="tab" aria-expanded="false" class="btn btn-info">
<i class="fa fa-file-o"></i>&nbsp; Record</a>

<button type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>

</div></div>

</div></div></section></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<?php $cek = $this->Role_Model->TrcSonyView(); if(!empty($cek)){ ?>
<div id="transaction_list"></div>
<?php } ?>
</div></div>`

</div>
</div>

<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="form-tab">


<div class="row">
<section class="col-lg-12 ">
<div class="box box-success">
<div class="box-header">             
<i class="fa fa-files-o"></i>
<h3 class="box-title">Form</h3>
  
<div class="box-tools pull-right" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">    

<button type="button" id="Save" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa  fa-save"></i>&nbsp; Save</button>

<button type="button" name="print_list2" id="print_list2" class="btn btn-info"><i class="glyphicon glyphicon-print"></i>&nbsp; Print</button>
<button type="button" name="export_list" id="export_list" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp; Download</button>

<button type="button" id="Add" class="btn btn-warning" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-plus"></i>&nbsp; New</button>

<a href="#tab_content1" role="tab" id="Home"  data-toggle="tab" aria-expanded="false" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-reply"></i>&nbsp; Closed</a>



</div></div>

</div></div></section></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<form class="form-horizontal" name="form_id" id="form_id">

<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">Barcode A</label>
<div class="col-xs-8">
<input type="text" id="RefNum" name="RefNum" class="form-control" required="true">
</div>
</div>
<div class="form-group">
<label class="col-xs-4 control-label">Barcode B</label>
<div class="col-xs-8">
<input type="text" id="RefNum_D" name="RefNum_D" class="form-control" required="true">
</div>
</div>


<div class="form-group">
<label class="col-xs-4 control-label">Checked By</label>
<div class="col-xs-8">
<select id="QCCheckID" name="QCCheckID" class="form-control" style="width: 100%;">
<?php if(empty($QCCheck)){ ?>
<option value="">QC Check</option>
<?php } foreach($M_QCCheck->result() as $t){ if($QCCheck==$t->QCCheck){ ?>
<option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->QCCheck;?></option>
<?php }else { ?>
<option value="<?php echo $t->SysID;?>"><?php echo $t->QCCheck;?></option>
<?php } } ?>  
</select>
</div></div>
              

<div class="form-group">
<label class="col-lg-4 control-label">Shift</label>
<div class="col-lg-8">
<select name="ShiftID" id="ShiftID" class="form-control">
<?php if(empty($Shift)){ ?>
<option value="">Select</option>
<?php } foreach($M_Shift->result() as $t){ if($Shift==$t->SysID){ ?>
<option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->SysID;?> - <?php echo $t->Shift;?></option>
<?php }else { ?>
<option value="<?php echo $t->SysID;?>"><?php echo $t->SysID;?> - <?php echo $t->Shift;?></option>
<?php } } ?>  </select> </div> 
</div>
             

</div>

<div class="col-md-6">

<div class="form-group">
<label class="col-xs-4 control-label">Doc Num</label>
<div class="col-xs-4">
<input type="text" id="DocNum" name="DocNum" class="form-control" readonly="true">
</div>
<div class="col-xs-4">
<input type="text" id="DocNumDetail" name="DocNumDetail" class="form-control" readonly="true">
</div>
</div>

<div class="form-group">
<label class="col-xs-4 control-label">Part No</label>
<div class="col-xs-8">
<select id="SysID" name="SysID" class="form-control" style="width: 100%;">
<?php if(empty($SysID)){ ?>
<option value="">Part No</option>
<?php } foreach($MListProduct->result() as $t){ if($MListProduct==$t->PartNo){ ?>
<option value="<?php echo $t->SysID2;?>" selected="selected"><?php echo $t->PartNo;?></option>
<?php }else { ?>
<option value="<?php echo $t->SysID2;?>"><?php echo $t->PartNo;?></option>
<?php } } ?>  
</select>
</div></div>

<div class="form-group">
<label class="col-xs-4 control-label">Part Name</label>
<div class="col-xs-8">
<input type="text" id="PartName" name="PartName" class="form-control" readonly="true" required="">
</div>
</div>

<div class="form-group">
<label class="col-xs-4 control-label">Doc Date</label>
<div class="col-xs-8">
<div class="input-group date">
<div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
</div>
<input type="text" class="form-control pull-right" value="<?php echo $DocDateReport_2 ; ?>" id="DocDate" name="DocDate" readonly="">
</div>
                
</div>
</div>

</div>



</form>

</div></div>

</div>

<div class="box-body">
<div class="box">
<div class="box-body">

<div id="transaction_detail"></div>

</div></div>`

</div>

</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="view-tab">


<div class="row">
<section class="col-lg-12 ">
<div class="box box-success">
<div class="box-header">             
<i class="fa fa-files-o"></i>
<h3 class="box-title">Detail Transaction</h3>
  
<div class="box-tools pull-right" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">    

<div hidden="">
<input type="text" id="DocNumView" name="DocNumView" class="form-control">
</div>

<button type="button" name="print_list" id="print_list" class="btn btn-info"><i class="glyphicon glyphicon-print"></i> Print</button>
<button type="button" name="export_list2" id="export_list2" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp; Download</button>
<a href="#tab_content2" role="tab" id="Add_2" data-toggle="tab" aria-expanded="false" class="btn btn-warning">
<i class="fa fa-plus"></i>&nbsp; Add</a>

<a href="#tab_content1" role="tab" id="Home2"  data-toggle="tab" aria-expanded="false" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-reply"></i>&nbsp; Closed</a>




</div></div>

</div></div></section></div>

<div class="box-body">
<div class="box">
<div class="box-body">

<div id="transaction_detail_2"></div>

</div></div>`

</div>

</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="report-tab">

<div class="row">
<section class="col-lg-12 ">
<div class="box box-success">
<div class="box-header">             
<i class="fa fa-files-o"></i>
<h3 class="box-title">Record</h3>
  
<div class="box-tools pull-right" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">    

<button type="button" name="Search" id="Search" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
<button type="button" name="print_list3" id="print_list3" class="btn btn-info"><i class="fa fa-print"></i>&nbsp; Print</button>
<button type="button" name="export_list3" id="export_list3" class="btn btn-primary"><i class="fa fa-file-excel-o"></i>&nbsp; Download</button>

<a href="#tab_content1" role="tab" id="Home3"  data-toggle="tab" aria-expanded="false" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-reply"></i>&nbsp; Closed</a>




</div></div>

</div></div></section></div>

<div class="box-body">
<div class="box">
<div class="box-body">

<form class="form-horizontal" name="form_id" id="form_id">

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
</div>

<div class="col-md-6">

<div class="form-group">
<label class="col-lg-4 control-label">Shift</label>
<div class="col-lg-8">
<select name="ShiftIDReport" id="ShiftIDReport" class="form-control">
<?php if(empty($Shift)){ ?>
<option value="ALL">All</option>
<?php } foreach($M_Shift->result() as $t){ if($Shift==$t->SysID){ ?>
<option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->SysID;?> - <?php echo $t->Shift;?></option>
<?php }else { ?>
<option value="<?php echo $t->SysID;?>"><?php echo $t->SysID;?> - <?php echo $t->Shift;?></option>
<?php } } ?>  </select> </div> 
</div>

<div class="form-group">
<label class="col-xs-4 control-label">Ref. No</label>
<div class="col-xs-8">
<input type="text" id="RefNumReport" name="RefNumReport" class="form-control" required="true">
</div>
</div>

</div>


</form>
</div></div></div>

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
    <input type="text" id="DocNumDetailDelete" name="DocNumDetailDelete" class="form-control" readonly="true" ></div>
     <div hidden="">
    <input type="text" id="RefNumDelete" name="RefNumDelete" class="form-control" readonly="true" ></div>
    </form>
    </form>
    
    </div>
    
    
</div></div></div></div></div><!-- /.modal -->

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
    <div hidden="">
    <input type="text" id="RefNumDelete2" name="RefNumDelete2" class="form-control" readonly="true" ></div>
    </form>
    
    </div>
    
    
</div></div></div></div></div><!-- /.modal -->




<script>
  $(function () {
    //Initialize Select2 Elements
    $("#QCCheckID").select2();
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