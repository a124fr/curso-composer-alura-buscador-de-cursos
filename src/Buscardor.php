<?php

namespace Alura\BuscadorDeCursos;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class Buscardor
{
    private ClientInterface $httpClient;
    private Crawler $crawler;

    public function __construct(ClientInterface $httpClient, Crawler $crawler)
    {
        $this->httpClient = $httpClient;
        $this->crawler = $crawler;
    }

    public function buscar(string $url): array
    {
        $resposta = $this->httpClient->request('GET', $url);
        $html = $resposta->getBody()->getContents();

        $this->crawler->addContent($html);
        $cursos = $this->crawler->filter('span.card-curso__nome');

        $contador = 1;
        $titulosCursos = [];

        foreach ($cursos as $curso) {
            $titulosCursos[] = "{$contador}° - {$curso->nodeValue}";
            $contador++;
        }

        return  $titulosCursos;
    }
}
