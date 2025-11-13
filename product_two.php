<?php
session_start();
include_once('./config/config.php');
$isLoggedIn = isset($_SESSION['user_id']); // true if user logged in
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FeetHub-product-redirect</title>
    <link rel="shortcut icon" href="./assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/product.css">
    <link rel="stylesheet" href="./css/productTwo.css">
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
    <main>
        <?php
        if (isset($_GET['product_id'])) {
            $product_id = $_GET['product_id'];
            $query = "select * from products where product_id=$product_id";
            $res = mysqli_query($connect, $query);
            $row = mysqli_fetch_array($res);
            $productId = $row['product_id'];
            $merchantId = $row['merchant_id'];
            $productName = $row['product_name'];
            $productCategory = $row['category'];
            $productType = $row['Type'];
            $productPrice = $row['price'];
            $productDiscount = $row['discount'];
            $productColourCount = $row['colour_count'];
            $productStockstatus = $row['stock_status'];
            $productDescription = $row['description'];

            // Fetch product images
            $imageQuery = "SELECT * FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
            $imageResult = mysqli_query($connect, $imageQuery);

            // Fetch product sizes
            $sizeQuery = "SELECT * FROM product_sizes WHERE product_id = $product_id";
            $sizeResult = mysqli_query($connect, $sizeQuery);

            // Fetch color variants (unique colors from images table)
            $colorQuery = "SELECT DISTINCT color FROM product_images WHERE product_id = $product_id AND color IS NOT NULL";
            $colorResult = mysqli_query($connect, $colorQuery);

            ?>
            <section id="details">
                <div class="wrapper">
                    <div class="left">
                        <div class="image">
                            <?php
                            $img = mysqli_fetch_assoc($imageResult); // Fetch only one row
                            if ($img) {
                                ?>
                                <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="images!">
                                <?php
                            }
                            ?>
                        </div>


                    </div>
                    <div class="right">
                        <div class="product-right">
                            <div class="header">
                                <div>
                                    <h2><?= $productName; ?></h2>
                                    <p><?= $productCategory; ?>     <?= $productType; ?></p>
                                </div>
                            </div>

                            <div class="desc">
                                <h3>Product Description:</h3>
                                <p>
                                    <?= $productDescription; ?>
                                </p>
                            </div>

                            <div class="rating">
                                <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                    class="bi bi-star-half"></i><span>(4.5/5)</span>
                            </div>

                            <div class="size-section">
                                <p>Select Size</p>
                                <div class="sizes">
                                    <?php
                                    if ($sizeResult && mysqli_num_rows($sizeResult) > 0) {
                                        while ($sizeRow = mysqli_fetch_assoc($sizeResult)) {
                                            $sizeValue = htmlspecialchars($sizeRow['size']); // assuming your column name is 'size'
                                            ?>
                                            <label>
                                                <input type="radio" name="size" value="<?= $sizeValue ?>">
                                                <span><?= $sizeValue ?></span>
                                            </label>
                                            <?php
                                        }
                                    } else {
                                        echo "<p style='color:gray;'>No sizes available</p>";
                                    }
                                    ?>


                                </div>
                            </div>

                            <div class="price">
                                <h2>₹<?= $productPrice; ?></h2>
                            </div>
                            <div class="btn-adjust">
                                <form method="POST" action="./components/cart.php" id="cartForm">
                                    <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                                    <input type="hidden" name="product_id" value="<?= $productId; ?>">
                                    <input type="hidden" name="merchant_id" value="<?= $merchantId; ?>">
                                    <input type="hidden" name="product_name" value="<?= $productName; ?>">
                                    <input type="hidden" name="product_price" value="<?= $productPrice; ?>">

                                    <button type="submit" data-product-id="<?= $product_id ?>"
                                        data-loggedin="<?= $isLoggedIn ? '1' : '0' ?>" data-login-url="login.php"
                                        name="cart" class="button-primary cart"><i class="bi bi-bag"></i> Add
                                        to cart
                                    </button>
                                </form>
                                <button class="button-primary buynow" id="open" data-product-id="<?= $product_id ?>"
                                    data-loggedin="<?= $isLoggedIn ? '1' : '0' ?>" data-login-url="login.php">
                                    Buy Now
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php
        }
        ?>

            </div>
        </section>
        <section id="Mens">
            <div class="wrapper">
                <h1>You Might Also Like</h1>
                <div class="cards">
                    <a href="#">
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/product-two//optionOne.png" alt="images!">

                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2> Air Jordan 1 Mid</h2>
                                    <h4>Men’s Shoes</h4>
                                    <h4>1 Colour</h4>

                                </div>
                                <div class="price">
                                    <h2>₹1,199</h2>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/product-two/optionTwo.png" alt="images!">

                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2>Woven flat slide sandal</h2>
                                    <h4>Women’s Slippers</h4>
                                    <h4>1 Colour</h4>

                                </div>
                                <div class="price">
                                    <h2>₹599</h2>

                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="#">
                        <div class="product">
                            <div class="image">
                                <img src="./assests/images/product-two/optionThree.png" alt="images!">

                            </div>
                            <div class="content">
                                <div class="details">
                                    <h2>Flat slide</h2>
                                    <h4>Women’s Slippers</h4>
                                    <h4>3 Colours</h4>

                                </div>
                                <div class="price">
                                    <h2>₹399</h2>

                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </section>
        <!-- modal -->
        <section id="modal">
            <div class="wrapper">
                <div class="checkout-card">
                    <?php
                    if (isset($_GET['product_id'])) {
                        $product_id = $_GET['product_id'];
                        $query = "select * from products where product_id=$product_id";
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

                        // Fetch product images
                        $imageQuery = "SELECT * FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
                        $imageResult = mysqli_query($connect, $imageQuery);

                        // Fetch color variants (unique colors from images table)
                        $colorQuery = "SELECT DISTINCT color FROM product_images WHERE product_id = $product_id AND color IS NOT NULL";
                        $colorResult = mysqli_query($connect, $colorQuery);

                        ?>
                        <span class="close-btn" id="close">✕</span>

                        <div class="checkout-main">
                            <div class="product-image">
                                <!-- <img src="./assests/images/product-two/colorGreen.png" alt="UrbanStride Sneakers"> -->
                                <?php
                                $img = mysqli_fetch_assoc($imageResult); // Fetch only one row
                                if ($img) {
                                    ?>
                                    <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="images!">
                                    <?php
                                }
                                ?>
                            </div>

                            <div class="product-details">
                                <h2><?= $productName; ?></h2>

                                <h3>Product Description:</h3>
                                <p>
                                    <?= $productDescription; ?>
                                </p>

                                <p><strong>Size:</strong> <span id="selectedSize">—</span></p>
                                <p><strong>Color:</strong>
                                    <?php while ($color = mysqli_fetch_assoc($colorResult)) { ?>
                                        <span>
                                            <?= htmlspecialchars($color['color']); ?>
                                        </span>
                                    <?php } ?>
                                </p>

                                <div class="price-and-qty">
                                    <h2>₹<?= $productPrice; ?></h2>
                                    <div class="quantity">
                                        <label>Quantity</label>
                                        <div class="qty-box">
                                            <button id="minus">-</button>
                                            <span id="quantity">1</span>
                                            <button id="plus">+</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="order-summary">
                            <h3>Order Summary</h3>
                            <div class="summary-item">
                                <span class="font">Subtotal</span>
                                <span class="font" id="price">₹<?= $productPrice; ?></span>
                            </div>
                            <div class="summary-item">
                                <span class="font">Discount</span>
                                <span class="font" id="discount"><?= $productDiscount; ?>%</span>
                            </div>
                            <div class="summary-item">
                                <span class="font">Delivery Fee</span>
                                <span class="font" id="delivery">₹50</span>
                            </div>
                            <hr>
                            <div class="summary-total">
                                <strong>Total</strong>
                                <strong id="total">₹1,050</strong>
                            </div>
                            <div class="payment-info">
                                <h3>Payment Method</h3>
                                <div class="payment-section">
                                    <label>
                                        <input type="radio" name="payment" value="Pay on Delivery" id="payOnDelivery">
                                        Pay on Delivery
                                    </label>

                                    <label>
                                        <input type="radio" name="payment" value="UPI Payment" id="upiPayment">
                                        UPI Payment
                                    </label>

                                    <!-- UPI input (hidden initially) -->
                                    <div id="upiField" style="display:none; margin-top:10px;">
                                        <label for="upiId">Enter your UPI ID:</label>
                                        <input type="text" id="upiId" placeholder="example@upi"
                                            style="width:100%; padding:8px; border:1px solid #ccc; border-radius:6px;">
                                        <small id="upiError" style="color:red; display:none;">⚠ Please enter a valid UPI ID
                                            (e.g., name@bank)</small>
                                    </div>
                                </div>
                            </div>

                            <hr>
                            <form method="POST" action="./components/order.php" id="orderForm">
                                <input type="hidden" name="user_id" value="<?= $user_id; ?>">
                                <input type="hidden" name="product_id" value="<?= $productId; ?>">
                                <input type="hidden" name="merchant_id" value="<?= $merchantId; ?>">
                                <input type="hidden" name="product_name" value="<?= $productName; ?>">
                                <input type="hidden" name="quantity" id="formQuantity" value="1">
                                <input type="hidden" name="total_amount" id="formTotal" value="">
                                <input type="hidden" name="payment_method" id="formPayment" value="">

                                <button type="submit" name="direct_order" class="button-primary" id="Confirm">Check Out</button>
                            </form>
                        </div>
                        <?php

                    } else {
                        echo "<p style='color:gray;'>No sizes available</p>";
                    }
                    ?>
                </div>



            </div>
        </section>
    </main>


    <?php include("./components/footer.php") ?>
    <button id="floatBtn" class="floating-btn"><i class="bi bi-chevron-up"></i></button>
    <script>
        AOS.init();
    </script>
    <script src="./js/query.js"></script>
    <script src="./js/script.js"></script>
    <script>
        let deliveryFee = 50;  // Delivery fee
        let quantity = 1;      // Default quantity

        // Get elements
        const priceElement = document.querySelector("#price");
        const discountElement = document.querySelector("#discount");
        const qtyElement = document.querySelector("#quantity");
        const totalElement = document.querySelector("#total");

        // Function to update values
        function updateValues() {
            // Extract numbers
            let price = parseFloat(priceElement.textContent.replace("₹", "").trim());
            let discount = parseFloat(discountElement.textContent.replace("%", "").trim());

            // Calculate totals
            let subtotal = price * quantity;
            let discountAmt = (discount / 100) * subtotal;
            let total = (subtotal - discountAmt) + deliveryFee;

            // Round to nearest rupee
            total = Math.round(total);

            // Update UI
            if (qtyElement) qtyElement.textContent = quantity;
            totalElement.textContent = "₹" + total;
        }

        // Increase quantity
        document.querySelector("#plus").addEventListener("click", function () {
            quantity++;
            updateValues();
        });

        // Decrease quantity
        document.querySelector("#minus").addEventListener("click", function () {
            if (quantity > 1) {
                quantity--;
                updateValues();
            }
        });

        // Initialize
        updateValues();
        const formQuantity = document.querySelector("#formQuantity");
        const formTotal = document.querySelector("#formTotal");
        const formPayment = document.querySelector("#formPayment");
        const paymentRadios = document.querySelectorAll("input[name='payment']");

        function updateFormValues() {
            formQuantity.value = quantity;
            formTotal.value = totalElement.textContent.replace("₹", "").trim();
        }

        // Update form whenever total or quantity changes
        document.querySelector("#plus").addEventListener("click", updateFormValues);
        document.querySelector("#minus").addEventListener("click", updateFormValues);

        // When payment method selected
        paymentRadios.forEach((radio) => {
            radio.addEventListener("change", () => {
                formPayment.value = radio.parentElement.textContent.trim();
            });
        });

        // On submit
        document.querySelector("#orderForm").addEventListener("submit", function (e) {
            if (formPayment.value === "") {
                e.preventDefault();
                alert("Please select a payment method before checkout!");
            } else {
                updateFormValues();
            }
        });
        // Payment method elements
        document.addEventListener("DOMContentLoaded", function () {
            const payOnDelivery = document.getElementById("payOnDelivery");
            const upiPayment = document.getElementById("upiPayment");
            const upiField = document.getElementById("upiField");
            const upiId = document.getElementById("upiId");
            const upiError = document.getElementById("upiError");
            const orderForm = document.getElementById("orderForm");
            const formPayment = document.getElementById("formPayment");

            // Toggle visibility of UPI input
            payOnDelivery.addEventListener("change", () => {
                upiField.style.display = "none";
                upiError.style.display = "none";
                upiId.value = "";
            });

            upiPayment.addEventListener("change", () => {
                upiField.style.display = "block";
            });

            // Form validation before submitting
            orderForm.addEventListener("submit", function (e) {
                let selectedPayment = "";

                if (upiPayment.checked) {
                    selectedPayment = "UPI Payment";
                    const upiRegex = /^[\w.\-]+@[\w.\-]+$/;
                    if (upiId.value.trim() === "" || !upiRegex.test(upiId.value.trim())) {
                        e.preventDefault();
                        upiError.style.display = "block";
                        upiId.focus();
                        return;
                    } else {
                        upiError.style.display = "none";
                    }
                } else if (payOnDelivery.checked) {
                    selectedPayment = "Pay on Delivery";
                } else {
                    e.preventDefault();
                    alert("Please select a payment method before placing the order.");
                    return;
                }

                formPayment.value = selectedPayment;
            });
        });
        document.querySelectorAll('.cart').forEach(button => {
            button.addEventListener('click', function (e) {
                const selectedSize = document.querySelector("input[name='size']:checked");

                // Step 1: Check if size is selected
                if (!selectedSize) {
                    e.preventDefault();
                    alert("Please select a size before adding to cart!");
                    return false; // Stop here
                }

                // Step 2: Toggle Add/Added only if size is selected
                if (this.classList.contains('added')) {
                    // Remove from cart
                    this.classList.remove('added');
                    this.innerHTML = '<i class="bi bi-bag"></i> Add to cart';
                } else {
                    // Add to cart
                    this.classList.add('added');
                    this.innerHTML = '<i class="bi bi-check-circle"></i> Added';
                }
            });
        });

        // Validate size before Buy Now
        document.querySelectorAll(".buynow").forEach(button => {
            button.addEventListener("click", function (e) {
                const selectedSize = document.querySelector("input[name='size']:checked");
                if (!selectedSize) {
                    e.preventDefault();
                    alert("⚠ Please select a size before buying!");
                    return false;
                }
            });
        });

    </script>
</body>

</html>