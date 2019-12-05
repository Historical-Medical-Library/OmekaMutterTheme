<?php
$pageTitle = __('Items');
echo head(array('title'=>$pageTitle,'bodyclass' => 'items browse'));
?>

<h1><?php echo $pageTitle;?> <?php echo __('(%s total)', $total_results); ?></h1>

<nav class="items-nav navigation secondary-nav">
    <?php echo public_nav_items2(); ?>
</nav>
<?php if ($total_results > 0): ?>
<div id="pagination-sort">
<?php echo pagination_links(); ?>
<?php
$sortLinks[__('Title')] = 'Dublin Core,Title';
$sortLinks[__('Creator')] = 'Dublin Core,Creator';
$sortLinks[__('Date')] = 'Dublin Core,Date';
$sortLinks[__('Date Added')] = 'added';
?>
<div id="sort-links">
    <span class="sort-label"><?php echo __('Sort by: '); ?></span><?php echo browse_sort_links($sortLinks); ?>
</div>
</div>
<?php else: ?>
    <p><?php echo __('Your query returned no results. Please try another keyword. Or try our <a href="/items/search">Advanced Search</a> or <a href="/items/tags">Browse by Subject</a> feature.');?></p>
<?php endif; ?>

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
<div id="pagination-sort-bottom">
<?php echo pagination_links(); ?>

</div>

<?php fire_plugin_hook('public_items_browse', array('items'=>$items, 'view' => $this)); ?>

<?php echo foot(); ?>
