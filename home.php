<?php
require_once 'config/database.php';

$template = new Template();
$productModel = new Product();
$products = $productModel->getAllProducts();

$recentProducts=[];
if(isset($_COOKIE['recentView'])) {
    $recentProducts = $productModel->getProductsByIds(json_decode($_COOKIE['recentView']));
}
$data = [
    'title' => 'Trang home',
    'slot'  => $template->render('product-list', ['products' => $products] ) .
                $template->render('product-recent', ['recentProducts' => $recentProducts]) 
];
$template->view('layout', $data);