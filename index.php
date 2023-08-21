<?php

declare(strict_types=1);

// ki vettem h a foldereket tudjunk controller, repo, viewmodelbe rendezni, ha kapunk kezenfekvo megoldast vissza tehetjuk
//spl_autoload_register(function ($class) {
//   require __DIR__ . "/src/$class.php";
//});

// usings
require __DIR__ . "/src/Database.php";
require __DIR__ . "/src/ErrorHandler.php";
require __DIR__ . "/src/Controllers/TermekController.php";
require __DIR__ . "/src/Controllers/RendelesController.php";
require __DIR__ . "/src/Repositories/TermekGateway.php";
require __DIR__ . "/src/Repositories/RendelesGateway.php";

set_exception_handler("\\ErrorHandler::handleException");



header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header("Content-type: application/json; charset=UTF-8");


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
    http_response_code(200);
    exit;
}

$parts = explode("/",$_SERVER["REQUEST_URI"]);
if($parts[2] == "termekek") {
    $id = $parts[3] ?? null;
    $kategoria = $parts[4] ?? null;

    $database = new Database("localhost","webaruhaz","root","123");

    $gateway = new TermekGateway($database);

    $controller = new TermekController($gateway);

    $controller->processRequest($_SERVER["REQUEST_METHOD"], $parts[2], $id, $kategoria);
}
if($parts[2] == "images" && $parts[3] != null) {
    $im = file_get_contents('images/' . $parts[3]);
    header('content-type: image/gif');
    echo $im;
}
if($parts[2] == "rendeles") {
    $entityBody = file_get_contents('php://input');
    $entityObject = json_decode($entityBody,true);
    $database = new Database("localhost","webaruhaz","root","123");

    $gateway = new RendelesGateway($database);

    $controller = new RendelesController($gateway);

    $controller->processRequest($_SERVER["REQUEST_METHOD"], $parts[2], $entityObject);

}


