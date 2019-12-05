<?php
function deco_homepage_gallery_items(){

			$items = get_random_featured_items(10);
			if ($items!=null) 
			{	
			$html = '';	
			foreach ($items as $item): 
				if (metadata($item, 'has thumbnail')){
					set_current_record('item',$item);
					$file=item_image('square_thumbnail',$item);
					$src = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $file , $matches);
					$first_img = $matches[1][0];
					$title=metadata($item,array('Dublin Core', 'Title'));
	
			    	       $html .= '<div class="main">';
			    	       	   $html .=  link_to_item(item_image('square_thumbnail', array('title'=>'', 'alt' => metadata('item', array('Dublin Core', 'Title')))));
							   $html .=  '<div class="caption">';
				    	       $html .=  '<h3>'.link_to($item,'show',$title).'</h3>';
							   $html .= '</div>'; 
			    	       $html .='</div>';
	
				}
			endforeach; 
			return $html;
			}
    	
}

function deco_homepage_gallery(){
?>			
			<div id='slider' class='swipe'>
			  <div class='swipe-wrap'>
			    <?php echo deco_homepage_gallery_items();?>
			  </div>
			</div>
		
<?php
}
function deco_collections_gallery_items(){
			$coll=get_current_record('Collections',false)->id;
			$items = get_records('item',array('hasImage'=>true,'collection'=>$coll),$num=10);
			if ($items!=null) 
			{	
			$html = '';	
			foreach ($items as $item): 
				if (metadata($item, 'has thumbnail')){
					set_current_record('item',$item);
					$file=item_image('square_thumbnail',$item);
					$src = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $file , $matches);
					$first_img = $matches[1][0];
					$title=metadata($item,array('Dublin Core', 'Title'));
	
			    	       $html .= '<div class="main">';
			    	       	   $html .= '<img src="'.$first_img.'">';
							   $html .=  '<div class="caption">';
				    	       $html .=  '<h3>'.link_to($item,'show',$title).'</h3>';
							   $html .= '</div>'; 
			    	       $html .='</div>';
	
				}
			endforeach; 
			return $html;
			}
    	
}

function deco_collections_gallery(){
	if (get_theme_option('Display Featured Item') !== '0') {
?>			
			<h2 class="gallery">Featured Items</h2>
			<div id='slider' class='swipe'>
			  <div class='swipe-wrap'>
			    <?php echo deco_collections_gallery_items();?>
			  </div>
			</div>
		
<?php
}
}

function exhibit_builder_gallery_items() {
	$exhibit = get_current_record('exhibit');
	$exhibitItems = get_records('Item', array('hasImage'=>true,'exhibit'=>$exhibit), 10);
	$topPages = $exhibit->getTopPages();
	$html = '';
	if ($exhibitItems!=null) {
		$html .= '<div id="slider" class="swipe">';
		$html .= '<div class="swipe-wrap">';
		foreach ($exhibitItems as $item) {
			$html .= '<div class="main">'.link_to_exhibit(item_image('square_thumbnail', array('title'=>'', 'alt' => metadata($item, array('Dublin Core', 'Title'))), 0, $item), array(), $topPages[0]).'</div>';
		}
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<h2>'.link_to_exhibit('Launch Exhibit', array(), $topPages[0]).'</h2>';
	}
	return $html;
}

function exhibit_builder_topPages_nav($exhibitPage = null){
	if (!$exhibitPage) {
	    $exhibitPage = get_current_record('exhibit_page', false);
	}
	if ($exhibitPage->parent_id == null) {
		$currentTopPage = $exhibitPage->id;
	}
	else {
		$currentTopPage = $exhibitPage->parent_id;
	}
	$exhibit = $exhibitPage->getExhibit();
	$topPages = $exhibit->getTopPages();
	$currentPage = $exhibitPage->id;
	$addClass=' class="current" ';
	    
	$html = '<ul>';
	foreach($topPages as $page){
	
		$html .= '<li'.__(($page->id == $currentTopPage) ? $addClass : "").'><a href="'.exhibit_builder_exhibit_uri($exhibit, $page).'">'.$page->title.'</a>';

		$html .='</li>';
	}
	$html .= '</ul>';
	
	return $html;
}

