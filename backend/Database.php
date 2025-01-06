<?php

class Database
{
    private $runDatabase;
    private $conn;

    public function setRunDb() {
        $this->runDatabase = '../python/CreateDb.py';
        $output = shell_exec("python3 $this->runDatabase");
    }

    public function __construct()
    {
        $this->conn = new PDO('sqlite:../python/db/database.db');
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection()
    {
        return $this->conn;
    }
}
?>