<?php
if (isset($_GET['sub_id'])) {
    $user_id = $_GET['sub_id'];
    $query = "select * from sub_admins where id=$user_id";
    $res = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($res);
    $id = $row['id'];
    $managerName = $row['name'];
    $managerId = $row['manager_id'];
    $password = $row['password'];
    $managerPhone = $row['phone'];
    $managerMail = $row['email_id'];
    $lastlogin = $row['created_at'];
}
?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Manager ID - <?= htmlspecialchars($user_id); ?></div>
    </div>
    <div class="card-body">
        <div class="details-grid">
            <div class="label">Manager Name</div>
            <div class="value" id="nameValue">
                <p><?= htmlspecialchars($managerName); ?></p>
            </div>
            <div class="label">Manager Id</div>
            <div class="value" id="emailValue">
                <p><?= htmlspecialchars($managerId); ?></p>
            </div>
            <div class="label">Password</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($password); ?></p>
            </div>
            <div class="label">Manager Phone Number</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($managerPhone); ?></p>
            </div>
            <div class="label">Manager Email</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($managerMail); ?></p>
            </div>
            <div class="label">Join date</div>
            <div class="value" id="phoneValue">
                <p><?= htmlspecialchars($lastlogin); ?></p>
            </div>
        </div>
    </div>
</div>