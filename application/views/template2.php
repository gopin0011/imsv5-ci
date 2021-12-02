<!DOCTYPE html>
<html>
 <meta charset="UTF-8">
 <title>IMS</title>
 <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <meta name="description" content="Common form elements and layouts" />
 <meta name="viewport" content="width=device-width, initial-scale=1.0" />
 <link href="<?php echo base_url(); ?>assets/css/monitoring/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
 <link href="<?php echo base_url(); ?>assets/css/monitoring/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
 <link href="<?php echo base_url(); ?>assets/css/monitoring/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
 <link href="<?php echo base_url(); ?>assets/css/monitoring/css/bootstrap.min.css" rel="stylesheet">
 <link href="<?php echo base_url(); ?>assets/css/monitoring/css/styles.css" rel="stylesheet">
 <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.css">  
<link rel="stylesheet" href="<?php echo base_url(); ?>datetimepicker/bootstrap-datetimepicker.min.css" />
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/datepicker/datepicker3.css">
  
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
 
 <body style="background: cyan;">
 <?php echo $_content;?>
 <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
 
 <script src="<?php echo base_url(); ?>assets/css/monitoring/plugins/chartjs/Chart.min.js" type="text/javascript"></script>
 <script src="<?php echo base_url(); ?>assets/css/monitoring/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>datetimepicker/moment.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>datetimepicker/id.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>datetimepicker/bootstrap-datetimepicker.min.js"></script>
     <!-- PNotify -->
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/notify/pnotify.core.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/notify/pnotify.buttons.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/notify/pnotify.nonblock.js"></script>
  
  <script type="text/javascript">
var waitingDialog3 = waitingDialog3 || (function ($) {
    'use strict';

	// Creating modal dialog's DOM
	var $dialog = $(
		'<div class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top:15%; overflow-y:visible;">' +
		'<div class="modal-dialog modal-m">' +
		'<div class="modal-content">' +
			'<div class="modal-header"><h3 style="margin:0;"></h3></div>' +
			'<div class="modal-body">' +
				'<div class="progress progress-striped active" style="margin-bottom:0;"><div class="progress-bar" style="width: 100%"></div></div>' +
			'</div>' +
		'</div></div></div>');

	return {
		/**
		 * Opens our dialog
		 * @param message Custom message
		 * @param options Custom options:
		 * 				  options.dialogSize - bootstrap postfix for dialog size, e.g. "sm", "m";
		 * 				  options.progressType - bootstrap postfix for progress bar type, e.g. "success", "warning".
		 */
		show: function (message, options) {
			// Assigning defaults
			if (typeof options === 'undefined') {
				options = {};
			}
			if (typeof message === 'undefined') {
				message = 'Loading';
			}
			var settings = $.extend({
				dialogSize: 'm',
				progressType: '',
				onHide: null // This callback runs after the dialog was hidden
			}, options);

			// Configuring dialog
			$dialog.find('.modal-dialog').attr('class', 'modal-dialog').addClass('modal-' + settings.dialogSize);
			$dialog.find('.progress-bar').attr('class', 'progress-bar');
			if (settings.progressType) {
				$dialog.find('.progress-bar').addClass('progress-bar-' + settings.progressType);
			}
			$dialog.find('h3').text(message);
			// Adding callbacks
			if (typeof settings.onHide === 'function') {
				$dialog.off('hidden.bs.modal').on('hidden.bs.modal', function (e) {
					settings.onHide.call($dialog);
				});
			}
			// Opening dialog
			$dialog.modal();
		},
		/**
		 * Closes dialog
		 */
		hide: function () {
			$dialog.modal('hide');
		}
	};

})(jQuery);
</script>

 </body>
 </html>