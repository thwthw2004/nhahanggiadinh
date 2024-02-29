
<?php
function getCartItemCount() {
    $cartItemCount = 0;

    // Kiểm tra session giỏ hàng có tồn tại không và có sản phẩm không
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cartItem) {
            // Đếm số lượng sản phẩm trong giỏ hàng
            $cartItemCount += $cartItem['quantity'];
        }
    }

    return $cartItemCount;
}
?>
