<?php

class Anuncio {
        
    public $titulo;
    public $descricao;
    public $imagem;

    public function __construct($titulo, $descricao, $imagem) 
    {
        $this->titulo = $titulo;
        $this->descricao = $descricao;
        $this->imagem = $imagem;
    }
}