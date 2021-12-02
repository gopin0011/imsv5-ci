<!-- start UnConfirm.view -->

<form id="form_confirm">
    <input type="hidden" name="RegID" id="RegID" value="<?php echo $RegID;?>" />
    <div class="form-group">
        <label class="control-label col-sm-2">Keterangan</label>
        <div class="col-sm-10">
        <textarea id="Remark" class="form-control" name="Remark"><?php echo $Keterangan;?></textarea>
        </div>
    </div>
    <div class="col-sm-2">&nbsp</div>
    <div class="col-sm-10"><hr /><button class="btn btn-success" type="button" id="save_confirm">Save</button></div>
</form>

<script>
    $('#save_confirm').click(function(){
        var form = $('#form_confirm').serialize();
        if($('#Remark').val()!='')
        {
            $.ajax({
                type	: 'POST',
                url		: "<?php echo site_url(); ?>/SuratJalan/SaveConfirmStatus/",
                data	: "type=2&"+form,
                cache	: false,
                success	: function(data)
                {
                    $('#tolak').attr({'class':'btn btn-default active','onclick':'proses_confirm(this,0);'});
                    $('#IsConfirm').val('2');
                    $("#myModal_confirm").modal('hide');
                    NotifSuccsess(data);
                    $('#Home3a').trigger('click');
                } 
            });
        }
        else
        {
            NotifSuccsess('Keterangan masih kosong');
        }        
    });
</script>
<!-- end UnConfirm.view -->