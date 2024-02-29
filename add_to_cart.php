<?php
session_start();
require_once 'config/database.php';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addToCart'])) {
    $productId = $_POST['productId'];
    $quantity = $_POST['quantity'];

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    $isExisting = false;
    foreach ($_SESSION['cart'] as $key => $cartItem) {
        if ($cartItem['productId'] == $productId) {
            // Nếu sản phẩm đã tồn tại trong giỏ hàng, cộng thêm vào số lượng
            $_SESSION['cart'][$key]['quantity'] += $quantity;
            $isExisting = true;
            break;
        }
    }

    // Nếu sản phẩm chưa có trong giỏ hàng, thêm mới vào
    if (!$isExisting) {
        $_SESSION['cart'][] = array('productId' => $productId, 'quantity' => $quantity);
    }

    // Chuyển hướng người dùng đến trang giỏ hàng sau khi thêm sản phẩm thành công
    header("Location: shop_cart.php");
    exit;
}
?>
