# Lojistas Crawler

## Instalar dependências

- Baixar o composer: http://getcomposer.org/download/
- Rodar `composer install`

## Utilizando ferramenta

### Baixando categorias

Primeiro é necessário baixar as categorias usando o comando:

> php scripts/extract-categorias.php

Isso irá criar um arquivo json dento de `data/categorias.json`.

### Baixando produtos por categoria

Depois das categorias baixadas, é necessário buscar quais produtos pertencem a cada categoria.

> php scripts/extract-produtos.php

Esse comando irá gerar um arquivo json para cada categoria em `data/produtos_categoria_*`

### Baixando revendedores por produto

Depois dos produtos baixados, é necessário buscar qual é o revendedor de cada produto.

> php scripts/extract-revendedores.php

Este comando irá gerar um arquivo dentro de `data/revendedores.json`