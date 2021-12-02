 <?php $no=0; foreach($list as $row): 
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
?>
 <div class="box-footer box-comments">
 <div class="box-comment">
 <img class="img-circle img-sm" src="<?php echo base_url();?>images/foto_profil/<?php echo $row->foto ;?>" alt="User Image">
 <div class="comment-text">
 <span class="username">
 <?php echo $row->username  ; ?>
 <span class="text-muted pull-right"><?php echo (date('j F Y',strtotime($row->tgl_in))); ?> <?php echo $row->jam ; ?></span>
 </span>
 <?php echo $row->coment ; ?>
 </div>
 </div>
 </div>

<?php endforeach;?>