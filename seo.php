<?php

// Register blueprints
$kirby->set('blueprint', 'fields/metadata',  __DIR__ . '/blueprints/fields/metadata.yml');
$kirby->set('blueprint', 'fields/opengraph', __DIR__ . '/blueprints/fields/opengraph.yml');

// Register snippets
$kirby->set('snippet', 'seo.meta',      __DIR__ . '/snippets/seo.meta.php');
$kirby->set('snippet', 'seo.opengraph', __DIR__ . '/snippets/seo.opengraph.php');
