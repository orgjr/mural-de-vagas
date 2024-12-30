<?php

class Database
{
    private $conn;

    public function __construct()
    {
        // Defina o caminho correto do banco de dados SQLite
        $this->conn = new PDO('sqlite:../python/bd/muraldevagas.db');
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
?>