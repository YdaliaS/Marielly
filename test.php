<?php

// Definir la URL de la API y tu clave de API
$apiUrl = 'https://api.remove.bg/v1.0/removebg';
$apiKey = 'INSERT_YOUR_API_KEY_HERE';

// Definir la URL de la imagen que deseas procesar
$imageUrl = 'https://www.remove.bg/example.jpg';

// Directorio donde deseas guardar la imagen sin fondo
$saveDirectory = __DIR__ . '/images/';

// Configurar los datos del formulario para la solicitud POST
$postData = [
    'image_url' => $imageUrl,
    'size' => 'auto',
];

// Configurar las opciones de la solicitud cURL
$options = [
    CURLOPT_URL => $apiUrl,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $postData,
    CURLOPT_HTTPHEADER => [
        'X-API-Key: ' . $apiKey,
    ],
];

// Inicializar cURL y configurar opciones
$ch = curl_init();
curl_setopt_array($ch, $options);

// Ejecutar la solicitud cURL
$response = curl_exec($ch);

// Verificar si hay errores
if (curl_errno($ch)) {
    echo 'Error al hacer la solicitud: ' . curl_error($ch);
    // Manejar el error según tus necesidades
} else {
    // Crear el directorio si no existe
    if (!is_dir($saveDirectory)) {
        mkdir($saveDirectory, 0755, true);
    }

    // Guardar la imagen sin fondo en un archivo en el directorio especificado
    file_put_contents($saveDirectory . 'no-bg.png', $response);
    echo 'Imagen sin fondo guardada en ' . $saveDirectory . 'no-bg.png';
}

// Cerrar la sesión cURL
curl_close($ch);
?>
