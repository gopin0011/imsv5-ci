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
 volume: 1.0 });
 });
</script>
  
<script type="text/javascript">
$(document).ready(function(){

$("#form-tab").click(function(){
    document.getElementById("form").reset();
    });	

$('#reload').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 tampil_data(); });

$("#Home2").click(function() {
 setTimeout(function() {
 $('#reload').click(); }, 100); });
         
tampil_data();
function tampil_data(){
var id = $("#DeptIDView").val() ;
 $('#reload').button('loading');
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterUser/ListProduct",
data	: "&id="+id,
cache	: false,
success	: function(data){
$("#tampil_data").html(data);
setTimeout(function() {
$('#reload').button('reset'); }, 1000)
} }); };

$("#DeptIDView").change(function(){
setTimeout(function() { $('#reload').click(); }, 200); });
    
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
          
    	
$("#Save").click(function(){
 var username	    = $("#username").val();
 var nama_lengkap	= $("#nama_lengkap").val();
 var level	    = $("#level").val();
 var pwd3	    = $("#pwd3").val();
 var pwd4	    = $("#pwd4").val(); 
 var string = $("#form").serialize();
 if(username.length==0){ NotifFail('Kode User Harus Di isi');   return false(); } 
 if(nama_lengkap.length==0){ NotifFail('Nama Lengkap Harus Di isi');  return false(); } 
 if(pwd3!==pwd4){ NotifFail('Department Harus Di isi');  return false(); } 
 if(level.length==0){ NotifFail('Department Harus Di isi');  return false(); } 
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterUser/Save",
 data	: string,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function(){ 
 $("#Home2").click(); },1000) 	},
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); 	} }); return false(); });

$("#RegID").load(CariProfilProduct());
$("#RegID").focus(function(e){ var isi = $(e.target).val(); CariProfilProduct(); });
$("#RegID").keyup(function(){ CariProfilProduct();		});
	
function CariProfilProduct(){
 var kode = $("#RegID").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/ref_json/InfoMasterUser",
 data	: "kode="+kode,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#username").val(data.username);
 $("#nama_lengkap").val(data.nama_lengkap);
 $("#level").val(data.IDLevel);
 $("#id_dept").val(data.id_dept);
 $("#dept").val(data.dept);
 $("#IsActive").val(data.IDBlokir);
 $("#blokir").val(data.Blokir);
 $("#MUser").val(data.MUser);
 $("#MUserIMS").val(data.MUserIMS);
 $("#MUserTR").val(data.MUserTR);
 $("#MProdMaterial").val(data.MProdMaterial);
 $("#MProdStamping").val(data.MProdStamping);
 $("#MProdWelding").val(data.MProdWelding);
 $("#MProdDelivery").val(data.MProdDelivery);
 $("#MProdStoreRoom").val(data.MProdStoreRoom);
 $("#MPartner").val(data.MPartner);
 $("#MCategory").val(data.MCategory);
 $("#MUnit").val(data.MUnit);
 $("#MProdICT").val(data.MProdICT);
 $("#MProdGA").val(data.MProdGA);
 $("#MCust").val(data.MCust);
 $("#MProduct").val(data.MProduct);
 $("#MUtility").val(data.MUtility);
 $("#TrcMaterial").val(data.TrcMaterial);
 $("#TrcStamping").val(data.TrcStamping);
 $("#TrcWelding").val(data.TrcWelding);
 $("#TrcWH").val(data.TrcWH);
 $("#TrcStoreRoom").val(data.TrcStoreRoom);
 $("#TrcGA").val(data.TrcGA);
 $("#TrcSony").val(data.TrcSony);
 $("#CanEditMaster").val(data.CanEditMaster);
 $("#TrcICT").val(data.TrcICT);
 $("#TrcGA").val(data.TrcGA);
 $("#TrcProduction").val(data.TrcProduction);
 $("#CanEditDoc").val(data.CanEditDoc);
 $("#CanEditDocAdmin").val(data.CanEditDocAdmin);
 $("#CanEditMaster").val(data.CanEditMaster);
 $("#TrcWIP").val(data.TrcWIP);  
 }  });  };
             
$.fn.capitalize = function () {
 $.each(this, function () {
 var split = this.value.split(' ');
 for (var i = 0, len = split.length; i < len; i++) {
 split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);  }
 this.value = split.join(' '); });
 return this; };
    
