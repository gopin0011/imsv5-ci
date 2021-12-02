<!-- start Confirm.view -->
<style>
.typeahead {
	background-color: #FFFFFF;
}
.typeahead:focus {
	border: 2px solid #0097CF;
}
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
    visibility:hidden;
}
.tt-menu {
	background-color: #FFFFFF;
	border: 1px solid rgba(0, 0, 0, 0.2);
	border-radius: 8px;
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	margin-top: 12px;
	padding: 8px 0;
	width: 422px;
}
.tt-suggestion {
	font-size: 22px;  /* Set suggestion dropdown font size */
	padding: 3px 20px;
}
.tt-suggestion:hover {
	cursor: pointer;
	background-color: #0097CF;
	color: #FFFFFF;
}
.tt-suggestion p {
	margin: 0;
}
</style>
<form id="form_confirm" class="form-horizontal">
    <input type="hidden" name="RegID" id="RegID" value="<?php echo $RegID;?>" />
    <div class="form-group">
        <label class="control-label col-sm-2">Driver</label>
        <div class="col-sm-4">
        <input id="Driver" class="form-control" name="Driver" type="text" value="<?php echo $Driver;?>">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Car Num</label>
        <div class="col-sm-8">
            <input type="text" id="CarNum" name="CarNum" size="30" class="typeahead tt-query form-control" value="<?php echo $CarNum;?>">            
        </div>
    </div>
    <div class="col-sm-2">&nbsp</div>
    <div class="col-sm-10"><hr /><button class="btn btn-success" type="button" id="save_confirm">Save</button></div>
</form>

<script src="<?php echo base_url();?>assets/plugins/typeahead.js"></script>
<script>
   $(document).ready(function() {
            $('#CarNum').typeahead({
                hint: false,
                name: 'CarNum',
                remote: '<?php echo site_url();?>/SuratJalan/GetAllCarNum?query=%QUERY'
            });
            
            $('#Driver').typeahead({
                hint: false,
                name: 'Driver',
                remote: '<?php echo site_url();?>/SuratJalan/GetAllDriver?query=%QUERY'
            });
        });
    
    $('#save_confirm').click(function(){
        var form = $('#form_confirm').serialize();
        if($('#Driver').val()=='')
        {    
            NotifSuccsess('Nama supir masih kosong');
            return false;
        }
        if($('#CarNum').val()=='')
        {
            NotifSuccsess('Nomer plat masih kosong');
            return false;
        }
        
        $.ajax({
            type	: 'POST',
            url		: "<?php echo site_url(); ?>/SuratJalan/SaveConfirmStatus/",
            data	: "type=1&"+form,
            cache	: false,
            success	: function(data)
            {
                $('#confirm').attr({'class':'btn btn-default active','onclick':'proses_confirm(this,0);'});
                $('#IsConfirm').val('1');
                $("#myModal_confirm").modal('hide');
                NotifSuccsess(data);
                $('#Home3a').trigger('click');
            }  
        });  
        
    });
</script>
<!-- end Confirm.view -->