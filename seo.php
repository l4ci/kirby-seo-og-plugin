<?php

if (!c::get('seo', false)) return;

// Register blueprints
$kirby->set('blueprint', 'fields/metadata',  __DIR__ . '/blueprints/fields/metadata.yml');
$kirby->set('blueprint', 'fields/opengraph', __DIR__ . '/blueprints/fields/opengraph.yml');

// Register snippets
$kirby->set('snippet', 'seo.meta',      __DIR__ . '/snippets/seo.meta.php');
$kirby->set('snippet', 'seo.opengraph', __DIR__ . '/snippets/seo.opengraph.php');

// Robots.txt
$robotsDefault = '
User-agent: *
Disallow:';

$robotsEnabled = c::get('seo.robots.txt', true);

if ( $robotsEnabled !== false){
    
    if ($robotsEnabled === true) c::set('seo.robots.txt', $robotsDefault);

    $kirby->set('route', array(
        'pattern' => 'robots.txt',
        'action'  => function() {
            return new Response(trim(c::get('seo.robots.txt')), 'text/plain', 200);
        }
    ));

    $kirby->set('route', array(
        'pattern' => 'sitemap',
        'action'  => function() {
            $ignore = c::get('seo.xmlsitemap.ignore', array('sitemap', 'error'));
            header('Content-type: text/xml; charset="utf-8"');
            echo '<?xml version="1.0" encoding="utf-8"?>';
            ?>
            <urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
                <?php foreach($pages->index() as $p): ?>
                <?php if(in_array($p->uri(), $ignore)) continue ?>
                    <url>
                        <loc><?php echo html($p->url()) ?></loc>
                        <lastmod><?php echo $p->modified('c') ?></lastmod>
                        <priority><?php echo ($p->isHomePage()) ? 1 : number_format(0.5/$p->depth(), 1) ?></priority>
                    </url>
                <?php endforeach ?>
            </urlset>
            <?php
        }
    ));
}