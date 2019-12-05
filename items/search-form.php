<?php
if (!empty($formActionUri)):
    $formAttributes['action'] = $formActionUri;
else:
    $formAttributes['action'] = url(array('controller'=>'items',
                                          'action'=>'browse'));
endif;
$formAttributes['method'] = 'GET';
?>

<form <?php echo tag_attributes($formAttributes); ?>>
    <div id="search-narrow-by-fields" class="field">
        <div class="label"><?php echo __('Search for Images by Specific Fields'); ?></div>
        <div class="inputs">
        <?php
        // If the form has been submitted, retain the number of search
        // fields used and rebuild the form
        if (!empty($_GET['advanced'])) {
            $search = $_GET['advanced'];
        } else {
            $search = array(array('field'=>'','type'=>'','value'=>''));
        }

        //Here is where we actually build the search form
        foreach ($search as $i => $rows): ?>
            <div class="search-entry">
                <?php
                //The POST looks like =>
                // advanced[0] =>
                //[field] = 'description'
                //[type] = 'contains'
                //[terms] = 'foobar'
                //etc
                echo $this->formSelect(
                    "advanced[$i][element_id]",
                    @$rows['element_id'],
                    array(),
                    label_table_options(array(
                        '50' => __('Title'),
                        '39' => __('Creator (Artist, Illustrator, Engraver, Photographer, etc.)'),
						'49' => __('Subject'),
                        '48' => __('Source (Work in which the image appears)'),
						'41' => __('Description'))
                    )
                );
                echo '<input type="hidden" name="advanced[0][type]" id="advanced-0-type" value="contains" />'
				;
                echo $this->formText(
                    "advanced[$i][terms]",
                    @$rows['terms'],
                    array('size' => '20')
                );
                ?>
                <button type="button" class="remove_search" disabled="disabled" style="display: none;">-</button>
            </div>
        <?php endforeach; ?>
        </div>
        <button type="button" class="add_search"><?php echo __('Add a Field'); ?></button>
		    <div>
        <input type="submit" class="submit" name="submit_search" id="submit_search_advanced" value="<?php echo __('Search'); ?>" />
    </div>
    </div>
</form>

<?php echo js_tag('items-search'); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        Omeka.Search.activateSearchButtons();
    });
</script>
