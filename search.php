<?php
require_once 'config/database.php';
$template = new Template();
if (isset($_GET['q'])) {
    $keyword = $_GET['q'];
    $productModel = new Product();
    $products = $productModel->search($keyword);
}

$data = [
    'title' => $keyword,
    'slot'  => $template->render('product-list', ['products' => $products] )
];
$template->view('layout-category', $data);