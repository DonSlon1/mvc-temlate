<?php
namespace App\Core;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View {
    protected $twig;

    public function __construct() {
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);
    }

    public function render($template, $data = []) {
        return $this->twig->render($template . '.twig', $data);
    }
}
