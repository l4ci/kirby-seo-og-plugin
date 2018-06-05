<?php
    // Config
    $debug    = c::get('seo.debug', false);
    $disabled = c::get('seo.meta.disable', false);

    if ($disabled) return;

    // Title and description
    $title = ( $page->metatitle()->isNotEmpty() ? $page->metatitle()->html() : $page->title()->html() . " | " . $site->title()->html() );
    $description = ( $page->metadescription()->isNotEmpty() ? $page->metadescription()->html() : str::excerpt($page->text(), 157, true) );

    // Robots Index,Noindex Follow,Nofollow
    $index = 'index';
    if ($page->metaindex()->isNotEmpty()){
        $index = ($page->metaindex()->isFalse() ? 'noindex': 'index');
    }else if ($site->metaindex()->isNotEmpty()){
        $index = ($site->metaindex()->isFalse() ? 'noindex': 'index');
    }

    $follow = 'follow';
    if ($page->metafollow()->isNotEmpty()){
        $follow = ($page->metafollow()->isFalse() ? 'nofollow': 'follow');
    }else if ($site->metafollow()->isNotEmpty()){
        $follow = ($site->metafollow()->isFalse() ? 'nofollow': 'follow');
    }
?>

<?php e($debug, '<!-- SEO: Meta -->'); ?>

    <link rel="canonical" href="<?php echo $page->url() ?>">
    <title itemprop="name"><?php echo $title ?></title>

    <?php if ( $description ): ?>
        <meta name="description" content="<?php echo $description; ?>">
    <?php endif; ?>

    <meta name="robots" content="<?php echo $index?>,<?php echo $follow?>" />

<?php e($debug, '<!-- /SEO: Meta -->'); ?>
