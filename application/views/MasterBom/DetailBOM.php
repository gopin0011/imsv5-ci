
<div class="">
<div class="panel panel-default">
<div class="panel-heading"><h3>Detail</h3></div>
<div class="panel-body">
            
<table id="t_transaction_detail" class="table table-striped table-bordered" cellspacing="0" width="100%">
<thead style="background: aquamarine;">
<tr class="headings">
<th>Item No.</th>
<th>Part No</th>
<th>Part Name</th>
<th>Customer</th>
<th>Project</th>
<th>PartType</th>
<th>Action</th>
</tr> 
</thead>
<tbody>
<?php
if ($num > 0) {
$no = 1;
foreach ($data as $row) {; 
$ItemNoA[] = $row->ItemNo;
?>
<tr class="odd gradeX">
<td align="center" width="70"><span class="label label-success"><?php echo $row->ItemNo ; ?></span></td>
<td align="left" width="120" ><?php echo $row->PartNo; ?></td>
<td align="left" width="300"><?php echo $row->PartName; ?></td>
<td align="left" width="40" ><?php echo $row->Code; ?></td>
<td align="left" width="40" ><?php echo $row->ProjectName; ?></td>
<td align="center" width="40" ><span class="label label-info"><?php echo $row->PartType; ?></span></td>
<td align="center" width="30">
<a style="cursor: pointer;" data-toggle="collapse" data-target="#<?php echo $row->SysID; ?>-head" class="accordion-toggle">
<i class="glyphicon glyphicon-eye-open"></i></a>
<?php  $cek = $this->Role_Model->MBomUp(); if(!empty($cek)){ ?>
<a onfocus="PilihEditHead('<?php echo $row->SysID; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-cog"></i> </a>
<?php  $cek = $this->Role_Model->MBomDel(); if(!empty($cek)){ ?>
<a onfocus="PilihHapusHead22('<?php echo $row->SysID ; ?>','<?php echo $row->PartNo ; ?>')" href="#tab_content1" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-trash"></i> </a>
<?php } ?><?php } ?>
</td>
<tr>
<td colspan="12" class="hiddenRow">
<div class="collapse" id="<?php echo $row->SysID; ?>-head"> 
<table class="table table-striped table-striped table-bordered responsive-utilities jambo_table bulk_action">
<thead>
<tr><th colspan="4" class="text-center " style="background-color: goldenrod;">Info</th></tr>
<tr>
<th class="text-center">Packing Type</th>
<th class="text-center">STD Packing</th>
<th class="text-center">WH Location</th>
<th class="text-center">Supplier</th>
</tr>
</thead>
<tbody>
<tr class="text-center">
<td><?php echo $row->PackingType; ?></td>
<td><?php echo $row->StdPack; ?></td>
<td><?php echo $row->FGLocation; ?></td>
<td><?php echo $row->partner_name; ?></td>
</tr>
</tbody>
</table>          
</div></td>
</tr>              
</tr>
<?php $no++;  } }  ?>
</tbody> </table> 
<br /><hr />
<form id="form_detail">
<table id="t_transaction_detail2" class="table table-condensed table-striped" style="border-collapse:collapse;">
<thead style="background: aqua;">
<tr>
    <td colspan="8"><a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Add Component</a></td>
