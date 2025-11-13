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
    <title>My Cart - FeetHub</title>
    <link rel="shortcut icon" href="./assests/icons/logo.ico" type="image/x-icon">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/product.css">
    <link rel="stylesheet" href="./css/cart.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>

<body>
    <header>
        <div class="wrapper">
            <?php include("./components/nav.php") ?>

        </div>
    </header>
    <div class="cart-container">
        <div class="cart-header">
            <h2>My Cart</h2>
        </div>

        <div class="cart-table">
            <div class="cart-row head">
                <p>Product</p>
                <p>Price</p>
                <p>Discount</p>
                <p>Quantity</p>
                <p>Total</p>
                <p style="width: 40px;"></p>
            </div>
            <?php
            $query = "SELECT * FROM cart WHERE user_name = '$username'";
            $res = mysqli_query($connect, $query);

            // Initialize safe defaults
            $productPrice = 0;
            $productDiscount = 0;
            $hasItems = false;

            if (mysqli_num_rows($res) > 0) {
                $hasItems = true;
                // Use distinct variable names to avoid overwriting the result row
                while ($cartRow = mysqli_fetch_assoc($res)) {
                    $cart_id = $cartRow['cart_id'];
                    $product_id = $cartRow['product_id'];
                    $merchant_id = $cartRow['merchant_id'];

                    $product_query = "SELECT * FROM products WHERE product_id = $product_id";
                    $product_res = mysqli_query($connect, $product_query);
                    $product_row = mysqli_fetch_assoc($product_res);
                    $productName = $product_row['product_name'];
                    $productPrice = $product_row['price'];
                    $productDiscount = $product_row['discount'];

                    // Fetch product image
                    $imageQuery = "SELECT image_path FROM product_images WHERE product_id = $product_id AND is_main = 1 LIMIT 1";
                    $imageResult = mysqli_query($connect, $imageQuery);
                    $img = mysqli_fetch_assoc($imageResult);
                    ?>
                    <div class="cart-row">
                        <div class="cart-product">
                            <?php if ($img) { ?>
                                <img src="./<?= htmlspecialchars($img['image_path']); ?>" alt="Product Image">
                            <?php } else { ?>
                                <img src="./assests/no-image.png" alt="No Image">
                            <?php } ?>
                            <div>
                                <h4><?= htmlspecialchars($productName); ?></h4>
                            </div>
                        </div>
                        <p class="item-price">₹<?= $productPrice; ?></p>
                        <p class="item-price"><?= $productDiscount; ?>%</p>
                        <div class="quantity">
                            <div class="qty-box">
                                <button class="minus-btn">-</button>
                                <span class="item-qty">1</span>
                                <button class="plus-btn">+</button>
                            </div>
                        </div>
                        <p class="item-total">₹<?= $productPrice; ?></p>
                        <div class="remove-btn" data-cart-id="<?= $cart_id ?>">
                            <i class="bi bi-x"></i>
                        </div>
                    </div>
                    <?php
                }
            } else { ?>
                <p class='empty-cart'>Your cart is empty</p>
                <?php
            }
            ?>


            <?php if ($hasItems) { ?>
                <div class="order-summary">
                    <div class="shipping-box payment-info">
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

                    <div class="summary-box">
                        <div class="summary-item">
                            <span class="font">Subtotal</span>
                            <span class="font" id="subtotal">₹0.00</span>
                        </div>
                        <div class="summary-item">
                            <span class="font">Delivery Fee</span>
                            <span class="font" id="deliveryFee">₹50</span>
                        </div>
                        <div class="summary-total">
                            <strong>Total</strong>
                            <strong id="grandTotal">₹0.00</strong>
                        </div>
                        <form method="POST" action="./components/order.php" id="orderForm">
                            <input type="hidden" name="user_id" value="<?= $userId; ?>">
                            <input type="hidden" name="is_cart_checkout" value="1">
                            <input type="hidden" name="product_id" value="<?= $product_id; ?>">
                            <input type="hidden" name="merchant_id" value="<?= $merchant_id; ?>">
                            <input type="hidden" name="product_name" value="<?= $productName; ?>">
                            <input type="hidden" name="quantity" id="formQuantity" value="1">
                            <input type="hidden" name="total_amount" id="formTotal" value="">
                            <input type="hidden" name="payment_method" id="formPayment" value="">

                            <button type="submit" name="direct_order" class="checkout-btn" id="Confirm">Check Out</button>
                        </form>
                        <!-- <button class="checkout-btn">Checkout</button> -->
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php include("./components/footer.php") ?>
    <script src="./js/query.js"></script>
    <script src="./js/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const deliveryFee = 50;

            // 🔹 Function to recalculate subtotal + total dynamically
            function recalcTotals() {
                let subtotal = 0;
                const rows = document.querySelectorAll(".cart-row:not(.head)");

                rows.forEach((row) => {
                    const priceEl = row.querySelector(".item-price");
                    const discountEl = row.querySelectorAll(".item-price")[1]; // second price element is discount
                    const qtyEl = row.querySelector(".item-qty");
                    const totalEl = row.querySelector(".item-total");

                    if (!priceEl || !discountEl || !qtyEl || !totalEl) return;

                    const price = parseFloat(priceEl.textContent.replace("₹", "").trim()) || 0;
                    const discount = parseFloat(discountEl.textContent.replace("%", "").trim()) || 0;
                    const qty = parseInt(qtyEl.textContent.trim()) || 1;

                    // 🔹 Calculate discounted total for this product
                    const afterDiscount = (price - (price * (discount / 100))) * qty;

                    // update individual item total visually
                    totalEl.textContent = "₹" + afterDiscount.toFixed(2);

                    subtotal += afterDiscount;
                });

                // 🔹 Update summary section
                document.getElementById("subtotal").textContent = "₹" + subtotal.toFixed(2);
                document.getElementById("deliveryFee").textContent = "₹" + deliveryFee.toFixed(2);
                const grandTotal = subtotal + deliveryFee;
                document.getElementById("grandTotal").textContent = "₹" + grandTotal.toFixed(2);

                // Also update hidden form field
                const formTotal = document.getElementById("formTotal");
                if (formTotal) formTotal.value = grandTotal.toFixed(2);
            }

            // 🔹 Handle quantity increment/decrement
            document.querySelectorAll(".plus-btn").forEach((btn) => {
                btn.addEventListener("click", function () {
                    const qtyEl = this.parentElement.querySelector(".item-qty");
                    qtyEl.textContent = parseInt(qtyEl.textContent) + 1;
                    recalcTotals();
                });
            });

            document.querySelectorAll(".minus-btn").forEach((btn) => {
                btn.addEventListener("click", function () {
                    const qtyEl = this.parentElement.querySelector(".item-qty");
                    let qty = parseInt(qtyEl.textContent);
                    if (qty > 1) {
                        qtyEl.textContent = qty - 1;
                        recalcTotals();
                    }
                });
            });

            // 🔹 Handle remove from cart
            document.querySelectorAll(".remove-btn").forEach((btn) => {
                btn.addEventListener("click", function () {
                    const cartId = this.getAttribute("data-cart-id");
                    const row = this.closest(".cart-row");
                    if (!cartId) return;

                    fetch("./components/remove_from_cart.php", {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: "cart_id=" + encodeURIComponent(cartId)
                    })
                        .then(res => res.json())
                        .then(data => {
                            if (data.success) {
                                row.remove();
                                recalcTotals();

                                if (document.querySelectorAll(".cart-row:not(.head)").length === 0) {
                                    document.querySelector(".order-summary").remove();
                                    const cartTable = document.querySelector(".cart-table");
                                    const msg = document.createElement("p");
                                    msg.className = "empty-cart";
                                    msg.textContent = "Your cart is empty";
                                    cartTable.appendChild(msg);
                                }
                            } else {
                                alert("Failed to remove item.");
                            }
                        })
                        .catch(() => alert("Something went wrong. Try again."));
                });
            });

            // 🔹 Payment method logic
            const payOnDelivery = document.getElementById("payOnDelivery");
            const upiPayment = document.getElementById("upiPayment");
            const upiField = document.getElementById("upiField");
            const upiId = document.getElementById("upiId");
            const upiError = document.getElementById("upiError");
            const formPayment = document.getElementById("formPayment");
            const orderForm = document.getElementById("orderForm");

            payOnDelivery.addEventListener("change", () => {
                upiField.style.display = "none";
                upiError.style.display = "none";
                upiId.value = "";
            });

            upiPayment.addEventListener("change", () => {
                upiField.style.display = "block";
            });

            orderForm.addEventListener("submit", (e) => {
                let selectedPayment = "";

                if (upiPayment.checked) {
                    selectedPayment = "UPI Payment";
                    const upiRegex = /^[\w.\-]+@[\w.\-]+$/;
                    if (!upiRegex.test(upiId.value.trim())) {
                        e.preventDefault();
                        upiError.style.display = "block";
                        return;
                    } else {
                        upiError.style.display = "none";
                    }
                } else if (payOnDelivery.checked) {
                    selectedPayment = "Pay on Delivery";
                } else {
                    e.preventDefault();
                    alert("Please select a payment method before placing your order!");
                    return;
                }

                formPayment.value = selectedPayment;
                recalcTotals(); // ensure formTotal is updated before submitting
            });

            // 🔹 Run initial calculation
            recalcTotals();
        });
    </script>




</body>

</html>