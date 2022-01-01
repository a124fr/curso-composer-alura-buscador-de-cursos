<?php

require __DIR__ . DIRECTORY_SEPARATOR .'vendor/autoload.php';

use \GuzzleHttp\Client;
use \Symfony\Component\DomCrawler\Crawler;
use Alura\BuscadorDeCursos\Buscardor;

Teste::metodo();
Teste2::metodo();

$client = new Client(['base_uri' => 'https://www.alura.com.br/']);

$crawler = new Crawler();

$buscardor = new Buscardor($client, $crawler);
$cursos = $buscardor->buscar('/cursos-online-programacao/php');

foreach ($cursos as $curso) {
    echo exibeMensagem($curso);
}