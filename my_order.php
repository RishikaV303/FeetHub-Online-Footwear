<?php
include_once('./config/config.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
date_default_timezone_set('Asia/Kolkata');
// Prevent cache
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Check if user is logged in
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_name'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];
$username = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details -FeetHub</title>
    <link rel="shortcut icon" href="./assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/product.css">
    <link rel="stylesheet" href="./css/my_order.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <header>
        <div class="wrapper">
            <?php include("./components/nav.php") ?>

        </div>
    </header>
    <div class="container">
        <div class="order-header">
            <h2>My Orders</h2>
        </div>

        <div class="order-items">
            <?php
            $query = "SELECT * FROM orders WHERE username = '$username' ORDER BY order_date DESC";
            $res = mysqli_query($connect, $query);

            if (mysqli_num_rows($res) > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $order_id = $row['order_id'];
                    $product_id = $row['product_id'];
                    $productname = $row['product_name'];
                    $quantity = $row['quantity'];
                    $tolamt = $row['total_amount'];
                    $payment_method = $row['payment_method'];
                    $orderdate = $row['order_date']; // <<-- make sure this exists in DB and this line is before date calculations
            
                    // If order_date might be null/empty, provide a fallback:
                    if (empty($orderdate)) {
                        $orderdate = date('Y-m-d'); // fallback to today or handle differently
                    }

                    // Create DateTime objects
                    try {
                        $orderDate = new DateTime($orderdate);
                    } catch (Exception $e) {
                        // if parsing fails, fallback to today
                        $orderDate = new DateTime();
                    }

                    $placedDate = (clone $orderDate); // same day
                    $pickedDate = (clone $orderDate)->modify('+1 day');
                    $packedDate = (clone $pickedDate)->modify('+1 day');
                    $shippedDate = (clone $packedDate)->modify('+2 day');
                    $deliveredDate = (clone $shippedDate)->modify('+1 day');

                    $today = new DateTime();

                    $steps = [
                        "Order Placed" => $placedDate,
                        "Picked" => $pickedDate,
                        "Packed" => $packedDate,
                        "Order Shipped" => $shippedDate,
                        "Order Delivered" => $deliveredDate,
                    ];
                    ?>

                    <div class="order-tracking">
                        <h3>Order Tracking</h3>
                        <div class="steps">
                            <?php $i = 0; ?>
                            <?php foreach ($steps as $label => $date): ?>
                                <?php
                                // ✅ Always mark "Order Placed" as completed
                                if ($label === "Order Placed") {
                                    $completed = true;
                                } else {
                                    // Compare only by date (ignore time)
                                    $completed = ($today->format('Y-m-d') >= $date->format('Y-m-d'));
                                }

                                $iconClass = $completed ? "bi-check-circle-fill completed" : "bi-check-circle pending";
                                $formattedDate = $date->format('d M, Y');
                                ?>
                                <div class="step">
                                    <i class="bi <?= $iconClass; ?>"></i>
                                    <div>
                                        <p><?= htmlspecialchars($label); ?></p>
                                        <span><?= $formattedDate; ?></span>
                                    </div>
                                </div>
                                <?php if (++$i < count($steps)): ?>
                                    <p>------</p>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php
                    $order_id = $row['order_id'];
                    $product_id = $row['product_id'];
                    $productname = $row['product_name'];
                    $quantity = $row['quantity'];
                    $tolamt = $row['total_amount'];
                    $payment_method = $row['payment_method'];
                    $orderdate = $row['order_date'];

                    // Fetch product image
                    $imageQuery = "SELECT image_path FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
                    $imageResult = mysqli_query($connect, $imageQuery);
                    $img = mysqli_fetch_assoc($imageResult);

                    // Fetch color variants (unique colors)
                    $colorQuery = "SELECT DISTINCT color FROM product_images WHERE product_id = $product_id AND color IS NOT NULL";
                    $colorResult = mysqli_query($connect, $colorQuery);
                    ?>

                    <div class="item">
                        <?php if ($img) { ?>
                            <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="Product Image">
                        <?php } else { ?>
                            <img src="./assests/no-image.png" alt="No Image">
                        <?php } ?>

                        <div class="details">
                            <h4><?= htmlspecialchars($productname); ?></h4>
                            <p><strong>Color:</strong>
                                <?php
                                if (mysqli_num_rows($colorResult) > 0) {
                                    while ($color = mysqli_fetch_assoc($colorResult)) {
                                        echo '<span>' . htmlspecialchars($color['color']) . '</span> ';
                                    }
                                } else {
                                    echo '<span>—</span>';
                                }
                                ?>
                            </p>
                            <p><strong>Quantity:</strong> <?= $quantity; ?></p>
                            <p><strong>Payment:</strong> <?= htmlspecialchars($payment_method); ?></p>
                            <p><strong>Date:</strong> <?= htmlspecialchars($orderdate); ?></p>
                        </div>
                        <div class="price">
                            <strong>₹<?= $tolamt; ?></strong>
                        </div>
                    </div>

                    <?php
                }
            } else {
                echo "<p>No orders found for this user.</p>";
            }
            ?>
        </div>

    </div>
    <?php include("./components/footer.php") ?>
</body>

</html>