<?php
session_start();
include_once('../../config/config.php');

// Initialize variables
$productName = $description = $category = $productType = $price = $discount = $stockStatus = $colourCount = "";
$productNameErr = $descriptionErr = $categoryErr = $typeErr = $priceErr = $discountErr = "";

// Default color count = 1
$colourCount = 1;

if (isset($_POST['create'])) {

    $merchant_id = $_SESSION['user_id'];
    // Collect form inputs
    $productName = trim($_POST['product_name']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $productType = trim($_POST['product_type']);
    $price = trim($_POST['price']);
    $discount = trim($_POST['discount']);
    $stockStatus = $_POST['stock_status'];
    $colourCount = !empty($_POST['colour_count']) ? $_POST['colour_count'] : 1;

    // Regex patterns
    $namePatt = '/^[A-Za-z ]+$/'; // Only letters and spaces
    $descPatt = '/^[A-Za-z0-9 ,.()-]+$/'; // Letters, numbers, basic punctuation
    $numPatt = '/^[0-9]+$/';

    // Product Name Validation
    if (empty($productName)) {
        $productNameErr = "Please enter the Product Name";
    } elseif (!preg_match($namePatt, $productName)) {
        $productNameErr = "Product name should contain only letters and spaces";
    }

    // Description Validation
    if (empty($description)) {
        $descriptionErr = "Please enter Description";
    } elseif (!preg_match($descPatt, $description)) {
        $descriptionErr = "Description contains invalid characters";
    }

    // Category Validation
    if (empty($category)) {
        $categoryErr = "Please select a Category";
    }

    // Product Type Validation
    if (empty($productType)) {
        $typeErr = "Please select a Product Type";
    }

    // Price Validation
    if (empty($price)) {
        $priceErr = "Please enter Price";
    } elseif (!preg_match($numPatt, $price)) {
        $priceErr = "Price must contain only numbers";
    } elseif ($price < 1 || $price > 99999) {
        $priceErr = "Price must be between 1 and 99999";
    }

    // Discount Validation
    if (empty($discount)) {
        $discountErr = "Please enter Discount";
    } elseif (!preg_match($numPatt, $discount)) {
        $discountErr = "Discount must be a number";
    } elseif ($discount <= 0 || $discount > 100) {
        $discountErr = "Discount must be between 0 to 100";
    }

    // Check merchant exists in user_details
    $check = mysqli_query($connect, "SELECT * FROM user_details WHERE user_id='$merchant_id' AND role='merchant'");
    if (mysqli_num_rows($check) == 0) {
        die("Invalid merchant ID. Cannot insert product.");
    }

    // ✅ Universal upload folders (works globally)
    $root_path = realpath(dirname(__FILE__) . '/../../'); // Go 2 levels up from current file
    $upload_folder = $root_path . "/uploads/products";    // Physical folder on server
    $web_folder = "uploads/products";                     // Web accessible path

    if (!is_dir($upload_folder)) {
        mkdir($upload_folder, 0777, true);
    }

    $main_path = "";
    if (!empty($_FILES['main_image']['name'])) {
        $main_image = basename($_FILES['main_image']['name']);
        $extension = pathinfo($main_image, PATHINFO_EXTENSION);
        $unique_name = uniqid("prod_", true) . "." . $extension;

        // Save file
        move_uploaded_file($_FILES['main_image']['tmp_name'], $upload_folder . "/" . $unique_name);

        // Save web path in DB
        $main_path = $web_folder . "/" . $unique_name;
    }

    $created_at = date('Y-m-d H:i:s');

    if (empty($productNameErr) && empty($descriptionErr) && empty($categoryErr) && empty($typeErr) && empty($priceErr) && empty($discountErr)) {

        $query = "INSERT INTO products 
        (merchant_id, product_name, description, category, price, discount, colour_count, stock_status, created_at) 
        VALUES 
        ('$merchant_id', '$productName', '$description', '$category', '$price', '$discount', '$colourCount', '$stockStatus', '$created_at')";

        $result = mysqli_query($connect, $query);
        $product_id = mysqli_insert_id($connect);

        if ($result) {
            // Store main image path
            if (!empty($main_path)) {
                mysqli_query($connect, "INSERT INTO product_images (product_id, image_path, is_main) VALUES ('$product_id', '$main_path', 1)");
            }
            // Handle view images
            if (!empty($_FILES['view_images']['name'][0])) {
                foreach ($_FILES['view_images']['name'] as $key => $filename) {
                    if (!empty($filename)) {
                        $tmp = $_FILES['view_images']['tmp_name'][$key];
                        $extension = pathinfo($filename, PATHINFO_EXTENSION);
                        $unique_name = uniqid("view_", true) . "." . $extension;
                        $server_path = $upload_folder . "/" . $unique_name;
                        $web_path = $web_folder . "/" . $unique_name;

                        move_uploaded_file($tmp, $server_path);

                        mysqli_query($connect, "INSERT INTO product_images (product_id, image_path, is_main) VALUES ('$product_id', '$web_path', 0)");
                    }
                }
            }

            // Handle sizes
            if (!empty($_POST['sizes'])) {
                foreach ($_POST['sizes'] as $size) {
                    mysqli_query($connect, "INSERT INTO product_sizes (product_id, size) VALUES ('$product_id', '$size')");
                }
            }

            // Handle color variants
            if (!empty($_POST['color_names'])) {
                foreach ($_POST['color_names'] as $index => $color_name) {
                    $color_name = mysqli_real_escape_string($connect, $color_name);

                    if (!empty($color_name)) {
                        // ✅ Main color image
                        if (!empty($_FILES['color_main_image']['name'][$index])) {
                            $main_filename = $_FILES['color_main_image']['name'][$index];
                            $main_tmp = $_FILES['color_main_image']['tmp_name'][$index];
                            $extension = pathinfo($main_filename, PATHINFO_EXTENSION);
                            $unique_name = uniqid("color_", true) . "." . $extension;
                            $server_path = $upload_folder . "/" . $unique_name;
                            $web_path = $web_folder . "/" . $unique_name;

                            move_uploaded_file($main_tmp, $server_path);

                            mysqli_query($connect, "INSERT INTO product_images (product_id, color, image_path, is_main) VALUES ('$product_id', '$color_name', '$web_path', 1)");
                        }
                    }
                }
            }
            $_SESSION['message'] = "Product added successfully";
            header('Location: ../merchant-dashboard.php');
            exit();
        } else {
            $_SESSION['message'] = "Error: " . mysqli_error($connect);
            header('Location: ../merchant-dashboard.php');
            exit();
        }
    }
}
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
    <title>Add New Product</title>
</head>
<style>
    .error {
        color: red;
        font-size: 14px;
        margin-top: 3px;
    }

    .success {
        color: green;
        font-weight: 600;
        margin-bottom: 10px;
    }
    
</style>

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
    <main class="content">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Create New Product</div>
            </div>
            <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="details-grid">

                        <!-- Product Name -->
                        <div class="label">Product Name</div>
                        <div class="value">
                            <input type="text" name="product_name" class="input-field"
                                value="<?= htmlspecialchars($productName) ?>">
                            <div class="error"><?= $productNameErr ?></div>
                        </div>

                        <!-- Description -->
                        <div class="label">Description</div>
                        <div class="value">
                            <input type="text" name="description" class="input-field"
                                value="<?= htmlspecialchars($description) ?>">
                            <div class="error"><?= $descriptionErr ?></div>
                        </div>

                        <!-- Category -->
                        <div class="label">Category</div>
                        <div class="value">
                            <select name="category" class="input-field">
                                <option value="">Select Main Category</option>
                                <option value="Mens" <?= $category == "Mens" ? "selected" : "" ?>>Mens</option>
                                <option value="Women" <?= $category == "Women" ? "selected" : "" ?>>Womens</option>
                                <option value="Kids" <?= $category == "Kids" ? "selected" : "" ?>>Kids</option>
                                <option value="Family" <?= $category == "Family" ? "selected" : "" ?>>Family</option>
                                <option value="Formal" <?= $category == "Formal" ? "selected" : "" ?>>Formal</option>
                                <option value="Seasonal" <?= $category == "Seasonal" ? "selected" : "" ?>>Seasonal</option>
                            </select>
                            <div class="error"><?= $categoryErr ?></div>
                        </div>

                        <!-- Type -->
                        <div class="label">Type</div>
                        <div class="value">
                            <select name="product_type" class="input-field">
                                <option value="">Select Type</option>
                                <option value="Shoes" <?= $productType == "Shoes" ? "selected" : "" ?>>Shoes</option>
                                <option value="Slippers" <?= $productType == "Slippers" ? "selected" : "" ?>>Slippers
                                </option>
                                <option value="Flip-Flops" <?= $productType == "Flip-Flops" ? "selected" : "" ?>>Flip-Flops
                                </option>
                                <option value="Sandals" <?= $productType == "Sandals" ? "selected" : "" ?>>Sandals</option>
                            </select>
                            <div class="error"><?= $typeErr ?></div>
                        </div>

                        <!-- Price -->
                        <div class="label">Price</div>
                        <div class="value">
                            <input type="text" name="price" class="input-field" value="<?= htmlspecialchars($price) ?>">
                            <div class="error"><?= $priceErr ?></div>
                        </div>

                        <!-- Discount -->
                        <div class="label">Discount</div>
                        <div class="value">
                            <input type="text" name="discount" class="input-field"
                                value="<?= htmlspecialchars($discount) ?>">
                            <div class="error"><?= $discountErr ?></div>
                        </div>

                        <!-- Stock -->
                        <div class="label">Stock Status</div>
                        <div class="value">
                            <select name="stock_status" class="input-field">
                                <option value="in_stock" <?= $stockStatus == "in_stock" ? "selected" : "" ?>>In Stock
                                </option>
                                <option value="out_of_stock" <?= $stockStatus == "out_of_stock" ? "selected" : "" ?>>Out of
                                    Stock</option>
                            </select>
                        </div>

                        <!-- Colors -->
                        <div class="label">Available Colors count</div>
                        <div class="value">
                            <input type="text" name="colour_count" class="input-field"
                                value="<?= htmlspecialchars($colourCount) ?>" readonly>
                        </div>

                        <div class="label">Color Variant</div>
                        <div class="value">
                            <input type="text" name="color_names[]" placeholder="Color name (e.g. Yellow)"
                                class="input-field" required>
                            <div class="label">Main Image:</div>
                            <input type="file" name="color_main_image[0]" class="input-field" required>
                        </div>

                        <!-- Sizes -->
                        <div class="label">Available Sizes:</div>
                        <div class="value check">
                            <input type="checkbox" name="sizes[]" value="6">6
                            <input type="checkbox" name="sizes[]" value="7">7
                            <input type="checkbox" name="sizes[]" value="8">8
                            <input type="checkbox" name="sizes[]" value="9">9
                            <input type="checkbox" name="sizes[]" value="10">10
                            <input type="checkbox" name="sizes[]" value="11">11
                            <input type="checkbox" name="sizes[]" value="12">12
                            <input type="checkbox" name="sizes[]" value="13">13
                        </div>

                        <div class="label"></div>
                        <button type="submit" class="create-btn btn-primary" name="create">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <?php include("../../components/footer-two.php") ?>
</body>


</html>