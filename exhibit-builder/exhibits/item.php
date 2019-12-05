<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show exhibit-item-show')); ?>

<h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>

<aside id="sidebar">

    <?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?>
    <?php echo files_for_item(array('imageSize' => 'fullsize', 'linkToFile' => 'fullsize', 'imgAttributes' => array('title' => ''), 'linkAttributes' => array('data-title' => metadata('item', array('Dublin Core', 'Title'))))); ?>
    <?php endif; ?>

    <!-- The following returns all of the files associated with an item. -->
    <?php if ((get_theme_option('Item FileGallery') == 1) && metadata('item', 'has files')): ?>
    <div id="itemfiles" class="element">
        <h2><?php echo __('Files'); ?></h2>
        <?php echo item_image_gallery(); ?>
    </div>
    <?php endif; ?>
	
	<!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h2><?php echo __('Citation'); ?></h2>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>    

	<?php fire_plugin_hook('public_items_show', array('view' => $this, 'item' => $item)); ?>
</aside>

<div id="primary">


    <div class="element-set">
	<h2>About This Item</h2>
    <?php echo all_element_texts('item'); ?>
	</div>
    

</div><!-- end primary -->

<?php echo foot(); ?>
