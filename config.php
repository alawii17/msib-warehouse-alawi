<?php
class Database {
    private $host = "localhost";
    private $port = 3306;
    private $db_name = "db_msib";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host;port=$this->port;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(Throwable $error) {
            echo "Connected Failed: ". $error->getMessage();
        }

        return $this->conn;
    }
}

$database = new Database();
$database->getConnection();
?>