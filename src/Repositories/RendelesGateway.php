<?php

class RendelesGateway
{
    private PDO $conn;
    public function __construct(Database $database)
    {
        $this->conn=$database->getConnection();
    }

    public function handleOrder(array $items):void {
        print_r($items);
        $sql = "INSERT INTO rendelesek (name, address, email, products) VALUES('". $items['name']."', '".$items['address']."','".$items['email']."','".json_encode($items['items'])."')";
        $stmt = $this->conn->query($sql);
    }
}