function exhibit_builder_childPages_nav($exhibitPage = null){
	if (!$exhibitPage) {
	    $exhibitPage = get_current_record('exhibit_page', false);
	}
	if ($exhibitPage->parent_id == null) {
		$currentTopPage = $exhibitPage->id;
	}
	else {
		$currentTopPage = $exhibitPage->parent_id;
	}
	$exhibit = $exhibitPage->getExhibit();
	$topPages = $exhibit->getTopPages();
	$currentPage = $exhibitPage->id;
	$addClass=' class="current" ';
	
	foreach($topPages as $page){
		if ($page->id == $currentTopPage) {
			$children=exhibit_builder_child_pages($page);
			if($children){
			$html = '<nav id="exhibit-childpages"><ul>';
			$html .= '<li'.__(($page->id == $currentPage) ? $addClass : "").'><a href="'.exhibit_builder_exhibit_uri($exhibit, $page).'">Page 1</a>';
			$html .= '</li>';
			$count = 1;
			foreach($children as $child){
				$count = $count + 1;
				$pagenum = "$count";
				$html .= '<li'.__(($child->id == $currentPage) ? $addClass : "").'><a href="'.exhibit_builder_exhibit_uri($exhibit, $child).'">Page '.$pagenum.'</a></li>';
				$grandchildren=exhibit_builder_child_pages($child);
				if($grandchildren){
					$html .= '<ul>';
				foreach($grandchildren as $grandchild){
					$html .= '<li'.__(($grandchild->id == $currentPage) ? $addClass : "").'><a href="'.exhibit_builder_exhibit_uri($exhibit, $grandchild).'">'.$grandchild->title.'</a></li>';
				}
					$html .= '</ul>';
				}
			}
			$html .= '</ul></nav>';
		return $html;
		}
		}
	}
}

/**
 * Returns HTML for a set of linked thumbnails for the items on a given exhibit page.  Each
 * thumbnail is wrapped with a div of class = "exhibit-item". Modified for CPP to link directly to file.
 *
 * @param int $start The range of items on the page to display as thumbnails
 * @param int $end The end of the range
 * @param array $props Properties to apply to the <img> tag for the thumbnails
 * @param string $thumbnailType The type of thumbnail to display
 * @return string HTML output
 **/
function cpp_exhibit_builder_thumbnail_gallery($start, $end, $props = array(), $thumbnailType = 'square_thumbnail')
{
    $html = '';
    for ($i = (int)$start; $i <= (int)$end; $i++) {
        if ($attachment = exhibit_builder_page_attachment($i)) {
            $html .= "\n" . '<div class="exhibit-item">';
            if ($attachment['item']) {
                $html .= file_markup($attachment['file'], array('imageSize' => $thumbnailType, 'linkToFile' => 'fullsize', 'imgAttributes' => array('title' => '', 'class'=>'permalink', 'alt' => metadata($attachment['item'], array('Dublin Core', 'Title'))), 'linkAttributes' => array('data-title' => link_to_item('View full item-record', array(), 'show', $attachment['item'])))); 
            }
            $html .= exhibit_builder_attachment_caption($attachment);
            $html .= '</div>' . "\n";
        }
    }
    
    return apply_filters('exhibit_builder_thumbnail_gallery', $html,
        array('start' => $start, 'end' => $end, 'props' => $props, 'thumbnail_type' => $thumbnailType));
}

