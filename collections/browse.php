<?php
$pageTitle = __('Browse Collections');
echo head(array('title'=>$pageTitle,'bodyclass' => 'collections browse'));
?>

<nav class="navigation secondary-nav">
<h1><?php echo $pageTitle; ?></h1>
<?php echo pagination_links(); ?>
</nav>

<?php foreach (loop('collections') as $collection): ?>
<?php $item = get_record('Item', array('hasImage'=>true,'collection'=>$collection)); ?>
<div class="collection">
	<?php if ($item!=null) echo link_to_collection(item_image('square_thumbnail', array('title'=>'', 'alt' => metadata($item, array('Dublin Core', 'Title'))), 0, $item)); else echo link_to_collection('<img src="'.img('default_icon.png', 'css/images').'" />'); ?>
    <h4><?php echo link_to_collection(); ?></h4>
	
    <?php fire_plugin_hook('public_collections_browse_each', array('view' => $this, 'collection' => $collection)); ?>

</div><!-- end class="collection" -->

<?php endforeach; ?>

<?php echo pagination_links(); ?>

<?php fire_plugin_hook('public_collections_browse', array('collections'=>$collections, 'view' => $this)); ?>

<?php echo foot(); ?>