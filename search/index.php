<?php
$pageTitle = __('Browse Items ') . __('(%s total)', $total_results);
echo head(array('title' => $pageTitle, 'bodyclass' => 'search'));
$searchRecordTypes = get_search_record_types();
?>
<?php if ($total_results): ?>
<h1><?php echo $pageTitle;?></h1>
<div id="pagination-sort">
<?php echo pagination_links(); ?>
</div>

        <?php foreach (loop('search_texts') as $searchText): ?>
        <?php $record = get_record_by_id($searchText['record_type'], $searchText['record_id']); ?>
		<?php set_current_record('item', $record); ?>
			<div class="item-img">
			<?php if (metadata('item', 'has thumbnail')): ?>
			<?php echo link_to_item(item_image('square_thumbnail')); ?>
			<?php else: ?>
			<?php echo link_to_item('<img src="'.img('default_icon.png', 'css/images').'" />'); ?>
		<?php endif; ?>
				<div class="item-meta"> 
					<div class="item-description">
					<?php echo link_to_item(metadata('item', array('Dublin Core', 'Title'), array('snippet'=>50)), array('class'=>'permalink')); ?>
					</div>
				</div><!-- end class="item-meta" -->
			</div><!-- end class="item-img" -->
        <?php endforeach; ?>
<div id="pagination-sort-bottom">
<?php echo pagination_links(); ?>
</div>
<?php else: ?>
<div id="no-results">
    <p><?php echo __('Your query returned no results. Please try another keyword. Or try our <a href="/items/search">Advanced Search</a> or <a href="/items/tags">Browse by Subject</a> feature.');?></p>
</div>
<?php endif; ?>
<?php echo foot(); ?>