<?php
 if (isset($_GET['user_id'])) {
        $user_id = $_GET['user_id'];
        $query = "select * from user_details where user_id=$user_id";
        $res = mysqli_query($connect, $query);
        $row = mysqli_fetch_array($res);
        $userid = $row['user_id'];
        $username = $row['user_name'];
        $email = $row['email'];
        $phone = $row['phone'];
        $role = $row['role'];
        $joindate = $row['created_at'];
        $shopName = $row['shop_name'];
        $brandType = $row['brand_name'];
        $businessNum = $row['business_number'];
        $shopAddress = $row['shop_address'];
    }
    ?>
<div class="card">
    <div class="card-header">
        <div class="card-title">User ID - <?= htmlspecialchars($userid); ?></div>
    </div>
    <div class="card-body">
        <div class="details-grid">
            <div class="label">Name</div>
            <div class="value" id="nameValue">
                <p><?= htmlspecialchars($username); ?></p>
            </div>
            <div class="label">Email</div>
            <div class="value" id="emailValue">
                <p><?= htmlspecialchars($email); ?></p>
            </div>
            <div class="label">Phone</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($phone); ?></p>
            </div>
            <div class="label">Role</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($role); ?></p>
            </div>
            <?php
            if ($role == 'merchant') {
                ?>
                <div class="label">Shop Name</div>
                <div class="value" id="phoneValue">
                    <p><?= $shopName; ?></p>
                </div>
                <div class="label">Brand Type</div>
                <div class="value" id="phoneValue">
                    <p><?= $brandType; ?></p>
                </div>
                <div class="label">Business Mobile Number</div>
                <div class="value" id="phoneValue">
                    <p><?= $businessNum; ?></p>
                </div>
                <div class="label">Shop Address</div>
                <div class="value" id="phoneValue">
                    <p><?= $shopAddress; ?></p>
                </div>
                <?php
            }
            ?>
            <div class="label">Join date</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($joindate); ?></p>
            </div>
        </div>
    </div>