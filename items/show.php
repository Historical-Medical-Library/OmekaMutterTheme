<?php queue_js_file('jquery.colorbox-min'); ?>
<?php echo head(array('title' => metadata('item', array('Dublin Core', 'Title')),'bodyclass' => 'items show')); ?>
<div id="item-title">
<h1><?php echo metadata('item', array('Dublin Core', 'Title')); ?></h1>
</div>
<?php $files = $item->getFiles(); ?>
<?php $count = 0; ?>
<?php foreach ($files as $file){
	$count = $count + 1;
}?>

<?php if ($count > 2): ?>
<?php
    fire_plugin_hook('book_reader_item_show', array(
        'view' => $this,
        'item' => $item,
        'page' => '0',
        'embed_functions' => false,
        'mode_page' => 1,
    ));
    ?>
<?php endif; ?>
<div id="main">

<?php if ($count <= 2 ): ?>
<aside id="sidebar">

    <?php if ((get_theme_option('Item FileGallery') == 0) && metadata('item', 'has files')): ?>
    <?php echo files_for_item(array('imageSize' => 'fullsize', 'linkToFile' => 'fullsize', 'imgAttributes' => array('title' => '', 'alt' => metadata('item', array('Dublin Core', 'Title'))), 'linkAttributes' => array('data-title' => metadata('item', array('Dublin Core', 'Title'))))); ?>
    <?php endif; ?>

    <!-- The following returns all of the files associated with an item. -->
    <?php if ((get_theme_option('Item FileGallery') == 1) && metadata('item', 'has files')): ?>
    <div id="itemfiles" class="element">
        <h2><?php echo __('Files'); ?></h2>
        <?php echo item_image_gallery(); ?>
    </div>
    <?php endif; ?>
</aside>
<?php endif; ?>

<?php if ($count <= 2 ): ?>
<div id="primary">

    <div class="element-set">
	<h2>About This Item</h2>
    <?php echo all_element_texts('item'); ?>
	</div>
<!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h2><?php echo __('Citation'); ?></h2>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>
	<?php link_to_related_exhibits($item); ?>

</div><!-- end primary -->
</div>
<?php endif; ?>

<?php if ($count > 2 ): ?>
<div id="content">
<div id="primary">

    <div class="element-set">
	<h2>About This Item</h2>
    <?php echo all_element_texts('item'); ?>
	</div>
<!-- The following prints a citation for this item. -->
    <div id="item-citation" class="element">
        <h2><?php echo __('Citation'); ?></h2>
        <div class="element-text"><?php echo metadata('item', 'citation', array('no_escape' => true)); ?></div>
    </div>

</div><!-- end primary -->
</div>
</div>
<?php endif; ?>

<ul class="item-pagination navigation">
    <?php custom_paging(); ?>
</ul>

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
