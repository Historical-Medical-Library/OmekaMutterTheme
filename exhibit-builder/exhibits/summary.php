<?php echo head(array('title' => metadata('exhibit', 'title'), 'bodyclass'=>'exhibits summary')); ?>
<div id="exhibit-title">
<h1><?php echo metadata('exhibit', 'title'); ?></h1>
</div>
<div id="main">
<div id="primary">
<?php if ($exhibitDescription = metadata('exhibit', 'description', array('no_escape' => true))): ?>
<div class="exhibit-description">
	<h2><?php echo __('Summary'); ?></h2>
    <?php echo $exhibitDescription; ?>
</div>
<?php endif; ?>

<?php if (($exhibitCredits = metadata('exhibit', 'credits'))): ?>
<div class="exhibit-credits">
    <h2><?php echo __('Credits'); ?></h2>
    <p><?php echo $exhibitCredits; ?></p>
</div>
<?php endif; ?>
</div>
<aside id="exhibit-pages">
	<?php $exhibit = get_current_record('exhibit');
	$exhibitItem = get_records('Item', array('hasImage'=>true,'exhibit'=>$exhibit, 'featured' => true), 1);
	$topPages = $exhibit->getTopPages(); 
	?>
	<?php if ($exhibitItem!=null) echo link_to_exhibit(item_image('fullsize', array('title'=>'', 'alt' => metadata($exhibitItem[0], array('Dublin Core', 'Title'))), 0, $exhibitItem[0]), array(), $topPages[0]); else echo link_to_exhibit('<img src="'.img('default_icon.png', 'css/images').'" />', array(), $topPages[0]); ?>
        <h2><?php echo link_to_exhibit('Launch Exhibit', array(), $topPages[0]); ?></h2>
</aside>
</div>

<!-- AddThis Smart Layers BEGIN -->
<!-- Go to http://www.addthis.com/get/smart-layers to customize -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-524dca3e695e266e"></script>
<script type="text/javascript">
  addthis.layers({
    'theme' : 'transparent',
    'share' : {
      'position' : 'left',
      'numPreferredServices' : 5
    }   
  });
</script>
<!-- AddThis Smart Layers END -->

<?php echo foot(); ?>
