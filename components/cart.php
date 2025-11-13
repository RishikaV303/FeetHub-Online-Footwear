<?php
include_once('../config/config.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// ✅ Correct way to get user_id from session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if (!$user_id) {
    // If user is not logged in, redirect or show error
    echo "<script>alert('Please login first!'); window.location.href='../login.php';</script>";
    exit;
}

if (isset($_POST['cart'])) {
    $product_id = $_POST['product_id'];
    $merchant_id = $_POST['merchant_id'];
    $product_name = mysqli_real_escape_string($connect, $_POST['product_name']);
    $product_price = $_POST['product_price'];
    

    // ✅ Get user details
    $queryuser = "SELECT * FROM user_details WHERE user_id = $user_id";
    $res = mysqli_query($connect, $queryuser);

    if ($res && mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        $username = $row['user_name'];
    } else {
        echo "<script>alert('User not found!');</script>";
        exit;
    }

    // ✅ Insert into orders table (with username)
    $query = "INSERT INTO cart (user_name, product_id, merchant_id)
              VALUES ('$username', '$product_id', '$merchant_id')";

    if (mysqli_query($connect, $query)) {
        echo "<script>window.location.href='../products.php';</script>";
    } else {
        echo "<script>alert('Error placing order: " . mysqli_error($connect) . "');</script>";
    }
}
?>
