<?php

require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../core/bootstrap.php";

/*Esta função retorna uma matriz associativa retornando os vários componentes que estão presentes em uma url. 
Se um dos elementos não estiver presente, não será criada uma entrada para ele. 
Os valores dos elementos do array não são codificados. Esta função não é um meio para validar a URL indicada, 
ela somente quebra nas partes listadas. URLs parciais também são aceitas, parse_url() 
tenta o melhor para interpreta-las corretamente. O PHP_URL_PATH é uma constante da PHP para detectar a URL digitada*/
