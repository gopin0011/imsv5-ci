<!-- ExportListReport.view -->

<?php foreach($list as $r =>$v)
{
    header("Content-type: application/x-msdownload");
    header("Content-Disposition: attachment; filename=".$DocNum."_.xls");
    header("Pragma: no-cache");
    header("Expires: 0");
    ?>
    <form class="form-horizontal" id="myForm">
    <input type="hidden" name="RegID" id="RegID" value="<?php echo $RegID;?>">
    <table id="aaa" class="table table-bordered table-striped" >
    <thead>
    <tr>
        <th colspan="2" align="left">Dari Area</th>
        <th align="left">: <?php echo $diserahkan[2];?></th>
        <th align="left">Diserahkan</th> 
        <th colspan="3" align="left">: <?php echo $diserahkan[1];?></th>
    </tr>
    <tr>
        <th colspan="2" align="left">Ke Area</th>
        <th align="left">: <?php echo $diterima[2];?></th>
        <th align="left">Diterima</th> 
        <th colspan="3" align="left">: <?php echo $diterima[1];?></th>
    </tr>
    <tr>
        <th colspan="2" align="left">Tanggal</th>
        <th align="left">: <?php echo $DocDate;?></th>
        <th align="left">DocNum</th> 
        <th colspan="3" align="left">: <?php echo $DocNum.$DocNumDetail;?></th>
    </tr>
    <tr>
        <th colspan="2" align="left">Shift</th>
        <th align="left" colspan="4">: <?php echo $shift;?></th>
    </tr>          
    <!--
        <div class="panel-body">
            <div class="col-md-6">
                <div class="form-group">
                <label class="control-label text-left">: <?php echo $diserahkan[2];?></label>
                </div>
                <div class="form-group">
                <label class="control-label text-left">Ke Area: <?php echo $diterima[2];?></label>
                </div>
                
                <div class="form-group">
                <label class="control-label text-left">Tanggal: <?php echo $DocDate;?></label>
                </div>
                
                <div class="form-group">
                <label class="control-label text-left">Shift: <?php echo $shift;?></label>
                </div>
            </div>
            
            <div class="col-md-6 text-left">
                <div class="form-group">
                <label class="control-label text-left">Diserahkan: <?php echo $diserahkan[1];?></label>
                </div>
                
                <div class="form-group">
                <label class="control-label text-left">Diterima: <?php echo $diterima[1];?></label>
                </div>
            
                
                <label class="control-label text-left">DocNum: <?php echo $DocNum;?><?php echo $DocNumDetail;?></label>
            </div>
        </div> 
        -->
    <tr style="background-color: yellow;">
    <th width="20">No</th>
    <th width="100">DocNum</th>
    <th width="200">Part No.</th>
    <th width="300">Part Name</th>
    <th width="40">Customer</th>
    <th width="70">Total</th>
    <th>Keterangan</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $no = 1;
        foreach($v['data'] as $vv)
        {
            echo'<tr id="'.$vv->RegID.'">
                     <th>'.$no.'</th>
                     <th>'.$vv->Raw_DocNum.'</th>
                     <th>'.$vv->PartNo.'</th>
                     <th>'.$vv->PartName.'</th>
                     <th>'.$vv->Code.'</th>
                     <th><span id="Qty_'.$vv->RegID.'">'.$vv->QtyMat.'</span></th>
                     <th><span id="Ket_'.$vv->RegID.'">'.$vv->ket.'</span></th>
                 </tr>';
            $no++;
        }
    ?>    
    </tbody>
    </table>   
    </form> 
    <?php
}
?>

<!-- ExportListReport.view -->