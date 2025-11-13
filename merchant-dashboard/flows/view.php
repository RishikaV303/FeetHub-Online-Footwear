<?php
session_start();
include_once('../../config/config.php');

$product_id = $_GET['product_id'] ?? null;
$order_id = $_GET['order_id'] ?? null;
$recentorder_id = $_GET['recentorder_id'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/register.css">
    <link rel="stylesheet" href="../../css/admin-dashboard.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/form.css">
    <link rel="stylesheet" href="../../css/view.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Product</title>
</head>

<body>
    <header>
        <div class="wrapper">
            <nav class="nav">
                <div class="wrap">
                    <div class="back">
                        <?php
                        if ($product_id) {
                            ?>
                            <a href="../merchant-dashboard.php"><i class="bi bi-arrow-left"></i>
                                <p>Back to Dashboard</p>
                            </a>
                            <?php
                        } elseif ($order_id) {
                            ?>
                            <a href="../merchant-dashboard.php"><i class="bi bi-arrow-left"></i>
                                <p>Back to Dashboard</p>
                            </a>
                            <?php
                        } elseif ($recentorder_id) {
                            ?>
                            <a href="../merchant-dashboard.php"><i class="bi bi-arrow-left"></i>
                                <p>Back to Dashboard</p>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="logo">
                        <a href="../../index.php"><img src="../../assests/images/home/logo.svg" alt="logo"></a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <main class="content">
        <?php
        if ($product_id) {
            include '../../components/product-view.php';

        } elseif ($order_id) {
            include '../../components/order-view.php';
        } elseif ($recentorder_id) {
            include '../../components/order-view.php';
        }
        ?>

    </main>

</body>

</html>