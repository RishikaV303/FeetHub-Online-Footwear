<?php
include_once('../../config/config.php');

if (!isset($_GET['product_id']) || empty($_GET['product_id'])) {
    die("Error: No product ID provided in the URL.");
}
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    $query = "select * from products where product_id = $product_id";
    $res = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($res);
    $productId = $row['product_id'];
    $productName = $row['product_name'];
    $productCategory = $row['category'];
    $productType = $row['Type'];
    $productPrice = $row['price'];
    $productDiscount = $row['discount'];
    $productColourCount = $row['colour_count'];
    $productStockstatus = $row['stock_status'];
    $productDescription = $row['description'];
}
// Fetch product images
$imageQuery = "SELECT * FROM product_images WHERE product_id = $product_id";
$imageResult = mysqli_query($connect, $imageQuery);

// Fetch product sizes
$sizeQuery = "SELECT * FROM product_sizes WHERE product_id = $product_id";
$sizeResult = mysqli_query($connect, $sizeQuery);
$sizes = [];
if (mysqli_num_rows($sizeResult) > 0) {
    while ($row = mysqli_fetch_assoc($sizeResult)) {
        $sizes[] = $row['size']; // adjust column name if needed
    }
}

// Fetch color variants (unique colors from images table)
$colors = [];

$colorQuery = "SELECT DISTINCT color FROM product_images WHERE product_id = $product_id AND color IS NOT NULL";
$colorResult = mysqli_query($connect, $colorQuery);

if (mysqli_num_rows($colorResult) > 0) {
    while ($colorRow = mysqli_fetch_assoc($colorResult)) {
        $colorName = $colorRow['color'];

        // Fetch main image for this color
        $mainImageQuery = "SELECT image_path FROM product_images WHERE product_id = $product_id AND color = '$colorName' AND is_main = 1 LIMIT 1";
        $mainImageResult = mysqli_query($connect, $mainImageQuery);
        $mainImageRow = mysqli_fetch_assoc($mainImageResult);
        $mainImage = $mainImageRow ? $mainImageRow['image_path'] : '';

        // Fetch gallery images for this color (non-main)
        $galleryQuery = "SELECT image_path FROM product_images WHERE product_id = $product_id AND color = '$colorName' AND is_main = 0";
        $galleryResult = mysqli_query($connect, $galleryQuery);

        $galleryImages = [];
        while ($gRow = mysqli_fetch_assoc($galleryResult)) {
            $galleryImages[] = $gRow['image_path'];
        }

        // Store in array
        $colors[] = [
            'color_name' => $colorName,
            'main_image' => $mainImage,
            'gallery_images' => $galleryImages
        ];
    }
}

?>


<div class="card">
    <div class="card-header">
        <div class="card-title">Update Product - <?= htmlspecialchars($productId); ?></div>
    </div>
    <div class="card-body">
        <!-- <form action="./process.php" method="POST" enctype="multipart/form-data"> -->
        <!-- <form action="<?php //echo $SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data"> -->
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= htmlspecialchars($product_id); ?>">
            <div class="details-grid">
                <div class="label">Product Name</div>
                <div class="value" id="nameValue">
                    <input type="text" name="product_name" class="input-field"
                        value="<?= htmlspecialchars($productName); ?>">
                </div>

                <div class="label">Description</div>
                <div class="value" id="emailValue">
                    <input type="text" name="description" class="input-field"
                        value="<?= htmlspecialchars($productDescription); ?>">
                </div>

                <div class="label">Category</div>
                <div class="value" id="phoneValue">
                    <select name="category" class="input-field">
                        <?php
                        $categories = ["Kids", "Family", "Mens", "Women", "Formal", "Seasonal"];
                        foreach ($categories as $cat) {
                            $selected = ($cat == $productCategory) ? 'selected' : '';
                            echo "<option value='$cat' $selected>$cat</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="label">Type</div>
                <div class="value" id="phoneValue">
                    <select name="product_type" class="input-field">
                        <?php
                        $categories = ["Shoes", "Slippers", "Flip-Flops", "Sandals"];
                        foreach ($categories as $cat) {
                            $selected = ($cat == $productCategory) ? 'selected' : '';
                            echo "<option value='$cat' $selected>$cat</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="label">Price</div>
                <div class="value" id="phoneValue">
                    <input type="text" name="price" class="input-field" value="<?= htmlspecialchars($productPrice); ?>">
                </div>

                <div class="label">Discount</div>
                <div class="value" id="phoneValue">
                    <input type="text" name="discount" class="input-field"
                        value="<?= htmlspecialchars($productDiscount); ?>">
                </div>

                <div class="label">Stock Status</div>
                <div class="value" id="phoneValue">
                    <select name="stock_status" class="input-field">
                        <option value="in_stock" <?= $productStockstatus == 'in_stock' ? 'selected' : '' ?>>In Stock</option>
                        <option value="out_of_stock" <?= $productStockstatus == 'out_of_stock' ? 'selected' : '' ?>>Out of
                            Stock</option>
                    </select>
                </div>

                <div class="label">Available Colors count</div>
                <div class="value" id="phoneValue">
                    <input type="text" name="colour_count" class="input-field"
                        value="<?= htmlspecialchars($productColourCount); ?>">
                </div>

                <div class="label">Color Variant</div>
                <div class="value" id="colorContainer">
                    <div class="color-block">
                        <?php 
                        $firstColor = !empty($colors) ? $colors[0] : null;
                        ?>
                        <div class="value">
                            <input type="text" name="color_names[]" placeholder="Color name (e.g. Yellow)" class="input-field" 
                                value="<?= $firstColor ? htmlspecialchars($firstColor['color_name']) : ''; ?>" required>
                        </div>

                        <?php if ($firstColor && !empty($firstColor['main_image'])): ?>
                            <div class="label">Current Main Image:</div>
                            <div class="value">
                                <img src="../../<?= htmlspecialchars($firstColor['main_image']); ?>" width="80">
                            </div>
                        <?php endif; ?>

                        <div class="label">Change Main Image:</div>
                        <div class="value">
                            <input type="file" name="color_main_image[0]" class="input-field">
                        </div>
                    </div>
                </div>


                <div class="label">Available Sizes:</div>
                <div class="value check">
                    <?php
                    if (!isset($sizes) || !is_array($sizes)) {
                        $sizes = [];
                    }
                    $allSizes = [6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37];
                    foreach ($allSizes as $size) {
                        $checked = (!empty($sizes) && in_array($size, $sizes)) ? 'checked' : '';
                        echo "<label><input type='checkbox' name='sizes[]' value='$size' $checked> $size</label> ";
                    }
                    ?>
                </div>

                <div class="label"></div>
                <button type="submit" class="create-btn btn-primary" name="update">Update</button>
            </div>

        </form>
    </div>
</div>
