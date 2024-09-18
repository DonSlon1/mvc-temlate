<?php
    $r->addRoute('GET', '/', 'HomeController@index');
    $r->addRoute('GET', '/about', 'HomeController@about');
    $r->addRoute('GET', '/users', 'UserController@index');
    $r->addRoute('GET', '/users/{id:\d+}', 'UserController@show');
    $r->addRoute('GET', '/users/create', 'UserController@create');
    $r->addRoute('POST', '/users', 'UserController@store');
