<?php
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];
    $query = "select * from orders where order_id=$order_id";
    $res = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($res);
    $order_id = $row['order_id'];
    $username = $row['username'];
    $product_id = $row['product_id'];
    $merchant_id = $row['merchant_id'];
    $productname = $row['product_name'];
    $quantity = $row['quantity'];
    $tolamt = $row['total_amount'];
    $payment_method = $row['payment_method'];
    $orderdate = $row['order_date'];
}
elseif (isset($_GET['recentorder_id'])) {
    $order_id = $_GET['recentorder_id'];
    $query = "select * from orders where order_id=$order_id";
    $res = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($res);
    $order_id = $row['order_id'];
    $username = $row['username'];
    $product_id = $row['product_id'];
    $merchant_id = $row['merchant_id'];
    $productname = $row['product_name'];
    $quantity = $row['quantity'];
    $tolamt = $row['total_amount'];
    $payment_method = $row['payment_method'];
    $orderdate = $row['order_date'];
}
?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Order ID - <?= htmlspecialchars($order_id); ?></div>
    </div>
    <div class="card-body">
        <div class="details-grid">
            <div class="label">Customer Name</div>
            <div class="value" id="nameValue">
                <p><?= htmlspecialchars($username); ?></p>
            </div>
            <div class="label">Merchant ID</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($merchant_id); ?></p>
            </div>
            <div class="label">Product ID</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($product_id); ?></p>
            </div>
            <div class="label">Product Name</div>
            <div class="value" id="emailValue">
                <p><?= htmlspecialchars($productname); ?></p>
            </div>
            <div class="label">Quantity</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($quantity); ?></p>
            </div>
            <div class="label">Total Amount</div>
            <div class="value" id="phoneValue">
                <p>₹<?= htmlspecialchars($tolamt); ?></p>
            </div>
            <div class="label">Payment Method</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($payment_method); ?></p>
            </div>
            <div class="label">Order Date</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($orderdate); ?></p>
            </div>
        </div>
    </div>