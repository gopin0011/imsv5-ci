<link href='<?php echo base_url();?>/assets/plugins/dragula/dragula.css' rel='stylesheet' type='text/css' />
<link href='<?php echo base_url();?>/assets/plugins/dragula/example.css' rel='stylesheet' type='text/css' />
<style>
/*!
 * Start Bootstrap - Simple Sidebar (http://startbootstrap.com/)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */

 body {
    overflow-x: hidden;
 }

/* Toggle Styles */

#wrapper {
    padding-left: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled {
    padding-left: 300px;
}

#sidebar-wrapper {
    z-index: 1000;    
    left: 300px;
    width: 0;
    height: 100%;
    margin-left: -300px;
    overflow-y: auto;
    background: #000;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled #sidebar-wrapper {
    width: 300px;
}

#page-content-wrapper {
    width: 100%;
    position: absolute;
    padding: 15px;
}

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-right: -300px;
}

/* Sidebar Styles */

.sidebar-nav {
    position: absolute;
    width: 300px;
    margin: 0;
    padding: 0;
    list-style: none;
}

.sidebar-nav li {
    text-indent: 20px;
    line-height: 40px;
}

.sidebar-nav li a {
    display: block;
    text-decoration: none;
    color: #999999;
}

.sidebar-nav li a:hover {
    text-decoration: none;
    color: #fff;
    background: rgba(255,255,255,0.2);
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
    text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
    height: 65px;
    font-size: 18px;
    line-height: 60px;
}

.sidebar-nav > .sidebar-brand a {
    color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
    color: #fff;
    background: none;
}

@media(min-width:768px) {
    #wrapper {
        padding-left: 0;
    }

    #wrapper.toggled {
        padding-left: 300px;
    }

    #sidebar-wrapper {
        width: 0;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 300px;
    }

    #page-content-wrapper {
        padding: 20px;
        position: relative;
    }

    #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 0;
    }
}

#Product{
    overflow: auto;
    height: 450px;
}
#Product p {
    margin-left: 5px;
}



</style>
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
var Globals = <?php echo json_encode(array(
                    'site_url' => site_url(),
                    )); 
                      ?>;
$(document).ready(function(){
    /*
    $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/MasterBom/getTemplatesDetail",
        data	: "&id=",
        cache	: false,
        success	: function(data){
            $('#templates_detail').html(data);
        } 
    });
    */
    
 
  
 $("#Home3").click(function() {
 setTimeout(function() {
 $('#CustIDView').click(); }, 200); });
 
  $("#Home4").click(function() {
 setTimeout(function() {
 $('#CustIDView').click(); }, 200); });
    
tampil_data();
function tampil_data(){
var id = $("#CustIDView").val() ;
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterBom/ListProduct",
data	: "&id="+id,
cache	: false,
success	: function(data){
$("#tampil_data").html(data);
} }); };
    
$("#CustIDView").change(function(){
setTimeout(function() { $('#reload').click(); }, 200); });
    
$("#SysIDDetail").focus(function(){ DetailBOM(); });
$("#SysIDDetail").keyup(function(){ DetailBOM(); });
$("#SysIDDetail").keydown(function(){ DetailBOM(); });
$("#SysIDDetail").click(function(){ DetailBOM(); });

function DetailBOM(){
    //$("#Product").html('');
    document.getElementById("FormViewBOM").reset();
    $('#formaddchild').attr("style","display:none;");
var kode = $("#SysIDDetail").val() ;
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterBom/DetailBOM",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#rightside").html(data);
$("#rightside").attr('style','display:;');
waitingDialog3.hide(); } 	}); } ;

$('#reload').on('click', function() {
var $this = $(this);
$this.button('loading');
setTimeout(function() {
$this.button('reset');
tampil_data(); }, 500);
});

function DetailBOM_old(){
var kode = $("#SysIDDetail").val() ;
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterBom/DetailBOM",
data	: "kode="+kode,
cache	: false,
success	: function(data){
$("#DetailBOM").html(data);
waitingDialog3.hide(); } 	}); } ;

$('#reload').on('click', function() {
var $this = $(this);
$this.button('loading');
setTimeout(function() {
$this.button('reset');
tampil_data(); }, 500);
});

$('#reload1').on('click', function(){
var $this = $(this);
$this.button('loading');
setTimeout(function(){
$this.button('reset');
DetailBOM(); }, 500);
});

$('#Home2').click(function(){ $('#reload').click(); });


    
$("#ItemID").focus(function(){ DetailBOM2(); });
$("#ItemID").click(function(){ DetailBOM2();});

/*
$('#MParts').on('change',function(){
    alert('a');
    //editthisBOM2($(this).val(),'search');
 });
*/

$("#MParts").select2({
     ajax: {
        url: '<?php echo site_url();?>/MasterBom/searchkomponen',    
        dataType: 'json',    
        delay: 250,
        processResults: function (data) {
            //console.log(data);
            return {
                results: data
            };
        },
     cache: true
     }
}); 

$("#MParts").on("select2:select", function (e) { editthisBOM2($(this).val(),'search'); });

function DetailBOM2(){
var kode = $("#ItemID").val() ;
if(kode!="")
{
   $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/MasterBom/GetInfoData",
        data	: "kode="+kode,
        cache	: false,
        success	: function(data){
            var d = JSON.parse(data);
            $('#ItemID').val(d.list.SysID);
            $('#ItemNo').val(d.list.ItemNo);
            $('#PartNo').val(d.list.PartNo);
            $('#PartName').val(d.list.PartName);
            $('#NameType').val(d.list.NameType);
            $('#IDCust').val(d.list.IDCust);
            $('#IDProject').val(d.list.IDProject);
            $('#QtyPerCarHead').val(d.list.QtyPerCar);
            $('#FGLocation').val(d.list.FGLocation);
            $('#PackingType').val(d.list.PackingType);
            $('#StdPack').val(d.list.StdPack);
            $('#PartTypeID').val(d.list.PartTypeID);
            $('#SupplierIDHead').val(d.list.SupplierID);
            $('#IsActive').val(d.list.IsActive);
        } 
        
    }); 
}
 };
    
$("#home-tab").click(function(){
waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
setTimeout(function () { tampil_data();
setTimeout(function(){
waitingDialog3.hide();
},200) ; },1000) });	


    
$("#home-tab2").click(function(){
setTimeout(function () { 
tampil_data();
setTimeout(function(){
waitingDialog3.hide(); },200) ; },1000) });		
    
$("#form-tab").click(function(){ document.getElementById("form").reset(); $("#detail").hide(); $("#ItemID").click(); });	
$("#form-tab2").click(function(){ document.getElementById("form").reset(); $("#detail").hide(); $("#ItemID").click(); });
$("#form-tab3").click(function(){ Add_Child(); });
$("#save").click(function(){ RegID_FG();  });  
$("#save2").click(function(){ RegID_Child();  }); 

$("#PartTypeID2").change(function(){  HideDetailSpec(); });

function HideDetailSpec(){
var PartTypeID = $("#PartTypeID2").val();
if(PartTypeID.match('RM')){
$("#detail_spec").show();
$("#ItemNoDetail").val("");
$("#ItemNoDetailSub").val("");
 }else{
    
var kode = $("#ItemID2").val();
var LinkID = $("#LinkID").val();

var ItemNo = $("#ItemNo").val();
var ItemNoDetail = $("#ItemNoDetail").val();
var ItemNoDetailSub = $("#ItemNoDetailSub").val();


$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterBom/InfoTambahChild_add",
data	: "&kode="+kode+"&LinkID="+LinkID+"&ItemNo="+ItemNo+"&ItemNoDetail="+ItemNoDetail+"&ItemNoDetailSub="+ItemNoDetailSub,
cache	: false,
dataType : "json",
success	: function(data){
 $("#detail_spec").hide();
    
$("#ItemNoDetail").val(data.ItemNo);
$("#ItemNoDetailSub").val(data.ItemNoDetailSub);

}  });
    
}
}; 


$("#PartNo2").focus(function(){ 
var PartNo = $("#PartNo").val();  
var PartNo2 = $("#PartNo2").val();  
if(PartNo2.length==0){
$("#PartNo2").val(PartNo); }
});

$("#PartName2").focus(function(){ 
var PartName = $("#PartName").val();  
var PartName2 = $("#PartName2").val();  
if(PartName2.length==0){
$("#PartName2").val(PartName); }
});

function RegID_FG(){
    var kode = $("#ItemID").val();
    var ItemNo = $("#ItemNo").val();
    var NoUrut = $("#NoUrut").val();
    var PartNo = $("#PartNo").val();
    var PartName = $("#PartName").val();
    var IDCust = $("#IDCust").val();
    var IDProject = $("#IDProject").val();
    var PackingType = $("#PackingType").val();
    var StdPack = $("#StdPack").val();
    var PartTypeID = $("#PartTypeID").val();
    var FGLocation = $("#FGLocation").val();
    var QtyPerCarHead = $("#QtyPerCarHead").val();
    var SupplierIDHead = $("#SupplierIDHead").val();
    var IsActive = $("#IsActive").val();
    var NameType = $('#NameType').val();
    
    if(PartNo.length==0){
        $("#myModal4").modal('show');
        $("#pesan4").html('<em><strong>Part No</strong></em> field is required !!!'); 
        return false();
    } 
        if(PartName.length==0){
        $("#myModal4").modal('show');
        $("#pesan4").html('<em><strong>Part Name</strong></em> field is required !!!'); 
        return false();
    } 
    if(IDCust.length==0){
        $("#myModal4").modal('show');
        $("#pesan4").html('<em><strong>Customer</strong></em> field is required !!!'); 
        return false();
    } 
    if(IDProject.length==0){
        $("#myModal4").modal('show');
        $("#pesan4").html('<em><strong>Project</strong></em> field is required !!!'); 
        return false();
    } 
    if(PartTypeID.length==0){
        $("#myModal4").modal('show');
        $("#pesan4").html('<em><strong>Part Type</strong></em> field is required !!!'); 
        return false();
    } 
    
    var string = $('form').serialize();
    setTimeout(function(){
        $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/MasterBom/InfoTambahBOM",
        data	: "&kode="+kode+"&PartNo="+PartNo+"&PartName="+PartName+"&IDCust="+IDCust+"&IDProject="+IDProject+"&PackingType="+PackingType+"&StdPack="+StdPack+"&PartTypeID="+PartTypeID+"&FGLocation="+FGLocation+"&IsActive="+IsActive+"&QtyPerCarHead="+QtyPerCarHead+"&SupplierIDHead="+SupplierIDHead+"&ItemNo="+ItemNo+"&NoUrut="+NoUrut+"&NameType="+NameType,
        cache	: false,
        dataType : "json",
        success	: function(data){
            NotifSuccsess(data.pesan);
            setTimeout(function(){
                //$("#detail").show(); 
                //$("#detail_spec").hide();   
                $('#SysIDDetail').val(data.ItemID);
                DetailBOM();
                //Viewmapping(data.ItemID);
                $('#content11').trigger('click');     
            },1000)
            }  
        });  
    },300);
};

