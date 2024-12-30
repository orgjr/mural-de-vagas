<?php

require_once 'Database.php';
require_once 'Anuncio.php';

class Cadastra extends Anuncio
{
    public function cadastra()
    {
        $db = new Database();
        $conn = $db->getConnection();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];

            // Verificar e processar o upload de imagem
            $imagem = null;
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../uploads/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
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

            // Inserir no banco de dados
            $stmt = $conn->prepare('INSERT INTO ads (titulo, descricao, imagem) VALUES (:titulo, :descricao, :imagem)');
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':imagem', $imagem);
            $stmt->execute();

            echo json_encode(['status' => 'success', 'message' => 'Anúncio cadastrado com sucesso']);
        } else {
            http_response_code(405);
            echo json_encode(['status' => 'error', 'message' => 'Erro ao criar o anúncio']);
        }
    }
}

// Instancia e executa
$cadastra = new Cadastra('', '', '');
$cadastra->cadastra();