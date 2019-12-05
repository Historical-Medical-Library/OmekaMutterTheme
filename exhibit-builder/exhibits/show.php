<?php
echo head(array(
    'title' => metadata('exhibit_page', 'title') . ' &middot; ' . metadata('exhibit', 'title'),
    'bodyclass' => 'exhibits show'));
?>
<div id="exhibit-title">
<h1><?php 
	$topPages = $exhibit->getTopPages();
	echo link_to_exhibit(); 
	?>
</h1>
</div>
<div id="main">
	<nav id="exhibit-pages">
		<h3>Sections</h3>
		<?php echo exhibit_builder_topPages_nav(); ?>
	</nav>
	<div id="exhibit">
		<h1><?php echo metadata('exhibit_page', 'title'); ?></h1>
		<?php exhibit_builder_render_exhibit_page(); ?>
		<?php echo exhibit_builder_childPages_nav(); ?>
	</div>
</div>



<?php echo foot(); ?>
