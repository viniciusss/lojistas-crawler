<?php

require_once __DIR__ . '/functions.php';

$crawler = createCrawler('/mapa-do-site');

$res = $crawler->filter('div[data-component="sitemapList"]');

$categorias = $res->filter('li.child-level-2 > a');

printf('Categorias encontradas: %d. %s', count($categorias), PHP_EOL);

$urlCategorias = [];

foreach ($categorias as $categoria) {
    $urlCategorias[] = $categoria->getAttribute('href');
}

saveCache('categorias', $urlCategorias);
