<?php

require_once 'Anuncio.php';

class Cadastra extends Anuncio
{
    public function cadastra()
    {
        $arquivo = '../fakeAPI/anuncios.json';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];

            // Verificar e processar o upload de imagem
            $imagem = null;
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Criar o diretório, se não existir
                }
                $nomeImagem = uniqid() . '-' . basename($_FILES['imagem']['name']);
                $caminhoImagem = $uploadDir . $nomeImagem;

                if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
                    $imagem = $caminhoImagem;
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Erro ao salvar imagem.']);
                    exit;
                }
            }

            $novoAnuncio = [
                'titulo' => $titulo,
                'descricao' => $descricao,
                'imagem' => $imagem ? $imagem : 'Imagem não enviada'
            ];

            // Ler os anúncios existentes do arquivo
            $anunciosExistem = file_exists($arquivo);
            $anuncios = $anunciosExistem ? json_decode(file_get_contents($arquivo), true) : [];

            $anuncios[] = $novoAnuncio;

            // Salvar o array atualizado no arquivo
            file_put_contents($arquivo, json_encode($anuncios, JSON_PRETTY_PRINT));

            echo json_encode(['status' => 'success', 'message' => 'Anúncio cadastrado com sucesso']);
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Método não permitido']);
        }
    }
}

// Instancia e executa
$cadastra = new Cadastra('', '', '');
$cadastra->cadastra();