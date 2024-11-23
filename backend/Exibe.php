<?php

require_once 'Anuncio.php';

class Exibe extends Anuncio
{
    public function exibir($termoPesquisa = '')
    {
        $arquivo = '../fakeAPI/anuncios.json';
        $conteudoJson = file_exists($arquivo) ? file_get_contents($arquivo) : null;
        $anuncios = $conteudoJson ? json_decode($conteudoJson, true) : [];

        if (!empty($termoPesquisa)) {
            $termoPesquisa = strtolower($termoPesquisa); // Converter o termo para minúsculas para tornar a busca case-insensitive
            $anuncios = array_filter($anuncios, function($anuncio) use ($termoPesquisa) {
                return strpos(strtolower($anuncio['titulo']), $termoPesquisa) !== false ||
                       strpos(strtolower($anuncio['descricao']), $termoPesquisa) !== false;
            });
        }

        // Invertendo a ordem dos anúncios, os últimos cadastrados aparecem no topo da página
        $anuncios = array_reverse($anuncios);

        foreach ($anuncios as $anuncio) {
            echo '<div class="anuncio">';
            echo '<div class="imagem">';
            if (!empty($anuncio['imagem']) && file_exists($anuncio['imagem'])) {
                echo '<img src="' . $anuncio['imagem'] . '" alt="Imagem do Anúncio" class="imagem-centralizada">';
            } else {
                echo '<img src="../Assets/images/noimg-ok.jpeg" alt="Sem imagem disponível">';
            }
            echo '</div>';
            echo '<div class="texto">';
            echo '<h2>' . htmlspecialchars($anuncio['titulo']) . '</h2>';
            echo '<p>' . nl2br(htmlspecialchars($anuncio['descricao'])) . '</p>';
            echo '</div>';
            echo '</div>';
        }
    }
}

// Instancia e executa
if (isset($_GET['pesquisar'])) {
    $termoPesquisa = $_GET['pesquisar'];
} else {
    $termoPesquisa = '';
}

$exibeAnuncios = new Exibe('', '', '');
$exibeAnuncios->exibir($termoPesquisa);