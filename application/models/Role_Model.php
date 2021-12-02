<?php
 class Role_Model extends CI_Model {
 /**
 * @author : Aji
 **/
 
public function CanEditMaster(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MasterH' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function CanEditUtility(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='UtilityH' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MasterUser(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MasterUser' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MasterUserDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MasterUser' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MasterUserUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MasterUser' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MasterUserView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MasterUser' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MUserTR(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MUserTR' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }


public function MUserTRDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MUserTR' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MUserTRUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MUserTR' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MUserTRView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MUserTR' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
public function MPartner(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MPartner' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
 public function MPartnerDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MPartner' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MPartnerUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MPartner' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MPartnerView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MPartner' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MBom(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MBom' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MBomDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MBom' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MBomUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MBom' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MBomView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MBom' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
  
public function MProdMaterial(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdMaterial' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 

public function MProdMaterialDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdMaterial' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MProdMaterialUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdMaterial' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MProdMaterialView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdMaterial' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MProdStamping(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdStamping' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MProdStampingDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdStamping' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MProdStampingUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdStamping' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MProdStampingView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdStamping' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MProdWelding(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdWelding' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
public function MProdWeldingDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdWelding' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MProdWeldingUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdWelding' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MProdWeldingView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdWelding' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MProdDelivery(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdDelivery' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
public function MProdDeliveryDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdDelivery' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MProdDeliveryUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdDelivery' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MProdDeliveryView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdDelivery' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MProdStoreRoom(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdStoreRoom' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
public function MProdStoreRoomDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdStoreRoom' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MProdStoreRoomUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdStoreRoom' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MProdStoreRoomView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdStoreRoom' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MProdGA(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdGA' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
public function MProdGADel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdGA' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MProdGAUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdGA' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MProdGAView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdGA' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MProdICT(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdICT' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 

public function MProdICTDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdICT' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MProdICTUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdICT' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MProdICTView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdICT' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MCust(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MCust' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 

 public function MCustDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MCust' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MCustUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MCust' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MCustView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MCust' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 

public function MUnit(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MUnit' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
 public function MUnitDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MUnit' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MUnitUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MUnit' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MUnitView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MUnit' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MCategory(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MCategory' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
public function MCategoryDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MCategory' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MCategoryUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MCategory' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MCategoryView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MCategory' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MAsset(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MAsset' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MAssetDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MAsset' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MAssetUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MAsset' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function MAssetView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MAsset' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function CanEditMasterUpdate(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ActivityID=89 AND UpData=1 ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
 public function TrcSony(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcSony'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcSonyDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcSony' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcSonyUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcSony' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function TrcSonyView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcSony' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

 
 public function TrcMaterial(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcMaterial'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function TrcMaterialDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcMaterial' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcMaterialUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcMaterial' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function TrcMaterialView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcMaterial' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
  
  public function TrcGA(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcGA'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function TrcGADel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcGA' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcGAUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcGA' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function TrcGAView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcGA' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
  public function TrcStoreRoom(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcStoreRoom'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcStoreRoomDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcStoreRoom' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcStoreRoomUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcStoreRoom' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function TrcStoreRoomView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcStoreRoom' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
  
  public function TrcWH(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWH'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcWHDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWH' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcWHUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWH' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function TrcWHView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWH' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
  
  public function TrcWIP(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWIP'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcWIPDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWIP' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcWIPUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWIP' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function TrcWIPView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWIP' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
  public function TrcProduction(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcProduction'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
  public function TrcStamping(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcStamping'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcStampingDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcStamping' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcStampingUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcStamping' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function TrcStampingView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcStamping' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
  
  public function TrcWelding(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWelding'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcWeldingDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWelding' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcWeldingUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWelding' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function TrcWeldingView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcWelding' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
  
  public function TrcICT(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcICT'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function TrcICTDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcICT' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcICTUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcICT' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function TrcICTView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcICT' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
  public function TrcNonStamping(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcNonStamping'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function TrcNonStampingDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcNonStamping' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcNonStampingUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcNonStamping' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function TrcNonStampingView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcNonStamping' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
 public function TrcDailyGAPUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='DailyGAP' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
 
 public function TrcBPFG(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcBPFG'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
  public function TrcPOCust(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='PO Customer'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function TrcPOCustDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='PO Customer' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 public function TrcPOCustUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='PO Customer' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
public function TrcPOCustView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='PO Customer' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function TrigerView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='Triger' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

 public function MProdWip(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdWip' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function MProdWipDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdWip' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function MProdWipUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdWip' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
public function MProdWipView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MProdWip' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

   public function TrcSJ(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcSJ'";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
 public function MSJ(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MSJ' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
 
 public function TrcSJConfirm(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcSJConfirm' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
 
  public function Tracer(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='Tracer' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
public function TracerDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='Tracer' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TracerUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='Tracer' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
public function TracerView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='Tracer' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcSJConfirmMkt(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcSJConfirmMkt' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
 public function TrcSJWH(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcSJWH' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
 public function MPartner2(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='MPartner2' ";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
 
public function TrcAdministration(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='Administration' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }   
 
public function TrcTTIDel(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcTTI' AND DelData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }

public function TrcTTIUp(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcTTI' AND UpData=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; } 
 
public function TrcTTIView(){
 $id = $this->session->userdata('SysID');
 $t = "SELECT SysID FROM QM_UserRole WHERE SysID='$id' AND ObjTitle='TrcTTI' AND ViewJurnal=1";
 $d = $this->app_model->manualQuery($t);
 $r = $d->num_rows();
 if($r>0){
 $hasil = $r;
 }else{
 $hasil = 0; }
 return $hasil; }
 
 }