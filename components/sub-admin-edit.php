<?php
if (isset($_GET['sub_id'])) {
    $user_id = $_GET['sub_id'];
    $query = "select * from sub_admins where id=$user_id";
    $res = mysqli_query($connect, $query);
    $row = mysqli_fetch_array($res);
    $id = $row['id'];
    $managername = $row['name'];
    $managerid = $row['manager_id'];
    $managerpwd = $row['password'];
    $managerPhone = $row['phone'];
    $managermail = $row['email_id'];
    $status = $row['status'];
}



?>
<div class="card">
    <div class="card-header">
        <div class="card-title">Manager ID - <?= htmlspecialchars($id); ?></div>
    </div>
    <div class="card-body">
        <form action="edit.php?sub_id=<?= $user_id ?>" method="post" class="detail">
            <input type="hidden" name="id" value="<?= htmlspecialchars($user_id); ?>">
            <div class="details-grid">
                <div class="label">Name</div>
                <div class="value" id="nameValue">
                    <input type="text" name="name" class="input-field" value="<?= htmlspecialchars($managername); ?>">
                    <div class="error"><?= $nameErr ?></div>
                </div>
                <div class="label">Manager ID</div>
                <div class="value" id="emailValue">
                    <input type="text" name="manager-id" class="input-field"
                        value="<?= htmlspecialchars($managerid); ?>" readonly>
                </div>
                <div class="label">Password</div>
                <div class="value" id="phoneValue" style="position: relative;">
                    <input type="password" id="password" name="password" class="input-field"
                        value="<?= htmlspecialchars($managerpwd); ?>">
                    <i class="bi bi-eye-slash" id="togglePassword"
                        style="position:absolute; right:10px; top:7px; cursor:pointer; color:#555;"></i>
                    <div class="error"><?= $passwordErr ?></div>

                </div>
                <div class="label">Mobile Number</div>
                <div class="value" id="phoneValue">
                    <input type="text" name="mobile_number" class="input-field"
                        value="<?= htmlspecialchars($managerPhone); ?>">
                    <div class="error"><?= $mobileErr ?></div>

                </div>
                <div class="label">Mail</div>
                <div class="value" id="phoneValue">
                    <input type="text" name="mail" class="input-field" value="<?= htmlspecialchars($managermail); ?>">
                    <div class="error"><?= $mailErr ?></div>

                </div>
                <div class="label"></div>
                <button type="submit" class="create-btn btn-primary" name="update_manager">update</button>

            </div>
        </form>
    </div>
</div>
<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#password");

    togglePassword.addEventListener("click", function () {
        const type = password.getAttribute("type") === "password" ? "text" : "password";
        password.setAttribute("type", type);

        this.classList.toggle("bi-eye");
        this.classList.toggle("bi-eye-slash");
    });
</script>