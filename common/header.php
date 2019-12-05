<!DOCTYPE html>
<html lang="<?php echo get_html_lang(); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo option('site_title'); echo isset($title) ? ' | ' . strip_formatting($title) : ''; ?></title>
	<?php echo meta_tags(); ?>
    <?php echo auto_discovery_link_tags(); ?>

    <!-- Plugin Stuff -->
    <?php fire_plugin_hook('public_head', array('view'=>$this)); ?>

    <!-- Stylesheets -->
    <?php
    queue_css_file('normalize');
    queue_css_file('style_m');
	queue_css_file('nivo-slider');
    echo head_css();
    ?>
    <!-- JavaScripts -->
    <?php queue_js_file('vendor/modernizr'); ?>
    <?php queue_js_file('vendor/selectivizr'); ?>
    <?php queue_js_file('jquery-extra-selectors'); ?>
    <?php queue_js_file('vendor/respond'); ?>
    <?php queue_js_file('globals'); ?>
	<?php //queue_js_file('jquery.colorbox-min'); ?>
	<?php //queue_js_file('jquery.smoothZoom.min'); ?>
	<?php queue_js_file('detectmobilebrowser'); ?>
	<?php queue_js_file('jquery.nivo.slider'); ?>
    <?php echo head_js(); ?>
	
	<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
	<link rel="icon" href="/favicon.ico" type="image/x-icon">
	
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-46016111-1', 'auto');
		ga('send', 'pageview');

	</script>
</head>
<?php echo body_tag(array('id' => @$bodyid, 'class' => @$bodyclass)); ?>
    <?php fire_plugin_hook('public_body', array('view'=>$this)); ?>
    <div id="wrap">
        <header>
            <div id="site-title">
				<h1>
				<?php echo link_to_home_page('<img src="'.img('diglibblack2.png', 'css/images').'" alt="The College of Physicians of Philadelphia Digital Library" />'); ?>
				</h1>
            </div>
            <div id="search-container">
                <?php echo $this->partial('search/search-bar.php',
				array('formAttributes' =>
				array('id'=>'search-bar'))); ?>
            </div>
            <?php fire_plugin_hook('public_header', array('view'=>$this)); ?>
        </header>

        <nav class="top">
            <?php echo public_nav_main(); ?>
        </nav>

        <div id="content">