function Viewmapping(LinkID)
{
    var kode = $("#ItemID").val() ;
    $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/MasterBom/ViewMapping",
        data	: "kode="+LinkID,
        cache	: false,
        success	: function(data){
            $("#FormMapping").html(data);
        }
    });
}

function RegID_FG_old(){
var kode = $("#ItemID").val();
var ItemNo = $("#ItemNo").val();
var NoUrut = $("#NoUrut").val();
var PartNo = $("#PartNo").val();
var PartName = $("#PartName").val();
var IDCust = $("#IDCust").val();
var IDProject = $("#IDProject").val();
var PackingType = $("#PackingType").val();
var StdPack = $("#StdPack").val();
var PartTypeID = $("#PartTypeID").val();
var FGLocation = $("#FGLocation").val();
var QtyPerCarHead = $("#QtyPerCarHead").val();
var SupplierIDHead = $("#SupplierIDHead").val();
var IsActive = $("#IsActive").val();

if(PartNo.length==0){
$("#myModal4").modal('show');
$("#pesan4").html('<em><strong>Part No</strong></em> field is required !!!'); 
return false();
} 
if(PartName.length==0){
$("#myModal4").modal('show');
$("#pesan4").html('<em><strong>Part Name</strong></em> field is required !!!'); 
return false();
} 
if(IDCust.length==0){
$("#myModal4").modal('show');
$("#pesan4").html('<em><strong>Customer</strong></em> field is required !!!'); 
return false();
} 
if(IDProject.length==0){
$("#myModal4").modal('show');
$("#pesan4").html('<em><strong>Project</strong></em> field is required !!!'); 
return false();
} 
if(PartTypeID.length==0){
$("#myModal4").modal('show');
$("#pesan4").html('<em><strong>Part Type</strong></em> field is required !!!'); 
return false();
} 
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterBom/InfoTambahBOM",
data	: "&kode="+kode+"&PartNo="+PartNo+"&PartName="+PartName+"&IDCust="+IDCust+"&IDProject="+IDProject+"&PackingType="+PackingType+"&StdPack="+StdPack+"&PartTypeID="+PartTypeID+"&FGLocation="+FGLocation+"&IsActive="+IsActive+"&QtyPerCarHead="+QtyPerCarHead+"&SupplierIDHead="+SupplierIDHead+"&ItemNo="+ItemNo+"&NoUrut="+NoUrut,
cache	: false,
dataType : "json",
success	: function(data){
NotifSuccsess(data.pesan);
setTimeout(function(){
$("#detail").show(); DetailBOM2();
$("#detail_spec").hide();

},1000)
    
$("#ItemID").val(data.ItemID);
$("#ItemNo").val(data.ItemNo);
$("#NoUrut").val(data.NoUrut);
$("#PartNo").val(data.PartNo);
$("#PartName").val(data.PartName);
$("#IDCust").val(data.IDCust);
$("#IDProject").val(data.IDProject);
$("#PackingType").val(data.PackingType);
$("#StdPack").val(data.StdPack);
$("#PartTypeID").val(data.PartTypeID);
$("#FGLocation").val(data.FGLocation);
$("#IsActive").val(data.IsActive);
$("#ItemID2").val(data.ItemID2);
$("#LinkID").val(data.ItemID);
$("#ItemNoDetail").val(data.ItemNo);
$("#ItemNoDetailSub").val(data.ItemNoDetailSub);

 $("#PartNo2").val(""); $("#PartName2").val("");
 
}  });  }; 


function RegID_Child(){
var kode = $("#ItemID2").val();
var ItemNo = $("#ItemNo").val();
var NoUrut = $("#NoUrut").val();
var ItemNoDetail = $("#ItemNoDetail").val();
var ItemNoDetailSub = $("#ItemNoDetailSub").val();
var LinkID = $("#LinkID").val();
var PartNo2 = $("#PartNo2").val();
var PartName2 = $("#PartName2").val();
var PartTypeID2 = $("#PartTypeID2").val();
var PackingTypeDetail = $("#PackingTypeDetail").val();
var StdPackDetail = $("#StdPackDetail").val();
var LevelPart = $("#LevelPart").val();
var QtyCar = $("#QtyCar").val();
var SupplierID = $("#SupplierID").val();

var MaterialType = $("#MaterialType").val();
var IsCommon = $("#IsCommon").val();
var Spec = $("#Spec").val();
var QtyPart = $("#QtyPart").val();
var Ratio = $("#Ratio").val();
var SpecOrder1 = $("#SpecOrder1").val();
var SpecOrder2 = $("#SpecOrder2").val();
var Thick = $("#Thick").val();
var Width = $("#Width").val();
var Length = $("#Length").val();
var PcsPerSheet = $("#PcsPerSheet").val();
var KgPerSheet = $("#KgPerSheet").val();
var PartWeight = $("#PartWeight").val();
var OP5 = $("#OP5").val(); var OP5M = $("#OP5M").val();
var OP10 = $("#OP10").val(); var OP10M = $("#OP10M").val();
var OP40 = $("#OP40").val(); var OP40M = $("#OP40M").val();
var OP20 = $("#OP20").val(); var OP20M = $("#OP20M").val();
var OP50 = $("#OP50").val(); var OP50M = $("#OP50M").val();
var OP30 = $("#OP30").val(); var OP30M = $("#OP30M").val();
var OP60 = $("#OP60").val(); var OP60M = $("#OP60M").val();
var OP70 = $("#OP70").val(); var OP70M = $("#OP70M").val();
var ProcessAssy = $("#ProcessAssy").val(); var ProcessAssyM = $("#ProcessAssyM").val();


if(PartNo2.length==0){
$("#myModal4").modal('show');
$("#pesan4").html('<em><strong>Part No</strong></em> field is required !!!'); 
return false();
} 

if(PartName2.length==0){
$("#myModal4").modal('show');
$("#pesan4").html('<em><strong>Part Name</strong></em> field is required !!!'); 
return false();
} 

$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterBom/InfoTambahChild",
data	: "&kode="+kode+"&PartNo2="+PartNo2+"&PartName2="+PartName2+"&PartTypeID2="+PartTypeID2+"&LevelPart="+LevelPart+"&QtyCar="+QtyCar+"&SupplierID="+SupplierID+"&MaterialType="+MaterialType+"&Spec="+Spec+"&Thick="+Thick+"&Width="+Width+"&Length="+Length+"&PcsPerSheet="+PcsPerSheet+"&KgPerSheet="+KgPerSheet+"&PartWeight="+PartWeight+"&OP5="+OP5+"&OP5M="+OP5M+"&OP10="+OP10+"&OP10M="+OP10M+"&OP40="+OP40+"&OP40M="+OP40M+"&OP20="+OP20+"&OP20M="+OP20M+"&OP50="+OP50+"&OP50M="+OP50M+"&OP30="+OP30+"&OP30M="+OP30M+"&OP60="+OP60+"&OP60M="+OP60M+"&ProcessAssy="+ProcessAssy+"&ProcessAssyM="+ProcessAssyM+"&OP70="+OP70+"&OP70M="+OP70M+"&LinkID="+LinkID+"&PackingTypeDetail="+PackingTypeDetail+"&StdPackDetail="+StdPackDetail+"&ItemNoDetail="+ItemNoDetail+"&ItemNoDetailSub="+ItemNoDetailSub+"&ItemNo="+ItemNo+"&NoUrut="+NoUrut+"&SpecOrder1="+SpecOrder1+"&SpecOrder2="+SpecOrder2+"&IsCommon="+IsCommon+"&QtyPart="+QtyPart+"&Ratio="+Ratio,
cache	: false,
dataType : "json",
success	: function(data){
NotifSuccsess(data.pesan);
setTimeout(function(){
$("#detail").show(); DetailBOM2(); 
},1000)

$("#LinkID").val(data.LinkID);    
$("#ItemID2").val(data.ItemID2);
$("#PartNo2").val(data.PartNo2);
$("#PartName2").val(data.PartName2);
$("#PartTypeID2").val(data.PartTypeID2);
$("#PartLevel").val(data.PartLevel);
$("#QtyCar").val(data.QtyCar);
$("#SupplierID").val(data.SupplierID);
$("#PackingTypeDetail").val(data.PackingTypeDetail);
$("#StdPackDetail").val(data.StdPackDetail);
$("#MaterialType").val(data.MaterialType);
$("#SpecOrder1").val(data.SpecOrder1);
$("#SpecOrder2").val(data.SpecOrder2);
$("#IsCommon").val(data.IsCommon);
$("#QtyPart").val(data.QtyPart);
$("#Ratio").val(data.Ratio);
$("#Spec").val(data.Spec);
$("#Thick").val(data.Thick);
$("#Width").val(data.Width);
$("#Length").val(data.Length);
$("#PcsPerSheet").val(data.PcsPerSheet);
$("#KgPerSheet").val(data.KgPerSheet);
$("#PartWeight").val(data.PartWeight);
$("#OP5").val(data.OP5); $("#OP5M").val(data.OP5M);
$("#OP10").val(data.OP10); $("#OP10M").val(data.OP10M);
$("#OP40").val(data.OP40); $("#OP40M").val(data.OP40M);
$("#OP20").val(data.OP20); $("#OP20M").val(data.OP20M);
$("#OP50").val(data.OP50); $("#OP50M").val(data.OP50M);
$("#OP30").val(data.OP30); $("#OP30M").val(data.OP30M);
$("#OP60").val(data.OP60); $("#OP60M").val(data.OP60M);
$("#ProcessAssy").val(data.ProcessAssy); $("#ProcessAssyM").val(data.ProcessAssyM);
$("#OP70").val(data.OP70); $("#OP70M").val(data.OP70M);
$("#ItemNoDetail").val(data.ItemNo);
$("#ItemNoDetailSub").val(data.ItemNoDetailSub);
$("#NoUrut").val(data.NoUrut)

}  });  }; 

