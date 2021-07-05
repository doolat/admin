<?php

class config
{
    private $servername = "localhost";
    private $username = "maks";
    private $password = "1234";
    private $database = "sibers";
    protected $conn = null;
    public function __construct(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
}
