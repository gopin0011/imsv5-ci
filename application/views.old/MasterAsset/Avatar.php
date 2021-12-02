<?php foreach($list as $row):  $Image =  $row->Image ; ?>
				  
<div class="form-group"><div class="col-lg-12">
<div class="avatar-view2" style="float: right;" title="">
<img class="img-responsive" src="<?php echo base_url(); ?>images/FotoAsset/<?php echo $Image ?>" alt="Avatar"></div>
</div></div>

<?php endforeach ;?>