function tag_browse($recordOrTags = null, $link = null, $maxClasses = 9, $tagNumber = false, $tagNumberOrder = null, $page = 'A', $count = 0)
{
	if (!$recordOrTags) {
        $tags = array();
    } else if (is_string($recordOrTags)) {
        $tags = get_current_record($recordOrTags)->Tags;
    } else if ($recordOrTags instanceof Omeka_Record_AbstractRecord) {
        $tags = $recordOrTags->Tags;
    } else {
        $tags = $recordOrTags;
    }
    
    if (empty($tags)) {
        return '<p>' . __('No subjects are available.') . '</p>';
    }
	if (isset($_GET['page'])) {
	$page = $_GET['page'];
	}
	$html = '<div class="hTagcloud">';
	$html .= '<ul>';
	foreach( $tags as $tag ) {
		if (substr($tag['name'], 0, 1) == $page) {
			$count = $count + 1;
			$html .= '<li>';
			if ($link) {
				$html .= '<a href="' . html_escape(url($link, array('tags' => $tag['name']))) . '">';
			}
			$html .= html_escape($tag['name']);
			if ($link) {
				$html .= '</a>';
			}
			$html .= ' [';
			$html .= html_escape($tag['tagCount']);
			$html .= ']';
			$html .= '</li>' . "\n";
		}
	}
    $html .= '</ul></div>';
	if ($count == 0) {
	$html .= '<p>No subjects available under ' . html_escape($page) . '.</p>';
	}
    return $html;

}

function subject_nav_browse ($page = 'A')
{
	if (isset($_GET['page'])) {
	$page = $_GET['page'];
	}
	$html = '<nav class="subject_browse">';
		foreach (range('A', 'Z') as $letter) {
		$html .= '<a href="/items/tags?page=';
		$html .= html_escape($letter);
		$html .= '"';
			if ($letter == $page) {
			$html .= ' class="active"';
			}
		$html .= '>';
		$html .= html_escape($letter);
		$html .= '</a>' . "\n";
		}
	$html .= '</nav>';
	return $html;
}

/**
 * Return the navigation for items.
 * 
 * @package Omeka\Function\View\Navigation
 * @uses nav()
 * @param array $navArray
 * @param integer|null $maxDepth
 * @return string
 */
function public_nav_items2(array $navArray = null, $maxDepth = 0)
{
    if (!$navArray) {
        $navArray = array(
            array(
                'label' =>__('Browse All'),
                'uri' => url('items/browse?sort_field=Dublin+Core%2CTitle'),
            ));
            if (total_records('Tag')) {
                $navArray[] = array(
                    'label' => __('Browse by Subject'),
                    'uri' => url('items/tags')
                );
            }
			$navArray[] = array(
                'label' => __('Browse by Creator'),
                'uri' => url('creatorindex')
            );
            $navArray[] = array(
                'label' => __('Search Items'),
                'uri' => url('items/search')
            );
    }
    return nav($navArray, 'public_navigation_items');
}

function creator_index(){
	$db = get_db();
	$select = "
	SELECT DISTINCT text FROM omeka_element_texts
	WHERE element_id='39'";
	
	$creators = $db->getTable("ElementText")->fetchObjects($select);
	natsort($creators);
	$html = '<div class="creatorindex"><ul>';
	foreach ($creators as $creator) {
			$url = url('items/browse', array(
            'advanced' => array(
                array(
                    'element_id' => '39',
                    'type' => 'is exactly',
                    'terms' =>$creator->text,
					)
				)
			));
			$html .= '<li>';
			$html .= '<a href="';
			$html .= $url;
			$html .= '">';
			$html .= $creator;
			$html .= '</a>';
			$html .= '</li>' . "\n";
		}	
	$html .= '</ul></div>';
	return $html;

}

function link_to_related_exhibits($item) {

    $db = get_db();

    $select = "
    SELECT e.* FROM {$db->prefix}exhibits AS e
    INNER JOIN {$db->prefix}exhibit_pages AS ep on ep.exhibit_id = e.id
    INNER JOIN {$db->prefix}exhibit_page_blocks AS epb ON epb.page_id = ep.id
    INNER JOIN {$db->prefix}exhibit_block_attachments AS epba ON epba.block_id = epb.id
    WHERE epba.item_id = ?";

    $exhibits = $db->getTable("Exhibit")->fetchObjects($select,array($item->id));

    if(!empty($exhibits)) {
        echo '<h3>Related Exhibits</h3>';
        foreach($exhibits as $exhibit) {
            echo '<p><a href="/exhibits/show/'.$exhibit->slug.'">'.$exhibit->title.'</a></p>';
        }
    }
}