function Add_Child_old(){
var kode = $("#ItemID2").val();
var LinkID = $("#LinkID").val();

var ItemNo = $("#ItemNo").val();
var NoUrut = $("#NoUrut").val();
var ItemNoDetail = $("#ItemNoDetail").val();
var ItemNoDetailSub = $("#ItemNoDetailSub").val();

$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterBom/InfoTambahChild_add",
data	: "&kode="+kode+"&LinkID="+LinkID+"&ItemNo="+ItemNo+"&ItemNoDetail="+ItemNoDetail+"&ItemNoDetailSub="+ItemNoDetailSub,
cache	: false,
dataType : "json",
success	: function(data){
NotifSuccsess(data.pesan);
setTimeout(function(){
$("#detail").show(); DetailBOM2();
},1000)

$("#LinkID").val(data.LinkID);  
$("#MaterialType").val("0");   
$("#ItemID2").val(data.ItemID2); $("#PartNo2").val(""); $("#PartName2").val("");
$("#PartTypeID2").val(""); $("#PartLevel").val(""); $("#QtyCar").val(""); $("#SupplierID").val("");
$("#PackingTypeDetail").val("");
$("#StdPackDetail").val("");  $("#SpecOrder1").val(""); $("#SpecOrder2").val(""); $("#IsCommon").val("0");
 $("#Spec").val(""); $("#Thick").val(""); $("#Width").val("");
$("#Length").val(""); $("#PcsPerSheet").val(""); $("#KgPerSheet").val(""); $("#PartWeight").val("");
$("#OP5").val(""); $("#OP5M").val("0");
$("#OP10").val(""); $("#OP10M").val("0"); $("#OP40").val(""); $("#OP40M").val("0"); $("#OP20").val(""); 
$("#OP20M").val("0"); $("#OP50").val(""); $("#OP50M").val("0"); $("#OP30").val("");  $("#OP30M").val("0");
$("#OP60").val(""); $("#OP60M").val("0"); $("#ProcessAssy").val(""); $("#ProcessAssyM").val("0");
$("#OP70").val(""); $("#OP70M").val("0");$("#QtyPart").val("1");$("#Ratio").val("1");

$("#NoUrut").val(data.NoUrut);
$("#ItemNoDetail").val(data.ItemNo);
$("#ItemNoDetailSub").val(data.ItemNoDetailSub);

}  });  }; 


    
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
          
$('#BAddBack').click(function(){
	var i = 500;
    setTimeout(function(){
		$('#formaddchild').attr("style","display:none;");
        DetailBOM();
		i += 500;
    },i);
    /*
    var kode = $("#SysIDDetail").val() ;
    $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/MasterBom/DetailBOM",
        data	: "kode="+kode,
        cache	: false,
        success	: function(data){
            $('#rightside').attr('style','display:none');
            $("#rightside").html(data);
            //waitingDialog3.hide();
            setTimeout(function(){
                $('#rightside').attr('style','display:');
            },300);
        }
    });
    */
});

$('#simpan2').click(function(){
	$('#BAddBack').button('loading');
    var kode = $("#SysIDDetail").val();
    var ItemID = $('#ItemIDSys2').val();
    var ItemNo = $("#ItemNo").val();
    var NoUrut = $("#NoUrut").val();
    var ItemNoDetail = $("#ItemNoDetail").val();
    var ItemNoDetailSub = $("#ItemNoDetailSub").val();
    //var LinkID = $("#LinkID").val();
    var LinkID = kode;
    var PartNo2 = $("#PartNo2").val();
    var PartNo3 = $("#PartNo3").val();
    var IsRHLH = $("#IsRHLH").val();
    var PartName2 = $("#PartName2").val();
    var PartTypeID2 = $("#PartTypeID2").val();
    var PackingTypeDetail = $("#PackingTypeDetail").val();
    var StdPackDetail = $("#StdPackDetail").val();
    var LevelPart = $("#LevelPart").val();
    var QtyCar = $("#QtyCar").val();
    var SupplierID = $("#SupplierID").val();
    
    var MaterialType = $("#MaterialType").val();
    var IsCommon = $("#IsCommon").val();
    var Spec = $("#Spec").val();
    var QtyPart = $("#QtyPart").val();
    var Ratio = $("#Ratio").val();
    var SpecOrder1 = $("#SpecOrder1").val();
    var SpecOrder2 = $("#SpecOrder2").val();
    var Thick = $("#Thick").val();
    var Width = $("#Width").val();
    var Length = $("#Length").val();
    var PcsPerSheet = $("#PcsPerSheet").val();
    var KgPerSheet = $("#KgPerSheet").val();
    var PartWeight = $("#PartWeight").val();
    var OP5 = $("#OP5").val(); var OP5M = $("#OP5M").val();
    var OP10 = $("#OP10").val(); var OP10M = $("#OP10M").val();
    var OP40 = $("#OP40").val(); var OP40M = $("#OP40M").val();
    var OP20 = $("#OP20").val(); var OP20M = $("#OP20M").val();
    var OP50 = $("#OP50").val(); var OP50M = $("#OP50M").val();
    var OP30 = $("#OP30").val(); var OP30M = $("#OP30M").val();
    var OP60 = $("#OP60").val(); var OP60M = $("#OP60M").val();
    var OP70 = $("#OP70").val(); var OP70M = $("#OP70M").val();
    var ProcessAssy = $("#ProcessAssy").val(); var ProcessAssyM = $("#ProcessAssyM").val();
    
    var PartRM = $('#PartRM').val();
    if(PartNo2.length==0){
        $("#myModal4").modal('show');
        $("#pesan4").html('<em><strong>Part No</strong></em> field is required !!!'); 
        return false();
    } 
    
    if(LevelPart.length==0)
    {
        NotifFail("Level Part Belum di Pilih");
        return false();
    }
    
    if(PartName2.length==0){
        $("#myModal4").modal('show');
        $("#pesan4").html('<em><strong>Part Name</strong></em> field is required !!!'); 
        return false();
    } 
    
    if(IsRHLH == 1 && PartNo3.length==0)
    {
        $("#myModal4").modal('show');
        $("#pesan4").html('<em><strong>Part No 2</strong></em> field is required !!!'); 
        return false();
    }
    
    /*
    if(PartRM == null && PartTypeID2.indexOf('PC')>=0)
    {
        NotifFail('PartType PC Part RM Harus Terisi');
        return false();
    }
    */
    
    if(PartTypeID2.indexOf('RM')>=0) PartRM = null;
    
    $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/MasterBom/InfoTambahChild",
        data	: "&ItemID="+ItemID+"&kode="+kode+"&PartNo2="+PartNo2+"&PartName2="+PartName2+"&PartNo3="+PartNo3+"&IsRHLH="+IsRHLH+"&PartTypeID2="+PartTypeID2+"&LevelPart="+LevelPart+"&QtyCar="+QtyCar+"&SupplierID="+SupplierID+"&MaterialType="+MaterialType+"&Spec="+Spec+"&Thick="+Thick+"&Width="+Width+"&Length="+Length+"&PcsPerSheet="+PcsPerSheet+"&KgPerSheet="+KgPerSheet+"&PartWeight="+PartWeight+"&OP5="+OP5+"&OP5M="+OP5M+"&OP10="+OP10+"&OP10M="+OP10M+"&OP40="+OP40+"&OP40M="+OP40M+"&OP20="+OP20+"&OP20M="+OP20M+"&OP50="+OP50+"&OP50M="+OP50M+"&OP30="+OP30+"&OP30M="+OP30M+"&OP60="+OP60+"&OP60M="+OP60M+"&ProcessAssy="+ProcessAssy+"&ProcessAssyM="+ProcessAssyM+"&OP70="+OP70+"&OP70M="+OP70M+"&LinkID="+LinkID+"&PackingTypeDetail="+PackingTypeDetail+"&StdPackDetail="+StdPackDetail+"&ItemNoDetail="+ItemNoDetail+"&ItemNoDetailSub="+ItemNoDetailSub+"&ItemNo="+ItemNo+"&NoUrut="+NoUrut+"&SpecOrder1="+SpecOrder1+"&SpecOrder2="+SpecOrder2+"&IsCommon="+IsCommon+"&QtyPart="+QtyPart+"&Ratio="+Ratio+"&PartRM="+PartRM,
        cache	: false,
        dataType : "json",
        success	: function(data){
            //var d = JSON.parse(data);
            NotifSuccsess(data.pesan);
            setTimeout(function(){
                $('#ItemIDSys2').val(data.ItemID);
                editthisBOM2(data.ItemID);
				$('#BAddBack').button('reset');
            },200);
        }  
    });
    var string = $('#formSubBom').serialize();
});

$('#PartNo4, #PartNo4b, #PartName4, #SpecOrder41, #SpecOrder42, #Spec4').on('keyup',function(){
    $(this).val($(this).val().toUpperCase());
});

$('#simpanRM').click(function(){
    //document.getElementById('formSubRM').reset();
    var kode = $("#SysIDDetail").val();
    var ItemID = $('#ItemIDSys4').val();
    //var LinkID = $("#LinkID").val();
    var LinkID = kode;
    var PartNo2 = $("#PartNo4").val();
    var PartNo3 = $("#PartNo4b").val();
    var IsRHLH = $("#IsRHLH4").val();
    var PartName2 = $("#PartName4").val();
    var PartTypeID2 = $("#PartTypeID4").val();
    var PackingTypeDetail = $("#PackingTypeDetail4").val();
    var StdPackDetail = $("#StdPackDetail4").val();
    var LevelPart = $("#LevelPart4").val();
    var QtyCar = $("#QtyCar4").val();
    var SupplierID = $("#SupplierID4").val();
    
    var MaterialType = $("#MaterialType4").val();
    var IsCommon = $("#IsCommon4").val();
    var Spec = $("#Spec4").val();
    var QtyPart = $("#QtyPart4").val();
    var Ratio = $("#Ratio4").val();
    var SpecOrder1 = $("#SpecOrder41").val();
    var SpecOrder2 = $("#SpecOrder42").val();
    var Thick = $("#Thick4").val();
    var Width = $("#Width4").val();
    var Length = $("#Length4").val();
    var PcsPerSheet = $("#PcsPerSheet4").val();
    var KgPerSheet = $("#KgPerSheet4").val();
    var PartWeight = $("#PartWeight4").val();
    
    var PartRM = $('#PartRM').val();
    if(PartNo2.length==0){
        console.log('error 1');
        $("#myModal4").modal('show');
        $("#pesan4").html('<em><strong>Part No</strong></em> field is required !!!'); 
        return false();
    } 
    
    if(LevelPart.length==0)
    {
        console.log('error 2');
        NotifFail("Level Part Belum di Pilih");
        return false();
    }
    
    if(PartName2.length==0){
        console.log('error 3');
        $("#myModal4").modal('show');
        $("#pesan4").html('<em><strong>Part Name</strong></em> field is required !!!'); 
        return false();
    } 
    
    if(IsRHLH == 1 && PartNo3.length==0)
    {
        console.log('error 4');
        $("#myModal4").modal('show');
        $("#pesan4").html('<em><strong>Part No 2</strong></em> field is required !!!'); 
        return false();
    }
    
    if(PartTypeID2.indexOf('RM')>=0) PartRM = null;
    
    $.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/MasterBom/InfoTambahChild",
        data	: "&ItemID="+ItemID+"&kode="+kode+"&PartNo2="+PartNo2+"&PartName2="+PartName2+"&PartNo3="+PartNo3+"&IsRHLH="+IsRHLH+"&PartTypeID2="+PartTypeID2+"&LevelPart="+LevelPart+"&QtyCar="+QtyCar+"&SupplierID="+SupplierID+"&MaterialType="+MaterialType+"&Spec="+Spec+"&Thick="+Thick+"&Width="+Width+"&Length="+Length+"&PcsPerSheet="+PcsPerSheet+"&KgPerSheet="+KgPerSheet+"&PartWeight="+PartWeight+"&LinkID="+LinkID+"&PackingTypeDetail="+PackingTypeDetail+"&StdPackDetail="+StdPackDetail+"&SpecOrder1="+SpecOrder1+"&SpecOrder2="+SpecOrder2+"&IsCommon="+IsCommon+"&QtyPart="+QtyPart+"&Ratio="+Ratio+"&PartRM="+PartRM,
        cache	: false,
        dataType : "json",
        success	: function(data){
            //NotifSuccsess(data.pesan);
            setTimeout(function(){
                $('#myModalRM').modal('hide');
                var cek = $("#PartRM option[value='"+data.ItemID+"']").length > 0;
                if(cek!==true)
                {
                    $("#PartRM").append('<option value="'+data.ItemID+'" selected="selected">'+data.PartName2+'</option>');
                } else {
                    //$("#PartRM").val(data.ItemID).trigger('change');
                }
                //var d = $('#PartRM').val();
                //i = d.push(data.ItemID);
                //d.val(i).trigger('change');
                //$.each($('#PartRM').val(),function(i,x){
                    //console.log(x);
                //});
                document.getElementById('formSubRM').reset();
            },500);
        }  
    });
    var string = $('#formSubBom').serialize();
});


