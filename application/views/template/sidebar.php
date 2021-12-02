<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script>
get_notif();
function get_notif()
{
	$.ajax({
        type	: 'POST',
        url		: "<?php echo site_url(); ?>/ref_json/GetNotif",
        data	: "kode=",
        cache	: false,
        success	: function(data)
        {
            var d = JSON.parse(data);
            $('#notif_mkt_confirm').html(d.Waiting_MKT);
            $('#notif_confirm').html(d.Waiting_WH);
        } 
    });
}
setInterval(function (){
    get_notif();
}, 15000);
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

function Menu_active(Url,HeadMenuActive,MenuActive,IconActive){
var IPX = $("#ip").val();
$.ajax({
type	: 'POST',
url		: "<?php echo site_url(); ?>/home/MenuActive",
data	: "&Url="+Url+"&HeadMenuActive="+HeadMenuActive+"&MenuActive="+MenuActive+"&IconActive="+IconActive+"&IPX="+IPX,
cache	: false,
success	: function(data){
    
} }); };
 </script>
<script>
$("#simpanFoto").click(function(){
$("#myModalEditFotoUser").modal('hide');
});
 </script>
 
<?php 
 $CekDB =$this->app_model->MenuActive_button($this->session->userdata('RegID'));
 $cek = $this->session->userdata('UserName');
 if(!empty($cek)){
 $CekDBX1 =$this->app_model->MenuActive_button($this->session->userdata('RegID')); 
 foreach($CekDBX1->result() as $row) {
 
 $HeadMenuActive = $row->HeadMenuActive ;
 $MenuActive = $row->MenuActive ;
 $IconActive = $row->IconActive ;
 
 if($HeadMenuActive=='Forum_H'){$Forum_H = 'active';}else{$Forum_H = '' ;}
 if($MenuActive=='Forum'){$Forum = 'active' ;}else{$Forum = '' ;}
 if($IconActive=='Forum_icon'){$Forum_icon = 'fa fa-circle' ;}else{$Forum_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='DailyGAP'){$DailyGAP = 'active' ;}else{$DailyGAP = '' ;}
 if($IconActive=='DailyGAP_icon'){$DailyGAP_icon = 'fa fa-circle' ;}else{$DailyGAP_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Tracer'){$Tracer = 'active' ;}else{$Tracer = '' ;}
 if($IconActive=='Tracer_icon'){$Tracer_icon = 'fa fa-circle' ;}else{$Tracer_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='Utility_H'){$Utility_H = 'active';}else{$Utility_H = '' ;}
 if($MenuActive=='UtilityUser'){$UtilityUser = 'active' ;}else{$UtilityUser = '' ;}
 if($IconActive=='UtilityUser_icon'){$UtilityUser_icon = 'fa fa-circle' ;}else{$UtilityUser_icon = 'fa fa-circle-o' ;}

 if($MenuActive=='UtilityUserTR'){$UtilityUserTR = 'active' ;}else{$UtilityUserTR = '' ;}
 if($IconActive=='UtilityUserTR_icon'){$UtilityUserTR_icon = 'fa fa-circle' ;}else{$UtilityUserTR_icon = 'fa fa-circle-o' ;} 
 if($MenuActive=='UtilityPartner'){$UtilityPartner = 'active' ;}else{$UtilityPartner = '' ;}
 if($IconActive=='UtilityPartner_icon'){$UtilityPartner_icon = 'fa fa-circle' ;}else{$UtilityPartner_icon = 'fa fa-circle-o' ;} 
 if($MenuActive=='UtilityPartner2'){$UtilityPartner2 = 'active' ;}else{$UtilityPartner2 = '' ;}
 if($IconActive=='UtilityPartner2_icon'){$UtilityPartner2_icon = 'fa fa-circle' ;}else{$UtilityPartner2_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='UtilityCust'){$UtilityCust = 'active' ;}else{$UtilityCust = '' ;}
 if($IconActive=='UtilityCust_icon'){$UtilityCust_icon = 'fa fa-circle' ;}else{$UtilityCust_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='UtilityUnit'){$UtilityUnit = 'active' ;}else{$UtilityUnit = '' ;}
 if($IconActive=='UtilityUnit_icon'){$UtilityUnit_icon = 'fa fa-circle' ;}else{$UtilityUnit_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='UtilityCategory'){$UtilityCategory = 'active' ;}else{$UtilityCategory = '' ;}
 if($IconActive=='UtilityCategory_icon'){$UtilityCategory_icon = 'fa fa-circle' ;}else{$UtilityCategory_icon = 'fa fa-circle-o' ;} 
 if($MenuActive=='UtilityAsset'){$UtilityAsset = 'active' ;}else{$UtilityAsset = '' ;}
 if($IconActive=='UtilityAsset_icon'){$UtilityAsset_icon = 'fa fa-circle' ;}else{$UtilityAsset_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='Master_H'){$Master_H = 'active';}else{$Master_H = '' ;}
 if($MenuActive=='MasterBom'){$MasterBom = 'active' ;}else{$MasterBom = '' ;}
 if($IconActive=='MasterBom_icon'){$MasterBom_icon = 'fa fa-circle' ;}else{$MasterBom_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdMat'){$MasterProdMat = 'active' ;}else{$MasterProdMat = '' ;}
 if($IconActive=='MasterProdMat_icon'){$MasterProdMat_icon = 'fa fa-circle' ;}else{$MasterProdMat_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdStamping'){$MasterProdStamping = 'active' ;}else{$MasterProdStamping = '' ;}
 if($IconActive=='MasterProdStamping_icon'){$MasterProdStamping_icon = 'fa fa-circle' ;}else{$MasterProdStamping_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdWeld'){$MasterProdWeld = 'active' ;}else{$MasterProdWeld = '' ;}
 if($IconActive=='MasterProdWeld_icon'){$MasterProdWeld_icon = 'fa fa-circle' ;}else{$MasterProdWeld_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdDelivery'){$MasterProdDelivery = 'active' ;}else{$MasterProdDelivery = '' ;}
 if($IconActive=='MasterProdDelivery_icon'){$MasterProdDelivery_icon = 'fa fa-circle' ;}else{$MasterProdDelivery_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdStoreRoom'){$MasterProdStoreRoom = 'active' ;}else{$MasterProdStoreRoom = '' ;}
 if($IconActive=='MasterProdStoreRoom_icon'){$MasterProdStoreRoom_icon = 'fa fa-circle' ;}else{$MasterProdStoreRoom_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdGA'){$MasterProdGA = 'active' ;}else{$MasterProdGA = '' ;}
 if($IconActive=='MasterProdGA_icon'){$MasterProdGA_icon = 'fa fa-circle' ;}else{$MasterProdGA_icon = 'fa fa-circle-o' ;}
  if($MenuActive=='MasterProdWip'){$MasterProdWip = 'active' ;}else{$MasterProdWip = '' ;}
 if($IconActive=='MasterProdWip_icon'){$MasterProdWip_icon = 'fa fa-circle' ;}else{$MasterProdWip_icon = 'fa fa-circle-o' ;}
 
  // erfin //
 if($MenuActive=='MasterProdICT'){$MasterProdICT = 'active' ;}else{$MasterProdICT = '' ;}
 if($IconActive=='MasterProdICT_icon'){$MasterProdICT_icon = 'fa fa-circle' ;}else{$MasterProdICT_icon = 'fa fa-circle-o' ;}
 
 if($MenuActive=='MasterSubcon'){$MasterSubcon = 'active' ;}else{$MasterSubcon = '' ;}
 if($IconActive=='MasterSubcon_icon'){$MasterSubcon_icon = 'fa fa-circle' ;}else{$MasterSubcon_icon = 'fa fa-circle-o' ;}
 
  if($HeadMenuActive=='Sony_H'){$Sony_H = 'active';}else{$Sony_H = '' ;}
     if($MenuActive=='SCHProduction'){$SCHProduction = 'active' ;}else{$SCHProduction = '' ;}
 if($IconActive=='SCHProduction_icon'){$SCHProduction_icon = 'fa fa-circle' ;}else{$SCHProduction_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Sony_in'){$Sony_in = 'active' ;}else{$Sony_in = '' ;}
 if($IconActive=='Sony_in_icon'){$Sony_in_icon = 'fa fa-circle' ;}else{$Sony_in_icon = 'fa fa-circle-o' ;}
  if($MenuActive=='Sony_out'){$Sony_out = 'active' ;}else{$Sony_out = '' ;}
 if($IconActive=='Sony_out_icon'){$Sony_out_icon = 'fa fa-circle' ;}else{$Sony_out_icon = 'fa fa-circle-o' ;}
    if($MenuActive=='Sony_Del'){$Sony_Del = 'active' ;}else{$Sony_Del = '' ;}
 if($IconActive=='Sony_Del_icon'){$Sony_Del_icon = 'fa fa-circle' ;}else{$Sony_Del_icon = 'fa fa-circle-o' ;}
  if($MenuActive=='Sony_ret'){$Sony_ret = 'active' ;}else{$Sony_ret = '' ;}
 if($IconActive=='Sony_ret_icon'){$Sony_ret_icon = 'fa fa-circle' ;}else{$Sony_ret_icon = 'fa fa-circle-o' ;}
  if($MenuActive=='Sony_report'){$Sony_report = 'active' ;}else{$Sony_report = '' ;}
 if($IconActive=='Sony_report_icon'){$Sony_report_icon = 'fa fa-circle' ;}else{$Sony_report_icon = 'fa fa-circle-o' ;}

  if($HeadMenuActive=='Administration_H'){$Administration_H = 'active';}else{$Administration_H = '' ;}
 if($MenuActive=='TTI'){$TTI = 'active' ;}else{$TTI = '' ;}
 if($IconActive=='TTI_icon'){$TTI_icon = 'fa fa-circle' ;}else{$TTI_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='Material_H'){$Material_H = 'active';}else{$Material_H = '' ;}
 if($MenuActive=='Material_in'){$Material_in = 'active' ;}else{$Material_in = '' ;}
 if($IconActive=='Material_in_icon'){$Material_in_icon = 'fa fa-circle' ;}else{$Material_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Material_out'){$Material_out = 'active' ;}else{$Material_out = '' ;}
 if($IconActive=='Material_out_icon'){$Material_out_icon = 'fa fa-circle' ;}else{$Material_out_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Material_return'){$Material_return = 'active' ;}else{$Material_return = '' ;}
 if($IconActive=='Material_return_icon'){$Material_return_icon = 'fa fa-circle' ;}else{$Material_return_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Material_report'){$Material_report = 'active' ;}else{$Material_report = '' ;}
 if($IconActive=='Material_report_icon'){$Material_report_icon = 'fa fa-circle' ;}else{$Material_report_icon = 'fa fa-circle-o' ;}

 if($HeadMenuActive=='Mtrl_new_H'){$Mtrl_new_H = 'active';}else{$Mtrl_new_H = '' ;}
 if($MenuActive=='Mtrl_in_new'){$Mtrl_in_new = 'active' ;}else{$Mtrl_in_new = '' ;}
 if($IconActive=='Mtrl_in_new_icon'){$Mtrl_in_new_icon = 'fa fa-circle' ;}else{$Mtrl_in_new_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Mtrl_out_new'){$Mtrl_out_new = 'active' ;}else{$Mtrl_out_new = '' ;}
 if($IconActive=='Mtrl_out_new_icon'){$Mtrl_out_new_icon = 'fa fa-circle' ;}else{$Mtrl_out_new_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Mtrl_return_new'){$Mtrl_return_new = 'active' ;}else{$Mtrl_return_new = '' ;}
 if($IconActive=='Mtrl_return_new_icon'){$Mtrl_return_new_icon = 'fa fa-circle' ;}else{$Mtrl_return_new_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Mtrl_report_new'){$Mtrl_report_new = 'active' ;}else{$Mtrl_report_new = '' ;}
 if($IconActive=='Mtrl_report_new_icon'){$Mtrl_report_new_icon = 'fa fa-circle' ;}else{$Mtrl_report_new_icon = 'fa fa-circle-o' ;}
 

 if($HeadMenuActive=='StoreRoom_H'){$StoreRoom_H = 'active';}else{$StoreRoom_H = '' ;}
 if($MenuActive=='StoreRoom_in'){$StoreRoom_in = 'active' ;}else{$StoreRoom_in = '' ;}
 if($IconActive=='StoreRoom_in_icon'){$StoreRoom_in_icon = 'fa fa-circle' ;}else{$StoreRoom_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='StoreRoom_out'){$StoreRoom_out = 'active' ;}else{$StoreRoom_out = '' ;}
 if($IconActive=='StoreRoom_out_icon'){$StoreRoom_out_icon = 'fa fa-circle' ;}else{$StoreRoom_out_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='StoreRoom_report'){$StoreRoom_report = 'active' ;}else{$StoreRoom_report = '' ;}
 if($IconActive=='StoreRoom_report_icon'){$StoreRoom_report_icon = 'fa fa-circle' ;}else{$StoreRoom_report_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='GeneralAfair_H'){$GeneralAfair_H = 'active';}else{$GeneralAfair_H = '' ;}
 if($MenuActive=='GeneralAfair_in'){$GeneralAfair_in = 'active' ;}else{$GeneralAfair_in = '' ;}
 if($IconActive=='GeneralAfair_in_icon'){$GeneralAfair_in_icon = 'fa fa-circle' ;}else{$GeneralAfair_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='GeneralAfair_out'){$GeneralAfair_out = 'active' ;}else{$GeneralAfair_out = '' ;}
 if($IconActive=='GeneralAfair_out_icon'){$GeneralAfair_out_icon = 'fa fa-circle' ;}else{$GeneralAfair_out_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='GeneralAfair_report'){$GeneralAfair_report = 'active' ;}else{$GeneralAfair_report = '' ;}
 if($IconActive=='GeneralAfair_report_icon'){$GeneralAfair_report_icon = 'fa fa-circle' ;}else{$GeneralAfair_report_icon = 'fa fa-circle-o' ;}

 if($HeadMenuActive=='FinishGood_H'){$FinishGood_H = 'active';}else{$FinishGood_H = '' ;}
 if($MenuActive=='FinishGood_in'){$FinishGood_in = 'active' ;}else{$FinishGood_in = '' ;}
 if($IconActive=='FinishGood_in_icon'){$FinishGood_in_icon = 'fa fa-circle' ;}else{$FinishGood_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='FinishGood_out'){$FinishGood_out = 'active' ;}else{$FinishGood_out = '' ;}
 if($IconActive=='FinishGood_out_icon'){$FinishGood_out_icon = 'fa fa-circle' ;}else{$FinishGood_out_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='FinishGood_report'){$FinishGood_report = 'active' ;}else{$FinishGood_report = '' ;}
 if($IconActive=='FinishGood_report_icon'){$FinishGood_report_icon = 'fa fa-circle' ;}else{$FinishGood_report_icon = 'fa fa-circle-o' ;}

 if($HeadMenuActive=='Wip_H'){$Wip_H = 'active';}else{$Wip_H = '' ;}
 if($MenuActive=='Wip_in'){$Wip_in = 'active' ;}else{$Wip_in = '' ;}
 if($IconActive=='Wip_in_icon'){$Wip_in_icon = 'fa fa-circle' ;}else{$Wip_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Wip_out'){$Wip_out = 'active' ;}else{$Wip_out = '' ;}
 if($IconActive=='Wip_out_icon'){$Wip_out_icon = 'fa fa-circle' ;}else{$Wip_out_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Wip_report'){$Wip_report = 'active' ;}else{$Wip_report = '' ;}
 if($IconActive=='Wip_report_icon'){$Wip_report_icon = 'fa fa-circle' ;}else{$Wip_report_icon = 'fa fa-circle-o' ;} 

 if($HeadMenuActive=='Production_H'){$Production_H = 'active';}else{$Production_H = '' ;}
 if($MenuActive=='ProductionSTP_in'){$ProductionSTP_in = 'active' ;}else{$ProductionSTP_in = '' ;}
 if($IconActive=='ProductionSTP_in_icon'){$ProductionSTP_in_icon = 'fa fa-circle' ;}else{$ProductionSTP_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='ProductionNonSTP_in'){$ProductionNonSTP_in = 'active' ;}else{$ProductionNonSTP_in = '' ;}
 if($IconActive=='ProductionNonSTP_in_icon'){$ProductionNonSTP_in_icon = 'fa fa-circle' ;}else{$ProductionNonSTP_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='ProductionReportDies'){$ProductionReportDies = 'active' ;}else{$ProductionReportDies = '' ;}
 if($IconActive=='ProductionReportDies_icon'){$ProductionReportDies_icon = 'fa fa-circle' ;}else{$ProductionReportDies_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='BPFG_H'){$BPFG_H = 'active';}else{$BPFG_H = '' ;}
 if($MenuActive=='BPFG_in'){$BPFG_in = 'active' ;}else{$BPFG_in = '' ;}
 if($IconActive=='BPFG_in_icon'){$BPFG_in_icon = 'fa fa-circle' ;}else{$BPFG_in_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='Ict_H'){$Ict_H = 'active';}else{$Ict_H = '' ;}
 if($MenuActive=='Ict_in'){$Ict_in = 'active' ;}else{$Ict_in = '' ;}
 if($IconActive=='Ict_in_icon'){$Ict_in_icon = 'fa fa-circle' ;}else{$Ict_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Ict_out'){$Ict_out = 'active' ;}else{$Ict_out = '' ;}
 if($IconActive=='Ict_out_icon'){$Ict_out_icon = 'fa fa-circle' ;}else{$Ict_out_icon = 'fa fa-circle-o' ;}
 
 if($MenuActive=='Ict_report'){$Ict_report = 'active' ;}else{$Ict_report = '' ;}
 if($IconActive=='Ict_report_icon'){$Ict_report_icon = 'fa fa-circle' ;}else{$Ict_report_icon = 'fa fa-circle-o' ;} 
 
 if($MenuActive=='CreateBPFG'){$CreateBPFG = 'active' ;}else{$CreateBPFG = '' ;}
 if($IconActive=='CreateBPFG_icon'){$CreateBPFG_icon = 'fa fa-circle' ;}else{$CreateBPFG_icon = 'fa fa-circle-o' ;} 
 
  if($HeadMenuActive=='POCust_H'){$POCust_H = 'active';}else{$POCust_H = '' ;}
 if($MenuActive=='POCust'){$POCust = 'active' ;}else{$POCust = '' ;}
 if($IconActive=='POCust_icon'){$POCust_icon = 'fa fa-circle' ;}else{$POCust_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='SuratJalan_H'){$SuratJalan_H = 'active';}else{$SuratJalan_H = '' ;}
 if($MenuActive=='General'){$General = 'active' ;}else{$General = '' ;}
 if($IconActive=='General_icon'){$General_icon = 'fa fa-circle' ;}else{$General_icon = 'fa fa-circle-o' ;} 
 
 if($MenuActive=='SJMkt'){$SJMkt = 'active' ;}else{$SJMkt = '' ;}
 if($IconActive=='SJMkt_icon'){$SJMkt_icon = 'fa fa-circle' ;}else{$SJMkt_icon = 'fa fa-circle-o' ;}
 
 if($MenuActive=='SJSubcon'){$SJSubcon = 'active' ;}else{$SJSubcon = '' ;}
 if($IconActive=='SJSubcon_icon'){$SJSubcon_icon = 'fa fa-circle' ;}else{$SJSubcon_icon = 'fa fa-circle-o' ;}
 
 if($MenuActive=='SJAll'){$SJAll = 'active' ;}else{$SJAll = '' ;}
 if($IconActive=='SJAll_icon'){$SJAll_icon = 'fa fa-circle' ;}else{$SJAll_icon = 'fa fa-circle-o' ;}  
 
 if($MenuActive=='SJWH'){$SJWH = 'active' ;}else{$SJWH = '' ;}
 if($IconActive=='SJWH_icon'){$SJWH_icon = 'fa fa-circle' ;}else{$SJWH_icon = 'fa fa-circle-o' ;}
} 

}else{

$CekDBX =$this->app_model->MenuActive_button('50512'); 
 foreach($CekDBX->result() as $row) {
    
 $HeadMenuActive = $row->HeadMenuActive ;
 $MenuActive = $row->MenuActive ;
 $IconActive = $row->IconActive ;
 
 if($HeadMenuActive=='Forum_H'){$Forum_H = 'active';}else{$Forum_H = '' ;}
 if($MenuActive=='Forum'){$Forum = 'active' ;}else{$Forum = '' ;}
 if($IconActive=='Forum_icon'){$Forum_icon = 'fa fa-circle' ;}else{$Forum_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='DailyGAP'){$DailyGAP = 'active' ;}else{$DailyGAP = '' ;}
 if($IconActive=='DailyGAP_icon'){$DailyGAP_icon = 'fa fa-circle' ;}else{$DailyGAP_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Tracer'){$Tracer = 'active' ;}else{$Tracer = '' ;}
 if($IconActive=='Tracer_icon'){$Tracer_icon = 'fa fa-circle' ;}else{$Tracer_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='Utility_H'){$Utility_H = 'active';}else{$Utility_H = '' ;}
 if($MenuActive=='UtilityUser'){$UtilityUser = 'active' ;}else{$UtilityUser = '' ;}
 if($IconActive=='UtilityUser_icon'){$UtilityUser_icon = 'fa fa-circle' ;}else{$UtilityUser_icon = 'fa fa-circle-o' ;}

 if($MenuActive=='UtilityUserTR'){$UtilityUserTR = 'active' ;}else{$UtilityUserTR = '' ;}
 if($IconActive=='UtilityUserTR_icon'){$UtilityUserTR_icon = 'fa fa-circle' ;}else{$UtilityUserTR_icon = 'fa fa-circle-o' ;} 
 if($MenuActive=='UtilityPartner'){$UtilityPartner = 'active' ;}else{$UtilityPartner = '' ;}
 if($IconActive=='UtilityPartner_icon'){$UtilityPartner_icon = 'fa fa-circle' ;}else{$UtilityPartner_icon = 'fa fa-circle-o' ;} 
 if($MenuActive=='UtilityPartner2'){$UtilityPartner2 = 'active' ;}else{$UtilityPartner2 = '' ;}
 if($IconActive=='UtilityPartner2_icon'){$UtilityPartner2_icon = 'fa fa-circle' ;}else{$UtilityPartner2_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='UtilityCust'){$UtilityCust = 'active' ;}else{$UtilityCust = '' ;}
 if($IconActive=='UtilityCust_icon'){$UtilityCust_icon = 'fa fa-circle' ;}else{$UtilityCust_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='UtilityUnit'){$UtilityUnit = 'active' ;}else{$UtilityUnit = '' ;}
 if($IconActive=='UtilityUnit_icon'){$UtilityUnit_icon = 'fa fa-circle' ;}else{$UtilityUnit_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='UtilityCategory'){$UtilityCategory = 'active' ;}else{$UtilityCategory = '' ;}
 if($IconActive=='UtilityCategory_icon'){$UtilityCategory_icon = 'fa fa-circle' ;}else{$UtilityCategory_icon = 'fa fa-circle-o' ;} 
 if($MenuActive=='UtilityAsset'){$UtilityAsset = 'active' ;}else{$UtilityAsset = '' ;}
 if($IconActive=='UtilityAsset_icon'){$UtilityAsset_icon = 'fa fa-circle' ;}else{$UtilityAsset_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='Master_H'){$Master_H = 'active';}else{$Master_H = '' ;}
 if($MenuActive=='MasterBom'){$MasterBom = 'active' ;}else{$MasterBom = '' ;}
 if($IconActive=='MasterBom_icon'){$MasterBom_icon = 'fa fa-circle' ;}else{$MasterBom_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdMat'){$MasterProdMat = 'active' ;}else{$MasterProdMat = '' ;}
 if($IconActive=='MasterProdMat_icon'){$MasterProdMat_icon = 'fa fa-circle' ;}else{$MasterProdMat_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdStamping'){$MasterProdStamping = 'active' ;}else{$MasterProdStamping = '' ;}
 if($IconActive=='MasterProdStamping_icon'){$MasterProdStamping_icon = 'fa fa-circle' ;}else{$MasterProdStamping_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdWeld'){$MasterProdWeld = 'active' ;}else{$MasterProdWeld = '' ;}
 if($IconActive=='MasterProdWeld_icon'){$MasterProdWeld_icon = 'fa fa-circle' ;}else{$MasterProdWeld_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdDelivery'){$MasterProdDelivery = 'active' ;}else{$MasterProdDelivery = '' ;}
 if($IconActive=='MasterProdDelivery_icon'){$MasterProdDelivery_icon = 'fa fa-circle' ;}else{$MasterProdDelivery_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdStoreRoom'){$MasterProdStoreRoom = 'active' ;}else{$MasterProdStoreRoom = '' ;}
 if($IconActive=='MasterProdStoreRoom_icon'){$MasterProdStoreRoom_icon = 'fa fa-circle' ;}else{$MasterProdStoreRoom_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='MasterProdGA'){$MasterProdGA = 'active' ;}else{$MasterProdGA = '' ;}
 if($IconActive=='MasterProdGA_icon'){$MasterProdGA_icon = 'fa fa-circle' ;}else{$MasterProdGA_icon = 'fa fa-circle-o' ;}
 
  if($HeadMenuActive=='Sony_H'){$Sony_H = 'active';}else{$Sony_H = '' ;}
     if($MenuActive=='SCHProduction'){$SCHProduction = 'active' ;}else{$SCHProduction = '' ;}
 if($IconActive=='SCHProduction_icon'){$SCHProduction_icon = 'fa fa-circle' ;}else{$SCHProduction_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Sony_in'){$Sony_in = 'active' ;}else{$Sony_in = '' ;}
 if($IconActive=='Sony_in_icon'){$Sony_in_icon = 'fa fa-circle' ;}else{$Sony_in_icon = 'fa fa-circle-o' ;}
  if($MenuActive=='Sony_out'){$Sony_out = 'active' ;}else{$Sony_out = '' ;}
 if($IconActive=='Sony_out_icon'){$Sony_out_icon = 'fa fa-circle' ;}else{$Sony_out_icon = 'fa fa-circle-o' ;}
    if($MenuActive=='Sony_Del'){$Sony_Del = 'active' ;}else{$Sony_Del = '' ;}
 if($IconActive=='Sony_Del_icon'){$Sony_Del_icon = 'fa fa-circle' ;}else{$Sony_Del_icon = 'fa fa-circle-o' ;}
  if($MenuActive=='Sony_ret'){$Sony_ret = 'active' ;}else{$Sony_ret = '' ;}
 if($IconActive=='Sony_ret_icon'){$Sony_ret_icon = 'fa fa-circle' ;}else{$Sony_ret_icon = 'fa fa-circle-o' ;}
  if($MenuActive=='Sony_report'){$Sony_report = 'active' ;}else{$Sony_report = '' ;}
 if($IconActive=='Sony_report_icon'){$Sony_report_icon = 'fa fa-circle' ;}else{$Sony_report_icon = 'fa fa-circle-o' ;}

  if($HeadMenuActive=='Administration_H'){$Administration_H = 'active';}else{$Administration_H = '' ;}
 if($MenuActive=='TTI'){$TTI = 'active' ;}else{$TTI = '' ;}
 if($IconActive=='TTI_icon'){$TTI_icon = 'fa fa-circle' ;}else{$TTI_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='Material_H'){$Material_H = 'active';}else{$Material_H = '' ;}
 if($MenuActive=='Material_in'){$Material_in = 'active' ;}else{$Material_in = '' ;}
 if($IconActive=='Material_in_icon'){$Material_in_icon = 'fa fa-circle' ;}else{$Material_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Material_out'){$Material_out = 'active' ;}else{$Material_out = '' ;}
 if($IconActive=='Material_out_icon'){$Material_out_icon = 'fa fa-circle' ;}else{$Material_out_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Material_return'){$Material_return = 'active' ;}else{$Material_return = '' ;}
 if($IconActive=='Material_return_icon'){$Material_return_icon = 'fa fa-circle' ;}else{$Material_return_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Material_report'){$Material_report = 'active' ;}else{$Material_report = '' ;}
 if($IconActive=='Material_report_icon'){$Material_report_icon = 'fa fa-circle' ;}else{$Material_report_icon = 'fa fa-circle-o' ;}

 if($HeadMenuActive=='Mtrl_new_H'){$Mtrl_new_H = 'active';}else{$Mtrl_new_H = '' ;}
 if($MenuActive=='Mtrl_in_new'){$Mtrl_in_new = 'active' ;}else{$Mtrl_in_new = '' ;}
 if($IconActive=='Mtrl_in_new_icon'){$Mtrl_in_new_icon = 'fa fa-circle' ;}else{$Mtrl_in_new_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Mtrl_out_new'){$Mtrl_out_new = 'active' ;}else{$Mtrl_out_new = '' ;}
 if($IconActive=='Mtrl_out_new_icon'){$Mtrl_out_new_icon = 'fa fa-circle' ;}else{$Mtrl_out_new_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Mtrl_return_new'){$Mtrl_return_new = 'active' ;}else{$Mtrl_return_new = '' ;}
 if($IconActive=='Mtrl_return_new_icon'){$Mtrl_return_new_icon = 'fa fa-circle' ;}else{$Mtrl_return_new_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Mtrl_report_new'){$Mtrl_report_new = 'active' ;}else{$Mtrl_report_new = '' ;}
 if($IconActive=='Mtrl_report_new_icon'){$Mtrl_report_new_icon = 'fa fa-circle' ;}else{$Mtrl_report_new_icon = 'fa fa-circle-o' ;}
 

 if($HeadMenuActive=='StoreRoom_H'){$StoreRoom_H = 'active';}else{$StoreRoom_H = '' ;}
 if($MenuActive=='StoreRoom_in'){$StoreRoom_in = 'active' ;}else{$StoreRoom_in = '' ;}
 if($IconActive=='StoreRoom_in_icon'){$StoreRoom_in_icon = 'fa fa-circle' ;}else{$StoreRoom_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='StoreRoom_out'){$StoreRoom_out = 'active' ;}else{$StoreRoom_out = '' ;}
 if($IconActive=='StoreRoom_out_icon'){$StoreRoom_out_icon = 'fa fa-circle' ;}else{$StoreRoom_out_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='StoreRoom_report'){$StoreRoom_report = 'active' ;}else{$StoreRoom_report = '' ;}
 if($IconActive=='StoreRoom_report_icon'){$StoreRoom_report_icon = 'fa fa-circle' ;}else{$StoreRoom_report_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='GeneralAfair_H'){$GeneralAfair_H = 'active';}else{$GeneralAfair_H = '' ;}
 if($MenuActive=='GeneralAfair_in'){$GeneralAfair_in = 'active' ;}else{$GeneralAfair_in = '' ;}
 if($IconActive=='GeneralAfair_in_icon'){$GeneralAfair_in_icon = 'fa fa-circle' ;}else{$GeneralAfair_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='GeneralAfair_out'){$GeneralAfair_out = 'active' ;}else{$GeneralAfair_out = '' ;}
 if($IconActive=='GeneralAfair_out_icon'){$GeneralAfair_out_icon = 'fa fa-circle' ;}else{$GeneralAfair_out_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='GeneralAfair_report'){$GeneralAfair_report = 'active' ;}else{$GeneralAfair_report = '' ;}
 if($IconActive=='GeneralAfair_report_icon'){$GeneralAfair_report_icon = 'fa fa-circle' ;}else{$GeneralAfair_report_icon = 'fa fa-circle-o' ;}

 if($HeadMenuActive=='FinishGood_H'){$FinishGood_H = 'active';}else{$FinishGood_H = '' ;}
 if($MenuActive=='FinishGood_in'){$FinishGood_in = 'active' ;}else{$FinishGood_in = '' ;}
 if($IconActive=='FinishGood_in_icon'){$FinishGood_in_icon = 'fa fa-circle' ;}else{$FinishGood_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='FinishGood_out'){$FinishGood_out = 'active' ;}else{$FinishGood_out = '' ;}
 if($IconActive=='FinishGood_out_icon'){$FinishGood_out_icon = 'fa fa-circle' ;}else{$FinishGood_out_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='FinishGood_report'){$FinishGood_report = 'active' ;}else{$FinishGood_report = '' ;}
 if($IconActive=='FinishGood_report_icon'){$FinishGood_report_icon = 'fa fa-circle' ;}else{$FinishGood_report_icon = 'fa fa-circle-o' ;}

 if($HeadMenuActive=='Wip_H'){$Wip_H = 'active';}else{$Wip_H = '' ;}
 if($MenuActive=='Wip_in'){$Wip_in = 'active' ;}else{$Wip_in = '' ;}
 if($IconActive=='Wip_in_icon'){$Wip_in_icon = 'fa fa-circle' ;}else{$Wip_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Wip_out'){$Wip_out = 'active' ;}else{$Wip_out = '' ;}
 if($IconActive=='Wip_out_icon'){$Wip_out_icon = 'fa fa-circle' ;}else{$Wip_out_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='Wip_report'){$Wip_report = 'active' ;}else{$Wip_report = '' ;}
 if($IconActive=='Wip_report_icon'){$Wip_report_icon = 'fa fa-circle' ;}else{$Wip_report_icon = 'fa fa-circle-o' ;} 

 if($HeadMenuActive=='Production_H'){$Production_H = 'active';}else{$Production_H = '' ;}
 if($MenuActive=='ProductionSTP_in'){$ProductionSTP_in = 'active' ;}else{$ProductionSTP_in = '' ;}
 if($IconActive=='ProductionSTP_in_icon'){$ProductionSTP_in_icon = 'fa fa-circle' ;}else{$ProductionSTP_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='ProductionNonSTP_in'){$ProductionNonSTP_in = 'active' ;}else{$ProductionNonSTP_in = '' ;}
 if($IconActive=='ProductionNonSTP_in_icon'){$ProductionNonSTP_in_icon = 'fa fa-circle' ;}else{$ProductionNonSTP_in_icon = 'fa fa-circle-o' ;}
 if($MenuActive=='ProductionReportDies'){$ProductionReportDies = 'active' ;}else{$ProductionReportDies = '' ;}
 if($IconActive=='ProductionReportDies_icon'){$ProductionReportDies_icon = 'fa fa-circle' ;}else{$ProductionReportDies_icon = 'fa fa-circle-o' ;} 
 if($MenuActive=='CreateBPFG'){$CreateBPFG = 'active' ;}else{$CreateBPFG = '' ;}
 if($IconActive=='CreateBPFG_icon'){$CreateBPFG_icon = 'fa fa-circle' ;}else{$CreateBPFG_icon = 'fa fa-circle-o' ;}
 
 if($HeadMenuActive=='SuratJalan_H'){$SuratJalan_H = 'active';}else{$SuratJalan_H = '' ;}
 if($MenuActive=='General'){$General = 'active' ;}else{$General = '' ;}
 if($IconActive=='General_icon'){$General_icon = 'fa fa-circle' ;}else{$General_icon = 'fa fa-circle-o' ;} 
 
 if($MenuActive=='SJMkt'){$SJMkt = 'active' ;}else{$SJMkt = '' ;}
 if($IconActive=='SJMkt_icon'){$SJMkt_icon = 'fa fa-circle' ;}else{$SJMkt_icon = 'fa fa-circle-o' ;}
 
 if($MenuActive=='SJSubcon'){$SJSubcon = 'active' ;}else{$SJSubcon = '' ;}
 if($IconActive=='SJSubcon_icon'){$SJSubcon_icon = 'fa fa-circle' ;}else{$SJSubcon_icon = 'fa fa-circle-o' ;}
 
 if($MenuActive=='SJAll'){$SJAll = 'active' ;}else{$SJAll = '' ;}
 if($IconActive=='SJAll_icon'){$SJAll_icon = 'fa fa-circle' ;}else{$SJAll_icon = 'fa fa-circle-o' ;}  
 
 if($MenuActive=='SJWH'){$SJWH = 'active' ;}else{$SJWH = '' ;}
 if($IconActive=='SJWH_icon'){$SJWH_icon = 'fa fa-circle' ;}else{$SJWH_icon = 'fa fa-circle-o' ;}
    } 
}

 ?>
<aside class="main-sidebar">
<section class="sidebar">
<div class="user-panel">
<div class="pull-left image">
<img style="cursor: pointer;" onclick="javascript:editFoto(<?php echo $this->app_model->CariIDPengguna();?>)" src="<?php echo base_url(); ?>images/foto_profil/<?php echo $this->app_model->CariFFPengguna();?>" class="img-circle" alt="User Image">
</div>
<div class="pull-left info">
<p><?php echo $this->app_model->CariNamaPengguna();?></p>
<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
</div></div>

<form action="#" method="get" class="sidebar-form">
<div class="input-group">
<input type="text" name="q" class="form-control" placeholder="Search...">
<span class="input-group-btn">
<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
</button></span>


        </div>
      </form>
      
      <input type="text" hidden="" style="color: black;" id="ip">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
 
<ul class="sidebar-menu">     

<li class="<?php echo $Forum_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-home"></i><span>Dashboard</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu">

<li class="<?php echo $Forum ; ?>" onclick="Menu_active('home/','Forum_H','Forum','Forum_icon')">
<a href="<?php echo base_url();?>index.php/home/">
<i class="<?php echo $Forum_icon ; ?>"></i>Home</a></li>

<li onclick="Menu_active('MonitoringStock/','Forum_H','Forum','Forum_icon')">
<a target="_blank" href="<?php echo base_url();?>index.php/MonitoringStock/">
<i class="fa fa-circle-o"></i>Material Stock</a></li>

<li onclick="Menu_active('MonitoringStockFG/','Forum_H','Forum','Forum_icon')">
<a target="_blank" href="<?php echo base_url();?>index.php/MonitoringStockFG/">
<i class="fa fa-circle-o"></i>FG Stock</a></li>

<li class="<?php echo $DailyGAP ; ?>" onclick="Menu_active('home/','Forum_H','DailyGAP','DailyGAP_icon')">
<a href="<?php echo base_url();?>index.php/DailyGAP/">
<i class="<?php echo $DailyGAP_icon ; ?>"></i>Delivery Outstanding</a></li>

<li class="<?php echo $Tracer ; ?>" onclick="Menu_active('Tracer/','Forum_H','Tracer','Tracer_icon')">
<a href="<?php echo base_url();?>index.php/Tracer/">
<i class="<?php echo $Tracer_icon ; ?>"></i>Tracer</a></li>

</ul>
</li>

<?php $CanEditUtility = $this->Role_Model->CanEditUtility(); if($CanEditUtility>0){ ?>
<li class="<?php echo $Utility_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-gears"></i><span>Utility</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu">
<?php  $MUser = $this->Role_Model->MasterUser(); if(!empty($MUser)){ ?>
<li class="<?php echo $UtilityUser ; ?>" onclick="Menu_active('MasterUser/','Utility_H','UtilityUser','UtilityUser_icon')">
<a href="<?php echo base_url();?>index.php/MasterUser/">
<i class="<?php echo $UtilityUser_icon ; ?>"></i>User</a></li>
<?php } ?>
<?php  $MUserTR = $this->Role_Model->MUserTR(); if(!empty($MUserTR)){ ?>
<li class="<?php echo $UtilityUserTR ; ?>" onclick="Menu_active('MasterUserTR/','Utility_H','UtilityUserTR','UtilityUserTR_icon')">
<a href="<?php echo base_url();?>index.php/MasterUserTR/">
<i class="<?php echo $UtilityUserTR_icon ; ?>"></i>PIC</a></li>
<?php } ?>
<?php  $MPartner = $this->Role_Model->MPartner(); if(!empty($MPartner)){ ?>
<li class="<?php echo $UtilityPartner; ?>" onclick="Menu_active('MasterPartner/','Utility_H','UtilityPartner','UtilityPartner_icon')">
<a href="<?php echo base_url();?>index.php/MasterPartner/">
<i class="<?php echo $UtilityPartner_icon ; ?>"></i>Partner</a></li>
<?php } ?>

<?php  $MPartner2 = $this->Role_Model->MPartner2(); if(!empty($MPartner2)){ ?>
<li class="<?php echo $UtilityPartner2; ?>" onclick="Menu_active('MasterPartner2/','Utility_H','UtilityPartner2','UtilityPartner2_icon')">
<a href="<?php echo base_url();?>index.php/MasterPartner2/">
<i class="<?php echo $UtilityPartner2_icon ; ?>"></i>Partner Surat Jalan</a></li>
<?php } ?>

<?php  $cek = $this->Role_Model->MCust(); if(!empty($cek)){ ?>
<li class="<?php echo $UtilityCust ; ?>" onclick="Menu_active('MasterCust/','Utility_H','UtilityCust','UtilityCust_icon')">
<a href="<?php echo base_url();?>index.php/MasterCust/">
<i class="<?php echo $UtilityCust_icon ; ?>"></i>Customer</a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->MUnit(); if(!empty($cek)){ ?>
<li class="<?php echo $UtilityUnit ; ?>" onclick="Menu_active('MasterUnit/','Utility_H','UtilityUnit','UtilityUnit_icon')">
<a href="<?php echo base_url();?>index.php/MasterUnit/">
<i class="<?php echo $UtilityUnit_icon ; ?>"></i>Unit</a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->MCategory(); if(!empty($cek)){ ?>
<li class="<?php echo $UtilityCategory ; ?>" onclick="Menu_active('MasterCategory/','Utility_H','UtilityCategory','UtilityCategory_icon')">
<a href="<?php echo base_url();?>index.php/MasterCategory/">
<i class="<?php echo $UtilityCategory_icon ; ?>"></i>Category</a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->MAsset(); if(!empty($cek)){ ?>
<li class="<?php echo $UtilityAsset ; ?>" onclick="Menu_active('MasterAsset/','Utility_H','UtilityAsset','UtilityAsset_icon')">
<a href="<?php echo base_url();?>index.php/MasterAsset/">
<i class="<?php echo $UtilityAsset_icon ; ?>"></i>Asset</a></li>
<?php } ?>

</ul></li><?php } ?>

<?php $CanEditMaster = $this->Role_Model->CanEditMaster(); if($CanEditMaster>0){ ?>
<li class="<?php echo $Master_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-gears"></i><span>Master</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu">
 
<?php  $cek = $this->Role_Model->MBom() ; if(!empty($cek)){ ?>
<li class="<?php echo $MasterBom ; ?>" onclick="Menu_active('MasterBom/','Master_H','MasterBom','MasterBom_icon')">
<a href="<?php echo base_url();?>index.php/MasterBom/">
<i class="<?php echo $MasterBom_icon ; ?>"></i>BOM</a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->MProdMaterial() ; if(!empty($cek)){ ?>
<li class="<?php echo $MasterProdMat ; ?>" onclick="Menu_active('MasterProdMaterial/','Master_H','MasterProdMat','MasterProdMat_icon')">
<a href="<?php echo base_url();?>index.php/MasterProdMaterial/">
<i class="<?php echo $MasterProdMat_icon ; ?>"></i>Prod Material</a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->MProdStamping() ; if(!empty($cek)){ ?>
<li class="<?php echo $MasterProdStamping ; ?>" onclick="Menu_active('MasterProdStamping/','Master_H','MasterProdStamping','MasterProdStamping_icon')">
<a href="<?php echo base_url();?>index.php/MasterProdStamping/">
<i class="<?php echo $MasterProdStamping_icon ; ?>"></i>Prod Stamping</a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->MProdWip() ; if(!empty($cek)){ ?>
<li class="<?php echo $MasterProdWip ; ?>" onclick="Menu_active('MasterProdWip/','Master_H','MasterProdWip','MasterProdWip_icon')">
<a href="<?php echo base_url();?>index.php/MasterProdWip/">
<i class="<?php echo $MasterProdWip_icon ; ?>"></i>Prod Wip</a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->MProdWelding() ; if(!empty($cek)){ ?>
<li class="<?php echo $MasterProdWeld ; ?>" onclick="Menu_active('MasterProdWeld/','Master_H','MasterProdWeld','MasterProdWeld_icon')">
<a href="<?php echo base_url();?>index.php/MasterProdWeld/">
<i class="<?php echo $MasterProdWeld_icon ; ?>"></i>Prod Welding</a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->MProdDelivery() ; if(!empty($cek)){ ?>
<li class="<?php echo $MasterProdDelivery ; ?>" onclick="Menu_active('MasterProdDelivery/','Master_H','MasterProdDelivery','MasterProdDelivery_icon')">
<a href="<?php echo base_url();?>index.php/MasterProdDelivery/">
<i class="<?php echo $MasterProdDelivery_icon ; ?>"></i>Prod Delivery</a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->MProdStoreRoom() ; if(!empty($cek)){ ?>
<li class="<?php echo $MasterProdStoreRoom ; ?>" onclick="Menu_active('MasterProdStoreRoom/','Master_H','MasterProdStoreRoom','MasterProdStoreRoom_icon')">
<a href="<?php echo base_url();?>index.php/MasterProdStoreRoom/">
<i class="<?php echo $MasterProdStoreRoom_icon ; ?>"></i>Prod Store Room</a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->MProdGA() ; if(!empty($cek)){ ?>
<li class="<?php echo $MasterProdGA ; ?>" onclick="Menu_active('MasterProdGA/','Master_H','MasterProdGA','MasterProdGA_icon')">
<a href="<?php echo base_url();?>index.php/MasterProdGA/">
<i class="<?php echo $MasterProdGA_icon ; ?>"></i>Prod GA</a></li>
<?php } ?>

<!-- erfin -->
<?php  $cek = $this->Role_Model->MProdICT(); if(!empty($cek)){ ?>
<li class="<?php echo $MasterProdICT ; ?>" onclick="Menu_active('MasterProdICT/','Master_H','MasterProdICT','MasterProdICT_icon')">
<a href="<?php echo base_url();?>index.php/MasterProdICT/">
<i class="<?php echo $MasterProdICT_icon ; ?>"></i>Prod ICT</a></li>
<?php } ?>

<?php  $cek = $this->Role_Model->MSJ() ; if(!empty($cek)){ ?>
<li class="<?php echo $MasterSubcon ; ?>" onclick="Menu_active('MasterSubcon/','Master_H','MasterSubcon','MasterSubcon_icon')">
<a href="<?php echo base_url();?>index.php/MasterSubcon/">
<i class="<?php echo $MasterSubcon_icon ; ?>"></i>Surat Jalan</a></li>
<?php } ?>
</ul></li><?php } ?>

<?php  $cek = $this->Role_Model->TrcSony() ; if(!empty($cek)){ ?>
<li class="<?php echo $Sony_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-folder-open"></i><span>Sony</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu"> 

<li class="<?php echo $SCHProduction ; ?>" onclick="Menu_active('SCHProduction_Sony/','Sony_H','SCHProduction','SCHProduction_icon')">
<a href="<?php echo base_url();?>index.php/SCHProduction_Sony/"><i class="<?php echo $SCHProduction_icon ; ?>"></i>Schedule</a></li>

<li class="<?php echo $Sony_in ; ?>" onclick="Menu_active('INMaterial_Sony/','Sony_H','Sony_in','Sony_in_icon')">
<a href="<?php echo base_url();?>index.php/INMaterial_Sony/"><i class="<?php echo $Sony_in_icon ; ?>"></i>IN</a></li>
<li class="<?php echo $Sony_out ; ?>" onclick="Menu_active('OUTMaterial_Sony/','Sony_H','Sony_out','Sony_out_icon')">
<a href="<?php echo base_url();?>index.php/OUTMaterial_Sony/"><i class="<?php echo $Sony_out_icon ; ?>"></i>Unpacking</a></li>
<li class="<?php echo $Sony_Del ; ?>" onclick="Menu_active('DelMaterial_Sony/','Sony_H','Sony_Del','Sony_Del_icon')">
<a href="<?php echo base_url();?>index.php/DelMaterial_Sony/"><i class="<?php echo $Sony_Del_icon ; ?>"></i>Delivery</a></li>
<li class="<?php echo $Sony_ret ; ?>" onclick="Menu_active('ReturnMaterial_Sony/','Sony_H','Sony_ret','Sony_ret_icon')">
<a href="<?php echo base_url();?>index.php/ReturnMaterial_Sony/"><i class="<?php echo $Sony_ret_icon ; ?>"></i>Return</a></li>
<li class="<?php echo $Sony_report ; ?>" onclick="Menu_active('ReportMaterial_Sony/','Sony_H','Sony_report','Sony_report_icon')">
<a href="<?php echo base_url();?>index.php/ReportMaterial_Sony/"><i class="<?php echo $Sony_report_icon ; ?>"></i>Report</a></li>
</ul>
</li><?php } ?>


<?php  $cek = $this->Role_Model->TrcAdministration() ; if(!empty($cek)){ ?>
<li class="<?php echo $Administration_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-folder-open"></i><span>Administration</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu"> 
<li class="<?php echo $TTI ; ?>" onclick="Menu_active('TTI/','Administration_H','TTI','TTI_icon')">
<a href="<?php echo base_url();?>index.php/TTI/"><i class="<?php echo $TTI_icon ; ?>"></i>TTI (Exedy)</a></li>
</ul>
</li><?php } ?>

 
<?php  $cek = $this->Role_Model->TrcMaterial(); if(!empty($cek)){ ?>
<li class="<?php echo $Material_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-folder-open"></i><span>Raw Material</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu"> 
<li class="<?php echo $Material_in ; ?>" onclick="Menu_active('INMaterial/','Material_H','Material_in','Material_in_icon')">
<a href="<?php echo base_url();?>index.php/INMaterial/"><i class="<?php echo $Material_in_icon ; ?>"></i>In</a></li>
<li class="<?php echo $Material_out ; ?>" onclick="Menu_active('OUTMaterial/','Material_H','Material_out','Material_out_icon')" >
<a href="<?php echo base_url();?>index.php/OUTMaterial/"><i class="<?php echo $Material_out_icon ; ?>"></i>Out</a></li>
<li class="<?php echo $Material_return ; ?>" onclick="Menu_active('ReturnMaterial/','Material_H','Material_return','Material_return_icon')" >
<a href="<?php echo base_url();?>index.php/ReturnMaterial/"><i class="<?php echo $Material_return_icon ; ?>"></i>Return</a></li>
<li class="<?php echo $Material_report ; ?>" onclick="Menu_active('ReportMaterial/','Material_H','Material_report','Material_report_icon')">
<a href="<?php echo base_url();?>index.php/ReportMaterial/"><i class="<?php echo $Material_report_icon ; ?>"></i>Report</a></li>
</ul></li><?php } ?>

  
<?php  $cek = $this->Role_Model->TrcStoreRoom() ; if(!empty($cek)){ ?>
<li class="<?php echo $StoreRoom_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-folder-open"></i><span>Store Room</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu"> 
<li class="<?php echo $StoreRoom_in ; ?>" onclick="Menu_active('Material_in_TR/','StoreRoom_H','StoreRoom_in','StoreRoom_in_icon')">
<a href="<?php echo base_url();?>index.php/Material_in_TR/"><i class="<?php echo $StoreRoom_in_icon ; ?>"></i>In</a></li>
<li class="<?php echo $StoreRoom_out ; ?>" onclick="Menu_active('Material_out_TR/','StoreRoom_H','StoreRoom_out','StoreRoom_out_icon')" >
<a href="<?php echo base_url();?>index.php/Material_out_TR/"><i class="<?php echo $StoreRoom_out_icon ; ?>"></i>Out</a></li>
<li class="<?php echo $StoreRoom_report; ?>" onclick="Menu_active('Material_report_TR/','StoreRoom_H','StoreRoom_report','StoreRoom_report_icon')">
<a href="<?php echo base_url();?>index.php/Material_report_TR/"><i class="<?php echo $StoreRoom_report_icon ; ?>"></i>Report</a></li>
</ul></li><?php } ?>

<?php  $cek = $this->Role_Model->TrcGA() ; if(!empty($cek)){ ?>
<li class="<?php echo $GeneralAfair_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-folder-open"></i><span>GA</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu"> 
<li class="<?php echo $GeneralAfair_in ; ?>" onclick="Menu_active('Material_in_GA/','GeneralAfair_H','GeneralAfair_in','GeneralAfair_in_icon')">
<a href="<?php echo base_url();?>index.php/Material_in_GA/"><i class="<?php echo $GeneralAfair_in_icon ; ?>"></i>In</a></li>
<li class="<?php echo $GeneralAfair_out ; ?>" onclick="Menu_active('Material_out_GA/','GeneralAfair_H','GeneralAfair_out','GeneralAfair_out_icon')" >
<a href="<?php echo base_url();?>index.php/Material_out_GA/"><i class="<?php echo $GeneralAfair_out_icon ; ?>"></i>Out</a></li>
<li class="<?php echo $GeneralAfair_report ; ?>" onclick="Menu_active('Material_report_GA/','GeneralAfair_H','GeneralAfair_report','GeneralAfair_report_icon')">
<a href="<?php echo base_url();?>index.php/Material_report_GA/"><i class="<?php echo $GeneralAfair_report_icon ; ?>"></i>Report</a></li>
</ul></li><?php } ?>
 
<?php  $cek = $this->Role_Model->TrcWH() ; if(!empty($cek)){ ?>
<li class="<?php echo $FinishGood_H; ?>">
<a style="cursor: pointer;"><i class="fa fa-folder-open"></i><span>WareHouse FG</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu"> 


<li class="<?php echo $FinishGood_in ; ?>" onclick="Menu_active('INFinishGood/','FinishGood_H','FinishGood_in','FinishGood_in_icon')">
<a href="<?php echo base_url();?>index.php/INFinishGood/"><i class="<?php echo $FinishGood_in_icon ; ?>"></i>In</a></li>

<li class="<?php echo $FinishGood_out ; ?>" onclick="Menu_active('OUTFinishGood/','FinishGood_H','FinishGood_out','FinishGood_out_icon')" >
<a href="<?php echo base_url();?>index.php/OUTFinishGood/"><i class="<?php echo $FinishGood_out_icon ; ?>"></i>Out</a></li>
<li class="<?php echo $FinishGood_report ; ?>" onclick="Menu_active('ReportFinishGood/','FinishGood_H','FinishGood_report','FinishGood_report_icon')">
<a href="<?php echo base_url();?>index.php/ReportFinishGood/"><i class="<?php echo $FinishGood_report_icon ; ?>"></i>Report</a></li>

<li class="<?php echo $BPFG_in ; ?>" onclick="Menu_active('BPFG_in/','FinishGood_H','BPFG_in','BPFG_in_icon')">
<a href="<?php echo base_url();?>index.php/BPFG_in/"><i class="<?php echo $BPFG_in_icon ; ?>"></i>Confirm</a></li>
</ul></li>



<?php } ?>

<?php  $cek = $this->Role_Model->TrcWIP() ; if(!empty($cek)){ ?>
<li class="<?php echo $Wip_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-folder-open"></i><span>WIP Store</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu"> 
<li class="<?php echo $Wip_in ; ?>" onclick="Menu_active('INWip/','Wip_H','Wip_in','Wip_in_icon')">
<a href="<?php echo base_url();?>index.php/INWip/"><i class="<?php echo $Wip_in_icon ; ?>"></i>In</a></li>
<li class="<?php echo $Wip_out ; ?>" onclick="Menu_active('OUTWip/','Wip_H','Wip_out','Wip_out_icon')" >
<a href="<?php echo base_url();?>index.php/OUTWip/"><i class="<?php echo $Wip_out_icon ; ?>"></i>Out</a></li>
<li class="<?php echo $Wip_report ; ?>" onclick="Menu_active('ReportWip/','Wip_H','Wip_report','Wip_report_icon')">
<a href="<?php echo base_url();?>index.php/ReportWip/"><i class="<?php echo $Wip_report_icon ; ?>"></i>Report</a></li>
</ul></li><?php } ?>


<?php  $cek = $this->Role_Model->TrcProduction() ; if(!empty($cek)){ ?>
<li class="<?php echo $Production_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-folder-open"></i><span>Production</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<?php  $cek = $this->Role_Model->TrcStamping() ; if(!empty($cek)){ ?>
<ul class="treeview-menu"> 
<li class="<?php echo $ProductionSTP_in ; ?>" onclick="Menu_active('OutSTP/','Production_H','ProductionSTP_in','ProductionSTP_in_icon')">
<a href="<?php echo base_url();?>index.php/OutSTP/"><i class="<?php echo $ProductionSTP_in_icon ; ?>"></i>Stamping Press</a></li>
</ul><?php } ?>
<?php  $cek = $this->Role_Model->TrcNonStamping() ; if(!empty($cek)){ ?>
<ul class="treeview-menu"> 
<li class="<?php echo $ProductionNonSTP_in ; ?>" onclick="Menu_active('OutNonSTP/','Production_H','ProductionNonSTP_in','ProductionNonSTP_in_icon')">
<a href="<?php echo base_url();?>index.php/OutNonSTP/"><i class="<?php echo $ProductionNonSTP_in_icon ; ?>"></i>Non Press</a></li>
</ul><?php } ?>



<?php $cek = $this->Role_Model->TrcStamping() ; if(!empty($cek)){ ?>
<ul class="treeview-menu"> 
<li class="<?php echo $ProductionReportDies ; ?>" onclick="Menu_active('ReportDies/','Production_H','ProductionReportDies','ProductionReportDies_icon')">
<a href="<?php echo base_url();?>index.php/ReportDies/"><i class="<?php echo $ProductionReportDies_icon ; ?>"></i>Stroke Dies</a></li>
</ul><?php } ?>


<?php $cek = $this->Role_Model->TrcBPFG() ; if(!empty($cek)){ ?>
<ul class="treeview-menu"> 
<li class="<?php echo $CreateBPFG ; ?>" onclick="Menu_active('BPFG/','Production_H','CreateBPFG','CreateBPFG_icon')">
<a href="<?php echo base_url();?>index.php/BPFG/"><i class="<?php echo $CreateBPFG_icon ; ?>"></i>Create BPFG</a></li>
</ul><?php } ?>
</li>
<?php } ?>

<?php  $cek = $this->Role_Model->TrcICT() ; if(!empty($cek)){ ?>
<li class="<?php echo $Ict_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-folder-open"></i><span>ICT</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu"> 
<li class="<?php echo $Ict_in ; ?>" onclick="Menu_active('Ict_in_TR/','Ict_H','Ict_in','Ict_in_icon')">
<a href="<?php echo base_url();?>index.php/Ict_in_TR/"><i class="<?php echo $Ict_in_icon ; ?>"></i>In</a></li>
<li class="<?php echo $Ict_out ; ?>" onclick="Menu_active('Ict_out_TR/','Ict_H','Ict_out','Ict_out_icon')" >
<a href="<?php echo base_url();?>index.php/Ict_out_TR/"><i class="<?php echo $Ict_out_icon ; ?>"></i>Out</a></li>
<li class="<?php echo $Ict_report; ?>" onclick="Menu_active('Ict_report_TR/','Ict_H','Ict_report','Ict_report_icon')">
<a href="<?php echo base_url();?>index.php/Ict_report_TR/"><i class="<?php echo $Ict_report_icon ; ?>"></i>Report</a></li>
</ul></li><?php } ?>

<?php  $cek = $this->Role_Model->TrigerView() ; if(!empty($cek)){ ?>
<li class="<?php echo $POCust_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-folder-open"></i><span>Triger</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu"> 
<li class="<?php echo $POCust ; ?>" onclick="Menu_active('POCust/','POCust_H','POCust','POCust_icon')">
<a href="<?php echo base_url();?>index.php/POCust/"><i class="<?php echo $POCust_icon ; ?>"></i>Create PO Cust</a></li>
</ul></li><?php } ?>

<?php  $cek = $this->Role_Model->TrcSJ() ; 
       $cek2 = $this->Role_Model->TrcSJConfirm() ; 
	   $cek3 = $this->Role_Model->TrcSJConfirmMkt() ;
	   $cek4 = $this->Role_Model->TrcSJWH();
	   if(!empty($cek) || !empty($cek2) || !empty($cek3) || !empty($cek4)){ ?>
<li class="<?php echo $SuratJalan_H ; ?>">
<a style="cursor: pointer;"><i class="fa fa-folder-open"></i><span>Surat Jalan</span>
<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span></a>
<ul class="treeview-menu"> 
<?php  $cek = $this->Role_Model->TrcSJConfirm() ; if(!empty($cek)){ ?>
<li class="<?php echo $General ; ?>" onclick="Menu_active('SuratJalan/','SuratJalan_H','General','General_icon')">
<a href="<?php echo base_url();?>index.php/SuratJalan/"><i class="<?php echo $General_icon ; ?>"></i><span>Confirm Surat Jalan General</span>
<span class="pull-right-container">
<small class="label pull-right bg-blue" id="notif_confirm"></small>
</span></a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->TrcSJConfirmMkt() ; if(!empty($cek)){ ?>
<li class="<?php echo $SJMkt ; ?>" onclick="Menu_active('SuratJalanMkt/','SuratJalan_H','SJMkt','SJMkt_icon')">
<a href="<?php echo base_url();?>index.php/SuratJalanMkt/"><i class="<?php echo $SJMkt_icon ; ?>"></i><span>Confirm Marketing</span>
<span class="pull-right-container">
<small class="label pull-right bg-blue" id="notif_mkt_confirm"></small>
</span></a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->TrcSJ() ; if(!empty($cek)){ ?>
<li class="<?php echo $SJAll ; ?>" onclick="Menu_active('SuratJalanAll/','SuratJalan_H','SJAll','SJAll_icon')" >
<a href="<?php echo base_url();?>index.php/SuratJalanAll/"><i class="<?php echo $SJAll_icon ; ?>"></i>Create Surat Jalan General</a></li>
<?php } ?>
<?php  $cek = $this->Role_Model->TrcSJWH() ; if(!empty($cek)){ ?>
<li class="<?php echo $SJWH ; ?>" onclick="Menu_active('SuratJalanWH/','SuratJalan_H','SJWH','SJWH_icon')" >
<a href="<?php echo base_url();?>index.php/SuratJalanWH/"><i class="<?php echo $SJWH_icon ; ?>"></i>Create Surat Jalan WH</a></li>
<?php } ?>
</ul></li><?php } ?>

</ul> 
</section>
</aside>
  
  <div class="modal fade" id="myModalEditFotoUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-options="closed:true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">Cl&times;se</button>
<h4 class="modal-title"><strong>Data User</strong></h4></div><div class="modal-body"><div>
                        

<form class="form-horizontal" name="formFoto" id="formFoto" method="post" action="<?php echo site_url();?>/ref_json/simpanFoto" enctype="multipart/form-data">
<div class="panel-body">
<div class="col-md-12">
 <div class="form-group">
<div class="col-lg-12">
<input type="file" name="foto" id="foto" size="50" maxlength="20"  />
</div></div> 

</div></div>
</form>
<div class="panel-footer">
<button type="submit" name="simpanFoto" id="simpanFoto" class="btn btn-success" data-options="iconCls:'icon-save'"><i class="fa fa-save"></i> &nbsp; Update</button>
</div>    

 
   
    
</div></div></div></div></div><!-- /.modal -->
  
     <script type="text/javascript">
function editFoto(id){
    
$("#myModalEditFotoUser").modal('show');

$("#RegID2").val(id);

setTimeout(function(){
					$("#RegID2").focus();
					$("#RegID2").click();
},200)
	
}
</script>
  