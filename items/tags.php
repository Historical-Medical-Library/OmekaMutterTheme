<?php
$pageTitle = __('Items');
echo head(array('title'=>$pageTitle, 'bodyclass'=>'items tags'));
?>

<h1><?php echo $pageTitle; ?></h1>

<nav class="navigation items-nav secondary-nav">
    <?php echo public_nav_items2(); ?>
</nav>
<?php echo subject_nav_browse(); ?>

<?php 
natcasesort($tags);
echo tag_browse($tags, 'items/browse'); ?>

<?php echo foot(); ?>
