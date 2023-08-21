<?php

class RendelesController
{
    public function __construct(private RendelesGateway $gateway)
    {}

    public function processRequest(string $method, string $type, array $body): void
    {

        if($method == "POST" && $type=='rendeles') {
            $this->handleRendeles($body);
        }
    }

    private function handleRendeles(array $items) {
        $this->gateway->handleOrder($items);
        http_response_code(200);
        echo json_encode(["message" => "Record inserted successfully"]);
    }
}