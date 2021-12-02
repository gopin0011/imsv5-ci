 <title>Login</title>

 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_new/bootstrap.min.css">    
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/login_new/css/style.css">
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
 

<style>
 body{
 background: url('<?php echo base_url(); ?>images/Back.png') fixed;
 background-size: cover;
 padding: 0;
 margin: 0; }
</style>
    

  

 <div class="login-wrap">
 <div class="login-html">
 <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label style="cursor: pointer;" for="tab-1" id="welcome" class="tab">Sign In</label>
 <input id="tab-2" type="radio" name="tab" class="sign-up"><label style="cursor: pointer;" for="tab-2" class="tab">Sign Up</label>
 
  
  
 <div class="login-form">
 
 <form role="form" action="<?php echo site_url('welcome/proses');?>" method="post">
 <div class="sign-in-htm">
 <input id="keyWelcome" name="keyWelcome" value="<?php echo $welcome ; ?>" type="text" hidden="">
 <div class="group">
 <label for="user" class="label">Username</label>
 <input id="username" name="username" value="<?php echo $Username ; ?>" type="text" class="input">
 </div>
 <div class="group">
 <label for="pass" class="label">Password</label>
 <input id="password" name="password" type="password" class="input" data-type="password">
 </div>
 <input type="text" hidden="" name="ip" id="ip">
 <?php echo $this->session->flashdata('message');?></span>
 <br /><br />
 <div class="group">
<button type="submit" class="button" id="Login" name="Login" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">Sign In</button>

 </div>
 <div class="hr"></div>
 <div class="foot-lnk">
<label>PT SUMMIT ADYAWINSA INDONESIA<br />IMS &copy; 2014 - 2017 By ICT</label>
 </div></div>
 </form>
 
 <form id="Form_SignUp" name="Form_SignUp" >
 <div class="sign-up-htm">
 <div class="group">
 <label for="user" class="label">Full Name</label>
 <input type="text" id="Fullname_SignUp" name="Fullname_SignUp" onchange="Fullname=this.value;" class="input" required="">
 </div>
 <div class="group">
 <label for="user" class="label">Username</label>
 <input type="text" id="Username_SignUp" name="Username_SignUp" class="input" required="">
 </div>

 <div class="group">
 <label for="pass" class="label">Password</label>
 <input type="password" id="Password_SignUp1" name="Password_SignUp1" class="input" data-type="password" required="">
 </div>
 <div class="group">
 <label for="pass" class="label">Repeat Password</label>
 <input type="password" id="Password_SignUp2" name="Password_SignUp2" class="input" data-type="password" required="">
 </div>
 <div class="group">
 <label for="email" class="label">Email Address</label>
 <input type="email" id="Email_SignUp" name="Email_SignUp" class="input" data-type="email" required="">
 </div>
 <br /> </form>
 <div class="group">
 <button type="button" id="SignUp" name="SignUp" class="button">Sign Up</button>
 </div>
 <div class="hr"></div>
 <div class="foot-lnk">
 <label for="tab-1">Already Member?</a>
 </div> </div>
 </div></div>
 </div>    
 

                
 <script src="<?php echo base_url(); ?>assets/js/pace/pace.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/moment/moment.min.js"></script>  
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/notify/bootstrap-notify.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/notify/bootstrap-notify.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/notify/Gruntfile.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/notify/package.min.js"></script>
 <script type="text/javascript" src="<?php echo base_url(); ?>assets/notify/test_meteor.min.js"></script>



 <script src="<?php echo base_url(); ?>assets/js/nprogress.js"></script>
 <script type="text/javascript">
function getUserIP(onNewIP) { //  onNewIp - your listener function for new IPs
 var myPeerConnection = window.RTCPeerConnection || window.mozRTCPeerConnection || window.webkitRTCPeerConnection;
 var pc = new myPeerConnection({
 iceServers: []
 }),
 noop = function() {},
 localIPs = {},
 ipRegex = /([0-9]{1,3}(\.[0-9]{1,3}){3}|[a-f0-9]{1,4}(:[a-f0-9]{1,4}){7})/g,
 key;

 function iterateIP(ip) {
 if (!localIPs[ip]) onNewIP(ip);
 localIPs[ip] = true;
 }
 pc.createDataChannel("");
  pc.createOffer(function(sdp) {
 sdp.sdp.split('\n').forEach(function(line) {
 if (line.indexOf('candidate') < 0) return;
 line.match(ipRegex).forEach(iterateIP);
 });
 pc.setLocalDescription(sdp, noop, noop);
 }, noop); 
 pc.onicecandidate = function(ice) {
 if (!ice || !ice.candidate || !ice.candidate.candidate || !ice.candidate.candidate.match(ipRegex)) return;
 ice.candidate.candidate.match(ipRegex).forEach(iterateIP);
 };
 }
 getUserIP(function(ip){
 $("#ip").val(ip);
 });


</script>


