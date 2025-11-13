<?php
include_once('../../config/config.php');
if (isset($_GET['product_id'])) {
    $user_id = $_GET['product_id'];
    $query = "select * from products where product_id=$user_id";
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
$imageQuery = "SELECT * FROM product_images WHERE product_id = $user_id";
$imageResult = mysqli_query($connect, $imageQuery);

// Fetch product sizes
$sizeQuery = "SELECT * FROM product_sizes WHERE product_id = $user_id";
$sizeResult = mysqli_query($connect, $sizeQuery);

// Fetch color variants (unique colors from images table)
$colorQuery = "SELECT DISTINCT color FROM product_images WHERE product_id = $user_id AND color IS NOT NULL";
$colorResult = mysqli_query($connect, $colorQuery);

?>
<?php
// if()


?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Product ID - <?= htmlspecialchars($productId); ?></div>
    </div>
    <div class="card-body">
        <div class="details-grid">
            <div class="label">Product Name</div>
            <div class="value" id="nameValue">
                <p><?= htmlspecialchars($productName); ?></p>
            </div>
            <div class="label">Description</div>
            <div class="value" id="emailValue">
                <p><?= htmlspecialchars($productDescription); ?></p>
            </div>
            <div class="label">Category</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($productCategory); ?></p>
            </div>
            <div class="label">Type</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($productType); ?></p>
            </div>
            <div class="label">Price</div>
            <div class="value" id="phoneValue">
                <p>₹<?= htmlspecialchars($productPrice); ?></p>
            </div>
            <div class="label">Discount</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($productDiscount); ?></p>
            </div>
            <div class="label">Stock status</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($productStockstatus); ?></p>
            </div>
            <div class="label">Product Colour Count</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($productColourCount); ?></p>
            </div>

            <div class="label">Available Colors</div>
            <div class="value">
                <?php while ($color = mysqli_fetch_assoc($colorResult)) { ?>
                    <span>
                        <?= htmlspecialchars($color['color']); ?>
                    </span>
                <?php } ?>
            </div>

            <div class="label">Product Images</div>
            <div class="value images">
                <?php while ($img = mysqli_fetch_assoc($imageResult)) { ?>
                    <img src="../../<?= htmlspecialchars($img['image_path']); ?>" alt="Product Image" width="100" height="100"
                        style="border-radius:8px; margin:5px;">
                <?php } ?>
            </div>

            <div class="label">Available Sizes</div>
            <div class="value">
                <?php while ($size = mysqli_fetch_assoc($sizeResult)) { ?>
                    <span style="display:inline-block; background:#eee; padding:5px 10px; border-radius:6px; margin:3px;">
                        <?= htmlspecialchars($size['size']); ?>
                    </span>
                <?php } ?>
            </div>


        </div>

    </div>
</div>