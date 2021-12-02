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
url		: "<?php echo site_url(); ?>/MasterUser/ListUser",
data	: "&id="+id,
cache	: false,
success	: function(data){
$("#tampil_data").html(data);
setTimeout(function() {
$('#reload').button('reset'); }, 1000)
} }); };

function DetailRole(){
var id = $("#SysID").val() ;
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/MasterUser/DetailRole",
data	: "&id="+id,
cache	: false,
success	: function(data){
$("#DetailRole").html(data);
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
 $("#Save").button('loading');
 var UserName = $("#UserName").val();
 var FullName = $("#FullName").val();
 var DeptID = $("#DeptID").val();
 var Password = $("#Password").val();
 var PasswordX = $("#PasswordX").val(); 
 var string = $("#form").serialize();
 if(UserName.length==0){ NotifFail('UserName User Harus Di isi'); setTimeout(function() { $("#Save").button('reset'); }, 500) ;  return false(); } 
 if(FullName.length==0){ NotifFail('Nama Lengkap Harus Di isi'); setTimeout(function() { $("#Save").button('reset'); }, 500) ; return false(); } 
 if(Password!==PasswordX){ NotifFail('Department Harus Di isi'); setTimeout(function() { $("#Save").button('reset'); }, 500) ; return false(); } 
 if(DeptID.length==0){ NotifFail('Department Harus Di isi'); setTimeout(function() { $("#Save").button('reset'); }, 500) ; return false(); } 
 $.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterUser/Save",
 data	: string,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function() { $("#Save").button('reset'); }, 500) ;
 	},
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); 	} }); return false(); });

$("#SysID").load(CariProfil());
$("#SysID").focus(function(e){ var isi = $(e.target).val(); CariProfil();  DetailRole();});
$("#SysID").keyup(function(){ CariProfil();	 DetailRole();	});

$("#SysID2").load(DetailRole());
$("#SysID2").focus(function(e){ var isi = $(e.target).val();   DetailRole();});
$("#SysID2").keyup(function(){  DetailRole();	});
	
function CariProfil(){
 var ID = $("#SysID").val();
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterUser/InfoMasterUser",
 data	: "&ID="+ID,
 cache	: false,
 dataType : "json",
 success	: function(data){
 $("#UserName").val(data.UserName);
 $("#FullName").val(data.FullName);
 $("#DeptID").val(data.DeptID);
 $("#IsActive").val(data.IsActive);

 }  });  };
             
$.fn.capitalize = function () {
 $.each(this, function () {
 var split = this.value.split(' ');
 for (var i = 0, len = split.length; i < len; i++) {
 split[i] = split[i].charAt(0).toUpperCase() + split[i].slice(1);  }
 this.value = split.join(' '); });
 return this; };
    
 
$("#FullName").on('keyup', function () {
    $(this).capitalize();
}).capitalize();
             
$("#UserName").on('keyup', function () {
    $(this).capitalize();
}).capitalize();

$("#Hapus").click(function(){
 var SysIDDelete	    = $("#SysIDDelete").val();
 var string = $("#form").serialize();
 $("#myModalDelete").modal('hide');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterUser/Hapus",
 data	: "&SysIDDelete="+SysIDDelete,
 cache	: false,
 success	: function(data){
 NotifSuccsess(data);
 setTimeout(function(){
 $("#Home2").click(); },1000) },
 error : function(xhr, teksStatus, kesalahan) {
 NotifFail('Server tidak merespon :'+kesalahan); } }); 	return false();	 });
    
 $("#Hapus_User").click(function(){
 var SysID	    = $("#SysID").val();
 var FullName	    = $("#FullName").val();
 $("#SysIDDelete").val(SysID);
 if(SysID.length==0){
 }else{
 $("#myModalDelete").modal('show');
 $("#Pesan").text("Anda yakin menghapus bro ?");
 $("#Description").text(FullName); }
 });

$('#Reload2').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 ActivityList(); });
      
function ActivityList(){
 var kode = "" ;
 $("#ActivityList").html("");
 $('#Reload2').button('loading');
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterUser/ActivityList",
 data	: "kode="+kode,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#Reload2').button('reset'); }, 900);
 setTimeout(function() {
 $("#ActivityList").html(data); }, 700); } }); };
  
 $("#AddActivity").click(function(){
 $("#myModalActivityList").modal('show'); $("#Reload2").click();  
 });
 

    
 });	
</script>


<div class="content-wrapper">

<div id="myTabContent" class="tab-content">

<div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
<div class="box-body"><div class="box box-success"><div class="box-body">            

<div class="pull-left" data-toggle="tooltip">
<div class="btn-group" data-toggle="btn-toggle">

