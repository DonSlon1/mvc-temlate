<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\User;

class UserController extends Controller {
    public function index() {
        $users = User::all();
        return $this->render('users/index', ['users' => $users, 'title' => 'Users List']);
    }

    public function show($id) {
        $user = User::find($id);
        if ($user) {
            return $this->render('users/show', ['user' => $user, 'title' => 'User Profile']);
        } else {
            $this->response->setStatusCode(404);
            $this->response->setContent('User not found');
            return $this->response;
        }
    }

    public function create() {
        return $this->render('users/create', ['title' => 'Create User']);
    }

    public function store() {
        $data = $this->request->request->all();
        User::create($data);
        $this->response->setContent('User created successfully!');
        return $this->response;
    }
}
