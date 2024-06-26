<?php

// CRUD bao gom: danh sach, them, sua, xem, xoa

// USER:
// GET    -> USER/INDEX   -> functon: INDEX -> Danh sach
// GET    -> USER/CREATE  -> functon: CEATE -> Hien thi form them moi
// POST   -> USER/STORE   -> functon: STORE -> Luu du lieu tu form them moi vao db
// GET    -> USER/ID      -> functon: SHOW($id) -> Xem chi tiet
// GET    -> USER/ID/EDIT -> functon: EDIT($id) -> Hien thi from cap nhat
// PUT    -> USER/ID      -> functon: UPDATE($id) -> Luu du lieu tu form cap nhat vao db
// DELETE -> USER/ID      -> functon: DELETE($id) -> Xoa ban ghi trong db

use Tunglam\BasicPhp2\Controllers\Admin\UserController;
use Tunglam\BasicPhp2\Controllers\Admin\ProductController;
use Tunglam\BasicPhp2\Controllers\Admin\CategoryController;
use Tunglam\BasicPhp2\Controllers\Admin\DashboardController;

// check dang nhap
$router->before('GET|POST', '/admin/*.*', function () {
    middleware_auth();
});

$router->before('GET|POST', '/admin/*.*', function () {

    if (!is_logged()) {
        header('Location: ' . url('login'));
    }
    if (!is_admin()) {
        header('Location: ' . url(''));
    }
});

$router->mount('/admin', function () use ($router) {



    $router->get('/',  DashboardController::class . '@dashboard');

    // CRUD USERS
    $router->mount('/users', function () use ($router) {
        $router->get('/',               UserController::class . '@index');
        $router->get('/create',         UserController::class . '@create');
        $router->post('/store',         UserController::class . '@store');
        $router->get('/{id}/edit',      UserController::class . '@edit');
        $router->post('/{id}/update',   UserController::class . '@update');
        $router->get('/{id}/delete',   UserController::class . '@delete');
        $router->get('/{id}/show',      UserController::class . '@show');
    });

    $router->mount('/products', function () use ($router) {

        $router->get('/',              ProductController::class  . '@index');
        $router->get('/create',        ProductController::class  . '@create'); // Show form thêm mới
        $router->post('/store',        ProductController::class  . '@store'); // Lưu mới vào DB
        $router->get('/{id}/show',     ProductController::class  . '@show');
        $router->get('/{id}/edit',     ProductController::class  . '@edit');
        $router->post('/{id}/update',  ProductController::class  . '@update');
        $router->get('/{id}/delete',   ProductController::class  . '@delete');
    });

    $router->mount('/categorys', function () use ($router) {

        $router->get('/',              CategoryController::class  . '@index');
        $router->get('/create',        CategoryController::class  . '@create'); // Show form thêm mới
        $router->post('/store',        CategoryController::class  . '@store'); // Lưu mới vào DB
        $router->get('/{id}/show',     CategoryController::class  . '@show');
        $router->get('/{id}/edit',     CategoryController::class  . '@edit');
        $router->post('/{id}/update',  CategoryController::class  . '@update');
        $router->get('/{id}/delete',   CategoryController::class  . '@delete');
    });
});