$('#ViewB').click(function(){
    $('#ViewB').button('loading');
    $('#Product').html('');
    var Arr = [];  
    $.each($('#form_detail input:hidden.detailItem'),function(id,row){
        //if($(this).val()==value.ItemID) { $('#chk'+value.ItemID).prop('checked',true); return true; }
        //else $('#chk'+value.ItemID).prop('checked',false);    
        Arr.push($(this).val());
    }); 
        
    $.ajax({
        type        : 'POST',
        url         : Globals.site_url+'/MasterBom/GetListByPartLevel',
        cache       : false,
        data        : "PartLevel="+$('#LevelPartList').val()+"&PartTypeID="+$('#PartTypeIDS').val()+"&PartNo="+$('#PartNoS').val(),
        success	: function(data){
            $('#ViewB').button('reset');
            var d = JSON.parse(data);
            $.each(d.list, function(index,value){
                var string = '<p title="'+value.PartName+'"><input id="chk'+value.ItemID+'" type="checkbox" value="'+value.ItemID+'" onclick="inputChild(this,\''+linkid+'\');" data-parttype="'+value.PartType+'" data-itemid="'+value.ItemID+'" data-ref="'+value.PartNo+' - '+value.PartName+'" /> '+value.text+'&nbsp;&nbsp;<span class="label label-info pull-right" style="cursor: pointer;" onclick="editthisBOM2('+value.ItemID+'); return false;">edit</span></p>';
                $('#Product').append(string);
                if(jQuery.inArray(value.ItemID, Arr) !== -1) $('#chk'+value.ItemID).prop('checked',true);
            });
        }
    });
});	

$('#NewB').click(function(){
    $('#rightside').attr('style','display:none;');
    $('#formaddchild').removeAttr('style');        
    document.getElementById("formSubBom").reset();
    $('#PartRM').val(null).trigger("change");
    $('#SupplierID').val("0").trigger("change");
    //$('#ProsesOP').attr("class","collapse in");
    //$('#MaterialSpecCollapse').attr("class","collapse");
    //$("#wrapper").attr('Class','');     
    //$('#accordion2').attr('style','display:none');
    set_hide($('#PartTypeID2').val());
                                    
    $.ajax({
        type        : 'POST',
        url         : '<?php echo site_url(); ?>/MasterBom/GetListPartType',
        cache       : false,
        data        : "kode="+$("#SysIDDetail").val(),
        success	: function(data){
            $('#PartTypeID2').find('option').remove();
            setTimeout(function(){
                //console.log(JSON.parse(data));
                $.each(JSON.parse(data),function(i,x){
                    $('#PartTypeID2').append('<option value="'+x.id+'">'+x.text+'</option>');
                    //console.log(x);
                });
            },300);
        }
   });
   
});        
$("#PartNo").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#PartName").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#PackingType").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#FGLocation").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#PartNo2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); }); 
$("#PartName2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); }); 
$("#Spec").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#SpecOrder1").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#SpecOrder2").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
$("#MaterialType").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
 
$("#StdPack").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; 	} });
$("#StdPackDetail").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; 	} });
$("#QtyCar, #QtyCar4").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; 	} });
$("#QtyPerCarHead").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; 	} });
$("#PcsPerSheet, #QtyPart, #Ratio, #QtyPart4, #Ratio4, #PcsPerSheet4").keypress(function(data){ if (data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; 	} });
$("#KgPerSheet, #KgPerSheet4").keypress(function(data){ if (data.which!=46 && data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; 	} });
$("#PartWeight, #PartWeight4").keypress(function(data){ if (data.which!=46 && data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; 	} });
$("#Thick, #Thick4").keypress(function(data){ if (data.which!=46 && data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; 	} });
$("#Width, #Width4").keypress(function(data){ if (data.which!=46 && data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; 	} });
$("#Length, #Length4").keypress(function(data){ if (data.which!=46 && data.which!=8 && data.which!=0 && (data.which<48 || data.which>57)) { return false; 	} });
    
    $("#OP5").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
    $("#OP10").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
    $("#OP40").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
    $("#OP20").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
    $("#OP50").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
    $("#OP30").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
    $("#OP60").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
    $("#OP70").keyup(function(e){ var isi = $(e.target).val(); $(e.target).val(isi.toUpperCase()); });
    
    
    
	
	$("#SaveEditHead").click(function(){
		var PartNoEdit	    = $("#PartNoEdit").val();
        var PartNameEdit	= $("#PartNameEdit").val();
		var IDCustEdit	    = $("#IDCustEdit").val();
     
		var string = $("#formEditHead").serialize();
		
	if(PartNoEdit.length==0){
		  $("#myModal4").modal('show');
            $("#pesan4").text('Part No Harus di isi'); 
			return false();
		} 
        
        	if(PartNameEdit.length==0){
		  $("#myModal4").modal('show');
            $("#pesan4").text('Part Name Harus di isi'); 
			return false();
		} 
        
               	if(IDCustEdit.length==0){
		  $("#myModal4").modal('show');
            $("#pesan4").text('Customer Harus di isi'); 
			return false();
		}
        
        
        $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/MasterBom/SaveEditHead",
			data	: string,
			cache	: false,
			success	: function(data){
			NotifSuccsess(data);
			},
			error : function(xhr, teksStatus, kesalahan) {
				$("#myModal4").modal('show');
                 $("#pesan4").text('Server tidak merespon :'+kesalahan);
			}
		});
		return false();		
	});
    
        
$("#ItemID").load(CariProfilProduct());
$("#ItemID").focus(function(e){
var isi = $(e.target).val();
CariProfilProduct(); 
});
	
	function CariProfilProduct(){
		var kode = $("#ItemID").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/MasterBom/InfoBOM_Head",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#ItemNo").val(data.ItemNo);
                $("#PartNo").val(data.PartNo);
                $("#PartName").val(data.PartName);
                $("#IDCust").val(data.IDCust);
                $("#IDProject").val(data.IDProject);
                $("#PackingType").val(data.PackingType);
                $("#StdPack").val(data.StdPack);
                $("#PartTypeID").val(data.PartTypeID);
                $("#FGLocation").val(data.FGLocation);
                $("#IsActive").val(data.IsActive);
                $("#QtyPerCar").val(data.QtyPerCar);
                $("#SupplierID").val(data.SupplierID);
                $("#SupplierName").val(data.SupplierName);
                
                $("#IDCustQ").val(data.IDCust);
                $("#LinkIDQ").val($("#ItemID").val());
               
                			 }  });  };

$("#LinkID").load(CariProfilDetail());
$("#LinkID").focus(function(e){
		var isi = $(e.target).val();
		CariProfilDetail(); CariProfilProduct();
	});	
	function CariProfilDetail(){
		var kode = $("#ItemID2").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/MasterBom/InfoBOM_Detail",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
			     $("#LinkID").val(data.LinkID);
                 $("#NoUrut").val(data.NoUrut);
				$("#PartNo2").val(data.PartNo);
                $("#PartName2").val(data.PartName);
                $("#PackingTypeDetail").val(data.PackingType);
                $("#StdPackDetail").val(data.StdPack);
                $("#LevelPart").val(data.LevelPart);
                $("#PartTypeID2").val(data.PartTypeID);
                $("#QtyCar").val(data.QtyPerCar);
                $("#SupplierID").val(data.SupplierID); 
                $("#SupplierName").val(data.SupplierName);
                $("#MaterialType").val(data.MaterialType); 
                $("#IsCommon").val(data.IsCommon);
                $("#SpecOrder1").val(data.SpecOrder1);
                $("#SpecOrder2").val(data.SpecOrder2);
                $("#QtyPart").val(data.QtyPart); 
				$("#Ratio").val(data.Ratio); 
				$("#Spec").val(data.Spec); 
                $("#Thick").val(data.Thick);
                $("#Width").val(data.Width);
                $("#Length").val(data.Width); 
                $("#PcsPerSheet").val(data.PcsPerSheet); 
                $("#KgPerSheet").val(data.KgPerSheet);
                $("#PartWeight").val(data.PartWeight);
$("#OP5").val(data.OP5); $("#OP5M").val(data.OP5M);
$("#OP10").val(data.OP10); $("#OP10M").val(data.OP10M);
$("#OP40").val(data.OP40); $("#OP40M").val(data.OP40M);
$("#OP20").val(data.OP20); $("#OP20M").val(data.OP20M);
$("#OP50").val(data.OP50); $("#OP50M").val(data.OP50M);
$("#OP30").val(data.OP30); $("#OP30M").val(data.OP30M);
$("#OP60").val(data.OP60); $("#OP60M").val(data.OP60M);
$("#ProcessAssy").val(data.ProcessAssy); $("#ProcessAssyM").val(data.ProcessAssyM);
$("#OP70").val(data.OP70); $("#OP70M").val(data.OP70M);
$("#ItemNoDetail").val(data.ItemNoDetail);
$("#ItemNoDetailSub").val(data.ItemNoDetailSub);
               DetailBOM2();  
                			 }  });  }; 
                             
 $("#SaveEditDetail").click(function(){
		var PartNoEditDetail	    = $("#PartNoEditDetail").val();
        var PartNameEditDetail	= $("#PartNameEditDetail").val();
     
		var string = $("#formEditDetail").serialize();
		
	if(PartNoEditDetail.length==0){
		  $("#myModal4").modal('show');
            $("#pesan4").text('Part No Harus di isi'); 
			return false();
		} 
        
        	if(PartNameEditDetail.length==0){
		  $("#myModal4").modal('show');
            $("#pesan4").text('Part Name Harus di isi'); 
			return false();
		} 
        
        $.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/MasterBom/SaveEditDetail",
			data	: string,
			cache	: false,
			success	: function(data){
			NotifSuccsess(data);
			},
			error : function(xhr, teksStatus, kesalahan) {
				$("#myModal4").modal('show');
                 $("#pesan4").text('Server tidak merespon :'+kesalahan);
			}
		});
		return false();		
	});
    

    
