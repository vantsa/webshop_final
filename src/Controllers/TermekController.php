<?php

class TermekController
{


    public function __construct(private TermekGateway $gateway)
    {}

    public function processRequest(string $method, string $type, ?string $id, ?string $kategoria): void
    {

        if($method == "GET" && $id == NULL) {
            $this->browseCollection();
        }
        if($method == "GET" && $id != NULL && $id != 0 && is_numeric($id)) {
            $this->browseDetail($id);
        }
        if($method == "GET" && $id == 'kategoriak') {
            $this->browseByCategory($kategoria);
        }

    }

    private function browseCollection():void
    {
        echo json_encode($this->gateway->getAll());
    }

    private function browseDetail(int $id):void {
        echo json_encode($this->gateway->getDetail($id));
    }
    private function browseByCategory($kategoria):void {
        echo json_encode($this->gateway->getByCategory($kategoria));
    }
}