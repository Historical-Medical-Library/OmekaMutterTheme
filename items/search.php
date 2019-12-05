<?php
$pageTitle = __('Advanced Search');
echo head(array('title' => $pageTitle,
           'bodyclass' => 'items advanced-search'));
?>

<h1><?php echo $pageTitle; ?></h1>

<nav class="items-nav navigation secondary-nav">
    <?php echo public_nav_items2(); ?>
</nav>

<?php echo $this->partial('items/search-form.php',
    array('formAttributes' =>
        array('id'=>'advanced-search-form'))); ?>

<?php echo foot(); ?>