$("#Hapus").click(function(){
 var DocNumDetailDelete2	    = $("#DocNumDetailDelete2").val();
 $("#myModal3434").modal('hide');
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterBom/Hapus_Detail",
 data	: "DocNumDetailDelete2="+DocNumDetailDelete2,
 cache	: false,
 success	: function(data){
    var d = JSON.parse(data);
    $('#Product p #chk'+d.ItemID).prop('checked',false);
    setTimeout(function(){
     NotifFail(d.msg);
     $("#SysIDDetail").focus();  
     DetailBOM88($("#SysIDDetail").val()); 
     //DetailBOM2(); 
     },200) 	
 },
 error : function(xhr, teksStatus, kesalahan) {
 $("#myModal4").modal('show');
 $("#pesan4").text('Server tidak merespon :'+kesalahan); 	} }); 	return false();	 });
     
$("#HapusHead").click(function(){
 var DocNumDetailDelete	    = $("#DocNumDetailDelete").val();
 $("#myModal3333").modal('hide');  
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterBom/Hapus_Head",
 data	: "DocNumDetailDelete="+DocNumDetailDelete,
 cache	: false,
 success	: function(data){
 setTimeout(function(){
 NotifFail(data); 
 $("#home-tab2").click(); 
 DetailBOM(); DetailBOM2();
 },300) },
 error : function(xhr, teksStatus, kesalahan) {
 $("#myModal4").modal('show');
 $("#pesan4").text('Server tidak merespon :'+kesalahan); 	} }); return false(); });
    
$("#SupplierIDHead").click(function(){
$("#myModal_Partner2").modal('show'); });
$("#SupplierIDHeadEdit").click(function(){
$("#myModal_Partner2Head").modal('show'); });
$("#SupplierIDEditDetail").click(function(){
$("#myModal_PartnerDetail").modal('show'); });
    
     $("#SupplierID").click(function(){
		$("#myModal_Partner").modal('show');
	});
    
    $("#SupplierID").focus(function(e){
		var isi = $(e.target).val();
		CariProfilPartner();
	});
	$("#SupplierID").keyup(function(){
		CariProfilPartner();	
	});
	
	function CariProfilPartner(){
		var kode = $("#SupplierID").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/MasterBom/InfoPartner",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#SupplierName").val(data.partner_code);
			 }  });  };
             
    $("#SupplierIDEditDetail").focus(function(e){
		var isi = $(e.target).val();
		CariProfilPartnerEditDetail();
	});
	$("#SupplierIDEditDetail").keyup(function(){
		CariProfilPartnerEditDetail();	
	});
	
	function CariProfilPartnerEditDetail(){
		var kode = $("#SupplierIDEditDetail").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/MasterBom/InfoPartner",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#SupplierNameEditDetail").val(data.partner_code);
			 }  });  };
             
    $("#SupplierIDHead").focus(function(e){
		var isi = $(e.target).val();
		CariProfilPartnerHead();
	});
	$("#SupplierIDHead").keyup(function(){
		CariProfilPartnerHead();	
	});
	
	function CariProfilPartnerHead(){
		var kode = $("#SupplierIDHead").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/MasterBom/InfoPartner",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#SupplierNameHead").val(data.partner_code);
			 }  });  };
             
    $("#SupplierIDHeadEdit").focus(function(e){
		var isi = $(e.target).val();
		CariProfilPartnerHeadEdit();
	});
	$("#SupplierIDHeadEdit").keyup(function(){
		CariProfilPartnerHeadEdit();	
	});
	
	function CariProfilPartnerHeadEdit(){
		var kode = $("#SupplierIDHeadEdit").val();
		$.ajax({
			type	: 'POST',
			url		: "<?php echo site_url(); ?>/MasterBom/InfoPartner",
			data	: "kode="+kode,
			cache	: false,
			dataType : "json",
			success	: function(data){
				$("#SupplierNameHeadEdit").val(data.partner_code);
			 }  });  };
    
    $("#Tutup").click(function(){
	$("#myModal3").modal('hide');
	}); 
    
    $("#RegID").click(function(){
	$("#myModal_product").modal('show');
	});
    
$("#DownLoad").click(function(){
 var CustIDView = $("#CustIDView").val() ;
 window.open('<?php echo site_url();?>/MasterBom/ExportProduct/'+CustIDView);
 return false(); });
    
    
	
	
});	
</script>

 <script type="text/javascript">
$(document).ready(function() {
$('#PurchaseDate').daterangepicker({
singleDatePicker: true,
calender_style: "picker_4"
}, function(start, end, label) {
console.log(start.toISOString(), end.toISOString(), label);
});
});
</script>

<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">

<?php  $cek = $this->Role_Model->MBomUp(); if(!empty($cek)){ ?>
<a href="#tab_content2" role="tab" id="form-tab" data-toggle="tab" aria-expanded="false" class="btn btn-primary">
<i class="fa  fa-plus"></i>&nbsp; New</a><?php } ?>
<button type="button" name="DownLoad" id="DownLoad" class="btn btn-info"><i class="fa fa-file-excel-o"></i>&nbsp; Download</button>






</div></div>

<div class="col-sm-3 pull-right">
<div class="input-group">
<select name="CustIDView" id="CustIDView" class="form-control col-sm-12">
<?php if(empty($PartnerID)){ ?>
<option value="">Select</option>
<?php } foreach($l_MCust->result() as $t){ if($IDCust==$t->Code){ ?>
<option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->RegID;?> - <?php echo $t->Code;?></option>
<?php }else { ?>
<option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option> <?php } } ?> 
</select>
<span class="input-group-btn">
<a  onclick="Search()" href="#" >
<button type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">
<i class="fa fa-refresh"></i></button></a>
</span>
</div></div>

</div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<?php  $cek = $this->Role_Model->MBomView(); if(!empty($cek)){ ?>
<div id="tampil_data"></div>
<?php } ?>
</div></div>`

</div>
</div>

<div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="form-tab">
<div class="box-body">
<div class="box">
<div class="box-body">
    <div class="panel-group" id="accordion">
    <form class="form-horizontal" id="form">
            <div class="panel panel-default">
            <div class="panel-heading">
            <h5 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#transaksi"><span class="glyphicon ">
            </span> FG Part &nbsp; 
            <span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>
            
            <div id="transaksi" class="collapse in">
            <div class="panel-body">
            <div class="col-md-6">
            <div class="form-group">
            <label class="col-sm-4 control-label">ID</label>
            <div class="col-sm-4">
            <input type="text" id="ItemID" name="ItemID"  class="form-control" readonly="true">
            </div>
            <div class="col-sm-4">
            <input type="text" id="ItemNo" name="ItemNo"  class="form-control" readonly="true">
            </div></div>
            <div class="form-group">
            <label class="col-sm-4 control-label">Part No</label>
            <div class="col-sm-8">
            <input type="text" id="PartNo" name="PartNo"  class="form-control">
            </div></div>
             <div class="form-group">
            <label class="col-sm-4 control-label">Part Name</label>
            <div class="col-sm-5">
            <input type="text" id="PartName" name="PartName"  class="form-control">
            </div>
            <div class="col-lg-3">
                <select name="NameType" id="NameType" class="selectpicker form-control" data-width="fit">
                    <option value="0"></option>
                    <option value="1">RH</option>
                    <option value="2">LH</option>
                </select>
            </div>
            </div> 
            
            <div class="form-group">
            <label class="col-sm-4 control-label">Customer</label>
            <div class="col-sm-4">
            <select name="IDCust" id="IDCust" class="form-control" style="width: 100%;">
            <?php if(empty($PartnerID)){ ?>
            <option value="">Select</option>
            <?php } foreach($l_MCust->result() as $t){ if($IDCust==$t->Code){ ?>
            <option value="<?php echo $t->RegID;?>"><?php echo $t->Code;?></option>
            <?php }else{ ?>
            <option value="<?php echo $t->RegID;?>" ><?php echo $t->Code;?></option> <?php } } ?> 
            </select> </div>
            <div class="col-sm-4">
            <select name="IDProject" id="IDProject" class="form-control" style="width: 100%;">
            <?php if(empty($PartnerID)){ ?>
            <option value="">Select</option>
            <?php } foreach($l_MProject->result() as $t){ if($IDProject==$t->ProjectName){ ?>
            <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->RegID;?> - <?php echo $t->ProjectName;?></option>
            <?php }else { ?>
            <option value="<?php echo $t->RegID;?>"><?php echo $t->ProjectName;?></option>
            <?php } } ?>  </select>
            </div></div>
              
            <div class="form-group">
            <label class="col-sm-4 control-label">Qty/Car</label>
            <div class="col-sm-8">
            <input type="text" id="QtyPerCarHead" name="QtyPerCarHead"  class="form-control">
            </div></div> 
            <div class="form-group">
            <label class="col-sm-4 control-label">WH Location</label>
            <div class="col-sm-8">
            <input type="text" id="FGLocation" name="FGLocation"  class="form-control">
            </div></div>
            </div>
                
            <div class="col-md-6">
            <div class="form-group">
            <label class="col-sm-4 control-label">Packing Type</label>
            <div class="col-sm-8">
            <input type="text" id="PackingType" name="PackingType"  class="form-control">
            </div></div> 
            
            <div class="form-group">
            <label class="col-sm-4 control-label">Standart Packing</label>
            <div class="col-sm-8">
            <input type="text" id="StdPack" name="StdPack"  class="form-control">
            </div></div> 
              
              <div class="form-group">
              <label class="col-sm-4 control-label">Part Type</label>
              <div class="col-sm-8">
              <select name="PartTypeID" id="PartTypeID" class="form-control" style="width: 100%;">
              <?php if(empty($PartnerID)){ ?>
                <option value="">Select</option>
              <?php } foreach($PartTypeFg->result() as $t){ if($PartTypeID==$t->SysID){ ?>
              <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->SysID;?> - <?php echo $t->PartType;?></option>
              <?php }else { ?>
              <option value="<?php echo $t->SysID;?>"><?php echo $t->PartType;?></option> <?php } } ?> 
              </select> </div> </div>
              
            <div class="form-group">
            <label class="col-sm-4 control-label">Supplier</label>
            <div class="col-sm-8">
            <select id="SupplierIDHead" name="SupplierIDHead" class="form-control" style="width: 100%;">
            <?php if(empty($PartnerID)){ ?>
            <option value="">Select</option>
            <?php } foreach($MListPartner->result() as $t){ if($PartnerID==$t->partner_name){ ?>
            <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->partner_name;?></option>
            <?php }else { ?>
            <option value="<?php echo $t->id;?>"><?php echo $t->partner_name;?></option>
            <?php } } ?>  
            </select>
            </div></div>
            
              <div class="form-group">
              <label class="col-sm-4 control-label">Status</label>
              <div class="col-sm-8">
              <select name="IsActive" id="IsActive" class="form-control">
              <?php foreach($l_MDetailStatus->result() as $t){ if($IDBlokir==$t->Detail){ ?>
              <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->RegID;?> - <?php echo $t->Detail;?></option>
              <?php }else { ?>
              <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option> <?php } } ?> 
              </select> </div> </div> 
              </div>
              
            </div>
            
            <div class="panel-footer" data-toggle="btn-toggle">
            <div class="btn-group">
            <?php  $cek = $this->Role_Model->MBomUp(); if(!empty($cek)){ ?>
            <button type="button" name="save" id="save" class="btn btn-success"><i class="fa fa-save"></i> Save</button>            
            <?php } ?>
            <a href="#tab_content1" id="Home3" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-info">
            <i class="fa fa-reply"></i> Closed</a>
            
            
            <a href="#tab_content11" id="content11" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-info" style="display: none;">
            next</a>
            
            
            </div></div>
            
            </div></div>
            
            </form>
            </div>
</div></div> </div>
</div>


<div role="tabpanel" class="tab-pane fade" id="tab_content_DetailBOM" aria-labelledby="view-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<a href="#tab_content1" role="tab" id="Home2"  data-toggle="tab" aria-expanded="false" class="btn btn-warning" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-reply"></i>&nbsp; Back</a>
<button type="button" class="btn btn-info" id="reload1" name="reload1" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>
</div></div>

<div class="pull-right">
<div class="input-group">
<input type="text" class="form-control" id="SysIDDetail" name="SysIDDetail" placeholder="Barcode">
<span class="input-group-btn">
</span>
</div></div>
</div></div></div>

<div class="box-body">
<div class="box">
<div class="box-body">
<div id="DetailBOM"></div>
</div></div>`
</div>
</div>