<?php  $cek = $this->Role_Model->MasterUserUp() ; if($cek==1){ ?>
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
 <option value="All">All Department </option>
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
<?php  $cek = $this->Role_Model->MasterUserView() ; if($cek==1){ ?>
<div id="tampil_data"></div>
<?php } ?>
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
 <div class="btn-group">
 <button type="button" class="btn btn-primary" id="Save" name="Save" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
 <i class="fa fa-save"></i>&nbsp; Save</button>
 
 <a href="#tab_content1" id="Home2" role="tab" data-toggle="tab" aria-expanded="true" class="btn btn-success">
 <i class="fa fa-reply"></i>&nbsp; Closed</a>
 <?php  $cek = $this->Role_Model->MasterUserDel() ; if($cek==1){ ?>
 <button type="button" name="Hapus_User" id="Hapus_User" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i>&nbsp; Hapus</button>        
 <?php } ?>
 </div>
 
<a data-toggle="collapse" data-parent="#accordion" href="#transaksi1">
<span style="float: right;"><i class="fa fa-bars"></i></span></a></h5></div>
<input type="text" hidden="" id="UserID" name="UserID" /> <input hidden="" type="text"  id="NumOf" name="NumOf"/>
<div id="transaksi1" class="collapse in">

<div class="panel-body">
<div class="col-md-6">
<div class="form-group">
<label class="col-xs-4 control-label">UserName</label>
<div class="col-xs-8">
<input type="text" id="UserName" name="UserName"  class="form-control">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Full Name</label>
<div class="col-xs-8">
<input type="text" id="FullName" name="FullName"  class="form-control">
</div></div> 

<div class="form-group">
<label class="col-xs-4 control-label">Password</label>
<div class="col-xs-8">
<input type="password" id="Password" name="Password"  class="form-control">
</div></div>
 <div class="form-group">
<label class="col-xs-4 control-label">Confirm</label>
<div class="col-xs-8">
<input type="password" id="PasswordX" name="PasswordX"  class="form-control">
</div></div> 

</div> 
 <div class="col-md-6">
 <div class="form-group">
 <label class="col-xs-4 control-label">Department</label>
 <div class="col-xs-8">
 <select name="DeptID" id="DeptID" class="form-control">
 <?php if(empty($id_dept_)){ ?>
 <option value=""> Select</option>
 <?php } foreach($l_MDept->result() as $t){ if($id_dept_==$t->Dept_Name){ ?>
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
<input type="text" id="SysID" name="SysID"  class="form-control" readonly="true">
</div></div>

</div></div></div></div></div>

<div class="panel-group">
<div class="panel panel-default">
<div class="panel-heading">
<h4 class="panel-title">
<a data-toggle="collapse" data-parent="#accordion" href="#MainMenu" > <span style="float: right;"><i class="fa fa-bars"></i></span></a> </h4> 
<div class="btn-group">
<button type="button" class="btn btn-success" id="AddActivity">
<i class="fa fa-plus"></i>&nbsp; Add</button>
</div>
</div>
<div id="MainMenu" class="collapse in">
<div class="panel-body">

<div class="box-body">
<div class="box">
<div class="box-body">
<div id="DetailRole"></div>
</div></div></div>
</div></div></div></div>

</form>
</div></div></div>
</div>
</div></div>

 <div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
 <div class="modal-dialog">
 <div class="modal-content">
 <div class="modal-header">
 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
 <h4 class="modal-title">Info</h4></div><div class="modal-body"><div>
                        
 <div id="Pesan"></div>
 <div style="font-size: larger; font-weight: bold;" id="Description"></div>
 <br /><br /><br />
 <div class="panel-footer">
 <div class="btn-group">
 <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-primary"><i class="fa fa-reply"></i> Cancel</button>
 <button type="button" name="Hapus" id="Hapus" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> Delete</button>
 <form class="navbar-right" role="search">
 <div class="form-group">
 <input type="text" id="SysIDDelete" name="SysIDDelete" hidden="" readonly="true" ></div>
 </form>
 </div></div>
 </div></div></div></div></div><!-- /.modal -->
 
 
<div class="modal fade" id="myModalActivityList" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="Reload2" name="Reload2" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; List Activity</button>

</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div class="box-body">
<div class="box">
<div class="box-body">
<div id="ActivityList"></div></div></div></div>
</div> </div> </div> </div> </div> </div> </div>

<div class="modal fade" id="myModalUserGrpFlow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog modal-lg"> <div class="modal-content"> <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<button type="button" class="btn btn-success" id="Reload3" name="Reload3" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
<i class="fa fa-refresh"></i>&nbsp; UserGrpFlow</button>

</div><div class="modal-body"><div>
<div class="row"><div class="panel-body">
<div class="box-body">
<div class="box">
<div class="box-body">
<div id="UserGrpFlow"></div></div></div></div>
</div> </div> </div> </div> </div> </div> </div>

<script type="text/javascript"> 
function Select(ID){
 $("#SysID").val(ID);
 $("#SysID2").val(ID);
 setTimeout(function(){
 $("#SysID").focus();
 $("#SysID").click(); },700) 
 return false(); }
 
function ActionUpdateRole(SysID, NumOf, UpData){
$("#Update_"+NumOf).button('loading');
var X = UpData ;
if(X==1){var UpDataX = 0 ;}
if(X==0){var UpDataX = 1 ;}
$.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterUser/UpdateRoleUp",
 data	: "&SysID="+SysID+"&NumOf="+NumOf+"&UpDataX="+UpDataX,
 cache	: false,
 success	: function(data){
 DetailRole2();
 setTimeout(function() {  $("#Update_"+NumOf).button('reset'); }, 200) ;
 	} }); return false(); };
    
function ActionDeleteRole(SysID, NumOf, UpData){
$("#Delete_"+NumOf).button('loading');
var X = UpData ;
if(X==1){var UpDataX = 0 ;}
if(X==0){var UpDataX = 1 ;}

$.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterUser/UpdateRoleDel",
 data	: "&SysID="+SysID+"&NumOf="+NumOf+"&UpDataX="+UpDataX,
 cache	: false,
 success	: function(data){
    DetailRole2();
 setTimeout(function() {  $("#Delete_"+NumOf).button('reset'); }, 200) ;
 	} }); return false(); };
    
