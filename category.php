<?php
require_once 'config/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productModel = new Product();
    $products = $productModel->getProductsByCategory($id);
}

$template = new Template();
$data = [
    'title' => 'Trang danh mục',
    'slot'  => $template->render('product-list', ['products' => $products] )
];
$template->view('layout-category', $data);