</tr>
<tr>
<th>Item No.</th>
<th>Part No</th>
<th>Part Name</th>
<th>Images</th>
<th>Customer</th>
<th>Project</th>
<th>PartType</th>
<th>Action</th>
</tr>
</thead>
<script type="text/javascript">
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>   
<tbody> 
<?php
if ($num2 > 0) {
$no = 0;
$j = 1;
$no1=$no2=$no3=0;
$no = array();
$no[1] = $no[2] = $no[3] = $no[4] = 0;
//$no[2] = 1;
//$no[3] = 1;
//$no[4] = 1;
foreach ($data2 as $db) {  
    $OP5 = $db->OP5 ; $OP10 = $db->OP10 ; $OP20 = $db->OP20 ; $OP30 = $db->OP30 ; $OP40 = $db->OP40 ;
    $OP50 = $db->OP50 ; $OP60 = $db->OP60 ; $OP70 = $db->OP70 ;
    
    if(empty($OP5)){$OP5='-';}  if(empty($OP10)){$OP10='-';} if(empty($OP20)){$OP20='-';} if(empty($OP30)){$OP30='-';} 
    if(empty($OP40)){$OP40='-';} if(empty($OP50)){$OP50='-';} if(empty($OP60)){$OP60='-';} if(empty($OP70)){$OP70='-';} 
    
    $OP5M1 = $db->OP5M ;
    if(empty($OP5M1)){$OP5M='-';}else{
    $OP5M = $this->app_model->CariMachine($OP5M1) ;}
    
    $OP5M2 = $db->OP10M ;
    if(empty($OP5M2)){$OP10M='-';}else{
    $OP10M = $this->app_model->CariMachine($OP5M2) ;}
    
    $OP5M3 = $db->OP20M ;
    if(empty($OP5M3)){$OP20M='-';}else{
    $OP20M = $this->app_model->CariMachine($OP5M3) ;}
    
    $OP5M4 = $db->OP30M ;
    if(empty($OP5M4)){$OP30M='-';}else{
    $OP30M = $this->app_model->CariMachine($OP5M4) ;}
    
    $OP5M5 = $db->OP40M ;
    if(empty($OP5M5)){$OP40M='-';}else{
    $OP40M = $this->app_model->CariMachine($OP5M5) ;}
    
    $OP5M6 = $db->OP50M ;
    if(empty($OP5M6)){$OP50M='-';}else{
    $OP50M = $this->app_model->CariMachine($OP5M6) ;}
    
    $OP5M7 = $db->OP60M ;
    if(empty($OP5M7)){$OP60M='-';}else{
    $OP60M = $this->app_model->CariMachine($OP5M7) ;}
    
    $OP5M8 = $db->OP70M ;
    if(empty($OP5M8)){$OP70M='-';}else{
    $OP70M = $this->app_model->CariMachine($OP5M8) ;}
    
    $LineAssyM = $db->LineAssy;
    if(empty($LineAssyM)||$LineAssyM=='null'){$LineAssy='-';}else{
    $LineAssy = $this->app_model->CariMachine($LineAssyM) ;}
    
    //if(strpos($db->PartType,'RM')!==false)
    //    $ItemNo = '';
    //else
    //{
    /*
        $ItemNo = $db->ItemNo;
        if($db->level == 1)
        {
            $no1++;
            $no2 = 0;
            $ItemNo = $ItemNo.'.'.$no1;
        }
        else if($db->level == 2)
        {
            $no2++;
			$no3 = 0;
            $ItemNo = $ItemNo.'.'.$no1.'.'.$no2;
        } else 
        {
            $no3++;
            $ItemNo = $ItemNo.'.'.$no1.'.'.$no2.'.'.$no3;
        }
   */
    //}
    
    //if(strpos($db->PartType,'RM')!==false){
    //    $ItemNo='';
    //} else{
    //    $ItemNo = $ItemNo;
    //}
    $ItemNo = $db->ItemNo;
    $y = $db->level;
    for($i=1;$i<=$db->level;$i++)
    {
        if($db->level == $i)
        {
            $no[$i] += 1;
            $no[$i+1] = 0;    
        }
        //$no[$i+1] = 0;
        $ItemNo .= '.'.$no[$i];
    }
    //echo"<pre>";
    //print_r($no[$y]);
    //echo"</pre>";
    $FGCek = substr($db->PartType,0,2)=='FG';
    if(empty($FGCek)){$FG= $db->SysID2 ;}else{
    $FG= '' ;}
    
    ; ?> 


<tr id="<?php echo $db->ItemSys;?>">
<td align="left" width="70"><span class="label label-default"><?php echo $ItemNo ; ?></span></td>
<td align="left" width="120" ><?php echo $db->PartNo; ?><input type="hidden" class="detailItem" name="detailItem<?php echo $db->ItemID;?>" value="<?php echo $db->ItemID; ?>" /> </td>
<td align="left" width="300"><?php echo $db->PartName; ?></td>
<td align="center" width="70"><img class="img-circle" src="<?php echo base_url();?>uploads/<?php echo $db->Images; ?>" height="75px" width="75px"></td>
<td align="left" width="60" ><?php echo $db->Code; ?></td>
<td align="left" width="40" ><?php echo $db->ProjectName; ?></td>
<td align="left" width="40" ><span class="label label-info"><?php echo $db->PartType ; ?></span></td>
<td align="center" width="30">



<?php  $cek2 = substr($db->PartType,0,2)=='FG'; if(empty($cek2)){ ?>
<a style="cursor: pointer;" data-toggle="collapse" data-target="#<?php echo $db->num; ?>" class="accordion-toggle">
<i class="glyphicon glyphicon-eye-open"></i></a>

<?php  $cek = $this->Role_Model->MBomUp(); if(!empty($cek)){ ?>
<a onfocus="PilihEditDetail('<?php echo $db->SysID; ?>','<?php echo $db->SysID2; ?>','<?php echo $db->ItemID; ?>')" href="#tab_content11" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-cog"></i> </a>
<?php } ?>
<?php  $cek = $this->Role_Model->MBomDel(); if(!empty($cek)){ ?>
<a onfocus="PilihHapusDetail('<?php echo $db->SysID2 ; ?>','<?php echo $db->PartNo ; ?>','<?php echo $db->ItemSys; ?>','<?php echo $db->level; ?>')" href="#tab_content2" data-toggle="tab" aria-expanded="false" >
<i class="glyphicon glyphicon-trash"></i> </a>
<?php } ?>            
<?php } ?>
</td>


        

</tr>
<tr id="d<?php echo $db->ItemSys;?>">
<td colspan="12" class="hiddenRow">
<div class="collapse" id="<?php echo $db->num ; ?>"> 
<table class="table table-striped table-striped table-bordered">
<?php $cek3 = substr($db->PartType,0,2)=='RM'; if(!empty($cek3)){ ?>
<thead>
                        <tr>
                        <th colspan="8" class="text-center " style="background-color: blueviolet;">Material Spec</th>
                        </tr>
                        <tr>
                        <th class="text-center">Type</th>
                        <th class="text-center">Spec</th>
                        <th class="text-center">T</th>
                        <th class="text-center">W</th>
                        <th class="text-center">L</th>
                        <th class="text-center">Pcs/Sheet</th>
                        <th class="text-center">Kg/Sheet</th>
                        <th class="text-center">Part Weight</th>
                        </tr>
                      </thead>
                      
                        <tr class="text-center">
                        <td><?php echo $db->MaterialType; ?></td>
                        <td><?php echo $db->Spec; ?></td>
                        <td><?php echo number_format($db->Thick,2); ?></td>
                        <td><?php echo $db->Width; ?></td>
                        <td><?php echo $db->Length; ?></td>
                        <td><?php echo $db->PcsPerSheet; ?></td>
                        <td><?php echo $db->KgPerSheet; ?></td>
                        <td><?php echo $db->PartWeight; ?></td>
                        </tr>
                      
                      
<thead>
 <tr>
 <th colspan="8" class="text-center " style="background-color: green;">Material Spec Order</th>
 </tr>
 <tr>
 <th colspan="4" class="text-center">Spec</th>
 <th colspan="4" class="text-center">Size</th>
 </tr>
 </thead>
 
 <tr class="text-center">
 <td colspan="4"><?php echo $db->SpecOrder1; ?></td>
 <td colspan="4"><?php echo $db->SpecOrder2; ?></td>
 </tr>
 
                      
                      <?php } ?>
                      
               	</table>
                <br />
                <?php $cek4 = substr($db->PartType,0,2)=='RM'; if(empty($cek4)){ ?>
                <table class="table table-striped">
                      
                      <thead>
                        <tr>
                        <th colspan="8" class="text-center" style="background-color: green;">Dies Proccess / Machine Line</th>
                        </tr>
                        <tr>
                        <th align="center">OP5</th>
                        <th align="center">OP10</th>
                        <th align="center">OP20</th>
                        <th align="center">OP30</th>
                        <th align="center">OP40</th>
                        <th align="center">OP50</th>
                        <th align="center">OP60</th>
                        <th align="center">OP70</th>
                        </tr>
                      </thead>
                      
                        <tr>
                        <td align="left"><?php echo $OP5 ; ?></td>
                        <td align="left"><?php echo $OP10 ; ?></td>
                        <td align="left"><?php echo $OP20; ?></td>
                        <td align="left"><?php echo $OP30; ?></td>
                        <td align="left"><?php echo $OP40; ?></td>
                        <td align="left"><?php echo $OP50; ?></td>
                        <td align="left"><?php echo $OP60; ?></td>
                        <td align="left"><?php echo $OP70; ?></td>
                        </tr>
                        <tr>
                        <td align="left"><?php echo $OP5M ; ?></td>
                        <td align="left"><?php echo $OP10M ; ?></td>
                        <td align="left"><?php echo $OP20M; ?></td>
                        <td align="left"><?php echo $OP30M; ?></td>
                        <td align="left"><?php echo $OP40M; ?></td>
                        <td align="left"><?php echo $OP50M; ?></td>
                        <td align="left"><?php echo $OP60M; ?></td>
                        <td align="left"><?php echo $OP70M; ?></td>
                        </tr>
                      
                      
                      
                      
                      
               	</table>
                
                <table class="table table-striped table-striped table-bordered responsive-utilities jambo_table bulk_action">
                <thead>
                <tr>
                <th colspan="4" class="text-center " style="background-color: goldenrod;">Assy</th>
                </tr>
                <tr>
                <th class="text-center">ProcessAssy</th>
                <th class="text-center">LineAssy</th>
                
                </tr>
                 </thead>
                 
                 <tr class="text-center">
                 <td><?php echo $db->ProcessAssy; ?></td>
                 <td><?php echo $LineAssy; ?></td>
                  
                  </tr>
                  
                  </table>
                  
                  
                  <table class="table table-striped table-striped table-bordered responsive-utilities jambo_table bulk_action">
                      
                     
                      <thead>
                        <tr>
                        <th colspan="4" class="text-center " style="background-color: goldenrod;">Info</th>
                        </tr>
                        <tr>
                        <th class="text-center">Packing Type</th>
                        <th class="text-center">STD Packing</th>
                        <th class="text-center">WH Location</th>
                        <th class="text-center">Supplier</th>
                        </tr>
                      </thead>
                      
                        <tr class="text-center">
                        <td><?php echo $db->PackingType; ?></td>
                        <td><?php echo $db->StdPack; ?></td>
                        <td><?php echo $db->FGLocation; ?></td>
                        <td><?php echo $db->partner_name; ?></td>
                        </tr>
                      
                    </table>
                
              <?php } ?>
              </div> </td>
        </tr>

<?php $no++; } 

}  ?>
</tbody>
</table>
</form>
</div></div></div>


     
<script type="text/javascript"> 
    var linkid = $("#SysIDDetail").val();

