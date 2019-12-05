<?php
$title = __('Browse Exhibits');
echo head(array('title' => $title, 'bodyclass' => 'exhibits browse'));
?>
<h1><?php echo $title; ?> <?php echo __('(%s total)', $total_results); ?></h1>
<?php if (count($exhibits) > 0): ?>

<nav class="navigation" id="secondary-nav">
    <?php echo nav(array(
        array(
            'label' => __('Browse All'),
            'uri' => url('exhibits')
        )
    )); ?>
</nav>
<div id="pagination-sort">
<?php echo pagination_links(); ?>
</div>
<?php $exhibitCount = 0; ?>
<?php foreach (loop('exhibit') as $exhibit): ?>
    <?php $exhibitCount++; ?>
	<?php $item = get_records('Item', array('hasImage'=>true, 'exhibit'=>$exhibit, 'featured' => true), 1); ?>
    <div class="exhibit <?php if ($exhibitCount%2==1) echo ' even'; else echo ' odd'; ?>">
		<?php if ($item!=null) echo link_to_exhibit(item_image('square_thumbnail', array('title'=>'', 'alt' => metadata($item[0], array('Dublin Core', 'Title'))), 0, $item[0])); else echo link_to_exhibit('<img src="'.img('default_icon.png', 'css/images').'" />'); ?>
        <h4><?php echo link_to_exhibit(); ?></h4>
    </div>
<?php endforeach; ?>
<div id="pagination-sort">
<?php echo pagination_links(); ?>
</div>
<?php else: ?>
<h4><?php echo __('There are no exhibits at this time. Please check back again shortly.'); ?></h4>
<div class="exhibit">
	<img src="<?php echo img('coming_soon.jpg', 'css/images'); ?>">
	<h4>Diary of a Philadelphia Physician in WWI</h4>
</div>

<?php endif; ?>

<?php echo foot(); ?>
