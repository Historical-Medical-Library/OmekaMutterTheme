<div class="image-list-right">
    <?php
    for ($i = 1; $i <= 8; $i++):
        $text = exhibit_builder_page_text($i);
        $attachment = exhibit_builder_page_attachment($i);
        if ($text || $attachment):
    ?>
    <div class="image-text-group">
        <?php if ($text): ?>
        <div class="exhibit-text">
            <?php echo $text; ?>
        </div>
        <?php endif; ?>
        <?php if ($attachment): ?>
        <div class="exhibit-item">
            <?php
			echo file_markup($attachment['file'], array('imageSize' => 'fullsize', 'linkToFile' => 'fullsize', 'imgAttributes' => array('title' => '', 'class'=>'permalink', 'alt' => metadata($attachment['item'], array('Dublin Core', 'Title'))), 'linkAttributes' => array('data-title' => link_to_item('View full item-record', array(), 'show', $attachment['item'])))); 
			?>
        </div>
        <?php endif; ?>
    </div>
    <?php endif; endfor; ?>
</div>
