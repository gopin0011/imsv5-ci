 <title>Trans G5 | Log in</title>
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">   
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
 <link href="<?php echo base_url(); ?>assets/css/custom.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/notify/animate.css" rel="stylesheet"> 
 <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>  
 
 <script type="text/javascript">
 $(document).ready(function(){

welcome();

function welcome(){
var keyWelcome = $("#keyWelcome").val();
if(keyWelcome.length>0){
 setTimeout(function(){
 $.notify(keyWelcome, {
 animate: {
 enter: 'animated bounceInDown',
 exit: 'animated bounceOutUp' }
});
},200)
 } };
    
$("#SignUp").click(function(){
var Fullname_SignUp = $("#Fullname_SignUp").val();
var Username_SignUp = $("#Username_SignUp").val();
var Password_SignUp1 = $("#Password_SignUp1").val();
var Password_SignUp2 = $("#Password_SignUp2").val();
var Email_SignUp = $("#Email_SignUp").val();
var string = $("#Form_SignUp").serialize();
if(Fullname_SignUp.length==0){ 
 $.notify("Full Name harus diisi", {
 animate: {
 enter: 'animated bounceInDown',
 exit: 'animated bounceOutUp' }
});  return false(); }

if(Username_SignUp.length==0){ 
 $.notify("Username harus diisi", {
 animate: {
 enter: 'animated bounceInDown',
 exit: 'animated bounceOutUp' }
});  return false(); }

if(Password_SignUp1.length==0){ 
 $.notify("Password harus di isi !!!", {
 animate: {
 enter: 'animated bounceInDown',
 exit: 'animated bounceOutUp' }
});  return false(); }

if(Password_SignUp1!==Password_SignUp2){ 
 $.notify("Password tidak match !!!", {
 animate: {
 enter: 'animated bounceInDown',
 exit: 'animated bounceOutUp' }
});  return false(); }

if(Email_SignUp.length==0){ 
 $.notify("Email harus di isi !!!", {
 animate: {
 enter: 'animated bounceInDown',
 exit: 'animated bounceOutUp' }
});  return false(); }

if(!Email_SignUp.match('@summitadyawinsa.co.id')){ 
 $.notify("Hanya email SAI yang di perbolehkan ", {
 animate: {
 enter: 'animated bounceInDown',
 exit: 'animated bounceOutUp' }
});  return false(); }



$.ajax({
 type	: 'POST',
 url	: "<?php echo site_url(); ?>/Welcome/SignUp",
 data	: string,
 cache	: false,
 success	: function(data){
 $.notify(data, {
 animate: {
 enter: 'animated bounceInDown',
 exit: 'animated bounceOutUp' }
});  	},
 error : function(xhr, teksStatus, kesalahan) {
 $.notify(kesalahan, {
 animate: {
 enter: 'animated bounceInDown',
 exit: 'animated bounceOutUp' }
}); 	} }); return false(); });
 

});
</script> 
  
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Nunito');
@import url('https://fonts.googleapis.com/css?family=Poiret+One');

body, html {
	height: 100%;
	background-repeat: no-repeat;    /*background-image: linear-gradient(rgb(12, 97, 33),rgb(104, 145, 162));*/
	background:url('<?php echo base_url(); ?>images/Back.png') fixed;
	position: relative;
}
#login-box {
	position: absolute;
	top: 40px;
	left: 50%;
	transform: translateX(-50%);
	width: 350px;
	margin: 0 auto;
	background: white;
	min-height: 250px;
	padding: 20px;
	z-index: 9999;
}
#login-box .logo .logo-caption {
	font-family: 'Poiret One', cursive;
	color: red;
	text-align: center;
	margin-bottom: 0px;
}
#login-box .logo .tweak {
	color: #ff5252;
}
#login-box .controls {
	padding-top: 30px;
}
#login-box .controls input {
	border-radius: 0px;
	background: rgb(98, 96, 96);
	border: 0px;
	color: white;
	font-family: 'Nunito', sans-serif;
}
#login-box .controls input:focus {
	box-shadow: none;
}
#login-box .controls input:first-child {
	border-top-left-radius: 12px;
	border-top-right-radius: 12px;
}
#login-box .controls input:last-child {
	border-bottom-left-radius: 12px;
	border-bottom-right-radius: 12px;
}
#login-box button.btn-custom {
	border-radius: 2px;
	margin-top: 8px;
	background:#ff5252;
	border-color: rgba(48, 46, 45, 1);
	color: white;
	font-family: 'Nunito', sans-serif;
}
#login-box button.btn-custom:hover{
	-webkit-transition: all 500ms ease;
	-moz-transition: all 500ms ease;
	-ms-transition: all 500ms ease;
	-o-transition: all 500ms ease;
	transition: all 500ms ease;
	background: rgba(48, 46, 45, 1);
	border-color: #ff5252;
}
#particles-js{
  	width: 100%;
  	height: 100%;
  	background-size: cover;
  	background-position: 50% 50%;
  	position: fixed;
  	top: 0px;
  	z-index:1;
}
    </style>




 <div id="login-box" class="login-box">
 <div class="logo">
 <h1 class="logo-caption"><span class="tweak">Sign</span> Up</h1>
 </div><!-- /.logo -->
		
 <div class="login-logo">
 <a href="<?php echo site_url(); ?>"><b>IMS</b>V5</a>
 </div> 
 <form id="Form_SignUp" name="Form_SignUp" >
 <div class="form-group has-feedback">
 <input type="text" id="Fullname_SignUp" name="Fullname_SignUp" class="form-control" placeholder="Full Name" required="">
 <span class="glyphicon glyphicon-user form-control-feedback"></span>
 </div>
 <div class="form-group has-feedback">
 <input type="text" id="Username_SignUp" name="Username_SignUp" class="form-control" placeholder="Username" required="">
 <span class="glyphicon glyphicon-user form-control-feedback"></span>
 </div>
 <div class="form-group has-feedback">
 <input type="password" id="Password_SignUp1" name="Password_SignUp1" class="form-control" placeholder="Password" required="">
 <span class="glyphicon glyphicon-lock form-control-feedback"></span>
 </div>

 <div class="form-group has-feedback">
 <input type="password" id="Password_SignUp2" name="Password_SignUp2" class="form-control" placeholder="Password" required="">
 <span class="glyphicon glyphicon-lock form-control-feedback"></span>
 </div>
 <div class="form-group has-feedback">
 <input type="email" id="Email_SignUp" name="Email_SignUp" class="form-control" placeholder="Email" required="">
 <span class="fa fa-envelope form-control-feedback"></span>
 </div>
</form>
 <div class="controls">
 <button type="button" id="SignUp" name="SignUp" class="btn btn-success btn-block btn-flat">Sign Up</button>
 </div> 
 </div>



<script src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>  
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/notify/bootstrap-notify.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/notify/bootstrap-notify.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/notify/Gruntfile.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/notify/package.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/notify/test_meteor.min.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/nprogress.js"></script>
 
 


 
