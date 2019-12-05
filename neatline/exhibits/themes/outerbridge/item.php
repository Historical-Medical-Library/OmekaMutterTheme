<!-- Texts. -->
<?php echo all_element_texts('item'); ?>

<!-- Files. -->
<?php if (metadata('item', 'has files')): ?>
  <h3><?php echo __('Files'); ?></h3>
  <?php echo files_for_item(); ?>
<?php endif; ?>

<hr />

<!-- Link. -->
<?php echo link_to(
  get_current_record('item'), 'show', 'View the item in Omeka'
); ?>