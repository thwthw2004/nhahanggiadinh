<?php
session_start();

if(isset($_GET['productId'])) {
    $productIdToRemove = $_GET['productId'];

    // Tìm sản phẩm cần xóa trong giỏ hàng và loại bỏ nó
    foreach ($_SESSION['cart'] as $key => $cartItem) {
        if ($cartItem['productId'] == $productIdToRemove) {
            unset($_SESSION['cart'][$key]); // Xóa sản phẩm khỏi giỏ hàng
            $_SESSION['cart_message'] = "Product removed successfully"; // Thông báo xóa thành công
            break;
        }
    }
}

header("Location: shop_cart.php"); // Chuyển hướng trở lại trang giỏ hàng
?>
