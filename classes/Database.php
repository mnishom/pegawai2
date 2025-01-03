<?php
class Database
{
    private $host = "localhost";
    private $dbName = "pegawai";
    private $username = "root";
    private $password = "";
    private $connection;

    public function connect()
    {
        try {
            $this->connection = new PDO(
                "mysql:host={$this->host};dbname={$this->dbName}",
                $this->username,
                $this->password
            );
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $e) {
            $response = [
                'status' => 'failed',
                'message' => 'Gagal terhubung ke basis data.' . $e->getMessage(),
            ];
            header('Content-Type: application/json');
            echo json_encode($response);

            //die("Database Connection Error: " . $e->getMessage());
        }
    }
}