<div role="tabpanel" class="tab-pane fade" id="tab_content11" aria-labelledby="view-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">
<a href="#tab_content1" role="tab" id="Home2" data-toggle="tab" aria-expanded="false" class="btn btn-warning" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-reply"></i>&nbsp; Closed</a>
</div></div>
<div class="col-sm-3 pull-right">
    <div class="input-group">
        <select id="MParts" class="form-control" style="width:200px" data-placeholder="Part No">
        </select>
    </div>
</div>
</div></div></div>



    <div id="templates_detail">
    
        <div id="wrapper">

        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <div class="sidebar-nav">
                <div class="col-md-12">
                    <div class="row">
                        <form class="form-horizontal" id="FormViewBOM">
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Part Level</label>
                                <div class="col-lg-8">
                                    <select id="LevelPartList" class="form-control input-sm" name="LevelPart" onchange="$('#ViewB').click();">
                                        <option value=""></option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Part Type</label>
                                <div class="col-lg-8">
                                    <select name="PartTypeIDS" id="PartTypeIDS" class="form-control input-sm" onchange="$('#ViewB').click();">
                                        <option value=""></option>
                                        <?php foreach($PartType2->result() as $t){ if($PartTypeID==$t->SysID){ ?>
                                        <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->SysID;?> - <?php echo $t->PartType;?></option>
                                        <?php }else { ?>
                                        <option value="<?php echo $t->SysID;?>"><?php echo $t->PartType;?></option> <?php } } ?> 
                                    </select>
                                </div>
                            </div>
                            
                            
                
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Part No</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control input-sm" id="PartNoS" name="PartNoS" onkeyup="$('#ViewB').click();" />
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-lg-4 control-label">&nbsp;</label>
                                <div class="col-lg-8">
                                <a id="ViewB" class="btn btn-success btn-sm" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">&nbsp;View</a>
                                <a id="NewB" class="btn btn-default btn-sm" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">&nbsp;New</a>
                                
                                </div>
                            </div> 
                        </form>
                    </div>
                    
                    <div class="row">
                        <div id="Product">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div class="box-body">
        <div class="box">
        <div class="box-body">

            <div id="page-content-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div id="rightside">
                                <!--<a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Toggle Menu</a>-->
                            </div>
                            <div id="formaddchild" style="display: none;">
                            
                            <div class='wrapper1'>
                              <div id='left-defaults' class='container'>
                                <div>You can move these elements between these two containers</div>
                                <div>Moving them anywhere else isn't quite possible</div>
                              </div>
                              <div id='right-defaults' class='container'>
                                <div>There's also the possibility of moving elements around in the same container, changing their position</div>
                                <div>This is the default use case. You only need to specify the containers you want to use</div>
                                <div>More interactive use cases lie ahead</div>
                              </div>
                            </div>
                            <script src='<?php echo base_url();?>/assets/plugins/dragula/dragula.js'></script>
                            <script src='<?php echo base_url();?>/assets/plugins/dragula/example.min.js'></script>
                                <form class="form-horizontal" id="formSubBom">
                                <!--<input type="hidden" name="SysIDDetail2a" id="SysIDDetail2a" value="" />-->
                                <input type="hidden" id="LinkID" name="LinkID"  class="form-control" readonly="true">
                                <input type="hidden" id="ItemID2" name="ItemID2"  class="form-control" readonly="true">
                                <input type="hidden" id="ItemNoDetail" name="ItemNoDetail"  class="form-control" readonly="true">
                                <input type="hidden" min="1" max="20" id="ItemNoDetailSub" name="ItemNoDetailSub"  class="form-control">
                                <div class="panel-group" id="accordion">
                                <div class="panel panel-success">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#product"><span class="glyphicon ">
                                </span> Data Product &nbsp; 
                                <span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
                                <div id="product" class="collapse in">
                                <div id="detail31">
                                
                                <div class="panel-body">
                                <div class="col-md-6">
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Item ID</label>
                                <div class="col-lg-8">
                                <input type="text" id="ItemIDSys2" name="ItemIDSys2"  class="form-control" readonly="">
                                </div></div>
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Part No LH</label>
                                <div class="col-lg-8">
                                <input type="text" id="PartNo2" name="PartNo2"  class="form-control" >
                                </div></div>
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Part No RH</label>
                                <div class="col-lg-8">
                                <input type="text" id="PartNo3" name="PartNo3"  class="form-control">
                                </div></div>
                                 <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Part Name</label>
                                <div class="col-lg-8">
                                <input type="text" id="PartName2" name="PartName2"  class="form-control">
                                </div>
                                </div> 
                                
                                    <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Packing Type</label>
                                <div class="col-lg-8">
                                <input type="text" id="PackingTypeDetail" name="PackingTypeDetail"  class="form-control">
                                </div></div> 
                                
                                 <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Standart Packing</label>
                                <div class="col-lg-8">
                                <input type="text" id="StdPackDetail" name="StdPackDetail"  class="form-control">
                                </div></div>
                                
                                </div>
                                    
                                  <div class="col-md-6">  
                                  <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                  <label class="col-lg-4 control-label">Part Level</label>
                                  <div class="col-lg-8">
                                  <select name="LevelPart" id="LevelPart" class="form-control">
                                  <option value=""></option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>      
                                  </select> </div> </div> 
                                  
                                  <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                  <label class="col-lg-4 control-label">Part Type</label>
                                  <div class="col-lg-8">
                                  <select name="PartTypeID2" id="PartTypeID2" class="form-control">
                                  <option value=""></option>
                                  <?php foreach($PartType->result() as $t){ if($PartTypeID==$t->SysID){ ?>
                                  <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->SysID;?> - <?php echo $t->PartType;?></option>
                                  <?php }else { ?>
                                  <option value="<?php echo $t->SysID;?>"><?php echo $t->PartType;?></option> <?php } } ?> 
                                  </select> </div> </div>
                                  
                                
                                
                                  
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Qty / Car</label>
                                <div class="col-lg-8">
                                <input type="text" id="QtyCar" name="QtyCar"  class="form-control">
                                </div></div> 
                                
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-sm-4 control-label">Supplier</label>
                                <div class="col-sm-8">
                                <select id="SupplierID" name="SupplierID" class="form-control" style="width: 100%;">
                                <?php if(empty($PartnerID)){ ?>
                                <option value="0">Select</option>
                                <?php } foreach($MListPartner->result() as $t){ if($PartnerID==$t->partner_name){ ?>
                                <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->partner_name;?></option>
                                <?php }else { ?>
                                <option value="<?php echo $t->id;?>"><?php echo $t->partner_name;?></option>
                                <?php } } ?>  
                                </select>
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-sm-4 control-label">Is RH LH</label>
                                <div class="col-sm-8">
                                <select name="IsRHLH" id="IsRHLH" class="form-control">
                                  <option value="0">No</option>
                                  <option value="1">Yes</option>
                                </select>
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;" id="RMHide">
                                <label class="col-sm-4 control-label">Part RM</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                    <select id="PartRM" class="form-control js-data-example-ajax-search" multiple>
                                    <?php foreach($ListRM->result() as $t) {
                                        echo '<option value="'.$t->ItemID.'">'.$t->PartNo.'</option>';
                                    }
                                    ?>
                					</select>
                                    <span class="input-group-btn">
                						<button class="btn btn-default" type="button" id="BNewRM" data-toggle="modal" data-target="#myModalRM" onclick="document.getElementById('formSubRM').reset();">
                							New
                						</button>
                					</span>
                                    </div>
                                </div></div>
                                
                                                                
                                
                                </div></div></div></div></div></div>
                                
                                
                                <div class="panel-group" id="accordion2"> 
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion2" href="#MaterialSpecCollapse"><span class="glyphicon ">
                                </span> Material Spec &nbsp; 
                                <span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>
                                
                                <div id="MaterialSpecCollapse" class="collapse">
                                
                                <div class="panel-body" style="background: aqua;">
                                <div class="col-md-6">
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Spec Order</label>
                                <div class="col-lg-4">
                                <input type="text" id="SpecOrder1" name="SpecOrder1"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <input type="text" id="SpecOrder2" name="SpecOrder2"  class="form-control">
                                </div></div>
                                
                                 <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                 <label class="col-lg-4 control-label">Material Type</label>
                                 <div class="col-lg-8">
                                  
                                  <select name="MaterialType" id="MaterialType" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <option value="0">Type</option>
                                <?php foreach($MaterialTypeList->result() as $t){ if($MaterialType==$t->MaterialName){ ?>
                                <option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->MaterialName;?></option>
                                <?php }else { ?>
                                <option value="<?php echo $t->RegID;?>"><?php echo $t->MaterialName;?></option>
                                <?php } } ?> 
                                </select>
                                
                                  </div> </div> 
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Spec</label>
                                <div class="col-lg-8">
                                <input type="text" id="Spec" name="Spec"  class="form-control">
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Size</label>
                                <div class="col-lg-2">
                                <input type="text" id="Thick" name="Thick"  class="form-control" placeholder="T">
                                </div>
                                <label class="col-lg-1 control-label">X</label>
                                <div class="col-lg-2">
                                <input type="text" id="Width" name="Width"  class="form-control" placeholder="W">
                                </div>
                                <label class="col-lg-1 control-label">X</label>
                                <div class="col-lg-2">
                                <input type="text" id="Length" name="Length"  class="form-control" placeholder="L">
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Qty Part</label>
                                <div class="col-lg-8">
                                <input type="text" id="QtyPart" name="QtyPart"  class="form-control" value="1">
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Ratio</label>
                                <div class="col-lg-8">
                                <input type="text" id="Ratio" name="Ratio"  class="form-control" value="1">
                                </div></div>
                                
                                </div>
                                
                                <div class="col-md-6">
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Pcs / Sheet</label>
                                <div class="col-lg-8">
                                <input type="text" id="PcsPerSheet" name="PcsPerSheet"  class="form-control">
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Kg / Sheet</label>
                                <div class="col-lg-8">
                                <input type="text" id="KgPerSheet" name="KgPerSheet"  class="form-control">
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Part Weight</label>
                                <div class="col-lg-8">
                                <input type="text" id="PartWeight" name="PartWeight"  class="form-control">
                                </div></div>
                                
                                  <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                  <label class="col-sm-4 control-label">Is Common</label>
                                  <div class="col-sm-8">
                                  <select name="IsCommon" id="IsCommon" class="form-control">
                                 <option value="0">False</option>
                                 <option value="1">True</option>
                                  </select> </div> </div>
                                  
                                </div>
                                </div>
                                </div></div></div>
                                
                                <div class="panel-group" id="accordion3">
                                <div class="panel panel-default">
                                <div class="panel-heading">
                                <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion3" href="#ProsesOP"><span class="glyphicon " id="timbul2">
                                </span> Proccess & Home Line &nbsp; 
                                <span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>
                                
                                <div id="ProsesOP" class="collapse">
                                
                                <div class="panel-body">
                                <div class="col-md-6">
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP5</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP5" name="OP5"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                
                                <select name="OP5M" id="OP5M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <?php if(empty($OP5M)){ ?>
                                <option value="0" >Machine</option>
                                <?php } foreach($Machine->result() as $t){ if($OP5M==$t->RegID){ ?>
                                <option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php }else { ?>
                                <option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php } } ?> 
                                </select>
                                </div></div>
                                  
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP10</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP10" name="OP10"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP10M" id="OP10M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <?php if(empty($OP10M)){ ?>
                                <option value="0">Machine</option>
                                <?php } foreach($Machine->result() as $t){ if($OP10M==$t->RegID){ ?>
                                <option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php }else { ?>
                                <option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php } } ?> 
                                </select> </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP20</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP20" name="OP20"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP20M" id="OP20M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <?php if(empty($OP20M)){ ?>
                                <option value="0">Machine</option>
                                <?php } foreach($Machine->result() as $t){ if($OP20M==$t->RegID){ ?>
                                <option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php }else { ?>
                                <option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php } } ?> 
                                </select>  </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP30</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP30" name="OP30"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP30M" id="OP30M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <?php if(empty($OP30M)){ ?>
                                <option value="0">Machine</option>
                                <?php } foreach($Machine->result() as $t){ if($OP30M==$t->RegID){ ?>
                                <option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php }else { ?>
                                <option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php } } ?> 
                                </select> </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP40</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP40" name="OP40"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP40M" id="OP40M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <?php if(empty($OP40M)){ ?>
                                <option value="0">Machine</option>
                                <?php } foreach($Machine->result() as $t){ if($OP40M==$t->RegID){ ?>
                                <option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php }else { ?>
                                <option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php } } ?> 
                                </select> </div></div>
                                
                                </div>
                                
                                <div class="col-md-6">
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP50</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP50" name="OP50"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP50M" id="OP50M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <?php if(empty($OP50M)){ ?>
                                <option value="0">Machine</option>
                                <?php } foreach($Machine->result() as $t){ if($OP50M==$t->RegID){ ?>
                                <option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php }else { ?>
                                <option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php } } ?> 
                                </select> </div></div>
                                
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP60</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP60" name="OP60"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP60M" id="OP60M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <?php if(empty($OP60M)){ ?>
                                <option value="0">Machine</option>
                                <?php } foreach($Machine->result() as $t){ if($OP60M==$t->RegID){ ?>
                                <option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php }else { ?>
                                <option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php } } ?> 
                                </select> </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">OP70</label>
                                <div class="col-lg-4">
                                <input type="text" id="OP70" name="OP70"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                <select name="OP70M" id="OP70M" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <?php if(empty($OP70M)){ ?>
                                <option value="0">Machine</option>
                                <?php } foreach($Machine->result() as $t){ if($OP70M==$t->RegID){ ?>
                                <option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php }else { ?>
                                <option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php } } ?> 
                                </select> </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">Process Assy</label>
                                <div class="col-lg-4">
                                <input type="text" id="ProcessAssy" name="ProcessAssy"  class="form-control">
                                </div>
                                <div class="col-lg-4">
                                
                                <select name="ProcessAssyM" id="ProcessAssyM" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
                                <?php if(empty($ProcessAssy2)){ ?>
                                <option value="0">Machine</option>
                                <?php } foreach($Machine->result() as $t){ if($ProcessAssy2==$t->RegID){ ?>
                                <option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php }else { ?>
                                <option value="<?php echo $t->RegID;?>"><?php echo $t->Line;?> - <?php echo $t->DetailLine;?></option>
                                <?php } } ?> 
                                </select>
                                </div></div>
                                
                                <div class="form-group form-group-sm" style="margin-top: -0.5em;">
                                <label class="col-lg-4 control-label">No.</label>
                                <div class="col-lg-8">
                                <input type="number" min="2" max="20" id="NoUrut" name="NoUrut"  class="form-control">
                                </div></div>
                                
                                </div></div></div></div></div>
                                
                                
                                <div class="box-body panel-footer">
                                <div class="box-tools pull-left" data-toggle="tooltip" data-original-title="" title="">
                                <div class="btn-group" data-toggle="btn-toggle">
                                <button id="simpan2" class="btn btn-warning" type="button" name="simpan">
                                <i class="fa fa-save"></i>
                                Save
                                </button>
                                <a id="BAddBack" class="btn btn-success" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">
                                <i class="fa fa-mail-reply"></i>
                                Back
                                </a>
                                
                                <a id="BNewPart" class="btn btn-primary">
                                <i class="fa  fa-plus"></i>
                                New
                                </a>
                                </div>
                                </div>
                                </div>
                                </form>
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    </div>