function meta_tags() {

	$title = '';
    $description = '';
    $url = '';
    $image_url = '';

	// Is the current record an item?  Use its metadata.
	try {
		$item = get_current_record('item');
		$title = metadata('item', array('Dublin Core', 'Title'));
		$description_array = metadata('item', array('Dublin Core', 'Description'), array('all' => true, 'snippet' => 200));
		$description = implode(' ',$description_array);
		$url = record_url($item, null, $getAbsoluteUrl = true);
		if ($item->hasThumbnail()) {
			$files = $item->getFiles();
			$image_url = $files[0]->getWebPath('fullsize');
		}
	
		// General
		echo '<meta name="description" content="'.$description.'" />';
		
		// Twitter
		echo '<meta name="twitter:card" content="summary_large_image" />';
		echo '<meta name="twitter:site" content="@CPPHistMedLib" />';
		echo '<meta property="twitter:title" content="'.$title.'" />';
		echo '<meta property="twitter:image:src" content="'.$image_url.'" />';
		echo '<meta property="twitter:url" content="'.$url.'" />';
		echo '<meta property="twitter:description" content="'.$description.'" />';
		
		//Facebook OG
		echo '<meta property="og:title" content="'.$title.'" />';
		echo '<meta property="og:type" content="article" />';
		echo '<meta property="og:url" content="'.$url.'" />';
		echo '<meta property="og:image" content="'.$image_url.'" />';
		echo '<meta property="og:description" content="'.$description.'" />';
	}
	catch (Omeka_View_Exception $ove){
      //  no item, don't do anything
      $not_item = true;
    }
	
	// Is the current record an exhibit?  Use its metadata.
	try {
		$exhibit = get_current_record('exhibit');
		$title = metadata('exhibit', 'title', array('no_escape' => false));
      	$description = metadata('exhibit', 'description', array('no_escape' => false, 'snippet' => 200));
      	$url = record_url($exhibit, null, $getAbsoluteUrl = true);
      	$exhibitItem = get_records('Item', array('hasImage'=>true,'exhibit'=>$exhibit, 'featured' => true), 1);
      	if (($exhibitItem!=null) && ($exhibitItem[0]->hasThumbnail())) {
      		$files = $exhibitItem[0]->getFiles();
			$image_url = $files[0]->getWebPath('fullsize');
      	}
      	
      	// General
		echo '<meta name="description" content="'.$description.'" />';
		
      	// Twitter
		echo '<meta name="twitter:card" content="summary_large_image" />';
		echo '<meta name="twitter:site" content="@CPPHistMedLib" />';
		echo '<meta property="twitter:title" content="'.$title.'" />';
		echo '<meta property="twitter:image:src" content="'.$image_url.'" />';
		echo '<meta property="twitter:url" content="'.$url.'" />';
		echo '<meta property="twitter:description" content="'.$description.'" />';
		
		//Facebook OG
		echo '<meta property="og:title" content="'.$title.'" />';
		echo '<meta property="og:type" content="article" />';
		echo '<meta property="og:url" content="'.$url.'" />';
		echo '<meta property="og:image" content="'.$image_url.'" />';
		echo '<meta property="og:description" content="'.$description.'" />';
	}
	catch (Omeka_View_Exception $ove){
      //  no exhibit, don't do anything
      $not_exhibit = true;
    }
	
	if ($not_item && $not_exhibit) {
		$title = option('site_title');
      	$description = option('description');
      	$url = "http://www.cppdigitallibrary.org/";
      	$image_url = "http://www.cppdigitallibrary.org/themes/mutter/css/images/grid2.jpg";
      	
      	// General
		echo '<meta name="description" content="'.$description.'" />';
		
      	// Twitter
		echo '<meta name="twitter:card" content="summary_large_image" />';
		echo '<meta name="twitter:site" content="@CPPHistMedLib" />';
		echo '<meta property="twitter:title" content="'.$title.'" />';
		echo '<meta property="twitter:image:src" content="'.$image_url.'" />';
		echo '<meta property="twitter:url" content="'.$url.'" />';
		echo '<meta property="twitter:description" content="'.$description.'" />';
		
		//Facebook OG
		echo '<meta property="og:title" content="'.$title.'" />';
		echo '<meta property="og:type" content="article" />';
		echo '<meta property="og:url" content="'.$url.'" />';
		echo '<meta property="og:image" content="'.$image_url.'" />';
		echo '<meta property="og:description" content="'.$description.'" />';
	}
}

