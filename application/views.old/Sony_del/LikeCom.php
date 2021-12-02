<?php
foreach($data->result_array() as $db){  
$Like = $db['LikeCom'] ;
if(empty($qtyLike)){$QtyLike = 0 ;}else{$QtyLike = $db['LikeCom'] ;} ?> 
        
<?php echo $QtyLike ; ?>
        
<?php } ?>