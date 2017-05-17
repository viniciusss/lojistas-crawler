<?php
require_once __DIR__ . '/functions.php';

$categorias = fetchCache('categorias');

$categorias = array_slice($categorias, 1, 1);

define('ITENS_POR_PAGINA', 24);

function getTotalDeProdutos(\Symfony\Component\DomCrawler\Crawler $crawler)
{
    $aside = $crawler->filter('aside.sortbar');

    return (int)str_replace('.', '', $aside->filter('span')->getNode(0)->textContent);
}

function createCrawlerCategoria(string $categoria, int $offset = 0)
{
    $url = $categoria;
    $url .= '?offset=' . $offset;
    $url .= '&limite=' . ITENS_POR_PAGINA;

    return createCrawler($url);
}

foreach ($categorias as $categoria) {

    printf('Categoria: %s%s', $categoria, PHP_EOL);

    $produtosListados = [];

    $offset = 0;

    do {
        $crawler = createCrawlerCategoria($categoria, $offset);

        if (!isset($totalProdutos)) {
            $totalProdutos = getTotalDeProdutos($crawler);
            printf('>>>>>Total de produtos: %d. %s', $totalProdutos, PHP_EOL);
        }

        $produtos = $crawler->filter('a.card-product-url');

        /**
         * @var $produto DOMElement
         */
        foreach ($produtos as $produto) {
            $produtosListados[] = [
                'href' => $produto->getAttribute('href'),
                'title' => $produto->getAttribute('title'),
            ];
        }

        $offset += ITENS_POR_PAGINA;

    } while ($totalProdutos > count($produtosListados));

    saveCache('produtos_categoria_' . $categoria, $produtosListados);
}