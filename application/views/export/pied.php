</div>
		</div><!-- /.main-content -->
<div id="dialog-message" class="hide">
<p id="title-message">
	This is the default dialog which is useful for displaying information. The dialog window can be moved, resized and closed with the 'x' icon.
</p>
</div><!-- #dialog-message -->
		<div class="footer">
			<div class="footer-inner">
				<div class="footer-content">
					<span class="bigger-120">
						<span class="blue bolder">MESDHASA</span>
						 &copy; <?php echo "2017-".date('Y')?>
					</span>

				</div>
			</div>
		</div>

		<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
			<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
		</a>
	</div><!-- /.main-container -->

	<!-- basic scripts -->

	<!--[if !IE]> -->
	<script src="<?php echo base_url()?>assets/js/jquery-3.8.0.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/jquery-migrate-3.6.0.min.js"></script>
	<?php $sigco_ci =& get_instance(); ?>
	<script>window.SIGCO_CSRF = {nom: <?php echo json_encode($sigco_ci->security->get_csrf_token_name())?>, valeur: <?php echo json_encode($sigco_ci->security->get_csrf_hash())?>};</script>
	<script src="<?php echo sigco_asset('assets/js/sigco-securite.js')?>"></script>
	<script src="<?php echo sigco_asset('assets/js/sigco-ui.js')?>"></script>


	<!-- <![endif]-->

	<!--[if IE]>
<script src="assets/js/jquery-3.8.0.min.js"></script>
<![endif]-->
	<script type="text/javascript">
		if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		var base_url = "<?php echo base_url()?>";

		$(document).ready(function(){
		$("#codec1").change(function(){
		data=$(this).val();
		danne=data.split("|");
		$("#account_number_shipper").val(danne[1]);
		$("#name_shipper").val(danne[2]);
		$("#ville_shipper").val(danne[3]);
		$("#address_shipper").val(danne[4]);
		$("#email_shipper").val(danne[5]);
		$("#tel_shipper").val(danne[6]);
		});
		});
		$(document).ready(function(){
		$("#codec2").change(function(){
		data=$(this).val();
		danne=data.split("|");
		$("#account_number_consignee").val(danne[1]);
		$("#name_consignee").val(danne[2]);
		$("#ville_consignee").val(danne[3]);
		$("#address_consignee").val(danne[4]);
		$("#email_consignee").val(danne[5]);
		$("#tel_consignee").val(danne[6]);
		});
		});
		$(document).ready(function(){
		$("#codec3").change(function(){
		data=$(this).val();
		danne=data.split("|");
		$("#account_number_agent").val(danne[1]);
		$("#name_agent").val(danne[2]);
		$("#adress_agent").val(danne[3]);
		$("#ville_agent").val(danne[4]);
		});
		});
	</script>

	<script>
	jQuery(function($){
		$("#awblnum").mask("999-99999999");
	});
	</script>
	<script src="<?php echo base_url()?>assets/js/bootstrap-3.4.1.min.js"></script>

	<!-- page specific plugin scripts -->
	<script src="<?php echo base_url()?>assets/js/jquery-ui-1.14.2.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/jquery.ui.touch-punch.min.js"></script>

	<!-- ace scripts -->
	<script src="<?php echo base_url()?>assets/js/ace-elements.min.js"></script>
	<script src="<?php echo base_url()?>assets/js/ace.min.js"></script>
	<script src="<?php echo sigco_asset('assets/js/mesjs.js')?>"></script>
	<?php if (strtolower(get_instance()->router->fetch_class()) === 'home') { /* graphiques : tableau de bord uniquement */ ?><script src="<?php echo base_url()?>assets/js/Chart.bundle-2.9.4.min.js"></script><script src="<?php echo sigco_asset('assets/js/utils.js')?>"></script><?php } ?>
		<script src="<?php echo base_url()?>assets/js/jquery.maskedinput.min.js"></script>


<!-- inline scripts related to this page -->
	<script src="<?php echo base_url()?>assets/mytools/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>
	<script src="<?php echo base_url()?>assets/mytools/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
	<script src="<?php echo base_url()?>assets/mytools/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
	<script src="<?php echo base_url()?>assets/mytools/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>
	<script src="<?php echo base_url()?>assets/mytools/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

<script>
$(document).ready(function() {
$(".various").fancybox({
	maxWidth	: 1024,
	maxHeight	: 700,
	fitToView	: false,
	width		: '70%',
	height		: '70%',
	modal		: true,
	autoSize	: false,
	closeClick	: false,
	openEffect	: 'none',
	closeEffect	: 'none',
	showCloseButton : true,
	afterShow : function() {
		$('.fancybox-skin').append('<a title="Close" class="fancybox-item fancybox-close" href="javascript:jQuery.fancybox.close();"></a>');
	},
	afterClose: function() {
		//Liste_Programme_u();
		//Aff_planning();
	}
});


});

</script>

<div id='ajax_loader'style="position: fixed; left: 50%; top: 50%; display: none;">
	<img src="<?php echo base_url()?>assets/images/ajax-loader.gif"></img>
</div>
	<!-- inline scripts related to this page -->
</body>
</html>
