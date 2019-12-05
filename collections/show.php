<?php
$collectionTitle = strip_formatting(metadata('collection', array('Dublin Core', 'Title')));
if ($collectionTitle == '') {
    $collectionTitle = __('[Untitled]');
}
?>

<?php echo head(array('title'=> $collectionTitle, 'bodyclass' => 'items browse')); ?>

<div id="item-title" style="text-align: center;">
<h1><?php echo $collectionTitle; ?></h1>
</div>

<?php echo pagination_links(); ?>

<div class="element-set">
<h2>About This Collection</h2>
<?php echo all_element_texts('collection'); ?>
</div>

<?php echo '<h3>Featured Items</h3>' ?>

<?php foreach (loop('items') as $item): ?>

<div class="item-img">
		<?php if (metadata('item', 'has thumbnail')): ?>
        <?php
		if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']))
			{
			$searchlink = record_url('item').'?' . $_SERVER['QUERY_STRING'];
			echo '<a href="'.$searchlink.'">'. item_image('square_thumbnail', array('title'=>'', 'alt' => metadata('item', array('Dublin Core', 'Title')))).'</a>';
			}
		else
			{
			echo link_to_item(item_image('square_thumbnail', array('title'=>'', 'alt' => metadata('item', array('Dublin Core', 'Title')))));
			}
		?>
		<?php else: ?>
		<?php
		if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']))
			{
			$searchlink = record_url('item').'?' . $_SERVER['QUERY_STRING'];
			echo '<a href="'.$searchlink.'"><img src="'.img('default_icon.png', 'css/images').'" /></a>';
			}
		else
		{
			echo link_to_item('<img src="'.img('default_icon.png', 'css/images').'" />');
		}
		?>
    <?php endif; ?>
    <div class="item-meta">
		<?php
		if(isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING']))
		{
			$searchlink = record_url('item').'?' . $_SERVER['QUERY_STRING'];
			echo '<div class="item-description"><a href="'.$searchlink.'">'. metadata('item', array('Dublin Core','Title'), array('snippet'=>50)).'</a></div>';
		}
		else
		{
			echo '<div class="item-description">'.link_to_item(metadata('item', array('Dublin Core','Title'), array('snippet'=>50)), array('class'=>'permalink')).'</div>';
		}
		?>

		<?php fire_plugin_hook('public_items_browse_each', array('view' => $this, 'item' =>$item)); ?>
    </div><!-- end class="item-meta" -->
</div><!-- end class="item-img" -->
<?php endforeach; ?>
<!-- end collection-items -->

<div style="width: auto; clear: both; text-align: center;">
<h3><?php echo link_to_items_browse(__('View all items in %s', $collectionTitle), array('collection' => metadata('collection', 'id'))); ?></h3>
</div>
<?php echo foot(); ?>
