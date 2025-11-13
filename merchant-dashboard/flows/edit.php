<?php
session_start();
include_once('../../config/config.php');
$product_id = $_GET['product_id'] ?? null;

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
                        <a href="../merchant-dashboard.php"><i class="bi bi-arrow-left"></i>
                            <p>Back to Dashboard</p>
                        </a>
                    </div>
                    <div class="logo">
                        <a href="../../index.php"><img src="../../assests/images/home/logo.svg" alt="logo"></a>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <?php
    if (isset($_POST['update'])) {

        $productId = ($_POST['id']);
        $productName = $_POST['product_name'];
        $productDescription = $_POST['description'];
        $productCategory = $_POST['category'];
        $productType = $_POST['product_type'];
        $productPrice = $_POST['price'];
        $productDiscount = $_POST['discount'];
        $productStockstatus = $_POST['stock_status'];
        $productColourCount = $_POST['colour_count'];

        // 1️⃣ Update main product info
        $updatequery = "UPDATE products SET 
            product_name='$productName', 
            category='$productCategory', 
            Type='$productType', 
            price='$productPrice', 
            discount='$productDiscount', 
            stock_status='$productStockstatus', 
            colour_count='$productColourCount', 
            description='$productDescription' 
            WHERE product_id=$productId";

        $updateres = mysqli_query($connect, $updatequery) or die(mysqli_error($connect));

        // 2️⃣ Update sizes
        mysqli_query($connect, "DELETE FROM product_sizes WHERE product_id=$productId") or die(mysqli_error($connect));
        if (!empty($_POST['sizes'])) {
            foreach ($_POST['sizes'] as $size) {
                $size = intval($size);
                mysqli_query($connect, "INSERT INTO product_sizes (product_id, size) VALUES ($productId, '$size')") or die(mysqli_error($connect));
            }
        }

        // 3️⃣ Update/Add color variants
        foreach ($_POST['color_names'] as $index => $colorName) {
            $colorName = mysqli_real_escape_string($connect, $colorName);

            // Handle main image
            $product_folder = "assests/images/add-product";
            $mainImage = '';
            if (isset($_FILES['color_main_image']['name'][$index]) && $_FILES['color_main_image']['error'][$index] == 0) {
                $fileName = $_FILES['color_main_image']['name'][$index];
                $tmpName = $_FILES['color_main_image']['tmp_name'][$index];
                move_uploaded_file($main_path, $fileName);
                $mainImage = $product_folder . "/" . $fileName;

                // Update if exists, else insert
                mysqli_query($connect, "UPDATE product_images SET image_path='$mainImage' WHERE product_id=$productId AND color='$colorName' AND is_main=1");
                if (mysqli_affected_rows($connect) == 0) {
                    mysqli_query($connect, "INSERT INTO product_images (product_id, color, image_path, is_main) VALUES ($productId, '$colorName', '$mainImage', 1)");
                }
            }

            // Handle gallery images
            if (!empty($_FILES['color_images']['name'][$index][0])) {
                foreach ($_FILES['color_images']['name'][$index] as $gIndex => $gFileName) {
                    if ($_FILES['color_images']['error'][$index][$gIndex] == 0) {
                        $tmpGName = $_FILES['color_images']['tmp_name'][$index][$gIndex];
                        $gFileName = time() . '_' . basename($gFileName); // avoid duplicates
                        move_uploaded_file($tmpGName, "../../uploads/$gFileName");
                        mysqli_query($connect, "INSERT INTO product_images (product_id, color, image_path, is_main) VALUES ($productId, '$colorName', 'uploads/$gFileName', 0)") or die(mysqli_error($connect));
                    }
                }
            }
        }

        // 4️⃣ Redirect with success/failure message
        if ($updateres) {
            $_SESSION['message'] = "Product updated successfully!";
            header('Location: ../merchant-dashboard.php');
            exit();
        } else {
            $_SESSION['message'] = "Product update failed!";
            header('Location: ../merchant-dashboard.php');
            exit();
        }
    }
    ?>
    <main class="content">
        <?php
        if ($product_id) {
            include '../../components/product-edit.php';
        }
        ?>
    </main>
    <?php include("../../components/footer-two.php") ?>

</body>

</html>