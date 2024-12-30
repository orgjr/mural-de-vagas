<?php

require_once 'Database.php';
require_once 'Anuncio.php';

class Exibe extends Anuncio
{
    public function exibir($termoPesquisa = '')
    {
        $db = new Database();
        $conn = $db->getConnection();

        $query = 'SELECT * FROM ads';
        if (!empty($termoPesquisa)) {
            $query .= ' WHERE LOWER(titulo) LIKE :pesquisa OR LOWER(descricao) LIKE :pesquisa';
        }
        $query .= ' ORDER BY id DESC';

        $stmt = $conn->prepare($query);
        if (!empty($termoPesquisa)) {
            $pesquisa = '%' . strtolower($termoPesquisa) . '%';
            $stmt->bindParam(':pesquisa', $pesquisa);
        }
        $stmt->execute();
        $anuncios = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
$termoPesquisa = $_GET['pesquisar'] ?? '';
$exibeAnuncios = new Exibe('', '', '');
$exibeAnuncios->exibir($termoPesquisa);