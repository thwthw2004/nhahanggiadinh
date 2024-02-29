<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <style>
        .container {
    font-family: Arial, sans-serif;
    background-color: #f6ffa8;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 80vh;
}

form {
    background-color: #ffffff;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 100px rgba(0, 0, 0, 0.2);
}

h1 {
    text-align: center;

}

div {
    margin-bottom: 15px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
input[type="password"] {
    width: 100%;
    padding: 8px;
    border-radius: 3px;
    border: 1px solid #ccc;
}

input[type="submit"] {
    width: 100%;
    padding: 10px;
    border: none;
    border-radius: 3px;
    background-color: #deee00;
    color: #fff;
    cursor: pointer;
    font-size: 21px;
    transition: background-color 0.3s;
}

input[type="submit"]:hover {
    background-color: #a3a113;
}

.error {
    color: red;
    margin-top: 10px;
    text-align: center;
}
    </style>
</head>

<body>
    <h1>Login</h1>
    <div class="container">
        <form action="index.php" method="POST">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <input type="submit" value="Login">
        </form>
        <?php
        // Kiểm tra nếu form đã được gửi đi (dữ liệu POST tồn tại)
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            require_once 'config/database.php';

            // Lấy dữ liệu từ form
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Tạo đối tượng
            $user = new User();

            // Gọi hàm kiểm tra đăng nhập từ class User
            // Sau khi gọi hàm checkLogin và nhận thông tin người dùng, xác định quyền và chuyển hướng
            $userInfo = $user->checkLogin($username, $password);

            if ($userInfo) {
                if ($userInfo['permission'] === 'Admin') {
                    header("Location:  admin/products/index.php");
                    exit();
                } else {
                    header("Location:  home.php");
                    exit();
                }
            } else {
                echo "Đăng nhập thất bại! Vui lòng kiểm tra lại tên người dùng và mật khẩu.";
            }
        }
        ?>
    </div>
</body>

</html>