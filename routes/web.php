<?php

use Bramus\Router\Router;

$router = new Router();
$router->setNamespace('\App\Controllers');
$router->get('/', 'ViewController@home');
$router->get('/profil/([a-zA-Z0-9_-]+)', 'ViewController@pages');
$router->get('/pelayanan/([a-zA-Z0-9_-]+)', 'ViewController@pages');
$router->get('/publikasi/([a-zA-Z0-9_-]+)', 'ViewController@pages');

$router->get('/images/(\w+\.(jpg|jpeg|png|gif|bmp|webp|svg))', function ($filename) {
    // Lokasi asli file di folder "storage/images"
    $filePath = __DIR__ . '/../storage/images/' . $filename;

    // Periksa apakah file ada
    if (file_exists($filePath)) {
        // Dapatkan MIME type
        $mimeType = mime_content_type($filePath);

        // Set header untuk response
        header('Content-Type: ' . $mimeType);
        header('Content-Length: ' . filesize($filePath));

        // Baca file dan kirimkan ke browser
        readfile($filePath);
        exit;
    } else {
        // Tampilkan error jika file tidak ditemukan
        header('HTTP/1.1 404 Not Found');
        echo "File tidak ditemukan.";
    }
});



$router->set404(function () {
    header('location: /');
    exit();
});

$router->run();
