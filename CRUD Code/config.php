<?php
//Auteur: Justin Mank
session_start();

class Database {
    public $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "EX_database";
    public $conn;

    public function __construct() {
        try {
            $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Kan geen verbinding maken met de database: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
