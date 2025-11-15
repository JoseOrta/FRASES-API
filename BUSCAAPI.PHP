<?php


// Permite acceso desde cualquier origen (dev, producción ajusta el dominio)
header("Access-Control-Allow-Origin: *");
// Permite ciertos métodos (GET, POST)
header("Access-Control-Allow-Methods: GET, POST");
header('Content-Type: application/json');





// Indica que la respuesta será en formato JSON
header('Content-Type: application/json');

// URL de la API pública que devuelve una frase motivacional aleatoria
$url = "https://frasedeldia.azurewebsites.net/api/phrase";

// Realiza la petición GET a la API externa
$response = file_get_contents($url);

// Verifica si la petición fue exitosa
if ($response === FALSE) {
    // En caso de error, responde con código HTTP 500 y mensaje de error en JSON
    http_response_code(500);
    echo json_encode(["error" => "No se pudo obtener la frase"]);
    exit; // Termina la ejecución del script
}

// Decodifica la respuesta JSON recibida en un array asociativo de PHP
$data = json_decode($response, true);

// Verifica que la decodificación JSON haya sido exitosa
if (!$data) {
    // Si falla la decodificación, responde con error 500 y mensaje en JSON
    http_response_code(500);
    echo json_encode(["error" => "Error al procesar la respuesta"]);
    exit; // Termina la ejecución del script
}

// Si todo está bien, devuelve un JSON con la frase y el autor extraídos de la API
echo json_encode([
    "phrase" => $data["phrase"],  // Frase motivacional
    "author" => $data["author"]   // Autor de la frase
]);
