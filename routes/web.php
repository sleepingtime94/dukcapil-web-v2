<?php

use Bramus\Router\Router;

$router = new Router();
$router->setNamespace('\App\Controllers');
$router->get('/', 'ViewController@home');
$router->get('/profil/([a-zA-Z0-9_-]+)', 'ViewController@pages');
$router->get('/pelayanan/([a-zA-Z0-9_-]+)', 'ViewController@pages');
$router->get('/publikasi/([a-zA-Z0-9_-]+)', 'ViewController@pages');


$router->get('/images/([a-zA-Z0-9_-]+)\.(jpg|jpeg|png|gif|bmp|webp|svg)', function ($image, $ext) {

    $filePath = __DIR__ . '/storage/image/' . $image . '.' . $ext;

    if (file_exists($filePath)) {
        switch (strtolower($ext)) {
            case 'jpg':
            case 'jpeg':
                $mimeType = 'image/jpeg';
                break;
            case 'png':
                $mimeType = 'image/png';
                break;
            case 'gif':
                $mimeType = 'image/gif';
                break;
            case 'bmp':
                $mimeType = 'image/bmp';
                break;
            case 'webp':
                $mimeType = 'image/webp';
                break;
            case 'svg':
                $mimeType = 'image/svg+xml';
                break;
            default:
                $mimeType = 'application/octet-stream';
                break;
        }

        header('Content-Type: ' . $mimeType);

        readfile($filePath);
    } else {
        header('HTTP/1.1 404 Not Found');
        echo 'File tidak ditemukan';
    }
});


$router->set404(function () {
    header('location: /');
    exit();
});

$router->run();
