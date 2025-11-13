<?php
include_once('../config/config.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
    echo "<script>alert('Please login first!'); window.location.href='../login.php';</script>";
    exit;
}

if (isset($_POST['direct_order'])) {
    $payment_method = mysqli_real_escape_string($connect, $_POST['payment_method']);
    $total_amount = floatval($_POST['total_amount']);
    $is_cart_checkout = isset($_POST['is_cart_checkout']) ? intval($_POST['is_cart_checkout']) : 0;

    // ✅ Fetch username
    $userQuery = "SELECT user_name FROM user_details WHERE user_id = $user_id";
    $userRes = mysqli_query($connect, $userQuery);
    if (!$userRes || mysqli_num_rows($userRes) == 0) {
        echo "<script>alert('User not found!');</script>";
        exit;
    }
    $userRow = mysqli_fetch_assoc($userRes);
    $username = $userRow['user_name'];

    if ($is_cart_checkout === 1) {
        // ===============================
        // 🛒 Checkout All Cart Items
        // ===============================
        $cartQuery = "SELECT * FROM cart WHERE user_name = '$username'";
        $cartRes = mysqli_query($connect, $cartQuery);

        if ($cartRes && mysqli_num_rows($cartRes) > 0) {
            while ($cartItem = mysqli_fetch_assoc($cartRes)) {
                $product_id = $cartItem['product_id'];
                $merchant_id = $cartItem['merchant_id'];
                $quantity = 1; // You can change if you store qty in cart

                // Fetch product info
                $productQuery = "SELECT product_name, price, discount FROM products WHERE product_id = $product_id";
                $productRes = mysqli_query($connect, $productQuery);
                $product = mysqli_fetch_assoc($productRes);

                $product_name = mysqli_real_escape_string($connect, $product['product_name']);
                $price = $product['price'];
                $discount = $product['discount'];
                $afterDiscount = $price - ($price * ($discount / 100));
                $total = $afterDiscount * $quantity;

                // Insert into orders table
                $insertOrder = "INSERT INTO orders (username, product_id, merchant_id, product_name, quantity, total_amount, payment_method)
                                VALUES ('$username', '$product_id', '$merchant_id', '$product_name', '$quantity', '$total', '$payment_method')";
                mysqli_query($connect, $insertOrder);
            }

            // ✅ Delete all cart items for this user
            $deleteCart = "DELETE FROM cart WHERE user_name = '$username'";
            mysqli_query($connect, $deleteCart);

            echo "<script>alert('Order placed successfully!'); window.location.href='../my_order.php';</script>";
        } else {
            echo "<script>alert('Your cart is empty!'); window.location.href='../my_cart.php';</script>";
        }

    } else {
        // ===============================
        // 🛍 Direct Buy (single product)
        // ===============================
        $product_id = intval($_POST['product_id']);
        $merchant_id = intval($_POST['merchant_id']);
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

        // Get product info
        $productQuery = "SELECT product_name, price, discount FROM products WHERE product_id = $product_id";
        $productRes = mysqli_query($connect, $productQuery);
        if ($productRes && mysqli_num_rows($productRes) > 0) {
            $product = mysqli_fetch_assoc($productRes);
            $product_name = mysqli_real_escape_string($connect, $product['product_name']);
            $price = $product['price'];
            $discount = $product['discount'];
            $afterDiscount = $price - ($price * ($discount / 100));
            $total = $afterDiscount * $quantity;

            $insertQuery = "INSERT INTO orders (username, product_id, merchant_id, product_name, quantity, total_amount, payment_method)
                            VALUES ('$username', '$product_id', '$merchant_id', '$product_name', '$quantity', '$total', '$payment_method')";
            mysqli_query($connect, $insertQuery);

            echo "<script>alert('Order placed successfully!'); window.location.href='../my_order.php';</script>";
        } else {
            echo "<script>alert('Product not found!');</script>";
        }
    }
}
?>