<?php
    // Config
    $debug    = c::get('seo.debug', false);
    $og_types = c::get('seo.ogtypes', false);
    $disabled = c::get('seo.opengraph.disable', false);

    if ($disabled) return;

    // Title and description
    $og_title = ( $page->ogtitle()->isNotEmpty() ? $page->ogtitle()->html() : $page->title()->html() );
    $og_description = ( $page->ogdescription()->isNotEmpty() ? $page->ogdescription()->html() : false );

    // Type
    $og_type = 'website';
    if ($og_types !== false && count($og_types) > 0 ) {
        if ( in_array_key_exists($page->intendedTemplate(), $og_types ) ){
            $og_type = $og_types[$page->intendedTemplate()];
        }
    }

    // Image
    $og_img = false;
    if ( $page->ogimage()->isNotEmpty() ){
        $og_img = $page->ogimage()->toFile();
    }
?>
<?php e($debug, '<!-- SEO: Open Graph -->'); ?>

    <meta property="og:locale" content="<?php echo site()->language() ? site()->language()->code() : 'en' ?>">
    <meta property="og:site_name" content="<?php echo site()->title() ?>">
    <meta property="og:type" content="<?php echo $og_type ?>" />
    <meta property="og:url" content="<?php echo $page->url() ?>">
    <meta property="og:title" content="<?php echo $og_title ?>">

<?php if ($og_description): ?>
    <meta property="og:description" content="<?php echo $og_description ?>">
<?php endif; ?>

<?php if ($og_img): ?>
    <meta property="og:image" content="<?php echo $og_img->url() ?>">
<?php endif; ?>

<?php e($debug, '<!-- /SEO: Open Graph -->'); ?>
