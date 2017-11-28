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

$robots = c::get('seo.robots.txt', true);

if ( $robots !== false){
    
    if ($robots === true) c::set('seo.robots.txt', $robotsDefault);

    $kirby->set('route', array(
        'pattern' => 'robots.txt',
        'action'  => function() {
            return new Response(trim(c::get('seo.robots.txt')), 'text/plain', 200);
        }
    ));
}