function ActionReturnRole(SysID, NumOf, UpData){
$("#Return_"+NumOf).button('loading');
var X = UpData ;
if(X==1){var UpDataX = 0 ;}
if(X==0){var UpDataX = 1 ;}

$.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterUser/UpdateRoleRet",
 data	: "&SysID="+SysID+"&NumOf="+NumOf+"&UpDataX="+UpDataX,
 cache	: false,
 success	: function(data){
 DetailRole2();
 setTimeout(function() {  $("#Return_"+NumOf).button('reset'); }, 200) ;

 	} }); return false(); };
    
function ActionJurnalRole(SysID, NumOf, UpData){
$("#Jurnal_"+NumOf).button('loading');
var X = UpData ;
if(X==1){var UpDataX = 0 ;}
if(X==0){var UpDataX = 1 ;}

$.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterUser/UpdateRoleJurnal",
 data	: "&SysID="+SysID+"&NumOf="+NumOf+"&UpDataX="+UpDataX,
 cache	: false,
 success	: function(data){
 DetailRole2();
 setTimeout(function() {  $("#Jurnal_"+NumOf).button('reset'); }, 200) ;
 	} }); return false(); };

function ActionDelete(SysID, NumOf){
$("#Del_"+NumOf).button('loading');
$.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterUser/DeleteRole",
 data	: "&SysID="+SysID+"&NumOf="+NumOf,
 cache	: false,
 success	: function(data){

 setTimeout(function() {  DetailRole2();  }, 500) ;
 	} }); return false(); };
         
function AddActList(SysID){
$("#AddActivity").button('loading');
$("#myModalActivityList").modal('hide');
var SysID2 = $("#SysID").val() ;
$.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterUser/AddActList",
 data	: "&SysID="+SysID+"&SysID2="+SysID2,
 cache	: false,
 success	: function(data){
 DetailRole2();
 setTimeout(function() {  $("#AddActivity").button('reset'); }, 500) ;
 	} }); return false(); };
         

 

    
 $('#Reload3').on('click', function() {
 var $this = $(this);
 $this.button('loading');
 ListUserGrpFlow(); });
      
function ListUserGrpFlow(){
 $("#UserGrpFlow").html("");
 $('#Reload3').button('loading');
 var id = "";
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterUser/ListUserGrpFlow",
 data	: "&id="+id,
 cache	: false,
 success	: function(data){
 setTimeout(function() {
 $('#Reload3').button('reset'); }, 900);
 setTimeout(function() {
 $("#UserGrpFlow").html(data); }, 700); } }); };
 
 function UserGrpFlowAdd(SysID){
 var UserID = $("#UserID").val(); 
 var NumOf = $("#NumOf").val();
$("#myModalUserGrpFlow").modal('hide');
$.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/MasterUser/AddUserGrpFlow",
 data	: "&SysID="+SysID+"&UserID="+UserID+"&NumOf="+NumOf,
 cache	: false,
 success	: function(data){
 setTimeout(function() {  DetailRole2(); }, 500) ;

 	} }); return false(); };
    
 function myModalUserGrpFlow(UserID, NumOf){
 $("#UserID").val(UserID); 
 $("#NumOf").val(NumOf);
 $("#Flow_"+NumOf).button('loading');
 $("#myModalUserGrpFlow").modal('show'); $("#Reload3").click();  
 };
 
 function DetailRole2(){
 var id = $("#SysID").val() ;
 $.ajax({
 type	: 'POST',
 url		: "<?php echo site_url(); ?>/MasterUser/DetailRole",
 data	: "&id="+id,
 cache	: false,
 success	: function(data){
 $("#DetailRole").html(data);
 } }); };
</script>