</div>
</div></div>


 <div class="modal fade" id="myModal3333" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">Info</h4></div><div class="modal-body"><div>
                        
<div id="pesan3"></div>
<div style="font-size: larger; font-weight: bold;" id="PartNoDelete"></div>
<br /><br /><br />

    <div class="panel-footer">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Batal</button>
        <button type="button" name="HapusHead" id="HapusHead" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Ok</button>
    
    <form class="navbar-right" role="search">
    <div class="form-group">
    <input type="text" id="DocNumDetailDelete" name="DocNumDetailDelete" class="form-control" readonly="true" ></div>
    </form>
    
    </div>
    
    
</div></div></div></div></div><!-- /.modal -->
 
<div class="modal fade" id="myModal3434" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">Info</h4></div><div class="modal-body"><div>
                        
<div id="pesan34"></div>
<div style="font-size: larger; font-weight: bold;" id="PartNoDelete2"></div>
<br /><br /><br />

    <div class="panel-footer">
        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="glyphicon glyphicon-share"></i> Batal</button>
        <button type="button" name="Hapus" id="Hapus" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Ok</button>
    
    <form class="navbar-right" role="search">
    <div class="form-group">
    <input type="text" id="DocNumDetailDelete2" name="DocNumDetailDelete2" class="form-control" readonly="true" ></div>
    </form>
    
    </div>
    
    
</div></div></div></div></div><!-- /.modal -->


<div class="modal fade" id="myModalRM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title">Add New Raw Material</h4></div><div class="modal-body"><div>
                        
