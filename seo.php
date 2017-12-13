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
            $pages = site()->index()->visible();

            // Filter out Modules
            $pages = $pages->filterBy('isModule', false);

            $ignore = c::get('seo.xmlsitemap.ignore', ['sitemap', 'error']);
            $ignoreTemplates = c::get('seo.xmlsitemap.ignoretemplates', ['cronjob', 'error', 'redirect']);


            $r = '';
            $r .= '<?xml version="1.0" encoding="utf-8"?>';
            $r .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

            foreach($pages as $p){
                if ( in_array($p->uri(), $ignore) ) continue;
                if ( in_array($p->uri(), $ignoreTemplates) ) continue;
                if ( $p->metaindex()->isFalse() ) continue;

                $r .= '<url><loc>'.$p->url().'</loc><lastmod>'.$p->modified('c').'</lastmod><priority>'.( $p->isHomePage() ? 1 : number_format(0.5/$p->depth(), 1)).'</priority></url>';
            }
            $r .= '</urlset>';

            return new Response(trim($r), 'text/plain', 200);
        }
    ));
}