function PilihEditHead(id){
	$("#ItemID").val(id);
    setTimeout(function(){
					$("#ItemID").focus();
					$("#ItemID").click();
                    
          setTimeout(function(){
					$("#ItemID").focus();
					$("#ItemID").click();
				},300) ;
				},500) 
			return false();
	 
    }
</script>

<script type="text/javascript"> 
function PilihEditDetail_old(id,LinkID){
	$("#ItemID").val(id);
    $("#ItemID2").val(LinkID);
    $("#LinkID").val(id);
    setTimeout(function(){
					$("#LinkID").focus();
					$("#LinkID").click();
                    
          setTimeout(function(){
					$("#LinkID").focus();
					$("#LinkID").click();
				},300) ;
				},500) 
			return false();
	 
    }
    
function PilihEditDetail(id,LinkID,ItemID)
{
    editthisBOM2(ItemID);
    return false();
}
</script>

<script type="text/javascript"> 
function PilihHapusDetail(SysID,PartNo,ItemSys,level){
    $("#DocNumDetailDelete2").val(ItemSys);
    $("#LevelDetailDelete2").val(level);
     $("#myModal3434").modal('show');
     $("#pesan34").text("Anda yakin menghapus?");
     $("#PartNoDelete2").text(PartNo); 
	};
    </script>
    
    <script type="text/javascript"> 
function PilihHapusHead22(SysID,PartNo){
    $("#DocNumDetailDelete").val(SysID);
     $("#myModal3333").modal('show');
     $("#pesan3").text("Anda yakin menghapus bro ?");
     $("#PartNoDelete").text(PartNo); 
	};
    </script>

    