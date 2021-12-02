<script>
function textAreaAdjust(o) {
    o.style.height = "55px";
    o.style.height = (22+o.scrollHeight)+"px";
    tampil_data();
}
</script>
<script>
function textAreaAdjustOut(o) {
o.style.height = "77px";
o.style.border.right = "none" ;
o.style.border.bottom = "none" ;
o.style.border.top = "none" ;
tampil_data();
}
</script>

<script>
function bigImg(x) {
    x.style.height = "21px";
    x.style.width = "21px";
}

function normalImg(x) {
    x.style.height = "20px";
    x.style.width = "20px";
}
</script>
 <style>
.circular2-image img {
 width: 80px;
 height: 80px;
 -webkit-border-radius: 40px;
 -moz-border-radius: 40px;
 -ms-border-radius: 40px;
 -o-border-radius: 40px;
 border-radius: 40px;
 }
 textarea:focus {
    outline: none !important;
}
</style>


<?php $no=0; foreach($forums as $row): 
$no++;
$IDTes1 = $row->idcoment ;
$IDTes2 = '888' ;
$IDTes = $IDTes1.''.$IDTes2 ;
$QtyComentX = $row->LikeCom ;
if(empty($QtyComentX)){
$QtyComent = '0'  ;  
}else{
$QtyComent = $QtyComentX ;    
}
$IDCollapseX = $row->idcoment.'XX' ;
$IDCollapse = '#'.$IDCollapseX ;
$IDCollapseXX = $row->idcoment.'XXX' ;
$ButtonSave = $row->idcoment.'Save' ;
$ComentXXX = $row->idcoment.'XXXX' ;
$ComentXXXX = $row->idcoment.'XXXXX' ;
$ButtonReload = $row->idcoment.'Reload' ;
$IDQtyComent = $row->idcoment.'QtyComent' ;
$QtyComentDetail = $row->QtyComent ;
$ButtonKolom = $row->idcoment.'Kolom' ;
?>

<div class="box-body">
<div class="box">
<div class="box-body">

<div id="myTabContent" class="tab-content">

 <div class="box-header with-border">
 <div class="user-block">
 <img class="img-circle" src="<?php echo base_url();?>images/foto_profil/<?php echo $row->foto ;?>" alt="User Image">
 <span class="username"><a href="#"><?php echo $row->username  ; ?></a></span>
 <span class="description"><?php echo (date('j F Y',strtotime($row->tgl_in))); ?> <?php echo $row->jam ; ?></span>
 </div>
 </div>
 
 <div class="box-body" >
 <p><textarea onmouseover="textAreaAdjust(this)" class="col-xs-12" readonly="true" rows="3" style="border-top: none; border-bottom: none; border-right: none; border-left: none;  resize: none; overflow: hidden;">
 <?php echo $row->coment ; ?></textarea></p>
 <button onfocus="TesLike('<?php echo $row->idcoment ; ?>')" onclick="LikeAdd('<?php echo $row->idcoment ; ?>', '<?php echo $IDTes ; ?>')" type="button" class="btn btn-default btn-xs">
 <i class="fa fa-thumbs-o-up"></i> Like</button>
 <span class="pull-right text-muted">
 <input type="text" style="width: 10px; border: none;" id="<?php echo $row->idcoment;?>" value="<?php echo $QtyComent ; ?>" readonly="true"/> 
 likes - 
 <a class="text-muted" onclick="ViewComment('<?php echo $row->idcoment;?>','<?php echo $IDCollapseXX ;?>')" href="<?php echo $IDCollapse ; ?>" data-toggle="collapse" data-parent="#accordion">
 <input type="text" style="width: 10px; border: none;" id="<?php echo $IDQtyComent ;?>" value="<?php echo $row->QtyComent ; ?>" readonly="true"/> comments</a>
 </span>
 </div>

 
 <div id="<?php echo $IDCollapseX ;?>" class="collapse">


 <div id="<?php echo $IDCollapseXX ;?>"></div>
 <div  id="<?php echo $ButtonKolom ; ?>">
 <div class="box-footer">
 <form action="#" method="post">
 <img class="img-responsive img-circle img-sm" src="<?php echo base_url();?>images/foto_profil/<?php echo $this->session->userdata('foto'); ;?>" alt="Alt Text">
 <div class="img-push">
 <input type="text" id="<?php echo $ComentXXXX ;?>" class="form-control" placeholder="Press enter to post comment">
 <input type="text" id="<?php echo $ComentXXX ;?>" value="<?php echo $row->idcoment;?>" hidden=""> 
 </div>
 </form>
 </div>
 <div class="panel-footer">
 <div class="btn-group" data-toggle="btn-toggle">
 <button id="<?php echo $ButtonSave ;?>" onclick="Save('<?php echo $row->idcoment ;?>','<?php echo $ComentXXXX ;?>','<?php echo $ButtonSave ;?>','<?php echo $ButtonReload ;?>','<?php echo $ButtonKolom ; ?>')" class="btn btn-success"><i class="fa fa-send"></i> Send</button>
 <button type="button" class="btn btn-primary" id="<?php echo $ButtonReload ; ?>" onclick="Reload2('<?php echo $row->idcoment;?>','<?php echo $IDCollapseXX ;?>','<?php echo $ButtonReload ;?>','<?php echo $IDQtyComent ;?>')" data-loading-text="<i class='fa fa-spinner fa-spin '></i> Processing...">
 <i class="fa fa-refresh"></i>&nbsp; Refresh</button>
 </div></div>
 </div>
  </div>
 </div></div></div></div>
 <?php endforeach;?>

  

    