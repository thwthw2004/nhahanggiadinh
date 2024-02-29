<?php

require_once 'config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productModel = new Product();
    $product = $productModel->getProductById($id);


    // Tạo mảng recentView lưu vào cookie
    $recentView = [];
    if (isset($_COOKIE['recentView'])) {
        $recentView = json_decode($_COOKIE['recentView']);
        if (!in_array($id, $recentView)) {
            if (count($recentView) == 5) {
                array_shift($recentView);
            }
            array_push($recentView, $id);
        }
    }
    else {
        array_push($recentView, $id);
    }
    setcookie('recentView', json_encode($recentView), time() + 3600*24);
}

$template = new Template();

$data = [
    'title' => $product['name'],
    'slot'  => $template->render('product-detail', ['product' => $product] )
];
$template->view('layout-category', $data);