$("#code").keyup(function(e){
 var isi = $(e.target).val();
 $(e.target).val(isi.toUpperCase()); });
 
$("#nama_lengkap").on('keyup', function () {
    $(this).capitalize();
}).capitalize();
             
$("#Hapus").click(function(){
 var RegID	    = $("#RegID").val();
 var string = $("#form").serialize();
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterUser/Hapus_Product",
 data	: string,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function(){
 $("#Home2").click(); },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); } }); 	return false();	 });
    
 $("#Hapus_User").click(function(){
 var RegID	    = $("#RegID").val();
 var PartNo	    = $("#nama_lengkap").val();
 if(RegID.length==0){
 }else{
 $("#myModalDelete").modal('show');
 $("#pesan3").text("Anda yakin menghapus bro ?");
 $("#PartNoDelete").text(PartNo); }
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
<button type="button" class="btn btn-success" id="reload" name="reload" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; Refresh</button>

<div class="col-xs-3 pull-right">
<div class="input-group">
<span class="input-group-btn">
<button disabled="" type="button" class="btn" style="color: transparent; background: transparent;">@</button>
</span>
<select name="DeptIDView" id="DeptIDView" class="form-control col-xs-12" style="width: 100%;">
 <?php if(empty($id_dept_)){ ?>
 <option value="All">- Department -</option>
 <?php }
 foreach($l_MDept->result() as $t){ if($id_dept_==$t->Dept_Name){ ?>
 <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->Dept_Name;?></option>
 <?php }else { ?>
 <option value="<?php echo $t->id;?>"><?php echo $t->Dept_Name;?></option>
 <?php } } ?> 
 </select>
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

<form class="form-horizontal" id="form">

<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h5 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi1"><span class="glyphicon ">
</span> Data User &nbsp; 
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>

<div id="transaksi1" class="collapse in">

<div class="panel-body">
<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">UserName</label>
<div class="col-xs-8">
<input type="text" id="username" name="username"  class="form-control">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Full Name</label>
<div class="col-xs-8">
<input type="text" id="nama_lengkap" name="nama_lengkap"  class="form-control">
</div></div> 

<div class="form-group">
<label class="col-xs-4 control-label">Password</label>
<div class="col-xs-8">
<input type="password" id="pwd3" name="pwd3"  class="form-control">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Confirm</label>
<div class="col-xs-8">
<input type="password" id="pwd4" name="pwd4"  class="form-control">
</div></div> 

</div> 
<div class="col-md-6">
<div class="form-group">
        <label class="col-xs-4 control-label">Level</label>
        <div class="col-xs-4">
            <select name="level" id="level" class="form-control">
            <?php if(empty($level1)){ ?>
                <option value="">-PILIH-</option>
    <?php }
	foreach($l_MLevel->result() as $t){ if($level1==$t->level){ ?>
     <option value="<?php echo $t->id_level;?>" selected="selected"><?php echo $t->id_level;?> - <?php echo $t->level;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id_level;?>"><?php echo $t->level;?></option>
        <?php } } ?> 
    </select>
        </div>
        
        <div class="col-xs-4">
            <select name="id_dept" id="id_dept" class="form-control">
            <?php if(empty($id_dept_)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDept->result() as $t){ if($id_dept_==$t->Dept_Name){ ?>
     <option value="<?php echo $t->id;?>" selected="selected"><?php echo $t->id;?> - <?php echo $t->Dept_Name;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->id;?>"><?php echo $t->Dept_Name;?></option>
        <?php } } ?> 
    </select>
        </div>
        
    </div>
    


 <div class="form-group">
        <label class="col-xs-4 control-label">Status</label>
        <div class="col-xs-8">
            <select name="IsActive" id="IsActive" class="form-control">
            <?php if(empty($blokir)){ ?>
            <option value="1">Active</option>
            <option value="0">Non Active</option>
                 
    <?php }else{ ?>
            <option value="<?php echo $IDBlokir ;?>"><?php echo $blokir ;?></option>
            <option value="1">Active</option>
            <option value="0">Non Active</option>
    <?php } ?>
    </select>
        </div>
        </div> 
        
         <div class="form-group">
<label class="col-xs-4 control-label">ID</label>
<div class="col-xs-8">
<input type="text" id="RegID" name="RegID"  class="form-control" readonly="true">
</div></div>

</div></div></div></div></div>

<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#MainMenu" ><span  class="glyphicon ">
</span> Main Menu <span style="float: right;"><i class="fa fa-bars"></i></span></a> </h4> </div>
<div id="MainMenu" class="collapse">
<div class="panel-body">
<div class="col-md-6">

<div class="form-group">
        <label class="col-xs-4 control-label">MUser</label>
        <div class="col-xs-8">
            <select name="MUser" id="MUser" class="form-control">
            <?php if(empty($MUser)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MUser==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">Menu Product</label>
        <div class="col-xs-8">
            <select name="MProduct" id="MProduct" class="form-control">
            <?php if(empty($MProduct)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MProduct==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">Menu Utility</label>
        <div class="col-xs-8">
            <select name="MUtility" id="MUtility" class="form-control">
            <?php if(empty($MUtility)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MUtility==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>
</div>

</div></div></div></div>

<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#ADDMaster" ><span  class="glyphicon ">
</span> ADD Master <span style="float: right;"><i class="fa fa-bars"></i></span></a> </h4> </div>
<div id="ADDMaster" class="collapse">
<div class="panel-body">
<div class="col-md-6">

<div class="form-group">
        <label class="col-xs-4 control-label">MUserIMS</label>
        <div class="col-xs-8">
            <select name="MUserIMS" id="MUserIMS" class="form-control">
            <?php if(empty($MUserIMS)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MUserIMS==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">MUserTR</label>
        <div class="col-xs-8">
            <select name="MUserTR" id="MUserTR" class="form-control">
            <?php if(empty($MUserTR)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MUserTR==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">MProdMaterial</label>
        <div class="col-xs-8">
            <select name="MProdMaterial" id="MProdMaterial" class="form-control">
            <?php if(empty($MProdMaterial)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MProdMaterial==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">MProdStamping</label>
        <div class="col-xs-8">
            <select name="MProdStamping" id="MProdStamping" class="form-control">
            <?php if(empty($MProdStamping)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MProdStamping==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">MProdWelding</label>
        <div class="col-xs-8">
            <select name="MProdWelding" id="MProdWelding" class="form-control">
            <?php if(empty($MProdWelding)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MProdWelding==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">MProdDelivery</label>
        <div class="col-xs-8">
            <select name="MProdDelivery" id="MProdDelivery" class="form-control">
            <?php if(empty($MProdDelivery)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MProdDelivery==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">MProdICT</label>
        <div class="col-xs-8">
            <select name="MProdICT" id="MProdICT" class="form-control">
            <?php if(empty($MProdICT)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MProdICT==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>   
</div>

<div class="col-md-6">

<div class="form-group">
        <label class="col-xs-4 control-label">MProdGA</label>
        <div class="col-xs-8">
            <select name="MProdGA" id="MProdGA" class="form-control">
            <?php if(empty($MProdGA)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MProdGA==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div> 



<div class="form-group">
        <label class="col-xs-4 control-label">MProdStoreRoom</label>
        <div class="col-xs-8">
            <select name="MProdStoreRoom" id="MProdStoreRoom" class="form-control">
            <?php if(empty($MProdStoreRoom)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MProdStoreRoom==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">MPartner</label>
        <div class="col-xs-8">
            <select name="MPartner" id="MPartner" class="form-control">
            <?php if(empty($MPartner)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MProdStoreRoom==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">MCategory</label>
        <div class="col-xs-8">
            <select name="MCategory" id="MCategory" class="form-control">
            <?php if(empty($MCategory)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MCategory==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">MUnit</label>
        <div class="col-xs-8">
            <select name="MUnit" id="MUnit" class="form-control">
            <?php if(empty($MUnit)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MUnit==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">MCust</label>
        <div class="col-xs-8">
            <select name="MCust" id="MCust" class="form-control">
            <?php if(empty($MCust)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($MCust==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">CanEditMaster</label>
        <div class="col-xs-8">
            <select name="CanEditMaster" id="CanEditMaster" class="form-control">
            <?php if(empty($CanEditMaster)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($CanEditMaster==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div> </div></div> </div></div></div>

<div class="panel-group" id="accordion">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#Activity" ><span  class="glyphicon ">
</span> Activity <span style="float: right;"><i class="fa fa-bars"></i></span></a> </h4> </div>
<div id="Activity" class="collapse">
<div class="panel-body">
<div class="col-md-6">


<div class="form-group">
        <label class="col-xs-4 control-label">TrcMaterial</label>
        <div class="col-xs-8">
            <select name="TrcMaterial" id="TrcMaterial" class="form-control">
            <?php if(empty($TrcMaterial)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($TrcMaterial==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">TrcStamping</label>
        <div class="col-xs-8">
            <select name="TrcStamping" id="TrcStamping" class="form-control">
            <?php if(empty($TrcStamping)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($TrcStamping==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>


<div class="form-group">
        <label class="col-xs-4 control-label">TrcWelding</label>
        <div class="col-xs-8">
            <select name="TrcWelding" id="TrcWelding" class="form-control">
            <?php if(empty($TrcWelding)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($TrcWelding==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>


<div class="form-group">
        <label class="col-xs-4 control-label">TrcWareHouse</label>
        <div class="col-xs-8">
            <select name="TrcWH" id="TrcWH" class="form-control">
            <?php if(empty($TrcWareHouse)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($TrcWareHouse==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">TrcICT</label>
        <div class="col-xs-8">
            <select name="TrcICT" id="TrcICT" class="form-control">
            <?php if(empty($TrcICT)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($TrcICT==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">TrcGA</label>
        <div class="col-xs-8">
            <select name="TrcGA" id="TrcGA" class="form-control">
            <?php if(empty($TrcGA)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($TrcGA==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>      
</div>

<div class="col-md-6">

<div class="form-group">
        <label class="col-xs-4 control-label">Trc Sony</label>
        <div class="col-xs-8">
            <select name="TrcSony" id="TrcSony" class="form-control">
            <?php if(empty($TrcSony)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($TrcSony==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">Trc Production</label>
        <div class="col-xs-8">
            <select name="TrcProduction" id="TrcProduction" class="form-control">
            <?php if(empty($TrcProduction)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($TrcProduction==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>
 
       
<div class="form-group">
        <label class="col-xs-4 control-label">TrcWIP</label>
        <div class="col-xs-8">
            <select name="TrcWIP" id="TrcWIP" class="form-control">
            <?php if(empty($TrcWIP)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($TrcWIP==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">TrcStoreRoom</label>
        <div class="col-xs-8">
            <select name="TrcStoreRoom" id="TrcStoreRoom" class="form-control">
            <?php if(empty($TrcStoreRoom)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($TrcStoreRoom==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">CanEditDoc</label>
        <div class="col-xs-8">
            <select name="CanEditDoc" id="CanEditDoc" class="form-control">
            <?php if(empty($CanEditDoc)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($CanEditDoc==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>

<div class="form-group">
        <label class="col-xs-4 control-label">CanEditDocAdmin</label>
        <div class="col-xs-8">
            <select name="CanEditDocAdmin" id="CanEditDocAdmin" class="form-control">
            <?php if(empty($CanEditDocAdmin)){ ?>
                 <option value="">-PILIH-</option>
    <?php }
	foreach($l_MDetailStatus->result() as $t){ if($CanEditDocAdmin==$t->RegID){ ?>
     <option value="<?php echo $t->RegID;?>" selected="selected"><?php echo $t->Detail;?></option>
        <?php }else { ?>
        <option value="<?php echo $t->RegID;?>"><?php echo $t->Detail;?></option>
        <?php } } ?> 
    </select>
        </div>
</div>



</div>
</div></div></div></div>
</form>

 <div class="panel-footer">
 <div class="btn-group">
 <button type="button" id="Save" class="btn btn-primary" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
 <i class="fa  fa-save"></i>&nbsp; Save</button>
 <a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
 <i class="fa fa-reply"></i>&nbsp; Closed</a>
 <button type="button" name="Hapus_User" id="Hapus_User" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp; Hapus</button>        
 </div></div>
</div></div></div>
</div>

</div></div>

 <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
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
 <button type="button" name="Hapus" id="Hapus" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Ok</button>
 <form class="navbar-right" role="search">
 <div class="form-group">
 <input type="text" id="DocNumDetailDelete" name="DocNumDetailDelete" class="form-control" readonly="true" ></div>
 </form>
 </div>
 </div></div></div></div></div><!-- /.modal -->

<script type="text/javascript"> 
function Pilih(id){
 $("#RegID").val(id);
 setTimeout(function(){
 $("#RegID").focus();
 $("#RegID").click(); },700) 
 return false(); }
</script>