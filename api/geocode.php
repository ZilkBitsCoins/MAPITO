<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');
header('Cache-Control: public, max-age=300');

$query = trim((string) ($_GET['q'] ?? ''));
if (mb_strlen($query) < 2 || mb_strlen($query) > 160) {
    http_response_code(400);
    echo json_encode(['error' => 'La búsqueda debe tener entre 2 y 160 caracteres.'], JSON_UNESCAPED_UNICODE);
    exit;
}

$url = 'https://nominatim.openstreetmap.org/search?' . http_build_query([
    'q' => $query,
    'format' => 'jsonv2',
    'limit' => 5,
    'addressdetails' => 1,
]);

$context = stream_context_create([
    'http' => [
        'method' => 'GET',
        'timeout' => 8,
        'ignore_errors' => true,
        'header' => "User-Agent: ExploraMapa/1.0 (OpenStreetMap demo)\r\nAccept: application/json\r\n",
    ],
]);

$response = @file_get_contents($url, false, $context);
if ($response === false) {
    http_response_code(502);
    echo json_encode(['error' => 'El servicio de geocodificación no está disponible.'], JSON_UNESCAPED_UNICODE);
    exit;
}

$results = json_decode($response, true);
if (!is_array($results)) {
    http_response_code(502);
    echo json_encode(['error' => 'Respuesta inválida del servicio de mapas.'], JSON_UNESCAPED_UNICODE);
    exit;
}

$cleanResults = array_map(static function (array $result): array {
    return [
        'lat' => $result['lat'] ?? null,
        'lon' => $result['lon'] ?? null,
        'name' => $result['display_name'] ?? 'Ubicación',
    ];
}, $results);

echo json_encode(['results' => $cleanResults], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
