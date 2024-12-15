<?php

class Database
{
    // Declare variable
    private $host = "localhost";
    private $db_name = "Lab_5b";
    private $username = "root";
    private $password = "";
    public $conn;

    // Method untuk dapatkan database connection
    public function getConnection()
    {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error); // Jika gagal
        } else {
            // echo "Connected successfully"; Jika berjaya
        }

        return $this->conn;
    }
}
