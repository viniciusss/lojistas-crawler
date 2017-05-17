<?php
require_once __DIR__ . '/../vendor/autoload.php';

define('BASE_URL', 'https://www.submarino.com.br');
define('CACHE_DIR', __DIR__ . '/../data');

use Symfony\Component\DomCrawler\Crawler;

function fetchContent(string $path): string
{
    return file_get_contents(BASE_URL . $path);
}

function createCrawler(string $path): Crawler
{
    return new Crawler(fetchContent($path));
}


function _formatCacheFileName(string $name)
{
    $name = str_replace('/', '--', $name);

    return sprintf('%s/%s.json', CACHE_DIR, $name);
}

function saveCache(string $name, $data)
{
    return file_put_contents(_formatCacheFileName($name), json_encode($data));
}

function fetchCache(string $name, $default = null)
{
    $data = file_get_contents(_formatCacheFileName($name));

    if (false === $data) {
        return $default;
    }

    return json_decode($data, true);
}