<div class="gallery-full-right">
    <div class="primary">
        <?php if ($attachment = exhibit_builder_page_attachment(1)): ?>
        <div class="exhibit-item">
			<?php
			echo file_markup($attachment['file'], array('imageSize' => 'fullsize', 'linkToFile' => 'fullsize', 'imgAttributes' => array('title' => '', 'class'=>'permalink', 'alt' => metadata($attachment['item'], array('Dublin Core', 'Title'))), 'linkAttributes' => array('data-title' => link_to_item('View full item-record', array(), 'show', $attachment['item'])))); 
			?>
        </div>
        <?php endif; ?>
        <?php if ($text = exhibit_builder_page_text(1)): ?>
        <div class="exhibit-text">
            <?php echo $text; ?>
        </div>
        <?php endif; ?>
    </div>
    <div class="secondary gallery">
        <?php echo cpp_exhibit_builder_thumbnail_gallery(2, 9, array()); ?>
    </div>
</div>
