<div class="text-image-right">
    <div class="image-right">
        <?php if ($attachment = exhibit_builder_page_attachment(1)): ?>
        <div class="exhibit-item">
			<?php
			echo file_markup($attachment['file'], array('imageSize' => 'fullsize', 'linkToFile' => 'fullsize', 'imgAttributes' => array('title' => '', 'class'=>'permalink', 'alt' => metadata($attachment['item'], array('Dublin Core', 'Title'))), 'linkAttributes' => array('data-title' => link_to_item('View full item-record', array(), 'show', $attachment['item'])))); 
			?>
        </div>
        <?php endif; ?>
    </div>
    <?php echo exhibit_builder_page_text(1); ?>
</div>
