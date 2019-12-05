<?php echo head(array('bodyid'=>'home')); ?>

<div id="slider" class="nivoSlider">
	<a href="/items/browse?sort_field=Dublin+Core%2CTitle">
		<img src="<?php echo img('grid2x.jpg', 'css/images'); ?>" alt="Browse Images from the History of Medicine">
	</a>
	<a href="/exhibits">
		<img src="<?php echo img('exhibitsx.jpg', 'css/images'); ?>" alt="Explore Our Digital Exhibitions">
	</a>
	<a href="/exhibits/show/bad-medicine">
		<img src="<?php echo img('badmedicinebanner.jpg', 'css/images'); ?>" alt="Bad Medicine: Drug Manufacturers, Advertising, and the Push to Sell">
	</a>
	<a href="/exhibits/show/imperfecta">
		<img src="<?php echo img('imperfectabanner5.jpg', 'css/images'); ?>" alt="Further Into Imperfecta">
	</a>
	<a href="/exhibits/show/outerbridge">
		<img src="<?php echo img('outerbridgebanner.jpg', 'css/images'); ?>" alt="Travels With Outerbridge: A Fellow in the Great War">
	</a>
	<a href="/exhibits/show/histanat">
		<img src="<?php echo img('anatomybanner2.jpg', 'css/images'); ?>" alt="Teaching and Learning Anatomy: A 500 Year History">
	</a>
	<a href="/exhibits/show/battle-creek">
		<img src="<?php echo img('battlecreekbanner2.jpg', 'css/images'); ?>" alt="The Battle Creek Sanitarium: Deliverance Through Diet">
	</a>
	<a href="/exhibits/show/radium">
		<img src="<?php echo img('radiumbanner.jpg', 'css/images'); ?>" alt="Healing Energy: Radium in America">
	</a>
</div>
<?php fire_plugin_hook('public_home', array('view' => $this)); ?>

<?php echo foot(); ?>