function custom_paging()
{
//Starts a conditional statement that determines a search has been run
    if (isset($_SERVER['QUERY_STRING'])) {

        // Sets the current item ID to the variable $current
        $current = metadata('item', 'id');

        //Break the query into an array
        parse_str($_SERVER['QUERY_STRING'], $queryarray);

        //Items don't need the page level
        unset($queryarray['page']);

        $itemIds = array();
        $list = array();
        if (isset($queryarray['query'])) {
                //We only want to browse previous and next for Items
                $queryarray['record_types'] = array('Item');
                //Get an array of the texts from the query.
                $textlist = get_db()->getTable('SearchText')->findBy($queryarray);
                //Loop through the texts ans populate the ids and records.
                foreach ($textlist as $value) {
                        $itemIds[] = $value->record_id;
                        $record = get_record_by_id($value['record_type'], $value['record_id']);
                        $list[] = $record;
                }
        }
        elseif (isset($queryarray['advanced'])) {
                if (!array_key_exists('sort_field', $queryarray))
                {
                        $queryarray['sort_field'] = 'added';
                        $queryarray['sort_dir'] = 'd';
                }
                //Get an array of the items from the query.
                $list = get_db()->getTable('Item')->findBy($queryarray);
                foreach ($list as $value) {
                        $itemIds[] = $value->id;
                        $list[] = $value;
                }
        }
        //Browsing all items in general
        else
        {
                if (!array_key_exists('sort_field', $queryarray))
                {
                        $queryarray['sort_field'] = 'added';
                        $queryarray['sort_dir'] = 'd';
                }
                $list = get_db()->getTable('Item')->findBy($queryarray);
                foreach ($list as $value) {
                        $itemIds[] = $value->id;
                }
        }

        //Update the query string without the page and with the sort_fields
        $updatedquery = http_build_query($queryarray);
        $updatedquery = preg_replace('/%5B[0-9]+%5D/simU', '%5B%5D', $updatedquery);

        // Find where we currently are in the result set
        $key = array_search($current, $itemIds);

        // If we aren't at the beginning, print a Previous link
        if ($key > 0) {
            $previousItem = $list[$key - 1];
            $previousUrl = record_url($previousItem, 'show') . '?' . $updatedquery;
                $text = __('&lt; Previous');
            echo '<li id="previous-item" class="previous"><a href="' . html_escape($previousUrl) . '">' . $text . '</a></li>';
        }

        // If we aren't at the end, print a Next link
        if ($key >= 0 && $key < (count($list) - 1)) {
            $nextItem = $list[$key + 1];
            $nextUrl = record_url($nextItem, 'show') . '?' . $updatedquery;
                $text = __("Next &gt;");
                echo '<li id="next-item" class="next"><a href="' . html_escape($nextUrl) . '">' . $text . '</a></li>';
        }
    } else {
        // If a search was not run, then the normal next/previous navigation is displayed.
        echo '<li id="previous-item" class="previous">'.link_to_previous_item_show('&lt; Previous').'</li>';
        echo '<li id="next-item" class="next">'.link_to_next_item_show("Next &gt;").'</li>';
    }
}