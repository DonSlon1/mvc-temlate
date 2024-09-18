<?php
namespace App\Controllers;

use App\Core\Controller;

class HomeController extends Controller {
    public function index() {
        return $this->render('home', ['title' => 'Home Page']);
    }

    public function about() {
        return $this->render('about', ['title' => 'About Us']);
    }
}
