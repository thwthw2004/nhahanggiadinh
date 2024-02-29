<?php

require_once 'config/database.php';
require_once "functions.php";

$template = new Template();
$productModel = new Product();
$categoryModel = new Category();
$categories = $categoryModel->getAllCategories();

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $cartItem) {
        // Hiển thị thông tin sản phẩm trong giỏ hàng (có thể làm bằng cơ sở dữ liệu)
        $productId = $cartItem['productId'];
        $quantity = $cartItem['quantity'];
       
    }
    if (isset($_SESSION['cart_message'])) {
        echo '<div class="alert alert-success">' . $_SESSION['cart_message'] . '</div>';

        // Sau khi hiển thị, bạn có thể xóa thông báo để không hiển thị nó nữa
        unset($_SESSION['cart_message']);
    }
} else {
    echo "Your cart is empty";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Item - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="public/css/styles.css" rel="stylesheet" />
    <!-- Bootstrap icons-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="public/css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <!-- Navigation-->
    <section id="Home" style="height: 10vh;">
    <nav>
        <div class="logo">
            <img src="public/img/logo.png" alt="" href="index.php">
        </div>

        <ul>
            <li><a href="home.php">Home</a></li>
            <?php
                    foreach ($categories as $category) :
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" href="category.php?id=<?php echo $category['id'] ?>"><?php echo $category['name'] ?></a>
                        </li>
                    <?php
                    endforeach
                    ?>
                            
        </ul>
        <form class="d-flex" role="search" action="search.php" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>

                <form class="d-flex" action="shop_cart.php">
                    <button class="btn btn-outline-dark" type="submit">
                        <i class="bi-cart-fill me-1"></i>
                        Cart
                        <!-- Hiển thị số lượng sản phẩm trong giỏ hàng -->
                        <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo getCartItemCount(); ?></span>
                    </button>
                </form>

    </nav>
    
</section>
    <!-- Product section-->
    <!-- Product section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="row gx-4 gx-lg-5 align-items-center">
                <div id="shopping-cart">
                    <h2>Shopping Cart</h2>
                    <div class="float-end">
                        <a class="btn btn-outline-dark mt-auto" href="remove-all-cart.php">Empty Cart</a>
                    </div>
                    <table class="table" cellpadding="10" cellspacing="1">
                        <tbody>
                            <tr>
                                <th style="text-align:left;">Name</th>
                                <th style="text-align:left;">Code</th>
                                <th style="text-align:right;" width="5%">Quantity</th>
                                <th style="text-align:right;" width="10%">Price<br>( in $)</th>
                                <th style="text-align:right;" width="10%">Total<br>( in $)</th>
                                <th style="text-align:center;" width="5%">Remove</th>
                            </tr>
                            <?php
                            require_once "functions.php";
                            $cartItemCount = getCartItemCount();

                            // Khởi tạo đối tượng kết nối CSDL
                            $dbProduct = new Product();

                            // Hiển thị thông tin sản phẩm từ giỏ hàng
                            if (isset($_SESSION['cart']) && is_array($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
                                foreach ($_SESSION['cart'] as $cartItem) {
                                    if (isset($cartItem['productId']) && isset($cartItem['quantity'])) {
                                        $productId = $cartItem['productId'];
                                        $quantity = $cartItem['quantity'];                
                            
                                        // Lấy thông tin sản phẩm từ CSDL
                                        $product = $dbProduct->getProductById($productId);
                            
                                        // Hiển thị thông tin sản phẩm trong HTML
                                        echo "<tr>
                                            <td>{$product['name']}</td>
                                            <td>{$product['id']}</td>
                                            <td style='text-align:right;'>{$quantity}</td>
                                            <td style='text-align:right;'>{$product['price']}</td>
                                            <td style='text-align:right;'>" . number_format($product['price'] * $quantity) . "</td>
                                            <td style='text-align:center;'><a href='remove_product.php?productId=$productId' class=''><i class='bi bi-trash'></i></a></td>
                                            </tr>";
                                    }
                                }
                            }
                            ?>

                            <!-- Phần tổng số tiền và các thông tin khác ở đây -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer-->
    <footer>
    <div class="footer_main">

        <div class="footer_tag">
            <h2>Location</h2>
            <p>Sri Lanka</p>
            <p>USA</p>
            <p>India</p>
            <p>Japan</p>
            <p>Italy</p>
        </div>

        <div class="footer_tag">
            <h2>Quick Link</h2>
            <p>Home</p>
            <p>About</p>
            <p>Menu</p>
            <p>Gallary</p>
            <p>Order</p>
        </div>

        <div class="footer_tag">
            <h2>Contact</h2>
            <p>+94 12 3456 789</p>
            <p>+94 25 5568456</p>
            <p>johndeo123@gmail.com</p>
            <p>foodshop123@gmail.com</p>
        </div>

        <div class="footer_tag">
            <h2>Our Service</h2>
            <p>Fast Delivery</p>
            <p>Easy Payments</p>
            <p>24 x 7 Service</p>
        </div>

        <div class="footer_tag">
            <h2>Follows</h2>
            <i class="fa-brands fa-facebook-f"></i>
            <i class="fa-brands fa-twitter"></i>
            <i class="fa-brands fa-instagram"></i>
            <i class="fa-brands fa-linkedin-in"></i>
        </div>

    </div>

    <p class="end">Design by<span><i class="fa-solid fa-face-grin"></i> BE1</span></p>

</footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
</body>

</html>