<?php

namespace App\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Models\DBModel;

class ViewController
{
    private $twigEngine;
    private $twigLoader;
    private $dbModel;

    public function __construct()
    {
        $this->twigLoader = new FilesystemLoader(dirname(__DIR__, 1) . '/Views');
        $this->twigEngine = new Environment($this->twigLoader);
        $this->dbModel = new DBModel();
    }

    private function withAuthToken(array $data): array
    {
        $data['authtoken'] = $_SESSION['authtoken'] ?? null;
        return $data;
    }

    public function render($view, $data = [])
    {
        echo $this->twigEngine->render($view, $this->withAuthToken($data));
    }

    public function home()
    {
        $articles = $this->dbModel->findAll('articles');
        $this->render('home.twig', [
            'title' => 'DISDUKCAPIL TAPIN',
            'articles' => $articles
        ]);
    }
    public function pages($permalink)
    {
        $pages = $this->dbModel->findPage($permalink);
        $title = strtoupper($pages['title']) . ' - DISDUKCAPIL TAPIN';
        $this->render('page.twig', [
            'title' => $title,
            'pages' => $pages
        ]);
    }
}
