</div><!-- end content -->

<footer>
			<div class="footer-link">
				<a href="http://www.collegeofphysicians.org/"><img src="<?php echo img('CPP_Logo_Birthplace_BLUE.png', 'css/images'); ?>" alt="The College of Physicians of Philadelphia"></a>
			</div>
			<div class="footer-link">
				<a href="http://www.collegeofphysicians.org/library/"><img src="<?php echo img('Text_LowRes_trans.png', 'css/images'); ?>" alt="Historical Medical Library of The College of Physicians of Philadelphia"></a>
			</div>
			<div class="footer-text">
				<p>Copyright © 2019 | The College of Physicians of Philadelphia</br>
				<?php echo __('Proudly powered by <a href="http://omeka.org">Omeka</a>.'); ?></p>
			</div>
   
    <?php fire_plugin_hook('public_footer'); ?>
    
</footer>

</div><!--end wrap-->

<script type="text/javascript">
jQuery(document).ready(function () {
    Seasons.mobileSelectNav();
});
</script>
	<script type="text/javascript">
		if (jQuery.browser.mobile == false) { 
            jQuery(document).ready(function () {
                jQuery('a.download-file').colorbox({maxWidth:"100%", maxHeight:"100%", title:function(){ return jQuery(this).data('title'); }});
            });
		}
        </script>
		<script type="text/javascript">
		 jQuery(document).bind('cbox_complete', function(){ jQuery('img.cboxPhoto').smoothZoom({
			zoom_MAX:1000,
			animation_SMOOTHNESS: 10,
			use_3D_Transform: false
		 });
		 });
		 </script>
	<script type="text/javascript">
	jQuery(window).load(function() {
    jQuery('#slider').nivoSlider({
    effect: 'fade',               // Specify sets like: 'fold,fade,sliceDown'
    animSpeed: 1000,                 // Slide transition speed
    pauseTime: 5000,                // How long each slide will show
    pauseOnHover: false,             // Stop animation while hovering
	directionNav: false,             // Next & Prev navigation
    controlNav: false,               // 1,2,3... navigation
});
	});
	</script>
</body>

</html>
