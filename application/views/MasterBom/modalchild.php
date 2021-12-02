<!-- start modalchild -->
<style>

/* dragula-specific example page styles */
.wrapper1 {
  display: table;
  height: 300px;
    /* max-width: 760px; */
    min-height: 435px !important;
    
    min-width: 100%;   
    /* 
    margin-right:auto;
    margin-left:auto;
    margin-top:40px;
    */
}
.cont-dragula {
  display: table-cell;
  background-color: rgba(255, 255, 255, 0.2);
  width: 50%;
  padding: 0;
}
.cont-dragula:nth-child(odd) {
  background-color: rgba(0, 0, 0, 0.2);
}
/*
 * note that styling gu-mirror directly is a bad practice because it"s too generic.
 * you"re better off giving the draggable elements a unique class and styling that directly!
 */
.cont-dragula > div,
.gu-mirror {
  margin: 10px;
  padding: 10px;
  background-color: rgba(0, 0, 0, 0.2);
  transition: opacity 0.4s ease-in-out;
}
.cont-dragula > div {
  cursor: move;
  cursor: grab;
  cursor: -moz-grab;
  cursor: -webkit-grab;
}

.cont-dragula > li {
  margin: 10px;
  padding: 10px;
  background-color: rgba(0, 0, 0, 0.2);
  transition: opacity 0.4s ease-in-out;  
}

.cont-dragula > li {
  cursor: move;
  cursor: grab;
  cursor: -moz-grab;
  cursor: -webkit-grab;
}

.gu-mirror {
  cursor: grabbing;
  cursor: -moz-grabbing;
  cursor: -webkit-grabbing;
}
.cont-dragula .ex-moved {
  background-color: #e74c3c;
}
.cont-dragula.ex-over {
  background-color: rgba(255, 255, 255, 0.3);
}
#left-lovehandles > div,
#right-lovehandles > div {
  cursor: initial;
}
.handle {
  padding: 0 5px;
  margin-right: 5px;
  background-color: rgba(0, 0, 0, 0.4);
  cursor: move;
}

.gu-mirror {
  position: fixed !important;
  margin: 0 !important;
  z-index: 9999 !important;
  opacity: 0.8;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=80)";
  filter: alpha(opacity=80);
  list-style-type: none;
}
.gu-hide {
  display: none !important;
}
.gu-unselectable {
  -webkit-user-select: none !important;
  -moz-user-select: none !important;
  -ms-user-select: none !important;
  user-select: none !important;
}
.gu-transit {
  opacity: 0.2;
  -ms-filter: "progid:DXImageTransform.Microsoft.Alpha(Opacity=20)";
  filter: alpha(opacity=20);
}
.wrapper1 {
  /* background-color: #942A57; 
  max-width: 760px; */
}


.promo {
  margin-bottom: 0;
  font-style: italic;
  padding: 10px;
  background-color: #ff4020;
  border-bottom: 5px solid #c00;
}



.parent {
  background-color: rgba(255, 255, 255, 0.2);
  margin: 50px 0;
  padding: 20px;
}


.gh-fork {
  position: fixed;
  top: 0;
  right: 0;
  border: 0;
}

.parent > label {
    color: #fff;
}

#left1 > li, #right1 > li {
  list-style-type: none;
}


</style>
<body>
<input type="text" id="PartNoList" class="form-control" placeholder="PartNo">
<div class="wrapper1 panel panel-body">
<ul id="left1" class="cont-dragula">
    <h5><center><b>List Part</b></center></h5>
</ul>
<ul id="right1" class="cont-dragula">
    <h5><center><b>Drop Here</b></center></h5>
    <?php if(isset($listchild))
    {
        foreach($listchild as $row)
        {
            echo '<li data-ref="'.$row->ItemID.'">'.$row->PartNo.' - '.$row->PartName.'</li>';    
        }
    }
    ?>
</ul>
</div>
</body>
<script src='<?php echo base_url();?>/assets/plugins/dragula/dragula.js'></script>
<script>
var $sel = $('#right1'),
    $o = $sel.children('li').toArray().reverse();
    $sel.append($o);
    
drake = dragula([left1, right1]);
var leftList = document.querySelector('#left1');
var rightList = document.querySelector('#right1');
var list = document.querySelectorAll('#right1 li, #left1 li');
    $('#PartNoList').on('keyup',function(){
        var par = [];
        $.each($('#right1 li'),function(i,x){
            par.push($(this).attr('data-ref'));
        });
        
        //console.log($(this).val());
        GetListPart(this,par,$('#ItemIDSys2').val());
    });

</script>
<!-- end modalchild -->