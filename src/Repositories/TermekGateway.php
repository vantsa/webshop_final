<?php
class TermekGateway {

    private PDO $conn;
    public function __construct(Database $database)
    {
        $this->conn=$database->getConnection();
    }

    public function getAll():array {
        $sql = "SELECT id, name, kep_url, ar 
                    FROM termekek";
        $stmt = $this->conn->query($sql);
        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;

    }

    public function getDetail(int $termekId):array {
        $sql = "SELECT * 
                    FROM termekek
                    WHERE id = $termekId 
                    ";
        $stmt = $this->conn->query($sql);
        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        if(count($data) == 0) {
            return ['404'];
        }
        return $data[0];
    }

    public function getByCategory(string $category):array {
        $sql = "SELECT t.id, t.name, t.darab_szam, t.ar, t.kep_url 
                    FROM termek_kategoriak tk
                    INNER JOIN termekek t ON t.kategoriaID = tk.id
                    WHERE tk.name = '$category'
                    ";
        $stmt = $this->conn->query($sql);
        $data = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        if(count($data) == 0) {
            return ['404'];
        }
        return $data;
    }
}