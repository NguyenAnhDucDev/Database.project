<?php

class Connection
{
    private $server;
    private $bank;
    private $user;
    private $password;

    function __construct()
    {
        $this->server = "localhost";
        $this->bank = "FINANCIAL_SYSTEM";
        $this->user = "root";
        $this->password = "";
    }

    public function conectar() {
        try {
            $con = new PDO("mysql:host={$this->server};dbname={$this->bank};charset=utf8;",$this->user, $this->password);
            return $con;
        } catch (PDOException $msg) {
            echo "Error connecting to database: {$msg}";
        }
    }

}

?>