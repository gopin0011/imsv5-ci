<!-- DetailTrc.view -->


<form action="#" method="POST" class="form-horizontal"  name="formD" id="formD">
<input type="hidden" name="TH_RawMaterialID" id="TH_RawMaterialID" value="<?php echo $RegID;?>">
<div id="tampil_data_produksi_d">
        <div class="panel-body">
            <div class="col-md-6">
                
                
                
                
                <div class="form-group">
                <label class="col-xs-4 control-label">Tanggal</label>
                <div class="col-xs-4">
                <input id="DocDate" class="form-control" name="DocDate" readonly="readonly" type="text" value="<?php echo $head['DocDate'];?>">
                </div>
                </div>
                
                
                <div class="form-group">
                <label class="col-xs-4 control-label">Dari Area</label>
                <div class="col-xs-8">                
                <input type="text" id="FromArea" name="FromArea"  class="form-control" value="<?php echo $dari_area;?>" readonly="readonly" >
                </div></div>
                
                <div class="form-group">
                <label class="col-xs-4 control-label">Ke Area</label>
                <div class="col-xs-8">
                <!--<input type="text" id="ToArea" name="ToArea"  class="form-control" value="<?php echo $head['diterima'][2];?>">-->
                <select name="ToArea" id="ToArea" class="form-control">
					<option value="">PILIH</option>
					<?php foreach($area as $t) { ?>
                    <?php if($t->SysID == '25') $selected='selected="selected"';
                          else $selected = ''; ?>
					<option value="<?php echo $t->SysID;?>" <?php echo $selected;?>><?php echo $t->SysID;?> - <?php echo $t->Location;?></option>
					<?php } ?>  
				</select>
                </div></div>
            </div>
            
            <div class="col-md-6">
                <div class="form-group">
                <label class="col-xs-4 control-label">Diserahkan</label>
                <div class="col-xs-4">
                <input id="picFrom" class="form-control" name="picFrom" readonly="true" type="text" value="<?php echo $head['diserahkan'][0];?>">
                </div>
                <div class="col-xs-4">
                <input id="picFromName" class="form-control" name="picFromName" placeholder="Nama Pic" readonly="true" type="text" value="<?php echo $head['diserahkan'][1];?>">
                </div>
                </div>
                
                <div class="form-group">
                <label class="col-xs-4 control-label">Diterima</label>
                <div class="col-xs-4">
                <input id="picTo" class="form-control" name="picTo" readonly="true" type="text" value="<?php echo $head['diterima'][0];?>">
                </div>
                <div class="col-xs-4">
                <input id="picToName" class="form-control" name="picToName" placeholder="Nama Pic" readonly="true" type="text" value="<?php echo $head['diterima'][1];?>">
                </div>
                </div>
            
                <div class="form-group">
                <label class="col-xs-4 control-label">DocNum</label>
                <div class="col-xs-5">
                <input id="DocNum" class="form-control" name="DocNum" readonly="readonly" type="text" value="<?php echo $head['DocNum'];?>">
                </div>
                <div class="col-xs-3">
                <input id="DocNumDetail" class="form-control" name="DocNumDetail" readonly="readonly" type="text" value="<?php echo $head['DocNumDetail'];?>">
                </div></div>
            </div>
        </div>

    <table id="t_list_transaction_d" class="table table-bordered table-striped">
    <thead>
    <tr>
    <th>No</th>
    <th>Part No.</th>
    <th>Part Name</th>
    <th>Customer</th>
    <th>Total</th>
    <th>Keterangan</th>
    <th>Dari Area</th>
    </tr>
    </thead>
    <tbody>
    <?php
        $no = 0;
        foreach($list as $row => $val)
        {
            $no++;
            //echo"<pre>";
            //print_r($val);
            //echo"</pre>";
            echo "<tr><th><input type='hidden' value='".$val->RegID."' name='dbRegId[]'><input type='hidden' value='".$val->ItemID."' name='ItemID[".$val->RegID."]'>".$no."</th><th>".$val->PartNo."</th><th>".$val->PartName."</th><th>".$val->Code."</th><th><div class='col-xs-8'><input id='' name='QtyMat[".$val->RegID."]' class='form-control Qty' type='text' value='".$val->QtyMat."' placeholder='".$val->QtyMat."' onkeypress='return onlynumber(event);' ></div></th><th><input id='' name='ket[".$val->RegID."]' class='form-control' type='text' value='".$val->Remark."'></th><th>".$val->FromArea."</th></tr>";
        }
    ?>
    </tbody>
    <!--
    <tfoot>
    <tr>
        <td colspan="6" align="right">
            <div class="btn-group" data-toggle="btn-toggle">
                <button id="simpan_detail" class="btn btn-success" type="button" name="simpan" onclick="save_d();"><i class="fa fa-save"></i>
                Save
                </button>
            </div>
        </td>
    </tr>
    </tfoot>
    -->
    </table>
</div>
</form>

<script> $(function () { $("#t_list_transaction_d").DataTable(); });</script>
<script>
  function NotifSuccsess(data){
    new PNotify({
    title: 'Info',
    type: 'info',
    text: data,
    hide: true
    }); };
    function NotifFail(data){
    new PNotify({
    title: 'Info',
    type: 'error',
    text: data,
    hide: true
    }); }; 
    function NotifProses(data){
    new PNotify({
    title: 'Info',
    type: 'dark',
    text: data,
    hide: true
    }); };
</script>
<!-- DetailTrc.view -->