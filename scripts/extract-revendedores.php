<?php
require_once __DIR__ . '/functions.php';

$categorias = fetchCache('categorias');

$categorias = array_slice($categorias, 1, 1);

$revendedores = [];

foreach ($categorias as $categoria) {
    $produtos = fetchCache('produtos_categoria_' . $categoria);

    foreach ($produtos as $produto) {
        $crawler = createCrawler($produto['href']);

        $mainPrice = $crawler->filter('div.main-price');
        $revendedor = $mainPrice->filter('a.product-info-link')->getNode(0);

        $revendedores[$revendedor->getAttribute('href')] = [
            'href' => $revendedor->getAttribute('href'),
            'titulo' => $revendedor->textContent,
        ];
    }
}

printf('>>>> Revendedores encontrados: %d %s', count($revendedores), PHP_EOL);

saveCache('revendedores', array_values($revendedores));