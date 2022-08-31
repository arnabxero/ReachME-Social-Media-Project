<?php
class dbConfig
{
    
    public $host;
    public $username;
    public $password;
    public $dbName = NULL;
    public $conn;

    public function dbConnect() {
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->dbName);
    
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }
}

    $obj = new dbConfig();
    $obj->host = 'localhost';
    $obj->username = 'root';
    $obj->password = '';
    $obj->dbName = 'pw2';
    $obj->dbConnect();
