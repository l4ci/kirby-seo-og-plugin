<?php
    // Config
    $debug    = c::get('seo.debug', false);
    $disabled = c::get('seo.meta.disable', false);

    if ($disabled) return;

    // Title and description
    $title = ( $page->metatitle()->isNotEmpty() ? $page->metatitle()->html() : $page->title()->html() . " | " . $site->title()->html() );
    $description = ( $page->metadescription()->isNotEmpty() ? $page->metadescription()->html() : $page->text()->excerpt(157) );

    // Robots Index,Noindex Follow,Nofollow
    $index = ( $page->metaindex()->isNotEmpty() ? ($page->metaindex()->isFalse() ? 'noindex': 'index') : 'index' );
    $follow = ( $page->metafollow()->isNotEmpty() ? ($page->metafollow()->isFalse() ? 'nofollow' : 'follow') : 'follow' );
?>

<?php e($debug, '<!-- SEO: Meta -->'); ?>

    <link rel="canonical" href="<?php echo $page->url() ?>">
    <title itemprop="name"><?php echo $title ?></title>

<?php if ( $description ): ?>
    <meta name="description" content="<?php echo $description; ?>">
<?php endif; ?>

<meta name="robots" content="<?php echo $index?>,<?php echo $follow?>" />

<?php e($debug, '<!-- /SEO: Meta -->'); ?>
