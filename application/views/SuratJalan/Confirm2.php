<!-- start Confirm.view -->
<style>
.tt-query {
	box-shadow: 0 1px 1px rgba(0, 0, 0, 0.075) inset;
}
.tt-hint {
	color: #999999;
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
	font-size: 18px;  /* Set suggestion dropdown font size */
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
        <input id="Driver" class="form-control" name="Driver" type="text">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2">Car Num</label>
        <div class="col-sm-8">
        <input type="text" class="form-control typeahead tt-query" autocomplete="off" spellcheck="false" name="CarNum">
        </div>
    </div>
    <div class="col-sm-2">&nbsp</div>
    <div class="col-sm-10"><hr /><button class="btn btn-success" type="button" id="save_confirm">Save</button></div>
</form>

<script src="<?php echo base_url();?>assets/plugins/typeahead.bundle.js"></script>
<script>
    $(document).ready(function(){
        // Defining the local dataset
        //var cars = ['Audi', 'BMW', 'Bugatti', 'Ferrari', 'Ford', 'Lamborghini', 'Mercedes Benz', 'Porsche', 'Rolls-Royce', 'Volkswagen'];
        /*
        	$('.typeahead').typeahead({
        	    source:  function (query, process) {        
                return $.get('<?php echo site_url();?>/SuratJalan/GetAllCarNum', { query: query }, function (data) {        
                		console.log(data);        
                		data = $.parseJSON(data);        
        	            return process(data);        
        	        });        
        	    }        
        	});
        */
        /*
        $.getJSON("<?php echo site_url();?>/SuratJalan/GetAllCarNum", function(data){
            var cars = ['Mercedes Benz'];
            $.each(data,function(i,x){
                cars.push(x);
            });
            
            var cars = new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.whitespace,
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                local: cars
            });
        });
        
        
        */
        
        $('.typeahead').typeahead({
            hint: true,
            highlight: true, //Enable substring highlighting
            minLength: 1 //Specify minimum characters required for showing result
        },
        {
            //name: 'cars',
            source:  function (query, process) {        
                return $.get('<?php echo site_url();?>/SuratJalan/GetAllCarNum', { query: query }, function (data) {        
                		console.log(data);        
                		data = $.parseJSON(data);        
        	            return process(data);
        	        });        
        	    }
        });
        
    });
    $('#save_confirm').click(function(){
        var form = $('#form_confirm').serialize();
        
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
                    //$('#Home3a').trigger('click');
                } 
            });
            /*
        if($('#Remark').val()!='')
        {    
        }
        else
        {
            NotifSuccsess('Keterangan masih kosong');
        }     */   
    });
</script>
<!-- end Confirm.view -->