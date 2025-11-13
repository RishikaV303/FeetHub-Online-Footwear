<?php
session_start();
include_once('../../config/config.php');


$user_id = $_GET['user_id'] ?? null;
$product_id = $_GET['product_id'] ?? null;
$sub_id = $_GET['sub_id'] ?? null;
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
    <title>Edit page</title>
</head>

<body>


    <header>
        <div class="wrapper">
            <nav class="nav">
                <div class="wrap">
                    <div class="back">
                        <?php if ($sub_id) {
                            ?>
                            <a href="../admin-dashboard.php#sub-admins"><i class="bi bi-arrow-left"></i>
                                <p>Back to Dashboard</p>
                            </a>
                            <?php
                        } elseif ($product_id) {
                            ?>
                            <a href="../admin-dashboard.php#products"><i class="bi bi-arrow-left"></i>
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

    <?php


    // Initialize variables
    $nameErr = $passwordErr = $mailErr = $mobileErr = "";
    $name = $managerId = $password = $mobile_number = $mail = $status = "";
    $successMsg = "";
    // Form validation
    if (isset($_POST['update_manager'])) {
        $userid = $_POST['id'];
        $managerName = $_POST['name'];
        $managerId = $_POST['manager-id'];
        $password = $_POST['password'];
        $managerPhone = $_POST['mobile_number'];
        $managerMail = $_POST['mail'];

        // patterns
        $namePatt = '/^[A-Za-z]{3,}$/';
        $numPatt = '/^[6-9][0-9]{9}$/';
        $emailpatt = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
        $passPatt = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

        // Name validation
        if (empty($managerName)) {
            $nameErr = "Please enter the User Name";
        } elseif (strlen($managerName) < 3) {
            $nameErr = "First name must be at least 3 characters long";
        } elseif (strlen($managerName) > 30) {
            $nameErr = "First name Less than 30 character only allowed";
        } else {
            if (!preg_match($namePatt, $managerName)) {
                $nameErr = "Please enter a valid User Name";
            }
        }
        // password validation
        if (empty($password)) {
            $passwordErr = "Please enter the Password";
        } elseif (strlen($password) < 8) {
            $passwordErr = "Password must be at least 8 characters long";
        } elseif (strlen($password) > 20) {
            $passwordErr = "Password Less than 20 character only allowed";
        } else {
            if (!preg_match($passPatt, $password)) {
                $passwordErr = "Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character";
            }
        }
        // email validation
        if (empty($managerMail)) {
            $mailErr = "Please enter the Email id";
        } elseif (strlen($managerMail) > 50) {
            $mailErr = "Email id Less than 50 character only allowed";
        } else {
            if (!preg_match($emailpatt, $managerMail)) {
                $mailErr = "Please enter a valid Email id";
            }
        }
        // mobile number validation
        if (empty($managerPhone)) {
            $mobileErr = "Please enter the Mobile number";
        } else {
            if (!preg_match($numPatt, $managerPhone)) {
                $mobileErr = "Please enter a valid Mobile number";
            }
        }

        $checkQuery = "SELECT * FROM sub_admins 
               WHERE (name='$managerName' OR phone='$managerPhone' OR email_id='$managerMail') 
               AND id != '$userid'";
        $checkResult = mysqli_query($connect, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            // If record exists, find which one matches
            $existing = mysqli_fetch_assoc($checkResult);
            if ($existing['name'] === $managerName) {
                $nameErr = "This name is already created. Please use another name.";
            }
            if ($existing['phone'] === $managerPhone) {
                $mobileErr = "This phone number is already created. Please use another number.";
            }
            if ($existing['email_id'] === $managerMail) {
                $mailErr = "This mail id is already created. Please use another mail.";
            }
        } else {
            if (empty($nameErr) && empty($passwordErr) && empty($mobileErr) && empty($mailErr)) {
                // query execution
                $query = "update sub_admins set name='$managerName', manager_id='$managerId', password='$password', phone='$managerPhone', email_id='$managerMail' where id='$userid'";
                // echo $query;
                $res = mysqli_query($connect, $query);
                if ($res) {
                    $_SESSION['message'] = "update successfully";
                    header('Location: ../admin-dashboard.php#sub-admins');
                    exit();
                } else {
                    $_SESSION['message'] = "not update";
                    header('Location: ../admin-dashboard.php#sub-admins');
                    exit();
                }
            }
        }
    }



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
            header('Location: ../admin-dashboard.php#products');
            exit();
        } else {
            $_SESSION['message'] = "Product update failed!";
            header('Location: ../admin-dashboard.php#products');
            exit();
        }
    }
    ?>

    <main class="content">
        <?php if ($sub_id) {
            include '../../components/sub-admin-edit.php';
        } elseif ($product_id) {
            include '../../components/product-edit.php';
        }
        ?>

    </main>
    <?php include("../../components/footer-two.php") ?>

</body>

</html>