<div id="IsiModalRM">
        <form class="form-horizontal" id="formSubRM">
        <!--<input type="hidden" name="SysIDDetail2a" id="SysIDDetail2a" value="" />-->
        <input type="hidden" id="PartID" name="PartID"  class="form-control" readonly="true">
        <div class="panel-group" id="accordion">
        <div class="panel panel-success">
        <div class="panel-heading">
        <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#product4"><span class="glyphicon ">
        </span> Data Product &nbsp; 
        <span style="float: right;"><i class="fa fa-bars"></i></span></a></h4></div>
        <div id="product4" class="collapse in">
        <div id="detail31">
        
        <div class="panel-body">
        <div class="col-md-6">
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Item ID</label>
        <div class="col-lg-8">
        <input type="text" id="ItemIDSys4" name="ItemIDSys4"  class="form-control" readonly="">
        </div></div>
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Part No LH</label>
        <div class="col-lg-8">
        <input type="text" id="PartNo4" name="PartNo4"  class="form-control" >
        </div></div>
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Part No RH</label>
        <div class="col-lg-8">
        <input type="text" id="PartNo4b" name="PartNo4b"  class="form-control">
        </div></div>
         <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Part Name</label>
        <div class="col-lg-8">
        <input type="text" id="PartName4" name="PartName4"  class="form-control">
        </div>
        </div> 
        
            <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Packing Type</label>
        <div class="col-lg-8">
        <input type="text" id="PackingTypeDetail4" name="PackingTypeDetail4"  class="form-control">
        </div></div> 
        
         <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Standart Packing</label>
        <div class="col-lg-8">
        <input type="text" id="StdPackDetail4" name="StdPackDetail4"  class="form-control">
        </div></div>
        
        </div>
            
          <div class="col-md-6">  
          <div class="form-group form-group-sm" style="margin-top: -0.5em;">
          <label class="col-lg-4 control-label">Part Level</label>
          <div class="col-lg-8">
          <select name="LevelPart4" id="LevelPart4" class="form-control">
          <option value=""></option>
          <option value="2">2</option>
          <option value="3">3</option>
          <option value="4">4</option>      
          </select> </div> </div> 
          
          <div class="form-group form-group-sm" style="margin-top: -0.5em;">
          <label class="col-lg-4 control-label">Part Type</label>
          <div class="col-lg-8">
          <select name="PartTypeID4" id="PartTypeID4" class="form-control">
          <option value=""></option>
          <?php foreach($PartTypeRM->result() as $t){ if($PartTypeID==$t->SysID){ ?>
          <option value="<?php echo $t->SysID;?>" selected="selected"><?php echo $t->SysID;?> - <?php echo $t->PartType;?></option>
          <?php }else { ?>
          <option value="<?php echo $t->SysID;?>"><?php echo $t->PartType;?></option> <?php } } ?> 
          </select> </div> </div>
          
        
        
          
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Qty / Car</label>
        <div class="col-lg-8">
        <input type="text" id="QtyCar4" name="QtyCar4"  class="form-control">
        </div></div> 
        
        
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-sm-4 control-label">Supplier</label>
        <div class="col-sm-8">
        <select id="SupplierID4" name="SupplierID4" class="form-control" style="width: 100%;">
        <?php if(empty($PartnerID)){ ?>
        <option value="0">Select</option>
        <?php } foreach($MListPartner->result() as $t){ if($PartnerID==$t->partner_name){ ?>
        <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->partner_name;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id;?>"><?php echo $t->partner_name;?></option>
        <?php } } ?>  
        </select>
        </div></div>
        
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-sm-4 control-label">Is RH LH</label>
        <div class="col-sm-8">
        <select name="IsRHLH4" id="IsRHLH4" class="form-control">
          <option value="0">No</option>
          <option value="1">Yes</option>
        </select>
        </div></div>
        </div></div></div></div></div></div>
        
        
        <div class="panel-group" id="accordion">
        <div class="panel panel-default">
        <div class="panel-heading">
        <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#MaterialSpecCollapse4"><span class="glyphicon ">
        </span> Material Spec &nbsp; 
        <span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>
        
        <div id="MaterialSpecCollapse4" class="collapse in">
        
        <div class="panel-body" style="background: aqua;">
        <div class="col-md-6">
        
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Spec Order</label>
        <div class="col-lg-4">
        <input type="text" id="SpecOrder41" name="SpecOrder41"  class="form-control">
        </div>
        <div class="col-lg-4">
        <input type="text" id="SpecOrder42" name="SpecOrder42"  class="form-control">
        </div></div>
        
         <div class="form-group form-group-sm" style="margin-top: -0.5em;">
         <label class="col-lg-4 control-label">Material Type</label>
         <div class="col-lg-8">
          
          <select name="MaterialType4" id="MaterialType4" class="form-control" onmousedown="if(this.options.length>5){this.size=6;}"  onchange='this.size=0;' onblur="this.size=0;">
        <option value="0">Type</option>
        <?php foreach($MaterialTypeList->result() as $t){ if($MaterialType==$t->MaterialName){ ?>
        <option style="50px" value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->MaterialName;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->MaterialName;?></option>
        <?php } } ?> 
        </select>
        
          </div> </div> 
        
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Spec</label>
        <div class="col-lg-8">
        <input type="text" id="Spec4" name="Spec4"  class="form-control">
        </div></div>
        
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Size</label>
        <div class="col-lg-2">
        <input type="text" id="Thick4" name="Thick4" value="0" class="form-control" placeholder="T">
        </div>
        <label class="col-lg-1 control-label">X</label>
        <div class="col-lg-2">
        <input type="text" id="Width4" name="Width4" value="0" class="form-control" placeholder="W">
        </div>
        <label class="col-lg-1 control-label">X</label>
        <div class="col-lg-2">
        <input type="text" id="Length4" name="Length4" value="0" class="form-control" placeholder="L">
        </div></div>
        
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Qty Part</label>
        <div class="col-lg-8">
        <input type="text" id="QtyPart4" name="QtyPart4"  class="form-control" value="1">
        </div></div>
        
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Ratio</label>
        <div class="col-lg-8">
        <input type="text" id="Ratio4" name="Ratio4"  class="form-control" value="1">
        </div></div>
        
        </div>
        
        <div class="col-md-6">
        
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Pcs / Sheet</label>
        <div class="col-lg-8">
        <input type="text" id="PcsPerSheet4" name="PcsPerSheet4" value="0" class="form-control">
        </div></div>
        
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Kg / Sheet</label>
        <div class="col-lg-8">
        <input type="text" id="KgPerSheet4" name="KgPerSheet4" value="0" class="form-control">
        </div></div>
        
        <div class="form-group form-group-sm" style="margin-top: -0.5em;">
        <label class="col-lg-4 control-label">Part Weight</label>
        <div class="col-lg-8">
        <input type="text" id="PartWeight4" name="PartWeight4" value="0" class="form-control">
        </div></div>
        
          <div class="form-group form-group-sm" style="margin-top: -0.5em;">
          <label class="col-sm-4 control-label">Is Common</label>
          <div class="col-sm-8">
          <select name="IsCommon4" id="IsCommon4" class="form-control">
         <option value="0">False</option>
         <option value="1">True</option>
          </select> </div> </div>
          
        </div>
        </div>
        </div></div></div>
        
        </form>
</div>
<div style="font-size: larger; font-weight: bold;" id="PartNoDelete2"></div>
<br /><br /><br />

    <div class="panel-footer">
        <button id="simpanRM" class="btn btn-warning" name="simpan" type="button"><i class="fa fa-save"></i>Save</button>
        <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-success"><i class="fa fa-mail-reply"></i> Back</button>
    <form class="navbar-right" role="search">
    <div class="form-group">
    <input type="text" id="DocNumDetailDelete2" name="DocNumDetailDelete2" class="form-control" readonly="true" ></div>
    </form>
    
    </div>
    
    
</div></div></div></div></div><!-- /.modal -->


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
<!--<script src="<?php echo base_url(); ?>assets/plugins/select2/select2.full.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/select2/anchor.min.js"></script>-->

<script>
  $(function () {
    //Initialize Select2 Elements SupplierIDHead
    $("#PartRM").select2({
        width : '100%', 
    });
    
    $('#SupplierID4').select2();
    $("#CustIDView").select2({width:'100%'}); $("#IDCust").select2();$("#IDProject").select2();$("#SupplierIDHead").select2();
    $("#PartTypeID").select2({containerCssClass:':all:'}); $("#SupplierID").select2({containerCssClass:':all:'});
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
<script type="text/javascript"> 
function Avatar(){
    var ItemID	    = $("#ItemID").val();
    $("#ItemID2").val(ItemID);
    $("#avatar-modal").modal('show');
			return false();
    }
</script>

<script>
            $('#Upload').click(function(e) {
                var form = $('#Upload2');
                var formdata = false;
                if(window.FormData){
                    formdata = new FormData(form[0]);
                }
                var formAction = form.attr('action');
                $("#avatar-modal").modal('hide');
                $.ajax({
                    type        : 'POST',
                    url         : '<?php echo site_url(); ?>/MBom/Upload',
                    cache       : false,
                    data        : formdata ? formdata : form.serialize(),
                    contentType : false,
                    processData : false,
                    
                    success	: function(data){
                    $("#ItemID").focus();
					$("#ItemID").click();
                        			},
			error : function(xhr, teksStatus, kesalahan) {
				$("#myModal4").modal('show');
                 $("#pesan4").text('Server tidak merespon :'+kesalahan);
			}
		});
		e.preventDefault();	
	});

        </script>



<script type="text/javascript">     
function Search(){
    
    
    
    var DocNumSearch2 	    = $("#DocNumSearch").val();
    if(DocNumSearch2.match('SAI-ASSET')){
            DocNumSearch = $("#DocNumSearch").val();
        }else{
            DocNumSearch = ('SAI-ASSET'+DocNumSearch2);
            $("#DocNumSearch").val('SAI-ASSET'+DocNumSearch2);
        }
        
    if(DocNumSearch.length==0){
      $("#myModal4").modal('show');
      $("#pesan4").text('Masukan No Barcode');  
    }else{
    $("#myModal_Search").modal("show");
	$("#ItemID3").val(DocNumSearch);
    setTimeout(function(){
					$("#ItemID3").focus();
					$("#ItemID3").click();
                    
          setTimeout(function(){
					$("#ItemID3").focus();
					$("#ItemID3").click();
				},300) ;
				},500) 
			return false(); 
	 }
    }
</script>


    <script type="text/javascript">     
function PilihEditSearch(){
    var ItemID3 	    = $("#ItemID3").val();
    $("#myModal_Search").modal("hide");
    $("#ItemID").val(ItemID3);
    setTimeout(function(){
					$("#ItemID").focus();
					$("#ItemID").click();
                    waitingDialog3.show('Processing ...', {dialogSize: 'sm', progressType: 'warning'});
          setTimeout(function(){
					$("#ItemID").focus();
					$("#ItemID").click();
				},300) ;
				},500) 
			return false();
	 
    }
</script>

    <script type="text/javascript">

function pilih2(id){
	$("#myModal_Partner").modal("hide");
	$("#SupplierID").val(id);
	$("#SupplierID").focus();
	
}
</script>
    <script type="text/javascript">

function pilih2Detail(id){
	$("#myModal_PartnerDetail").modal("hide");
	$("#SupplierIDEditDetail").val(id);
	$("#SupplierIDEditDetail").focus();
	
}
</script>

<script type="text/javascript">

function pilih22(id){
	$("#myModal_Partner2").modal("hide");
	$("#SupplierIDHead").val(id);
	$("#SupplierIDHead").focus();
	
}
</script>

<script type="text/javascript">

function pilih22Head(id){
	$("#myModal_Partner2Head").modal("hide");
	$("#SupplierIDHeadEdit").val(id);
	$("#SupplierIDHeadEdit").focus();
	
}

$('#PartTypeID2').on('change',function(){
    set_hide($(this).val());
});  

function set_hide(PartType)
{
    if(PartType.indexOf('PC')>=0){
        $('#MaterialSpecCollapse').attr("class","collapse");
        $('#ProsesOP').attr("class","collapse in");
        $('#RMHide').removeAttr('style');
        $('#accordion2').attr('style','display:none');
        $('#accordion3').removeAttr('style');
    }
    else if(PartType.indexOf('RM')>=0){
        $('#ProsesOP').attr("class","collapse");
        $('#MaterialSpecCollapse').attr("class","collapse in");
        $('#RMHide').attr('style','display:none');
        $('#accordion2').removeAttr('style');
        $('#accordion3').attr('style','display:none');
    }
    else {
        $('#ProsesOP').attr("class","collapse");
        $('#MaterialSpecCollapse').attr("class","collapse");
        $('#RMHide').removeAttr('style');
        $('#accordion2').attr('style','display:none');
        $('#accordion3').attr('style','display:none');
    } 
}

$('#BNewPart').on('click',function(){
    document.getElementById("formSubBom").reset();
    set_hide($('#PartTypeID2').val());
    $('#SupplierID').val("0").trigger('change');
    $('#PartRM').val("").trigger('change');
    
    $.ajax({
        type        : 'POST',
        url         : '<?php echo site_url(); ?>/MasterBom/GetListPartType',
        cache       : false,
        data        : "kode="+$("#SysIDDetail").val(),
        success	: function(data){
            $('#PartTypeID2').find('option').remove();
            setTimeout(function(){
                //console.log(JSON.parse(data));
                $.each(JSON.parse(data),function(i,x){
                    $('#PartTypeID2').append('<option value="'+x.id+'">'+x.text+'</option>');
                    //console.log(x);
                });
            },300);
            $('#PartNo2').focus();
        }
   });
    
});
</script>
<script> $(function () { $("#t_list_master").DataTable(); });</script>
<script src="<?php echo base_url();?>assets/master_bom.js"></script>