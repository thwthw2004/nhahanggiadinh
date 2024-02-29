<?php
session_start();

unset($_SESSION['cart']); // Xóa sản phẩm khỏi giỏ hàng
header("Location: shop_cart.php"); // Chuyển hướng trở lại trang giỏ hàng
?>
